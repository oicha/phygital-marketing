<?php

namespace NewsHub\Modules\Blog\Shortcodes\BlockThree;

use NewsHub\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class BlockThree
 */
class BlockThree extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkd_block_three';
        $this->css_class = 'mkd-pb-three';
        $this->shortcode_title = esc_html__('Mikado Block 3','newshub');

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

        $args_featured = array(
            'featured_vertically_centered_content' => 'no',
            'featured_horizontally_centered_content' => 'no',

            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '',
            'featured_thumb_image_height' => '',

            'featured_display_post_type_icon' => 'no',
            'featured_post_type_icon_size' => 'small',

            'featured_display_share' => 'no',

            'featured_display_category' => 'yes',

            'featured_title_tag' => 'h3',
            'featured_display_title_separator' => '',
            'featured_title_length' => '',
            'featured_title_font_size' => '',
            'featured_title_line_height' => '',
            'featured_title_text_transform' => '',
            'featured_title_font_style' => '',
            'featured_title_font_weight' => '',
            'featured_title_letter_spacing' => '',

            'featured_display_excerpt' => 'no',
            'featured_excerpt_length' => '20',
            'featured_excerpt_margin_top' => '',
            'featured_excerpt_margin_bottom' => '',

            'featured_display_date' => 'yes',
            'featured_date_format' => 'F d, Y',

            'featured_display_comments' => 'no',
            'featured_display_count' => 'no',
            'featured_display_like' => 'no',
            'featured_display_author' => 'no',
        );

        $args = array(
            'vertically_centered_content' => 'no',
            'horizontally_centered_content' => 'no',

            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',

            'display_post_type_icon' => 'no',
            'post_type_icon_size' => 'small',

            'display_share' => 'no',

            'display_category' => 'yes',

            'title_tag' => 'h4',
            'display_title_separator' => '',
            'title_length' => '',
            'title_font_size' => '',
            'title_line_height' => '',
            'title_text_transform' => '',
            'title_font_style' => '',
            'title_font_weight' => '',
            'title_letter_spacing' => '',

            'display_excerpt' => 'no',
            'excerpt_length' => '20',
            'excerpt_margin_top' => '',
            'excerpt_margin_bottom' => '',

            'display_date' => 'yes',
            'date_format' => 'F d, Y',

            'display_comments' => 'no',
            'display_count' => 'no',
            'display_like' => 'no',
            'display_author' => 'no',
        );

        $params_featured = shortcode_atts($args_featured, $atts);
        $params_featured_filtered = newshub_mikado_get_filtered_params($params_featured, 'featured');

        $params_featured_filtered['excerpt_length'] = esc_attr($params_featured['featured_excerpt_length']);
        $params_featured_filtered['title_length'] = esc_attr($params_featured['featured_title_length']);
        $params_featured_filtered['title_style'] = $this->getTitleStyle($params_featured_filtered);
        $params_featured_filtered['excerpt_style'] = $this->getExcerptStyle($params_featured_filtered);

        $params = shortcode_atts($args, $atts);

        $params['excerpt_length'] = esc_attr($params['excerpt_length']);
        $params['title_length'] = esc_attr($params['title_length']);
        $params['title_style'] = $this->getTitleStyle($params);
        $params['excerpt_style'] = $this->getExcerptStyle($params);

        $html = '';

        $loop_counter = 0;
        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkd-bnl-inner">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $loop_counter++;

                if ($loop_counter == 1) {
                    $html .= '<div class="mkd-post-block-part mkd-post-block-featured mkd-pb-three-featured">';
                    //Get HTML from template
                    $html .= newshub_mikado_get_list_shortcode_module_template_part('post-template-four', 'templates', '', $params_featured_filtered);
                    $html .= '</div>';
                    $html .= '<div class="mkd-post-block-part mkd-post-block-non-featured mkd-pb-three-non-featured">';
                } else {
                    //Get HTML from template
                    $html .= newshub_mikado_get_list_shortcode_module_template_part('post-template-four', 'templates', '', $params);
                }

            endwhile;

            $html .= '</div>'; // close mkd-pb-three-non-featured
            $html .= '</div>'; // close mkd-bnl-inner

        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
    }

    /**
     * Enabling inner holder in shortcode if layout is used,
     * because block has its own inner holder
     *
     * @return boolean
     */
    protected function isBlockElement() {
        return true;
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

        if (isset($params['block_proportion']) && $params['block_proportion'] !== '') {
            $holder_classes[] = $params['block_proportion'];
        }

        if ($params['featured_horizontally_centered_content'] == 'yes') {
            $holder_classes[] = 'mkd-horizontally-centered-featured-content';
        }

        if ($params['featured_vertically_centered_content'] == 'yes') {
            $holder_classes[] = 'mkd-vertically-centered-featured-content';
        }

        if ($params['horizontally_centered_content'] == 'yes') {
            $holder_classes[] = 'mkd-horizontally-centered-non-featured-content';
        }

        if ($params['vertically_centered_content'] == 'yes') {
            $holder_classes[] = 'mkd-vertically-centered-non-featured-content';
        }

        if ($params['number_of_posts_dropdown'] == '2') {
            $holder_classes[] = 'mkd-non-featured-single';
        }

        $holder_classes[] = $params['non_featured_columns_number'];

        return $holder_classes;
    }

    /**
     * Overwrite setting in inner class.
     *
     * @param $params
     *
     * @return array
     */
    protected function overwriteSettings(&$params) {
        $params['number_of_posts'] = $params['number_of_posts_dropdown'];
    }
}