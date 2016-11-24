<?php

add_action('after_setup_theme', 'newshub_mikado_meta_boxes_map_init', 1);
function newshub_mikado_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('newshub_mikado_before_meta_boxes_map');

	global $newshub_options;
	global $newshub_Framework;
	global $newshub_options_fontstyle;
	global $newshub_options_fontweight;
	global $newshub_options_texttransform;
	global $newshub_options_fontdecoration;
	global $newshub_options_arrows_type;

    foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('newshub_mikado_meta_boxes_map');

	do_action('newshub_mikado_after_meta_boxes_map');
}