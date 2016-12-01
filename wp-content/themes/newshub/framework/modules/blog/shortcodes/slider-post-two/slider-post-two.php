<?php
namespace NewsHub\Modules\Blog\Shortcodes\SliderPostTwo;

use NewsHub\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class SliderPostTwo
 */
class SliderPostTwo extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_slider_post_two';
        $this->css_class = 'mkd-sp-two';
        $this->shortcode_title = esc_html__('Mikado Post Slider 2','newshub');

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
     * function gets $base for each shortcode
     *
     * @see newshub_mikado_get_shortcode_params()
     */

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',

            'display_category' => 'yes',

            'title_tag' => 'h2',
            'display_title_separator' => '',
            'title_length' => '',
            'title_font_size' => '',
            'title_line_height' => '',
            'title_text_transform' => '',
            'title_font_style' => '',
            'title_font_weight' => '',
            'title_letter_spacing' => '',

            'display_excerpt' => 'yes',
            'excerpt_length' => '20',
            'excerpt_margin_top' => '',
            'excerpt_margin_bottom' => '',

            'display_date' => 'yes',
            'date_format' => 'Y/m/d',

            'display_comments' => 'no',
            'display_count' => 'no',
            'display_like' => 'no',
            'display_author' => 'no',

            'display_read_more' => 'no',

            'display_spacing' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['title_length'] = esc_attr($params['title_length']);
        $params['title_style'] = $this->getTitleStyle($params);
        $params['excerpt_style'] = $this->getExcerptStyle($params);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-grid"></div>'; // this elements should be left empty, used for js calculations if slider is in centered mode
            $html .= '<div class="mkd-bnl-inner mkd-post-slider">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $html .= newshub_mikado_get_list_shortcode_module_template_part('post-template-eight', 'templates', '', $params);
            endwhile;

            $html .= '</div>'; // post-slider

        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
    }

    protected function getAdditionalClasses($params) {
        $holder_classes = array();

        if ($params['display_spacing'] != '') {
            $holder_classes[] = $params['display_spacing'];
        }

        $holder_classes[] = 'mkd-slider-holder';

        return $holder_classes;
    }

    /**
     * Generates posts additional data array.
     *
     * @param $params
     *
     * @return array
     */
    protected function getAdditionalData($params) {
        $data_classes = array();

        if (!isset($params['slider_slides_to_show']) || $params['slider_slides_to_show'] == '') {
            $data_classes['data-slider_slides_to_show'] = '1';
        }

        if (!isset($params['slider_slides_to_scroll']) || $params['slider_slides_to_scroll'] == '') {
            $data_classes['data-slider_slides_to_scroll'] = '1';
        }

        if (!isset($params['slider_center_mode']) || $params['slider_center_mode'] !== 'true') {
            $data_classes['data-slider_center_mode'] = 'false';
        }

        if (!isset($params['slider_autoplay']) || $params['slider_autoplay'] !== 'true') {
            $data_classes['data-slider_autoplay'] = 'true';
        }

        if (!isset($params['slider_arrows']) || $params['slider_arrows'] !== 'true') {
            $data_classes['data-slider_arrows'] = 'false';
        }

        if (!isset($params['slider_dots']) || $params['slider_dots'] !== 'true') {
            $data_classes['data-slider_dots'] = 'false';
        }
        return $data_classes;
    }
}