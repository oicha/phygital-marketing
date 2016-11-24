<?php

if ( ! function_exists('newshub_mikado_title_options_map') ) {

	function newshub_mikado_title_options_map() {

		newshub_mikado_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__('Title','newshub'),
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = newshub_mikado_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__('Title Settings','newshub')
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__('Show Title Area','newshub'),
				'description' => esc_html__('This option will enable/disable Title Area','newshub'),
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_show_title_area_container"
				)
			)
		);

		$show_title_area_container = newshub_mikado_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

        newshub_mikado_add_admin_field(
            array(
                'name' => 'title_area_type',
                'type' => 'select',
                'default_value' => 'standard',
                'label' => esc_html__('Title Area Type','newshub'),
                'description' => esc_html__('Choose title type','newshub'),
                'parent' => $show_title_area_container,
                'options' => array(
                    'standard' => esc_html__('Standard', 'newshub'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'newshub')
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "breadcrumb" => "#mkd_title_area_type_container"
                    ),
                    "show" => array(
                        "standard" => "#mkd_title_area_type_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_container = newshub_mikado_add_admin_container(
            array(
                'parent' => $show_title_area_container,
                'name' => 'title_area_type_container',
                'hidden_property' => 'title_area_type',
                'hidden_value' => '',
                'hidden_values' => array('breadcrumb'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'title_area_enable_breadcrumbs',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Enable Breadcrumbs','newshub'),
                'description' => esc_html__('This option will display Breadcrumbs in Title Area','newshub'),
                'parent' => $title_area_type_container,
            )
        );

		newshub_mikado_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'left',
				'label' => esc_html__('Content Alignment','newshub'),
				'description' => esc_html__('Specify title content alignment','newshub'),
				'parent' => $show_title_area_container,
				'options' => array(
					'left' => esc_html__('Left', 'newshub'),
					'center' => esc_html__('Center', 'newshub'),
					'right' => esc_html__('Right', 'newshub')
				)
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => esc_html__('Background Color','newshub'),
				'description' => esc_html__('Choose a background color for Title Area','newshub'),
				'parent' => $show_title_area_container
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => esc_html__('Background Image','newshub'),
				'description' => esc_html__('Choose an Image for Title Area','newshub'),
				'parent' => $show_title_area_container
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Background Responsive Image','newshub'),
				'description' => esc_html__('Enabling this option will make Title background image responsive','newshub'),
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#mkd_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = newshub_mikado_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		newshub_mikado_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => esc_html__('Height','newshub'),
			'description' => esc_html__('Set a height for Title Area','newshub'),
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'title_area_border_color',
                'type' => 'color',
                'label' => esc_html__('Bottom Border Color','newshub'),
                'description' => esc_html__('Choose a bottom border color for Title Area','newshub'),
                'parent' => $show_title_area_container
            )
        );


		$panel_typography = newshub_mikado_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title_typography',
				'title' => esc_html__('Typography','newshub')
			)
		);

		$group_page_title_styles = newshub_mikado_add_admin_group(array(
			'name'			=> 'group_page_title_styles',
			'title'			=> esc_html__('Title','newshub'),
			'description'	=> esc_html__('Define styles for page title','newshub'),
			'parent'		=> $panel_typography
		));

		$page_title_row_1 = newshub_mikado_add_admin_row(array(
			'name'		=> 'page_title_row_1',
			'parent'	=> $group_page_title_styles
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color','newshub'),
			'parent'		=> $page_title_row_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_fontsize',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $page_title_row_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_lineheight',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $page_title_row_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_texttransform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform','newshub'),
			'options'		=> newshub_mikado_get_text_transform_array(),
			'parent'		=> $page_title_row_1
		));

		$page_title_row_2 = newshub_mikado_add_admin_row(array(
			'name'		=> 'page_title_row_2',
			'parent'	=> $group_page_title_styles,
			'next'		=> true
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family','newshub'),
			'parent'		=> $page_title_row_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontstyle',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style','newshub'),
			'options'		=> newshub_mikado_get_font_style_array(),
			'parent'		=> $page_title_row_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontweight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight','newshub'),
			'options'		=> newshub_mikado_get_font_weight_array(),
			'parent'		=> $page_title_row_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $page_title_row_2
		));

		$group_page_breadcrumbs_styles = newshub_mikado_add_admin_group(array(
			'name'			=> 'group_page_breadcrumbs_styles',
			'title'			=> esc_html__('Title Breadcrumbs','newshub'),
			'description'	=> esc_html__('Define styles for page title breadcrumbs','newshub'),
			'parent'		=> $panel_typography
		));

		$row_page_breadcrumbs_styles_1 = newshub_mikado_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_1',
			'parent'	=> $group_page_breadcrumbs_styles
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color','newshub'),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_fontsize',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_lineheight',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_texttransform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform','newshub'),
			'options'		=> newshub_mikado_get_text_transform_array(),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		$row_page_breadcrumbs_styles_2 = newshub_mikado_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_2',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_breadcrumb_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family','newshub'),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontstyle',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style','newshub'),
			'options'		=> newshub_mikado_get_font_style_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontweight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight','newshub'),
			'options'		=> newshub_mikado_get_font_weight_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		$row_page_breadcrumbs_styles_3 = newshub_mikado_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_3',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_hovercolor',
			'default_value'	=> '',
			'label'			=> esc_html__('Hover Color','newshub'),
			'parent'		=> $row_page_breadcrumbs_styles_3
		));

		$group_page_title_info_styles = newshub_mikado_add_admin_group(array(
			'name'			=> 'group_page_title_info_styles',
			'title'			=> esc_html__('Title Info','newshub'),
			'description'	=> esc_html__('Define styles for post title info','newshub'),
			'parent'		=> $panel_typography
		));

		$page_title_info_row_1 = newshub_mikado_add_admin_row(array(
			'name'		=> 'page_title_info_row_1',
			'parent'	=> $group_page_title_info_styles
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_info_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Color','newshub'),
			'parent'		=> $page_title_info_row_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_info_fontsize',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Size','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $page_title_info_row_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_info_lineheight',
			'default_value'	=> '',
			'label'			=> esc_html__('Line Height','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $page_title_info_row_1
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_info_texttransform',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Transform','newshub'),
			'options'		=> newshub_mikado_get_text_transform_array(),
			'parent'		=> $page_title_info_row_1
		));

		$page_title_info_row_2 = newshub_mikado_add_admin_row(array(
			'name'		=> 'page_title_info_row_2',
			'parent'	=> $group_page_title_info_styles,
			'next'		=> true
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_info_google_fonts',
			'default_value'	=> '-1',
			'label'			=> esc_html__('Font Family','newshub'),
			'parent'		=> $page_title_info_row_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_info_fontstyle',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Style','newshub'),
			'options'		=> newshub_mikado_get_font_style_array(),
			'parent'		=> $page_title_info_row_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_info_fontweight',
			'default_value'	=> '',
			'label'			=> esc_html__('Font Weight','newshub'),
			'options'		=> newshub_mikado_get_font_weight_array(),
			'parent'		=> $page_title_info_row_2
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_info_letter_spacing',
			'default_value'	=> '',
			'label'			=> esc_html__('Letter Spacing','newshub'),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $page_title_info_row_2
		));

		$page_title_info_row_3 = newshub_mikado_add_admin_row(array(
			'name'		=> 'page_title_info_row_3',
			'parent'	=> $group_page_title_info_styles
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_info_hover_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Text Hover Color','newshub'),
			'parent'		=> $page_title_info_row_3
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_info_author_color',
			'default_value'	=> '',
			'label'			=> esc_html__('Author Separated Color','newshub'),
			'parent'		=> $page_title_info_row_3
		));

        $panel_section_title = newshub_mikado_add_admin_panel(
            array(
                'page' => '_title_page',
                'name' => 'panel_section_title',
                'title' => esc_html__('Section Title','newshub')
            )
        );

        $group_page_section_title_styles = newshub_mikado_add_admin_group(array(
            'name'			=> 'group_page_section_title_styles',
            'title'			=> esc_html__('Title','newshub'),
            'description'	=> esc_html__('Define styles for page title','newshub'),
            'parent'		=> $panel_section_title
        ));

        $page_section_title_row_1 = newshub_mikado_add_admin_row(array(
            'name'		=> 'page_section_title_row_1',
            'parent'	=> $group_page_section_title_styles
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'colorsimple',
            'name'			=> 'page_section_title_color',
            'default_value'	=> '',
            'label'			=> esc_html__('Text Color','newshub'),
            'parent'		=> $page_section_title_row_1
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_section_title_fontsize',
            'default_value'	=> '',
            'label'			=> esc_html__('Font Size','newshub'),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $page_section_title_row_1
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_section_title_lineheight',
            'default_value'	=> '',
            'label'			=> esc_html__('Line Height','newshub'),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $page_section_title_row_1
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_section_title_texttransform',
            'default_value'	=> '',
            'label'			=> esc_html__('Text Transform','newshub'),
            'options'		=> newshub_mikado_get_text_transform_array(),
            'parent'		=> $page_section_title_row_1
        ));

        $page_section_title_row_2 = newshub_mikado_add_admin_row(array(
            'name'		=> 'page_section_title_row_2',
            'parent'	=> $group_page_section_title_styles,
            'next'		=> true
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'fontsimple',
            'name'			=> 'page_section_title_google_fonts',
            'default_value'	=> '-1',
            'label'			=> esc_html__('Font Family','newshub'),
            'parent'		=> $page_section_title_row_2
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_section_title_fontstyle',
            'default_value'	=> '',
            'label'			=> esc_html__('Font Style','newshub'),
            'options'		=> newshub_mikado_get_font_style_array(),
            'parent'		=> $page_section_title_row_2
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'selectblanksimple',
            'name'			=> 'page_section_title_fontweight',
            'default_value'	=> '',
            'label'			=> esc_html__('Font Weight','newshub'),
            'options'		=> newshub_mikado_get_font_weight_array(),
            'parent'		=> $page_section_title_row_2
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_section_title_letter_spacing',
            'default_value'	=> '',
            'label'			=> esc_html__('Letter Spacing','newshub'),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $page_section_title_row_2
        ));

        $page_section_title_row_3 = newshub_mikado_add_admin_row(array(
            'name'		=> 'page_section_title_row_3',
            'parent'	=> $group_page_section_title_styles,
            'next'		=> true
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_section_title_padding_top',
            'default_value'	=> '',
            'label'			=> esc_html__('Space Top','newshub'),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $page_section_title_row_3
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'textsimple',
            'name'			=> 'page_section_title_padding_bottom',
            'default_value'	=> '',
            'label'			=> esc_html__('Space Bottom','newshub'),
            'args'			=> array(
                'suffix'	=> 'px'
            ),
            'parent'		=> $page_section_title_row_3
        ));

        newshub_mikado_add_admin_field(array(
            'type'			=> 'colorsimple',
            'name'			=> 'page_section_title_border_color',
            'default_value'	=> '',
            'label'			=> esc_html__('Border Color','newshub'),
            'parent'		=> $page_section_title_row_3
        ));

	}

	add_action( 'newshub_mikado_options_map', 'newshub_mikado_title_options_map', 6);
}