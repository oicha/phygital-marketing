<?php
/*
Plugin Name: Mikado CPT
Description: Plugin that adds all post types needed by our theme
Author: Mikado Themes
Version: 1.0
*/

require_once 'load.php';


if(!function_exists('mkd_core_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function mkd_core_text_domain() {
        load_plugin_textdomain('mkd_core', false, MIKADO_CORE_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'mkd_core_text_domain');
}

if(!function_exists('newshub_mikado_theme_menu')) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function newshub_mikado_theme_menu() {
		if(mkd_core_theme_installed()) {
			global $newshub_Framework;
			newshub_mikado_init_theme_options();

			$page_hook_suffix = add_menu_page(
				'Mikado Options',                   // The value used to populate the browser's title bar when the menu page is active
				'Mikado Options',                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'newshub_mikado_theme_menu',                // The ID used to bind submenu items to this menu
				array($newshub_Framework->getSkin(), 'renderOptions'), // The callback function used to render this menu
				$newshub_Framework->getSkin()->getMenuIcon('options'),             // Icon For menu Item
				$newshub_Framework->getSkin()->getMenuItemPosition('options')            // Position
			);

			foreach ($newshub_Framework->mkdOptions->adminPages as $key=>$value ) {
				$slug = "";

				if (!empty($value->slug)) {
					$slug = "_tab".$value->slug;
				}

				$subpage_hook_suffix = add_submenu_page(
					'newshub_mikado_theme_menu',
					'Mikado Options - '.$value->title,                   // The value used to populate the browser's title bar when the menu page is active
					$value->title,                   // The text of the menu in the administrator's sidebar
					'administrator',                  // What roles are able to access the menu
					'newshub_mikado_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
					array($newshub_Framework->getSkin(), 'renderOptions')
				);

				add_action('admin_print_scripts-'.$subpage_hook_suffix, 'newshub_mikado_enqueue_admin_scripts');
				add_action('admin_print_styles-'.$subpage_hook_suffix, 'newshub_mikado_enqueue_admin_styles');
			};

			add_action('admin_print_scripts-'.$page_hook_suffix, 'newshub_mikado_enqueue_admin_scripts');
			add_action('admin_print_styles-'.$page_hook_suffix, 'newshub_mikado_enqueue_admin_styles');
		}
	}

	add_action( 'admin_menu', 'newshub_mikado_theme_menu');

}

if(!function_exists('newshub_mikado_shortcodes_in_widgets')) {
    /**
     * Function that enables shortcodes rendering in widgets
     */
    function newshub_mikado_shortcodes_in_widgets(){
        //enable rendering shortcodes in widgets
        add_filter('widget_text', 'do_shortcode');
    }

    add_action('after_setup_theme', 'newshub_mikado_shortcodes_in_widgets');
}