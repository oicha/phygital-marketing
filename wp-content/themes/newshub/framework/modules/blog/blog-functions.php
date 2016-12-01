<?php
if (!function_exists('newshub_mikado_get_blog')) {
    /**
     * Function which return holder for all blog lists
     *
     * @return holder.php template
     */
    function newshub_mikado_get_blog($type) {

        $sidebar = newshub_mikado_sidebar_layout();

        $params = array(
            "blog_type" => $type,
            "sidebar" => $sidebar,
        );
        newshub_mikado_get_module_template_part('templates/lists/holder', 'blog', '', $params);
    }
}

if (!function_exists('newshub_mikado_get_blog_type')) {

    /**
     * Function which create query for blog lists
     *
     * @return blog list template
     */

    function newshub_mikado_get_blog_type($type) {
        global $wp_query;

        $id = newshub_mikado_get_page_id();
        $category = get_post_meta($id, "mkd_blog_category_meta", true);
        $post_number = esc_attr(get_post_meta($id, "mkd_show_posts_per_page_meta", true));

        $paged = newshub_mikado_paged();

        if (!is_archive()) {
            $blog_query = new WP_Query('post_type=post&paged=' . $paged . '&cat=' . $category . '&posts_per_page=' . $post_number . '&post_status=publish');
        } else {
            $blog_query = $wp_query;
        }

        if (newshub_mikado_options()->getOptionValue('blog_page_range') != "") {
            $blog_page_range = esc_attr(newshub_mikado_options()->getOptionValue('blog_page_range'));
        } else {
            $blog_page_range = $blog_query->max_num_pages;
        }

        $blog_classes = newshub_mikado_get_blog_holder_classes($type);
        $blog_data_params = newshub_mikado_set_blog_holder_data_params($type);

        $params = array(
            'blog_query' => $blog_query,
            'paged' => $paged,
            'blog_page_range' => $blog_page_range,
            'blog_type' => $type,
            'blog_classes' => $blog_classes,
            'blog_data_params' => $blog_data_params
        );

        newshub_mikado_get_module_template_part('templates/lists/' . $type, 'blog', '', $params);
    }
}

if (!function_exists('newshub_mikado_get_blog_holder_classes')) {
    /**
     * Function set blog holder class
     *
     * return string
     */

    function newshub_mikado_get_blog_holder_classes($type) {


        $show_load_more = newshub_mikado_enable_load_more();

        $blog_classes = array(
            'mkd-blog-holder'
        );

        if ($show_load_more) {
            $blog_classes[] = 'mkd-blog-load-more';
        }

        switch ($type) {

            case 'standard':
                $blog_classes[] = 'mkd-blog-type-standard';
                break;

            case 'standard-whole-post':
                $blog_classes[] = 'mkd-blog-type-standard';
                break;

            case 'featured-with-rest-small':
                $blog_classes[] = 'mkd-blog-type-featured-with-rest-small';
                break;

            case 'masonry':
                $blog_classes[] = 'mkd-blog-type-masonry';
                break;

            case 'first-post-full-content':
                $blog_classes[] = 'mkd-blog-type-first-post-full-content';
                break;

            case 'one-big-two-small':
                $blog_classes[] = 'mkd-blog-type-one-big-two-small';
                break;

            default:
                $blog_classes[] = 'mkd-blog-type-standard';
                break;
        }

        if ($type == 'masonry') {

            $masonry_columns = newshub_mikado_get_meta_field_intersect('blog_list_masonry_column');

            switch ($masonry_columns) {
                case 'four':
                    $blog_classes[] = 'mkd-post-columns-4';
                    break;
                case 'three':
                    $blog_classes[] = 'mkd-post-columns-3';
                    break;
                case 'two':
                    $blog_classes[] = 'mkd-post-columns-2';
                    break;
                default:
                    $blog_classes[] = 'mkd-post-columns-1';
                    break;
            }

        }

        if ($type == 'standard' || $type == 'standard-whole-post') {
            if (newshub_mikado_options()->getOptionValue('blog_list_horizontal_content_centering') == 'yes') {
                $blog_classes[] = 'mkd-horizontally-centered-content';
            }
        } else {
            if (newshub_mikado_options()->getOptionValue('blog_list_' . str_replace('-', '_', $type) . '_horizontal_content_centering') == 'yes') {
                $blog_classes[] = 'mkd-horizontally-centered-content';
            }
        }


        return implode(' ', $blog_classes);
    }

}

if (!function_exists('newshub_mikado_get_blog_query')) {
    /**
     * Function which create query for blog lists
     *
     * @return wp query object
     */
    function newshub_mikado_get_blog_query() {
        global $wp_query;

        $id = newshub_mikado_get_page_id();
        $category = esc_attr(get_post_meta($id, "mkd_blog_category_meta", true));
        if (esc_attr(get_post_meta($id, "mkd_show_posts_per_page_meta", true)) != "") {
            $post_number = esc_attr(get_post_meta($id, "mkd_show_posts_per_page_meta", true));
        } else {
            $post_number = esc_attr(get_option('posts_per_page'));
        }

        $paged = newshub_mikado_paged();
        $query_array = array(
            'post_type' => 'post',
            'paged' => $paged,
            'cat' => $category,
            'posts_per_page' => $post_number
        );
        if (is_archive()) {
            $blog_query = $wp_query;
        } else {
            $blog_query = new WP_Query($query_array);
        }
        return $blog_query;

    }
}

if (!function_exists('newshub_mikado_get_post_format_html')) {

    /**
     * Function which return html for post formats
     * @param $type
     * @return post hormat template
     */

    function newshub_mikado_get_post_format_html($type = "") {

        $post_format = get_post_format();
        $supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');

        if (in_array($post_format, $supported_post_formats)) {
            $post_format = $post_format;
        } else {
            $post_format = 'standard';
        }

        $slug = '';
        if ($type !== "") {
            if ($type == 'first-post-full-content') {
                $slug = 'standard-whole-post';
            } else {
                $slug = $type;
            }
        }

        $params = newshub_mikado_get_post_global_options($type);

        newshub_mikado_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);
    }
}

if (!function_exists('newshub_mikado_get_layout_post_format_html')) {

    /**
     * Function which return html for post formats
     * @param string $type is type of blog template
     * @param string $part is used to get specific options cuz some blog list can have more then one type of payouts
     * @param string $layout_template is type of layout that need to be rendered
     * @return post hormat template
     */

    function newshub_mikado_get_layout_post_format_html($type = "", $part = 'first', $layout_template = "post-template-one") {

        $params = newshub_mikado_get_post_global_options($type, $part, $layout_template);
        echo newshub_mikado_get_list_shortcode_module_template_part($layout_template, 'templates', '', $params);

    }
}

if (!function_exists('newshub_mikado_get_post_global_options')) {
    /**
     * Function which return array of global options for specific blog template type
     *
     * @param string $type is blog template
     * @param string $type is type of blog template
     * @param string $part is used to get specific options cuz some blog list can have more then one type of payouts
     * @param string $layout_template is type of layout that need to be rendered
     * @return string
     */

    function newshub_mikado_get_post_global_options($type = "", $part = 'first', $layout_template = "post-template-one") {

        $params = newshub_mikado_get_post_specific_type_options($type, $layout_template); // get default values for specific blog template

        if ($type === '' || $type === 'standard' || $type === 'standard-whole-post') {
            $prefix = 'blog_list';
        } else {
            $prefix = 'blog_list_' . $type;
        }

        $prefix = str_replace('-', '_', $prefix);

        $title_tag = 'h3';
        if ($part == 'first') {
            if (newshub_mikado_options()->getOptionValue($prefix . '_title_tag') !== '') {
                $title_tag = newshub_mikado_options()->getOptionValue($prefix . '_title_tag');
            }
        } else {
            if (newshub_mikado_options()->getOptionValue($prefix . '_title_tag_' . $part) !== '') {
                $title_tag = newshub_mikado_options()->getOptionValue($prefix . '_title_tag_' . $part);
            }
        }

        $params['title_tag'] = $title_tag;

        $title_length = '';

        if ($part == 'first') {
            if (newshub_mikado_options()->getOptionValue($prefix . '_title_length') !== '') {
                $title_length = newshub_mikado_options()->getOptionValue($prefix . '_title_length');
            }
        } else {
            if (newshub_mikado_options()->getOptionValue($prefix . '_title_length_' . $part) !== '') {
                $title_length = newshub_mikado_options()->getOptionValue($prefix . '_title_length_' . $part);
            }
        }

        $params['title_length'] = $title_length;

        $display_title_separator = 'no';
        if (newshub_mikado_options()->getOptionValue($prefix . '_separator') !== '') {
            $display_title_separator = newshub_mikado_options()->getOptionValue($prefix . '_separator');
        }

        $params['display_title_separator'] = $display_title_separator;

        $params['excerpt_length'] = '';
        if (newshub_mikado_blog_lists_number_of_chars($type)) {
            $params['excerpt_length'] = newshub_mikado_blog_lists_number_of_chars($type);
        }

        $display_category = 'yes';
        if (newshub_mikado_options()->getOptionValue($prefix . '_category') !== '') {
            $display_category = newshub_mikado_options()->getOptionValue($prefix . '_category');
        }

        $params['display_category'] = $display_category;

        $display_date = 'yes';
        if (newshub_mikado_options()->getOptionValue($prefix . '_date') !== '') {
            $display_date = newshub_mikado_options()->getOptionValue($prefix . '_date');
        }

        $params['display_date'] = $display_date;

        $display_author = 'no';
        if (newshub_mikado_options()->getOptionValue($prefix . '_author') !== '') {
            $display_author = newshub_mikado_options()->getOptionValue($prefix . '_author');
        }

        $params['display_author'] = $display_author;

        $display_comments = 'yes';
        if (newshub_mikado_options()->getOptionValue($prefix . '_comment') !== '') {
            $display_comments = newshub_mikado_options()->getOptionValue($prefix . '_comment');
        }

        $params['display_comments'] = $display_comments;

        $display_like = 'no';
        if (newshub_mikado_options()->getOptionValue($prefix . '_like') !== '') {
            $display_like = newshub_mikado_options()->getOptionValue($prefix . '_like');
        }

        $params['display_like'] = $display_like;

        $display_count = 'no';
        if (newshub_mikado_options()->getOptionValue($prefix . '_count') !== '') {
            $display_count = newshub_mikado_options()->getOptionValue($prefix . '_count');
        }

        $params['display_count'] = $display_count;

        $display_share = 'no';
        if (newshub_mikado_options()->getOptionValue('enable_social_share') == 'yes' &&
            newshub_mikado_options()->getOptionValue('enable_social_share_on_post') == 'yes' &&
            newshub_mikado_options()->getOptionValue($prefix . '_share') !== '') {
            $display_share = newshub_mikado_options()->getOptionValue($prefix . '_share');
        }

        $params['display_share'] = $display_share;

        $display_feature_image = true;
        if (newshub_mikado_options()->getOptionValue($prefix . '_feature_image') === 'no') {
            $display_feature_image = false;
        }

        $params['display_feature_image'] = $display_feature_image;

        $display_read_more = false;
        if (newshub_mikado_options()->getOptionValue($prefix . '_read_more') === 'yes') {
            $display_read_more = true;
        }

        $params['display_read_more'] = $display_read_more;
        $params['blog_type'] = $type;
        $params['excerpt_style'] = '';


        return $params;


    }

}

if (!function_exists('newshub_mikado_get_post_specific_type_options')) {
    /**
     * Function which return array of specific options for specific blog template type or empty array
     *
     * @param string $type is blog template
     * @return string
     */

    function newshub_mikado_get_post_specific_type_options($type = "", $layout_template) {

        $params = array();

        if ($type === 'featured-with-rest-small' || $type === 'first-post-full-content' || $type === 'one-big-two-small') {

            $params['title_style'] = '';

            if ($type == 'one-big-two-small' && $layout_template == 'post-template-six') {
                $params['display_excerpt'] = 'no';
                $params['thumb_image_size'] = 'custom_size';
                $params['thumb_image_width'] = '375';
                $params['thumb_image_height'] = '409';
            } else {
                $params['display_excerpt'] = 'yes';
                $params['thumb_image_size'] = 'original';
            }

            $params['display_post_type_icon'] = 'no';
            $params['date_format'] = '';
            $params['display_rating'] = 'no';

            $prefix = 'blog_list_' . $type;
            $prefix = str_replace('-', '_', $prefix);

            $title_tag_second = 'h5';
            if (newshub_mikado_options()->getOptionValue($prefix . '_title_second') !== '') {
                $title_tag_second = newshub_mikado_options()->getOptionValue($prefix . '_title_second');
            }

            $params['title_tag_second'] = $title_tag_second;

            $title_second_length = '';
            if (newshub_mikado_options()->getOptionValue($prefix . '_title_second_length') !== '') {
                $title_second_length = newshub_mikado_options()->getOptionValue($prefix . '_title_second_length');
            }

            $params['title_second_length'] = $title_second_length;

        }

        return $params;


    }

}

if (!function_exists('newshub_mikado_get_blog_masonry_gallery_classes')) {
    /**
     * Function which return default blog list for archive post types
     *
     * @return string
     */

    function newshub_mikado_get_blog_masonry_gallery_classes($id) {

        $blog_single_masonry_type = get_post_meta($id, 'mkd_blog_single_masonry_type', true);

        switch ($blog_single_masonry_type) {
            case 'large-width' : {
                return 'newshub_mikado_large_width';
            }
                break;
            case 'large-height' : {
                return 'newshub_mikado_large_height';
            }
                break;
            case 'square' : {
                return 'newshub_mikado_square';
            }
                break;
            default : {
                return 'default';
            }
        }

    }

}

if (!function_exists('newshub_mikado_set_blog_holder_data_params')) {
    /**
     * Function which set data params on blog holder div
     */
    function newshub_mikado_set_blog_holder_data_params($type) {

        $show_load_more = newshub_mikado_enable_load_more();
        if ($show_load_more) {
            $current_query = newshub_mikado_get_blog_query();

            $data_params = array();
            $data_return_string = '';

            $data_params['data-blog-type'] = $type;

            $paged = newshub_mikado_paged();

            if (get_post_meta(get_the_ID(), "mkd_show_posts_per_page_meta", true) != "") {
                $posts_number = get_post_meta(get_the_ID(), "mkd_show_posts_per_page_meta", true);
            } else {
                $posts_number = get_option('posts_per_page');
            }
            $category = get_post_meta(newshub_mikado_get_page_id(), 'mkd_blog_category_meta', true);


            //set data params
            $data_params['data-next-page'] = $paged + 1;
            $data_params['data-max-pages'] = $current_query->max_num_pages;

            if ($posts_number != '') {
                $data_params['data-post-number'] = $posts_number;
            }

            if ($category != '') {
                $data_params['data-category'] = $category;
            }

            if (is_archive()) {
                if (is_category()) {
                    $cat_id = get_queried_object_id();
                    $data_params['data-archive-category'] = $cat_id;
                }
                if (is_author()) {
                    $author_id = get_queried_object_id();
                    $data_params['data-archive-author'] = $author_id;
                }
                if (is_tag()) {
                    $current_tag_id = get_queried_object_id();
                    $data_params['data-archive-tag'] = $current_tag_id;
                }
                if (is_date()) {
                    $day = get_query_var('day');
                    $month = get_query_var('monthnum');
                    $year = get_query_var('year');

                    $data_params['data-archive-day'] = $day;
                    $data_params['data-archive-month'] = $month;
                    $data_params['data-archive-year'] = $year;
                }
            }
            if (is_search()) {
                $search_query = get_search_query();
                $data_params['data-archive-search-string'] = $search_query; // to do, not finished
            }

            foreach ($data_params as $key => $value) {
                if ($key !== '') {
                    $data_return_string .= $key . '= ' . esc_attr($value) . ' ';
                }
            }

            return $data_return_string;

        }
    }
}

if (!function_exists('newshub_mikado_enable_load_more')) {
    /**
     * Function that check if load more is enabled
     *
     * return boolean
     */
    function newshub_mikado_enable_load_more() {
        $enable_load_more = false;

        if (newshub_mikado_options()->getOptionValue('pagination') == 'yes') {

            if (newshub_mikado_options()->getOptionValue('pagination_type') == 'load_more_pagination') {

                $enable_load_more = true;

            }

        }

        return $enable_load_more;
    }
}

if (!function_exists('newshub_mikado_is_masonry_template')) {
    /**
     * Check if is masonry template enabled
     * return boolean
     */
    function newshub_mikado_is_masonry_template() {

        $page_id = newshub_mikado_get_page_id();
        $page_template = get_page_template_slug($page_id);
        $page_options_template = newshub_mikado_options()->getOptionValue('blog_list_type');

        if (!is_archive()) {
            if ($page_template == 'blog-masonry.php') {
                return true;
            }
        } elseif (is_archive() || is_home()) {
            if ($page_options_template == 'masonry') {
                return true;
            }
        } else {
            return false;
        }
    }


}

if (!function_exists('newshub_mikado_get_default_blog_list')) {
    /**
     * Function which return default blog list for archive post types
     *
     * @return post format template
     */

    function newshub_mikado_get_default_blog_list() {

        $blog_list = newshub_mikado_options()->getOptionValue('blog_list_type');

        if (strpos($blog_list, 'type') !== false) {
            $blog_list = 'unique-type';
        }

        return $blog_list;
    }
}

if (!function_exists('newshub_mikado_get_category_blog_list')) {
    /**
     * Function which return blog list for category post types
     *
     * @return post format template
     */

    function newshub_mikado_get_category_blog_list() {

        $blog_list = newshub_mikado_options()->getOptionValue('blog_list_type');

        if (strpos($blog_list, 'type') !== false) {
            $blog_list = 'unique-type';
        }

        if (newshub_mikado_options()->getOptionValue('unique_category_layout') === 'yes') {
            $blog_list = 'unique-category-layout';
        }

        return $blog_list;
    }
}

if (!function_exists('newshub_mikado_get_author_blog_list')) {
    /**
     * Function which return blog list for author post types
     *
     * @return post format template
     */

    function newshub_mikado_get_author_blog_list() {

        $blog_list = newshub_mikado_options()->getOptionValue('blog_list_type');

        if (strpos($blog_list, 'type') !== false) {
            $blog_list = 'unique-type';
        }

        if (newshub_mikado_options()->getOptionValue('unique_author_layout') === 'yes') {
            $blog_list = 'unique-author-layout';
        }

        return $blog_list;
    }
}

if (!function_exists('newshub_mikado_get_tag_blog_list')) {
    /**
     * Function which return blog list for tag post types
     *
     * @return post format template
     */

    function newshub_mikado_get_tag_blog_list() {

        $blog_list = newshub_mikado_options()->getOptionValue('blog_list_type');

        if (strpos($blog_list, 'type') !== false) {
            $blog_list = 'unique-type';
        }

        if (newshub_mikado_options()->getOptionValue('unique_tag_layout') === 'yes') {
            $blog_list = 'unique-tag-layout';
        }

        return $blog_list;
    }
}

if (!function_exists('newshub_mikado_pagination')) {

    /**
     * Function which return pagination
     *
     * @return blog list pagination html
     */

    function newshub_mikado_pagination($pages = '', $range = 4, $paged = 1) {

        $showitems = $range + 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }
        if (1 != $pages) {

            echo '<div class="mkd-pagination-new-holder">' . get_the_posts_pagination() . '</div>';

            echo '<div class="mkd-pagination">';
            echo '<ul>';
            if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
                echo '<li class="mkd-pagination-first-page"><a href="' . esc_url(get_pagenum_link(1)) . '"><span class="mkd-pagination-icon arrow_carrot-2left"></span></a></li>';
            }
            if ($paged > 1) {
                echo "<li class='mkd-pagination-prev'><a href='" . esc_url(get_pagenum_link($paged - 1)) . "'><span class='mkd-pagination-icon arrow_carrot-left'></span></a></li>";
            }
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    echo ($paged == $i) ? "<li class='active'><span>" . $i . "</span></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive'>" . $i . "</a></li>";
                }
            }
            if ($paged !== intval($pages)) {
                echo '<li class="mkd-pagination-next"><a href="';
                if ($pages > $paged) {
                    echo esc_url(get_pagenum_link($paged + 1));
                } else {
                    echo esc_url(get_pagenum_link($paged));
                }
                echo '"><span class="mkd-pagination-icon arrow_carrot-right"></span></a></li>';
            }

            if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
                echo '<li class="mkd-pagination-last-page"><a href="' . esc_url(get_pagenum_link($pages)) . '"><span class="mkd-pagination-icon arrow_carrot-2right"></span></a></li>';
            }
            echo '</ul>';
            echo "</div>";
        }
    }
}

if (!function_exists('newshub_mikado_post_info')) {
    /**
     * Function that loads parts of blog post info section
     * Possible options are:
     * 1. date
     * 2. category
     * 3. author
     * 4. comments
     * 5. like
     * 6. share
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info($config) {
        $default_config = array(
            'category' => '',
            'date' => '',
            'author' => '',
            'comments' => '',
            'like' => '',
            'count' => '',
            'share' => ''
        );

        extract(shortcode_atts($default_config, $config));

        if ($category == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-category', 'blog');
        }
        if ($author == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-author', 'blog');
        }
        if ($date == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-date', 'blog', '', array('date_format' => ''));
        }
        if ($like == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-like', 'blog');
        }
        if ($comments == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog');
        }
        if ($share == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-share', 'blog', '', array('type' => 'dropdown'));
        }
        if ($count == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-count', 'blog');
        }
    }
}

if (!function_exists('newshub_mikado_post_info_date')) {
    /**
     * Function that loads parts of blog post date info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_date($config) {
        $default_config = array(
            'date' => '',
            'date_format' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['date'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-date', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_category')) {
    /**
     * Function that loads parts of blog post category info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_category($config) {
        $default_config = array(
            'category' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['category'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-category', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_author')) {
    /**
     * Function that loads parts of blog post author info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_author($config) {
        $default_config = array(
            'author' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['author'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-author', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_comments')) {
    /**
     * Function that loads parts of blog post comments info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_comments($config) {
        $default_config = array(
            'comments' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['comments'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-comments', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_like')) {
    /**
     * Function that loads parts of blog post author info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_like($config) {
        $default_config = array(
            'like' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['like'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-like', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_count')) {
    /**
     * Function that loads parts of blog post author info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_count($config) {
        $default_config = array(
            'count' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['count'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-count', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_share')) {
    /**
     * Function that loads parts of blog post share info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_share($config) {
        $default_config = array(
            'share' => '',
            'type' => 'dropdown',
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['share'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-share', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_rating')) {
    /**
     * Function that loads parts of blog post rating info section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_rating($config) {
        $default_config = array(
            'rating' => ''
        );

        $params = (shortcode_atts($default_config, $config));

        if ($params['rating'] == 'yes') {

            $params['post_rating'] = newshub_mikado_get_post_rating();

            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-rating', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_post_info_type')) {
    /**
     * Function that loads parts of blog post type icon section
     *
     * @param $config array of sections to load
     */
    function newshub_mikado_post_info_type($config) {
        $default_config = array(
            'icon' => '',
            'size' => '',
        );

        $params = (shortcode_atts($default_config, $config));

        $params['post_type'] = get_post_format() ? 'mkd-post-' . get_post_format() : 'mkd-post-standard';

        if ($params['post_type'] == 'mkd-post-video') {
            $params['video_link'] = newshub_mikado_get_single_blog_video_link(get_the_ID());
        }

        if ($params['icon'] == 'yes') {
            newshub_mikado_get_module_template_part('templates/parts/post-info/post-info-icon-type', 'blog', '', $params);
        }
    }
}

if (!function_exists('newshub_mikado_get_single_blog_video_link')) {

    function newshub_mikado_get_single_blog_video_link($postID) {
        $_video_type = get_post_meta($postID, "mkd_video_type_meta", true);

        $video_link = '';

        if ($_video_type == "social_networks") {
            $video_link = esc_attr(get_post_meta(get_the_ID(), "mkd_post_video_link_meta", true));
        } elseif ($_video_type == "self") {
            $video_link = esc_url(get_post_meta(get_the_ID(), "mkd_post_video_mp4_link_meta", true)) . '?iframe=true&width50%&height=50%';
        }

        return $video_link;
    }
}

if (!function_exists('newshub_mikado_excerpt')) {
    /**
     * Function that cuts post excerpt to the number of word based on previosly set global
     * variable $word_count, which is defined in mkd_set_blog_word_count function.
     *
     * It current post has read more tag set it will return content of the post, else it will return post excerpt
     *
     */
    function newshub_mikado_excerpt($excerpt_length) {
        global $post;

        if (post_password_required()) {
            echo get_the_password_form();
        } //does current post has read more tag set?
        elseif (newshub_mikado_post_has_read_more()) {
            global $more;

            //override global $more variable so this can be used in blog templates
            $more = 0;
            the_content(true);
        } //is word count set to something different that 0?
        elseif ($excerpt_length != '0') {
            //if word count is set and different than empty take that value, else that general option from theme options
            $word_count = '45';
            if (isset($excerpt_length) && $excerpt_length != "") {
                $word_count = $excerpt_length;
            } elseif (newshub_mikado_blog_lists_number_of_chars() != '') {
                $word_count = esc_attr(newshub_mikado_blog_lists_number_of_chars());
            }
            //if post excerpt field is filled take that as post excerpt, else that content of the post
            $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

            //remove leading dots if those exists
            $clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

            //if clean excerpt has text left
            if ($clean_excerpt !== '') {
                //explode current excerpt to words
                $excerpt_word_array = explode(' ', $clean_excerpt);

                //cut down that array based on the number of the words option
                $excerpt_word_array = array_slice($excerpt_word_array, 0, $word_count);

                //and finally implode words together
                $excerpt = implode(' ', $excerpt_word_array);

                //is excerpt different than empty string?
                if ($excerpt !== '') {
                    echo '<p class="mkd-post-excerpt">' . wp_kses_post($excerpt) . '</p>';
                }
            }
        }
    }
}

if (!function_exists('newshub_mikado_get_blog_single')) {

    /**
     * Function which return holder for single posts
     *
     * @return single holder.php template
     */

    function newshub_mikado_get_blog_single() {
        $sidebar = newshub_mikado_sidebar_layout();

        $params = array(
            "sidebar" => $sidebar
        );

        newshub_mikado_get_module_template_part('templates/single/holder', 'blog', '', $params);
    }
}

if (!function_exists('newshub_mikado_get_single_html')) {

    /**
     * Function return all parts on single.php page
     *
     *
     * @return single.php html
     */
    function newshub_mikado_get_single_html() {

        $post_format = get_post_format();
        if ($post_format === false) {
            $post_format = 'standard';
        }

        $params = array();

        $display_category = 'yes';
        if (newshub_mikado_options()->getOptionValue('blog_single_category') !== '') {
            $display_category = newshub_mikado_options()->getOptionValue('blog_single_category');
        }

        $display_date = 'yes';
        if (newshub_mikado_options()->getOptionValue('blog_single_date') !== '') {
            $display_date = newshub_mikado_options()->getOptionValue('blog_single_date');
        }

        $display_author = 'yes';
        if (newshub_mikado_options()->getOptionValue('blog_single_author') !== '') {
            $display_author = newshub_mikado_options()->getOptionValue('blog_single_author');
        }

        $display_comments = newshub_mikado_show_comments() ? 'yes' : 'no';

        $display_like = 'no';
        if (newshub_mikado_options()->getOptionValue('blog_single_like') !== '') {
            $display_like = newshub_mikado_options()->getOptionValue('blog_single_like');
        }

        $display_count = 'yes';
        if (newshub_mikado_options()->getOptionValue('blog_single_count') !== '') {
            $display_count = newshub_mikado_options()->getOptionValue('blog_single_count');
        }

        $show_ratings = 'yes';
        if (newshub_mikado_options()->getOptionValue('blog_single_ratings') !== '') {
            $show_ratings = (newshub_mikado_options()->getOptionValue('blog_single_ratings'));
        }

        $params['display_category'] = $display_category;
        $params['display_date'] = $display_date;
        $params['display_author'] = $display_author;
        $params['display_comments'] = $display_comments;
        $params['display_like'] = $display_like;
        $params['display_count'] = $display_count;
        $params['display_ratings'] = $show_ratings;
        $params['post_type'] = $post_format;

        newshub_mikado_get_module_template_part('templates/single/parts/title', 'blog', '', $params);
		
		newshub_mikado_get_module_template_part('templates/single/parts/category', 'blog', '', $params);

		newshub_mikado_get_module_template_part('templates/single/parts/tags', 'blog');	
		
		//newshub_mikado_get_module_template_part('templates/single/parts/tag-a-cat', 'blog');	
		
        newshub_mikado_get_module_template_part('templates/single/parts/meta', 'blog', '', $params);
		
		newshub_mikado_get_module_template_part('templates/single/parts/sns', 'blog');

        newshub_mikado_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog', '', $params);

		newshub_mikado_get_module_template_part('templates/single/parts/cbtn', 'blog');
		
        newshub_mikado_get_module_template_part('templates/single/parts/share', 'blog', '', array('type' => 'list'));

        newshub_mikado_get_module_template_part('templates/single/parts/ratings', 'blog', '', $params);

        newshub_mikado_get_single_related_posts();

        newshub_mikado_get_module_template_part('templates/single/parts/author-info', 'blog');
		
		newshub_mikado_get_module_template_part('templates/single/parts/tags', 'blog');	

        newshub_mikado_get_module_template_part('templates/single/parts/single-navigation', 'blog');

        if (newshub_mikado_show_comments()) {
            comments_template('', true);
        }
    }
}

if (!function_exists('newshub_mikado_get_single_related_posts')) {

    /**
     * Function returns related posts on single.php page
     *
     *
     * @return single.php html
     */
    function newshub_mikado_get_single_related_posts() {

        $post_id = newshub_mikado_get_page_id();

        //Related posts
        $related_posts_params = array();
        $show_related = (newshub_mikado_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
        if ($show_related) {
            $related_post_number = 2;
            $related_posts_options = array('posts_per_page' => $related_post_number);
            $related_posts_image_size = (newshub_mikado_options()->getOptionValue('blog_single_related_image_size') !== '') ? intval(newshub_mikado_options()->getOptionValue('blog_single_related_image_size')) : '';
            $related_posts_title_size = (newshub_mikado_options()->getOptionValue('blog_single_related_title_size') !== '') ? intval(newshub_mikado_options()->getOptionValue('blog_single_related_title_size')) : '35';
            $related_posts_params = array('related_posts' => newshub_mikado_get_related_post_type($post_id, $related_posts_options), 'related_posts_image_size' => $related_posts_image_size, 'related_posts_title_size' => $related_posts_title_size, 'related_posts_number' => $related_post_number);
        }

        if ($show_related) {
            newshub_mikado_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
        }
    }
}

if (!function_exists('newshub_mikado_additional_post_items')) {

    /**
     * Function which return parts on single.php which are just below content
     *
     * @return single.php html
     */
    function newshub_mikado_additional_post_items() {

        $args_pages = array(
            'before' => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
            'after' => '</div></div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '%'
        );

        wp_link_pages($args_pages);
    }

    add_action('newshub_mikado_before_blog_article_closed_tag', 'newshub_mikado_additional_post_items');
}

if (!function_exists('newshub_mikado_additional_post_list_items')) {

    /**
     * Function which return parts on default blog list which are just below content
     *
     * @return tags html
     */
    function newshub_mikado_additional_post_list_items() {

        newshub_mikado_get_module_template_part('templates/lists/parts/tags', 'blog');

        $args_pages = array(
            'before' => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
            'after' => '</div></div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'pagelink' => '%'
        );

        wp_link_pages($args_pages);

    }

    add_action('newshub_mikado_blog_list_tags', 'newshub_mikado_additional_post_list_items');
}

if (!function_exists('newshub_mikado_comment')) {

    /**
     * Function which modify default wordpress comments
     *
     * @return comments html
     */
    function newshub_mikado_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;

        global $post;

        $is_pingback_comment = $comment->comment_type == 'pingback';
        $is_author_comment = $post->post_author == $comment->user_id;

        $comment_class = 'mkd-comment clearfix';

        if ($is_author_comment) {
            $comment_class .= ' mkd-post-author-comment';
        }

        if ($is_pingback_comment) {
            $comment_class .= ' mkd-pingback-comment';
        }
        ?>
        <li>
        <div class="<?php echo esc_attr($comment_class); ?>">
            <?php if (!$is_pingback_comment) { ?>
                <div class="mkd-comment-image"> <?php echo newshub_mikado_kses_img(get_avatar($comment, 90)); ?> </div>
            <?php } ?>
            <div class="mkd-comment-text-and-info">
                <div class="mkd-comment-info-and-links">
                    <h6 class="mkd-comment-name">
                        <?php if ($is_pingback_comment) {
                            esc_html_e('Pingback:', 'newshub');
                        } ?>
                        <span class="mkd-comment-author"><?php echo wp_kses_post(get_comment_author_link()); ?></span>
                        <?php if ($is_author_comment) { ?>
                            <span class="mkd-comment-author-label"><?php esc_html_e('(Author)', 'newshub'); ?></span>
                        <?php } ?>
                        <span class="mkd-comment-mark"><?php esc_html_e('/', 'newshub'); ?></span>
                        <span class="mkd-comment-date"><?php comment_time(get_option('date_format')); ?></span>
                    </h6>
                </div>
                <?php if (!$is_pingback_comment) { ?>
                    <div class="mkd-comment-text">
                        <div class="mkd-text-holder" id="comment-<?php echo comment_ID(); ?>">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                <?php } ?>
                <h6 class="mkd-comment-links">
                    <?php
                    comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'newshub'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
                    ?>
                    <span class="mkd-comment-mark"><?php esc_html_e('/', 'newshub'); ?></span>
                    <?php
                    edit_comment_link(esc_html__('Edit', 'newshub'));
                    ?>
                </h6>
            </div>
        </div>
        <?php //li tag will be closed by WordPress after looping through child elements
        ?>
        <?php
    }
}

if (!function_exists('newshub_mikado_blog_archive_pages_classes')) {

    /**
     * Function which create classes for container in archive pages
     *
     * @return array
     */
    function newshub_mikado_blog_archive_pages_classes($blog_type) {

        $classes = array();
        if (in_array($blog_type, newshub_mikado_blog_full_width_types())) {
            $classes['holder'] = 'mkd-full-width';
            $classes['inner'] = 'mkd-full-width-inner';
        } elseif (in_array($blog_type, newshub_mikado_blog_grid_types())) {
            $classes['holder'] = 'mkd-container';
            $classes['inner'] = 'mkd-container-inner clearfix';
        }

        return $classes;
    }
}

if (!function_exists('newshub_mikado_blog_full_width_types')) {

    /**
     * Function which return all full width blog types
     *
     * @return array
     */
    function newshub_mikado_blog_full_width_types() {

        $types = array();

        return $types;
    }
}

if (!function_exists('newshub_mikado_blog_grid_types')) {

    /**
     * Function which return in grid blog types
     *
     * @return array
     */
    function newshub_mikado_blog_grid_types() {

        $types = array('standard', 'standard-whole-post', 'unique-category-layout',
            'unique-author-layout', 'unique-tag-layout', 'unique-type',
            'featured-with-rest-small', 'first-post-full-content', 'masonry', 'one-big-two-small');

        return $types;
    }
}

if (!function_exists('newshub_mikado_blog_types')) {

    /**
     * Function which return all blog types
     *
     * @return array
     */
    function newshub_mikado_blog_types() {

        $types = array_merge(newshub_mikado_blog_grid_types(), newshub_mikado_blog_full_width_types());

        return $types;
    }
}

if (!function_exists('newshub_mikado_blog_templates')) {

    /**
     * Function which return all blog templates names
     *
     * @return array
     */
    function newshub_mikado_blog_templates() {

        $templates = array();
        $grid_templates = newshub_mikado_blog_grid_types();
        $full_templates = newshub_mikado_blog_full_width_types();
        foreach ($grid_templates as $grid_template) {
            array_push($templates, 'blog-' . $grid_template);
        }
        foreach ($full_templates as $full_template) {
            array_push($templates, 'blog-' . $full_template);
        }

        return $templates;
    }
}

if (!function_exists('newshub_mikado_blog_lists_number_of_chars')) {

    /**
     * Function that return number of characters for different lists based on options
     *
     * @param string $type is prefix for different blog template
     * @return int
     */
    function newshub_mikado_blog_lists_number_of_chars($type = '') {

        $number_of_chars = '';
        if ($type !== '') {

            if ($type === 'standard' || $type === 'standard-whole-post') {
                $prefix = 'blog_list';
            } else {
                $prefix = 'blog_list_' . $type;
            }

            $prefix = str_replace('-', '_', $prefix);
            if (newshub_mikado_options()->getOptionValue($prefix . '_number_of_chars')) {
                $number_of_chars = newshub_mikado_options()->getOptionValue($prefix . '_number_of_chars');
            }

        } elseif (newshub_mikado_options()->getOptionValue('number_of_chars')) {
            $number_of_chars = newshub_mikado_options()->getOptionValue('number_of_chars');
        }

        return $number_of_chars;
    }
}

if (!function_exists('newshub_mikado_post_has_read_more')) {

    /**
     * Function that checks if current post has read more tag set
     * @return int position of read more tag text. It will return false if read more tag isn't set
     */
    function newshub_mikado_post_has_read_more() {
        global $post;

        return strpos($post->post_content, '<!--more-->');
    }
}

if (!function_exists('newshub_mikado_post_has_title')) {

    /**
     * Function that checks if current post has title or not
     * @return bool
     */
    function newshub_mikado_post_has_title() {
        return get_the_title() !== '';
    }
}

if (!function_exists('newshub_mikado_modify_read_more_link')) {

    /**
     * Function that modifies read more link output.
     * Hooks to the_content_more_link
     * @return string modified output
     */
    function newshub_mikado_modify_read_more_link() {
        $link = '<div class="mkd-more-link-container">';
        $link .= newshub_mikado_get_button_html(array(
            'link' => get_permalink() . '#more-' . get_the_ID(),
            'text' => esc_html__('続きを読む', 'newshub')
        ));

        $link .= '</div>';

        return $link;
    }

    add_filter('the_content_more_link', 'newshub_mikado_modify_read_more_link');
}

if (!function_exists('newshub_mikado_load_blog_assets')) {

    /**
     * Function that checks if blog assets should be loaded
     *
     * @see mkd_is_blog_template()
     * @see is_home()
     * @see is_single()
     * @see mkd_has_blog_shortcode()
     * @see is_archive()
     * @see is_search()
     * @return bool
     */
    function newshub_mikado_load_blog_assets() {
        return newshub_mikado_is_blog_template() || is_home() || is_single() || is_archive() || is_search();
    }
}

if (!function_exists('newshub_mikado_is_blog_template')) {

    /**
     * Checks if current template page is blog template page.
     *
     * @param string current page. Optional parameter.
     *
     * @return bool
     *
     * @see newshub_mikado_get_page_template_name()
     */
    function newshub_mikado_is_blog_template($current_page = '') {

        if ($current_page == '') {
            $current_page = newshub_mikado_get_page_template_name();
        }

        $blog_templates = newshub_mikado_blog_templates();

        return in_array($current_page, $blog_templates);
    }
}

if (!function_exists('newshub_mikado_read_more_button')) {

    /**
     * Function that outputs read more button html if necessary.
     * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
     * and if post isn't password protected
     *
     * @param string $option name of option to check
     * @param string $class additional class to add to button
     * @param array $params
     */
    function newshub_mikado_read_more_button($option = '', $class = '', $params = array()) {
        if ($option != '') {
            $show_read_more_button = newshub_mikado_options()->getOptionValue($option) == 'yes';
        } else {
            $show_read_more_button = 'yes';
        }


        // set default values for params
        $params['type'] = !empty($params['type']) ? $params['type'] : '';
        $params['icon_pack'] = !empty($params['icon_pack']) ? $params['icon_pack'] : '';
        $params['ion_icon'] = !empty($params['ion_icon']) ? $params['ion_icon'] : 'ion-android-arrow-forward';

        if ($show_read_more_button && !newshub_mikado_post_has_read_more() && !post_password_required()) {
            echo newshub_mikado_get_button_html(array(
                'size' => '',
                'type' => $params['type'],
                'link' => get_the_permalink(),
                'text' => esc_html__('Read More', 'newshub'),
                'icon_pack' => $params['icon_pack'],
                // 'icon_pack' => 'ion_icons',
                'ion_icon' => $params['ion_icon'],
                'custom_class' => $class
            ));
        }
    }
}

if (!function_exists('newshub_mikado_blog_load_more')) {

    function newshub_mikado_blog_load_more() {

        $return_obj = array();
        $paged = $post_number = $category = $blog_type = '';
        $archive_category = $archive_author = $archive_tag = $archive_day = $archive_month = $archive_year = '';

        if (isset($_POST['nextPage'])) {
            $paged = $_POST['nextPage'];
        }
        if (isset($_POST['number'])) {
            $post_number = $_POST['number'];
        }
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        if (isset($_POST['blogType'])) {
            $blog_type = $_POST['blogType'];
        }
        if (isset($_POST['archiveCategory'])) {
            $archive_category = $_POST['archiveCategory'];
        }
        if (isset($_POST['archiveAuthor'])) {
            $archive_author = $_POST['archiveAuthor'];
        }
        if (isset($_POST['archiveTag'])) {
            $archive_tag = $_POST['archiveTag'];
        }
        if (isset($_POST['archiveDay'])) {
            $archive_day = $_POST['archiveDay'];
        }
        if (isset($_POST['archiveMonth'])) {
            $archive_month = $_POST['archiveMonth'];
        }
        if (isset($_POST['archiveYear'])) {
            $archive_year = $_POST['archiveYear'];
        }


        $html = '';
        $query_array = array(
            'post_type' => 'post',
            'paged' => $paged,
            'posts_per_page' => $post_number
        );

        if ($category != '') {
            $query_array['cat'] = $category;
        }
        if ($archive_category != '') {
            $query_array['cat'] = $archive_category;
        }
        if ($archive_author != '') {
            $query_array['author'] = $archive_author;
        }
        if ($archive_tag != '') {
            $query_array['tag'] = $archive_tag;
        }
        if ($archive_day != '' && $archive_month != '' && $archive_year != '') {
            $query_array['day'] = $archive_day;
            $query_array['monthnum'] = $archive_month;
            $query_array['year'] = $archive_year;
        }
        $query_results = new \WP_Query($query_array);

        if ($query_results->have_posts()):
            while ($query_results->have_posts()) : $query_results->the_post();
                $html .= newshub_mikado_get_post_format_html($blog_type, 'yes');
            endwhile;
        else:
            $html .= '<p>' . esc_html__('Sorry, no posts matched your criteria.', 'newshub') . '</p>';
        endif;

        $return_obj = array(
            'html' => $html,
        );

        echo json_encode($return_obj);
        exit;
    }
}

add_action('wp_ajax_nopriv_newshub_mikado_blog_load_more', 'newshub_mikado_blog_load_more');
add_action('wp_ajax_newshub_mikado_blog_load_more', 'newshub_mikado_blog_load_more');

if (!function_exists('newshub_mikado_get_max_number_of_pages')) {
    /**
     * Function that return max number of posts/pages for pagination
     * @return int
     *
     * @version 0.1
     */
    function newshub_mikado_get_max_number_of_pages() {
        global $wp_query;

        $max_number_of_pages = 10; //default value

        if ($wp_query) {
            $max_number_of_pages = $wp_query->max_num_pages;
        }

        return $max_number_of_pages;
    }
}

if (!function_exists('newshub_mikado_get_blog_page_range')) {
    /**
     * Function that return current page for blog list pagination
     * @return int
     *
     * @version 0.1
     */
    function newshub_mikado_get_blog_page_range() {
        global $wp_query;

        if (newshub_mikado_options()->getOptionValue('blog_page_range') != "") {
            $blog_page_range = esc_attr(newshub_mikado_options()->getOptionValue('blog_page_range'));
        } else {
            $blog_page_range = $wp_query->max_num_pages;
        }

        return $blog_page_range;
    }
}

if (!function_exists('newshub_mikado_update_post_count_views')) {

    function newshub_mikado_update_post_count_views() {
        $postID = newshub_mikado_get_page_id();
        if (is_singular('post')) {
            if (isset($_COOKIE['mkd-post-views_' . $postID])) {
                return;
            } else {
                $count = get_post_meta($postID, 'count_post_views', true);
                if ($count === '') {
                    update_post_meta($postID, 'count_post_views', 1);
                    setcookie('mkd-post-views_' . $postID, $postID, time() * 20, '/');
                } else {
                    $count++;
                    update_post_meta($postID, 'count_post_views', $count);
                    setcookie('mkd-post-views_' . $postID, $postID, time() * 20, '/');
                }
            }
        }
    }

    add_action('wp', 'newshub_mikado_update_post_count_views');
}

if (!function_exists('newshub_mikado_get_post_count_views')) {

    function newshub_mikado_get_post_count_views($postID) {
        $count = get_post_meta($postID, 'count_post_views', true);
        if ($count === '') {
            update_post_meta($postID, 'count_post_views', '0');
            return 0;
        }
        return $count;
    }
}

if (!function_exists('newshub_mikado_post_rating_ajax_function')) {
    function newshub_mikado_post_rating_ajax_function() {

        $post_ID = '';
        $rating_value = '';
        if (!empty($_POST['postID'])) {
            $post_ID = $_POST['postID'];
        }
        if (!empty($_POST['value'])) {
            $rating_value = $_POST['value'];
        }

        $rateResponse = newshub_mikado_set_post_rating($rating_value, $post_ID); //update total count of rates

        $newRateCount = newshub_mikado_get_post_rating($post_ID); // get total count of votes

        $return_obj = array(
            'newCount' => $newRateCount,
            'rateAnswer' => $rateResponse
        );

        echo json_encode($return_obj);
        exit;

    }

    add_action('wp_ajax_newshub_mikado_post_rating_ajax_function', 'newshub_mikado_post_rating_ajax_function');
    add_action('wp_ajax_nopriv_newshub_mikado_post_rating_ajax_function', 'newshub_mikado_post_rating_ajax_function');
}

if (!function_exists('newshub_mikado_get_post_rating')) {

    function newshub_mikado_get_post_rating($post_id = false) {

        if ($post_id == false) {
            $post_id = get_the_ID();
        }

        $rating_value = get_post_meta($post_id, 'mkd_post_rating_value', true);
        $rating_number_of_rates = get_post_meta($post_id, 'mkd_post_rating_number', true);
        if ($rating_value == '' || $rating_number_of_rates == '') {
            update_post_meta($post_id, 'mkd_post_rating_value', '0');
            update_post_meta($post_id, 'mkd_post_rating_number', '0');
        }

        if ($rating_number_of_rates > 0 && $rating_value > 0) {

            return round($rating_value / ($rating_number_of_rates * 5) * 100, 2);
        } else {
            return 0;
        }
    }
}

if (!function_exists('newshub_mikado_set_post_rating')) {
    /*
     * return string message in html
     */
    function newshub_mikado_set_post_rating($new_rating_value, $post_id = false) {

        if ($post_id == false) {
            $post_id = get_the_ID();
        }

        if (isset($_COOKIE['mkd_post_rating_' . $post_id])) {
            return '<span>' . esc_html__('You already rated this post!', 'newshub') . '</span>';
        } else {

            $rating_number_of_rates = get_post_meta($post_id, 'mkd_post_rating_number', true);
            $rating_value = get_post_meta($post_id, 'mkd_post_rating_value', true);

            if ($rating_number_of_rates == '') {
                update_post_meta($post_id, 'mkd_post_rating_number', 1);
            } else {
                $rating_number_of_rates++;
                update_post_meta($post_id, 'mkd_post_rating_number', $rating_number_of_rates);
            }

            if ($rating_value == '') {
                update_post_meta($post_id, 'mkd_post_rating_value', $new_rating_value);
                setcookie('mkd_post_rating_' . $post_id, $post_id, time() * 20, '/');
                return '<span>' . esc_html__('Thank you! You have succesfully rated this post!', 'newshub') . '</span>';
            } else {
                $rating_value += $new_rating_value;
                update_post_meta($post_id, 'mkd_post_rating_value', $rating_value);
                setcookie('mkd_post_rating_' . $post_id, $post_id, time() * 20, '/');
                return '<span>' . esc_html__('Thank you! You have succesfully rated this post!', 'newshub') . '</span>';
            }
        }
    }
}

if (!function_exists('newshub_mikado_comment_field_to_bottom')) {
    function newshub_mikado_comment_field_to_bottom($fields) {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        $fields['comment'] = $comment_field;

        return $fields;
    }

    add_filter('comment_form_fields', 'newshub_mikado_comment_field_to_bottom');
}

function newshub_mikado_taxonomy_custom_fields($tag) {
    $t_id = $tag->term_id; // Get the ID of the category you're editing  
    $term_meta = get_option("post_tax_term_$t_id");
    ?>

    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Template', 'newshub'); ?></label>
        </th>
        <td>
            <select name="term_meta[template]" id="term_meta[template]">
                <option <?php if (isset($term_meta['template']) && $term_meta['template'] == '') {
                    echo "selected='selected'";
                } ?> value='default'>Default
                </option>
                <option <?php if (isset($term_meta['template']) && $term_meta['template'] == 'type1') {
                    echo "selected='selected'";
                } ?> value='type1'>Template 1
                </option>
                <option <?php if (isset($term_meta['template']) && $term_meta['template'] == 'type2') {
                    echo "selected='selected'";
                } ?> value='type2'>Template 2
                </option>
                <option <?php if (isset($term_meta['template']) && $term_meta['template'] == 'type3') {
                    echo "selected='selected'";
                } ?> value='type3'>Template 3
                </option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Sidebar Layout', 'newshub'); ?></label>
        </th>
        <td>
            <select name="term_meta[sidebar_layout]" id="term_meta[sidebar_layout]">
                <option <?php if (isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == '') {
                    echo "selected='selected'";
                } ?> value=''></option>
                <option <?php if (isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'default') {
                    echo "selected='selected'";
                } ?> value='default'>No Sidebar
                </option>
                <option <?php if (isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-33-right') {
                    echo "selected='selected'";
                } ?> value='sidebar-33-right'>Sidebar 1/3 Right
                </option>
                <option <?php if (isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-25-right') {
                    echo "selected='selected'";
                } ?> value='sidebar-25-right'>Sidebar 1/4 Right
                </option>
                <option <?php if (isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-33-left') {
                    echo "selected='selected'";
                } ?> value='sidebar-33-left'>Sidebar 1/3 Left
                </option>
                <option <?php if (isset($term_meta['sidebar_layout']) && $term_meta['sidebar_layout'] == 'sidebar-25-left') {
                    echo "selected='selected'";
                } ?> value='sidebar-25-left'>Sidebar 1/4 Left
                </option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Custom Sidebar To Display', 'newshub'); ?></label>
        </th>
        <td>
            <select name="term_meta[custom_sidebar]" id="term_meta[custom_sidebar]">
                <option <?php if (isset($term_meta['custom_sidebar']) && $term_meta['custom_sidebar'] == '') {
                    echo "selected='selected'";
                } ?> value=''></option>
                <?php
                $custom_sidebars = newshub_mikado_get_custom_sidebars();
                foreach ($custom_sidebars as $key => $value) { ?>
                    <option <?php if (isset($term_meta['custom_sidebar']) && $term_meta['custom_sidebar'] == $key) {
                        echo "selected='selected'";
                    } ?> value='<?php echo esc_attr($key); ?>'><?php echo esc_attr($value); ?></option>
                <?php } ?>

            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Template Settings', 'newshub'); ?></label>
        </th>
    </tr>
    <tr>
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e(' - Post Settings', 'newshub'); ?></label>
            <p class="description"><?php esc_html_e('This options work only for Template 1, Template 2 or Template 3', 'newshub'); ?></p>
        </th>
        <td>
            <div style="display: inline;">
                <label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Width(px)', 'newshub'); ?></label>
                <input style="width:100px" type="text" name="term_meta[thumb_image_width]" id="term_meta[thumb_image_width]" size="3" value="<?php if (isset($term_meta['thumb_image_width']) && $term_meta['thumb_image_width'] != '') {
                    echo esc_attr($term_meta['thumb_image_width']);
                } ?>">
            </div>
            <div style="display: inline;">
                <label style="margin-right:5px" for="shortcode"><?php esc_html_e('Custom Image Height(px)', 'newshub'); ?></label>
                <input style="width:100px" type="text" name="term_meta[thumb_image_height]" id="term_meta[thumb_image_height]" size="3" value="<?php if (isset($term_meta['thumb_image_height']) && $term_meta['thumb_image_height'] != '') {
                    echo esc_attr($term_meta['thumb_image_height']);
                } ?>">
            </div>
            <div style="display: inline;">
                <label style="margin-right:5px" for="shortcode"><?php esc_html_e('Excerpt Length', 'newshub'); ?></label>
                <input style="width:100px" type="text" name="term_meta[excerpt_length]" id="term_meta[excerpt_length]" size="3" value="<?php if (isset($term_meta['excerpt_length']) && $term_meta['excerpt_length'] != '') {
                    echo esc_attr($term_meta['excerpt_length']);
                } ?>">
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row" valign="top">
            <label for="shortcode"><?php esc_html_e('Number of posts per page', 'newshub'); ?></label>
        </th>
        <td>
            <input style="width:100px" type="text" name="term_meta[number_of_posts]" id="term_meta[number_of_posts]" size="3" value="<?php if (isset($term_meta['number_of_posts']) && $term_meta['number_of_posts'] != '') {
                echo esc_attr($term_meta['number_of_posts']);
            } ?>">
        </td>
    </tr>
    <?php
}

function newshub_mikado_save_taxonomy_custom_fields($term_id) {
    if (isset($_POST['term_meta'])) {
        $t_id = $term_id;
        $term_meta = get_option("post_tax_term_$t_id");

        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        update_option("post_tax_term_$t_id", $term_meta);
    }
}

add_action('category_edit_form_fields', 'newshub_mikado_taxonomy_custom_fields', 10, 2);
add_action('edited_term', 'newshub_mikado_save_taxonomy_custom_fields', 10, 2);

?>