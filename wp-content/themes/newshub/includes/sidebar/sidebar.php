<?php

if (!function_exists('mkd_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function mkd_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar','newshub'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar','newshub'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
            'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
        ));
    }

    add_action('widgets_init', 'mkd_register_sidebars');
}

if (!function_exists('mkd_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates NewsHubMikadoSidebar object
     */
    function mkd_add_support_custom_sidebar() {
        add_theme_support('NewsHubMikadoSidebar');
        if (get_theme_support('NewsHubMikadoSidebar')) new NewsHubMikadoSidebar();
    }

    add_action('after_setup_theme', 'mkd_add_support_custom_sidebar');
}
