<?php

if(!function_exists('newshub_mikado_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function newshub_mikado_header_class($classes) {
        $header_type = newshub_mikado_get_meta_field_intersect('header_type', newshub_mikado_get_page_id());

        $classes[] = 'mkd-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_header_class');
}

if(!function_exists('newshub_mikado_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function newshub_mikado_header_behaviour_class($classes) {

        $classes[] = 'mkd-'.newshub_mikado_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_header_behaviour_class');
}

if(!function_exists('newshub_mikado_header_style_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function newshub_mikado_header_style_class($classes) {

        $id = newshub_mikado_get_page_id();

        if(newshub_mikado_get_meta_field_intersect('header_style', $id) !== '') {
            $classes[] = 'mkd-' . newshub_mikado_get_meta_field_intersect('header_style', $id);
        }
        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_header_style_class');
}

if(!function_exists('newshub_mikado_mobile_header_class')) {
    function newshub_mikado_mobile_header_class($classes) {
        $classes[] = 'mkd-default-mobile-header';

        $classes[] = 'mkd-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_mobile_header_class');
}

if(!function_exists('newshub_mikado_header_global_js_var')) {
    function newshub_mikado_header_global_js_var($global_variables) {

        $global_variables['mkdTopBarHeight'] = newshub_mikado_get_top_bar_height();
        $global_variables['mkdStickyHeaderHeight'] = newshub_mikado_get_sticky_header_height();
        $global_variables['mkdStickyHeaderTransparencyHeight'] = newshub_mikado_get_sticky_header_height_of_complete_transparency();
        $global_variables['mkdMobileHeaderHeight'] = newshub_mikado_get_mobile_header_height();

        return $global_variables;
    }

    add_filter('newshub_mikado_js_global_variables', 'newshub_mikado_header_global_js_var');
}

if(!function_exists('newshub_mikado_header_per_page_js_var')) {
    function newshub_mikado_header_per_page_js_var($perPageVars) {

        $perPageVars['mkdStickyScrollAmount'] = newshub_mikado_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('newshub_mikado_per_page_js_vars', 'newshub_mikado_header_per_page_js_var');
}

if(!function_exists('newshub_mikado_header_sticky_height')) {
    function newshub_mikado_header_sticky_height($globalVariables) {

        $globalVariables['mkdStickyHeight'] = newshub_mikado_get_sticky_header_height();

        return $globalVariables;
    }

    add_filter('newshub_mikado_js_global_variables', 'newshub_mikado_header_sticky_height');
}

if(!function_exists('newshub_mikado_aps_custom_style_class')) {
    function newshub_mikado_aps_custom_style_class($classes) {


        if(newshub_mikado_options()->getOptionValue('aps_custom_style') === 'apsc-custom-style-enabled'){
            $classes[] = 'mkd-'.newshub_mikado_options()->getOptionValue('aps_custom_style');
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_aps_custom_style_class');
}