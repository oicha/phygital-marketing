<?php

if (!function_exists('newshub_mikado_footer_top_styles')) {
    /**
     * Generates styles for footer top
     */
    function newshub_mikado_footer_top_styles() {

        $background_color = newshub_mikado_options()->getOptionValue('footer_top_background_color');
        $footer_top_styles = array();

        if ($background_color !== '') {
            $footer_top_styles['background-color'] = $background_color;
        }

        if (newshub_mikado_options()->getOptionValue('footer_top_top_border') == 'yes') {
            if (newshub_mikado_options()->getOptionValue('footer_top_top_border_color') !== "") {
                $footer_top_styles['border-top'] = '1px solid ' . newshub_mikado_options()->getOptionValue('footer_top_top_border_color');
            }
        }

        echo newshub_mikado_dynamic_css('footer .mkd-footer-top-holder', $footer_top_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_footer_top_styles');
}

if (!function_exists('newshub_mikado_footer_top_text_styles')) {
    /**
     * Generates styles for footer top
     */
    function newshub_mikado_footer_top_text_styles() {

        $footer_top_styles = array();

        if (newshub_mikado_options()->getOptionValue('footer_top_color') !== "") {
            $footer_top_styles['color'] = newshub_mikado_options()->getOptionValue('footer_top_color');

            $footer_top_selector = '
                footer .mkd-footer-top-holder,
                footer .mkd-footer-top-holder .widget,
                footer .mkd-footer-top-holder .widget a,
                footer .mkd-footer-top-holder .widget select,
                footer .mkd-footer-top-holder .widget .wp-caption-text,
                footer .mkd-footer-top-holder .widget .wp-calendar caption,
                footer .mkd-footer-top-holder .widget .wp-calendar td#today,
                footer .mkd-footer-top-holder .widget .widget_rss .rss-date,
                footer .mkd-footer-top-holder .widget .widget_search input,
                footer .mkd-footer-top-holder .widget .widget_search input[type="submit"],
                footer .mkd-footer-top-holder .widget .widget_recent_comments ul li .comment-author-link,
                footer .mkd-footer-top-holder .widget .widget_recent_comments ul li a:before,
                footer .mkd-footer-top-holder .widget .mkd-rc-holder .mkd-rc-date
                ';
            echo newshub_mikado_dynamic_css($footer_top_selector, array('color' => $footer_top_styles['color'] . '!important'));
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_footer_top_text_styles');
}

if (!function_exists('newshub_mikado_footer_bottom_text_styles')) {
    /**
     * Generates styles for footer bottom
     */
    function newshub_mikado_footer_bottom_text_styles() {

        $footer_bottom_styles = array();

        if (newshub_mikado_options()->getOptionValue('footer_bottom_color') !== "") {
            $footer_bottom_styles['color'] = newshub_mikado_options()->getOptionValue('footer_bottom_color');

            $footer_bottom_selector = '
                footer .mkd-footer-bottom-holder,
                footer .mkd-footer-bottom-holder .widget,
                footer .mkd-footer-bottom-holder .widget a,
                footer .mkd-footer-bottom-holder .widget select,
                footer .mkd-footer-bottom-holder .widget .wp-caption-text,
                footer .mkd-footer-bottom-holder .widget .wp-calendar caption,
                footer .mkd-footer-bottom-holder .widget .wp-calendar td#today,
                footer .mkd-footer-bottom-holder .widget .widget_rss .rss-date,
                footer .mkd-footer-bottom-holder .widget .widget_search input,
                footer .mkd-footer-bottom-holder .widget .widget_search input[type="submit"],
                footer .mkd-footer-bottom-holder .widget .widget_recent_comments ul li .comment-author-link,
                footer .mkd-footer-bottom-holder .widget .widget_recent_comments ul li a:before,
                footer .mkd-footer-bottom-holder .widget .mkd-rc-holder .mkd-rc-date
                ';
            echo newshub_mikado_dynamic_css($footer_bottom_selector, array('color' => $footer_bottom_styles['color'] . '!important'));
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_footer_bottom_text_styles');
}


if (!function_exists('newshub_mikado_footer_bottom_styles')) {
    /**
     * Generates styles for footer bottom
     */
    function newshub_mikado_footer_bottom_styles() {

        $background_color = newshub_mikado_options()->getOptionValue('footer_bottom_background_color');
        $footer_bottom_styles = array();

        if ($background_color !== '') {
            $footer_bottom_styles['background-color'] = $background_color;
        }

        if (newshub_mikado_options()->getOptionValue('footer_bottom_top_border') == 'yes') {
            if (newshub_mikado_options()->getOptionValue('footer_bottom_top_border_color') !== "") {
                $footer_bottom_styles['border-top'] = '1px solid ' . newshub_mikado_options()->getOptionValue('footer_bottom_top_border_color');
            }
        }

        echo newshub_mikado_dynamic_css('footer .mkd-footer-bottom-holder', $footer_bottom_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_footer_bottom_styles');
}

if (!function_exists('newshub_mikado_footer_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function newshub_mikado_footer_menu_styles() {

        $footer_menu_styles = array();
        $footer_menu_item_styles = array();
        $footer_menu_item_hover_styles = array();

        if (newshub_mikado_options()->getOptionValue('footer_widget_margin') !== '') {
            $footer_menu_styles['margin-bottom'] = newshub_mikado_options()->getOptionValue('footer_widget_margin') . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_text_color') !== '') {
            $footer_menu_item_styles['color'] = newshub_mikado_options()->getOptionValue('footer_menu_text_color');
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_google_fonts') !== '-1') {
            $footer_menu_item_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('footer_menu_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_fontsize') !== '') {
            $footer_menu_item_styles['font-size'] = newshub_mikado_options()->getOptionValue('footer_menu_fontsize') . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_lineheight') !== '') {
            $footer_menu_item_styles['line-height'] = newshub_mikado_options()->getOptionValue('footer_menu_lineheight') . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_texttransform') !== '') {
            $footer_menu_item_styles['text-transform'] = newshub_mikado_options()->getOptionValue('footer_menu_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_fontstyle') !== '') {
            $footer_menu_item_styles['font-style'] = newshub_mikado_options()->getOptionValue('footer_menu_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_fontweight') !== '') {
            $footer_menu_item_styles['font-weight'] = newshub_mikado_options()->getOptionValue('footer_menu_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_letterspacing') !== '') {
            $footer_menu_item_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('footer_menu_letterspacing') . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('footer_menu_text_hover_color') !== '') {
            $footer_menu_item_hover_styles['color'] = newshub_mikado_options()->getOptionValue('footer_menu_text_hover_color');
        }


        $footer_menu_selector = array(
            'footer .widget.widget_text'
        );

        $footer_menu_selector_item = array(
            'footer .widget.widget_nav_menu ul li a'
        );

        $footer_menu_selector_item_hover = array(
            'footer .widget.widget_nav_menu ul li a:hover'
        );

        echo newshub_mikado_dynamic_css($footer_menu_selector, $footer_menu_styles);

        echo newshub_mikado_dynamic_css($footer_menu_selector_item, $footer_menu_item_styles);

        echo newshub_mikado_dynamic_css($footer_menu_selector_item_hover, $footer_menu_item_hover_styles);


    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_footer_menu_styles');
}