<?php

if (!function_exists('newshub_mikado_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function newshub_mikado_register_top_header_areas() {
        $top_bar_enabled = newshub_mikado_options()->getOptionValue('top_bar');
        $top_bar_layout  = newshub_mikado_options()->getOptionValue('top_bar_layout');

        if ($top_bar_enabled == 'yes') {
            register_sidebar(array(
                'name' => esc_html__('Top Bar Left', 'newshub'),
                'id' => 'mkd-top-bar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="mkd-top-bar-heading">',
                'after_title' => '</h6>'
            ));

            //register this widget area only if top bar layout is three columns
            if($top_bar_layout === 'three-columns') {
                register_sidebar(array(
                    'name' => esc_html__('Top Bar Center', 'newshub'),
                    'id' => 'mkd-top-bar-center',
                    'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
                    'after_widget' => '</div>',
                    'before_title' => '<h6 class="mkd-top-bar-heading">',
                    'after_title' => '</h6>'
                ));
            }

            register_sidebar(array(
                'name' => esc_html__('Top Bar Right', 'newshub'),
                'id' => 'mkd-top-bar-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-top-bar-widget">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="mkd-top-bar-heading">',
                'after_title' => '</h6>'
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_register_top_header_areas');
}

if(!function_exists('newshub_mikado_header_standard_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function newshub_mikado_header_standard_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Right From Main Menu', 'newshub'),
            'id'            => 'mkd-right-from-main-menu',
            'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-main-menu-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right hand side from the main menu', 'newshub')
        ));
    }

    add_action('widgets_init', 'newshub_mikado_header_standard_areas');
}

if(!function_exists('newshub_mikado_header_type1_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function newshub_mikado_header_type1_widget_areas() {
        if(newshub_mikado_options()->getOptionValue('header_type') == 'header-type1' && newshub_mikado_options()->getOptionValue('widget_area_header_type1') == 'yes'  ) {
            register_sidebar(array(
                'name'          => esc_html__('Header Middle Area', 'newshub'),
                'id'            => 'mkd-header-middle-area-widget',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-header-middle-area-widget">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the middle area of Header', 'newshub')
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_header_type1_widget_areas');
}

if(!function_exists('newshub_mikado_header_type23_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function newshub_mikado_header_type23_widget_areas() {
        if(newshub_mikado_options()->getOptionValue('header_type') == 'header-type2' || newshub_mikado_options()->getOptionValue('header_type') == 'header-type3') {
            register_sidebar(array(
                'name'          => esc_html__('Left From Logo', 'newshub'),
                'id'            => 'mkd-left-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-left-from-logo">',
                'after_widget'  => '</div>',
                'description' => esc_html__('Widgets added here will appear on the left hand side from the logo', 'newshub')
            ));
            register_sidebar(array(
                'name'          => esc_html__('Right From Logo', 'newshub'),
                'id'            => 'mkd-right-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-logo">',
                'after_widget'  => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side from the logo', 'newshub')
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_header_type23_widget_areas');
}

if(!function_exists('newshub_mikado_header_type4_widget_areas')) {
    /**
     * Registers widget areas for standard header type
     */
    function newshub_mikado_header_type4_widget_areas() {
        if(newshub_mikado_options()->getOptionValue('header_type') == 'header-type4') {
            register_sidebar(array(
                'name'          => esc_html__('Right From Logo', 'newshub'),
                'id'            => 'mkd-right-from-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-logo">',
                'after_widget'  => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side from the logo', 'newshub')
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_header_type4_widget_areas');
}

if (!function_exists('newshub_mikado_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function newshub_mikado_register_sticky_header_areas() {
        if (in_array(newshub_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name' => esc_html__('Sticky Right', 'newshub'),
                'id' => 'mkd-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-sticky-right">',
                'after_widget' => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side in sticky menu', 'newshub')
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_register_sticky_header_areas');
}

if (!function_exists('newshub_mikado_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function newshub_mikado_register_mobile_header_areas() {
        if (newshub_mikado_is_responsive_on()) {
            register_sidebar(array(
                'name' => esc_html__('Right From Mobile Logo', 'newshub'),
                'id' => 'mkd-right-from-mobile-logo',
                'before_widget' => '<div id="%1$s" class="widget %2$s mkd-right-from-mobile-logo">',
                'after_widget' => '</div>',
                'description' => esc_html__('Widgets added here will appear on the right hand side from the mobile logo', 'newshub')
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_register_mobile_header_areas');
}