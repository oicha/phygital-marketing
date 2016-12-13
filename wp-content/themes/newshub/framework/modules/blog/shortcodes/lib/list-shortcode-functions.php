<?php

if (!function_exists('newshub_mikado_get_shortcode_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @param $signature string base param of shortcode
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_shortcode_params($signature) {

        switch ($signature) {
            case "mkd_block_one":
                return newshub_mikado_get_block_one_params();
                break;
            case "mkd_block_two":
                return newshub_mikado_get_block_two_params();
                break;
            case "mkd_block_three":
                return newshub_mikado_get_block_three_params();
                break;
            case "mkd_block_four":
                return newshub_mikado_get_block_four_params();
                break;
            case "mkd_block_five":
                return newshub_mikado_get_block_five_params();
                break;
            case "mkd_block_six":
                return newshub_mikado_get_block_six_params();
                break;
            case "mkd_block_seven":
                return newshub_mikado_get_block_seven_params();
                break;
            case "mkd_post_layout_one":
                return newshub_mikado_get_layout_one_params();
                break;
            case "mkd_post_layout_two":
                return newshub_mikado_get_layout_two_params();
                break;
            case "mkd_post_layout_three":
                return newshub_mikado_get_layout_three_params();
                break;
            case "mkd_post_layout_four":
                return newshub_mikado_get_layout_four_params();
                break;
            case "mkd_post_layout_five":
                return newshub_mikado_get_layout_five_params();
                break;
            case "mkd_post_layout_six":
                return newshub_mikado_get_layout_six_params();
                break;
            case "mkd_slider_post_one":
                return newshub_mikado_get_slider_one_params();
                break;
            case "mkd_slider_post_two":
                return newshub_mikado_get_slider_two_params();
                break;
            case "mkd_slider_post_three":
                return newshub_mikado_get_slider_three_params();
                break;
            default:
                return newshub_mikado_get_shortcode_params_default($signature);
                break;
        }
    }
}

if (!function_exists('newshub_mikado_get_shortcode_params_names')) {
    /**
     * Function that returns array of predefined names which will be used for shortcode
     * This is used just to set default values
     *
     * @param $params_array array with all params for shortcode with empty value
     *
     * @return array of names with empty values
     *
     */
    function newshub_mikado_get_shortcode_params_names($params_array) {
        $params_names = array();

        foreach ($params_array as $param) {
            $params_names[$param['param_name']] = '';
        }

        $params_names['offset'] = '';

        return $params_names;
    }
}

if (!function_exists('newshub_mikado_get_post_categories_VC')) {
    /**
     * Function that returns array of categories formatted for Visual Composer
     *
     * @return array of categories where key is category name and value is category id
     *
     * @see mkd_get_post_categories
     */
    function newshub_mikado_get_post_categories_VC() {
        return array_flip(newshub_mikado_get_post_categories());
    }
}

if (!function_exists('newshub_mikado_get_post_categories')) {
    /**
     * Function that returns associative array of post categories,
     * where key is category id and value is category name
     * @return array
     */
    function newshub_mikado_get_post_categories() {
        $vc_array = $post_categories = array();
        $vc_array[0] = "All Categories";
        $post_categories = get_categories();
        foreach ($post_categories as $cat) {
            $vc_array[$cat->cat_ID] = $cat->name;
        }
        return $vc_array;
    }
}

if (!function_exists('newshub_mikado_get_authors')) {
    /**
     * Function that returns associative array of authors,
     * where key is author id and value is author name
     * @return array
     */
    function newshub_mikado_get_authors() {
        $vc_array = $authors = array();
        $vc_array[0] = "All Authors";
        $authors = get_users();
        foreach ($authors as $author) {
            $vc_array[$author->ID] = $author->display_name;
        }
        return $vc_array;
    }
}

if (!function_exists('newshub_mikado_get_authors_VC')) {
    /**
     * Function that returns array of authors formatted for Visual Composer
     *
     * @return array of authors where key is category name and value is category id
     *
     * @see newshub_mikado_get_authors
     */
    function newshub_mikado_get_authors_VC() {
        return array_flip(newshub_mikado_get_authors());
    }
}

if (!function_exists('newshub_mikado_get_sort_array')) {
    /**
     * Function that returns array of sort properties for list shortcode formatted for Visual Composer
     *
     * @return array of sort properties for formatted for Visual Composer
     *
     */
    function newshub_mikado_get_sort_array() {
        $sort_array = array(
            "" => "",
            esc_html__("Latest", 'newshub') => "latest",
            esc_html__("Random", 'newshub') => "random",
            esc_html__("Random Posts Today", 'newshub') => "random_today",
            esc_html__("Random in Last 7 Days", 'newshub') => "random_seven_days",
            esc_html__("Most Commented", 'newshub') => "comments",
            esc_html__("Title", 'newshub') => "title",
            esc_html__("Popular", 'newshub') => "popular",
            esc_html__("Featured Posts First", 'newshub') => "featured_first"
        );
        return $sort_array;
    }
}

if (!function_exists('newshub_mikado_get_query')) {
    /**
     * Function that returns query from params
     *
     * @return WP_Query
     *
     */
    function newshub_mikado_get_query($params) {
        $params = shortcode_atts(
            array(
                'post_type' => 'post',
                'number_of_posts' => '-1',
                'author_id' => '',
                'category_id' => '',
                'category_slug' => '',
                'orderby' => 'date',
                'order' => '',
                'tag_slug' => '',
                'post_in' => '',
                'post_not_in' => '',
                'sort' => '',
                'offset' => '0',
                'paged' => '',
                'pagination' => 'no',
                'pagination_type' => '',
                'post_status' => 'publish'
            ), $params);

        $query_array = array();

        $query_array['post_status'] = $params['post_status']; //to ensure that ajax call will not return 'private' posts

        $categoryExist = true;
        $categoryHasPosts = true;
        if (is_wp_error(get_the_category_by_ID($params['category_id']))) {
            $categoryExist = false;
        } else {
            $categoryHasPosts = get_posts('cat=' . $params['category_id']);
            if (empty($categoryHasPosts)) {
                $categoryHasPosts = false;
            }
        }
        if ($params['category_id'] !== '' && $categoryExist && $categoryHasPosts) {
            $query_array['cat'] = $params['category_id'];
        }
        if ($params['category_slug'] !== '') {
            $query_array['category_name'] = $params['category_slug'];
        }
        $userExist = true;
        if (get_the_author_meta('display_name', $params['author_id']) === '') {
            $userExist = false;
        }
        if ($params['author_id'] !== "" && $userExist) {
            $query_array['author'] = $params['author_id'];
        }
        if (!empty($params['tag_slug'])) {
            $query_array['tag'] = str_replace(' ', '-', $params['tag_slug']);
        }
        if (!empty($params['post_not_in'])) {
            $query_array['post__not_in'] = explode(",", $params['post_not_in']);
        }
        if (!empty($params['post_in'])) {
            $query_array['post__in'] = explode(",", $params['post_in']);
        }

        $query_array['ignore_sticky_posts'] = '1';

        switch ($params['sort']) {
            case 'latest':
                $query_array['orderby'] = 'date';
                break;

            case 'random':
                $query_array['orderby'] = 'rand';
                break;

            case 'random_today':
                $query_array['orderby'] = 'rand';
                $query_array['year'] = date('Y');
                $query_array['monthnum'] = date('n');
                $query_array['day'] = date('j');
                break;

            case 'random_seven_days':
                $query_array['date_query'] = array(
                    'column' => 'post_date_gmt',
                    'after' => '1 week ago'
                );
                break;

            case 'comments':
                $query_array['orderby'] = 'comment_count';
                $query_array['order'] = 'DESC';
                break;

            case 'title':
                $query_array['orderby'] = 'title';
                $query_array['order'] = 'ASC';
                break;

            case 'popular':
                $query_array['meta_key'] = 'count_post_views';
                $query_array['orderby'] = 'meta_value_num';
                $query_array['order'] = 'ASC';
                break;
            case 'featured_first':
                $query_array['meta_key'] = 'mkd_show_featured_post';
                $query_array['orderby'] = 'meta_value';
                $query_array['order'] = 'DESC';
                break;
        }

        $query_array['posts_per_page'] = $params['number_of_posts'];

        if (!empty($params['order'])) {
            $query_array['order'] = $params['order'];
        }

        if ($params['paged'] == '') {
            if (get_query_var('paged')) {
                $params['paged'] = get_query_var('paged');
            } elseif (get_query_var('page')) {
                $params['paged'] = get_query_var('page');
            }
        }

        if (!empty($params['paged'])) {
            $query_array['paged'] = $params['paged'];
        } else {
            $query_array['paged'] = 1;
        }

        if (!empty($params['offset'])) {
            if ($query_array['paged'] > 1) {
                $query_array['offset'] = $params['offset'] + (($params['paged'] - 1) * $params['number_of_posts']);
            } else {
                $query_array['offset'] = $params['offset'];
            }
        }

        $list_query = new WP_Query($query_array);

        return $list_query;
    }
}

if (!function_exists('newshub_mikado_get_filtered_params')) {
    /**
     * Function that returns associative array without prefix.
     * This function is used for block shortcodes (prefix_param -> param)
     *
     * @param $params array which need to be filtered
     * @param $prefix string part of key that need to be removed
     *
     * @return array
     */

    function newshub_mikado_get_filtered_params($params, $prefix) {
        $params_filtered = array();

        foreach ($params as $key => $value) {
            $new_key = substr($key, strlen($prefix) + 1);
            $params_filtered[$new_key] = $value;
        }

        return $params_filtered;
    }
}

if (!function_exists('newshub_mikado_get_title_substring')) {
    /**
     * Function that returns substring of title
     *
     * @param $title string that need to be shorten
     * @param $length size of substring
     *
     * @return array
     */

    function newshub_mikado_get_title_substring($title, $length) {


        $pieces = explode(" ", $title);

        $new_title = esc_attr($title);

        if ($length !== false && $length !== '' && count($pieces) > $length) {
            $first_part = implode(" ", array_splice($pieces, 0, $length));
            $new_title = $first_part . '...';
        }

        return $new_title;

    }
}

/**
 *
 * Slider Group Visual Composer Options for Shortcodes
 *
 * Used as attributes for Slick Slider
 *
 */
if (!function_exists('newshub_mikado_get_slider_shortcode_params')) {
    /**
     * Function that returns array of slider predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_slider_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // SLIDER OPTIONS - START
        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Slider Height (px)','newshub'),
            'param_name' => 'slider_height',
            'value' => '335',
            'save_always' => true,
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Number of Post Per Slide','newshub'),
            'param_name' => 'slider_slides_to_show',
            'value' => '3',
            'save_always' => true,
            'description' => esc_html__('Set number of posts visible in one slide','newshub'),
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Number of Post To Scroll','newshub'),
            'param_name' => 'slider_slides_to_scroll',
            'value' => '1',
            'save_always' => true,
            'description' => esc_html__('Set number of posts visible in one slide','newshub'),
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Center Mode','newshub'),
            'param_name' => 'slider_center_mode',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'true',
                esc_html__('No', 'newshub') => 'false'
            ),
            'save_always' => true,
            'description' => esc_html__('When using this option please make sure to set odd number for "Number of Post Per Slide"','newshub'),
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Autoplay','newshub'),
            'param_name' => 'slider_autoplay',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'true',
                esc_html__('No', 'newshub') => 'false'
            ),
            'save_always' => true,
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Show Prev/Next Navigation','newshub'),
            'param_name' => 'slider_arrows',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'true',
                esc_html__('No', 'newshub') => 'false'
            ),
            'save_always' => true,
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Show Paginated Navigation','newshub'),
            'param_name' => 'slider_dots',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'true',
                esc_html__('No', 'newshub') => 'false'
            ),
            'save_always' => true,
            'group' => esc_html__('Slider','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Parallax Effect on Image','newshub'),
            'param_name' => 'slider_parallax',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'true',
                esc_html__('No', 'newshub') => 'false'
            ),
            'save_always' => true,
            'group' => esc_html__('Slider','newshub')
        );
        // SLIDER OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/**
 *
 * General Group Visual Composer options for Shortcodes
 *
 */
if (!function_exists('newshub_mikado_get_general_shortcode_params')) {
    /**
     * Function that returns array of general predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_general_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // GENERAL OPTIONS - START
        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Extra Class Name','newshub'),
            'param_name' => 'extra_class_name',
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Number of Posts','newshub'),
            'param_name' => 'number_of_posts',
            'value' => '6',
            'save_always' => true,
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Number of Posts','newshub'),
            'param_name' => 'number_of_posts_dropdown',
            'value' => array(
                esc_html__('Default', 'newshub') => '3',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7'
            ),
            'save_always' => true,
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            "type" => "dropdown",
            "class" => "",
            'heading' => esc_html__('Number of Columns','newshub'),
            "param_name" => "column_number",
            "value" => array(
                "" => "",
                esc_html__("One", 'newshub') => 1,
                esc_html__("Two", 'newshub') => 2,
                esc_html__("Three", 'newshub') => 3,
                esc_html__("Four", 'newshub') => 4,
                esc_html__("Five", 'newshub') => 5,
                esc_html__("Six", 'newshub') => 6
            ),
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Block Proportion','newshub'),
            'param_name' => 'block_proportion',
            'value' => array(
                '1/2+1/2' => 'two_half',
                '2/3+1/3' => 'two_third_one_third',
                '1/3+2/3' => 'one_third_two_third',
                '3/4+1/4' => 'three_fourths_one_fourth'
            ),
            'save_always' => true,
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            "type" => "dropdown",
            "class" => "",
            'heading' => esc_html__('Category','newshub'),
            "value" => newshub_mikado_get_post_categories_VC(),
            "param_name" => "category_id",
            'save_always' => true,
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Category Slug','newshub'),
            'param_name' => 'category_slug',
            'description' => esc_html__('Leave empty for all or use comma for list','newshub'),
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            "type" => "dropdown",
            "admin_label" => true,
            "class" => "",
            'heading' => esc_html__('Choose Author','newshub'),
            "param_name" => "author_id",
            "value" => newshub_mikado_get_authors_VC(),
            'save_always' => true,
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Tag Slug','newshub'),
            'param_name' => 'tag_slug',
            'description' => esc_html__('Leave empty for all or use comma for list','newshub'),
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Include Posts','newshub'),
            'param_name' => 'post_in',
            'description' => esc_html__('Enter the IDs of the posts you want to display','newshub'),
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Exclude Posts','newshub'),
            'param_name' => 'post_not_in',
            'description' => esc_html__('Enter the IDs of the posts you want to exclude','newshub'),
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            "type" => "dropdown",
            "admin_label" => true,
            "class" => "",
            'heading' => esc_html__('Sort','newshub'),
            "param_name" => "sort",
            "value" => newshub_mikado_get_sort_array(),
            'group' => esc_html__('General','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Layout Title','newshub'),
            'param_name' => 'title',
            'group' => esc_html__('General','newshub')
        );
        // GENERAL OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/*
 *
 * Feature Title Group Visual Composer Options for Shortcodes
 *
*/
if (!function_exists('newshub_mikado_get_feature_title_shortcode_params')) {
    /**
     * Function that returns array of feature title predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_feature_title_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // FEATURE TITLE OPTIONS - START
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Title Tag','newshub'),
            'param_name' => 'featured_title_tag',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Title Separator','newshub'),
            'param_name' => 'featured_display_title_separator',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Max Words','newshub'),
            'param_name' => 'featured_title_length',
            'description' => esc_html__('Enter max words of title post list that you want to display','newshub'),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Font Size (px)','newshub'),
            'param_name' => 'featured_title_font_size',
            'description' => esc_html__('Set custom font size for title (px)','newshub'),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Line Height (px)','newshub'),
            'param_name' => 'featured_title_line_height',
            'description' => esc_html__('Set custom line height for title (px)','newshub'),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text Transform','newshub'),
            'param_name' => 'featured_title_text_transform',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('None', 'newshub') => 'none',
                esc_html__('Capitalize', 'newshub') => 'capitalize',
                esc_html__('none', 'newshub') => 'none',
                esc_html__('Lowercase', 'newshub') => 'lowercase',
            ),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Style','newshub'),
            'param_name' => 'featured_title_font_style',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Normal', 'newshub') => 'normal',
                esc_html__('Italic', 'newshub') => 'italic',
            ),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Weight','newshub'),
            'param_name' => 'featured_title_font_weight',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900',
            ),
            'group' => esc_html__('Featured Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Letter Spacing (px)','newshub'),
            'param_name' => 'featured_title_letter_spacing',
            'description' => esc_html__('Set custom letter spacing for title (px)','newshub'),
            'group' => esc_html__('Featured Item Title','newshub')
        );
        // FEATURE TITLE OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/*
 *
 * Feature Group Visual Composer Options for Shortcodes
 *
*/
if (!function_exists('newshub_mikado_get_feature_shortcode_params')) {
    /**
     * Function that returns array of feature predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_feature_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // FEATURE OPTIONS - START
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Horizontal Content Centering','newshub'),
            'param_name' => 'featured_horizontally_centered_content',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Vertical Content Centering','newshub'),
            'param_name' => 'featured_vertically_centered_content',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Image Size','newshub'),
            'param_name' => 'featured_thumb_image_size',
            'value' => array(
                esc_html__('Original', 'newshub') => 'original',
                esc_html__('Landscape', 'newshub') => 'landscape',
                esc_html__('Portrait', 'newshub') => 'portrait',
                esc_html__('Square', 'newshub') => 'square',
                esc_html__('Custom', 'newshub') => 'custom_size'
            ),
            'save_always' => true,
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Width (px)','newshub'),
            'param_name' => 'featured_thumb_image_width',
            'description' => esc_html__('Set custom image width (px)','newshub'),
            'dependency' => array('element' => 'featured_thumb_image_size', 'value' => array('custom_size')),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Height (px)','newshub'),
            'param_name' => 'featured_thumb_image_height',
            'description' => esc_html__('Set custom image height (px)','newshub'),
            'dependency' => array('element' => 'featured_thumb_image_size', 'value' => array('custom_size')),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Custom Image Width (px)','newshub'),
            'param_name' => 'featured_custom_thumb_image_width',
            'description' => esc_html__('Set custom image width (px)','newshub'),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Custom Image Height (px)','newshub'),
            'param_name' => 'featured_custom_thumb_image_height',
            'description' => esc_html__('Set custom image height (px)','newshub'),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Excerpt','newshub'),
            'param_name' => 'featured_display_excerpt',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Max. Excerpt Length','newshub'),
            'param_name' => 'featured_excerpt_length',
            'value' => '',
            'description' => esc_html__('Enter max of words that can be shown for excerpt','newshub'),
            'dependency' => array('element' => 'featured_display_excerpt', 'value' => array('yes')),
            'group' => esc_html__('Featured Item','newshub')
        );
        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Excerpt - Margin Top','newshub'),
            'param_name' => 'featured_excerpt_margin_top',
            'value' => '',
            'description' => esc_html__('Enter margin top for excerpt','newshub'),
            'dependency' => array('element' => 'featured_display_excerpt', 'value' => array('yes')),
            'group' => esc_html__('Featured Item','newshub')
        );
        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Excerpt - Margin Bottom','newshub'),
            'param_name' => 'featured_excerpt_margin_bottom',
            'value' => '',
            'description' => esc_html__('Enter margin bottom for excerpt','newshub'),
            'dependency' => array('element' => 'featured_display_excerpt', 'value' => array('yes')),
            'group' => esc_html__('Featured Item','newshub')
        );
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Date','newshub'),
            'param_name' => 'featured_display_date',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Date Format','newshub'),
            'param_name' => 'featured_date_format',
            'description' => esc_html__('Enter the date format that you want to display','newshub'),
            'dependency' => array('element' => 'featured_display_date', 'value' => array('yes', '')),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Category','newshub'),
            'param_name' => 'featured_display_category',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Author','newshub'),
            'param_name' => 'featured_display_author',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Comments','newshub'),
            'param_name' => 'featured_display_comments',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Like','newshub'),
            'param_name' => 'featured_display_like',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Count','newshub'),
            'param_name' => 'featured_display_count',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Post Type Icon','newshub'),
            'param_name' => 'featured_display_post_type_icon',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Post Type Icon Size','newshub'),
            'param_name' => 'featured_post_type_icon_size',
            'value' => array(
                esc_html__('Small', 'newshub') => 'small',
                esc_html__('Medium', 'newshub') => 'medium',
                esc_html__('Large', 'newshub') => 'large'
            ),
            'save_always' => true,
            'dependency' => array('element' => 'featured_display_post_type_icon', 'value' => array('yes')),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display share links','newshub'),
            'param_name' => 'featured_display_share',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Featured Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display read more','newshub'),
            'param_name' => 'featured_display_read_more',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Featured Item','newshub')
        );
        // FEATURE OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/**
 *
 * Non-Feature Title Group Visual Composer Options for Shortcodes
 *
 */
if (!function_exists('newshub_mikado_get_non_feature_title_shortcode_params')) {
    /**
     * Function that returns array of non-feature predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_non_feature_title_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // NON-FEATURE TITLE OPTIONS - START
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Title Tag','newshub'),
            'param_name' => 'title_tag',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                'h2' => 'h2',
                'h3' => 'h3',
                'h4' => 'h4',
                'h5' => 'h5',
                'h6' => 'h6',
            ),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Title Separator','newshub'),
            'param_name' => 'display_title_separator',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Max Words','newshub'),
            'param_name' => 'title_length',
            'description' => esc_html__('Enter max words of title post list that you want to display','newshub'),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Font Size (px)','newshub'),
            'param_name' => 'title_font_size',
            'description' => esc_html__('Set custom font size for title (px)','newshub'),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Line Height (px)','newshub'),
            'param_name' => 'title_line_height',
            'description' => esc_html__('Set custom line height for title (px)','newshub'),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text Transform','newshub'),
            'param_name' => 'title_text_transform',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('None', 'newshub') => 'none',
                esc_html__('Capitalize', 'newshub') => 'capitalize',
                esc_html__('none', 'newshub') => 'none',
                esc_html__('Lowercase', 'newshub') => 'lowercase',
            ),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Style','newshub'),
            'param_name' => 'title_font_style',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Normal', 'newshub') => 'normal',
                esc_html__('Italic', 'newshub') => 'italic',
            ),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Font Weight','newshub'),
            'param_name' => 'title_font_weight',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                '100' => '100',
                '200' => '200',
                '300' => '300',
                '400' => '400',
                '500' => '500',
                '600' => '600',
                '700' => '700',
                '800' => '800',
                '900' => '900',
            ),
            'group' => esc_html__('Post Item Title','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Letter Spacing (px)','newshub'),
            'param_name' => 'title_letter_spacing',
            'description' => esc_html__('Set custom letter spacing for title (px)','newshub'),
            'group' => esc_html__('Post Item Title','newshub')
        );
        // NON-FEATURE TITLE OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/*
 *
 * Non-Feature Group Visual Composer Options for Shortcodes
 *
*/
if (!function_exists('newshub_mikado_get_non_feature_shortcode_params')) {
    /**
     * Function that returns array of non-feature predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_non_feature_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // NON-FEATURE OPTIONS - START
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Horizontal Content Centering','newshub'),
            'param_name' => 'horizontally_centered_content',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Vertical Content Centering','newshub'),
            'param_name' => 'vertically_centered_content',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Image Size','newshub'),
            'param_name' => 'thumb_image_size',
            'value' => array(
                esc_html__('Original', 'newshub') => 'original',
                esc_html__('Landscape', 'newshub') => 'landscape',
                esc_html__('Portrait', 'newshub') => 'portrait',
                esc_html__('Square', 'newshub') => 'square',
                esc_html__('Custom', 'newshub') => 'custom_size'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Width (px)','newshub'),
            'param_name' => 'thumb_image_width',
            'description' => esc_html__('Set custom image width (px)','newshub'),
            'dependency' => array('element' => 'thumb_image_size', 'value' => array('custom_size')),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Image Height (px)','newshub'),
            'param_name' => 'thumb_image_height',
            'description' => esc_html__('Set custom image height (px)','newshub'),
            'dependency' => array('element' => 'thumb_image_size', 'value' => array('custom_size')),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Custom Image Width (px)','newshub'),
            'param_name' => 'custom_thumb_image_width',
            'description' => esc_html__('Set custom image width (px)','newshub'),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Custom Image Height (px)','newshub'),
            'param_name' => 'custom_thumb_image_height',
            'description' => esc_html__('Set custom image height (px)','newshub'),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Date','newshub'),
            'param_name' => 'display_date',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Date Format','newshub'),
            'param_name' => 'date_format',
            'description' => esc_html__('Enter the date format that you want to display','newshub'),
            'dependency' => array('element' => 'display_date', 'value' => array('yes', '')),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Category','newshub'),
            'param_name' => 'display_category',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Author','newshub'),
            'param_name' => 'display_author',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Comments','newshub'),
            'param_name' => 'display_comments',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Like','newshub'),
            'param_name' => 'display_like',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Count','newshub'),
            'param_name' => 'display_count',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Excerpt','newshub'),
            'param_name' => 'display_excerpt',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Max. Excerpt Length','newshub'),
            'param_name' => 'excerpt_length',
            'value' => '',
            'description' => esc_html__('Enter max of words that can be shown for excerpt','newshub'),
            'dependency' => array('element' => 'display_excerpt', 'value' => array('yes')),
            'group' => esc_html__('Post Item','newshub')
        );
        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Excerpt - Margin Top','newshub'),
            'param_name' => 'excerpt_margin_top',
            'value' => '',
            'description' => esc_html__('Enter margin top for excerpt','newshub'),
            'dependency' => array('element' => 'display_excerpt', 'value' => array('yes')),
            'group' => esc_html__('Post Item','newshub')
        );
        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Excerpt - Margin Bottom','newshub'),
            'param_name' => 'excerpt_margin_bottom',
            'value' => '',
            'description' => esc_html__('Enter margin bottom for excerpt','newshub'),
            'dependency' => array('element' => 'display_excerpt', 'value' => array('yes')),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Post Type Icon','newshub'),
            'param_name' => 'display_post_type_icon',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Post Type Icon Size','newshub'),
            'param_name' => 'post_type_icon_size',
            'value' => array(
                esc_html__('Small', 'newshub') => 'small',
                esc_html__('Medium', 'newshub') => 'medium',
                esc_html__('Large', 'newshub') => 'large'
            ),
            'save_always' => true,
            'dependency' => array('element' => 'display_post_type_icon', 'value' => array('yes')),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display share links','newshub'),
            'param_name' => 'display_share',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            "type" => "dropdown",
            "class" => "",
            'heading' => esc_html__('Display Rating','newshub'),
            "param_name" => "display_rating",
            "value" => array(
                esc_html__("Default", 'newshub') => "",
                esc_html__("Yes", 'newshub') => "yes",
                esc_html__("No", 'newshub') => "no"
            ),
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display read more','newshub'),
            'param_name' => 'display_read_more',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display separator','newshub'),
            'param_name' => 'display_separator',
            'value' => array(
                esc_html__('Default', 'newshub') => '',
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Post Item','newshub')
        );
        // NON-FEATURE OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/**
 *
 * Pagination Group Visual Composer Options for Shortcodes
 *
 */
if (!function_exists('newshub_mikado_get_pagination_shortcode_params')) {
    /**
     * Function that returns array of pagination predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_pagination_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // PAGINATION OPTIONS - START
        $params_array[] = array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => esc_html__('Pagination','newshub'),
            'param_name' => 'display_pagination',
            'value' => array(
                esc_html__('No', 'newshub') => 'no',
                esc_html__('Yes', 'newshub') => 'yes'
            ),
            'save_always' => true,
            'group' => esc_html__('Pagination','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'class' => '',
            'heading' => esc_html__('Pagination Type','newshub'),
            'param_name' => 'pagination_type',
            'value' => array(
                esc_html__("Horizontal Navigation", 'newshub') => "np-horizontal",
                esc_html__("Load More", 'newshub') => "load-more",
                esc_html__("Infinite Scroll", 'newshub') => "infinite"
            ),
            'save_always' => true,
            'dependency' => array('element' => 'display_pagination', 'value' => array('yes')),
            'group' => esc_html__('Pagination','newshub')
        );

        $params_array[] = array(
            'type' => 'textfield',
            'heading' => esc_html__('Navigation Top Position','newshub'),
            'param_name' => 'navigation_top',
            'value' => '',
            'description' => esc_html__('Enter position top for Horizontal Navigation. Default is -4 (px)','newshub'),
            'dependency' => array('element' => 'pagination_type', 'value' => array('np-horizontal')),
            'group' => esc_html__('Pagination','newshub')
        );

        // PAGINATION OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/**
 *
 * Navigation Group Visual Composer Options for Shortcodes
 *
 */
if (!function_exists('newshub_mikado_get_navigation_shortcode_params')) {
    /**
     * Function that returns array of navigation predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_navigation_shortcode_params($exclude_options = array()) {

        $params_array = array();

        // NAVIGATION OPTIONS - START
        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Navigation','newshub'),
            'param_name' => 'display_navigation',
            'value' => array(
                esc_html__('Yes', 'newshub') => 'yes',
                esc_html__('No', 'newshub') => 'no'
            ),
            'save_always' => true,
            'group' => esc_html__('Navigation','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Control','newshub'),
            'param_name' => 'display_control',
            'value' => array(
                esc_html__('No', 'newshub') => 'no',
                esc_html__('Thumbnails', 'newshub') => 'thumbnails',
                esc_html__('Paging', 'newshub') => 'paging'
            ),
            'save_always' => true,
            'group' => esc_html__('Navigation','newshub')
        );

        $params_array[] = array(
            'type' => 'dropdown',
            'heading' => esc_html__('Display Paging','newshub'),
            'param_name' => 'display_paging',
            'value' => array(
                esc_html__('No', 'newshub') => 'no',
                esc_html__('Yes', 'newshub') => 'yes'
            ),
            'save_always' => true,
            'group' => esc_html__('Navigation','newshub')
        );
        // NAVIGATION OPTIONS - END

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}

/**
 *
 * Default Visual Composer Options for Shortcodes
 *
 */
if (!function_exists('newshub_mikado_get_shortcode_params_default')) {
    /**
     * Function that returns array of default predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_shortcode_params_default($exclude_options = array()) {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params();
        // GENERAL OPTIONS - END

        // FEATURED POST TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params();
        // FEATURED POST TITLE OPTIONS - END

        // FEATURED POST OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params();
        // FEATURED POST OPTIONS - END

        // NON-FEATURED POSTS TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params();
        // NON-FEATURED POSTS TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params();
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        // NAVIGATION OPTIONS - START
        $params_navigation_array = newshub_mikado_get_navigation_shortcode_params();
        // NAVIGATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array,
            $params_navigation_array
        );

        if (is_array($exclude_options) && count($exclude_options)) {
            foreach ($exclude_options as $exclude_key) {
                foreach ($params_array as $params_item) {
                    if ($exclude_key == $params_item['param_name']) {
                        $key = array_search($params_item, $params_array);
                        unset($params_array[$key]);
                    }
                }
            }
        }

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for Block 1 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_block_one_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_one_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params(
            array(
                'featured_display_title_separator',
            ));
        // FEATURE TITLE OPTIONS - END

        // FEATURE POSTS OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
            ));
        // FEATURE POSTS OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params();
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_rating',
                'display_separator',
            ));
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for block 2 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_block_two_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_two_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params();
        // NON-FEATURE TITLE OPTIONS - END

        // FEATURED POST OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_vertically_centered_content',
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
            ));
        // FEATURED POST OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator'
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_share',
                'display_rating',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for block 3 hortcode
 *
 *
 */
if (!function_exists('newshub_mikado_get_block_three_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_three_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'number_of_posts',
                'column_number',
            ));
        // GENERAL OPTIONS - END

        // FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params(
            array(
                'featured_display_title_separator',
            ));
        // FEATURE TITLE OPTIONS - END

        // FEATURE POSTS OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
            ));
        // FEATURE POSTS OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_rating',
                'display_separator',
            ));

        // ADDITIONAL NON FEATURED ARRAY
        $params_non_feature_additonal_array = array(
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Number of Columns','newshub'),
                'param_name' => 'non_featured_columns_number',
                'value' => array(
                    esc_html__('One', 'newshub') => 'mkd-non-feat-one-column',
                    esc_html__('Two', 'newshub') => 'mkd-non-feat-two-columns'
                ),
                'save_always' => true,
                'group' => esc_html__('Post Item','newshub')
            )
        );

        $params_non_feature_array = array_merge($params_non_feature_additonal_array, $params_non_feature_array);
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for block 4 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_block_four_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_four_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'number_of_posts',
            ));
        // GENERAL OPTIONS - END

        // FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params();
        // FEATURE TITLE OPTIONS - END

        // FEATURE POSTS OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_vertically_centered_content',
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
            ));
        // FEATURE POSTS OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_category',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_rating',
                'display_share',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer Options for block 5 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_block_five_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_five_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'number_of_posts'
            ));
        // GENERAL OPTIONS - END

        // FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params(
            array(
                'featured_display_title_separator',
            ));
        // FEATURE TITLE OPTIONS - END

        // FEATURE POSTS OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',

            ));
        // FEATURE POSTS OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator'
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_rating',
                'display_share',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for block 6 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_block_six_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_six_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
                'column_number',
            ));
        // GENERAL OPTIONS - END

        // FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params();
        // FEATURE TITLE OPTIONS - END

        // FEATURE POST OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_vertically_centered_content',
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
            ));
        // FEATURE POST OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator'
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_share',
                'display_rating',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for Block 1 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_block_seven_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_block_seven_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // FEATURE TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params(
            array(
                'featured_display_title_separator',
            ));
        // FEATURE TITLE OPTIONS - END

        // FEATURE POSTS OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
            ));
        // FEATURE POSTS OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_category',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_share',
                'display_rating',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for layout 1 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_layout_one_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_layout_one_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params();
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_separator',
            ));

        $params_non_feature_additonal_array = array(
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Skin','newshub'),
                'param_name' => 'non_featured_skin',
                'value' => array(
                    esc_html__('Default', 'newshub') => '',
                    esc_html__('Light', 'newshub') => 'mkd-light',
                ),
                'save_always' => true,
                'group' => esc_html__('Post Item','newshub')
            )
        );

        $params_non_feature_array = array_merge($params_non_feature_additonal_array, $params_non_feature_array);
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}

/**
 *
 * Visual Composer options for layout 2 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_layout_two_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_layout_two_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_category',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_share',
                'display_rating',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for layout 3 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_layout_three_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_layout_three_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator'
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_share',
                'display_rating',
                'display_read_more',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}

/**
 *
 * Visual Composer options for layout 4 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_layout_four_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_layout_four_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_rating',
                'display_separator',
                'display_read_more',
            ));
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for layout 5 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_layout_five_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_layout_five_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_rating',
                'display_separator',
                'display_read_more',
            ));
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for layout 6 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_layout_six_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_layout_six_params() {

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'block_proportion',
                'number_of_posts_dropdown',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURE TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURE TITLE OPTIONS - END

        // NON-FEATURE POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'horizontally_centered_content',
                'vertically_centered_content',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_rating',
                'display_separator',
                'display_read_more',
            ));
        // NON-FEATURE POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        $params_pagination_array = newshub_mikado_get_pagination_shortcode_params();
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_non_feature_title_array,
            $params_non_feature_array,
            $params_pagination_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for slider 1 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_slider_one_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_slider_one_params() {

        // SLIDER OPTIONS - BEGIN
        $params_slider_array = newshub_mikado_get_slider_shortcode_params(
            array(
                'slider_fade',
                'slider_slides_to_scroll',
                'slider_slides_to_show',
                'slider_center_mode',
                'slider_dots',
                'slider_arrows',
                'slider_parallax',
            ));
        // SLIDER OPTIONS - END

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'block_proportion',
                'number_of_posts',
                'title',
            ));
        // GENERAL OPTIONS - END

        // FEATURED POST TITLE OPTIONS - START
        $params_feature_title_array = newshub_mikado_get_feature_title_shortcode_params(
            array(
                'featured_display_title_separator',
            ));
        // FEATURED POST TITLE OPTIOMS - END

        // FEATURED POST OPTIONS - START
        $params_feature_array = newshub_mikado_get_feature_shortcode_params(
            array(
                'featured_horizontally_centered_content',
                'featured_vertically_centered_content',
                'featured_custom_thumb_image_width',
                'featured_custom_thumb_image_height',
                'featured_thumb_image_size',
                'featured_thumb_image_width',
                'featured_thumb_image_height',
                'featured_display_post_type_icon',
                'featured_post_type_icon_size',
                'featured_display_read_more',
                'featured_display_share',
            ));
        // FEATURED POST OPTIONS - END

        // NON-FEATURED POST TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURED POST TITLE OPTIOMS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_excerpt',
                'excerpt_length',
                'excerpt_margin_top',
                'excerpt_margin_bottom',
                'display_post_type_icon',
                'post_type_icon_size',
                'display_share',
                'display_rating',
                'display_read_more',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_slider_array,
            $params_feature_title_array,
            $params_feature_array,
            $params_non_feature_title_array,
            $params_non_feature_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for slider 2 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_slider_two_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_slider_two_params() {

        // SLIDER OPTIONS - BEGIN
        $params_slider_array = newshub_mikado_get_slider_shortcode_params(
            array(
                'slider_fade',
                'slider_height',
                'slider_parallax',
                'slider_parallax_speed',
            ));
        // SLIDER OPTIONS - END

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'block_proportion',
                'number_of_posts_dropdown',
                'title',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURED POST TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params();
        // NON-FEATURED POST TITLE OPTIOMS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'vertically_centered_content',
                'horizontally_centered_content',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'display_share',
                'display_rating',
                'display_separator',
            ));

        // ADDITIONAL NON FEATURED ARRAY
        $params_non_feature_additonal_array = array(
            array(
                'type' => 'dropdown',
                'class' => '',
                'heading' => esc_html__('Display spacing between items','newshub'),
                'param_name' => 'display_spacing',
                'value' => array(
                    esc_html__('Default', 'newshub') => '',
                    esc_html__('Yes', 'newshub') => '',
                    esc_html__('No', 'newshub') => 'mkd-no-spacing',
                ),
                'save_always' => true,
                'group' => esc_html__('Post Item','newshub')
            )
        );

        $params_non_feature_array = array_merge($params_non_feature_array, $params_non_feature_additonal_array);
        // NON-FEATURED POSTS OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_slider_array,
            $params_non_feature_title_array,
            $params_non_feature_array
        );

        return $params_array;
    }
}


/**
 *
 * Visual Composer options for slider 3 shortcode
 *
 */
if (!function_exists('newshub_mikado_get_slider_three_params')) {
    /**
     * Function that returns array of predefined params formatted for Visual Composer
     *
     * @return array of params
     *
     */
    function newshub_mikado_get_slider_three_params() {

        // SLIDER OPTIONS - BEGIN
        $params_slider_array = newshub_mikado_get_slider_shortcode_params(
            array(
                'slider_slides_to_scroll',
                'slider_slides_to_show',
                'slider_center_mode',
            ));
        // SLIDER OPTIONS - END

        // GENERAL OPTIONS - BEGIN
        $params_general_array = newshub_mikado_get_general_shortcode_params(
            array(
                'column_number',
                'block_proportion',
                'number_of_posts_dropdown',
                'title',
            ));
        // GENERAL OPTIONS - END

        // NON-FEATURED POST TITLE OPTIONS - START
        $params_non_feature_title_array = newshub_mikado_get_non_feature_title_shortcode_params(
            array(
                'display_title_separator',
            ));
        // NON-FEATURED POST TITLE OPTIOMS - END

        // NON-FEATURED POSTS OPTIONS - START
        $params_non_feature_array = newshub_mikado_get_non_feature_shortcode_params(
            array(
                'horizontally_centered_content',
                'vertically_centered_content',
                'custom_thumb_image_width',
                'custom_thumb_image_height',
                'thumb_image_size',
                'thumb_image_width',
                'thumb_image_height',
                'display_post_type_icon',
                'post_type_icon_size',
                'excerpt_length',
                'display_share',
                'display_rating',
                'display_separator',
            ));
        // NON-FEATURED POSTS OPTIONS - END

        // PAGINATION OPTIONS - START
        // PAGINATION OPTIONS - END

        $params_array = array_merge(
            $params_general_array,
            $params_slider_array,
            $params_non_feature_title_array,
            $params_non_feature_array
        );

        return $params_array;
    }
}