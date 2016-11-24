<?php

if (!function_exists('newshub_mikado_register_footer_sidebar')) {

    function newshub_mikado_register_footer_sidebar() {

        $display_footer_heading = (newshub_mikado_options()->getOptionValue('show_footer_heading') == 'yes') ? true : false;
        $display_footer_top = (newshub_mikado_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
        $display_footer_bottom = (newshub_mikado_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;

        if ($display_footer_heading) {
            register_sidebar(array(
                'name' => esc_html__('Footer Heading','newshub'),
                'id' => 'footer_heading',
                'description' => esc_html__('Footer Heading','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-heading %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));
        }

        if ($display_footer_top) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column 1','newshub'),
                'id' => 'footer_column_1',
                'description' => esc_html__('Footer Column 1','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-1 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Footer Column 2','newshub'),
                'id' => 'footer_column_2',
                'description' => esc_html__('Footer Column 2','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-2 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Footer Column 3','newshub'),
                'id' => 'footer_column_3',
                'description' => esc_html__('Footer Column 3','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-3 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Footer Column 4','newshub'),
                'id' => 'footer_column_4',
                'description' => esc_html__('Footer Column 4','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-column-4 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));
        }

        if ($display_footer_bottom) {
            register_sidebar(array(
                'name' => esc_html__('Footer Text','newshub'),
                'id' => 'footer_text',
                'description' => esc_html__('Footer Text','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-text %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Left','newshub'),
                'id' => 'footer_bottom_left',
                'description' => esc_html__('Footer Bottom Left','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-left %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));

            register_sidebar(array(
                'name' => esc_html__('Footer Bottom Right','newshub'),
                'id' => 'footer_bottom_right',
                'description' => esc_html__('Footer Bottom Right','newshub'),
                'before_widget' => '<div id="%1$s" class="widget mkd-footer-bottom-left %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="mkd-section-title-holder clearfix"><h5 class="mkd-title-line-head">',
                'after_title' => '</h5><div class="mkd-title-line-body"></div></div>'
            ));
        }

    }

    add_action('widgets_init', 'newshub_mikado_register_footer_sidebar');

}

if (!function_exists('newshub_mikado_get_footer')) {
    /**
     * Loads footer HTML
     */
    function newshub_mikado_get_footer() {

        $parameters = array();
        $id = newshub_mikado_get_page_id();

        if(is_active_sidebar('footer_heading')) {
            $parameters['display_footer_heading'] = (newshub_mikado_options()->getOptionValue('show_footer_heading') == 'yes') ? true : false;
        }
        else {
            $parameters['display_footer_heading'] = false;
        }

        if(is_active_sidebar('footer_column_1') || is_active_sidebar('footer_column_2') || is_active_sidebar('footer_column_3') || is_active_sidebar('footer_column_4')) {
            $parameters['display_footer_top'] = (newshub_mikado_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
        }
        else {
            $parameters['display_footer_top'] = false;
        }

        if(is_active_sidebar('footer_text') || is_active_sidebar('footer_bottom_left') || is_active_sidebar('footer_bottom_right')) {
            $parameters['display_footer_bottom'] = (newshub_mikado_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;
        }
        else {
            $parameters['display_footer_bottom'] = false;
        }

        newshub_mikado_get_module_template_part('templates/footer', 'footer', '', $parameters);
    }
}

if (!function_exists('newshub_mikado_get_footer_heading')) {
    /**
     * Return footer top HTML
     */
    function newshub_mikado_get_footer_heading() {

        $parameters = array();
        $footer_heading_classes = array();
        $footer_heading_classes[] = 'mkd-footer-heading-inner';

        $parameters['footer_heading_classes'] = $footer_heading_classes;
        $parameters['footer_in_grid'] = (newshub_mikado_options()->getOptionValue('footer_heading_in_grid') == 'yes') ? true : false;

        newshub_mikado_get_module_template_part('templates/parts/footer-heading', 'footer', '', $parameters);
    }
}

if (!function_exists('newshub_mikado_get_footer_top')) {
    /**
     * Return footer top HTML
     */
    function newshub_mikado_get_footer_top() {

        $parameters = array();
        $footer_top_classes = array();
        $footer_top_classes[] = 'mkd-footer-top';

        if (newshub_mikado_options()->getOptionValue('footer_in_grid') != 'yes') {
            $footer_top_classes[] = 'mkd-footer-top-full';
        }
        if (newshub_mikado_options()->getOptionValue('footer_top_text_align') == 'center') {
            $footer_top_classes[] = 'text-align-center'; // default/reset css
        }
        switch (newshub_mikado_options()->getOptionValue('footer_top_text_color')) {
            case 'light':
                $footer_top_classes[] = 'mkd-light';
                break;
            case 'dark':
                $footer_top_classes[] = 'mkd-dark';
                break;
            default:
                $footer_top_classes[] = '';
        }

        $parameters['footer_top_classes'] = $footer_top_classes;
        $parameters['footer_in_grid'] = (newshub_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
        $parameters['footer_top_columns'] = newshub_mikado_options()->getOptionValue('footer_top_columns');

        newshub_mikado_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);
    }
}

if (!function_exists('newshub_mikado_get_footer_bottom')) {
    /**
     * Return footer bottom HTML
     */
    function newshub_mikado_get_footer_bottom() {

        $parameters = array();
        $footer_bottom_classes = array();
        $footer_bottom_classes[] = 'mkd-footer-bottom-holder-inner';

        if (newshub_mikado_options()->getOptionValue('footer_in_grid') != 'yes') {
            $footer_bottom_classes[] = 'mkd-footer-bottom-full';
        }
        switch (newshub_mikado_options()->getOptionValue('footer_bottom_text_color')) {
            case 'light':
                $footer_bottom_classes[] = 'mkd-light';
                break;
            case 'dark':
                $footer_bottom_classes[] = 'mkd-dark';
                break;
            default:
                $footer_bottom_classes[] = '';
        }

        $parameters['footer_bottom_classes'] = $footer_bottom_classes;
        $parameters['footer_in_grid'] = (newshub_mikado_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
        $parameters['footer_bottom_columns'] = newshub_mikado_options()->getOptionValue('footer_bottom_columns');

        newshub_mikado_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);
    }
}

//Functions for loading sidebars

if (!function_exists('newshub_mikado_get_footer_sidebar_25_25_50')) {

    function newshub_mikado_get_footer_sidebar_25_25_50() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_sidebar_50_25_25')) {

    function newshub_mikado_get_footer_sidebar_50_25_25() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_sidebar_four_columns')) {

    function newshub_mikado_get_footer_sidebar_four_columns() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_sidebar_three_columns')) {

    function newshub_mikado_get_footer_sidebar_three_columns() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_sidebar_two_columns')) {

    function newshub_mikado_get_footer_sidebar_two_columns() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_sidebar_one_column')) {

    function newshub_mikado_get_footer_sidebar_one_column() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_bottom_sidebar_three_columns')) {

    function newshub_mikado_get_footer_bottom_sidebar_three_columns() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_bottom_sidebar_two_columns')) {

    function newshub_mikado_get_footer_bottom_sidebar_two_columns() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
    }
}

if (!function_exists('newshub_mikado_get_footer_bottom_sidebar_one_column')) {

    function newshub_mikado_get_footer_bottom_sidebar_one_column() {
        newshub_mikado_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
    }
}