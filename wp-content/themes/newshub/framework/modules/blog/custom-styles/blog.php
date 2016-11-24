<?php

if (!function_exists('newshub_mikado_blog_blog_single_post_info_styles')) {

    function newshub_mikado_blog_blog_single_post_info_styles() {

        $blog_single_post_info_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_color') !== '') {
            $blog_single_post_info_styles['color'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_color');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_google_fonts') !== '-1') {
            $blog_single_post_info_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('blog_single_post_info_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_fontsize') !== '') {
            $blog_single_post_info_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_single_post_info_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_lineheight') !== '') {
            $blog_single_post_info_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_single_post_info_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_texttransform') !== '') {
            $blog_single_post_info_styles['text-transform'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_fontstyle') !== '') {
            $blog_single_post_info_styles['font-style'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_fontweight') !== '') {
            $blog_single_post_info_styles['font-weight'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_letterspacing') !== '') {
            $blog_single_post_info_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_single_post_info_letterspacing')) . 'px';
        }

        $blog_single_post_info_selector = array(
            '.single-post .mkd-post-info > div'
        );

        if (!empty($blog_single_post_info_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_selector, $blog_single_post_info_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_blog_single_post_info_styles');
}


if (!function_exists('newshub_mikado_blog_blog_single_post_info_category_styles')) {

    function newshub_mikado_blog_blog_single_post_info_category_styles() {

        $blog_single_post_info_category_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_color') !== '') {
            $blog_single_post_info_category_styles['color'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_category_color');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_google_fonts') !== '-1') {
            $blog_single_post_info_category_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('blog_single_post_info_category_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_fontsize') !== '') {
            $blog_single_post_info_category_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_single_post_info_category_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_lineheight') !== '') {
            $blog_single_post_info_category_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_single_post_info_category_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_texttransform') !== '') {
            $blog_single_post_info_category_styles['text-transform'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_category_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_fontstyle') !== '') {
            $blog_single_post_info_category_styles['font-style'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_category_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_fontweight') !== '') {
            $blog_single_post_info_category_styles['font-weight'] = newshub_mikado_options()->getOptionValue('blog_single_post_info_category_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('blog_single_post_info_category_letterspacing') !== '') {
            $blog_single_post_info_category_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_single_post_info_category_letterspacing')) . 'px';
        }

        $blog_single_post_info_category_selector = array(
            '.single-post .mkd-post-info-category-holder > div'
        );

        if (!empty($blog_single_post_info_category_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_category_selector, $blog_single_post_info_category_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_blog_single_post_info_category_styles');
}


if (!function_exists('newshub_mikado_blog_blog_list_post_info_holder_styles')) {

    function newshub_mikado_blog_blog_list_post_info_holder_styles() {

        $blog_list_post_info_holder_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_padding_top') !== '') {
            $blog_list_post_info_holder_styles['padding-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_padding_top')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_padding_bottom') !== '') {
            $blog_list_post_info_holder_styles['padding-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_padding_bottom')) . 'px';
        }

        $blog_list_post_info_holder_selector = array(
            '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section,
            .mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-meta-section,
            .mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-pt-meta-section,
            .mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-meta-section,
            .mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-more-section'
        );

        if (!empty($blog_list_post_info_holder_styles)) {
            echo newshub_mikado_dynamic_css($blog_list_post_info_holder_selector, $blog_list_post_info_holder_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_blog_list_post_info_holder_styles');
}

if (!function_exists('newshub_mikado_blog_blog_list_post_info_styles')) {

    function newshub_mikado_blog_blog_list_post_info_styles() {

        $blog_list_post_info_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_color') !== '') {
            $blog_list_post_info_styles['color'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_color');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_google_fonts') !== '-1') {
            $blog_list_post_info_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('blog_list_post_info_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_fontsize') !== '') {
            $blog_list_post_info_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_lineheight') !== '') {
            $blog_list_post_info_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_texttransform') !== '') {
            $blog_list_post_info_styles['text-transform'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_fontstyle') !== '') {
            $blog_list_post_info_styles['font-style'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_fontweight') !== '') {
            $blog_list_post_info_styles['font-weight'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_letterspacing') !== '') {
            $blog_list_post_info_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_letterspacing')) . 'px';
        }

        $blog_list_post_info_selector = array(
            '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section > div,
            .mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-meta-section > div, 
            .mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-pt-meta-section > div,
            .mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-meta-section > div'
        );

        if (!empty($blog_list_post_info_styles)) {
            echo newshub_mikado_dynamic_css($blog_list_post_info_selector, $blog_list_post_info_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_blog_list_post_info_styles');
}

if (!function_exists('newshub_mikado_blog_blog_list_post_info_category_styles')) {

    function newshub_mikado_blog_blog_list_post_info_category_styles() {

        $blog_list_post_info_category_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_color') !== '') {
            $blog_list_post_info_category_styles['color'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_category_color');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_google_fonts') !== '-1') {
            $blog_list_post_info_category_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('blog_list_post_info_category_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_fontsize') !== '') {
            $blog_list_post_info_category_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_category_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_lineheight') !== '') {
            $blog_list_post_info_category_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_category_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_texttransform') !== '') {
            $blog_list_post_info_category_styles['text-transform'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_category_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_fontstyle') !== '') {
            $blog_list_post_info_category_styles['font-style'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_category_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_fontweight') !== '') {
            $blog_list_post_info_category_styles['font-weight'] = newshub_mikado_options()->getOptionValue('blog_list_post_info_category_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_letterspacing') !== '') {
            $blog_list_post_info_category_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_category_letterspacing')) . 'px';
        }

        $widgets_category_selector = array(
            'aside.mkd-sidebar .widget.widget_categories ul li a,
            .wpb_widgetised_column .widget.widget_categories ul li a,
            footer .widget.widget_categories ul li a,
            .mkd-side-menu .widget.widget_categories ul li a'
        );

        if (!empty($blog_list_post_info_category_styles)) {
            echo newshub_mikado_dynamic_css($widgets_category_selector, $blog_list_post_info_category_styles);
        }

        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_padding_top') !== '') {
            $blog_list_post_info_category_styles['padding-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_category_padding_top')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('blog_list_post_info_category_padding_bottom') !== '') {
            $blog_list_post_info_category_styles['padding-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_post_info_category_padding_bottom')) . 'px';
        }

        $blog_list_post_info_category_selector = array(
            '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-post-info-category,
            .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-post-info-category,
            .mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-post-info-category, 
            .mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-post-info-category,
            .mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-post-info-category'
        );

        if (!empty($blog_list_post_info_category_styles)) {
            echo newshub_mikado_dynamic_css($blog_list_post_info_category_selector, $blog_list_post_info_category_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_blog_list_post_info_category_styles');
}

if (!function_exists('newshub_mikado_blog_blog_single_comments')) {

    function newshub_mikado_blog_blog_single_comments() {

        $blog_single_commets_styles = array();

        if (newshub_mikado_options()->getOptionValue('h5_color') !== '') {
            $blog_single_commets_styles['color'] = newshub_mikado_options()->getOptionValue('h5_color');
        }
        if (newshub_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $blog_single_commets_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $blog_single_commets_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h5_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $blog_single_commets_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h5_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $blog_single_commets_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h5_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $blog_single_commets_styles['font-style'] = newshub_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $blog_single_commets_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h5_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $blog_single_commets_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h5_letterspacing')) . 'px';
        }


        $blog_list_post_info_category_selector = array(
            '.comment-respond .comment-reply-title'
        );

        if (!empty($blog_single_commets_styles)) {
            echo newshub_mikado_dynamic_css($blog_list_post_info_category_selector, $blog_single_commets_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_blog_single_comments');
}

if (!function_exists('newshub_mikado_blog_list_styles')) {

    function newshub_mikado_blog_list_styles() {

        /* blog list - standard */

        $blog_single_list_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_standard_excerpt_margin_top') !== '') {
            $blog_single_list_styles['margin-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_standard_excerpt_margin_top')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('blog_list_standard_excerpt_margin_bottom') !== '') {
            $blog_single_list_styles['margin-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_standard_excerpt_margin_bottom')) . 'px';
        }

        $blog_single_post_info_selector = array(
            '.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-excerpt'
        );

        if (!empty($blog_single_list_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_selector, $blog_single_list_styles);
        }

        /* blog list - masonry */

        $blog_single_list_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_masonry_excerpt_margin_top') !== '') {
            $blog_single_list_styles['margin-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_masonry_excerpt_margin_top')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('blog_list_masonry_excerpt_margin_bottom') !== '') {
            $blog_single_list_styles['margin-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_masonry_excerpt_margin_bottom')) . 'px';
        }

        $blog_single_post_info_selector = array(
            '.mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-excerpt'
        );

        if (!empty($blog_single_list_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_selector, $blog_single_list_styles);
        }

        /* blog list - featured post with rest small */

        $blog_single_list_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_featured_with_rest_small_excerpt_margin_top') !== '') {
            $blog_single_list_styles['margin-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_featured_with_rest_small_excerpt_margin_top')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('blog_list_featured_with_rest_small_excerpt_margin_bottom') !== '') {
            $blog_single_list_styles['margin-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_featured_with_rest_small_excerpt_margin_bottom')) . 'px';
        }

        $blog_single_post_info_selector = array(
            '.mkd-blog-holder.mkd-blog-type-featured-with-rest-small section .mkd-post-item-inner .mkd-pt-excerpt'
        );

        if (!empty($blog_single_list_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_selector, $blog_single_list_styles);
        }

        /* blog list - first post full content */

        $blog_single_list_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_first_post_full_content_excerpt_margin_top') !== '') {
            $blog_single_list_styles['margin-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_first_post_full_content_excerpt_margin_top')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('blog_list_first_post_full_content_excerpt_margin_bottom') !== '') {
            $blog_single_list_styles['margin-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_first_post_full_content_excerpt_margin_bottom')) . 'px';
        }

        $blog_single_post_info_selector = array(
            '.mkd-blog-holder.mkd-blog-type-first-post-full-content section .mkd-post-item-inner .mkd-pt-excerpt'
        );

        if (!empty($blog_single_list_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_selector, $blog_single_list_styles);
        }

        /* blog list - one bih two small */

        $blog_single_list_styles = array();

        if (newshub_mikado_options()->getOptionValue('blog_list_one_big_two_small_excerpt_margin_top') !== '') {
            $blog_single_list_styles['margin-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_one_big_two_small_excerpt_margin_top')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('blog_list_one_big_two_small_excerpt_margin_bottom') !== '') {
            $blog_single_list_styles['margin-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('blog_list_one_big_two_small_excerpt_margin_bottom')) . 'px';
        }

        $blog_single_post_info_selector = array(
            '.mkd-blog-holder.mkd-blog-type-one-big-two-small section .mkd-post-item-inner .mkd-pt-excerpt'
        );

        if (!empty($blog_single_list_styles)) {
            echo newshub_mikado_dynamic_css($blog_single_post_info_selector, $blog_single_list_styles);
        }




    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_blog_list_styles');
}



