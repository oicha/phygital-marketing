<?php
if (!function_exists('newshub_mikado_register_side_area_sidebar')) {
    /**
     * Register side area sidebar
     */
    function newshub_mikado_register_side_area_sidebar() {

        register_sidebar(array(
            'name' => 'Side Area',
            'id' => 'sidearea',
            'description' => esc_html__('Side Area','newshub'),
            'before_widget' => '<div id="%1$s" class="widget mkd-sidearea %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
            'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
        ));

    }

    add_action('widgets_init', 'newshub_mikado_register_side_area_sidebar');

}

if (!function_exists('newshub_mikado_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function newshub_mikado_side_menu_body_class($classes) {

        if (is_active_widget(false, false, 'mkd_side_area_opener')) {



                $classes[] = 'mkd-side-menu-slide-over-content';


                $classes[] = 'mkd-' . newshub_mikado_options()->getOptionValue('side_area_slide_over_content_width');




        }

        return $classes;

    }

    add_filter('body_class', 'newshub_mikado_side_menu_body_class');
}


if (!function_exists('newshub_mikado_get_side_area')) {
    /**
     * Loads side area HTML
     */
    function newshub_mikado_get_side_area() {

        if (is_active_widget(false, false, 'mkd_side_area_opener')) {

            $parameters = array(
                'show_side_area_title' => newshub_mikado_options()->getOptionValue('side_area_title') !== '' ? true : false, //Dont show title if empty
            );

            newshub_mikado_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);

        }

    }

}

if (!function_exists('newshub_mikado_get_side_area_title')) {
    /**
     * Loads side area title HTML
     */
    function newshub_mikado_get_side_area_title() {

        $parameters = array(
            'side_area_title' => newshub_mikado_options()->getOptionValue('side_area_title')
        );

        newshub_mikado_get_module_template_part('templates/parts/title', 'sidearea', '', $parameters);

    }

}

if (!function_exists('newshub_mikado_get_side_menu_icon_html')) {
    /**
     * Function that outputs html for side area icon opener.
     * Uses $newshub_IconCollections global variable
     * @return string generated html
     */
    function newshub_mikado_get_side_menu_icon_html() {

        $icon_html = '';

        if (newshub_mikado_options()->getOptionValue('side_area_button_icon_pack') !== '') {
            $icon_pack = newshub_mikado_options()->getOptionValue('side_area_button_icon_pack');

            $icons = newshub_mikado_icon_collections()->getIconCollection($icon_pack);
            $icon_options_field = 'side_area_icon_' . $icons->param;

            if (newshub_mikado_options()->getOptionValue($icon_options_field) !== '') {

                $icon = newshub_mikado_options()->getOptionValue($icon_options_field);
                $icon_html = newshub_mikado_icon_collections()->renderIcon($icon, $icon_pack);

            }

        }

        return $icon_html;
    }
}