<?php

if (!function_exists('newshub_mikado_content_options_map')) {

    function newshub_mikado_content_options_map() {

        newshub_mikado_add_admin_page(
            array(
                'slug' => '_content_page',
                'title' => esc_html__('Content','newshub'),
                'icon' => 'fa fa-institution'
            )
        );

        $panel_content = newshub_mikado_add_admin_panel(
            array(
                'page' => '_content_page',
                'name' => 'panel_content',
                'title' => esc_html__('General','newshub')
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_content,
                'name' => 'content_top_title',
                'title' => esc_html__('Content Top','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'content_top_widget',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Content Top Widget','newshub'),
                'description' => esc_html__('Enabling this option will show widget on content top','newshub'),
                'parent' => $panel_content,
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_content_top_container'
                ),
            )
        );

        $show_content_top_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'show_content_top_container',
                'hidden_property' => 'content_top_widget',
                'hidden_value' => 'no',
                'parent' => $panel_content
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'content_top_in_grid',
                'default_value' => 'yes',
                'label' => esc_html__('Content Top in Grid','newshub'),
                'description' => esc_html__('Enabling this option will place content top in grid','newshub'),
                'parent' => $show_content_top_container,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'content_top_widget_bottom_separator',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Separator','newshub'),
                'description' => esc_html__('Enabling this option will place bottom separator on content top widget','newshub'),
                'parent' => $panel_content,
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_content_top_separator_container'
                ),
            )
        );

        $show_content_top_separator_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'show_content_top_separator_container',
                'hidden_property' => 'content_top_widget_bottom_separator',
                'hidden_value' => 'no',
                'parent' => $panel_content
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'color',
                'name' => 'content_top_widget_bottom_separator_color',
                'label' => esc_html__('Separator Color','newshub'),
                'description' => esc_html__('Set color for bottom separator on content top widget','newshub'),
                'parent' => $show_content_top_separator_container,
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'text',
            'name' => 'content_top_padding',
            'description' => esc_html__('Enter top padding for content area for templates in full width. If you set this value then it\'s important to set also Content top padding for mobile header value','newshub'),
            'default_value' => '',
            'label' => esc_html__('Content Top Padding for Template in Full Width','newshub'),
            'args' => array(
                'suffix' => 'px',
                'col_width' => 3
            ),
            'parent' => $panel_content
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'text',
            'name' => 'content_top_padding_in_grid',
            'description' => esc_html__('Enter top padding for content area for Templates in grid. If you set this value then it\'s important to set also Content top padding for mobile header value','newshub'),
            'default_value' => '',
            'label' => esc_html__('Content Top Padding for Templates in Grid','newshub'),
            'args' => array(
                'suffix' => 'px',
                'col_width' => 3
            ),
            'parent' => $panel_content
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'text',
            'name' => 'content_top_padding_mobile',
            'description' => esc_html__('Enter top padding for content area for Mobile Header','newshub'),
            'default_value' => '',
            'label' => esc_html__('Content Top Padding for Mobile Header','newshub'),
            'args' => array(
                'suffix' => 'px',
                'col_width' => 3
            ),
            'parent' => $panel_content
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_content,
                'name' => 'content_bottom_title',
                'title' => esc_html__('Content Bottom','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'content_bottom_widget',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Content Bottom Widget','newshub'),
                'description' => esc_html__('Enabling this option will show widgets on content bottom','newshub'),
                'parent' => $panel_content,
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_content_bottom_container'
                ),
            )
        );

        $show_content_bottom_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'show_content_bottom_container',
                'hidden_property' => 'content_bottom_widget',
                'hidden_value' => 'no',
                'parent' => $panel_content
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'content_bottom_in_grid',
                'default_value' => 'yes',
                'label' => esc_html__('Content Bottom in Grid','newshub'),
                'description' => esc_html__('Enabling this option will place content bottom in grid','newshub'),
                'parent' => $show_content_bottom_container,
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'text',
            'name' => 'content_bottom_padding',
            'description' => esc_html__('Enter padding bottom for content','newshub'),
            'default_value' => '',
            'label' => esc_html__('Content Bottom Padding','newshub'),
            'args' => array(
                'suffix' => 'px',
                'col_width' => 3
            ),
            'parent' => $panel_content
        ));


    }

    add_action('newshub_mikado_options_map', 'newshub_mikado_content_options_map', 8);

}