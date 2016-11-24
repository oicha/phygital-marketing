<?php

if ( ! function_exists('newshub_mikado_general_options_map') ) {
    /**
     * General options page
     */
    function newshub_mikado_general_options_map() {

        newshub_mikado_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General','newshub'),
                'icon'  => 'fa fa-institution'
            )
        );

        do_action('newshub_mikado_before_general_options_map');

        $panel_design_style = newshub_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => esc_html__('Appearance','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family','newshub'),
                'description'   => esc_html__('Choose a default Google font for your site','newshub'),
                'parent' => $panel_design_style
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts','newshub'),
                'description'   => esc_html__('','newshub'),
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = newshub_mikado_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family','newshub'),
                'description'   => esc_html__('Choose additional Google font for your site','newshub'),
                'parent'        => $additional_google_fonts_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family','newshub'),
                'description'   => esc_html__('Choose additional Google font for your site','newshub'),
                'parent'        => $additional_google_fonts_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family','newshub'),
                'description'   => esc_html__('Choose additional Google font for your site','newshub'),
                'parent'        => $additional_google_fonts_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family','newshub'),
                'description'   => esc_html__('Choose additional Google font for your site','newshub'),
                'parent'        => $additional_google_fonts_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family','newshub'),
                'description'   => esc_html__('Choose additional Google font for your site','newshub'),
                'parent'        => $additional_google_fonts_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => esc_html__('First Main Color','newshub'),
                'description'   => esc_html__('Choose the most dominant theme color. Default color is #ff1d4d','newshub'),
                'parent'        => $panel_design_style
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color','newshub'),
                'description'   => esc_html__('Choose the background color for page content. Default color is #ffffff','newshub'),
                'parent'        => $panel_design_style
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => esc_html__('Text Selection Color','newshub'),
                'description'   => esc_html__('Choose the color users see when selecting text','newshub'),
                'parent'        => $panel_design_style
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout','newshub'),
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkd_fixed_image_container",
                    "dependence_show_on_yes" => "#mkd_boxed_container"
                )
            )
        );

        $boxed_container = newshub_mikado_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color','newshub'),
                'description'   => esc_html__('Choose the page background color outside box.','newshub'),
                'parent'        => $boxed_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Image','newshub'),
                'description'   => esc_html__('Choose an image to be displayed in background','newshub'),
                'parent'        => $boxed_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Pattern','newshub'),
                'description'   => esc_html__('Choose an image to be used as background pattern','newshub'),
                'parent'        => $boxed_container
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment','newshub'),
                'description'   => esc_html__('Choose background image attachment','newshub'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => 'Fixed',
                    'scroll'    => 'Scroll'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'element_appear_amount',
                'type' => 'text',
                'label' => esc_html__('Element Appearance','newshub'),
                'description' => esc_html__('For animated elements, set distance (related to browser bottom) to start the animation','newshub'),
                'parent' => $panel_design_style,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'fade_in_layouts',
                'type' => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__('Fade In Layouts','newshub'),
                'description' => esc_html__('Enabling this option will trigger a fade-in appear effect to all post layouts on non-touch devices.','newshub'),
                'parent' => $panel_design_style,
            )
        );

        $panel_settings = newshub_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behavior','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Smooth Scroll','newshub'),
                'description'   => esc_html__('Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)','newshub'),
                'parent'        => $panel_settings
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"','newshub'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page','newshub'),
                'parent'        => $panel_settings
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness','newshub'),
                'description'   => esc_html__('Enabling this option will make all pages responsive','newshub'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = newshub_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom CSS','newshub'),
                'description'   => esc_html__('Enter your custom CSS here','newshub'),
                'parent'        => $panel_custom_code
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom JS','newshub'),
                'description'   => esc_html__('Enter your custom Javascript here','newshub'),
                'parent'        => $panel_custom_code
            )
        );

        $panel_google_api = newshub_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_google_api',
                'title' => esc_html__('Google API','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name'        => 'google_maps_api_key',
                'type'        => 'text',
                'label'       => esc_html__('Google Maps Api Key','newshub'),
                'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation. Temporarily you can use "AIzaSyAidINa74sv7bt7Y3vqjKjM7m0PgJN1bhk"','newshub'),
                'parent'      => $panel_google_api
            )
        );


    }

    add_action( 'newshub_mikado_options_map', 'newshub_mikado_general_options_map', 1);
}