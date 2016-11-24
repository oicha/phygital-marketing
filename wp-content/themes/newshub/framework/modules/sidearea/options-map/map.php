<?php

if (!function_exists('newshub_mikado_sidearea_options_map')) {

    function newshub_mikado_sidearea_options_map() {

        newshub_mikado_add_admin_page(
            array(
                'slug' => '_side_area_page',
                'title' => esc_html__('Side Area','newshub'),
                'icon' => 'fa fa-search'
            )
        );

        $side_area_panel = newshub_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Side Area','newshub'),
                'name' => 'side_area',
                'page' => '_side_area_page'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_slide_over_content_width',
                'default_value' => 'width-311',
                'label' => esc_html__('Side Area Width','newshub'),
                'description' => esc_html__('Choose width for Side Area','newshub'),
                'options' => array(
                    'width-290' => esc_html__('290px', 'newshub'),
                    'width-311' => esc_html__('311px', 'newshub'),
                    'width-390' => esc_html__('390px', 'newshub')
                )
            )
        );


//init icon pack hide and show array. It will be populated dinamically from collections array
        $side_area_icon_pack_hide_array = array();
        $side_area_icon_pack_show_array = array();

//do we have some collection added in collections array?
        if (is_array(newshub_mikado_icon_collections()->iconCollections) && count(newshub_mikado_icon_collections()->iconCollections)) {
            //get collections params array. It will contain values of 'param' property for each collection
            $side_area_icon_collections_params = newshub_mikado_icon_collections()->getIconCollectionsParams();

            //foreach collection generate hide and show array
            foreach (newshub_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
                $side_area_icon_pack_hide_array[$dep_collection_key] = '';

                //we need to include only current collection in show string as it is the only one that needs to show
                $side_area_icon_pack_show_array[$dep_collection_key] = '#mkd_side_area_icon_' . $dep_collection_object->param . '_container';

                //for all collections param generate hide string
                foreach ($side_area_icon_collections_params as $side_area_icon_collections_param) {
                    //we don't need to include current one, because it needs to be shown, not hidden
                    if ($side_area_icon_collections_param !== $dep_collection_object->param) {
                        $side_area_icon_pack_hide_array[$dep_collection_key] .= '#mkd_side_area_icon_' . $side_area_icon_collections_param . '_container,';
                    }
                }

                //remove remaining ',' character
                $side_area_icon_pack_hide_array[$dep_collection_key] = rtrim($side_area_icon_pack_hide_array[$dep_collection_key], ',');
            }

        }

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_button_icon_pack',
                'default_value' => 'ion_icons',
                'label' => esc_html__('Side Area Button Icon Pack','newshub'),
                'description' => esc_html__('Choose icon pack for side area button','newshub'),
                'options' => newshub_mikado_icon_collections()->getIconCollections(),
                'args' => array(
                    'dependence' => true,
                    'hide' => $side_area_icon_pack_hide_array,
                    'show' => $side_area_icon_pack_show_array
                )
            )
        );

        if (is_array(newshub_mikado_icon_collections()->iconCollections) && count(newshub_mikado_icon_collections()->iconCollections)) {
            //foreach icon collection we need to generate separate container that will have dependency set
            //it will have one field inside with icons dropdown
            foreach (newshub_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
                $icons_array = $collection_object->getIconsArray();

                //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
                $icon_collections_keys = newshub_mikado_icon_collections()->getIconCollectionsKeys();

                //unset current one, because it doesn't have to be included in dependency that hides icon container
                unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

                $side_area_icon_hide_values = $icon_collections_keys;

                $side_area_icon_container = newshub_mikado_add_admin_container(
                    array(
                        'parent' => $side_area_panel,
                        'name' => 'side_area_icon_' . $collection_object->param . '_container',
                        'hidden_property' => 'side_area_button_icon_pack',
                        'hidden_value' => '',
                        'hidden_values' => $side_area_icon_hide_values
                    )
                );

                newshub_mikado_add_admin_field(
                    array(
                        'parent' => $side_area_icon_container,
                        'type' => 'select',
                        'name' => 'side_area_icon_' . $collection_object->param,
                        'default_value' => 'ion-navicon',
                        'label' => esc_html__('Side Area Icon','newshub'),
                        'description' => esc_html__('Choose Side Area Icon','newshub'),
                        'options' => $icons_array,
                    )
                );

            }

        }

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_predefined_icon_size',
                'default_value' => 'large',
                'label' => esc_html__('Predefined Side Area Icon Size','newshub'),
                'description' => esc_html__('Choose predefined size for Side Area icons','newshub'),
                'options' => array(
                    'normal' => esc_html__('Normal', 'newshub'),
                    'medium' => esc_html__('Medium', 'newshub'),
                    'large' => esc_html__('Large', 'newshub')
                ),
            )
        );

        $side_area_icon_style_group = newshub_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'side_area_icon_style_group',
                'title' => esc_html__('Side Area Icon Style','newshub'),
                'description' => esc_html__('Define styles for Side Area icon','newshub')
            )
        );

        $side_area_icon_style_row1 = newshub_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name' => 'side_area_icon_style_row1'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type' => 'colorsimple',
                'name' => 'side_area_icon_color',
                'default_value' => '',
                'label' => esc_html__('Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type' => 'colorsimple',
                'name' => 'side_area_icon_hover_color',
                'default_value' => '',
                'label' => esc_html__('Hover Color','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'selectblank',
                'name' => 'side_area_aligment',
                'default_value' => '',
                'label' => esc_html__('Text Aligment','newshub'),
                'description' => esc_html__('Choose text aligment for side area','newshub'),
                'options' => array(
                    'center' => esc_html__('Center', 'newshub'),
                    'left' => esc_html__('Left', 'newshub'),
                    'right' => esc_html__('Right', 'newshub')
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'text',
                'name' => 'side_area_title',
                'default_value' => '',
                'label' => esc_html__('Side Area Title','newshub'),
                'description' => esc_html__('Enter a title to appear in Side Area','newshub'),
                'args' => array(
                    'col_width' => 3,
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'color',
                'name' => 'side_area_background_color',
                'default_value' => '',
                'label' => esc_html__('Background Color','newshub'),
                'description' => esc_html__('Choose a background color for Side Area','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'select',
                'name' => 'side_area_close_icon',
                'default_value' => 'light',
                'label' => esc_html__('Close Icon Style','newshub'),
                'description' => esc_html__('Choose a type of close icon','newshub'),
                'options' => array(
                    'light' => esc_html__('Light', 'newshub'),
                    'dark' => esc_html__('Dark', 'newshub')
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'text',
                'name' => 'side_area_close_icon_size',
                'default_value' => '',
                'label' => esc_html__('Close Icon Size','newshub'),
                'description' => esc_html__('Define close icon size','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );

        $title_group = newshub_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'title_group',
                'title' => esc_html__('Title','newshub'),
                'description' => esc_html__('Define Style for Side Area title','newshub')
            )
        );

        $title_row_1 = newshub_mikado_add_admin_row(
            array(
                'parent' => $title_group,
                'name' => 'title_row_1',
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_1,
                'type' => 'colorsimple',
                'name' => 'side_area_title_color',
                'default_value' => '',
                'label' => esc_html__('Text Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_1,
                'type' => 'textsimple',
                'name' => 'side_area_title_fontsize',
                'default_value' => '',
                'label' => esc_html__('Font Size','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_1,
                'type' => 'textsimple',
                'name' => 'side_area_title_lineheight',
                'default_value' => '',
                'label' => esc_html__('Line Height','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_1,
                'type' => 'selectblanksimple',
                'name' => 'side_area_title_texttransform',
                'default_value' => '',
                'label' => esc_html__('Text Transform','newshub'),
                'options' => newshub_mikado_get_text_transform_array()
            )
        );

        $title_row_2 = newshub_mikado_add_admin_row(
            array(
                'parent' => $title_group,
                'name' => 'title_row_2',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'fontsimple',
                'name' => 'side_area_title_google_fonts',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_title_fontstyle',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_title_fontweight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $title_row_2,
                'type' => 'textsimple',
                'name' => 'side_area_title_letterspacing',
                'default_value' => '',
                'label' => esc_html__('Letter Spacing','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );


        $text_group = newshub_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'text_group',
                'title' => esc_html__('Text','newshub'),
                'description' => esc_html__('Define Style for Side Area text','newshub')
            )
        );

        $text_row_1 = newshub_mikado_add_admin_row(
            array(
                'parent' => $text_group,
                'name' => 'text_row_1',
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_1,
                'type' => 'colorsimple',
                'name' => 'side_area_text_color',
                'default_value' => '',
                'label' => esc_html__('Text Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_1,
                'type' => 'textsimple',
                'name' => 'side_area_text_fontsize',
                'default_value' => '',
                'label' => esc_html__('Font Size','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_1,
                'type' => 'textsimple',
                'name' => 'side_area_text_lineheight',
                'default_value' => '',
                'label' => esc_html__('Line Height','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_1,
                'type' => 'selectblanksimple',
                'name' => 'side_area_text_texttransform',
                'default_value' => '',
                'label' => esc_html__('Text Transform','newshub'),
                'options' => newshub_mikado_get_text_transform_array()
            )
        );

        $text_row_2 = newshub_mikado_add_admin_row(
            array(
                'parent' => $text_group,
                'name' => 'text_row_2',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'fontsimple',
                'name' => 'side_area_text_google_fonts',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'fontsimple',
                'name' => 'side_area_text_google_fonts',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_text_fontstyle',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'selectblanksimple',
                'name' => 'side_area_text_fontweight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $text_row_2,
                'type' => 'textsimple',
                'name' => 'side_area_text_letterspacing',
                'default_value' => '',
                'label' => esc_html__('Letter Spacing','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        $widget_links_group = newshub_mikado_add_admin_group(
            array(
                'parent' => $side_area_panel,
                'name' => 'widget_links_group',
                'title' => esc_html__('Link Style','newshub'),
                'description' => esc_html__('Define styles for Side Area widget links','newshub')
            )
        );

        $widget_links_row_1 = newshub_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name' => 'widget_links_row_1',
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_1,
                'type' => 'colorsimple',
                'name' => 'sidearea_link_color',
                'default_value' => '',
                'label' => esc_html__('Text Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_1,
                'type' => 'textsimple',
                'name' => 'sidearea_link_font_size',
                'default_value' => '',
                'label' => esc_html__('Font Size','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_1,
                'type' => 'textsimple',
                'name' => 'sidearea_link_line_height',
                'default_value' => '',
                'label' => esc_html__('Line Height','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_1,
                'type' => 'selectblanksimple',
                'name' => 'sidearea_link_text_transform',
                'default_value' => '',
                'label' => esc_html__('Text Transform','newshub'),
                'options' => newshub_mikado_get_text_transform_array()
            )
        );

        $widget_links_row_2 = newshub_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name' => 'widget_links_row_2',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'fontsimple',
                'name' => 'sidearea_link_font_family',
                'default_value' => '-1',
                'label' => esc_html__('Font Family','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'selectblanksimple',
                'name' => 'sidearea_link_font_style',
                'default_value' => '',
                'label' => esc_html__('Font Style','newshub'),
                'options' => newshub_mikado_get_font_style_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'selectblanksimple',
                'name' => 'sidearea_link_font_weight',
                'default_value' => '',
                'label' => esc_html__('Font Weight','newshub'),
                'options' => newshub_mikado_get_font_weight_array()
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_2,
                'type' => 'textsimple',
                'name' => 'sidearea_link_letter_spacing',
                'default_value' => '',
                'label' => esc_html__('Letter Spacing','newshub'),
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        $widget_links_row_3 = newshub_mikado_add_admin_row(
            array(
                'parent' => $widget_links_group,
                'name' => 'widget_links_row_3',
                'next' => true
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $widget_links_row_3,
                'type' => 'colorsimple',
                'name' => 'sidearea_link_hover_color',
                'default_value' => '',
                'label' => esc_html__('Hover Color','newshub'),
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $side_area_panel,
                'type' => 'text',
                'name' => 'sidearea_widget_margin',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'description' => esc_html__('Insert margin for Text Widget','newshub'),
                'args' => array(
                    'col_width' => 3,
                    'suffix' => 'px'
                )
            )
        );


    }

    add_action('newshub_mikado_options_map', 'newshub_mikado_sidearea_options_map', 4);

}