<?php

if (!function_exists('newshub_mikado_blog_options_map')) {

    function newshub_mikado_blog_options_map() {

        newshub_mikado_add_admin_page(
            array(
                'slug' => '_blog_page',
                'title' => esc_html__('Blog','newshub'),
                'icon' => 'fa fa-files-o'
            )
        );

        /**
         * Blog Lists
         */

        $custom_sidebars = newshub_mikado_get_custom_sidebars();

        $panel_blog_lists = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_lists',
                'title' => esc_html__('Blog Lists','newshub')
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_lists,
                'name' => 'templates_title_blog_list',
                'title' => esc_html__('Blog Templates','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_standard_enable',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__('Enable Standard List Options','newshub'),
            'description' => esc_html__('Enabling this option will display options for Standard Blog List','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_panel_blog_standard'
            )
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_enable',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__('Enable Masonry List Options','newshub'),
            'description' => esc_html__('Enabling this option will display options for Masonry Blog List','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_panel_blog_masonry'
            )
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_enable',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__('Enable First Post Featured List Options','newshub'),
            'description' => esc_html__('Enabling this option will display options for First Post Featured blog list','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_panel_blog_featured_with_rest_small'
            )
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_enable',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__('Enable First Post Full Content List Options','newshub'),
            'description' => esc_html__('Enabling this option will display options for First Post Full Content List','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_panel_blog_first_post_full_content'
            )
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_enable',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__('Enable Alternating List Options','newshub'),
            'description' => esc_html__('Enabling this option will display options for Alternating Blog List','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_panel_blog_one_big_two_small'
            )
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_lists,
                'name' => 'archive_title_blog_list',
                'title' => esc_html__('Archive - All Posts','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_type',
            'type' => 'select',
            'label' => esc_html__('Blog Layout for Archive Pages','newshub'),
            'description' => esc_html__('Choose a default blog layout','newshub'),
            'default_value' => 'standard',
            'parent' => $panel_blog_lists,
            'options' => array(
                'standard' => esc_html('Blog: Standard', 'newshub'),
                'standard-whole-post' => esc_html('Blog: Standard Whole Post', 'newshub'),
                'type1' => esc_html('Template 1', 'newshub'),
                'type2' => esc_html('Template 2', 'newshub'),
                'type3' => esc_html('Template 3', 'newshub')
            )
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'archive_sidebar_layout',
            'type' => 'select',
            'label' => esc_html__('Archive Sidebar','newshub'),
            'description' => esc_html__('Choose a sidebar layout for Archive Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => esc_html('No Sidebar', 'newshub'),
                'sidebar-33-right' => esc_html('Sidebar 1/3 Right', 'newshub'),
                'sidebar-25-right' => esc_html('Sidebar 1/4 Right', 'newshub'),
                'sidebar-33-left' => esc_html('Sidebar 1/3 Left', 'newshub'),
                'sidebar-25-left' => esc_html('Sidebar 1/4 Left', 'newshub')
            )
        ));

        if (count($custom_sidebars) > 0) {
            newshub_mikado_add_admin_field(array(
                'name' => 'blog_custom_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__('Archive Sidebar to Display','newshub'),
                'description' => esc_html__('Choose a sidebar to display on Blog Post Lists. Default sidebar is "Sidebar Page"','newshub'),
                'parent' => $panel_blog_lists,
                'options' => newshub_mikado_get_custom_sidebars()
            ));
        }

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'number_of_chars',
                'default_value' => '45',
                'label' => esc_html__('Number of Words in Excerpt','newshub'),
                'parent' => $panel_blog_lists,
                'description' => esc_html__('Enter a number of words in excerpt (article summary)','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'archive_section_title',
            'type' => 'yesno',
            'label' => esc_html__('Show Section Title ("Latest Posts")','newshub'),
            'description' => esc_html__('Enabling this option will show section title for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_lists,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_lists,
                'name' => 'category_title_blog_list',
                'title' => esc_html__('Category','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'unique_category_layout',
            'type' => 'yesno',
            'default_value' => 'yes',
            'label' => esc_html__('Enable Unique Category Layout','newshub'),
            'description' => esc_html__('Enable unique layout for Category Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_mkd_category_unique_layout_container'
            )
        ));

        $category_unique_layout_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'mkd_category_unique_layout_container',
                'hidden_property' => 'unique_category_layout',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $category_unique_layout_container,
                'type' => 'select',
                'name' => 'category_unique_layout',
                'default_value' => 'type1',
                'label' => esc_html__('Category Layout','newshub'),
                'description' => esc_html__('Choose unique layout for Category Blog Post Lists','newshub'),
                'options' => array(
                    'type1' => esc_html('Template 1', 'newshub'),
                    'type2' => esc_html('Template 2', 'newshub'),
                    'type3' => esc_html('Template 3', 'newshub')
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'category_sidebar_layout',
            'type' => 'select',
            'label' => esc_html__('Category Sidebar','newshub'),
            'description' => esc_html__('Choose a sidebar layout for Category Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => esc_html('No Sidebar', 'newshub'),
                'sidebar-33-right' => esc_html('Sidebar 1/3 Right', 'newshub'),
                'sidebar-25-right' => esc_html('Sidebar 1/4 Right', 'newshub'),
                'sidebar-33-left' => esc_html('Sidebar 1/3 Left', 'newshub'),
                'sidebar-25-left' => esc_html('Sidebar 1/4 Left', 'newshub')
            )
        ));

        if (count($custom_sidebars) > 0) {
            newshub_mikado_add_admin_field(array(
                'name' => 'blog_custom_category_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__('Category Sidebar to Display','newshub'),
                'description' => esc_html__('Choose a sidebar to display on Category Blog Lists. Default sidebar is "Sidebar Page"','newshub'),
                'parent' => $panel_blog_lists,
                'options' => newshub_mikado_get_custom_sidebars()
            ));
        }

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_lists,
                'name' => 'author_title_blog_list',
                'title' => esc_html__('Author','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'unique_author_layout',
            'type' => 'yesno',
            'default_value' => 'yes',
            'label' => esc_html__('Enable Unique Author Layout','newshub'),
            'description' => esc_html__('Enable unique layout for Author Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_mkd_author_unique_layout_container'
            )
        ));

        $author_unique_layout_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'mkd_author_unique_layout_container',
                'hidden_property' => 'unique_author_layout',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $author_unique_layout_container,
                'type' => 'select',
                'name' => 'author_unique_layout',
                'default_value' => 'type1',
                'label' => esc_html__('Author Layout','newshub'),
                'description' => esc_html__('Choose unique layout for Author Blog Post Lists','newshub'),
                'options' => array(
                    'type1' => esc_html('Template 1', 'newshub'),
                    'type2' => esc_html('Template 2', 'newshub'),
                    'type3' => esc_html('Template 3', 'newshub'),
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'author_sidebar_layout',
            'type' => 'select',
            'label' => esc_html__('Author Sidebar','newshub'),
            'description' => esc_html__('Choose a sidebar layout for Author Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => 'No Sidebar',
                'sidebar-33-right' => esc_html('Sidebar 1/3 Right', 'newshub'),
                'sidebar-25-right' => esc_html('Sidebar 1/4 Right', 'newshub'),
                'sidebar-33-left' => esc_html('Sidebar 1/3 Left', 'newshub'),
                'sidebar-25-left' => esc_html('Sidebar 1/4 Left', 'newshub'),
            )
        ));

        if (count($custom_sidebars) > 0) {
            newshub_mikado_add_admin_field(array(
                'name' => 'blog_custom_author_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__('Author Sidebar to Display','newshub'),
                'description' => esc_html__('Choose a sidebar to display on Author Blog Lists. Default sidebar is "Sidebar Page"','newshub'),
                'parent' => $panel_blog_lists,
                'options' => newshub_mikado_get_custom_sidebars()
            ));
        }

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_author_info_email',
                'default_value' => 'no',
                'label' => esc_html__('Show Author Email','newshub'),
                'description' => esc_html__('Enabling this option will show author email','newshub'),
                'parent' => $panel_blog_lists,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_lists,
                'name' => 'tag_title_blog_list',
                'title' => esc_html__('Tag','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'unique_tag_layout',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__('Enable Unique Tag Layout','newshub'),
            'description' => esc_html__('Enable unique layout for Tag Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_mkd_tag_unique_layout_container'
            )
        ));

        $tag_unique_layout_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'mkd_tag_unique_layout_container',
                'hidden_property' => 'unique_tag_layout',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $tag_unique_layout_container,
                'type' => 'select',
                'name' => 'tag_unique_layout',
                'default_value' => 'type3',
                'label' => esc_html__('Tag Layout','newshub'),
                'description' => esc_html__('Choose unique layout for Tag Blog Post Lists','newshub'),
                'options' => array(
                    'type1' => esc_html('Template 1', 'newshub'),
                    'type2' => esc_html('Template 2', 'newshub'),
                    'type3' => esc_html('Template 3', 'newshub'),
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'tag_sidebar_layout',
            'type' => 'select',
            'label' => esc_html__('Tag Sidebar','newshub'),
            'default_value' => 'default',
            'description' => esc_html__('Choose a sidebar layout for Tag Blog Post Lists','newshub'),
            'parent' => $panel_blog_lists,
            'options' => array(
                'default' => 'Default',
                'no-sidebar' => 'No Sidebar',
                'sidebar-33-right' => esc_html('Sidebar 1/3 Right', 'newshub'),
                'sidebar-25-right' => esc_html('Sidebar 1/4 Right', 'newshub'),
                'sidebar-33-left' => esc_html('Sidebar 1/3 Left', 'newshub'),
                'sidebar-25-left' => esc_html('Sidebar 1/4 Left', 'newshub')
            )
        ));

        if (count($custom_sidebars) > 0) {
            newshub_mikado_add_admin_field(array(
                'name' => 'blog_custom_tag_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__('Tag Sidebar to Display','newshub'),
                'description' => esc_html__('Choose a sidebar to display on Tag Blog Lists. Default sidebar is "Sidebar Page"','newshub'),
                'parent' => $panel_blog_lists,
                'options' => newshub_mikado_get_custom_sidebars()
            ));
        }

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_lists,
                'name' => 'rest_title_blog_list',
                'title' => esc_html__('Other','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'pagination',
                'default_value' => 'yes',
                'label' => esc_html__('Pagination','newshub'),
                'parent' => $panel_blog_lists,
                'description' => esc_html__('Enabling this option will display pagination links on bottom of Blog Post List','newshub'),
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_pagination_container'
                )
            )
        );

        $pagination_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'mkd_pagination_container',
                'hidden_property' => 'pagination',
                'hidden_value' => 'no',
                'parent' => $panel_blog_lists,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'parent' => $pagination_container,
                'type' => 'text',
                'name' => 'blog_page_range',
                'default_value' => '',
                'label' => esc_html__('Pagination Range limit','newshub'),
                'description' => esc_html__('Enter a number that will limit pagination to a certain range of links','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        /* standard options */

        $panel_blog_standard = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_standard',
                'title' => esc_html__('Blog Standard','newshub'),
                'hidden_property' => 'blog_list_standard_enable',
                'hidden_value' => 'no',
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_section_title',
            'type' => 'yesno',
            'label' => esc_html__('Show Section Title ("Latest Posts")','newshub'),
            'description' => esc_html__('Enabling this option will show section title for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_standard_number_of_chars',
                'default_value' => '45',
                'label' => esc_html__('Number of Words in Excerpt','newshub'),
                'parent' => $panel_blog_standard,
                'description' => esc_html__('Enter a number of words in excerpt (article summary)','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        $group_blog_list_standard_excerpt_margin = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_standard_excerpt_margin',
            'title' => esc_html__('Excerpt Margin','newshub'),
            'description' => esc_html__('Enter margins styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_standard
        ));

        $row_blog_list_standard_excerpt_margin_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_excerpt_margin_1',
            'parent' => $group_blog_list_standard_excerpt_margin
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_standard_excerpt_margin_top',
                'default_value' => '',
                'label' => esc_html__('Margin Top','newshub'),
                'parent' => $row_blog_list_standard_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_standard_excerpt_margin_bottom',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'parent' => $row_blog_list_standard_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_feature_image',
            'type' => 'yesno',
            'label' => esc_html__('Show Featured Image','newshub'),
            'description' => esc_html__('Enabling this option will show featured image for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_blog_list_feature_image_container'
            )
        ));

        $blog_list_feature_image_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'blog_list_feature_image_container',
                'hidden_property' => 'blog_list_feature_image',
                'hidden_value' => 'no',
                'parent' => $panel_blog_standard,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_feature_image_max_width',
                'default_value' => '',
                'label' => esc_html__('Featured Image Max Width','newshub'),
                'parent' => $blog_list_feature_image_container,
                'description' => esc_html__('Define maximum width for featured images on your blog page. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_standard,
                'name' => 'post_info_title_blog_list_masonry',
                'title' => esc_html__('Post Info','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'blog_list_horizontal_content_centering',
            'default_value' => 'no',
            'label' => esc_html__('Horizontal Centering Content','newshub'),
            'parent' => $panel_blog_standard
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_category',
            'type' => 'yesno',
            'label' => esc_html__('Show Category','newshub'),
            'description' => esc_html__('Enabling this option will show category post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'yes'
        ));


        $group_blog_list_title = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_title',
            'title' => esc_html__('Post Title Style','newshub'),
            'description' => esc_html__('Define styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_standard
        ));

        $row_blog_list_title_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_title_1',
            'parent' => $group_blog_list_title
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_title_tag',
            'default_value' => 'h3',
            'label' => esc_html__('Title Tag 1','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_title_length',
                'default_value' => '',
                'label' => esc_html__('Number of Words in First Title','newshub'),
                'parent' => $row_blog_list_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_separator',
            'type' => 'yesno',
            'label' => esc_html__('Show Separator','newshub'),
            'description' => esc_html__('Enabling this option will show separator post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'no',
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_date',
            'type' => 'yesno',
            'label' => esc_html__('Show Date','newshub'),
            'description' => esc_html__('Enabling this option will show date post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_author',
            'type' => 'yesno',
            'label' => esc_html__('Show Author','newshub'),
            'description' => esc_html__('Enabling this option will show author post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_comment',
            'type' => 'yesno',
            'label' => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_like',
            'type' => 'yesno',
            'label' => esc_html__('Show Like','newshub'),
            'description' => esc_html__('Enabling this option will show like post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_count',
            'type' => 'yesno',
            'label' => esc_html__('Show Count','newshub'),
            'description' => esc_html__('Enabling this option will show count post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'no'
        ));


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_share',
            'type' => 'yesno',
            'label' => esc_html__('Show Share','newshub'),
            'description' => esc_html__('Enabling this option will show share post info on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_read_more',
            'type' => 'yesno',
            'label' => esc_html__('Show Read More','newshub'),
            'description' => esc_html__('Enabling this option will show read more button on your blog page.','newshub'),
            'parent' => $panel_blog_standard,
            'default_value' => 'no'
        ));

        /* masonry options */

        $panel_blog_masonry = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_masonry',
                'title' => esc_html__('Blog Masonry','newshub'),
                'hidden_property' => 'blog_list_masonry_enable',
                'hidden_value' => 'no'
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_column',
            'type' => 'select',
            'label' => esc_html__('Number of Columns','newshub'),
            'description' => esc_html__('Choose number of columns for Blog Masonry','newshub'),
            'parent' => $panel_blog_masonry,
            'options' => array(
                'one' => esc_html('One', 'newshub'),
                'two' => esc_html('Two', 'newshub'),
                'three' => esc_html('Three', 'newshub'),
                'four' => esc_html('Four', 'newshub')
            ),
            'default_value' => 'column-3'
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_masonry_number_of_chars',
                'default_value' => '45',
                'label' => esc_html__('Number of Words in Excerpt','newshub'),
                'parent' => $panel_blog_masonry,
                'description' => esc_html__('Enter a number of words in excerpt (article summary)','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );


        $group_blog_list_masonry_excerpt_margin = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_masonry_excerpt_margin',
            'title' => esc_html__('Excerpt Margin','newshub'),
            'description' => esc_html__('Enter margins styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_masonry
        ));

        $row_blog_list_masonry_excerpt_margin_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_excerpt_margin_1',
            'parent' => $group_blog_list_masonry_excerpt_margin
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_masonry_excerpt_margin_top',
                'default_value' => '',
                'label' => esc_html__('Margin Top','newshub'),
                'parent' => $row_blog_list_masonry_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_masonry_excerpt_margin_bottom',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'parent' => $row_blog_list_masonry_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_section_title',
            'type' => 'yesno',
            'label' => esc_html__('Show Section Title ("Latest Posts")','newshub'),
            'description' => esc_html__('Enabling this option will show section title for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_feature_image',
            'type' => 'yesno',
            'label' => esc_html__('Show Featured Image','newshub'),
            'description' => esc_html__('Enabling this option will show featured image for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_blog_list_masonry_feature_image_container'
            )
        ));

        $blog_list_masonry_feature_image_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'blog_list_masonry_feature_image_container',
                'hidden_property' => 'blog_list_masonry_feature_image',
                'hidden_value' => 'no',
                'parent' => $panel_blog_masonry,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_masonry_feature_image_max_width',
                'default_value' => '',
                'label' => esc_html__('Featured Image Max Width','newshub'),
                'parent' => $blog_list_masonry_feature_image_container,
                'description' => esc_html__('Define maximum width for featured images on your blog page. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_masonry,
                'name' => 'post_info_title_blog_list_masonry',
                'title' => esc_html__('Post Info','newshub')
            )
        );


        newshub_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'blog_list_masonry_horizontal_content_centering',
            'default_value' => 'no',
            'label' => esc_html__('Horizontal Centering Content','newshub'),
            'parent' => $panel_blog_masonry
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_category',
            'type' => 'yesno',
            'label' => esc_html__('Show Category','newshub'),
            'description' => esc_html__('Enabling this option will show category post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'yes'
        ));


        $group_blog_list_masonry_title = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_masonry_title',
            'title' => esc_html__('Post Title Style','newshub'),
            'description' => esc_html__('Define styles for post info title separator on post lists','newshub'),
            'parent' => $panel_blog_masonry
        ));

        $row_blog_list_masonry_title_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_masonry_title_1',
            'parent' => $group_blog_list_masonry_title
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_masonry_title_tag',
            'default_value' => 'h3',
            'label' => esc_html__('Title Tag 1','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_masonry_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_masonry_title_length',
                'default_value' => '',
                'label' => esc_html__('Number of Words in First Title','newshub'),
                'parent' => $row_blog_list_masonry_title_1,
            )
        );


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_separator',
            'type' => 'yesno',
            'label' => esc_html__('Show Separator','newshub'),
            'description' => esc_html__('Enabling this option will show separator post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_date',
            'type' => 'yesno',
            'label' => esc_html__('Show Date','newshub'),
            'description' => esc_html__('Enabling this option will show date post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_author',
            'type' => 'yesno',
            'label' => esc_html__('Show Author','newshub'),
            'description' => esc_html__('Enabling this option will show author post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_comment',
            'type' => 'yesno',
            'label' => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_like',
            'type' => 'yesno',
            'label' => esc_html__('Show Like','newshub'),
            'description' => esc_html__('Enabling this option will show like post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_count',
            'type' => 'yesno',
            'label' => esc_html__('Show Count','newshub'),
            'description' => esc_html__('Enabling this option will show count post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'no'
        ));


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_share',
            'type' => 'yesno',
            'label' => esc_html__('Show Share','newshub'),
            'description' => esc_html__('Enabling this option will show share post info on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_masonry_read_more',
            'type' => 'yesno',
            'label' => esc_html__('Show Read More','newshub'),
            'description' => esc_html__('Enabling this option will show read more button on your blog page.','newshub'),
            'parent' => $panel_blog_masonry,
            'default_value' => 'no'
        ));

        /* blog-featured-with-rest-small options */

        $panel_blog_featured_with_rest_small = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_featured_with_rest_small',
                'title' => esc_html__('Blog First Post Featured','newshub'),
                'hidden_property' => 'blog_list_featured_with_rest_small_enable',
                'hidden_value' => 'no'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_featured_with_rest_small_number_of_chars',
                'default_value' => '45',
                'label' => esc_html__('Number of Words in Excerpt','newshub'),
                'parent' => $panel_blog_featured_with_rest_small,
                'description' => esc_html__('Enter a number of words in excerpt (article summary)','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        $group_blog_list_featured_with_rest_small_excerpt_margin = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_featured_with_rest_small_excerpt_margin',
            'title' => esc_html__('Excerpt Margin','newshub'),
            'description' => esc_html__('Enter margins styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_featured_with_rest_small
        ));

        $row_blog_list_featured_with_rest_small_excerpt_margin_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_excerpt_margin_1',
            'parent' => $group_blog_list_featured_with_rest_small_excerpt_margin
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_featured_with_rest_small_excerpt_margin_top',
                'default_value' => '',
                'label' => esc_html__('Margin Top','newshub'),
                'parent' => $row_blog_list_featured_with_rest_small_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_featured_with_rest_small_excerpt_margin_bottom',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'parent' => $row_blog_list_featured_with_rest_small_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_section_title',
            'type' => 'yesno',
            'label' => esc_html__('Show Section Title ("Latest Posts")','newshub'),
            'description' => esc_html__('Enabling this option will show section title for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_feature_image',
            'type' => 'yesno',
            'label' => esc_html__('Show Featured Image','newshub'),
            'description' => esc_html__('Enabling this option will show featured image for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_blog_list_featured_with_rest_small_feature_image_container'
            )
        ));

        $blog_list_featured_with_rest_small_feature_image_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'blog_list_featured_with_rest_small_feature_image_container',
                'hidden_property' => 'blog_list_featured_with_rest_small_feature_image',
                'hidden_value' => 'no',
                'parent' => $panel_blog_featured_with_rest_small,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_featured_with_rest_small_feature_image_max_width',
                'default_value' => '',
                'label' => esc_html__('Featured Image Max Width','newshub'),
                'parent' => $blog_list_featured_with_rest_small_feature_image_container,
                'description' => esc_html__('Define maximum width for featured images on your blog page. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_featured_with_rest_small,
                'name' => 'post_info_title_blog_list_featured_with_rest_small',
                'title' => esc_html__('Post Info','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'blog_list_featured_with_rest_small_horizontal_content_centering',
            'default_value' => 'no',
            'label' => esc_html__('Horizontal Centering Content','newshub'),
            'parent' => $panel_blog_featured_with_rest_small
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_category',
            'type' => 'yesno',
            'label' => esc_html__('Show Category','newshub'),
            'description' => esc_html__('Enabling this option will show category post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'yes'
        ));


        $group_blog_list_featured_with_rest_small_title = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_featured_with_rest_small_title',
            'title' => esc_html__('Post Title Style','newshub'),
            'description' => esc_html__('Define styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_featured_with_rest_small
        ));

        $row_blog_list_featured_with_rest_small_title_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_featured_with_rest_small_title_1',
            'parent' => $group_blog_list_featured_with_rest_small_title
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_featured_with_rest_small_title_tag',
            'default_value' => 'h3',
            'label' => esc_html__('Title Tag 1','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_featured_with_rest_small_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_featured_with_rest_small_title_length',
                'default_value' => '',
                'label' => esc_html__('Number of Words in First Title','newshub'),
                'parent' => $row_blog_list_featured_with_rest_small_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_featured_with_rest_small_title_tag_second',
            'default_value' => 'h4',
            'label' => esc_html__('Title Tag 2','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_featured_with_rest_small_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_featured_with_rest_small_title_length_second',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Second Title','newshub'),
                'parent' => $row_blog_list_featured_with_rest_small_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_separator',
            'type' => 'yesno',
            'label' => esc_html__('Show Separator','newshub'),
            'description' => esc_html__('Enabling this option will show separator post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_date',
            'type' => 'yesno',
            'label' => esc_html__('Show Date','newshub'),
            'description' => esc_html__('Enabling this option will show date post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_author',
            'type' => 'yesno',
            'label' => esc_html__('Show Author','newshub'),
            'description' => esc_html__('Enabling this option will show author post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_comment',
            'type' => 'yesno',
            'label' => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_like',
            'type' => 'yesno',
            'label' => esc_html__('Show Like','newshub'),
            'description' => esc_html__('Enabling this option will show like post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_count',
            'type' => 'yesno',
            'label' => esc_html__('Show Count','newshub'),
            'description' => esc_html__('Enabling this option will show count post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'no'
        ));


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_share',
            'type' => 'yesno',
            'label' => esc_html__('Show Share','newshub'),
            'description' => esc_html__('Enabling this option will show share post info on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_featured_with_rest_small_read_more',
            'type' => 'yesno',
            'label' => esc_html__('Show Read More','newshub'),
            'description' => esc_html__('Enabling this option will show read more button on your blog page.','newshub'),
            'parent' => $panel_blog_featured_with_rest_small,
            'default_value' => 'no'
        ));

        /* blog-first-post-full-content options */

        $panel_blog_first_post_full_content = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_first_post_full_content',
                'title' => esc_html__('Blog First Post Full Content','newshub'),
                'hidden_property' => 'blog_list_first_post_full_content_enable',
                'hidden_value' => 'no'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_first_post_full_content_number_of_chars',
                'default_value' => '45',
                'label' => esc_html__('Number of Words in Excerpt','newshub'),
                'parent' => $panel_blog_first_post_full_content,
                'description' => esc_html__('Enter a number of words in excerpt (article summary)','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        $group_blog_list_first_post_full_content_excerpt_margin = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_first_post_full_content_excerpt_margin',
            'title' => esc_html__('Excerpt Margin','newshub'),
            'description' => esc_html__('Enter margins styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_first_post_full_content
        ));

        $row_blog_list_first_post_full_content_excerpt_margin_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_excerpt_margin_1',
            'parent' => $group_blog_list_first_post_full_content_excerpt_margin
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_first_post_full_content_excerpt_margin_top',
                'default_value' => '',
                'label' => esc_html__('Margin Top','newshub'),
                'parent' => $row_blog_list_first_post_full_content_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_first_post_full_content_excerpt_margin_bottom',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'parent' => $row_blog_list_first_post_full_content_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_section_title',
            'type' => 'yesno',
            'label' => esc_html__('Show Section Title ("Latest Posts")','newshub'),
            'description' => esc_html__('Enabling this option will show section title for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_feature_image',
            'type' => 'yesno',
            'label' => esc_html__('Show Featured Image','newshub'),
            'description' => esc_html__('Enabling this option will show featured image for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_blog_list_first_post_full_content_feature_image_container'
            )
        ));

        $blog_list_first_post_full_content_feature_image_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'blog_list_first_post_full_content_feature_image_container',
                'hidden_property' => 'blog_list_first_post_full_content_feature_image',
                'hidden_value' => 'no',
                'parent' => $panel_blog_first_post_full_content,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_first_post_full_content_feature_image_max_width',
                'default_value' => '',
                'label' => esc_html__('Featured Image Max Width','newshub'),
                'parent' => $blog_list_first_post_full_content_feature_image_container,
                'description' => esc_html__('Define maximum width for featured images on your blog page. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        /* blog-first-post-full-content options */

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_first_post_full_content,
                'name' => 'post_info_title_blog_list_first_post_full_content',
                'title' => esc_html__('Post Info','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'blog_list_first_post_full_content_horizontal_content_centering',
            'default_value' => 'no',
            'label' => esc_html__('Horizontal Centering Content','newshub'),
            'parent' => $panel_blog_first_post_full_content
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_category',
            'type' => 'yesno',
            'label' => esc_html__('Show Category','newshub'),
            'description' => esc_html__('Enabling this option will show category post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'yes'
        ));


        $group_blog_list_first_post_full_content_title = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_first_post_full_content_title',
            'title' => esc_html__('Post Title Style','newshub'),
            'description' => esc_html__('Define styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_first_post_full_content
        ));

        $row_blog_list_first_post_full_content_title_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_first_post_full_content_title_1',
            'parent' => $group_blog_list_first_post_full_content_title
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_first_post_full_content_title_tag',
            'default_value' => 'h3',
            'label' => esc_html__('Title Tag 1','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_first_post_full_content_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_first_post_full_content_title_length',
                'default_value' => '',
                'label' => esc_html__('Number of Words in First Title','newshub'),
                'parent' => $row_blog_list_first_post_full_content_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_first_post_full_content_title_tag_second',
            'default_value' => 'h4',
            'label' => esc_html__('Title Tag 2','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_first_post_full_content_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_first_post_full_content_title_length',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Second Title','newshub'),
                'parent' => $row_blog_list_first_post_full_content_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_separator',
            'type' => 'yesno',
            'label' => esc_html__('Show Separator','newshub'),
            'description' => esc_html__('Enabling this option will show separator post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'no',

        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_date',
            'type' => 'yesno',
            'label' => esc_html__('Show Date','newshub'),
            'description' => esc_html__('Enabling this option will show date post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_author',
            'type' => 'yesno',
            'label' => esc_html__('Show Author','newshub'),
            'description' => esc_html__('Enabling this option will show author post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_comment',
            'type' => 'yesno',
            'label' => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_like',
            'type' => 'yesno',
            'label' => esc_html__('Show Like','newshub'),
            'description' => esc_html__('Enabling this option will show like post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_count',
            'type' => 'yesno',
            'label' => esc_html__('Show Count','newshub'),
            'description' => esc_html__('Enabling this option will show count post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'no'
        ));


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_share',
            'type' => 'yesno',
            'label' => esc_html__('Show Share','newshub'),
            'description' => esc_html__('Enabling this option will show share post info on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_first_post_full_content_read_more',
            'type' => 'yesno',
            'label' => esc_html__('Show Read More','newshub'),
            'description' => esc_html__('Enabling this option will show read more button on your blog page.','newshub'),
            'parent' => $panel_blog_first_post_full_content,
            'default_value' => 'no'
        ));

        /* blog-one-big-two-small options */

        $panel_blog_one_big_two_small = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_one_big_two_small',
                'title' => esc_html__('Blog Alternating','newshub'),
                'hidden_property' => 'blog_list_one_big_two_small_enable',
                'hidden_value' => 'no'
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_one_big_two_small_number_of_chars',
                'default_value' => '45',
                'label' => esc_html__('Number of Words in Excerpt','newshub'),
                'parent' => $panel_blog_one_big_two_small,
                'description' => esc_html__('Enter a number of words in excerpt (article summary)','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        $group_blog_list_one_big_two_small_excerpt_margin = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_one_big_two_small_excerpt_margin',
            'title' => esc_html__('Excerpt Margin','newshub'),
            'description' => esc_html__('Enter margins styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_one_big_two_small
        ));

        $row_blog_list_one_big_two_small_excerpt_margin_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_excerpt_margin_1',
            'parent' => $group_blog_list_one_big_two_small_excerpt_margin
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_one_big_two_small_excerpt_margin_top',
                'default_value' => '',
                'label' => esc_html__('Margin Top','newshub'),
                'parent' => $row_blog_list_one_big_two_small_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_one_big_two_small_excerpt_margin_bottom',
                'default_value' => '',
                'label' => esc_html__('Margin Bottom','newshub'),
                'parent' => $row_blog_list_one_big_two_small_excerpt_margin_1,
                'args'			=> array(
                    'suffix'	=> 'px'
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_section_title',
            'type' => 'yesno',
            'label' => esc_html__('Show Section Title ("Latest Posts")','newshub'),
            'description' => esc_html__('Enabling this option will show section title for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_feature_image',
            'type' => 'yesno',
            'label' => esc_html__('Show Featured Image','newshub'),
            'description' => esc_html__('Enabling this option will show featured image for your posts on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_blog_list_one_big_two_small_feature_image_container'
            )
        ));

        $blog_list_one_big_two_small_feature_image_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'blog_list_one_big_two_small_feature_image_container',
                'hidden_property' => 'blog_list_one_big_two_small_feature_image',
                'hidden_value' => 'no',
                'parent' => $panel_blog_one_big_two_small,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_list_one_big_two_small_feature_image_max_width',
                'default_value' => '',
                'label' => esc_html__('Featured Image Max Width','newshub'),
                'parent' => $blog_list_one_big_two_small_feature_image_container,
                'description' => esc_html__('Define maximum width for featured images on your blog page. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_one_big_two_small,
                'name' => 'post_info_title_blog_list_one_big_two_small',
                'title' => esc_html__('Post Info','newshub')
            )
        );


        newshub_mikado_add_admin_field(array(
            'type' => 'yesno',
            'name' => 'blog_list_one_big_two_small_horizontal_content_centering',
            'default_value' => 'no',
            'label' => esc_html__('Horizontal Centering Content','newshub'),
            'parent' => $panel_blog_one_big_two_small
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_category',
            'type' => 'yesno',
            'label' => esc_html__('Show Category','newshub'),
            'description' => esc_html__('Enabling this option will show category post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'yes'
        ));


        $group_blog_list_one_big_two_small_title = newshub_mikado_add_admin_group(array(
            'name' => 'group_blog_list_one_big_two_small_title',
            'title' => esc_html__('Post Title Style','newshub'),
            'description' => esc_html__('Define styles for post info title on post lists','newshub'),
            'parent' => $panel_blog_one_big_two_small
        ));

        $row_blog_list_one_big_two_small_title_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_blog_list_one_big_two_small_title_1',
            'parent' => $group_blog_list_one_big_two_small_title
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_one_big_two_small_title_tag',
            'default_value' => 'h3',
            'label' => esc_html__('Title Tag 1','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_one_big_two_small_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_one_big_two_small_title_length',
                'default_value' => '',
                'label' => esc_html__('Number of Words in First Title','newshub'),
                'parent' => $row_blog_list_one_big_two_small_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'type' => 'selectsimple',
            'name' => 'blog_list_one_big_two_small_title_tag_second',
            'default_value' => 'h4',
            'label' => esc_html__('Title Tag 2','newshub'),
            'options' => array(
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ),
            'parent' => $row_blog_list_one_big_two_small_title_1
        ));

        newshub_mikado_add_admin_field(
            array(
                'type' => 'textsimple',
                'name' => 'blog_list_one_big_two_small_title_length_second',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Second Title','newshub'),
                'parent' => $row_blog_list_one_big_two_small_title_1,
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_separator',
            'type' => 'yesno',
            'label' => esc_html__('Show Separator','newshub'),
            'description' => esc_html__('Enabling this option will show separator post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'no',
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_date',
            'type' => 'yesno',
            'label' => esc_html__('Show Date','newshub'),
            'description' => esc_html__('Enabling this option will show date post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_author',
            'type' => 'yesno',
            'label' => esc_html__('Show Author','newshub'),
            'description' => esc_html__('Enabling this option will show author post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_comment',
            'type' => 'yesno',
            'label' => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_like',
            'type' => 'yesno',
            'label' => esc_html__('Show Like','newshub'),
            'description' => esc_html__('Enabling this option will show like post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'no'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_count',
            'type' => 'yesno',
            'label' => esc_html__('Show Count','newshub'),
            'description' => esc_html__('Enabling this option will show count post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'no'
        ));


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_share',
            'type' => 'yesno',
            'label' => esc_html__('Show Share','newshub'),
            'description' => esc_html__('Enabling this option will show share post info on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_list_one_big_two_small_read_more',
            'type' => 'yesno',
            'label' => esc_html__('Show Read More','newshub'),
            'description' => esc_html__('Enabling this option will show read more button on your blog page.','newshub'),
            'parent' => $panel_blog_one_big_two_small,
            'default_value' => 'no'
        ));


        /**
         * Blog Layout and Block
         */
        $panel_blog_block_layout = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_layout_block',
                'title' => esc_html__('Blog Layout and Block','newshub')
            )
        );

        //Post Info

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_block_layout,
                'name' => 'post_info_title_blog_block_layout',
                'title' => esc_html__('Post Info','newshub')
            )
        );

        $group_heading_post_info = newshub_mikado_add_admin_group(array(
            'name' => 'group_heading_post_info',
            'title' => esc_html__('Post Info Style','newshub'),
            'description' => esc_html__('Define styles for post info on post lists','newshub'),
            'parent' => $panel_blog_block_layout
        ));

        $row_heading_blog_list_post_info_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_list_post_info_1',
            'parent' => $group_heading_post_info
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'blog_list_post_info_color',
            'default_value' => '',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row_heading_blog_list_post_info_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_fontsize',
            'default_value' => '',
            'label' => esc_html__('Font Size','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_lineheight',
            'default_value' => '',
            'label' => esc_html__('Line Height','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_list_post_info_texttransform',
            'default_value' => '',
            'label' => esc_html__('Text Transform','newshub'),
            'options' => newshub_mikado_get_text_transform_array(),
            'parent' => $row_heading_blog_list_post_info_1
        ));

        $row_heading_blog_list_post_info_2 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_list_post_info_2',
            'parent' => $group_heading_post_info,
            'next' => true
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'fontsimple',
            'name' => 'blog_list_post_info_google_fonts',
            'default_value' => '-1',
            'label' => esc_html__('Font Family','newshub'),
            'parent' => $row_heading_blog_list_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_list_post_info_fontstyle',
            'default_value' => '',
            'label' => esc_html__('Font Style','newshub'),
            'options' => newshub_mikado_get_font_style_array(),
            'parent' => $row_heading_blog_list_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_list_post_info_fontweight',
            'default_value' => '',
            'label' => esc_html__('Font Weight','newshub'),
            'options' => newshub_mikado_get_font_weight_array(),
            'parent' => $row_heading_blog_list_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_letterspacing',
            'default_value' => '',
            'label' => esc_html__('Letter Spacing','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_padding_top',
            'default_value' => '',
            'label' => esc_html__('Top padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_padding_bottom',
            'default_value' => '',
            'label' => esc_html__('Bottom padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_2
        ));

        //Post Category

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_block_layout,
                'name' => 'post_info_category_title_blog_block_layout',
                'title' => esc_html__('Category','newshub')
            )
        );

        $group_heading_post_info_category = newshub_mikado_add_admin_group(array(
            'name' => 'group_heading_post_info_category',
            'title' => esc_html__('Post Info Category Style','newshub'),
            'description' => esc_html__('Define styles for post info category on post lists','newshub'),
            'parent' => $panel_blog_block_layout
        ));

        $row_heading_blog_list_post_info_category_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_list_post_info_category_1',
            'parent' => $group_heading_post_info_category
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'blog_list_post_info_category_color',
            'default_value' => '',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row_heading_blog_list_post_info_category_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_category_fontsize',
            'default_value' => '',
            'label' => esc_html__('Font Size','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_category_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_category_lineheight',
            'default_value' => '',
            'label' => esc_html__('Line Height','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_category_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_list_post_info_category_texttransform',
            'default_value' => '',
            'label' => esc_html__('Text Transform','newshub'),
            'options' => newshub_mikado_get_text_transform_array(),
            'parent' => $row_heading_blog_list_post_info_category_1
        ));

        $row_heading_blog_list_post_info_category_2 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_list_post_info_category_2',
            'parent' => $group_heading_post_info_category,
            'next' => true
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'fontsimple',
            'name' => 'blog_list_post_info_category_google_fonts',
            'default_value' => '-1',
            'label' => esc_html__('Font Family','newshub'),
            'parent' => $row_heading_blog_list_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_list_post_info_category_fontstyle',
            'default_value' => '',
            'label' => esc_html__('Font Style','newshub'),
            'options' => newshub_mikado_get_font_style_array(),
            'parent' => $row_heading_blog_list_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_list_post_info_category_fontweight',
            'default_value' => '',
            'label' => esc_html__('Font Weight','newshub'),
            'options' => newshub_mikado_get_font_weight_array(),
            'parent' => $row_heading_blog_list_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_category_letterspacing',
            'default_value' => '',
            'label' => esc_html__('Letter Spacing','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_category_padding_top',
            'default_value' => '',
            'label' => esc_html__('Top Padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_list_post_info_category_padding_bottom',
            'default_value' => '',
            'label' => esc_html__('Bottom Padding','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_list_post_info_category_2
        ));


        /**
         * Blog Single
         */
        $panel_blog_single = newshub_mikado_add_admin_panel(
            array(
                'page' => '_blog_page',
                'name' => 'panel_blog_single',
                'title' => esc_html__('Blog Single','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_sidebar_layout',
            'type' => 'select',
            'label' => esc_html__('Sidebar Layout','newshub'),
            'description' => esc_html__('Choose a sidebar layout for Blog Single pages','newshub'),
            'parent' => $panel_blog_single,
            'options' => array(
                'default' => esc_html('No Sidebar', 'newshub'),
                'sidebar-33-right' => esc_html('Sidebar 1/3 Right', 'newshub'),
                'sidebar-25-right' => esc_html('Sidebar 1/4 Right', 'newshub'),
                'sidebar-33-left' => esc_html('Sidebar 1/3 Left', 'newshub'),
                'sidebar-25-left' => esc_html('Sidebar 1/4 Left', 'newshub')
            ),
            'default_value' => 'default'
        ));


        if (count($custom_sidebars) > 0) {
            newshub_mikado_add_admin_field(array(
                'name' => 'blog_single_custom_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display','newshub'),
                'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"','newshub'),
                'parent' => $panel_blog_single,
                'options' => newshub_mikado_get_custom_sidebars()
            ));
        }

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_single_feature_image_max_width',
                'default_value' => '',
                'label' => esc_html__('Featured Image Max Width','newshub'),
                'parent' => $panel_blog_single,
                'description' => esc_html__('Define maximum width for featured image on single post pages. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_title_in_title_area',
            'type' => 'yesno',
            'label' => esc_html__('Show Post Title in Title Area','newshub'),
            'description' => esc_html__('Enabling this option will show post title in title area on single post pages','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'no'
        ));

        //Post Info
        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_single,
                'name' => 'post_info_title_blog_single',
                'title' => esc_html__('Post Info','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_date',
            'type' => 'yesno',
            'label' => esc_html__('Show Date','newshub'),
            'description' => esc_html__('Enabling this option will show date post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_author',
            'type' => 'yesno',
            'label' => esc_html__('Show Author','newshub'),
            'description' => esc_html__('Enabling this option will show author post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_comment',
            'type' => 'yesno',
            'label' => esc_html__('Show Comments','newshub'),
            'description' => esc_html__('Enabling this option will show comments post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_like',
            'type' => 'yesno',
            'label' => esc_html__('Show Like','newshub'),
            'description' => esc_html__('Enabling this option will show like post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_count',
            'type' => 'yesno',
            'label' => esc_html__('Show Post Count','newshub'),
            'description' => esc_html__('Enabling this option will show count post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_ratings',
            'type' => 'yesno',
            'label' => esc_html__('Show Post Ratings','newshub'),
            'description' => esc_html__('Enabling this option will enable user to rate post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_share',
            'type' => 'yesno',
            'label' => esc_html__('Show Share','newshub'),
            'description' => esc_html__('Enabling this option will show share post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_tags',
            'type' => 'yesno',
            'label' => esc_html__('Show Tags','newshub'),
            'description' => esc_html__('Enabling this option will show post tags on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes'
        ));

        $group_heading_post_info = newshub_mikado_add_admin_group(array(
            'name' => 'group_heading_post_info',
            'title' => esc_html__('Post Info Style','newshub'),
            'description' => esc_html__('Define styles for post info on single post pages','newshub'),
            'parent' => $panel_blog_single
        ));

        $row_heading_blog_single_post_info_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_single_post_info_1',
            'parent' => $group_heading_post_info
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'blog_single_post_info_color',
            'default_value' => '',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row_heading_blog_single_post_info_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_single_post_info_fontsize',
            'default_value' => '',
            'label' => esc_html__('Font Size','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_single_post_info_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_single_post_info_lineheight',
            'default_value' => '',
            'label' => esc_html__('Line Height','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_single_post_info_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_single_post_info_texttransform',
            'default_value' => '',
            'label' => esc_html__('Text Transform','newshub'),
            'options' => newshub_mikado_get_text_transform_array(),
            'parent' => $row_heading_blog_single_post_info_1
        ));

        $row_heading_blog_single_post_info_2 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_single_post_info_2',
            'parent' => $group_heading_post_info,
            'next' => true
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'fontsimple',
            'name' => 'blog_single_post_info_google_fonts',
            'default_value' => '-1',
            'label' => esc_html__('Font Family','newshub'),
            'parent' => $row_heading_blog_single_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_single_post_info_fontstyle',
            'default_value' => '',
            'label' => esc_html__('Font Style','newshub'),
            'options' => newshub_mikado_get_font_style_array(),
            'parent' => $row_heading_blog_single_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_single_post_info_fontweight',
            'default_value' => '',
            'label' => esc_html__('Font Weight','newshub'),
            'options' => newshub_mikado_get_font_weight_array(),
            'parent' => $row_heading_blog_single_post_info_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_single_post_info_letterspacing',
            'default_value' => '',
            'label' => esc_html__('Letter Spacing','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_single_post_info_2
        ));

        //Post Info Category

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_single,
                'name' => 'post_info_category_title_blog_single',
                'title' => esc_html__('Category','newshub')
            )
        );


        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_category',
            'type' => 'yesno',
            'label' => esc_html__('Show Category','newshub'),
            'description' => esc_html__('Enabling this option will show category post info on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_blog_single_category_container'
            )
        ));

        $blog_single_category_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'blog_single_category_container',
                'hidden_property' => 'blog_single_category',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );


        $group_heading_post_info_category = newshub_mikado_add_admin_group(array(
            'name' => 'group_heading_post_info_category',
            'title' => esc_html__('Post Info Category','newshub'),
            'description' => esc_html__('Define styles for post info category on single post pages','newshub'),
            'parent' => $blog_single_category_container
        ));

        $row_heading_blog_single_post_info_category_1 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_single_post_info_category_1',
            'parent' => $group_heading_post_info_category
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'colorsimple',
            'name' => 'blog_single_post_info_category_color',
            'default_value' => '',
            'label' => esc_html__('Text Color','newshub'),
            'parent' => $row_heading_blog_single_post_info_category_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_single_post_info_category_fontsize',
            'default_value' => '',
            'label' => esc_html__('Font Size','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_single_post_info_category_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_single_post_info_category_lineheight',
            'default_value' => '',
            'label' => esc_html__('Line Height','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_single_post_info_category_1
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_single_post_info_category_texttransform',
            'default_value' => '',
            'label' => esc_html__('Text Transform','newshub'),
            'options' => newshub_mikado_get_text_transform_array(),
            'parent' => $row_heading_blog_single_post_info_category_1
        ));

        $row_heading_blog_single_post_info_category_2 = newshub_mikado_add_admin_row(array(
            'name' => 'row_heading_blog_single_post_info_category_2',
            'parent' => $group_heading_post_info_category,
            'next' => true
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'fontsimple',
            'name' => 'blog_single_post_info_category_google_fonts',
            'default_value' => '-1',
            'label' => esc_html__('Font Family','newshub'),
            'parent' => $row_heading_blog_single_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_single_post_info_category_fontstyle',
            'default_value' => '',
            'label' => esc_html__('Font Style','newshub'),
            'options' => newshub_mikado_get_font_style_array(),
            'parent' => $row_heading_blog_single_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'selectblanksimple',
            'name' => 'blog_single_post_info_category_fontweight',
            'default_value' => '',
            'label' => esc_html__('Font Weight','newshub'),
            'options' => newshub_mikado_get_font_weight_array(),
            'parent' => $row_heading_blog_single_post_info_category_2
        ));

        newshub_mikado_add_admin_field(array(
            'type' => 'textsimple',
            'name' => 'blog_single_post_info_category_letterspacing',
            'default_value' => '',
            'label' => esc_html__('Letter Spacing','newshub'),
            'args' => array(
                'suffix' => 'px'
            ),
            'parent' => $row_heading_blog_single_post_info_category_2
        ));

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_single,
                'name' => 'related_posts_title_blog_single',
                'title' => esc_html__('Related Posts','newshub')
            )
        );

        newshub_mikado_add_admin_field(array(
            'name' => 'blog_single_related_posts',
            'type' => 'yesno',
            'label' => esc_html__('Show Related Posts','newshub'),
            'description' => esc_html__('Enabling this option will show related posts on your single post page.','newshub'),
            'parent' => $panel_blog_single,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#mkd_related_image_container'
            )
        ));

        $related_image_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'related_image_container',
                'hidden_property' => 'blog_single_related_posts',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_single_related_image_size',
                'default_value' => '',
                'label' => esc_html__('Related Posts Image Max Width','newshub'),
                'parent' => $related_image_container,
                'description' => esc_html__('Define maximum width for related posts images on your single post pages. Default value is 1200','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'text',
                'name' => 'blog_single_related_title_size',
                'default_value' => '70',
                'label' => esc_html__('Title Max Words','newshub'),
                'parent' => $related_image_container,
                'description' => esc_html__('Enter max words of title post list that you want to display','newshub'),
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_single,
                'name' => 'navigation_title_blog_single',
                'title' => esc_html__('Navigation','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_single_navigation',
                'default_value' => 'yes',
                'label' => esc_html__('Enable Prev/Next Single Post Navigation Links','newshub'),
                'parent' => $panel_blog_single,
                'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)','newshub'),
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_navigation_container'
                )
            )
        );

        $blog_single_navigation_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'mkd_blog_single_navigation_container',
                'hidden_property' => 'blog_single_navigation',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_navigation_through_same_category',
                'default_value' => 'no',
                'label' => esc_html__('Enable Navigation Only in Current Category','newshub'),
                'description' => esc_html__('Limit your navigation only through current category','newshub'),
                'parent' => $blog_single_navigation_container,
                'args' => array(
                    'col_width' => 3
                )
            )
        );

        newshub_mikado_add_admin_section_title(
            array(
                'parent' => $panel_blog_single,
                'name' => 'author_info_box_title_blog_single',
                'title' => esc_html__('Author','newshub')
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_author_info',
                'default_value' => 'yes',
                'label' => esc_html__('Show Author Info Box','newshub'),
                'parent' => $panel_blog_single,
                'description' => esc_html__('Enabling this option will display author name and descriptions on Blog Single pages','newshub'),
                'args' => array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#mkd_mkd_blog_single_author_info_container'
                )
            )
        );

        $blog_single_author_info_container = newshub_mikado_add_admin_container(
            array(
                'name' => 'mkd_blog_single_author_info_container',
                'hidden_property' => 'blog_author_info',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

        newshub_mikado_add_admin_field(
            array(
                'type' => 'yesno',
                'name' => 'blog_single_author_info_email',
                'default_value' => 'no',
                'label' => esc_html__('Show Author Email','newshub'),
                'description' => esc_html__('Enabling this option will show author email','newshub'),
                'parent' => $blog_single_author_info_container,
                'args' => array(
                    'col_width' => 3
                )
            )
        );
    }

    add_action('newshub_mikado_options_map', 'newshub_mikado_blog_options_map', 11);
}