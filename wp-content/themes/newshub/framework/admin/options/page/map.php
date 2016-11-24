<?php

if ( ! function_exists('newshub_mikado_page_options_map') ) {

    function newshub_mikado_page_options_map() {

        newshub_mikado_add_admin_page(
            array(
                    'slug'  => '_page_page',
                'title' => esc_html__('Page','newshub'),
                'icon'  => 'fa fa-institution'
            )
        );

        $custom_sidebars = newshub_mikado_get_custom_sidebars();

        $panel_sidebar = newshub_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => esc_html__('Design Style','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name'        => 'page_sidebar_layout',
            'type'        => 'select',
            'label'       => esc_html__('Sidebar Layout','newshub'),
            'description' => esc_html__('Choose a sidebar layout for pages','newshub'),
            'default_value' => 'default',
            'parent'      => $panel_sidebar,
            'options'     => array(
                'default'			=> 'No Sidebar',
                'sidebar-33-right'	=> 'Sidebar 1/3 Right',
                'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
                'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
                'sidebar-25-left' 	=> 'Sidebar 1/4 Left'
            )
        ));


        if(count($custom_sidebars) > 0) {
            newshub_mikado_add_admin_field(array(
                'name' => 'page_custom_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display','newshub'),
                'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"','newshub'),
                'parent' => $panel_sidebar,
                'options' => $custom_sidebars
            ));
        }

        newshub_mikado_add_admin_field(array(
            'name'        => 'page_show_comments',
            'type'        => 'yesno',
            'label'       => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments on your page','newshub'),
            'default_value' => 'yes',
            'parent'      => $panel_sidebar
        ));

        do_action('newshub_mikado_after_page_options_map');

    }

    add_action( 'newshub_mikado_options_map', 'newshub_mikado_page_options_map', 7);

}