<?php

if(!function_exists('newshub_mikado_get_title')) {
    /**
     * Loads title area HTML
     */
    function newshub_mikado_get_title() {
        $id = newshub_mikado_get_page_id();

        extract(newshub_mikado_title_area_height());
        extract(newshub_mikado_title_area_background());
        extract(newshub_mikado_title_colors());

        //check for title type on page first, then in options
        if(($meta_temp = get_post_meta($id, "mkd_title_area_type_meta", true)) !== ""){
            $type = $meta_temp;
        }else {
            $type = newshub_mikado_options()->getOptionValue('title_area_type');
        }

        //check if breadcrumbs are enabled on page first, then in options
        if(($meta_temp = get_post_meta($id, "mkd_title_area_enable_breadcrumbs_meta", true)) !== ""){
            $enable_breadcrumbs = $meta_temp == 'yes' ? true : false;
        }else {
            $enable_breadcrumbs = newshub_mikado_options()->getOptionValue('title_area_enable_breadcrumbs') == 'yes' ? true : false;
        }

        //check if title area is visible on page first, then in the options
        $show_title_area = newshub_mikado_get_meta_field_intersect('show_title_area',$id) == 'yes' ? true : false;

        $parameters = array(
            'show_title_area' => $show_title_area,
            'type' => $type,
            'enable_breadcrumbs' => $enable_breadcrumbs,
            'title_height' => $title_height,
            'title_holder_height' => $title_holder_height,
            'title_subtitle_holder_padding' => $title_subtitle_holder_padding,
            'title_background_color' => $title_background_color,
            'title_background_image' => $title_background_image,
            'title_background_image_width' => $title_background_image_width,
            'title_background_image_src' => $title_background_image_src,
            'title_author_id' => newshub_mikado_get_author_id(),
            'title_color' => $title_color,
            'title_info_color' => $title_info_color,
            'title_border_color' => $title_border_color
        );

        $parameters = array_merge($parameters,newshub_mikado_get_blog_options());

        $parameters = apply_filters('newshub_mikado_title_area_height_params', $parameters);

        newshub_mikado_get_module_template_part('templates/title', 'title', '', $parameters);
    }
}

if(!function_exists('newshub_mikado_get_title_text')) {
    /**
     * Function that returns current page title text. Defines newshub_mikado_title_text filter
     * @return string current page title text
     *
     * @see is_tag()
     * @see is_date()
     * @see is_author()
     * @see is_category()
     * @see is_home()
     * @see is_search()
     * @see is_404()
     * @see get_queried_object_id()
     * @see is_woocommerce_installed()
     */
    function newshub_mikado_get_title_text() {

        $id = newshub_mikado_get_page_id();
        $title 	= '';

        //is current page tag archive?
        if (is_tag()) {
            //get title of current tag
            $title = single_term_title("", false) . esc_html__(' タグ', 'newshub');
        }

        //is current page date archive?
        elseif (is_date()) {
            //get current date archive format
            $title = get_the_time('F Y');
        }

        //is current page author archive?
        elseif (is_author()) {
            //get current author name
            $title = esc_html__('Author:', 'newshub') . " " . get_the_author();
        }

        //us current page category archive
        elseif (is_category()) {
            //get current page category title
            $title = single_cat_title('', false);
        }

        //is current page blog post page and front page? Latest posts option is set in Settings -> Reading
        elseif (is_home() && is_front_page()) {
            //get site name from options
            $title = get_option('blogname');
        }

        //is current page search page?
        elseif (is_search()) {
            //get title for search page
            $title = esc_html__('検索', 'newshub');
        }

        //is single post page
        elseif (is_singular('post')) {
            if (newshub_mikado_options()->getOptionValue('blog_single_title_in_title_area') == "yes") {
                $title = get_the_title($id);
            } else {
                $title = esc_html__('投稿', 'newshub');
            }
        }

        //is current page 404?
        elseif (is_404()) {
            //is 404 title text set in theme options?
            if(newshub_mikado_options()->getOptionValue('404_title') != "") {
                //get it from options
                $title = newshub_mikado_options()->getOptionValue('404_title');
            } else {
                //get default 404 page title
                $title = esc_html__('404 - Page not found', 'newshub');
            }
        }

        //is WooCommerce installed and is shop or single product page?
        elseif(newshub_mikado_is_woocommerce_installed() && (is_shop() || is_singular('product'))) {
            //get shop page id from options table
            $shop_id = get_option('woocommerce_shop_page_id');

            //get shop page and get it's title if set
            $shop = get_post($shop_id);
            if(isset($shop->post_title) && $shop->post_title !== '') {
                $title = $shop->post_title;
            }

        }

        //is WooCommerce installed and is current page product archive page?
        elseif(newshub_mikado_is_woocommerce_installed() && (is_product_category() || is_product_tag())) {
            global $wp_query;

            //get current taxonomy and it's name and assign to title
            $tax            = $wp_query->get_queried_object();
            $category_title = $tax->name;
            $title          = $category_title;
        }

        //is current page some archive page?
        elseif (is_archive()) {
            $title = esc_html__('Archive','newshub');
        }

        elseif(is_singular('post') && get_post_format($id) == 'quote'){
        	$title = ''.get_the_title($id).'';
        }

        elseif(is_singular('post') && get_post_format($id) == 'link'){
        	$title = '<a href="'.esc_html(get_post_meta($id, "mkd_post_link_link_meta", true)).'">'.get_the_title($id).'</a>';
        }

        //current page is regular page
        else {
            $title = get_the_title($id);
        }

        $title = apply_filters('newshub_mikado_title_text', $title);

        return $title;
    }
}

if(!function_exists('newshub_mikado_title_text')) {
    /**
     * Function that echoes title text.
     *
     * @see newshub_mikado_get_title_text()
     */
    function newshub_mikado_title_text() {
        echo newshub_mikado_get_title_text();
    }
}

if(!function_exists('newshub_mikado_custom_breadcrumbs')) {
    /**
     * Function that renders breadcrumbs
     *
     * @see home_url()
     * @see get_option()
     * @see get_post_meta()
     * @see is_home()
     * @see is_front_page()
     * @see is_category()
     * @see newshub_mikado_is_product_category()
     * @see get_search_query()
     */
    function newshub_mikado_custom_breadcrumbs() {
        global $post;

        $output = "";
        $homeLink = esc_url(home_url(''));
        $pageid = newshub_mikado_get_page_id();
        $bread_style = "";

        if(get_post_meta($pageid, "mkd_title_breadcrumb_color_meta", true) != ""){
            $bread_style="color:". get_post_meta($pageid, "mkd_title_breadcrumb_color_meta", true);
        }

        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = "<span>&nbsp;>&nbsp;</span>"; // delimiter between crumbs
        $home = esc_html__('ホーム','newshub'); // text for the 'Home' link
        $showCurrent = 0; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="mkd-current" '.newshub_mikado_get_inline_style($bread_style).'>'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        if (is_home() && !is_front_page()) {
            $output = '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner"><a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' <a '.newshub_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">'. get_the_title($pageid) .'</a></div></div>';

        } elseif(is_home()) {
            $output = '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner">'.$before.$home.$after.'</div></div>';
        }

        elseif(is_front_page()) {
            if ($showOnHome == 1) $output = '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner"><a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">' . $home . '</a></div></div>';
        }

        else {

            $output .= '<div class="mkd-breadcrumbs"><div class="mkd-breadcrumbs-inner"><a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . $homeLink . '">' . $home . '</a>' . $delimiter;

            if ( is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if (isset($thisCat->parent) && $thisCat->parent != 0) $output .= get_category_parents($thisCat->parent, TRUE, $delimiter);
                $output .= $before . single_cat_title('', false) . $after;

            } elseif ( is_search() ) {
                $output .= $before . esc_html__('検索', 'newshub') . $after;

            } elseif ( is_day() ) {
                $output .= '<a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
                $output .= '<a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
                $output .= $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                $output .= '<a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
                $output .= $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                $output .= $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    if ($showCurrent == 1) $output .= $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE);
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
                    $output .= $cats;
                    if ($showCurrent == 1) $output .= $before . get_the_title() . $after;
                }

            }  elseif ( is_attachment() && !$post->post_parent ) {
                if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                if($cat) {
                    $cat = $cat[0];
                    $output .= get_category_parents($cat, TRUE, $delimiter);
                }
                $output .= '<a itemprop="url"'.newshub_mikado_get_inline_style($bread_style).' href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1) $output .= $delimiter . $before . get_the_title() . $after;

            } elseif ( is_page() && !$post->post_parent ) {
                if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

            } elseif ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a itemprop="url" '.newshub_mikado_get_inline_style($bread_style).' href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    $output .= $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) $output .= $delimiter;
                }
                if ($showCurrent == 1) $output .= $delimiter . $before . get_the_title() . $after;

            } elseif ( is_tag() ) {
                $output .= $before . esc_html__('タグ ', 'newshub') .'"' . single_tag_title('', false) . '"' . $after;

            } elseif ( is_author() ) {
                global $authordata;
                $output .= $before . esc_html__('投稿者  ', 'newshub') . $authordata->display_name . $after;

            } elseif ( is_404() ) {
                $output .= $before . esc_html__('Error 404', 'newshub') . $after;
            } elseif ( newshub_mikado_is_woocommerce_installed() && is_shop() ){
                global $woocommerce;
                $shop_id = get_option('woocommerce_shop_page_id');
                $shop = get_page($shop_id);
                $output .= $before . $shop->post_title . $after;
            } elseif( newshub_mikado_bbpress_installed() && is_bbpress()) {
                $output .= $before . get_the_title() . $after;
            }
            elseif (is_archive()) {
                if(get_post_format()){
                    $output .= $before . get_post_format() . $after;
                }
            }

            if ( get_query_var('paged') ) {

                $output .= $before . " (" . esc_html__('ページ', 'newshub') . ' ' . get_query_var('paged') . ")" . $after;
            }

            $output .= '</div></div>';
        }

        echo wp_kses($output, array(
            'div' => array(
                'id' => true,
                'class' => true,
                'style' => true
            ),
            'span' => array(
                'class' => true,
                'id' => true,
                'style' => true
            ),
            'a' => array(
                'class' => true,
                'id' => true,
                'href' => true,
                'style' => true
            )
        ));
    }
}

if(!function_exists('newshub_mikado_get_title_area_height')) {

    /**
     * Function that returns title height
     **/
    function newshub_mikado_get_title_area_height() {

        $id = newshub_mikado_get_page_id();

        if(($meta_temp = get_post_meta($id, 'mkd_title_area_type_meta', true)) != '') {
            $title_type = $meta_temp;
        } else {
            $title_type = newshub_mikado_options()->getOptionValue('title_area_type');
        }

        $title_height = 100; // default title height without header height
        if($title_type == "breadcrumb") {
            $title_height = 34;
        }

        if(get_post_meta($id, "mkd_title_area_height_meta", true) != '') {
            $title_height = get_post_meta($id, 'mkd_title_area_height_meta', true);
        }elseif(newshub_mikado_options()->getOptionValue('title_area_height')) {
            $title_height = newshub_mikado_options()->getOptionValue('title_area_height');
        }

        return apply_filters('newshub_mikado_title_area_height', $title_height);
    }
}

if(!function_exists('newshub_mikado_get_title_content_padding')) {
    /**
     * Function that returns title content pading
     **/

    function newshub_mikado_get_title_content_padding() {
        return apply_filters('newshub_mikado_title_content_padding', 0);
    }
}

if(!function_exists('newshub_mikado_title_area_height')) {
    /**
     * Function that returns title height and padding to be applied in template
     **/

    function newshub_mikado_title_area_height() {
        $id = newshub_mikado_get_page_id();
        $title_height_and_padding = array();
        $title_height          = newshub_mikado_get_title_area_height();
        $header_height_padding = newshub_mikado_get_title_content_padding();
        $title_holder_height = '';
        $title_subtitle_holder_padding = '';

        //is responsive image is set for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = newshub_mikado_options()->getOptionValue('title_area_background_image_responsive');
        }

        //we need to define title height only when image isn't responsive and height is different from auto
        if($is_img_responsive !== 'yes' && $title_height !== 'auto') {
            $title_holder_height = 'height:'.$title_height.'px;';
        }

        //we need to add padding-top property only if we are aligning title text from bellow header
        if(!empty($header_height_padding)) {
            if($is_img_responsive == 'yes') {
                $title_subtitle_holder_padding = 'padding-top: '.$header_height_padding.'px;';
            } else {
                $title_holder_height .= 'padding-top: '.$header_height_padding.'px;';
            }
        }

        //increase title height for the height of header transparent parts if it is not auto
		if ($title_height !== 'auto'){
			$title_height_and_padding['title_height'] = 'height:'.$title_height+$header_height_padding.'px;';
		}
		else{
			$title_height_and_padding['title_height'] = 'height:'.$title_height.';';
		}
        $title_height_and_padding['title_holder_height'] = $title_holder_height;
        $title_height_and_padding['title_subtitle_holder_padding'] = $title_subtitle_holder_padding;

        return $title_height_and_padding;
    }
}

if(!function_exists('newshub_mikado_title_area_background')) {
    /**
     * Function that returns title background style be applied in template
     **/

    function newshub_mikado_title_area_background() {
        $id = newshub_mikado_get_page_id();
        $show_title_img = true;
        $title_area_background = array();
        $title_background_color = '';
        $title_background_image = '';
        $title_background_image_width = '';
        $title_background_image_src = '';
        $is_img_responsive = '';

        //is title image hidden for current page?
        if(get_post_meta($id, "mkd_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is responsive image is set for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = newshub_mikado_options()->getOptionValue('title_area_background_image_responsive');
        }

        //check if background color is set on page or in options
        if(get_post_meta($id, "mkd_title_area_background_color_meta", true) != ""){
            $background_color = get_post_meta($id, "mkd_title_area_background_color_meta", true);
        }else{
            $background_color = newshub_mikado_options()->getOptionValue('title_area_background_color');
        }

        //check if background image is set on page or in options

		if(get_post_meta($id, "mkd_title_area_background_image_meta", true) != ""){
            $background_image = get_post_meta($id, "mkd_title_area_background_image_meta", true);
        }else{
            $background_image = newshub_mikado_options()->getOptionValue('title_area_background_image');
        }

        //check for background image width
        $background_image_width = "";
        if($background_image !== ''){
            $background_image_width_dimensions_array = newshub_mikado_get_image_dimensions($background_image);
            if (count($background_image_width_dimensions_array)) {
                $background_image_width = $background_image_width_dimensions_array["width"];
            }
        }

        //generate styles
        if(!empty($background_color)){$title_background_color = 'background-color:'.$background_color.';';}
        if($is_img_responsive == 'no' && $show_title_img){ //no need for those styles if image is set to be responsive
            if(!empty($background_image)){
            	$title_background_image = 'background-image:url('.$background_image.');';
            }
            if(!empty($background_image_width)){
            	$title_background_image_width = 'data-background-width="'.$background_image_width.'"';
            }

        }
        if($show_title_img) {
            if(!empty($background_image)) { $title_background_image_src = $background_image; }
        }

        $title_area_background['title_background_color'] = $title_background_color;
        $title_area_background['title_background_image'] = $title_background_image;
        $title_area_background['title_background_image_width'] = $title_background_image_width;
        $title_area_background['title_background_image_src'] = $title_background_image_src;

        return $title_area_background;
    }
}

if (!function_exists('newshub_mikado_get_author_id')){
    /**
     * Function that returns author id
     **/
	function newshub_mikado_get_author_id(){
        $id = newshub_mikado_get_page_id();

        if (is_singular('post')){
			$auth = get_post($id);
			$authid = $auth->post_author;
			return $authid;
		}

		return -1;
	}
}

if (!function_exists('newshub_mikado_title_colors')){
    /**
     * Function that returns title color
     **/
	function newshub_mikado_title_colors(){
        $id = newshub_mikado_get_page_id();
        $title_color = '';
        $title_info_color = '';
        $title_border_color = '';
        $title_colors = array();

		if (get_post_meta($id, "mkd_title_color_meta", true) !== ''){
			$title_color = 'color: '.get_post_meta($id, "mkd_title_color_meta", true);
		}

		if (get_post_meta($id, "mkd_title_info_color_meta", true) !== ''){
			$title_info_color = 'color: '.get_post_meta($id, "mkd_title_info_color_meta", true);
		}

        if (newshub_mikado_get_meta_field_intersect('title_area_border_color',$id) !== ''){
            $title_border_color = 'border-color: '.newshub_mikado_get_meta_field_intersect('title_area_border_color',$id);
        }

		$title_colors['title_color'] = $title_color;
		$title_colors['title_info_color'] = $title_info_color;
        $title_colors['title_border_color'] = $title_border_color;

		return $title_colors;
	}
}

if (!function_exists('newshub_mikado_get_blog_options')){
    /**
     * Function that returns blog options in array
     **/
	function newshub_mikado_get_blog_options(){
		$blog_options = array();

		$display_category = 'yes';
		if(newshub_mikado_options()->getOptionValue('blog_single_category') !== ''){
			$display_category = newshub_mikado_options()->getOptionValue('blog_single_category');
		}

		$display_date = 'yes';
		if(newshub_mikado_options()->getOptionValue('blog_single_date') !== ''){
			$display_date = newshub_mikado_options()->getOptionValue('blog_single_date');
		}

		$display_author = 'yes';
		if(newshub_mikado_options()->getOptionValue('blog_single_author') !== ''){
			$display_author = newshub_mikado_options()->getOptionValue('blog_single_author');
		}

		$display_comments = 'yes';
		if(newshub_mikado_options()->getOptionValue('blog_single_comment') !== ''){
			$display_comments = newshub_mikado_options()->getOptionValue('blog_single_comment');
		}

		$display_like = 'yes';
		if(newshub_mikado_options()->getOptionValue('blog_single_like') !== ''){
			$display_like = newshub_mikado_options()->getOptionValue('blog_single_like');
		}

		$display_count = 'yes';
		if(newshub_mikado_options()->getOptionValue('blog_single_count') !== ''){
			$display_count = newshub_mikado_options()->getOptionValue('blog_single_count');
		}

		$blog_options = array(
			'display_category' => $display_category,
			'display_date' => $display_date,
			'display_author' => $display_author,
			'display_comments' => $display_comments,
			'display_like' => $display_like,
			'display_count' => $display_count
		);

		return $blog_options;
	}
}