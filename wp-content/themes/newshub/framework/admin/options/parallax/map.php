<?php

if ( ! function_exists('newshub_mikado_parallax_options_map') ) {
	/**
	 * Parallax options page
	 */
	function newshub_mikado_parallax_options_map()
	{

		newshub_mikado_add_admin_page(
			array(
				'slug' => '_parallax_page',
				'title' => esc_html__('Parallax','newshub'),
				'icon' => 'fa fa-unsorted'
			)
		);

		$panel_parallax = newshub_mikado_add_admin_panel(
			array(
				'page'  => '_parallax_page',
				'name'  => 'panel_parallax',
				'title' => esc_html__('Parallax','newshub')
			)
		);

		newshub_mikado_add_admin_field(array(
			'type'			=> 'onoff',
			'name'			=> 'parallax_on_off',
			'default_value'	=> 'off',
			'label'			=> esc_html__('Parallax on touch devices','newshub'),
			'description'	=> esc_html__('Enabling this option will allow parallax on touch devices','newshub'),
			'parent'		=> $panel_parallax
		));

		newshub_mikado_add_admin_field(array(
			'type'			=> 'text',
			'name'			=> 'parallax_min_height',
			'default_value'	=> '300',
			'label'			=> esc_html__('Parallax Min Height','newshub'),
			'description'	=> esc_html__('Set a minimum height for parallax images on small displays (phones, tablets, etc.)','newshub'),
			'args'			=> array(
				'col_width'	=> 3,
				'suffix'	=> 'px'
			),
			'parent'		=> $panel_parallax
		));

	}

	add_action('newshub_mikado_options_map', 'newshub_mikado_parallax_options_map',10);

}