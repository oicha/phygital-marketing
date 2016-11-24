<?php

if ( ! function_exists('newshub_mikado_logo_options_map') ) {

	function newshub_mikado_logo_options_map() {

		$panel_logo = newshub_mikado_add_admin_panel(
			array(
				'page' => '',
				'name' => 'panel_logo',
				'title' => esc_html__('Branding','newshub')
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__('Hide Logo','newshub'),
				'description' => esc_html__('Enabling this option will hide logo image','newshub'),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#mkd_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

        $hide_logo_container = newshub_mikado_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Default','newshub'),
				'description' => esc_html__('Choose a default logo image to display ','newshub'),
				'parent' => $hide_logo_container
			)
		);

        newshub_mikado_add_admin_field(
            array(
                'name' => 'logo_image_dark',
                'type' => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label' => esc_html__('Logo Image - Dark','newshub'),
                'description' => esc_html__('Choose a default logo image to display ','newshub'),
                'parent' => $hide_logo_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'logo_image_light',
                'type' => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
                'label' => esc_html__('Logo Image - Light','newshub'),
                'description' => esc_html__('Choose a default logo image to display ','newshub'),
                'parent' => $hide_logo_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'logo_image_transparent',
                'type' => 'image',
                'default_value' => MIKADO_ASSETS_ROOT."/img/logo-transparent.png",
                'label' => esc_html__('Logo Image - Transparent','newshub'),
                'description' => esc_html__('Choose a default logo image to display ','newshub'),
                'parent' => $hide_logo_container
            )
        );

		newshub_mikado_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo-sticky.png",
				'label' => esc_html__('Logo Image - Sticky','newshub'),
				'description' => esc_html__('Choose a default logo image to display','newshub'),
				'parent' => $hide_logo_container
			)
		);

		newshub_mikado_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo-mobile.png",
				'label' => esc_html__('Logo Image - Mobile','newshub'),
				'description' => esc_html__('Choose a default logo image to display ','newshub'),
				'parent' => $hide_logo_container
			)
		);
	}

    add_action('newshub_mikado_before_general_options_map', 'newshub_mikado_logo_options_map');

}