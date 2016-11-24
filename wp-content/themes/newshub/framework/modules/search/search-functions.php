<?php

if (!function_exists('newshub_mikado_search_body_class')) {
    /**
     * Function that adds body classes for different search types
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */

    function newshub_mikado_search_body_class($classes) {

        if (is_active_widget(false, false, 'mkd_search_opener')) {

            $classes[] = 'mkd-search-covers-header';

        }
        return $classes;

    }

    add_filter('body_class', 'newshub_mikado_search_body_class');
}

if (!function_exists('newshub_mikado_get_search')) {
    /**
     * Loads search HTML based on search type option.
     */
    function newshub_mikado_get_search() {

        if (newshub_mikado_active_widget(false, false, 'mkd_search_opener')) {

            newshub_mikado_set_position_for_covering_search();


        }
    }

}

if (!function_exists('newshub_mikado_set_position_for_covering_search')) {
    /**
     * Finds part of header where search template will be loaded
     */
    function newshub_mikado_set_position_for_covering_search() {

        $containing_sidebar = newshub_mikado_active_widget(false, false, 'mkd_search_opener');

        foreach ($containing_sidebar as $sidebar) {

            if (strpos($sidebar, 'top-bar') !== false) {
                add_action('newshub_mikado_after_header_top_html_open', 'newshub_mikado_load_search_template');
            } else if (strpos($sidebar, 'main-menu') !== false) {
                add_action('newshub_mikado_after_header_menu_area_html_open', 'newshub_mikado_load_search_template');
            } else if (strpos($sidebar, 'mobile-logo') !== false) {
                add_action('newshub_mikado_after_mobile_header_html_open', 'newshub_mikado_load_search_template');
            } else if (strpos($sidebar, 'logo') !== false) {
                add_action('newshub_mikado_after_header_logo_area_html_open', 'newshub_mikado_load_search_template');
            } else if (strpos($sidebar, 'sticky') !== false) {
                add_action('newshub_mikado_after_sticky_menu_html_open', 'newshub_mikado_load_search_template');
            }

        }

    }

}

if (!function_exists('newshub_mikado_load_search_template')) {
    /**
     * Loads HTML template with parameters
     */
    function newshub_mikado_load_search_template() {
        

        $search_type = 'search-covers-header';

        $search_icon = '';
        $search_icon_close = '';
        if (newshub_mikado_options()->getOptionValue('search_icon_pack') !== '') {
            $search_icon = newshub_mikado_icon_collections()->getSearchIcon(newshub_mikado_options()->getOptionValue('search_icon_pack'), true);
            $search_icon_close = newshub_mikado_icon_collections()->getSearchClose(newshub_mikado_options()->getOptionValue('search_icon_pack'), true);
        }

        $parameters = array('search_in_grid' => newshub_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false, 'search_icon' => $search_icon, 'search_icon_close' => $search_icon_close);

        newshub_mikado_get_module_template_part('templates/types/' . $search_type, 'search', '', $parameters);

    }

}