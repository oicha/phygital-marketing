<?php

namespace NewsHub\Modules\Blog\Shortcodes\Lib;

/**
 * Interface ShortcodeInterface
 */
abstract class ListShortcode
{

    private $base;
    private $css_class;
    private $shortcode_title;

    function __construct($base, $css_class, $shortcode_title) {
        $this->base = $base;
        $this->css_class = $css_class;
        $this->shortcode_title = $shortcode_title;
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */
    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(array(
                "name" => $this->shortcode_title,
                "base" => $this->base,
                'category' => esc_html__('by MIKADO  ','newshub'),
                "icon" => "icon-wpb-" . $this->css_class . " extended-custom-icon-magazine",
                "allowed_container_element" => 'vc_row',
                "params" => newshub_mikado_get_shortcode_params($this->base)
            ));
        }

    }

    /**
     * Renders specific HTML for each shortcode.This method is unique for each shortcode
     *
     * @param html
     */
    public function render($params, $content = null) {
    }

    /**
     * Renders shortcodes holder HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return html
     */
    public function renderHolders($atts, $content = null) {

        $args = newshub_mikado_get_shortcode_params_names(newshub_mikado_get_shortcode_params($this->base));
        $params = shortcode_atts($args, $atts);

        $this->overwriteSettings($params);

        $atts['query_result'] = $this->generatePostsQuery($params);
        $this->holderSettings($params, $atts);
        $this->passSettings($params, $atts);

        $holder_main_class = $this->css_class;

        $html = '';

        $html .= '<div class="mkd-bnl-holder ' . $this->css_class . '-holder  ' . esc_attr($params['holder_classes']) . '" ' . newshub_mikado_get_inline_attrs($params['posts_data']) . '>';


        if (!empty($params['title']) && $params['title'] !== '') {
            $html .= '<div class="mkd-layout-title-holder">';
            $html .= newshub_mikado_execute_shortcode('mkd_section_title', array('title' => $params['title'], 'title_tag' => 'h5'));
            $html .= '</div>';
        }


        $html .= '<div class="mkd-bnl-outer">';

        if (!$this->isBlockElement()) {
            $html .= '<div class="mkd-bnl-inner">';
        }

        $html .= $this->render($atts);

        if (!$this->isBlockElement()) {
            $html .= '</div>'; // close mkd-bnl-list-holder
        }

        $html .= '</div>'; // close mkd-bnl-holder-inner

        if ($this->isPaginationEnabled($params) && $params['max_pages'] > 1) {
            $html .= $this->getPaginationHtml($params, $atts);
        }

        $html .= '</div>';
        // close css_class holder

        return $html;
    }

    /**
     * Generates query array
     *
     * @param $params
     *
     * @return array
     */
    public function generatePostsQuery($params) {
        $queryResult = newshub_mikado_get_query($params);

        return $queryResult;
    }

    /**
     * Generates image size option
     *
     * @param $params
     *
     * @return string
     */
    private function generateImageSize($params, $type) {
        $thumbImageSize = '';

        switch ($type) {
            case 'regular' :
                $imageSize = isset($params['thumb_image_size']) ? $params['thumb_image_size'] : '';
                break;
            case 'featured' :
                $imageSize = isset($params['featured_thumb_image_size']) ? $params['featured_thumb_image_size'] : '';
                break;
            default :
                $imageSize = ''; // doesn't have image proportions
        }

        if ($imageSize !== '' && $imageSize == 'landscape') {
            $thumbImageSize = 'newshub_mikado_landscape';
        } else if ($imageSize !== '' && $imageSize === 'square') {
            $thumbImageSize = 'newshub_mikado_square';
        } else if ($imageSize !== '' && $imageSize == 'portrait') {
            $thumbImageSize = 'newshub_mikado_portrait';
        } else if ($imageSize !== '' && $imageSize == 'original') {
            $thumbImageSize = 'full';
        } else if ($imageSize !== '' && $imageSize == 'custom_size') {
            $thumbImageSize = 'custom_size';
        }

        return $thumbImageSize;
    }

    /**
     * Function that returns list of inline styles for post title
     *
     * @param $atts
     *
     * @return string
     */
    public function getTitleStyle($atts) {
        $style = array();

        // font size
        if (isset($atts['title_font_size']) && $atts['title_font_size'] !== '') {
            $style[] = 'font-size: ' . newshub_mikado_filter_px($atts['title_font_size']) . 'px';
        }

        // line height
        if (isset($atts['title_line_height']) && $atts['title_line_height'] !== '') {
            $style[] = 'line-height: ' . newshub_mikado_filter_px($atts['title_line_height']) . 'px';
        }

        // text transform
        if (isset($atts['title_text_transform']) && $atts['title_text_transform'] !== '') {
            $style[] = 'text-transform: ' . $atts['title_text_transform'];
        }

        // font style
        if (isset($atts['title_font_style']) && $atts['title_font_style'] !== '') {
            $style[] = 'font-style: ' . $atts['title_font_style'];
        }

        // font weight
        if (isset($atts['title_font_weight']) && $atts['title_font_weight'] !== '') {
            $style[] = 'font-weight: ' . $atts['title_font_weight'];
        }

        // letter spacing
        if (isset($atts['title_letter_spacing']) && $atts['title_letter_spacing'] !== '') {
            $style[] = 'letter-spacing: ' . newshub_mikado_filter_px($atts['title_letter_spacing']) . 'px';
        }

        return implode(';', $style);

    }

    /**
     * Function that returns list of inline styles for post excerpt
     *
     * @param $atts
     *
     * @return string
     */
    public function getExcerptStyle($atts) {
        $style = array();

        // margin top
        if (isset($atts['excerpt_margin_top']) && $atts['excerpt_margin_top'] !== '') {
            $style[] = 'margin-top: ' . newshub_mikado_filter_px($atts['excerpt_margin_top']) . 'px';
        }
        // margin bottom
        if (isset($atts['excerpt_margin_bottom']) && $atts['excerpt_margin_bottom'] !== '') {
            $style[] = 'margin-bottom: ' . newshub_mikado_filter_px($atts['excerpt_margin_bottom']) . 'px';
        }

        return implode(';', $style);

    }

    /**
     * Generates true/false for pagination
     *
     * @param $params
     *
     * @return boolean
     */
    private function isPaginationEnabled($params) {

        return (isset($params['display_pagination'])
            && isset($params['pagination_type'])
            && $params['display_pagination'] == 'yes');

    }

    /**
     * Generates true/false for pagination
     *
     * @return int
     */
    private function getPageNumber() {

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        return $paged;
    }

    /**
     * Generates posts data attribute array
     *
     * @param $params
     *
     * @return array
     */
    private function generatePostsData($params) {
        $sliderData = array();

        $sliderData['data-base'] = $this->base;

        foreach ($params as $key => $value) {
            $sliderData['data-' . $key] = ($value !== '') ? $value : '';
        }

        if ($this->isPaginationEnabled($params)) {
            $sliderData['data-prev_page'] = $sliderData['data-paged'] - 1;
            $sliderData['data-next_page'] = $sliderData['data-paged'] + 1;
        }

        $sliderData = array_merge($sliderData, $this->getAdditionalData($params));

        return $sliderData;
    }

    /**
     * Generates posts additional data array.
     *
     * @param $params
     *
     * @return array
     */

    protected function getAdditionalData($params) {
        return array();
    }

    /**
     * Generates posts class string
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params) {

        $holder_classes = array();

        if (isset($params['extra_class_name']) && $params['extra_class_name'] !== '') {
            $holder_classes[] = $params['extra_class_name'];
        }

        if (isset($params['general_style']) && $params['general_style'] !== '') {
            $holder_classes[] = 'mkd-post-layout-' . $params['general_style'];
        }

        if (isset($params['column_number']) && $params['column_number'] !== '') {
            $holder_classes[] = 'mkd-post-columns-' . $params['column_number'];
        }

        if ($this->isPaginationEnabled($params)) {
            $holder_classes[] = 'mkd-post-pag-' . $params['pagination_type'];
        }

        $holder_classes = array_merge($this->getAdditionalClasses($params), $holder_classes);

        return implode(' ', $holder_classes);
    }

    /**
     * Generates posts additional class string.
     *
     * @param $params
     *
     * @return array
     */

    protected function getAdditionalClasses($params) {
        return array();
    }

    /**
     * Overwrite setting in inner class.
     *
     * @param $params
     *
     * @return array
     */
    protected function overwriteSettings(&$params) {
    }

    /**
     * Enabling inner holder in shortcode if layout is used,
     * because block has its own inner holder
     *
     * @return boolean
     */
    protected function isBlockElement() {
        return false;
    }

    /**
     * Generating html if there where no post
     *
     * @return string-html
     */
    protected function errorMessage() {
        return '<div class="' . $this->css_class . '-message"><p>' . esc_html__('No posts were found.', 'newshub') . '</p></div>';
    }

    /**
     * Function that returns list of inline styles for navigation
     *
     * @param $atts
     *
     * @return string
     */
    private function getNavigationSettings($atts) {
        $style = array();

        // top
        if (isset($atts['navigation_top']) && $atts['navigation_top'] !== '') {
            $style[] = 'top: ' . newshub_mikado_filter_px($atts['navigation_top']) . 'px';
        }

        return implode(';', $style);

    }

    /**
     * Generates pagination html
     *
     * @param $params
     *
     * @return string-html
     */
    private function getPaginationHtml($params, $atts) {

        $html = '';

        switch ($params['pagination_type']) {
            case 'load-more' : {
                $html .= newshub_mikado_get_list_shortcode_module_template_part('post-show-load-more-template', 'templates', '', $atts);
            }
                break;
            case 'np-horizontal' : {
                $atts['navigation_style'] = $this->getNavigationSettings($atts);
                $html .= newshub_mikado_get_list_shortcode_module_template_part('post-direction-nav-horizontal-template', 'templates', '', $atts);
                $html .= newshub_mikado_get_list_shortcode_module_template_part('post-ajax-preloader-template', 'templates', '', $atts);
            }
                break;
            default :
                break;
        }

        return $html;
    }

    /**
     * Generates information for holder
     *
     * @param $params
     *
     * @param $atts
     *
     */
    private function holderSettings(&$params, &$atts) {
        $params['thumb_image_size'] = $this->generateImageSize($params, 'regular');
        $params['featured_thumb_image_size'] = $this->generateImageSize($params, 'featured');
        $params['paged'] = $this->getPageNumber();
        if ($params['offset'] > '0' && $params['offset'] != '') {
            $atts['max_pages'] = ceil(($atts['query_result']->found_posts - $params['offset']) / $atts['number_of_posts']);
        } else {
            $atts['max_pages'] = $atts['query_result']->max_num_pages;
        }
        $params['max_pages'] = $atts['max_pages'];
        $params['posts_data'] = $this->generatePostsData($params);
        $params['holder_classes'] = $this->getHolderClasses($params);

        // TODO make better logic to set default title
        /*if (!isset($params['title']) || ($params['title'] == '') && isset($params['pagination_type']) && $params['pagination_type'] == 'np-horizontal') {
            $params['title'] = '#';
        }*/

        $params['query_result'] = $atts['query_result'];
    }

    /**
     * Generates information that need to be passed to render
     *
     * @param $params
     *
     * @param $atts
     *
     */
    private function passSettings(&$params, &$atts) {
        $atts['thumb_image_size'] = $params['thumb_image_size'];
        if ($params['thumb_image_size'] == 'custom_size') {
            $atts['thumb_image_width'] = $params['thumb_image_width'];
            $atts['thumb_image_height'] = $params['thumb_image_height'];
        }
        $atts['featured_thumb_image_size'] = $params['featured_thumb_image_size'];
        if ($params['featured_thumb_image_size'] == 'custom_size' && $params['featured_thumb_image_width'] != '' && $params['featured_thumb_image_height'] != '') {
            $atts['featured_thumb_image_width'] = $params['featured_thumb_image_width'];
            $atts['featured_thumb_image_height'] = $params['featured_thumb_image_height'];
        }
    }
}