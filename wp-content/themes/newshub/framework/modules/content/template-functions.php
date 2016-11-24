<?php

if (!function_exists('newshub_mikado_register_content_widgets')) {

    function newshub_mikado_register_content_widgets() {

        $content_top_widget = newshub_mikado_options()->getOptionValue('content_top_widget');
        $content_bottom_widget  = newshub_mikado_options()->getOptionValue('content_bottom_widget');

        if ($content_top_widget == 'yes') {
            register_sidebar(array(
                'name' => esc_html__('Content Top','newshub'),
                'id' => 'content_top',
                'description' => esc_html__('Content Top','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-content-top-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-content-widget-title-outer"><h5 class="mkd-content-widget-title mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));
        }

        if ($content_bottom_widget == 'yes') {
            register_sidebar(array(
                'name' => esc_html__('Content Bottom 1','newshub'),
                'id' => 'content_bottom_1',
                'description' => esc_html__('Content Bottom 1','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-content-bottom-column-1 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-content-widget-title-outer"><h5 class="mkd-content-widget-title mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Content Bottom 2','newshub'),
                'id' => 'content_bottom_2',
                'description' => esc_html__('Content Bottom 2','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-content-bottom-column-2 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-content-widget-title-outer"><h5 class="mkd-content-widget-title mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Content Bottom 3','newshub'),
                'id' => 'content_bottom_3',
                'description' => esc_html__('Content Bottom 3','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-content-bottom-column-3 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-content-widget-title-outer"><h5 class="mkd-content-widget-title mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));
        }
    }

    add_action('widgets_init', 'newshub_mikado_register_content_widgets');

}

if (!function_exists('newshub_mikado_get_content_top')) {
    /**
     * Return content top HTML
     */
    function newshub_mikado_get_content_top() {

        //init variables
        $parameters = array();

        $id = newshub_mikado_get_page_id();

        $content_top_widget = newshub_mikado_options()->getOptionValue('content_top_widget');
        $content_top_widget_overwrite = newshub_mikado_get_content_top_options();

        if ($content_top_widget == 'yes' && get_post_meta($id, "mkd_page_content_top_widget", true) !== "yes" && $content_top_widget_overwrite) {

            $parameters['content_top_classes'][] = 'mkd-content-top-widget-area';

            $parameters['content_top_in_grid'] = (newshub_mikado_options()->getOptionValue('content_top_in_grid') == 'yes') ? true : false;

            if (newshub_mikado_options()->getOptionValue('content_top_widget_bottom_separator') == 'yes') {
                $parameters['content_top_classes'][] = 'mkd-content-top-separator';
            }

            newshub_mikado_get_module_template_part('templates/content-top', 'content', '', $parameters);
        }
    }

    add_filter('newshub_mikado_get_content_top', 'newshub_mikado_get_content_top');
}

if (!function_exists('newshub_mikado_get_content_top_options')) {
    /**
     * This function is used to overwrite options and hide content top
     *
     * Return options for content top
     */
    function newshub_mikado_get_content_top_options() {

        $option = true;
        return apply_filters('newshub_mikado_get_content_top_options', $option);
    }
}


if (!function_exists('newshub_mikado_get_content_bottom')) {
    /**
     * Return content bottom HTML
     */
    function newshub_mikado_get_content_bottom() {

        //init variables
        $id = newshub_mikado_get_page_id();
        $parameters = array();

        $content_bottom_widget = newshub_mikado_options()->getOptionValue('content_bottom_widget');
        $content_bottom_widget_overwrite = newshub_mikado_get_content_bottom_options();

        if ($content_bottom_widget == 'yes' && get_post_meta($id, "mkd_page_content_bottom_widget", true) !== "yes" && $content_bottom_widget_overwrite) {

            $parameters['content_bottom_in_grid'] = (newshub_mikado_options()->getOptionValue('content_bottom_in_grid') == 'yes') ? true : false;

            newshub_mikado_get_module_template_part('templates/content-bottom', 'content', '', $parameters);
        }
    }
}

if (!function_exists('newshub_mikado_get_content_bottom_options')) {
    /**
     * This function is used to overwrite options and hide content bottom
     *
     * Return options for content bottom
     */
    function newshub_mikado_get_content_bottom_options() {

        $option = true;
        return apply_filters('newshub_mikado_get_content_bottom_options', $option);
    }
}

