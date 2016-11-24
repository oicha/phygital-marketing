<?php

if ( ! function_exists('newshub_mikado_mobile_header_options_map') ) {

	function newshub_mikado_mobile_header_options_map() {

		$panel_mobile_header = newshub_mikado_add_admin_panel(array(
			'title' => esc_html__('Mobile header','newshub'),
			'name'  => 'panel_mobile_header',
			'page'  => '_header_page'
		));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_header_height',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Header Height','newshub'),
			'description' => esc_html__('Enter height for mobile header in pixels','newshub'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_header_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Header Background Color','newshub'),
			'description' => esc_html__('Choose color for mobile header','newshub'),
			'parent'      => $panel_mobile_header
		));

        newshub_mikado_add_admin_field(array(
            'name'        => 'mobile_header_border_color',
            'type'        => 'color',
            'label'       => esc_html__('Mobile Header Border Color','newshub'),
            'description' => esc_html__('Choose background color for mobile header','newshub'),
            'parent'      => $panel_mobile_header
        ));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Menu Background Color','newshub'),
			'description' => esc_html__('Choose color for mobile menu','newshub'),
			'parent'      => $panel_mobile_header
		));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header','newshub'),
			'description' => esc_html__('Define logo height for screen size smaller than 1000px','newshub'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices','newshub'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px','newshub'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		newshub_mikado_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__('Mobile Menu Opener','newshub')
		));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color','newshub'),
			'description' => esc_html__('Choose color for icon header','newshub'),
			'parent'      => $panel_mobile_header
		));

		newshub_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color','newshub'),
			'description' => esc_html__('Choose hover color for mobile navigation icon ','newshub'),
			'parent'      => $panel_mobile_header
		));
	}

    add_action('newshub_mikado_after_header_options_map', 'newshub_mikado_mobile_header_options_map');

}