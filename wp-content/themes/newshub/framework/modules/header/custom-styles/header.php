<?php

if(!function_exists('newshub_mikado_header_top_bar_styles')) {
    /**
     * Generates styles for header top bar
     */
    function newshub_mikado_header_top_bar_styles() {

        $background_color = newshub_mikado_options()->getOptionValue('top_bar_background_color');
        $top_bar_styles = array();

        if($background_color !== '') {
            $top_bar_styles['background-color'] = $background_color;
        }

        if(newshub_mikado_options()->getOptionValue('top_bar_bottom_border') == 'yes'){
            if(newshub_mikado_options()->getOptionValue('top_bar_bottom_border_color') !== "") {
                $top_bar_styles['border-bottom'] = '1px solid ' . newshub_mikado_options()->getOptionValue('top_bar_bottom_border_color');
            }
        }

        if(newshub_mikado_options()->getOptionValue('top_bar_color') !== ''){
            $top_bar_styles['color'] = newshub_mikado_options()->getOptionValue('top_bar_color');
        }

        echo newshub_mikado_dynamic_css('.mkd-top-bar', $top_bar_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_top_bar_styles');
}

if(!function_exists('newshub_mikado_header_top_bar_responsive_styles')) {
    /**
     * Generates styles for header top bar
     */
    function newshub_mikado_header_top_bar_responsive_styles() {

        $hide_top_bar_on_mobile = newshub_mikado_options()->getOptionValue('hide_top_bar_on_mobile');

        if($hide_top_bar_on_mobile === 'yes') { ?>
            @media only screen and (max-width: 700px) {
                .mkd-top-bar {
                    height: 0;
                    display: none;
                }
            }
        <?php }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_top_bar_responsive_styles');
}

if(!function_exists('newshub_mikado_header_type1_widget_area_styles')) {
    /**
     * Generates styles for header type 1 widget area
     */
    function newshub_mikado_header_type1_widget_area_styles() {

        $widget_area_header_type1_styles = array();

        if(newshub_mikado_options()->getOptionValue('widget_area_height_header_type1') !== '') {
            $widget_area_header_type1_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('widget_area_height_header_type1')).'px';
        }

        if(newshub_mikado_options()->getOptionValue('widget_area_color_header_type1') !== '') {
            $widget_area_header_type1_styles['color'] = newshub_mikado_options()->getOptionValue('widget_area_color_header_type1');
        }

        if(newshub_mikado_options()->getOptionValue('widget_area_background_color_header_type1') !== '') {
            $widget_area_header_type1_styles['background-color'] = newshub_mikado_options()->getOptionValue('widget_area_background_color_header_type1');
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type1 .mkd-page-header .mkd-widget-area', $widget_area_header_type1_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type1_widget_area_styles');
}


if(!function_exists('newshub_mikado_header_type1_mac_widget_area_styles')) {
    /**
     * Generates styles for header type 1 widget area on mac
     */
    function newshub_mikado_header_type1_mac_widget_area_styles() {

        $widget_area_header_type1_styles = array();

        if(newshub_mikado_options()->getOptionValue('widget_area_height_mac_header_type1') !== '') {
            $widget_area_header_type1_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('widget_area_height_mac_header_type1')).'px';
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type1 .mkd-page-header .mkd-widget-area', $widget_area_header_type1_styles);

    }

    add_action('newshub_mikado_style_dynamic_responsive_1025_1280', 'newshub_mikado_header_type1_mac_widget_area_styles');
}

if(!function_exists('newshub_mikado_header_type1_menu_area_styles')) {
    /**
     * Generates styles for header type 1 menu area
     */
    function newshub_mikado_header_type1_menu_area_styles() {

        $menu_area_header_type1_styles = array();

        if(newshub_mikado_options()->getOptionValue('menu_area_height_header_type1') !== '') {
            $menu_area_header_type1_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('menu_area_height_header_type1')).'px';
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_color_header_type1') !== '') {
            $menu_area_header_type1_styles['color'] = newshub_mikado_options()->getOptionValue('menu_area_color_header_type1');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type1') !== '') {

            $background_color = newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type1');
            if($background_color !== ''){
                $background_opacity = 1;
                if(newshub_mikado_options()->getOptionValue('menu_area_background_color_tr_header_type1') !== ''){
                    $background_opacity = newshub_mikado_options()->getOptionValue('menu_area_background_color_tr_header_type1');
                }
                $menu_area_header_type1_styles['background-color'] = newshub_mikado_rgba_color($background_color,$background_opacity);
            }
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type1 .mkd-page-header .mkd-menu-area', $menu_area_header_type1_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type1_menu_area_styles');
}

if(!function_exists('newshub_mikado_header_type2_menu_area_styles')) {
    /**
     * Generates styles for header type 2 menu area
     */
    function newshub_mikado_header_type2_menu_area_styles() {

        $menu_area_header_type2_styles = array();
        $logo_area_header_type2_styles = array();

        if(newshub_mikado_options()->getOptionValue('menu_area_height_header_type2') !== '') {
            $menu_area_header_type2_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('menu_area_height_header_type2')).'px';
            $logo_area_header_type2_styles['margin-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('menu_area_height_header_type2')).'px';
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_color_header_type2') !== '') {
            $menu_area_header_type2_styles['color'] = newshub_mikado_options()->getOptionValue('menu_area_color_header_type2');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type2') !== '') {
            $menu_area_header_type2_styles['background-color'] = newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type2');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_border_header_type2') == 'yes'){
            if(newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type2') !== ""){
                $menu_area_header_type2_styles['border-bottom-color'] = newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type2');
            }else{
                // default state
            }
        }
        elseif(newshub_mikado_options()->getOptionValue('menu_area_border_header_type2') == 'no'){
            $menu_area_header_type2_styles['border-bottom'] = 'none';
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type2 .mkd-page-header .mkd-menu-area', $menu_area_header_type2_styles);
        echo newshub_mikado_dynamic_css('.mkd-header-type2 .mkd-page-header .mkd-fixed-wrapper + .mkd-logo-area', $logo_area_header_type2_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type2_menu_area_styles');
}

if(!function_exists('newshub_mikado_header_type2_logo_styles')) {
    /**
     * Generates styles for header type 2 logo
     */
    function newshub_mikado_header_type2_logo_styles() {

        $logo_area_header_type2_styles = array();

        if(newshub_mikado_options()->getOptionValue('logo_area_height_header_type2') !== '') {
            $header_type2_height = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('logo_area_height_header_type2'));

            $logo_area_header_type2_styles['height'] = $header_type2_height.'px';

            $max_height = intval($header_type2_height).'px';
            echo newshub_mikado_dynamic_css('.mkd-header-type2 .mkd-page-header .mkd-logo-wrapper a', array('max-height' => $max_height));
        }
        
        if (newshub_mikado_options()->getOptionValue('logo_area_color_header_type2')) {
            $logo_area_header_type2_styles['color'] = esc_url(newshub_mikado_options()->getOptionValue('logo_area_color_header_type2'));
        }

        if (newshub_mikado_options()->getOptionValue('logo_area_background_color_header_type2')) {
            $logo_area_header_type2_styles['background-color'] = esc_url(newshub_mikado_options()->getOptionValue('logo_area_background_color_header_type2'));
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type2 .mkd-page-header .mkd-logo-area', $logo_area_header_type2_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type2_logo_styles');
}


if(!function_exists('newshub_mikado_header_type3_logo_styles')) {
    /**
     * Generates styles for header type 3 logo
     */
    function newshub_mikado_header_type3_logo_styles() {

        $logo_area_header_type3_styles = array();

        if(newshub_mikado_options()->getOptionValue('logo_area_height_header_type3') !== '') {
            $header_type3_height = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('logo_area_height_header_type3'));

            $logo_area_header_type3_styles['height'] = $header_type3_height.'px';

            $max_height = intval($header_type3_height).'px';
            echo newshub_mikado_dynamic_css('.mkd-header-type3 .mkd-page-header .mkd-logo-wrapper a', array('max-height' => $max_height));
        }

        if (newshub_mikado_options()->getOptionValue('logo_area_color_header_type3')) {
            $logo_area_header_type3_styles['color'] = esc_url(newshub_mikado_options()->getOptionValue('logo_area_color_header_type3'));
        }

        if (newshub_mikado_options()->getOptionValue('logo_area_background_color_header_type3')) {
            $logo_area_header_type3_styles['background-color'] = esc_url(newshub_mikado_options()->getOptionValue('logo_area_background_color_header_type3'));
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type3 .mkd-page-header .mkd-logo-area', $logo_area_header_type3_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type3_logo_styles');
}

if(!function_exists('newshub_mikado_header_type3_menu_area_styles')) {
    /**
     * Generates styles for header type 3 menu area
     */
    function newshub_mikado_header_type3_menu_area_styles() {

        $menu_area_header_type3_styles = array();

        if(newshub_mikado_options()->getOptionValue('menu_area_height_header_type3') !== '') {
            $menu_area_header_type3_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('menu_area_height_header_type3')).'px';
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_color_header_type3') !== '') {
            $menu_area_header_type3_styles['color'] = newshub_mikado_options()->getOptionValue('menu_area_color_header_type3');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type3') !== '') {
            $menu_area_header_type3_styles['background-color'] = newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type3');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_border_header_type3') == 'yes'){
            if(newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type3') !== ""){

                if(newshub_mikado_options()->getOptionValue('menu_area_border_top_header_type3') == 'yes') {
                    $menu_area_header_type3_styles['border-top'] = '1px solid ' . newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type3');
                }
                else {
                    $menu_area_header_type3_styles['border-top'] = 'none';
                }

                if(newshub_mikado_options()->getOptionValue('menu_area_border_bottom_header_type3') == 'yes') {
                    $menu_area_header_type3_styles['border-bottom'] = '1px solid ' . newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type3');
                }
                else {
                    $menu_area_header_type3_styles['border-bottom'] = 'none';
                }

            }else{
                // default state
            }
        }
        elseif(newshub_mikado_options()->getOptionValue('menu_area_border_header_type3') == 'no'){
            $menu_area_header_type3_styles['border-top'] = 'none';
            $menu_area_header_type3_styles['border-bottom'] = 'none';
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type3 .mkd-page-header .mkd-menu-area', $menu_area_header_type3_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type3_menu_area_styles');
}

if(!function_exists('newshub_mikado_header_type4_logo_styles')) {
    /**
     * Generates styles for header type 4 logo
     */
    function newshub_mikado_header_type4_logo_styles() {

        $logo_area_header_type4_styles = array();

        if(newshub_mikado_options()->getOptionValue('logo_area_height_header_type4') !== '') {
            $header_type4_height = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('logo_area_height_header_type4'));

            $logo_area_header_type4_styles['height'] = $header_type4_height.'px';

            $max_height = intval($header_type4_height).'px';
            echo newshub_mikado_dynamic_css('.mkd-header-type4 .mkd-page-header .mkd-logo-wrapper a', array('max-height' => $max_height));
        }

        if (newshub_mikado_options()->getOptionValue('logo_area_color_header_type4')) {
            $logo_area_header_type4_styles['color'] = esc_url(newshub_mikado_options()->getOptionValue('logo_area_color_header_type4'));
        }

        if (newshub_mikado_options()->getOptionValue('logo_area_background_color_header_type4')) {
            $logo_area_header_type4_styles['background-color'] = esc_url(newshub_mikado_options()->getOptionValue('logo_area_background_color_header_type4'));
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type4 .mkd-page-header .mkd-logo-area', $logo_area_header_type4_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type4_logo_styles');
}

if(!function_exists('newshub_mikado_header_type4_menu_area_styles')) {
    /**
     * Generates styles for header type 4 menu area
     */
    function newshub_mikado_header_type4_menu_area_styles() {

        $menu_area_header_type4_styles = array();

        if(newshub_mikado_options()->getOptionValue('menu_area_height_header_type4') !== '') {
            $menu_area_header_type4_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('menu_area_height_header_type4')).'px';
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_color_header_type4') !== '') {
            $menu_area_header_type4_styles['color'] = newshub_mikado_options()->getOptionValue('menu_area_color_header_type4');
        }
        
        if(newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type4') !== '') {
            $menu_area_header_type4_styles['background-color'] = newshub_mikado_options()->getOptionValue('menu_area_background_color_header_type4');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_border_header_type4') == 'yes'){
            if(newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type4') !== ""){

                if(newshub_mikado_options()->getOptionValue('menu_area_border_top_header_type4') == 'yes') {
                    $menu_area_header_type4_styles['border-top'] = '1px solid ' . newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type4');
                }
                else {
                    $menu_area_header_type4_styles['border-top'] = 'none';
                }

                if(newshub_mikado_options()->getOptionValue('menu_area_border_bottom_header_type4') == 'yes') {
                    $menu_area_header_type4_styles['border-bottom'] = '1px solid ' . newshub_mikado_options()->getOptionValue('menu_area_border_color_header_type4');
                }
                else {
                    $menu_area_header_type4_styles['border-bottom'] = 'none';
                }

            }else{
                // default state
            }
        }
        elseif(newshub_mikado_options()->getOptionValue('menu_area_border_header_type4') == 'no'){
            $menu_area_header_type4_styles['border-top'] = 'none';
            $menu_area_header_type4_styles['border-bottom'] = 'none';
        }

        echo newshub_mikado_dynamic_css('.mkd-header-type4 .mkd-page-header .mkd-menu-area', $menu_area_header_type4_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_header_type4_menu_area_styles');
}


if(!function_exists('newshub_mikado_sticky_header_styles')) {
    /**
     * Generates styles for sticky haeder
     */
    function newshub_mikado_sticky_header_styles() {

        $sticky_header_style = array();

        if(newshub_mikado_options()->getOptionValue('sticky_header_background_color') !== '' || newshub_mikado_options()->getOptionValue('sticky_border_bottom_color') !== '') {

            if(newshub_mikado_options()->getOptionValue('sticky_header_background_color') !== '') {

                $sticky_header_background_color = newshub_mikado_options()->getOptionValue('sticky_header_background_color');
                $sticky_header_background_color_transparency = 1;

                if (newshub_mikado_options()->getOptionValue('sticky_header_transparency') !== '') {
                    $sticky_header_background_color_transparency = newshub_mikado_options()->getOptionValue('sticky_header_transparency');
                }

                $sticky_header_style['background-color'] = newshub_mikado_rgba_color($sticky_header_background_color, $sticky_header_background_color_transparency);
            }

            if(newshub_mikado_options()->getOptionValue('sticky_border_bottom') == 'yes' && newshub_mikado_options()->getOptionValue('sticky_border_bottom_color') !== ""){
                $sticky_header_style['border-bottom'] = '1px solid ' . newshub_mikado_options()->getOptionValue('sticky_border_bottom_color');
            }

            echo newshub_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder', $sticky_header_style);
        }

        if(newshub_mikado_options()->getOptionValue('sticky_header_height') !== '') {
            $sticky_header_height = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sticky_header_height'));
            $max_height = intval($sticky_header_height * 0.9).'px';

            echo newshub_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header', array('height' => $sticky_header_height.'px'));
            echo newshub_mikado_dynamic_css('.mkd-page-header .mkd-sticky-header .mkd-sticky-holder .mkd-logo-wrapper a', array('max-height' => $max_height));
        }

        $sticky_menu_item_styles = array();
        if(newshub_mikado_options()->getOptionValue('sticky_color') !== '') {
            $sticky_menu_item_styles['color'] = newshub_mikado_options()->getOptionValue('sticky_color');
        }
        if(newshub_mikado_options()->getOptionValue('sticky_google_fonts') !== '-1') {
            $sticky_menu_item_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('sticky_google_fonts'));
        }
        if(newshub_mikado_options()->getOptionValue('sticky_fontsize') !== '') {
            $sticky_menu_item_styles['font-size'] = newshub_mikado_options()->getOptionValue('sticky_fontsize').'px';
        }
        if(newshub_mikado_options()->getOptionValue('sticky_lineheight') !== '') {
            $sticky_menu_item_styles['line-height'] = newshub_mikado_options()->getOptionValue('sticky_lineheight').'px';
        }
        if(newshub_mikado_options()->getOptionValue('sticky_texttransform') !== '') {
            $sticky_menu_item_styles['text-transform'] = newshub_mikado_options()->getOptionValue('sticky_texttransform');
        }
        if(newshub_mikado_options()->getOptionValue('sticky_fontstyle') !== '') {
            $sticky_menu_item_styles['font-style'] = newshub_mikado_options()->getOptionValue('sticky_fontstyle');
        }
        if(newshub_mikado_options()->getOptionValue('sticky_fontweight') !== '') {
            $sticky_menu_item_styles['font-weight'] = newshub_mikado_options()->getOptionValue('sticky_fontweight');
        }
        if(newshub_mikado_options()->getOptionValue('sticky_letterspacing') !== '') {
            $sticky_menu_item_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('sticky_letterspacing').'px';
        }

        $sticky_menu_item_selector = array(
            '.mkd-page-header .mkd-sticky-header .mkd-main-menu.mkd-sticky-nav > ul > li > a'
        );

        echo newshub_mikado_dynamic_css($sticky_menu_item_selector, $sticky_menu_item_styles);

        $sticky_menu_item_hover_styles = array();
        if(newshub_mikado_options()->getOptionValue('sticky_hovercolor') !== '') {
            $sticky_menu_item_hover_styles['color'] = newshub_mikado_options()->getOptionValue('sticky_hovercolor');
        }

        $sticky_menu_item_hover_selector = array(
            '.mkd-page-header .mkd-sticky-header .mkd-main-menu.mkd-sticky-nav > ul > li:hover > a',
            '.mkd-page-header .mkd-sticky-header .mkd-main-menu.mkd-sticky-nav > ul > li.mkd-active-item:hover > a'
        );

        echo newshub_mikado_dynamic_css($sticky_menu_item_hover_selector, $sticky_menu_item_hover_styles);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_sticky_header_styles');
}

if(!function_exists('newshub_mikado_main_menu_styles')) {
    /**
     * Generates styles for main menu
     */
    function newshub_mikado_main_menu_styles() {

        if(newshub_mikado_options()->getOptionValue('menu_color') !== '' || newshub_mikado_options()->getOptionValue('menu_fontsize') != '' || newshub_mikado_options()->getOptionValue('menu_lineheight') != '' || newshub_mikado_options()->getOptionValue('menu_fontstyle') !== '' || newshub_mikado_options()->getOptionValue('menu_fontweight') !== '' || newshub_mikado_options()->getOptionValue('menu_texttransform') !== '' || newshub_mikado_options()->getOptionValue('menu_letterspacing') !== '' || newshub_mikado_options()->getOptionValue('menu_google_fonts') != "-1") { ?>
            .mkd-main-menu.mkd-default-nav > ul > li > a {
            <?php if(newshub_mikado_options()->getOptionValue('menu_color')) { ?> color: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_color')); ?>!important ; <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_google_fonts') != "-1") { ?>
                font-family: '<?php echo esc_attr(str_replace('+', ' ', newshub_mikado_options()->getOptionValue('menu_google_fonts'))); ?>', sans-serif;
            <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_fontsize') !== '') { ?> font-size: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_fontsize')); ?>px; <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_lineheight') !== '') { ?> line-height: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_lineheight')); ?>px; <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_fontstyle') !== '') { ?> font-style: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_fontstyle')); ?>; <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_fontweight') !== '') { ?> font-weight: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_fontweight')); ?>; <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_texttransform') !== '') { ?> text-transform: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_texttransform')); ?>;  <?php } ?>
            <?php if(newshub_mikado_options()->getOptionValue('menu_letterspacing') !== '') { ?> letter-spacing: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_letterspacing')); ?>px; <?php } ?>
            }
        <?php } ?>

        <?php if(newshub_mikado_options()->getOptionValue('menu_hovercolor') !== '') { ?>
            .mkd-main-menu.mkd-default-nav > ul > li:hover > a,
            .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item:hover > a {
                color: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_hovercolor')); ?> !important;
            }
        <?php } ?>

        <?php if(newshub_mikado_options()->getOptionValue('menu_activecolor') !== '') { ?>
            .mkd-main-menu.mkd-default-nav > ul > li.mkd-active-item > a {
                color: <?php echo esc_attr(newshub_mikado_options()->getOptionValue('menu_activecolor')); ?> !important;
            }
        <?php } ?>

        <?php
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_main_menu_styles');
}

if(!function_exists('newshub_mikado_main_menu_item_styles')) {
    /**
     * Generates styles for main menu item
     */
    function newshub_mikado_main_menu_item_styles() {

        $menu_item_styles = array();
        $menu_item_hover_styles = array();
        $menu_item_arrows = array();
        if(newshub_mikado_options()->getOptionValue('menu_item_background_color') !== '') {
            $menu_item_styles['background-color'] = newshub_mikado_options()->getOptionValue('menu_item_background_color');
        }

        if(newshub_mikado_options()->getOptionValue('menu_item_hover_background_color') !== '') {
            $menu_item_hover_styles['background-color'] = newshub_mikado_options()->getOptionValue('menu_item_hover_background_color');
        }

        if(newshub_mikado_options()->getOptionValue('menu_item_border_color') !== '' || newshub_mikado_options()->getOptionValue('menu_item_hover_border_color') !== '') {
            $menu_item_styles['border-right'] = '1px solid transparent'; ?>
            .mkd-main-menu > ul > li:first-child > a {
                border-left: 1px solid;
            }
        <?php

        }

        if(newshub_mikado_options()->getOptionValue('menu_item_border_color') !== '') {
            $menu_item_styles['border-color'] = newshub_mikado_options()->getOptionValue('menu_item_border_color'); ?>
            .mkd-main-menu > ul > li:first-child > a {
                border-left-color: <?php echo esc_attr($menu_item_styles['border-color']) ?>
            }
            <?php
        }

        if(newshub_mikado_options()->getOptionValue('menu_item_hover_border_color') !== '') {
            $menu_item_hover_styles['border-color'] = newshub_mikado_options()->getOptionValue('menu_item_hover_border_color');
        }

        if(newshub_mikado_options()->getOptionValue('menu_area_item_arrow') === 'no') {
            $menu_item_arrows['display'] = 'none';
        }

        $main_menu_item_selector = array(
            '.mkd-main-menu > ul > li > a'
        );

        $main_menu_item_hover_selector = array(
            '.mkd-main-menu > ul > li:hover > a'
        );

        $main_menu_item_arrows_selector = array(
            '.mkd-main-menu > ul > li > a > i.blank:before, 
             .mkd-main-menu > ul > li > a .mkd-menu-arrow:before'
        );


        echo newshub_mikado_dynamic_css($main_menu_item_selector, $menu_item_styles);

        echo newshub_mikado_dynamic_css($main_menu_item_hover_selector, $menu_item_hover_styles);

        echo newshub_mikado_dynamic_css($main_menu_item_arrows_selector, $menu_item_arrows);


    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_main_menu_item_styles');
}


if(!function_exists('newshub_mikado_main_menu_dropdown_styles')) {
    /**
     * Generates styles for main menu
     */
    function newshub_mikado_main_menu_dropdown_styles() {

        $dropdown_styles = array();
        $dropdown_item_styles = array();
        $dropdown_item_hover_styles = array();

        if(newshub_mikado_options()->getOptionValue('dropdown_text_color') !== '') {
            $dropdown_item_styles['color'] = newshub_mikado_options()->getOptionValue('dropdown_text_color');
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_google_fonts') !== '-1') {
            $dropdown_item_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('dropdown_google_fonts'));
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_fontsize') !== '') {
            $dropdown_item_styles['font-size'] = newshub_mikado_options()->getOptionValue('dropdown_fontsize').'px';
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_lineheight') !== '') {
            $dropdown_item_styles['line-height'] = newshub_mikado_options()->getOptionValue('dropdown_lineheight').'px';
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_texttransform') !== '') {
            $dropdown_item_styles['text-transform'] = newshub_mikado_options()->getOptionValue('dropdown_texttransform');
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_fontstyle') !== '') {
            $dropdown_item_styles['font-style'] = newshub_mikado_options()->getOptionValue('dropdown_fontstyle');
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_fontweight') !== '') {
            $dropdown_item_styles['font-weight'] = newshub_mikado_options()->getOptionValue('dropdown_fontweight');
        }
        if(newshub_mikado_options()->getOptionValue('dropdown_letterspacing') !== '') {
            $dropdown_item_styles['letter-spacing'] = newshub_mikado_options()->getOptionValue('dropdown_letterspacing').'px';
        }

        if(newshub_mikado_options()->getOptionValue('dropdown_text_hover_color') !== '') {
            $dropdown_item_hover_styles['color'] = newshub_mikado_options()->getOptionValue('dropdown_text_hover_color');
        }

        if(newshub_mikado_options()->getOptionValue('dropdown_background_color') !== '') {
            $dropdown_styles['background-color'] = newshub_mikado_options()->getOptionValue('dropdown_background_color');
        }

        if(newshub_mikado_options()->getOptionValue('dropdown_border_color') !== '') {
            $dropdown_styles['border'] = '1px solid' . newshub_mikado_options()->getOptionValue('dropdown_border_color');
        }

        $dropdown_selector = array(
            '.mkd-drop-down .mkd-menu-second .mkd-menu-inner > ul,
            li.mkd-menu-narrow .mkd-menu-second .mkd-menu-inner ul,
            .mkd-top-bar #lang_sel ul ul'
        );

        $dropdown_selector_item = array(
            '.mkd-drop-down .mkd-menu-second .mkd-menu-inner > ul li a,
            li.mkd-menu-narrow .mkd-menu-second .mkd-menu-inner ul li a,
            .mkd-top-bar #lang_sel ul ul li a'
        );

        $dropdown_selector_item_hover = array(
            '.mkd-drop-down .mkd-menu-second .mkd-menu-inner > ul > li:hover > a,
            li.mkd-menu-narrow .mkd-menu-second .mkd-menu-inner ul > li:hover > a,
            .mkd-top-bar #lang_sel > ul > ul > li:hover > a,
            .mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul > li.current-menu-item>a,
            .mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul > li.current_page_item>a'
        );

        echo newshub_mikado_dynamic_css($dropdown_selector, $dropdown_styles);

        echo newshub_mikado_dynamic_css($dropdown_selector_item, $dropdown_item_styles);

        echo newshub_mikado_dynamic_css($dropdown_selector_item_hover, $dropdown_item_hover_styles);


    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_main_menu_dropdown_styles');
}