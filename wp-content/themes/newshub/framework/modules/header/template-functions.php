<?php

use NewsHub\Modules\Header\Lib\HeaderFactory;

if(!function_exists('newshub_mikado_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines newshub_mikado_header_type_parameters filter
     */
    function newshub_mikado_get_header() {

        //will be read from options
        $header_type     = newshub_mikado_options()->getOptionValue('header_type');
        $header_behavior = newshub_mikado_options()->getOptionValue('header_behaviour');

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => newshub_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
            );

            $parameters = apply_filters('newshub_mikado_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('newshub_mikado_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function newshub_mikado_get_header_top() {

        //generate column width class
        switch(newshub_mikado_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_width_class = '50-50';
                break;
            case ('three-columns'):
                $column_width_class = newshub_mikado_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_width_class,
            'show_widget_center' => newshub_mikado_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top'    => newshub_mikado_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => newshub_mikado_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('newshub_mikado_header_top_params', $params);

        newshub_mikado_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('newshub_mikado_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function newshub_mikado_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : newshub_mikado_options()->getOptionValue('header_type');

        if($slug == 'sticky'){
            $logo_image = newshub_mikado_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = newshub_mikado_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = newshub_mikado_options()->getOptionValue('logo_image_dark');
        $logo_image_light = newshub_mikado_options()->getOptionValue('logo_image_light');
        $logo_image_transparent = newshub_mikado_options()->getOptionValue('logo_image_transparent');

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = newshub_mikado_get_image_dimensions($logo_image);

        $logo_height = 51;
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
        }
        $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_image_transparent' => $logo_image_transparent,
            'logo_styles' => $logo_styles,
        );

        newshub_mikado_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('newshub_mikado_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function newshub_mikado_get_main_menu($additional_class = 'mkd-default-nav') {
        newshub_mikado_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('newshub_mikado_get_sticky_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function newshub_mikado_get_sticky_main_menu($additional_class = 'mkd-default-nav') {
        newshub_mikado_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('newshub_mikado_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     * * @param $slug
     */
    function newshub_mikado_get_sticky_header($slug = '') {

        $parameters = array(
            'hide_logo' => newshub_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_in_grid'    => newshub_mikado_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
        );

        newshub_mikado_get_module_template_part('templates/behaviors/sticky-header', 'header', $slug, $parameters);
    }
}

if(!function_exists('newshub_mikado_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function newshub_mikado_get_mobile_header() {
        if(newshub_mikado_is_responsive_on()) {
            $header_type = newshub_mikado_options()->getOptionValue('header_type');

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => newshub_mikado_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'show_navigation_opener' => has_nav_menu('main-navigation')
            );

            newshub_mikado_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('newshub_mikado_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function newshub_mikado_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : newshub_mikado_options()->getOptionValue('header_type');

        //check if mobile logo has been set and use that, else use normal logo
        if(newshub_mikado_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = newshub_mikado_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = newshub_mikado_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = newshub_mikado_get_image_dimensions($logo_image);

        $logo_height = 51;
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
        }
        $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        newshub_mikado_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('newshub_mikado_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function newshub_mikado_get_mobile_nav() {

        $slug = newshub_mikado_options()->getOptionValue('header_type');

        newshub_mikado_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}