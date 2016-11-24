<?php

add_action('after_setup_theme', 'newshub_mikado_admin_map_init', 0);

function newshub_mikado_admin_map_init() {

    do_action('newshub_mikado_before_options_map');

    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/fonts/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/general/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/page/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/parallax/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/sidebar/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/social/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/error404/map.php';
    require_once MIKADO_FRAMEWORK_ROOT_DIR.'/admin/options/reset/map.php';


    do_action('newshub_mikado_options_map');

    do_action('newshub_mikado_after_options_map');

}