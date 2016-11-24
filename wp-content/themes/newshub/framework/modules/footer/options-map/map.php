<?php

if (!function_exists('newshub_mikado_footer_options_map')) {
    /**
     * Add footer options
     */
    function newshub_mikado_footer_options_map() {

        newshub_mikado_add_admin_page(
            array(
                'slug' => '_footer_page',
                'title' => esc_html__('Footer','newshub'),
                'icon' => 'fa fa-sort-amount-asc'
            )
        );

        $footer_panel = newshub_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Footer','newshub'),
                'name' => 'footer',
                'page' => '_footer_page'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'show_footer_heading',
                'default_value' => 'no',
                'label' => esc_html__('Show Footer Heading','newshub'),
                'description' => esc_html__('Enabling this option will show Footer Heading area','newshub'),
                'parent' => $footer_panel,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_footer_heading_container"
                )
            )
        );

        $footer_heading_container = newshub_mikado_add_admin_container(array(
            'name' => 'footer_heading_container',
            'parent' => $footer_panel,
            'hidden_property' => 'show_footer_heading',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'footer_heading_in_grid',
                'default_value' => 'no',
                'label' => esc_html__('Footer Heading in Grid','newshub'),
                'description' => esc_html__('Enabling this option will place Footer Heading content in grid','newshub'),
                'parent' => $footer_heading_container,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'footer_in_grid',
                'default_value' => 'no',
                'label' => esc_html__('Footer in Grid','newshub'),
                'description' => esc_html__('Enabling this option will place Footer Top and Bottom content in grid','newshub'),
                'parent' => $footer_panel,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'uncovering_footer_effect',
                'default_value' => 'no',
                'label' => esc_html__('Uncovering Footer','newshub'),
                'description' => esc_html__('Set footer to have uncovering/unveiling behavior','newshub'),
                'parent' => $footer_panel,
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $footer_panel,
                'name' => 'footer_top_area',
                'title' => esc_html__('Footer Top Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'show_footer_top',
                'default_value' => 'yes',
                'label' => esc_html__('Show Footer Top','newshub'),
                'description' => esc_html__('Enabling this option will show Footer Top area','newshub'),
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_top_container'
                ),
                'parent' => $footer_panel,
            )
        );

        $show_footer_top_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'show_footer_top_container',
                'hidden_property' => 'show_footer_top',
                'hidden_value' => 'no',
                'parent' => $footer_panel
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'footer_top_columns',
                'default_value' => '4',
                'label' => esc_html__('Footer Top Columns','newshub'),
                'description' => esc_html__('Choose number of columns for Footer Top area','newshub'),
                'options' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '5' => '3(25%+25%+50%)',
                    '6' => '3(50%+25%+25%)',
                    '4' => '4'
                ),
                'parent' => $show_footer_top_container,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'footer_top_text_color',
                'default_value' => 'default',
                'label' => esc_html__('Footer Top Skin','newshub'),
                'description' => esc_html__('Choose skin for Footer Top area','newshub'),
                'options' => array(
                    'default' => esc_html__('Default', 'newshub'),
                    'light' => esc_html__('Light', 'newshub'),
                    'dark' => esc_html__('Dark', 'newshub'),
                ),
                'parent' => $show_footer_top_container,
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_top_color',
            'type' => 'color',
            'label' => esc_html__('Text Color','newshub'),
            'description' => esc_html__('Set text color for footer top','newshub'),
            'parent' => $show_footer_top_container
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_top_background_color',
            'type' => 'color',
            'label' => esc_html__('Background Color','newshub'),
            'description' => esc_html__('Set background color for footer top','newshub'),
            'parent' => $show_footer_top_container
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'footer_top_text_align',
                'default_value' => 'default',
                'label' => esc_html__('Text Align','newshub'),
                'description' => esc_html__('Choose text align for Footer Top area','newshub'),
                'options' => array(
                    'default' => esc_html__('Default', 'newshub'),
                    'center' => esc_html__('Center', 'newshub'),
                ),
                'parent' => $show_footer_top_container,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'name' => 'footer_top_top_border',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Top Border','newshub'),
                'description' => esc_html__('Enabling this option will show Footer Top top border','newshub'),
                'parent' => $show_footer_top_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_footer_top_border_container"
                )
            )
        );

        $footer_top_border_container = newshub_mikado_add_admin_container(array(
            'name' => 'footer_top_border_container',
            'parent' => $show_footer_top_container,
            'hidden_property' => 'footer_top_top_border',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_top_top_border_color',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set top border color for footer top, deafult is #e4e4e4','newshub'),
            'parent' => $footer_top_border_container
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $footer_panel,
                'name' => 'footer_bottom_area',
                'title' => esc_html__('Footer Bottom Area','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'show_footer_bottom',
                'default_value' => 'yes',
                'label' => esc_html__('Show Footer Bottom','newshub'),
                'description' => esc_html__('Enabling this option will show Footer Bottom area','newshub'),
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_show_footer_bottom_container'
                ),
                'parent' => $footer_panel,
            )
        );

        $show_footer_bottom_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'show_footer_bottom_container',
                'hidden_property' => 'show_footer_bottom',
                'hidden_value' => 'no',
                'parent' => $footer_panel
            )
        );


        newshub_mikado_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'footer_bottom_columns',
                'default_value' => '2',
                'label' => esc_html__('Footer Bottom Columns','newshub'),
                'description' => esc_html__('Choose number of columns for Footer Bottom area','newshub'),
                'options' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3'
                ),
                'parent' => $show_footer_bottom_container,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'select',
                'name' => 'footer_bottom_text_color',
                'default_value' => 'Default',
                'label' => esc_html__('Footer Bottom Skin','newshub'),
                'description' => esc_html__('Choose skin for Footer Bottom area','newshub'),
                'options' => array(
                    'default' => esc_html__('Default', 'newshub'),
                    'light' => esc_html__('Light', 'newshub'),
                    'dark' => esc_html__('Dark', 'newshub'),
                ),
                'parent' => $show_footer_bottom_container,
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_bottom_color',
            'type' => 'color',
            'label' => esc_html__('Text Color','newshub'),
            'description' => esc_html__('Set text color for footer bottom','newshub'),
            'parent' => $show_footer_bottom_container
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_bottom_background_color',
            'type' => 'color',
            'label' => esc_html__('Background Color','newshub'),
            'description' => esc_html__('Set background color for footer bottom','newshub'),
            'parent' => $show_footer_bottom_container
        ));

        newshub_mikado_add_admin_field(
            array(
                'name' => 'footer_bottom_top_border',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Top Border','newshub'),
                'description' => esc_html__('Enabling this option will show Footer Bottom top border','newshub'),
                'parent' => $show_footer_bottom_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkd_footer_bottom_border_container"
                )
            )
        );

        $footer_bottom_border_container = newshub_mikado_add_admin_container(array(
            'name' => 'footer_bottom_border_container',
            'parent' => $show_footer_bottom_container,
            'hidden_property' => 'footer_bottom_top_border',
            'hidden_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_bottom_top_border_color',
            'type' => 'color',
            'label' => esc_html__('Border Color','newshub'),
            'description' => esc_html__('Set top border color for footer bottom, deafult is #e4e4e4','newshub'),
            'parent' => $footer_bottom_border_container
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $footer_panel,
                'name' => 'footer_widget_area',
                'title' => esc_html__('Footer Text Widget','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $footer_panel,
                'type' => 'text',
                'name' => 'footer_widget_margin',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'description' => esc_html__('Insert margin for Text Widget','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $footer_panel,
                'name' => 'footer_menu_area',
                'title' => esc_html__('Footer Menu Area','newshub')
            )
        );

        $group_footer_menu = newshub_mikado_add_admin_group(array(
            'title' => esc_html__('Item Style','newshub'),
            'name' => 'group_footer_menu',
            'parent' => $footer_panel,
            'description' => esc_html__('Define styles for footer menu item','newshub'),
        ));

        $row1_footer_menu = newshub_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_footer_menu
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_menu_text_color',
            'type' => 'colorsimple',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row1_footer_menu
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'footer_menu_text_hover_color',
            'type' => 'colorsimple',
            'label' => esc_html__('Text Hover Color','newshub'),
            'parent' => $row1_footer_menu
        ));

        $row2_footer_menu = newshub_mikado_add_admin_row(
            array(
                'parent' => $group_footer_menu,
                'name' => 'row2_footer_menu',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_footer_menu,
                'type' => 'fontsimple',
                'name' => 'footer_menu_google_fonts',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_footer_menu,
                'type' => 'textsimple',
                'name' => 'footer_menu_fontsize',
                'default_value' => '',
                'label' => esc_html__('Font Size','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_footer_menu,
                'type' => 'textsimple',
                'name' => 'footer_menu_lineheight',
                'default_value' => '',
                'label' => esc_html__('Line Height','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row2_footer_menu,
                'type' => 'selectblanksimple',
                'name' => 'footer_menu_fontweight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array()
            )
        );

        $row3_footer_menu = newshub_mikado_add_admin_row(
            array(
                'parent' => $group_footer_menu,
                'name' => 'row3_footer_menu',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row3_footer_menu,
                'type' => 'selectblanksimple',
                'name' => 'footer_menu_fontstyle',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row3_footer_menu,
                'type' => 'textsimple',
                'name' => 'footer_menu_letterspacing',
                'default_value' => '',
                'label' => esc_html__('Letter Spacing','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $row3_footer_menu,
                'type' => 'selectblanksimple',
                'name' => 'footer_menu_texttransform',
                'default_value' => '',
                'label' => esc_html__('Text Transform','newshub'),
                'options' => newshub_mikado_get_text_transform_array()
            )
        );
    }

    add_action('newshub_mikado_options_map', 'newshub_mikado_footer_options_map', 9);
}