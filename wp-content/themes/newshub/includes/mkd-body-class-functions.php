<?php

if(!function_exists('newshub_mikado_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function newshub_mikado_boxed_class($classes) {
        $id = newshub_mikado_get_page_id();
        //is boxed layout turned on?
        if(newshub_mikado_get_meta_field_intersect('boxed',$id) == 'yes') {
            $classes[] = 'mkd-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_boxed_class');
}

if(!function_exists('newshub_mikado_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function newshub_mikado_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')).'-child-ver-'.$current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')).'-ver-'.$current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_theme_version_class');
}

if(!function_exists('newshub_mikado_fade_in_layouts_class')) {
    /**
     * Function that adds classes on body for fade in layouts effect
     */
    function newshub_mikado_fade_in_layouts_class($classes) {

        if(newshub_mikado_options()->getOptionValue('fade_in_layouts') == 'yes') {
            $classes[] = 'mkd-fade-in-layouts';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_fade_in_layouts_class');
}

if(!function_exists('newshub_mikado_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for smooth scroll
     */
    function newshub_mikado_smooth_scroll_class($classes) {

        //is smooth scroll enabled enabled and not Mac device?
        if(newshub_mikado_options()->getOptionValue('smooth_scroll') == 'yes') {
            $classes[] = 'mkd-smooth-scroll';
        } else {
            $classes[] = '';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_smooth_scroll_class');
}

if(!function_exists('newshub_mikado_set_blog_body_class')) {
    /**
     * Function that adds blog class to body if blog template, shortcodes or widgets are used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function newshub_mikado_set_blog_body_class($classes) {

        if(newshub_mikado_load_blog_assets()) {
            $classes[] = 'mkd-blog-installed';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_set_blog_body_class');
}

if(!function_exists('newshub_mikado_set_category_template_body_class')) {
    /**
     * Function that adds class to body if unique category template layout is used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function newshub_mikado_set_category_template_body_class($classes) {

        if(newshub_mikado_options()->getOptionValue('unigue_category_layout') === 'yes'){
            $classes[] = 'mkd-unique-category-layout';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_set_category_template_body_class');
}

if(!function_exists('newshub_mikado_set_title_body_class')) {
    /**
     * Function that adds class to body if unique category template layout is used on site.
     *
     * @param $classes array of body classes
     *
     * @return array with blog body class added
     */
    function newshub_mikado_set_title_body_class($classes) {
        $id = newshub_mikado_get_page_id();

        if(newshub_mikado_get_meta_field_intersect('show_title_area',$id) == 'no'){
            $classes[] = 'mkd-no-title-area';
        }

        return $classes;
    }

    add_filter('body_class', 'newshub_mikado_set_title_body_class');
}