<?php

    $general_meta_box = newshub_mikado_add_meta_box(
        array(
            'scope' => array('page', 'post', 'forum', 'topic'),
            'title' => esc_html__('General','newshub'),
            'name' => 'general_meta'
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'type' => 'select',
            'name' => 'mkd_header_style_meta',
            'default_value' => '',
            'label' => esc_html__('Header Style','newshub'),
            'description' => esc_html__('Choose predefined Header style','newshub'),
            'options' => array(
                '' => '',
                'dark' => 'Dark',
                'light' => 'Light',
                'transparent' => 'Transparent'
            )
        )
    );

    $header_background_color_type1_container = newshub_mikado_add_admin_container(
        array(
            'parent'            => $general_meta_box,
            'name'              => 'mkd_header_background_color_type1_container_meta',
            'hidden_property'   => 'header_type',
            'hidden_values' => array('header-type2', 'header-type3', 'header-type4')
        )
    );

    $group_menu_area_background_color = newshub_mikado_add_admin_group(array(
        'title' => esc_html__('Menu Area Background color','newshub'),
        'name' => 'group_menu_area_background_color_meta',
        'parent' => $header_background_color_type1_container,
        'description' => esc_html__('Set background color for menu area','newshub'),
        'hidden_property'   => 'header_type',
        'hidden_values' => array('header-type2', 'header-type3', 'header-type4')
    ));

    $row1_menu_area_background_color_meta = newshub_mikado_add_admin_row(array(
        'name' => 'row1',
        'parent' => $group_menu_area_background_color
    ));

    newshub_mikado_add_meta_box_field(array(
        'name' => 'mkd_menu_area_background_color_header_type1_meta',
        'type' => 'colorsimple',
        'label' => esc_html__('Color','newshub'),
        'parent' => $row1_menu_area_background_color_meta
    ));

    newshub_mikado_add_meta_box_field(array(
        'name' => 'mkd_menu_area_background_color_tr_header_type1_meta',
        'type' => 'textsimple',
        'label' => esc_html__('Transparency (0-1)','newshub'),
        'parent' => $row1_menu_area_background_color_meta
    ));

    newshub_mikado_add_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'name' => 'mkd_logo_position_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => esc_html__('Logo position','newshub'),
            'description' => esc_html__('Choose a logo position','newshub'),
            'options' => array(
                '' => '',
                'center' => 'Center',
                'left' => 'Left'
            )
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_page_background_color_meta',
            'type' => 'color',
            'default_value' => '',
            'label' => esc_html__('Page Background Color','newshub'),
            'description' => esc_html__('Choose background color for page content','newshub'),
            'parent' => $general_meta_box
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'          => 'mkd_boxed_meta',
            'type'          => 'select',
            'default_value' => '',
            'label'         => esc_html__('Boxed Layout','newshub'),
            'parent'        => $general_meta_box,
            'options'     => array(
                '' => '',
                'yes' => 'Yes',
                'no' => 'No',
            ),
            'args'          => array(
                "dependence" => true,
                'show' => array(
                    '' => '',
                    'yes' => '#mkd_mkd_boxed_container_meta',
                    'no' => '',

                ),
                'hide' => array(
                    '' => '#mkd_mkd_boxed_container_meta',
                    'yes' => '',
                    'no' => '#mkd_mkd_boxed_container_meta',
                )
            )
        )
    );

        $boxed_container = newshub_mikado_add_admin_container(
            array(
                'parent'            => $general_meta_box,
                'name'              => 'mkd_boxed_container_meta',
                'hidden_property'   => 'mkd_boxed_meta',
                'hidden_values'      => array('','no')
            )
        );

            newshub_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkd_page_background_color_in_box_meta',
                    'type'          => 'color',
                    'label'         => esc_html__('Page Background Color','newshub'),
                    'description'   => esc_html__('Choose the page background color outside box.','newshub'),
                    'parent'        => $boxed_container
                )
            );

            newshub_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkd_boxed_background_image_meta',
                    'type'          => 'image',
                    'label'         => esc_html__('Background Image','newshub'),
                    'description'   => esc_html__('Choose an image to be displayed in background','newshub'),
                    'parent'        => $boxed_container
                )
            );

            newshub_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkd_boxed_pattern_background_image_meta',
                    'type'          => 'image',
                    'label'         => esc_html__('Background Pattern','newshub'),
                    'description'   => esc_html__('Choose an image to be used as background pattern','newshub'),
                    'parent'        => $boxed_container
                )
            );

            newshub_mikado_add_meta_box_field(
                array(
                    'name'          => 'mkd_boxed_background_image_attachment_meta',
                    'type'          => 'select',
                    'default_value' => 'fixed',
                    'label'         => esc_html__('Background Image Attachment','newshub'),
                    'description'   => esc_html__('Choose background image attachment','newshub'),
                    'parent'        => $boxed_container,
                    'options'       => array(
                        'fixed'     => 'Fixed',
                        'scroll'    => 'Scroll'
                    )
                )
            );

    newshub_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_page_slider_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => esc_html__('Slider Shortcode','newshub'),
            'description' => esc_html__('Paste your slider shortcode here','newshub'),
            'parent' => $general_meta_box
        )
    );

    $mkd_slider_group = newshub_mikado_add_admin_group(array(
        'name' => 'slider_group',
        'title' => esc_html__('Slider Style','newshub'),
        'description' => esc_html__('Define styles for Slider area','newshub'),
        'parent' => $general_meta_box
    ));

    $mkd_slider_row = newshub_mikado_add_admin_row(array(
        'name' => 'mkd_slider_row',
        'next' => true,
        'parent' => $mkd_slider_group
    ));

        newshub_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_page_slider_background_color',
                'type'          => 'colorsimple',
                'label'         => esc_html__('Slider Background Color','newshub'),
                'parent'        => $mkd_slider_row
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_page_slider_top_padding',
                'type'          => 'textsimple',
                'default_value' => '',
                'label'         => esc_html__('Slider Top Padding','newshub'),
                'parent'        => $mkd_slider_row,
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name'          => 'mkd_page_slider_bottom_padding',
                'type'          => 'textsimple',
                'default_value' => '',
                'label'         => esc_html__('Slider Bottom Padding','newshub'),
                'parent'        => $mkd_slider_row,
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_page_content_top_widget',
            'type'        => 'select',
            'label'       => esc_html__('Hide Content Top Widget','newshub'),
            'description' => esc_html__('Enabling this option will hide Content Top','newshub'),
            'parent'      => $general_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
            'hidden_property'   => 'content_top_widget',
            'hidden_values'      => array('no')
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_page_content_bottom_widget',
            'type'        => 'select',
            'label'       => esc_html__('Hide Content Bottom Widget','newshub'),
            'description' => esc_html__('Enabling this option will hide Content Bottom','newshub'),
            'parent'      => $general_meta_box,
            'options'     => array(
                'no' => 'No',
                'yes' => 'Yes',
            ),
            'hidden_property'   => 'content_bottom_widget',
            'hidden_values'      => array('no')
        )
    );

    $mkd_content_padding_group = newshub_mikado_add_admin_group(array(
        'name' => 'content_padding_group',
        'title' => esc_html__('Content Style','newshub'),
        'description' => esc_html__('Define styles for Content area','newshub'),
        'parent' => $general_meta_box
    ));
    
    $mkd_content_padding_row = newshub_mikado_add_admin_row(array(
        'name' => 'mkd_content_padding_row',
        'next' => true,
        'parent' => $mkd_content_padding_group
    ));

    newshub_mikado_add_meta_box_field(
        array(
            'name'          => 'mkd_page_content_top_padding',
            'type'          => 'textsimple',
            'default_value' => '',
            'label'         => esc_html__('Content Top Padding','newshub'),
            'parent'        => $mkd_content_padding_row,
            'args'          => array(
                'suffix' => 'px'
            )
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_page_content_top_padding_mobile',
            'type'        => 'selectblanksimple',
            'label'       => esc_html__('Set this top padding for mobile header','newshub'),
            'parent'      => $mkd_content_padding_row,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'          => 'mkd_page_content_bottom_padding',
            'type'          => 'textsimple',
            'default_value' => '',
            'label'         => esc_html__('Content Bottom Padding','newshub'),
            'parent'        => $mkd_content_padding_row,
            'args'          => array(
                'suffix' => 'px'
            )
        )
    );

    newshub_mikado_add_meta_box_field(
        array(
            'name'        => 'mkd_page_comments_meta',
            'type'        => 'selectblank',
            'label'       => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments on your page','newshub'),
            'parent'      => $general_meta_box,
            'options'     => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        )
    );

    if(newshub_mikado_options() -> getOptionValue('header_type') != 'header-vertical') {
        newshub_mikado_add_meta_box_field(
            array(
                'name'            => 'mkd_scroll_amount_for_sticky_meta',
                'type'            => 'text',
                'label'           => esc_html__('Scroll amount for sticky header appearance','newshub'),
                'description'     => esc_html__('Define scroll amount for sticky header appearance','newshub'),
                'parent'          => $general_meta_box,
                'args'            => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            )
        );
    }

    newshub_mikado_add_meta_box_field(
        array(
            'type' => 'yesno',
            'name' => 'mkd_uncovering_footer_effect_meta',
            'default_value' => 'no',
            'label' => esc_html__('Uncovering Footer','newshub'),
            'description' => esc_html__('Set footer to have uncovering behavior','newshub'),
            'parent'      => $general_meta_box,
        )
    );