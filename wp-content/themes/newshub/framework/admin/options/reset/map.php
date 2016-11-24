<?php

if ( ! function_exists('newshub_mikado_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function newshub_mikado_reset_options_map() {

		newshub_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__('Reset','newshub'),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = newshub_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__('Reset','newshub')
			)
		);

		newshub_mikado_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> esc_html__('Reset to Defaults','newshub'),
			'description'	=> esc_html__('This option will reset all Mikado Options values to defaults','newshub'),
			'parent'		=> $panel_reset
		));

	}

	add_action( 'newshub_mikado_options_map', 'newshub_mikado_reset_options_map', 22 );
}