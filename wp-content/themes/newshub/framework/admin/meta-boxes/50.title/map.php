<?php

$title_meta_box = newshub_mikado_add_meta_box(
    array(
        'scope' => array('page', 'post', 'forum', 'topic'),
        'title' => esc_html__('Title','newshub'),
        'name' => 'title_meta'
    )
);

    newshub_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_show_title_area_meta',
            'type' => 'select',
            'default_value' => '',
            'label' => esc_html__('Show Title Area','newshub'),
            'description' => esc_html__('Disabling this option will turn off page title area','newshub'),
            'parent' => $title_meta_box,
            'options' => array(
                '' => '',
                'no' => 'No',
                'yes' => 'Yes'
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "",
                    "no" => "#mkd_mkd_show_title_area_meta_container",
                    "yes" => ""
                ),
                "show" => array(
                    "" => "#mkd_mkd_show_title_area_meta_container",
                    "no" => "",
                    "yes" => "#mkd_mkd_show_title_area_meta_container"
                )
            )
        )
    );

    $show_title_area_meta_container = newshub_mikado_add_admin_container(
        array(
            'parent' => $title_meta_box,
            'name' => 'mkd_show_title_area_meta_container',
            'hidden_property' => 'mkd_show_title_area_meta',
            'hidden_value' => 'no'
        )
    );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Area Type','newshub'),
                'description' => esc_html__('Choose title type','newshub'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'standard' => 'Standard',
                    'breadcrumb' => 'Breadcrumb'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "standard" => "",
                        "breadcrumb" => "#mkd_mkd_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_type_meta_container",
                        "standard" => "#mkd_mkd_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = newshub_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_title_area_type_meta_container',
                'hidden_property' => 'mkd_title_area_type_meta',
                'hidden_value' => '',
                'hidden_values' => array('breadcrumb'),
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_enable_breadcrumbs_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Breadcrumbs','newshub'),
                'description' => esc_html__('This option will display Breadcrumbs in Title Area','newshub'),
                'parent' => $title_area_type_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Content Alignment','newshub'),
                'description' => esc_html__('Specify title content alignment','newshub'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => '',
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
                )
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Color','newshub'),
                'description' => esc_html__('Choose a color for title text','newshub'),
                'parent' => $show_title_area_meta_container
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_breadcrumb_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Breadcrumbs Color','newshub'),
                'description' => esc_html__('Choose a color for breadcrumb text','newshub'),
                'parent' => $show_title_area_meta_container
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_info_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Info Color','newshub'),
                'description' => esc_html__('Choose a color for title info text (only for posts)','newshub'),
                'parent' => $show_title_area_meta_container
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Background Color','newshub'),
                'description' => esc_html__('Choose a background color for Title Area','newshub'),
                'parent' => $show_title_area_meta_container
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Hide Background Image','newshub'),
                'description' => esc_html__('Enable this option to hide background image in Title Area','newshub'),
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkd_mkd_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = newshub_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'mkd_hide_background_image_meta_container',
                'hidden_property' => 'mkd_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_meta',
                'type' => 'image',
                'label' => esc_html__('Background Image','newshub'),
                'description' => esc_html__('Choose an Image for Title Area','newshub'),
                'parent' => $hide_background_image_meta_container
            )
        );

        newshub_mikado_add_meta_box_field(
            array(
                'name' => 'mkd_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Responsive Image','newshub'),
                'description' => esc_html__('Enabling this option will make Title background image responsive','newshub'),
                'parent' => $hide_background_image_meta_container,
                'options' => array(
                    '' => '',
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#mkd_mkd_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#mkd_mkd_title_area_height_meta",
                        "no" => "#mkd_mkd_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        newshub_mikado_add_meta_box_field(array(
            'name' => 'mkd_title_area_height_meta',
            'type' => 'text',
            'label' => esc_html__('Height','newshub'),
            'description' => esc_html__('Set a height for Title Area','newshub'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

    newshub_mikado_add_meta_box_field(
        array(
            'name' => 'mkd_title_area_border_color_meta',
            'type' => 'color',
            'label' => esc_html__('Bottom Border Color','newshub'),
            'description' => esc_html__('Choose a bottom border color for Title Area','newshub'),
            'parent' => $show_title_area_meta_container
        )
    );