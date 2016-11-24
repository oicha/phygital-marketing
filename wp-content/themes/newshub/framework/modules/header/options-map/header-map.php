<?php

if (!function_exists('newshub_mikado_header_options_map')) {

    function newshub_mikado_header_options_map() {

        newshub_mikado_add_admin_page(
            array(
                'slug' => '_header_page',
                'title' => esc_html__('Header','newshub'),
                'icon' => 'fa fa-header'
            )
        );

        /****** HEADER PANEL ******/

        $panel_header = newshub_mikado_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header',
                'title' => esc_html__('Header','newshub')
            )
        );


        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header,
                'type' => 'radiogroup',
                'name' => 'header_type',
                'default_value' => 'header-type1',
                'label' => esc_html__('Choose Header Type','newshub'),
                'description' => esc_html__('Select the type of header you would like to use','newshub'),
                'options' => array(
                    'header-type1' => array(
                        'image' => MIKADO_ASSETS_ROOT . '/img/header-type-1.png'
                    ),
                    'header-type2' => array(
                        'image' => MIKADO_ASSETS_ROOT . '/img/header-type-2.png'
                    ),
                    'header-type3' => array(
                        'image' => MIKADO_ASSETS_ROOT . '/img/header-type-3.png'
                    ),
                    'header-type4' => array(
                        'image' => MIKADO_ASSETS_ROOT . '/img/header-type-4.png'
                    ),
                ),
                'args' => array(
                    'use_images' => true,
                    'hide_labels' => true,
                    'dependence' => true,
                    'show' => array(
                        'header-type1' => '#mkd_panel_header_type1, #mkd_panel_header_top',
                        'header-type2' => '#mkd_panel_header_type2',
                        'header-type3' => '#mkd_panel_header_type3, #mkd_panel_header_top',
                        'header-type4' => '#mkd_panel_header_type4, #mkd_panel_sticky_header, #mkd_panel_header_top',
                    ),
                    'hide' => array(
                        'header-type1' => '#mkd_panel_header_type2,#mkd_panel_header_type3,#mkd_panel_header_type4, #mkd_panel_sticky_header',
                        'header-type2' => '#mkd_panel_header_type1,#mkd_panel_header_type3,#mkd_panel_header_type4, #mkd_panel_sticky_header, #mkd_panel_header_top',
                        'header-type3' => '#mkd_panel_header_type1,#mkd_panel_header_type2,#mkd_panel_header_type4, #mkd_panel_sticky_header',
                        'header-type4' => '#mkd_panel_header_type1,#mkd_panel_header_type2,#mkd_panel_header_type3',
                    )
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header,
                'type' => 'select',
                'name' => 'header_style',
                'default_value' => '',
                'label' => esc_html__('Header Style','newshub'),
                'description' => esc_html__('Choose predefined Header style','newshub'),
                'options' => array(
                    '' => '',
                    'dark' => esc_html__('Dark', 'newshub'),
                    'light' => esc_html__('Light', 'newshub'),
                    'transparent' => esc_html__('Transparent', 'newshub'),
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header,
                'type' => 'select',
                'name' => 'header_behaviour',
                'default_value' => 'default',
                'label' => esc_html__('Choose Header behaviour','newshub'),
                'description' => esc_html__('Select the behaviour of header when you scroll down to page','newshub'),
                'options' => array(
                    'default' => esc_html__('Default', 'newshub'),
                    'sticky-header-on-scroll-up' => esc_html__('Sticky on scroll up', 'newshub'),
                    'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scroll up/down', 'newshub'),
                    'fixed-on-scroll' => esc_html__('Fixed on scroll', 'newshub'),
                ),
                'args' => array(
                    'dependence' => true,
                    'show' => array(
                        'default' => '',
                        'sticky-header-on-scroll-up' => '#mkd_panel_sticky_header',
                        'sticky-header-on-scroll-down-up' => '#mkd_panel_sticky_header',
                        'fixed-on-scroll' => ''
                    ),
                    'hide' => array(
                        'default' => '#mkd_panel_sticky_header',
                        'sticky-header-on-scroll-up' => '',
                        'sticky-header-on-scroll-down-up' => '',
                        'fixed-on-scroll' => '#mkd_panel_sticky_header',
                    )
                )
            )
        );

        /****** HEADER TOP ******/

        $panel_header_top = newshub_mikado_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_top',
                'title' => esc_html__('Header Top Bar','newshub'),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-type2'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'top_bar',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Top Bar','newshub'),
                'description' => esc_html__('Enabling this option will show top bar area','newshub'),
                'parent' => $panel_header_top,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_top_bar_container"
                )
            )
        );

        $top_bar_container = newshub_mikado_add_admin_container(array(
            'name' => 'top_bar_container',
            'parent' => $panel_header_top,
            'hidden_property' => 'top_bar',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(
            array(
                'parent' => $top_bar_container,
                'type' => 'select',
                'name' => 'top_bar_layout',
                'default_value' => 'two-columns',
                'label' => esc_html__('Choose top bar layout','newshub'),
                'description' => esc_html__('Select the layout for top bar','newshub'),
                'options' => array(
                    'two-columns' => esc_html__('Two columns', 'newshub'),
                    'three-columns' => esc_html__('Three columns', 'newshub'),
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "two-columns" => "#mkd_top_bar_layout_container",
                        "three-columns" => ""
                    ),
                    "show" => array(
                        "two-columns" => "",
                        "three-columns" => "#mkd_top_bar_layout_container"
                    )
                )
            )
        );

        $top_bar_layout_container = newshub_mikado_add_admin_container(array(
            'name' => 'top_bar_layout_container',
            'parent' => $top_bar_container,
            'hidden_property' => 'top_bar_layout',
            'hidden_value' => '',
            'hidden_values' => array("two-columns"),
        ));

        newshub_mikado_add_admin_field(
            array(
                'parent' => $top_bar_layout_container,
                'type' => 'select',
                'name' => 'top_bar_column_widths',
                'default_value' => '33-33-33',
                'label' => esc_html__('Choose column widths','newshub'),
                'options' => array(
                    '33-33-33' => '33% - 33% - 33%',
                    '25-50-25' => '25% - 50% - 25%'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'top_bar_in_grid',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Top Bar in grid','newshub'),
                'description' => esc_html__('Set top bar content to be in grid','newshub'),
                'parent' => $top_bar_container,
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'top_bar_color',
            'type' => 'color',
            'label' => esc_html__('Color','newshub'),
            'description' => esc_html__('Set text color for top bar','newshub'),
            'parent' => $top_bar_container
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'top_bar_background_color',
            'type' => 'color',
            'label' => esc_html__('Background Color','newshub'),
            'description' => esc_html__('Set background color for top bar','newshub'),
            'parent' => $top_bar_container
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'top_bar_bottom_border',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Bottom Border','newshub'),
                'description' => esc_html__('Set top bar bottom border','newshub'),
                'parent' => $top_bar_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_top_bar_border_container"
                )
            )
        );

        $top_bar_border_container = newshub_mikado_add_admin_container(array(
            'name' => 'top_bar_border_container',
            'parent' => $top_bar_container,
            'hidden_property' => 'top_bar_bottom_border',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'top_bar_bottom_border_color',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set bottom border color for top bar, deafult is #e4e4e4','newshub'),
            'parent' => $top_bar_border_container
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'hide_top_bar_on_mobile',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Hide Top Bar on Mobile Devices','newshub'),
                'description' => esc_html__('Enabling this option you will hide top header area on mobile devices','newshub'),
                'parent' => $top_bar_container
            )
        );

        /****** HEADER TYPE 1 ******/

        $panel_header_type1 = newshub_mikado_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_type1',
                'title' => esc_html__('Header Type 1','newshub'),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-type2',
                    'header-type3',
                    'header-type4',
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type1,
                'name' => 'widget_area_title_header_type1',
                'title' => esc_html__('Widget Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type1,
                'type' => 'yesno',
                'name' => 'widget_area_header_type1',
                'default_value' => 'no',
                'label' => esc_html__('Widget Area','newshub'),
                'description' => esc_html__('Enabling this option will show widget area','newshub'),
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_widget_area_header_type1_container"
                )
            )
        );

        $widget_area_header_type1_container = newshub_mikado_add_admin_container(array(
            'name' => 'widget_area_header_type1_container',
            'parent' => $panel_header_type1,
            'hidden_property' => 'widget_area_header_type1',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_area_header_type1_container,
                'type' => 'yesno',
                'name' => 'widget_area_in_grid_header_type1',
                'default_value' => 'yes',
                'label' => esc_html__('Widget Area in grid','newshub'),
                'description' => esc_html__('Set header content to be in grid','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_area_header_type1_container,
                'type' => 'color',
                'name' => 'widget_area_color_header_type1',
                'default_value' => '',
                'label' => esc_html__('Text color','newshub'),
                'description' => esc_html__('Set text color for header','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_area_header_type1_container,
                'type' => 'color',
                'name' => 'widget_area_background_color_header_type1',
                'default_value' => '',
                'label' => esc_html__('Background color','newshub'),
                'description' => esc_html__('Set background color for header','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_area_header_type1_container,
                'type' => 'text',
                'name' => 'widget_area_height_header_type1',
                'default_value' => '',
                'label' => esc_html__('Height','newshub'),
                'description' => esc_html__('Enter header height (default is 128px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_area_header_type1_container,
                'type' => 'text',
                'name' => 'widget_area_height_mac_header_type1',
                'default_value' => '',
                'label' => esc_html__('Height (on devices between 1025px - 1280px)','newshub'),
                'description' => esc_html__('Enter header height (default is 128px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type1,
                'name' => 'menu_area_title',
                'title' => esc_html__('Menu Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type1,
                'type' => 'yesno',
                'name' => 'menu_area_in_grid_header_type1',
                'default_value' => 'yes',
                'label' => esc_html__('Menu area in grid','newshub'),
                'description' => esc_html__('Set menu area content to be in grid','newshub'),
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_menu_area_in_grid_header_standard_container'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type1,
                'type' => 'color',
                'name' => 'menu_area_color_header_type1',
                'default_value' => '',
                'label' => esc_html__('Text color','newshub'),
                'description' => esc_html__('Set text color for header','newshub')
            )
        );

        $group_menu_area_background_color = newshub_mikado_add_admin_group(array(
            'title' => esc_html__('Background color','newshub'),
            'name' => 'group_menu_area_background_color',
            'parent' => $panel_header_type1,
            'description' => esc_html__('Set background color for header','newshub'),
        ));

        $row1_menu_area_background_color = newshub_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_menu_area_background_color
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_background_color_header_type1',
            'type' => 'colorsimple',
            'label' => esc_html__('Color','newshub'),
            'parent' => $row1_menu_area_background_color
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_background_color_tr_header_type1',
            'type' => 'textsimple',
            'label' => esc_html__('Transparency (0-1)','newshub'),
            'parent' => $row1_menu_area_background_color
        ));

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type1,
                'type' => 'text',
                'name' => 'menu_area_height_header_type1',
                'default_value' => '',
                'label' => esc_html__('Height','newshub'),
                'description' => esc_html__('Enter header height (default is 60px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        /****** HEADER TYPE 2 ******/

        $panel_header_type2 = newshub_mikado_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_type2',
                'title' => esc_html__('Header Type 2','newshub'),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-type1',
                    'header-type3',
                    'header-type4',
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type2,
                'name' => 'menu_area_title_header_type2',
                'title' => esc_html__('Menu Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type2,
                'type' => 'yesno',
                'name' => 'menu_area_in_grid_header_type2',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area in grid','newshub'),
                'description' => esc_html__('Set Menu area content to be in grid','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type2,
                'type' => 'text',
                'name' => 'menu_area_height_header_type2',
                'default_value' => '',
                'label' => esc_html__('Menu Area Height','newshub'),
                'description' => esc_html__('Enter menu area height (default is 60px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_color_header_type2',
            'type' => 'color',
            'label' => esc_html__('Menu Area Text Color','newshub'),
            'description' => esc_html__('Set background color for menu area','newshub'),
            'parent' => $panel_header_type2
        ));
        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_background_color_header_type2',
            'type' => 'color',
            'label' => esc_html__('Menu Area Background Color','newshub'),
            'description' => esc_html__('Set background color for menu area','newshub'),
            'parent' => $panel_header_type2
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'menu_area_border_header_type2',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area bottom border','newshub'),
                'description' => esc_html__('Set bottom border on menu area','newshub'),
                'parent' => $panel_header_type2,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_menu_area_border_header_type2_container"
                )
            )
        );

        $menu_area_border_header_type2_container = newshub_mikado_add_admin_container(array(
            'name' => 'menu_area_border_header_type2_container',
            'parent' => $panel_header_type2,
            'hidden_property' => 'menu_area_border_header_type2',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_border_color_header_type2',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set border color for menu area, deafult is #e4e4e4','newshub'),
            'parent' => $menu_area_border_header_type2_container
        ));


        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type2,
                'name' => 'logo_area_title_header_type2',
                'title' => esc_html__('Logo Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type2,
                'type' => 'yesno',
                'name' => 'logo_area_in_grid_header_type2',
                'default_value' => 'yes',
                'label' => esc_html__('Logo Area in grid','newshub'),
                'description' => esc_html__('Set logo area content to be in grid','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type2,
                'type' => 'text',
                'name' => 'logo_area_height_header_type2',
                'default_value' => '',
                'label' => esc_html__('Logo Area Height','newshub'),
                'description' => esc_html__('Enter logo area height (default is 127px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'logo_area_color_header_type2',
            'type' => 'color',
            'label' => esc_html__('Logo Area Text Color','newshub'),
            'description' => esc_html__('Set text color for logo area','newshub'),
            'parent' => $panel_header_type2
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'logo_area_background_color_header_type2',
            'type' => 'color',
            'label' => esc_html__('Logo Area Background Color','newshub'),
            'description' => esc_html__('Set background color for logo area','newshub'),
            'parent' => $panel_header_type2
        ));


        /****** HEADER TYPE 3 ******/

        $panel_header_type3 = newshub_mikado_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_type3',
                'title' => esc_html__('Header Type 3','newshub'),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-type1',
                    'header-type2',
                    'header-type4',
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type3,
                'name' => 'logo_area_title_header_type3',
                'title' => esc_html__('Logo Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type3,
                'type' => 'yesno',
                'name' => 'logo_area_in_grid_header_type3',
                'default_value' => 'yes',
                'label' => esc_html__('Logo Area in grid','newshub'),
                'description' => esc_html__('Set logo area content to be in grid','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type3,
                'type' => 'text',
                'name' => 'logo_area_height_header_type3',
                'default_value' => '',
                'label' => esc_html__('Logo Area Height','newshub'),
                'description' => esc_html__('Enter logo area height (default is 127px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'logo_area_color_header_type3',
            'type' => 'color',
            'label' => esc_html__('Logo Area Text Color','newshub'),
            'description' => esc_html__('Set text color for logo area','newshub'),
            'parent' => $panel_header_type3
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'logo_area_background_color_header_type3',
            'type' => 'color',
            'label' => esc_html__('Logo Area Background Color','newshub'),
            'description' => esc_html__('Set background color for logo area','newshub'),
            'parent' => $panel_header_type3
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type3,
                'name' => 'menu_area_title_header_type3',
                'title' => esc_html__('Menu Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type3,
                'type' => 'yesno',
                'name' => 'menu_area_in_grid_header_type3',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area in grid','newshub'),
                'description' => esc_html__('Set Menu area content to be in grid','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type3,
                'type' => 'text',
                'name' => 'menu_area_height_header_type3',
                'default_value' => '',
                'label' => esc_html__('Menu Area Height','newshub'),
                'description' => esc_html__('Enter menu area height (default is 60px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_color_header_type3',
            'type' => 'color',
            'label' => esc_html__('Menu Area Text Color','newshub'),
            'description' => esc_html__('Set text color for menu area','newshub'),
            'parent' => $panel_header_type3
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_background_color_header_type3',
            'type' => 'color',
            'label' => esc_html__('Menu Area Background Color','newshub'),
            'description' => esc_html__('Set background color for menu area','newshub'),
            'parent' => $panel_header_type3
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'menu_area_border_header_type3',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area top/bottom border','newshub'),
                'description' => esc_html__('Set top/bottom border on menu area','newshub'),
                'parent' => $panel_header_type3,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_menu_area_border_header_type3_container"
                )
            )
        );

        $menu_area_border_header_type3_container = newshub_mikado_add_admin_container(array(
            'name' => 'menu_area_border_header_type3_container',
            'parent' => $panel_header_type3,
            'hidden_property' => 'menu_area_border_header_type3',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_border_color_header_type3',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set top/bottom border color for menu area, deafult is #e4e4e4','newshub'),
            'parent' => $menu_area_border_header_type3_container
        ));

        newshub_mikado_add_admin_field(
            array(
                'parent' => $menu_area_border_header_type3_container,
                'type' => 'yesno',
                'name' => 'menu_area_border_top_header_type3',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area top border','newshub'),
                'description' => esc_html__('Set top border on menu area','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $menu_area_border_header_type3_container,
                'type' => 'yesno',
                'name' => 'menu_area_border_bottom_header_type3',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area bottom border','newshub'),
                'description' => esc_html__('Set bottom border on menu area','newshub'),
                'args' => array()
            )
        );

        /****** HEADER TYPE 4 ******/

        $panel_header_type4 = newshub_mikado_add_admin_panel(
            array(
                'page' => '_header_page',
                'name' => 'panel_header_type4',
                'title' => esc_html__('Header Type 4','newshub'),
                'hidden_property' => 'header_type',
                'hidden_value' => '',
                'hidden_values' => array(
                    'header-type1',
                    'header-type2',
                    'header-type3',
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type4,
                'name' => 'logo_area_title_header_type4',
                'title' => esc_html__('Logo Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type4,
                'type' => 'yesno',
                'name' => 'logo_area_in_grid_header_type4',
                'default_value' => 'yes',
                'label' => esc_html__('Logo Area in grid','newshub'),
                'description' => esc_html__('Set logo area content to be in grid','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type4,
                'type' => 'text',
                'name' => 'logo_area_height_header_type4',
                'default_value' => '',
                'label' => esc_html__('Logo Area Height','newshub'),
                'description' => esc_html__('Enter logo area height (default is 127px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'logo_area_color_header_type4',
            'type' => 'color',
            'label' => esc_html__('Logo Area Text Color','newshub'),
            'description' => esc_html__('Set text color for logo area','newshub'),
            'parent' => $panel_header_type4
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'logo_area_background_color_header_type4',
            'type' => 'color',
            'label' => esc_html__('Logo Area Background Color','newshub'),
            'description' => esc_html__('Set background color for logo area','newshub'),
            'parent' => $panel_header_type4
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_header_type4,
                'name' => 'menu_area_title_header_type4',
                'title' => esc_html__('Menu Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type4,
                'type' => 'yesno',
                'name' => 'menu_area_in_grid_header_type4',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area in grid','newshub'),
                'description' => esc_html__('Set Menu area content to be in grid','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_header_type4,
                'type' => 'text',
                'name' => 'menu_area_height_header_type4',
                'default_value' => '',
                'label' => esc_html__('Menu Area Height','newshub'),
                'description' => esc_html__('Enter menu area height (default is 60px)','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_color_header_type4',
            'type' => 'color',
            'label' => esc_html__('Menu Area Text Color','newshub'),
            'description' => esc_html__('Set text color for menu area','newshub'),
            'parent' => $panel_header_type4
        ));


        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_background_color_header_type4',
            'type' => 'color',
            'label' => esc_html__('Menu Area Background Color','newshub'),
            'description' => esc_html__('Set background color for menu area','newshub'),
            'parent' => $panel_header_type4
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'menu_area_border_header_type4',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area top/bottom border','newshub'),
                'description' => esc_html__('Set top/bottom border on menu area','newshub'),
                'parent' => $panel_header_type4,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_menu_area_border_header_type4_container"
                )
            )
        );

        $menu_area_border_header_type4_container = newshub_mikado_add_admin_container(array(
            'name' => 'menu_area_border_header_type4_container',
            'parent' => $panel_header_type4,
            'hidden_property' => 'menu_area_border_header_type4',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'menu_area_border_color_header_type4',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set top/bottom border color for menu area, deafult is #e4e4e4','newshub'),
            'parent' => $menu_area_border_header_type4_container
        ));

        newshub_mikado_add_admin_field(
            array(
                'parent' => $menu_area_border_header_type4_container,
                'type' => 'yesno',
                'name' => 'menu_area_border_top_header_type4',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area top border','newshub'),
                'description' => esc_html__('Set top border on menu area','newshub'),
                'args' => array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $menu_area_border_header_type4_container,
                'type' => 'yesno',
                'name' => 'menu_area_border_bottom_header_type4',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area bottom border','newshub'),
                'description' => esc_html__('Set bottom border on menu area','newshub'),
                'args' => array()
            )
        );


        /****** STICKY HEADER PANEL ******/

        $panel_sticky_header = newshub_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Sticky Header','newshub'),
                'name' => 'panel_sticky_header',
                'page' => '_header_page',
                'hidden_property' => 'header_behaviour',
                'hidden_values' => array(
                    'default',
                    'fixed-on-scroll'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'scroll_amount_for_sticky',
                'type' => 'text',
                'label' => esc_html__('Scroll Amount for Sticky','newshub'),
                'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height)','newshub'),
                'parent' => $panel_sticky_header,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_sticky_header,
                'type' => 'yesno',
                'name' => 'sticky_header_in_grid',
                'default_value' => 'yes',
                'label' => esc_html__('Sticky Header in grid','newshub'),
                'description' => esc_html__('Set sticky header content to be in grid','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'sticky_header_background_color',
            'type' => 'color',
            'label' => esc_html__('Background Color','newshub'),
            'description' => esc_html__('Set background color for sticky header','newshub'),
            'parent' => $panel_sticky_header
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'sticky_header_transparency',
            'type' => 'text',
            'label' => esc_html__('Sticky Header Transparency','newshub'),
            'description' => esc_html__('Enter transparency for sticky header (value from 0 to 1)','newshub'),
            'parent' => $panel_sticky_header,
            'args' => array(
                'col_width' => 1
            )
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'sticky_header_height',
            'type' => 'text',
            'label' => esc_html__('Sticky Header Height','newshub'),
            'description' => esc_html__('Enter height for sticky header (default is 47px)','newshub'),
            'parent' => $panel_sticky_header,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'sticky_border_bottom',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Sticky bottom border','newshub'),
                'description' => esc_html__('Set bottom border on sticky header','newshub'),
                'parent' => $panel_sticky_header,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_sticky_border_bottom_container"
                )
            )
        );

        $sticky_border_bottom_container = newshub_mikado_add_admin_container(array(
            'name' => 'sticky_border_bottom_container',
            'parent' => $panel_sticky_header,
            'hidden_property' => 'sticky_border_bottom',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'sticky_border_bottom_color',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set border color for menu area, deafult is #e4e4e4','newshub'),
            'parent' => $sticky_border_bottom_container
        ));

        $group_sticky_header_menu = newshub_mikado_add_admin_group(array(
            'title' => esc_html__('Sticky Header Menu','newshub'),
            'name' => 'group_sticky_header_menu',
            'parent' => $panel_sticky_header,
            'description' => esc_html__('Define styles for sticky menu items','newshub'),
        ));

        $row1_sticky_header_menu = newshub_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_sticky_header_menu
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'sticky_color',
            'type' => 'colorsimple',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row1_sticky_header_menu
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'sticky_hovercolor',
            'type' => 'colorsimple',
            'label' => esc_html__('Hover/Active color','newshub'),
            'parent' => $row1_sticky_header_menu
        ));

        $row2_sticky_header_menu = newshub_mikado_add_admin_row(array(
            'name' => 'row2',
            'parent' => $group_sticky_header_menu
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'sticky_google_fonts',
                'type' => 'fontsimple',
                'label' => esc_html__('Font Family','newshub'),
                'default_value' => '-1',
                'parent' => $row2_sticky_header_menu,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'sticky_fontsize',
                'label' => esc_html__('Font Size','newshub'),
                'default_value' => '',
                'parent' => $row2_sticky_header_menu,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'sticky_lineheight',
                'label' => esc_html__('Line height','newshub'),
                'default_value' => '',
                'parent' => $row2_sticky_header_menu,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'selectblanksimple',
                'name' => 'sticky_texttransform',
                'label' => esc_html__('Text transform','newshub'),
                'default_value' => '',
                'options' => newshub_mikado_get_text_transform_array(),
                'parent' => $row2_sticky_header_menu
            )
        );

        $row3_sticky_header_menu = newshub_mikado_add_admin_row(array(
            'name' => 'row3',
            'parent' => $group_sticky_header_menu
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'selectblanksimple',
                'name' => 'sticky_fontstyle',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array(),
                'parent' => $row3_sticky_header_menu
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'selectblanksimple',
                'name' => 'sticky_fontweight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array(),
                'parent' => $row3_sticky_header_menu
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'sticky_letterspacing',
                'label' => esc_html__('Letter Spacing','newshub'),
                'default_value' => '',
                'parent' => $row3_sticky_header_menu,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        /****** MAIN MENU PANEL ******/

        $panel_main_menu = newshub_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Main Menu','newshub'),
                'name' => 'panel_main_menu',
                'page' => '_header_page'
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_main_menu,
                'name' => 'main_menu_area_title',
                'title' => esc_html__('Main Menu General Settings','newshub')
            )
        );

        $first_level_group = newshub_mikado_add_admin_group(
            array(
                'parent' => $panel_main_menu,
                'name' => 'first_level_group',
                'title' => esc_html__('1st Level Menu','newshub'),
                'description' => esc_html__('Define styles for 1st level in Top Navigation Menu','newshub')
            )
        );

        $first_level_row1 = newshub_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name' => 'first_level_row1'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row1,
                'type' => 'colorsimple',
                'name' => 'menu_color',
                'default_value' => '',
                'label' => esc_html__('Text Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row1,
                'type' => 'colorsimple',
                'name' => 'menu_hovercolor',
                'default_value' => '',
                'label' => esc_html__('Hover Text Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row1,
                'type' => 'colorsimple',
                'name' => 'menu_activecolor',
                'default_value' => '',
                'label' => esc_html__('Active Text Color','newshub'),
            )
        );

        $first_level_row2 = newshub_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name' => 'first_level_row2'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row2,
                'type' => 'colorsimple',
                'name' => 'menu_item_background_color',
                'default_value' => '',
                'label' => esc_html__('Background Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row2,
                'type' => 'colorsimple',
                'name' => 'menu_item_hover_background_color',
                'default_value' => '',
                'label' => esc_html__('Hover Background Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row2,
                'type' => 'colorsimple',
                'name' => 'menu_item_border_color',
                'default_value' => '',
                'label' => esc_html__('Border Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row2,
                'type' => 'colorsimple',
                'name' => 'menu_item_hover_border_color',
                'default_value' => '',
                'label' => esc_html__('Hover Border Color','newshub'),
            )
        );


        $first_level_row5 = newshub_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name' => 'first_level_row5',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row5,
                'type' => 'fontsimple',
                'name' => 'menu_google_fonts',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row5,
                'type' => 'textsimple',
                'name' => 'menu_fontsize',
                'default_value' => '',
                'label' => esc_html__('Font Size','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row5,
                'type' => 'textsimple',
                'name' => 'menu_lineheight',
                'default_value' => '',
                'label' => esc_html__('Line Height','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row5,
                'type' => 'selectblanksimple',
                'name' => 'menu_fontweight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array()
            )
        );

        $first_level_row6 = newshub_mikado_add_admin_row(
            array(
                'parent' => $first_level_group,
                'name' => 'first_level_row6',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row6,
                'type' => 'selectblanksimple',
                'name' => 'menu_fontstyle',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row6,
                'type' => 'textsimple',
                'name' => 'menu_letterspacing',
                'default_value' => '',
                'label' => esc_html__('Letter Spacing','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $first_level_row6,
                'type' => 'selectblanksimple',
                'name' => 'menu_texttransform',
                'default_value' => '',
                'label' => esc_html__('Text Transform','newshub'),
                'options' => newshub_mikado_get_text_transform_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_main_menu,
                'type' => 'yesno',
                'name' => 'menu_area_item_arrow',
                'default_value' => 'yes',
                'label' => esc_html__('Menu Area Item Arrow','newshub'),
                'description' => esc_html__('Set item arrow on menu area items','newshub')
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_main_menu,
                'name' => 'main_menu_area_dropdown_title',
                'title' => esc_html__('Dropdown Settings','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_main_menu,
                'type' => 'color',
                'name' => 'dropdown_background_color',
                'default_value' => '',
                'label' => esc_html__('Background Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $panel_main_menu,
                'type' => 'color',
                'name' => 'dropdown_border_color',
                'default_value' => '',
                'label' => esc_html__('Border Color','newshub'),
            )
        );

        $group_menu_dropdown = newshub_mikado_add_admin_group(array(
            'title' => esc_html__('Item Style','newshub'),
            'name' => 'group_menu_dropdown',
            'parent' => $panel_main_menu,
            'description' => esc_html__('Define styles for menu item dropdown','newshub'),
        ));

        $row1_menu_dropdown = newshub_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_menu_dropdown
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'dropdown_text_color',
            'type' => 'colorsimple',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row1_menu_dropdown
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'dropdown_text_hover_color',
            'type' => 'colorsimple',
            'label' => esc_html__('Text Hover Color','newshub'),
            'parent' => $row1_menu_dropdown
        ));

        $row2_menu_dropdown = newshub_mikado_add_admin_row(
            array(
                'parent' => $group_menu_dropdown,
                'name' => 'row2_menu_dropdown',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_menu_dropdown,
                'type' => 'fontsimple',
                'name' => 'dropdown_google_fonts',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_menu_dropdown,
                'type' => 'textsimple',
                'name' => 'dropdown_fontsize',
                'default_value' => '',
                'label' => esc_html__('Font Size','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_menu_dropdown,
                'type' => 'textsimple',
                'name' => 'dropdown_lineheight',
                'default_value' => '',
                'label' => esc_html__('Line Height','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_menu_dropdown,
                'type' => 'selectblanksimple',
                'name' => 'dropdown_fontweight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array()
            )
        );

        $row3_menu_dropdown = newshub_mikado_add_admin_row(
            array(
                'parent' => $group_menu_dropdown,
                'name' => 'row3_menu_dropdown',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row3_menu_dropdown,
                'type' => 'selectblanksimple',
                'name' => 'dropdown_fontstyle',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row3_menu_dropdown,
                'type' => 'textsimple',
                'name' => 'dropdown_letterspacing',
                'default_value' => '',
                'label' => esc_html__('Letter Spacing','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row3_menu_dropdown,
                'type' => 'selectblanksimple',
                'name' => 'dropdown_texttransform',
                'default_value' => '',
                'label' => esc_html__('Text Transform','newshub'),
                'options' => newshub_mikado_get_text_transform_array()
            )
        );

        do_action('newshub_mikado_after_header_options_map');


    }

    add_action('newshub_mikado_options_map', 'newshub_mikado_header_options_map', 3);
}