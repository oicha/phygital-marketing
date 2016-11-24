<?php

if(!function_exists('newshub_mikado_access_press_social_plugin')) {
	/**
	 * Map Access Press Social Count plugin
	 * Hooks on vc_after_init action
	 */
	function newshub_mikado_access_press_social_plugin() {

        newshub_mikado_add_admin_page(
			array(
				'slug' => '_aps_plugin_page',
				'title' => esc_html__('Access Press Social','newshub'),
				'icon' => 'fa fa-home'
			)
		);

		$aps_panel = newshub_mikado_add_admin_panel(
			array(
				'title' => esc_html__('Access Press Social Count','newshub'),
				'name' => 'aps_plugin',
				'page' => '_aps_plugin_page'
			)
		);

        newshub_mikado_add_admin_field(
			array(
				'parent'		=> $aps_panel,
				'type'			=> 'select',
				'name'			=> 'aps_custom_style',
				'default_value'	=> '',
				'label' 		=> esc_html__('Enable Custom Style','newshub'),
				'description' 	=> esc_html__('Enabling this option you will set our custom style for Access Press Social Count elements','newshub'),
				'options' 		=> array(
					'apsc-custom-style-enabled' => esc_html('Yes', 'newshub'),
					'' => esc_html('No', 'newshub')
				)
			)
		);
	}

    add_action( 'newshub_mikado_options_map', 'newshub_mikado_access_press_social_plugin', 14 );
}