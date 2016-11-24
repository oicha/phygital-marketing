<?php
namespace NewsHub\Modules\Blog\Shortcodes\PostLayoutThree;

use NewsHub\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class PostLayoutThree
 */
class PostLayoutThree extends ListShortcode
{

    /**
     * @var string
     */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_post_layout_three';
        $this->css_class = 'mkd-pl-three';
        $this->shortcode_title = esc_html__('Mikado Post Layout 3','newshub');

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
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'display_post_type_icon' => 'no',
            'post_type_icon_size' => 'small',

            'display_category' => 'no',

            'title_tag' => 'h5',
            'title_length' => '',
            'title_font_size' => '',
            'title_line_height' => '',
            'title_text_transform' => '',
            'title_font_style' => '',
            'title_font_weight' => '',
            'title_letter_spacing' => '',

            'display_date' => 'yes',
            'date_format' => 'F d, Y',

            'display_comments' => 'no',
            'display_count' => 'no',
            'display_like' => 'no',
            'display_author' => 'no',

            'display_separator' => '',
        );

        $params = shortcode_atts($args, $atts);

        $params['title_length'] = esc_attr($params['title_length']);
        $params['title_style'] = $this->getTitleStyle($params);

        $html = '';

        if ($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= newshub_mikado_get_list_shortcode_module_template_part('post-template-three', 'templates', '', $params);

            endwhile;
        else:
            $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

        return $html;
    }

    /**
     * Generates posts additional class string.
     *
     * @param $params
     *
     * @return array
     */
    protected function getAdditionalClasses($params) {
        $holder_classes = array();

        if ($params['display_separator'] == 'yes') {
            $holder_classes[] = 'mkd-display-separator';
        }

        return $holder_classes;
    }
}