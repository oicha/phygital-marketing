<?php

if (!function_exists('newshub_mikado_side_area_over_content_style')) {

    function newshub_mikado_side_area_over_content_style() {

        $width = newshub_mikado_options()->getOptionValue('side_area_slide_over_content_width');
        if ($width !== '') {

            if ($width == 'width-290') {
                $width = '290px';
            } elseif ($width == 'width-311') {
                $width = '311px';
            } else {
                $width = '390px';
            }

            echo newshub_mikado_dynamic_css('.mkd-side-menu-slide-over-content .mkd-side-menu', array(
                'right' => '-' . $width,
                'width' => $width
            ));
        }

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_over_content_style');

}

if (!function_exists('newshub_mikado_side_area_icon_color_styles')) {

    function newshub_mikado_side_area_icon_color_styles() {

        if (newshub_mikado_options()->getOptionValue('side_area_icon_color') !== '') {

            echo newshub_mikado_dynamic_css('a.mkd-side-menu-button-opener', array(
                'color' => newshub_mikado_options()->getOptionValue('side_area_icon_color')
            ));

        }
        if (newshub_mikado_options()->getOptionValue('side_area_icon_hover_color') !== '') {

            echo newshub_mikado_dynamic_css('a.mkd-side-menu-button-opener:hover', array(
                'color' => newshub_mikado_options()->getOptionValue('side_area_icon_hover_color').'!important'
            ));
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_icon_color_styles');
}

if (!function_exists('newshub_mikado_side_area_alignment')) {

    function newshub_mikado_side_area_alignment() {

        if (newshub_mikado_options()->getOptionValue('side_area_aligment')) {

            echo newshub_mikado_dynamic_css('.mkd-side-menu-slide-over-content .mkd-side-menu', array(
                'text-align' => newshub_mikado_options()->getOptionValue('side_area_aligment')
            ));

        }

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_alignment');

}

if (!function_exists('newshub_mikado_side_area_styles')) {

    function newshub_mikado_side_area_styles() {

        $side_area_styles = array();

        if (newshub_mikado_options()->getOptionValue('side_area_background_color') !== '') {
            $side_area_styles['background-color'] = newshub_mikado_options()->getOptionValue('side_area_background_color');
        }

        if (!empty($side_area_styles)) {
            echo newshub_mikado_dynamic_css('.mkd-side-menu', $side_area_styles);
        }

        if (newshub_mikado_options()->getOptionValue('side_area_close_icon') == 'dark') {
            echo newshub_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
                'color' => '#000000'
            ));
        }

        if (newshub_mikado_options()->getOptionValue('side_area_close_icon_size') !== '') {
            echo newshub_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu', array(
                'height' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
                'width' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
                'line-height' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
                'padding' => 0,
            ));
            echo newshub_mikado_dynamic_css('.mkd-side-menu a.mkd-close-side-menu span, .mkd-side-menu a.mkd-close-side-menu i', array(
                'font-size' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
                'height' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
                'width' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
                'line-height' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_close_icon_size')) . 'px',
            ));
        }

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_styles');

}

if (!function_exists('newshub_mikado_side_area_title_styles')) {

    function newshub_mikado_side_area_title_styles() {

        $title_styles = array();

        if (newshub_mikado_options()->getOptionValue('side_area_title_color') !== '') {
            $title_styles['color'] = newshub_mikado_options()->getOptionValue('side_area_title_color');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_fontsize') !== '') {
            $title_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_title_fontsize')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_lineheight') !== '') {
            $title_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_title_lineheight')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_texttransform') !== '') {
            $title_styles['text-transform'] = newshub_mikado_options()->getOptionValue('side_area_title_texttransform');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_google_fonts') !== '-1') {
            $title_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('side_area_title_google_fonts')) . ', sans-serif';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_fontstyle') !== '') {
            $title_styles['font-style'] = newshub_mikado_options()->getOptionValue('side_area_title_fontstyle');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_fontweight') !== '') {
            $title_styles['font-weight'] = newshub_mikado_options()->getOptionValue('side_area_title_fontweight');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_title_letterspacing') !== '') {
            $title_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_title_letterspacing')) . 'px';
        }

        if (!empty($title_styles)) {

            echo newshub_mikado_dynamic_css('.mkd-side-menu .mkd-side-menu-title h5', $title_styles);

        }

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_title_styles');

}

if (!function_exists('newshub_mikado_side_area_text_styles')) {

    function newshub_mikado_side_area_text_styles() {
        $text_styles = array();

        if (newshub_mikado_options()->getOptionValue('side_area_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('side_area_text_google_fonts')) . ', sans-serif';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_fontsize') !== '') {
            $text_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_text_fontsize')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_lineheight') !== '') {
            $text_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_text_lineheight')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('side_area_text_letterspacing')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_fontweight') !== '') {
            $text_styles['font-weight'] = newshub_mikado_options()->getOptionValue('side_area_text_fontweight');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_fontstyle') !== '') {
            $text_styles['font-style'] = newshub_mikado_options()->getOptionValue('side_area_text_fontstyle');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_texttransform') !== '') {
            $text_styles['text-transform'] = newshub_mikado_options()->getOptionValue('side_area_text_texttransform');
        }

        if (newshub_mikado_options()->getOptionValue('side_area_text_color') !== '') {
            $text_styles['color'] = newshub_mikado_options()->getOptionValue('side_area_text_color');
        }

        if (!empty($text_styles)) {

            echo newshub_mikado_dynamic_css(array(
                '.mkd-side-menu .widget',
                '.mkd-side-menu .widget.widget_search form',
                '.mkd-side-menu .widget.widget_search form input[type="text"]',
                '.mkd-side-menu .widget.widget_search form input[type="submit"]',
                '.mkd-side-menu .widget h5',
                '.mkd-side-menu .widget h5 a',
                '.mkd-side-menu .widget p',
                '.mkd-side-menu .widget li a',
                '.mkd-side-menu #wp-calendar caption',
                '.mkd-side-menu .widget li',
                '.mkd-side-menu h3',
                '.mkd-side-menu .widget.widget_archive select',
                '.mkd-side-menu .widget.widget_categories select',
                '.mkd-side-menu .widget.widget_text select',
                '.mkd-side-menu .widget.widget_search form input[type="submit"]',
                '.mkd-side-menu #wp-calendar th',
                '.mkd-side-menu #wp-calendar td',
                '.mkd-side-menu .q_social_icon_holder i.simple_social',
                '.mkd-side-menu .widget .screen-reader-text',
                '.mkd-side-menu span',
                '.mkd-side-menu .widget.widget_nav_menu ul li a',
                '.mkd-side-menu .widget.widget_nav_menu ul li a:before',
                '.mkd-side-menu .widget.widget_nav_menu ul li a:after'
            ),
                $text_styles
            );
        }

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_text_styles');

}

if (!function_exists('newshub_mikado_side_area_link_styles')) {

    function newshub_mikado_side_area_link_styles() {
        $link_styles = array();

        if (newshub_mikado_options()->getOptionValue('sidearea_link_font_family') !== '-1') {
            $link_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('sidearea_link_font_family')) . ',sans-serif';
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_font_size') !== '') {
            $link_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidearea_link_font_size')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_line_height') !== '') {
            $link_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidearea_link_line_height')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_letter_spacing') !== '') {
            $link_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidearea_link_letter_spacing')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_font_weight') !== '') {
            $link_styles['font-weight'] = newshub_mikado_options()->getOptionValue('sidearea_link_font_weight');
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_font_style') !== '') {
            $link_styles['font-style'] = newshub_mikado_options()->getOptionValue('sidearea_link_font_style');
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_text_transform') !== '') {
            $link_styles['text-transform'] = newshub_mikado_options()->getOptionValue('sidearea_link_text_transform');
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_color') !== '') {
            $link_styles['color'] = newshub_mikado_options()->getOptionValue('sidearea_link_color');
        }

        if (!empty($link_styles)) {

            echo newshub_mikado_dynamic_css('.mkd-side-menu .widget li a, .mkd-side-menu .widget a:not(.qbutton),.mkd-side-menu .widget.widget_rss li a.rsswidget', $link_styles);
        }

        if (newshub_mikado_options()->getOptionValue('sidearea_link_hover_color') !== '') {
            echo newshub_mikado_dynamic_css('.mkd-side-menu .widget a:hover, .mkd-side-menu .widget li:hover, .mkd-side-menu .widget li:hover>a,.mkd-side-menu .widget.widget_rss li a.rsswidget:hover', array(
                'color' => newshub_mikado_options()->getOptionValue('sidearea_link_hover_color')
            ));
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_link_styles');
}


if (!function_exists('newshub_mikado_side_area_widget_styles')) {
    /**
     * Generates styles for text widget
     */
    function newshub_mikado_side_area_widget_styles() {

        $sidearea_widget_styles = array();

        if (newshub_mikado_options()->getOptionValue('sidearea_widget_margin') !== '') {
            $sidearea_widget_styles['margin-bottom'] = newshub_mikado_options()->getOptionValue('sidearea_widget_margin') . 'px';
        }

        $sidearea_widget_selector = array(
            '.mkd-side-menu .widget.widget_text'
        );

        echo newshub_mikado_dynamic_css($sidearea_widget_selector, $sidearea_widget_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_side_area_widget_styles');
}