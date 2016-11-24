<?php

if ( ! function_exists('newshub_mikado_search_options_map') ) {

	function newshub_mikado_search_options_map() {

		newshub_mikado_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__('Search Page','newshub'),
				'icon' => 'fa fa-search'
			)
		);

		$search_panel = newshub_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Search Page','newshub'),
				'name' => 'search',
				'page' => '_search_page'
			)
		);

        newshub_mikado_add_admin_field(
            array(
                'parent'		=> $search_panel,
                'type'			=> 'yesno',
                'name'			=> 'search_in_grid',
                'default_value'	=> 'yes',
                'label'			=> esc_html__('Search area in grid','newshub'),
                'description'	=> esc_html__('Set search area to be in grid','newshub'),
            )
        );

        $search_style_group = newshub_mikado_add_admin_group(
            array(
                'parent'	=> $search_panel,
                'title'		=> esc_html__('Search Holder','newshub'),
                'description'	=> esc_html__('Define style for search holder','newshub'),
                'name'		=> 'search_style_group'
            )
        );

            $search_style_row = newshub_mikado_add_admin_row(
                array(
                    'parent'	=> $search_style_group,
                    'name'		=> 'search_style_row'
                )
            );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'	=> $search_style_row,
                        'type'		=> 'colorsimple',
                        'name'		=> 'search_icon_color',
                        'label'		=> esc_html__('Color','newshub')
                    )
                );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'	=> $search_style_row,
                        'type'		=> 'colorsimple',
                        'name'		=> 'search_background_color',
                        'label'		=> esc_html__('Background Color','newshub')
                    )
                );

        newshub_mikado_add_admin_field(
            array(
                'parent'		=> $search_panel,
                'type'			=> 'select',
                'name'			=> 'search_icon_pack',
                'default_value'	=> 'font_awesome',
                'label'			=> esc_html__('Search Icon Pack','newshub'),
                'description'	=> esc_html__('Choose icon pack for search icon','newshub'),
                'options'		=> newshub_mikado_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons', 'dripicons'))
            )
        );

        $search_icon_color_group = newshub_mikado_add_admin_group(
            array(
                'parent'	=> $search_panel,
                'title'		=> esc_html__('Icon Style','newshub'),
                'description'	=> esc_html__('Define style for search icon','newshub'),
                'name'		=> 'search_icon_color_group'
            )
        );

            $search_icon_color_row = newshub_mikado_add_admin_row(
                array(
                    'parent'	=> $search_icon_color_group,
                    'name'		=> 'search_icon_color_row'
                )
            );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'		=> $search_icon_color_row,
                        'type'			=> 'textsimple',
                        'name'			=> 'search_icon_size',
                        'default_value'	=> '',
                        'label'			=> esc_html__('Icon Size','newshub'),
                        'args'			=> array(
                            'suffix'	=> 'px'
                        )
                    )
                );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'	=> $search_icon_color_row,
                        'type'		=> 'colorsimple',
                        'name'		=> 'search_icon_color',
                        'label'		=> esc_html__('Color','newshub')
                    )
                );
                newshub_mikado_add_admin_field(
                    array(
                        'parent' => $search_icon_color_row,
                        'type'		=> 'colorsimple',
                        'name'		=> 'search_icon_hover_color',
                        'label'		=> esc_html__('Hover Color','newshub')
                    )
                );

        $search_close_icon_group = newshub_mikado_add_admin_group(
            array(
                'parent'	=> $search_panel,
                'title'		=> esc_html__('Search Close','newshub'),
                'description'	=> esc_html__('Define style for search close icon','newshub'),
                'name'		=> 'search_close_icon_group'
            )
        );

            $search_close_icon_row = newshub_mikado_add_admin_row(
                array(
                    'parent'	=> $search_close_icon_group,
                    'name'		=> 'search_icon_row'
                )
            );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'		=> $search_close_icon_row,
                        'type'			=> 'textsimple',
                        'name'			=> 'search_close_size',
                        'label'			=> esc_html__('Icon Size','newshub'),
                        'default_value'	=> '',
                        'args'			=> array(
                            'suffix'	=> 'px'
                        )
                    )
                );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'		=> $search_close_icon_row,
                        'type'			=> 'colorsimple',
                        'name'			=> 'search_close_color',
                        'label'			=> esc_html__('Icon Color','newshub'),
                        'default_value'	=> ''
                    )
                );

                newshub_mikado_add_admin_field(
                    array(
                        'parent'		=> $search_close_icon_row,
                        'type'			=> 'colorsimple',
                        'name'			=> 'search_close_hover_color',
                        'label'			=> esc_html__('Icon Hover Color','newshub'),
                        'default_value'	=> ''
                    )
                );


		newshub_mikado_add_admin_field(array(
			'name'        => 'enable_search_page_sidebar',
			'type'        => 'select',
			'label'       => esc_html__('Enable Sidebar for Search Pages','newshub'),
			'description' => esc_html__('Enabling this option you will display sidebar on your Search Pages','newshub'),
			'default_value' => 'yes',
			'parent'      => $search_panel,
			'options'     => array(
				'yes' => esc_html__('Yes', 'newshub'),
				'no' => esc_html__('No', 'newshub')
			)
		));

		$custom_sidebars = newshub_mikado_get_custom_sidebars();

		if(count($custom_sidebars) > 0) {
			newshub_mikado_add_admin_field(array(
				'name' => 'search_page_custom_sidebar',
				'type' => 'selectblank',
				'label' => esc_html__('Custom Sidebar to Display','newshub'),
				'description' => esc_html__('Choose a custom sidebar to display on your Search Pages. Default sidebar is "Sidebar Page"','newshub'),
				'parent' => $search_panel,
				'options' => newshub_mikado_get_custom_sidebars()
			));
		}

	}

	add_action('newshub_mikado_options_map', 'newshub_mikado_search_options_map', 5);
}