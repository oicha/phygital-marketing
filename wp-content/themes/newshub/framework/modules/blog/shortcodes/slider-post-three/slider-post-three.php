<?php
namespace NewsHub\Modules\Blog\Shortcodes\SliderPostThree;

use NewsHub\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class SliderPostThree
 */
class SliderPostThree extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_slider_post_three';
        $this->css_class = 'mkd-sp-three';
        $this->shortcode_title = esc_html__('Mikado Post Slider 3','newshub');

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
            'display_category' => 'yes',

            'title_tag' => 'h2',
            'title_length' => '',
            'title_font_size' => '',
            'title_line_height' => '',
            'title_text_transform' => '',
            'title_font_style' => '',
            'title_font_weight' => '',
            'title_letter_spacing' => '',

            'display_date' => 'yes',
            'date_format' => 'Y/m/d',

            'display_comments' => 'no',
            'display_count' => 'no',
            'display_like' => 'no',
            'display_author' => 'no',

            'display_excerpt' => 'yes',
            'excerpt_length' => '20',
            'excerpt_margin_top' => '',
            'excerpt_margin_bottom' => '',

            'display_read_more' => 'yes',
        );

        $params = shortcode_atts($args, $atts);
        $params['title_style'] = $this->getTitleStyle($atts);
        $params['excerpt_style'] = $this->getExcerptStyle($params);

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-post-slider">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= newshub_mikado_get_list_shortcode_module_template_part('post-template-nine', 'templates', '', $params);

            endwhile;

            $html .= '</div>'; // close mkd-post-slider

        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
    }

    protected function getAdditionalClasses($params) {
        $holder_classes = array();

        if ($params['slider_parallax'] == 'true') {
            $holder_classes[] = 'mkd-parallax';
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

        if (!isset($params['slider_autoplay']) || $params['slider_autoplay'] !== 'true') {
            $data_classes['data-slider_autoplay'] = 'true';
        }

        return $data_classes;
    }
}