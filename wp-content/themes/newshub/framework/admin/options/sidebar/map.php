<?php

if (!function_exists('newshub_mikado_sidebar_options_map')) {

    function newshub_mikado_sidebar_options_map() {

        $panel_widgets = newshub_mikado_add_admin_panel(
            array(
                'page' => '_page_page',
                'name' => 'panel_widgets',
                'title' => esc_html__('Widgets','newshub')
            )
        );

        /**
         * Navigation style
         */
        newshub_mikado_add_admin_field(array(
            'type' => 'color',
            'name' => 'sidebar_background_color',
            'default_value' => '',
            'label' => esc_html__('Sidebar Background Color','newshub'),
            'description' => esc_html__('Choose background color for sidebar','newshub'),
            'parent' => $panel_widgets
        ));

        $group_sidebar_padding = newshub_mikado_add_admin_group(array(
            'name' => 'group_sidebar_padding',
            'title' => esc_html__('Padding','newshub'),
            'parent' => $panel_widgets
        ));

        $row_sidebar_padding = newshub_mikado_add_admin_row(array(
            'name' => 'row_sidebar_padding',
            'parent' => $group_sidebar_padding
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'sidebar_padding_top',
            'default_value' => '',
            'label' => esc_html__('Top Padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_sidebar_padding
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'sidebar_padding_right',
            'default_value' => '',
            'label' => esc_html__('Right Padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_sidebar_padding
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'sidebar_padding_bottom',
            'default_value' => '',
            'label' => esc_html__('Bottom Padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_sidebar_padding
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'sidebar_padding_left',
            'default_value' => '',
            'label' => esc_html__('Left Padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_sidebar_padding
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'select',
            'name' => 'sidebar_alignment',
            'default_value' => '',
            'label' => esc_html__('Text Alignment','newshub'),
            'description' => esc_html__('Choose text aligment','newshub'),
            'options' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
            'parent' => $panel_widgets
        ));


        ////////////////////////////////////////////////////////////////////////////////////////

        $group_layout_widget = newshub_mikado_add_admin_group(array(
            'name' => 'group_layout_widget',
            'title' => esc_html__('Layout Widget','newshub'),
            'description' => esc_html__('Define styles for layout widget in header and sidearea','newshub'),
            'parent' => $panel_widgets
        ));

        $row_layout_widget_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_layout_widget_1',
            'parent' => $group_layout_widget
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'widget_layout_title_color',
            'default_value' => '',
            'label' => esc_html__('Title Color','newshub'),
            'parent' => $row_layout_widget_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'widget_layout_light_title_color',
            'default_value' => '',
            'label' => esc_html__('Light Title Color','newshub'),
            'parent' => $row_layout_widget_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'widget_layout_dark_title_color',
            'default_value' => '',
            'label' => esc_html__('Dark Title Color','newshub'),
            'parent' => $row_layout_widget_1
        ));

        ////////////////////////////////////////////////////////////////////////////////////////


    }

    add_action('newshub_mikado_after_page_options_map', 'newshub_mikado_sidebar_options_map');
}