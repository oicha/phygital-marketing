<?php

if(!function_exists('newshub_mikado_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function newshub_mikado_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(newshub_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(newshub_mikado_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = newshub_mikado_options()->getOptionValue('mobile_header_background_color');
        }

        if(newshub_mikado_options()->getOptionValue('mobile_header_border_color')) {
            $mobile_header_styles['border-bottom-color'] = newshub_mikado_options()->getOptionValue('mobile_header_border_color');
        }

        echo newshub_mikado_dynamic_css('.mkd-mobile-header .mkd-mobile-header-inner', $mobile_header_styles);


		if(newshub_mikado_options()->getOptionValue('mobile_menu_background_color')) {
			echo newshub_mikado_dynamic_css(
				'.mkd-mobile-header .mkd-mobile-nav',
				array("background-color" => newshub_mikado_options()->getOptionValue('mobile_menu_background_color'))
			);
		}
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_mobile_header_general_styles');
}

if(!function_exists('newshub_mikado_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function newshub_mikado_mobile_logo_styles() {
        if(newshub_mikado_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo newshub_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-logo-wrapper a',
                array('height' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(newshub_mikado_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo newshub_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-logo-wrapper a',
                array('height' => newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_mobile_logo_styles');
}

if(!function_exists('newshub_mikado_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function newshub_mikado_mobile_icon_styles() {
    	
        if(newshub_mikado_options()->getOptionValue('mobile_icon_color') !== '') {
            echo newshub_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-menu-opener .mkd-mobile-opener-icon-holder i',
                array('color' => newshub_mikado_options()->getOptionValue('mobile_icon_color')));
        }

        if(newshub_mikado_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo newshub_mikado_dynamic_css(
                '.mkd-mobile-header .mkd-mobile-menu-opener a:hover .mkd-mobile-opener-icon-holder i',
                array('color' => newshub_mikado_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_mobile_icon_styles');
}