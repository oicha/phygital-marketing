<?php

/**
 * Widget that adds weather type
 *
 * Class Weather_Widget
 */
class NewsHubMikadoWeatherWidget extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_weather_widget', // Base ID
            esc_html__('Mikado Weather Widget', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $app_link = 'http://openweathermap.org/appid#get';
        $app_location = 'http://openweathermap.org/find';

        $this->params = array(
            array(
                'type' => 'textfield',
                'title' => esc_html__('Widget Title','newshub'),
                'name' => 'widget_title'
            ),
            array(
                'type' => 'textfield_html',
                'title' => esc_html__('API Key','newshub'),
                'name' => 'api_key',
                'description' => '<a href="' . esc_url($app_link) . '" target="_blank">'.esc_html__('How to get API key','newshub').'</a>'
            ),
            array(
                'type' => 'textfield_html',
                'title' => esc_html__('Location','newshub'),
                'name' => 'location',
                'description' => '<a href="' . esc_url($app_location) . '" target="_blank">'.esc_html__('Find Your Location (i.e: London,UK or New York City,NY)','newshub').'</a>'
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Temperature Unit','newshub'),
                'name' => 'units',
                'options' => array(
                    'metric' => esc_html__('Metric','newshub'),
                    'imperial' => esc_html__('Imperial','newshub')
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => esc_html__('Time zone','newshub'),
                'name' => 'time_zone',
                'options' => array(
                    '0' => 'UTC',
                    '1' => 'GMT',
                )
            ),
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        $api_key = '';
        if (!empty($instance['api_key']) && $instance['api_key'] !== '') {
            $api_key = $instance['api_key'];
        }

        $location = '';
        if (!empty($instance['location']) && $instance['location'] !== '') {
            $location = $instance['location'];
        }

        $units = '';
        if (!empty($instance['units']) && $instance['units'] !== '') {
            $units = $instance['units'];
        }

        $time_zone = '';
        if (!empty($instance['time_zone']) && $instance['time_zone'] !== '') {
            $time_zone = $instance['time_zone'];
        }

        print $args['before_widget'];
        if (!empty($instance['widget_title']) && $instance['widget_title'] !== '') {
            print $args['before_title'] . $instance['widget_title'] . $args['after_title'];
        }
        echo newshub_mikado_weather_widget_logic(
            array(
                'api_key' => $api_key,
                'location' => $location,
                'units' => $units,
                'time_zone' => $time_zone,
            )
        );
        print $args['after_widget'];
    }
}

// the logic
function newshub_mikado_weather_widget_logic($atts) {

    $html = "";
    $weather_data = array();
    $api_key = isset($atts['api_key']) ? $atts['api_key'] : false;
    $location = isset($atts['location']) ? $atts['location'] : false;
    $units = isset($atts['units']) ? $atts['units'] : false;
    $time_zone = isset($atts['time_zone']) ? $atts['time_zone'] : false;
    $days_to_show = 5;
    $locale = 'en';

    $sytem_locale = get_locale();
    $available_locales = array('en', 'es', 'sp', 'fr', 'it', 'de', 'pt', 'ro', 'pl', 'ru', 'uk', 'ua', 'fi', 'nl', 'bg', 'sv', 'se', 'ca', 'tr', 'hr', 'zh', 'zh_tw', 'zh_cn', 'hu');

    // check for locale
    if (in_array($sytem_locale, $available_locales)) $locale = $sytem_locale;

    // check for locale by first two digits, used as language in returned data
    if (in_array(substr($sytem_locale, 0, 2), $available_locales)) $locale = substr($sytem_locale, 0, 2);

    // if location is empty abort
    if (!$location) {
        return newshub_mikado_weather_widget_error();
    }

    // find and cache city id
    if (is_numeric($location)) {
        $city_name_slug = sanitize_title($location);;
        $api_query = "id=" . $location;
    } else {
        $city_name_slug = sanitize_title($location);
        $api_query = "q=" . $location;
    }

    // set transient name
    $weather_transient_name = 'mkd_' . $city_name_slug . "_" . $days_to_show . "_" . $units . '_' . $locale;

    // get weather data
    if (get_transient($weather_transient_name)) {
        $weather_data = get_transient($weather_transient_name);
    } else {
        $weather_data['now'] = array();
        $weather_data['forecast'] = array();

        // ping weather now api
        $now_ping = "http://api.openweathermap.org/data/2.5/weather?" . $api_query . "&lang=" . $locale . "&units=" . $units . "&APPID=" . $api_key;
        $now_ping = str_replace(" ", "", $now_ping);
        $now_ping_get = wp_remote_get($now_ping);

        // ping url error
        if (is_wp_error($now_ping_get)) return newshub_mikado_weather_widget_error($now_ping_get->get_error_message());

        // get body of request
        $city_data = json_decode($now_ping_get['body']);

        if (isset($city_data->cod) AND $city_data->cod == 404) {
            return newshub_mikado_weather_widget_error($city_data->message);
        } else {
            $weather_data['now'] = $city_data;
        }

        // ping weather forecast api
        $forecast_ping = "http://api.openweathermap.org/data/2.5/forecast/daily?" . $api_query . "&lang=" . $locale . "&units=" . $units . "&cnt=7&APPID=" . $api_key;

        $forecast_ping = str_replace(" ", "", $forecast_ping);
        $forecast_ping_get = wp_remote_get($forecast_ping);

        if (is_wp_error($forecast_ping_get)) {
            return newshub_mikado_weather_widget_error($forecast_ping_get->get_error_message());
        }

        $forecast_data = json_decode($forecast_ping_get['body']);

        if (isset($forecast_data->cod) AND $forecast_data->cod == 404) {
            return newshub_mikado_weather_widget_error($forecast_data->message);
        } else {
            $weather_data['forecast'] = $forecast_data;
        }

        if ($weather_data['now'] OR $weather_data['forecast']) {
            // set the transient, cache for three hours
            set_transient($weather_transient_name, $weather_data, apply_filters('newshub_mikado_weather_cache', 1800));
        }
    }

    // no weather
    if (!$weather_data OR !isset($weather_data['now'])) {
        return newshub_mikado_weather_widget_error();
    }

    // todays temps
    $today = $weather_data['now'];

    $today_temp = round($today->main->temp);
    $today_high = round($today->main->temp_max);
    $today_low = round($today->main->temp_min);

    // data
    $today->main->humidity = round($today->main->humidity);
    $today->wind->speed = round($today->wind->speed);

    $wind_label = array(esc_html__('N', 'newshub'), esc_html__('NNE', 'newshub'), esc_html__('NE', 'newshub'), esc_html__('ENE', 'newshub'), esc_html__('E', 'newshub'), esc_html__('ESE', 'newshub'), esc_html__('SE', 'newshub'), esc_html__('SSE', 'newshub'), esc_html__('S', 'newshub'), esc_html__('SSW', 'newshub'), esc_html__('SW', 'newshub'), esc_html__('WSW', 'newshub'), esc_html__('W', 'newshub'), esc_html__('WNW', 'newshub'), esc_html__('NW', 'newshub'), esc_html__('NNW', 'newshub'));

    if (isset($today->wind->deg) ? $wind_direction = $wind_label[fmod((($today->wind->deg + 11) / 22.5), 16)] : $wind_direction = '')
        $wind_direction = $wind_label[fmod((($today->wind->deg + 11) / 22.5), 16)];

    $holder_class = '';
    if (!empty($today->weather[0]->description) && $today->weather[0]->description !== '') {
        $holder_class = 'mkd-desc-' . sanitize_title($today->weather[0]->description);
    }

    if ($units == 'metric' ? $units_display_temperature = esc_html__('C', 'newshub') : $units_display_temperature = esc_html__('F', 'newshub')) ;
    if ($units == 'metric' ? $units_display_wind = esc_html__('m/s', 'newshub') : $units_display_wind = esc_html__('fps', 'newshub')) ;

    // display widget
    $html .= '<div class="mkd-weather-widget-holder ' . $holder_class . '">
        <div class="mkd-weather-information">
            <div class="mkd-weather-today-temp">
                <div class="mkd-weather-today-temp-inner"><span>' . $today_temp . ' <sup>' . $units_display_temperature . '</sup></span></div>
            </div>
            <div class="mkd-weather-todays-stats">
                <div class="mkd-weather-todays-description">' . $today->weather[0]->description . '</div>
                <div class="mkd-weather-todays-location">' . $today->name . '</div>
                <div class="mkd-weather-todays-humidty">' . esc_html__('humidity: ', 'newshub') . $today->main->humidity . esc_html__('%', 'newshub') . '</div>
                <div class="mkd-weather-todays-wind">' . esc_html__('wind: ', 'newshub') . $today->wind->speed . ' ' . $units_display_wind . ' ' . $wind_direction . '</div>
                <div class="mkd-weather-todays-highlow">' . esc_html__('H', 'newshub') . $today_high . ' &bull; ' . esc_html__('L', 'newshub') . $today_low . '</div>
            </div>
        </div>
        <div class="mkd-weather-forecast">
        ';

    $c = 1;
    $dt_today = date('Ymd', current_time('timestamp', $time_zone));
    $forecast = $weather_data['forecast'];
    $days_to_show = 5;

    foreach ((array)$forecast->list as $forecast) {
        if ($dt_today >= date('Ymd', $forecast->dt)) continue;
        $days_of_week = array(esc_html__('Sun', 'newshub'), esc_html__('Mon', 'newshub'), esc_html__('Tue', 'newshub'), esc_html__('Wed', 'newshub'), esc_html__('Thu', 'newshub'), esc_html__('Fri', 'newshub'), esc_html__('Sat', 'newshub'));

        $forecast->temp = (int)$forecast->temp->day;
        $day_of_week = $days_of_week[date('w', $forecast->dt)];
        $html .= '
                <div class="mkd-weather-forecast-day">
                    <div class="mkd-weather-forecast-day-abbr">' . $day_of_week . '</div>
                    <div class="mkd-weather-forecast-day-temp">' . $forecast->temp . ' <sup>' . $units_display_temperature . '</sup></div>
                </div>
            ';
        if ($c == $days_to_show) break;
        $c++;
    }

    $html .= '</div>
    </div>
    ';

    return $html;
}

// handle error
function newshub_mikado_weather_widget_error($msg = false) {

    if (!$msg) {
        $msg = esc_html__('No weather information available', 'newshub');
    }

    return $msg;
}