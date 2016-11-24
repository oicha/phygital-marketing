<?php
if (!function_exists('newshub_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function newshub_mikado_design_styles() {

        if (newshub_mikado_options()->getOptionValue('google_fonts')) {
            $font_family = newshub_mikado_options()->getOptionValue('google_fonts');
            if (newshub_mikado_is_font_option_valid($font_family)) {
                echo newshub_mikado_dynamic_css('body', array('font-family' => newshub_mikado_get_font_option_val($font_family)));
            }
        }

        if (newshub_mikado_options()->getOptionValue('first_color') !== "") {

            $background_color_selector = array(
                '.mkd-pagination ul li a:hover',
                '.mkd-pagination ul li.active span',
                '#mkd-back-to-top:hover',
                'footer .widget #wp-calendar td#today',
                'body.search .mkd-search-page-form .mkd-search-submit:hover',
                '.wpb_widgetised_column .widget #wp-calendar td#today',
                'aside.mkd-sidebar .widget #wp-calendar td#today',
                '.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-bg):hover .mkd-btn-icon-element',
                '.mkd-icon-shortcode.circle',
                '.mkd-icon-shortcode.square',
                '.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a.flex-active:before',
                '.wpb_gallery_slides.wpb_flexslider .flex-control-nav li a:hover:before',
                '.mkd-post-pag-np-horizontal .mkd-bnl-navigation-holder .mkd-paging-button-holder.mkd-bnl-paging-active .mkd-paging-button',
                '.mkd-post-pag-np-horizontal .mkd-bnl-navigation-holder .mkd-paging-button-holder:hover .mkd-paging-button',
                '.mkd-post-ajax-preloader .mkd-pulse',
                '.mkd-bnl-holder.mkd-slider-holder .slick-dots li.slick-active button:before',
                '.mkd-sp-three-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-pt-content-holder .mkd-grid .mkd-pt-content-holder-inner .mkd-pt-content-holder-inner2 .mkd-read-more-holder .mkd-read-more:hover',
                '.mkd-bn-holder .mkd-bn-title',
                '.widget_mkd_instagram_widget .mkd-instagram-feed-heading a:hover span',
                '.mkd-side-menu .widget #wp-calendar td#today',
                'footer .mkd-light .widget #wp-calendar td#today',
                'footer .mkd-dark .widget #wp-calendar td#today',
                '.single-post .comment-form #submit_comment:hover',
                '.mkd-single-links-pages .mkd-single-links-pages-inner>a:hover',
                '.mkd-single-links-pages .mkd-single-links-pages-inner>span'

            );

            $background_color_important_selector = array(
                '.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-hover-bg):hover',
                '.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-hover-bg):hover'
            );

            $color_selector = array(
                'a:not(.mkd-pt-title-link):hover',
                'h1 a:not(.mkd-pt-title-link):hover',
                'h2 a:not(.mkd-pt-title-link):hover',
                'h3 a:not(.mkd-pt-title-link):hover',
                'h4 a:not(.mkd-pt-title-link):hover',
                'h5 a:not(.mkd-pt-title-link):hover',
                'h6 a:not(.mkd-pt-title-link):hover',
                'p a:not(.mkd-pt-title-link):hover',
                'blockquote:before',
                '.mkd-comment-holder .mkd-comment-links a:hover',
                '.mkd-post-author-comment .mkd-comment-info .mkd-comment-author-label',
                '.mkd-post-author-comment .mkd-comment-info .mkd-comment-mark',
                '.mkd-post-author-comment .mkd-comment-text .mkd-text-holder:before',
                '.mkd-main-menu>ul>li.mkd-active-item>a',
                '.mkd-main-menu>ul>li.mkd-active-item>a',
                '.mkd-main-menu>ul>li:hover>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner ul li:hover>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul li.current-menu-ancestor>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul li.current-menu-item>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul li.current_page_item>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner ul li.mkd-menu-sub:hover a i.mkd-menu-arrow',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul.right li.current-menu-ancestor>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul.right li.current-menu-item>a',
                '.mkd-drop-down .mkd-menu-second .mkd-menu-inner>ul.right li.current_page_item>a',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner>ul>li>a .menu_icon_wrapper i',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul li ul li.current-menu-ancestor a',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul li ul li.current-menu-item a',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul li ul li.current_page_item a',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul.right li ul li.current-menu-ancestor a',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul.right li ul li.current-menu-item a',
                '.mkd-drop-down .mkd-menu-wide .mkd-menu-second .mkd-menu-inner ul.right li ul li.current_page_item a',
                '.mkd-top-bar .widget.widget_nav_menu ul li a:hover',
                '.mkd-mobile-header .mkd-mobile-nav a.current',
                '.mkd-mobile-header .mkd-mobile-nav a:hover',
                '.mkd-mobile-header .mkd-mobile-nav h6.current',
                '.mkd-mobile-header .mkd-mobile-nav h6:hover',
                '.mkd-mobile-header .mkd-mobile-nav li.current_page_item>a',
                '.mkd-mobile-header .mkd-mobile-nav li.mkd-active-item>a',
                '.mkd-dark .mkd-main-menu.mkd-default-nav>ul>li.mkd-active-item>a',
                '.mkd-dark .mkd-main-menu.mkd-default-nav>ul>li:hover>a',
                '.mkd-dark.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-dark.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.mkd-dark.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.mkd-dark.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.mkd-dark.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.mkd-light .mkd-main-menu.mkd-default-nav>ul>li.mkd-active-item>a',
                '.mkd-light .mkd-main-menu.mkd-default-nav>ul>li:hover>a',
                '.mkd-light.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-light.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.mkd-light.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.mkd-light.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.mkd-light.widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.mkd-transparent .mkd-main-menu.mkd-default-nav>ul>li.mkd-active-item>a',
                '.mkd-search-cover .mkd-search-close a:hover',
                '.mkd-search-opener-holder .mkd-search-opener:hover',
                '.wpb_widgetised_column .widget a:not(.mkd-pt-title-link):hover',
                'aside.mkd-sidebar .widget a:not(.mkd-pt-title-link):hover',
                '.wpb_widgetised_column .widget.widget_rss li a:hover',
                'aside.mkd-sidebar .widget.widget_rss li a:hover',
                '.wpb_widgetised_column .widget.widget_archive ul li a:after',
                '.wpb_widgetised_column .widget.widget_categories ul li a:after',
                '.wpb_widgetised_column .widget.widget_meta ul li a:after',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a:after',
                '.wpb_widgetised_column .widget.widget_pages ul li a:after',
                'aside.mkd-sidebar .widget.widget_archive ul li a:after',
                'aside.mkd-sidebar .widget.widget_categories ul li a:after',
                'aside.mkd-sidebar .widget.widget_meta ul li a:after',
                'aside.mkd-sidebar .widget.widget_nav_menu ul li a:after',
                'aside.mkd-sidebar .widget.widget_pages ul li a:after',
                '.wpb_widgetised_column .widget.widget_archive ul li a:hover',
                '.wpb_widgetised_column .widget.widget_categories ul li a:hover',
                '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
                '.wpb_widgetised_column .widget.widget_nav_menu ul li a:hover',
                '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
                'aside.mkd-sidebar .widget.widget_archive ul li a:hover',
                'aside.mkd-sidebar .widget.widget_categories ul li a:hover',
                'aside.mkd-sidebar .widget.widget_meta ul li a:hover',
                'aside.mkd-sidebar .widget.widget_nav_menu ul li a:hover',
                'aside.mkd-sidebar .widget.widget_pages ul li a:hover',
                '.wpb_widgetised_column .widget.widget_recent_comments ul li a:hover',
                'aside.mkd-sidebar .widget.widget_recent_comments ul li a:hover',
                '.wpb_widgetised_column .widget.widget_recent_entries ul li a:hover',
                'aside.mkd-sidebar .widget.widget_recent_entries ul li a:hover',
                '.wpb_widgetised_column .widget.widget_tag_cloud a:hover',
                'aside.mkd-sidebar .widget.widget_tag_cloud a:hover',
                '.wpb_widgetised_column .widget.mkd-rc-holder .mkd-rc-content .mkd-rc-link a:hover',
                'aside.mkd-sidebar .widget.mkd-rc-holder .mkd-rc-content .mkd-rc-link a:hover',
                '.wpb_widgetised_column .widget.mkd-rc-holder .mkd-rc-date:hover',
                'aside.mkd-sidebar .widget.mkd-rc-holder .mkd-rc-date:hover',
                '.mkd-btn.mkd-btn-transparent:not(.mkd-btn-custom-hover-color):hover .mkd-btn-icon-element',
                '.mkd-btn.mkd-btn-transparent.mkd-read-more:hover .mkd-btn-icon-element',
                '.mkd-icon-shortcode .mkd-icon-element',
                '.mkd-social-share-holder.mkd-dropdown:hover .mkd-social-share-dropdown-opener:before',
                '.mkd-tabs.mkd-tabs-skin-light .mkd-tabs-nav li.ui-state-active .mkd-tabs-nav-item',
                '.mkd-tabs.mkd-tabs-skin-light .mkd-tabs-nav li.ui-state-hover .mkd-tabs-nav-item',
                '.mkd-tabs.mkd-tabs-skin-dark .mkd-tabs-nav li.ui-state-active .mkd-tabs-nav-item',
                '.mkd-tabs.mkd-tabs-skin-dark .mkd-tabs-nav li.ui-state-hover .mkd-tabs-nav-item',
                '.mkd-icon-list-item .mkd-icon-list-icon-holder-inner .font_elegant',
                '.mkd-icon-list-item .mkd-icon-list-icon-holder-inner i',
                '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.mkd-pt-one-item .mkd-post-item-inner .mkd-post-info-rating .mkd-post-info-rating-active',
                '.mkd-bnl-holder.mkd-light.mkd-pl-one-holder .mkd-bnl-navigation-holder .mkd-bnl-nav-icon:hover',
                '.mkd-bnl-holder.mkd-light.mkd-pl-one-holder .mkd-pt-one-item .mkd-post-item-inner .mkd-pt-more-section .mkd-read-more:hover',
                '.mkd-bnl-holder.mkd-light.mkd-pl-one-holder .mkd-pt-one-item .mkd-post-item-inner .mkd-pt-more-section .mkd-read-more:hover .mkd-btn-icon-element',
                '.mkd-pb-five-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-block-non-featured .mkd-post-item:hover .mkd-post-item-inner>:first-child:before',
                '.mkd-sp-three-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-pt-content-holder .mkd-grid .mkd-pt-content-holder-inner .mkd-pt-content-holder-inner2 .mkd-post-info-category a:hover',
                '.mkd-bn-holder ul.mkd-bn-slide .mkd-bn-text a:hover',
                '.mkd-rpc-holder .mkd-rpc-inner ul li .mkd-rpc-date:hover',
                '.mkd-twitter-widget li .mkd-tweet-text a:not(.mkd-tweet-time):hover',
                '.mkd-weather-widget-holder .mkd-weather-today-temp div span',
                '.mkd-weather-widget-holder .mkd-weather-todays-stats .mkd-weather-todays-description',
                '.mkd-main-menu ul li .mkd-plw-tabs .mkd-plw-tabs-tab:hover>a',
                '.mkd-side-menu .widget.widget_archive ul li a:hover',
                '.mkd-side-menu .widget.widget_categories ul li a:hover',
                '.mkd-side-menu .widget.widget_meta ul li a:hover',
                '.mkd-side-menu .widget.widget_nav_menu ul li a:hover',
                '.mkd-side-menu .widget.widget_pages ul li a:hover',
                '.mkd-side-menu .widget.widget_archive ul li a:hover:after',
                '.mkd-side-menu .widget.widget_categories ul li a:hover:after',
                '.mkd-side-menu .widget.widget_meta ul li a:hover:after',
                '.mkd-side-menu .widget.widget_nav_menu ul li a:hover:after',
                '.mkd-side-menu .widget.widget_pages ul li a:hover:after',
                '.mkd-side-menu .widget.widget_archive ul li a:hover:before',
                '.mkd-side-menu .widget.widget_categories ul li a:hover:before',
                '.mkd-side-menu .widget.widget_meta ul li a:hover:before',
                '.mkd-side-menu .widget.widget_nav_menu ul li a:hover:before',
                '.mkd-side-menu .widget.widget_pages ul li a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article.format-link:hover .mkd-post-title>*',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article.format-quote:hover .mkd-post-title>*',
                '.mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-masonry article.format-link:hover .mkd-post-title>*',
                '.mkd-blog-holder.mkd-blog-type-masonry article.format-quote:hover .mkd-post-title>*',
                '.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-meta-section>div .mkd-post-info-comments:hover:before',
                '.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-blog-like a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-meta-section>div.mkd-post-info-date a:hover:before',
                '.mkd-blog-holder.mkd-blog-type-standard article.format-link:hover .mkd-post-title>*',
                '.mkd-blog-holder.mkd-blog-type-standard article.format-quote:hover .mkd-post-title>*',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article.format-link .mkd-post-title:before',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article.format-quote .mkd-post-title:before',
                '.mkd-blog-holder.mkd-blog-type-masonry article.format-link .mkd-post-title:before',
                '.mkd-blog-holder.mkd-blog-type-masonry article.format-quote .mkd-post-title:before',
                '.mkd-blog-holder.mkd-blog-type-standard article.format-link .mkd-post-title:before',
                '.mkd-blog-holder.mkd-blog-type-standard article.format-quote .mkd-post-title:before',
                '.single-post.single-format-link .entry-title.mkd-post-title:before',
                '.single-post.single-format-quote .entry-title.mkd-post-title:before',
                '.single-post .mkd-post-info-category-holder>div a:hover',
                '.single-post .mkd-post-info>div a:hover',
                '.single-post .mkd-post-info-category-holder>div .mkd-post-info-comments:hover:before',
                '.single-post .mkd-post-info-category-holder>div.mkd-blog-like a:hover:before',
                '.single-post .mkd-post-info-category-holder>div.mkd-post-info-date a:hover:before',
                '.single-post .mkd-post-info>div .mkd-post-info-comments:hover:before',
                '.single-post .mkd-post-info>div.mkd-blog-like a:hover:before',
                '.single-post .mkd-post-info>div.mkd-post-info-date a:hover:before',
                '.single-post .mkd-related-posts-holder .mkd-post-columns-inner .mkd-post-item .mkd-post-info-category a:hover',
                '.single-post .mkd-related-posts-holder .mkd-post-columns-inner .mkd-post-item .mkd-pt-meta-section>div a:hover',
                '.mkd-ratings-holder .mkd-ratings-stars-holder .mkd-ratings-stars-inner>span.mkd-active-rating-star',
                '.mkd-ratings-holder .mkd-ratings-stars-holder .mkd-ratings-stars-inner>span.mkd-hover-rating-star'

            );

            $color_important_selector = array(
                '.wpb_widgetised_column .widget.mkd-light a:hover',
                'aside.mkd-sidebar .widget.mkd-light a:hover',
                '.mkd-btn.mkd-btn-transparent:not(.mkd-btn-custom-hover-color):hover',
                '.mkd-btn.mkd-btn-transparent.mkd-read-more:hover',
                '.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.mkd-bnl-holder.mkd-light.mkd-pl-one-holder .mkd-pt-one-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover:before',
                '.mkd-pt-four-item .mkd-post-item-inner .mkd-pt-content-holder-outer .mkd-pt-content-holder .mkd-pt-content-holder-inner .mkd-pt-meta-section>div a:hover:before',
                '.mkd-pt-five-item .mkd-post-item-inner .mkd-pt-content-holder-outer .mkd-pt-content-holder .mkd-pt-content-holder-inner .mkd-pt-meta-section>div a:hover:before',
                '.mkd-pt-seven-item .mkd-post-item-inner .mkd-post-info-category a:hover',
                '.mkd-pt-seven-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.mkd-pt-seven-item .mkd-post-item-inner .mkd-pt-meta-section>div a:hover:before',
                '.mkd-sp-one-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-slider-primary .mkd-post-item .mkd-pt-meta-section>div a:hover',
                '.mkd-sp-one-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-slider-primary .mkd-post-item .mkd-pt-meta-section>div a:hover:before',
                '.mkd-sp-one-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-slider-secondary .slick-list .slick-track .slick-slide .mkd-pt-meta-section>div a:hover:before',
                '.mkd-sp-three-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-pt-content-holder .mkd-grid .mkd-pt-content-holder-inner .mkd-pt-content-holder-inner2 .mkd-pt-meta-section>div a:hover',
                '.mkd-sp-three-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-pt-content-holder .mkd-grid .mkd-pt-content-holder-inner .mkd-pt-content-holder-inner2 .mkd-pt-meta-section>div a:hover:before',
                '.mkd-side-menu-button-opener:hover',
                '.mkd-blog-holder.mkd-blog-type-first-post-full-content article .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.mkd-blog-holder.mkd-blog-type-masonry article .mkd-post-item-inner .mkd-pt-meta-section>div a:hover',
                '.mkd-blog-holder.mkd-blog-type-standard article .mkd-post-item-inner .mkd-pt-meta-section>div a:hover'
            );

            $border_color_selector = array(
                '.mkd-pagination ul li a:hover',
                '.mkd-pagination ul li.active span',
                '#mkd-back-to-top:hover',
                '.mkd-sp-two-holder.mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-content-holder-outer .mkd-pt-content-holder .mkd-pt-content-holder-inner .mkd-pt-content-holder-inner2 .mkd-read-more-holder .mkd-read-more',
                '.mkd-main-menu ul li .mkd-plw-tabs .mkd-plw-tabs-tab:hover',
                '.single-post .comment-form #submit_comment:hover'
            );

            $border_color_important_selector = array(
                '.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-border-hover):hover',
                '.mkd-btn.mkd-btn-solid:not(.mkd-btn-custom-border-hover):hover .mkd-btn-icon-element',
                '.mkd-btn.mkd-btn-transparent:not(.mkd-btn-custom-border-hover):hover',
                '.mkd-btn.mkd-btn-transparent:not(.mkd-btn-custom-border-hover):hover .mkd-btn-icon-element',
                '.mkd-btn.mkd-btn-outline:not(.mkd-btn-custom-border-hover):hover'
            );

            if (newshub_mikado_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.woocommerce .star-rating span',
                    '.mkd-single-product-summary .product_meta>span a:hover',
                    '.mkd-woocommerce-page.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
                    '.mkd-woocommerce-page.woocommerce-account .woocommerce table.shop_table td.order-number a:hover',
                    '.widget.woocommerce.widget_layered_nav ul li a:after',
                    '.widget.woocommerce.widget_product_categories ul li a:after',
                    '.widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content ul li a:not(.remove):hover',
                    '.widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content ul li .remove:hover',
                    '.widget.woocommerce.widget_layered_nav_filters a:hover',
                    '.widget.woocommerce.widget_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_recently_viewed_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_top_rated_products ul li .product-title:hover',
                    '.widget.woocommerce.widget_recent_reviews a:hover',
                    '.mkd-shopping-cart-holder .mkd-header-cart:hover',
                    '.mkd-dark-header .mkd-page-header>div:not(.mkd-sticky-header):not(.fixed) .mkd-shopping-cart-holder .mkd-header-cart:hover',
                    '.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header):not(.fixed) .mkd-shopping-cart-holder .mkd-header-cart:hover',
                    '.mkd-shopping-cart-dropdown .mkd-item-info-holder .remove:hover'
                );

                $woo_background_color_selector = array(
                    '.woocommerce-page .mkd-content a.added_to_cart:hover',
                    '.woocommerce-page .mkd-content a.button:hover',
                    '.woocommerce-page .mkd-content button[type=submit]:hover',
                    '.woocommerce-page .mkd-content input[type=submit]:hover',
                    'div.woocommerce a.added_to_cart:hover',
                    'div.woocommerce a.button:hover',
                    'div.woocommerce button[type=submit]:hover',
                    'div.woocommerce input[type=submit]:hover',
                    '.woocommerce-page .mkd-content .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
                    '.woocommerce-pagination ul li a:hover',
                    '.woocommerce-pagination ul li span.current',
                    '.woocommerce-page .mkd-content .mkd-quantity-buttons .mkd-quantity-input',
                    'div.woocommerce .mkd-quantity-buttons .mkd-quantity-input',
                    '.mkd-woo-single-page .woocommerce-tabs ul.tabs>li.active a',
                    '.mkd-woo-single-page .woocommerce-tabs ul.tabs>li:hover a',
                    'ul.products>.product .mkd-pl-inner .mkd-pl-text-inner .added_to_cart:hover',
                    'ul.products>.product .mkd-pl-inner .mkd-pl-text-inner .button:hover',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
                    '.mkd-shopping-cart-holder .mkd-header-cart .mkd-cart-number',
                    '.mkd-shopping-cart-dropdown .mkd-cart-bottom .mkd-view-cart'
                );

                $woo_border_color_selector = array(
                    '.woocommerce-pagination ul li a:hover',
                    '.woocommerce-pagination ul li span.current',
                    '.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle'
                );

                $color_selector = array_merge($color_selector, $woo_color_selector);
                $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);
                $border_color_selector = array_merge($border_color_selector, $woo_border_color_selector);

            }


            echo newshub_mikado_dynamic_css('::selection', array('background' => newshub_mikado_options()->getOptionValue('first_color')));
            echo newshub_mikado_dynamic_css('::-moz-selection', array('background' => newshub_mikado_options()->getOptionValue('first_color')));
            echo newshub_mikado_dynamic_css($color_selector, array('color' => newshub_mikado_options()->getOptionValue('first_color')));
            echo newshub_mikado_dynamic_css($color_important_selector, array('color' => newshub_mikado_options()->getOptionValue('first_color') . '!important'));
            echo newshub_mikado_dynamic_css($background_color_selector, array('background-color' => newshub_mikado_options()->getOptionValue('first_color')));
            echo newshub_mikado_dynamic_css($background_color_important_selector, array('background-color' => newshub_mikado_options()->getOptionValue('first_color') . '!important'));
            echo newshub_mikado_dynamic_css($border_color_selector, array('border-color' => newshub_mikado_options()->getOptionValue('first_color')));
            echo newshub_mikado_dynamic_css($border_color_important_selector, array('border-color' => newshub_mikado_options()->getOptionValue('first_color') . '!important'));
        }

        if (newshub_mikado_options()->getOptionValue('page_background_color')) {
            $background_color_selector = array(
                '.mkd-wrapper-inner',
                '.mkd-content',
                '.mkd-boxed .mkd-wrapper .mkd-wrapper-inner',
                '.mkd-boxed .mkd-wrapper .mkd-content'
            );
            echo newshub_mikado_dynamic_css($background_color_selector, array('background-color' => newshub_mikado_options()->getOptionValue('page_background_color')));
        }

        if (newshub_mikado_options()->getOptionValue('selection_color')) {
            echo newshub_mikado_dynamic_css('::selection', array('background' => newshub_mikado_options()->getOptionValue('selection_color')));
            echo newshub_mikado_dynamic_css('::-moz-selection', array('background' => newshub_mikado_options()->getOptionValue('selection_color')));
        }

        $boxed_background_style = array();
        if (newshub_mikado_options()->getOptionValue('page_background_color_in_box')) {
            $boxed_background_style['background-color'] = newshub_mikado_options()->getOptionValue('page_background_color_in_box');
        }

        if (newshub_mikado_options()->getOptionValue('boxed_background_image')) {
            $boxed_background_style['background-image'] = 'url(' . esc_url(newshub_mikado_options()->getOptionValue('boxed_background_image')) . ')';
            $boxed_background_style['background-position'] = 'center 0px';
            $boxed_background_style['background-repeat'] = 'no-repeat';
        }

        if (newshub_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
            $boxed_background_style['background-image'] = 'url(' . esc_url(newshub_mikado_options()->getOptionValue('boxed_pattern_background_image')) . ')';
            $boxed_background_style['background-position'] = '0px 0px';
            $boxed_background_style['background-repeat'] = 'repeat';
        }

        if (newshub_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
            $boxed_background_style['background-attachment'] = (newshub_mikado_options()->getOptionValue('boxed_background_image_attachment'));
            if (newshub_mikado_options()->getOptionValue('boxed_background_image_attachment') == 'fixed') {
                $boxed_background_style['background-size'] = 'cover';
            }
        }

        echo newshub_mikado_dynamic_css('.mkd-boxed', $boxed_background_style);
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_design_styles');
}


if (!function_exists('newshub_mikado_content_styles')) {
    /**
     * Generates content custom styles
     */
    function newshub_mikado_content_styles() {

        $content_style = array();
        if (newshub_mikado_options()->getOptionValue('content_top_padding') !== '') {
            $padding_top = (newshub_mikado_options()->getOptionValue('content_top_padding'));
            $content_style['padding-top'] = newshub_mikado_filter_px($padding_top) . 'px';
        }

        $content_selector = array(
            '.mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner',
        );

        echo newshub_mikado_dynamic_css($content_selector, $content_style);

        $content_style_in_grid = array();
        if (newshub_mikado_options()->getOptionValue('content_top_padding_in_grid') !== '') {
            $padding_top_in_grid = (newshub_mikado_options()->getOptionValue('content_top_padding_in_grid'));
            $content_style_in_grid['padding-top'] = newshub_mikado_filter_px($padding_top_in_grid) . 'px';

        }

        $content_selector_in_grid = array(
            '.mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
        );

        echo newshub_mikado_dynamic_css($content_selector_in_grid, $content_style_in_grid);

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_content_styles');
}

if (!function_exists('newshub_mikado_content_top_styles')) {
    /**
     * Generates content top custom styles
     */
    function newshub_mikado_content_top_styles() {

        $content_style = array();
        if (newshub_mikado_options()->getOptionValue('content_top_widget_bottom_separator_color') !== '') {
            $border_color = (newshub_mikado_options()->getOptionValue('content_top_widget_bottom_separator_color'));
            $content_style['border-bottom-color'] = newshub_mikado_filter_px($border_color);
        }

        $content_selector = array(
            '.mkd-content-top-widget-area.mkd-content-top-separator',
        );

        echo newshub_mikado_dynamic_css($content_selector, $content_style);

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_content_top_styles');
}

if (!function_exists('newshub_mikado_content_bottom_styles')) {
    /**
     * Generates content custom styles
     */
    function newshub_mikado_content_bottom_styles() {

        $content_style = array();
        if (newshub_mikado_options()->getOptionValue('content_bottom_padding') !== '') {
            $padding_bottom = (newshub_mikado_options()->getOptionValue('content_bottom_padding'));
            $content_style['padding-bottom'] = newshub_mikado_filter_px($padding_bottom) . 'px';
        }

        $content_selector = array(
            '.mkd-content',
        );

        echo newshub_mikado_dynamic_css($content_selector, $content_style);

    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_content_bottom_styles');
}


if (!function_exists('newshub_mikado_h1_styles')) {

    function newshub_mikado_h1_styles() {

        $h1_styles = array();

        if (newshub_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = newshub_mikado_options()->getOptionValue('h1_color');
        }
        if (newshub_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h1_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h1_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h1_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = newshub_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h1_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h1_letterspacing')) . 'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo newshub_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_h1_styles');
}

if (!function_exists('newshub_mikado_h2_styles')) {

    function newshub_mikado_h2_styles() {

        $h2_styles = array();

        if (newshub_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = newshub_mikado_options()->getOptionValue('h2_color');
        }
        if (newshub_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h2_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h2_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h2_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = newshub_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h2_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h2_letterspacing')) . 'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo newshub_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_h2_styles');
}

if (!function_exists('newshub_mikado_h3_styles')) {

    function newshub_mikado_h3_styles() {

        $h3_styles = array();

        if (newshub_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = newshub_mikado_options()->getOptionValue('h3_color');
        }
        if (newshub_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h3_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h3_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h3_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = newshub_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h3_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h3_letterspacing')) . 'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo newshub_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_h3_styles');
}

if (!function_exists('newshub_mikado_h4_styles')) {

    function newshub_mikado_h4_styles() {

        $h4_styles = array();

        if (newshub_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = newshub_mikado_options()->getOptionValue('h4_color');
        }
        if (newshub_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h4_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h4_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h4_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = newshub_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h4_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h4_letterspacing')) . 'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo newshub_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_h4_styles');
}

if (!function_exists('newshub_mikado_h5_styles')) {

    function newshub_mikado_h5_styles() {

        $h5_styles = array();

        if (newshub_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = newshub_mikado_options()->getOptionValue('h5_color');
        }
        if (newshub_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h5_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h5_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h5_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = newshub_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h5_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h5_letterspacing')) . 'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo newshub_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_h5_styles');
}

if (!function_exists('newshub_mikado_h6_styles')) {

    function newshub_mikado_h6_styles() {

        $h6_styles = array();

        if (newshub_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = newshub_mikado_options()->getOptionValue('h6_color');
        }
        if (newshub_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h6_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h6_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = newshub_mikado_options()->getOptionValue('h6_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = newshub_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = newshub_mikado_options()->getOptionValue('h6_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('h6_letterspacing')) . 'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo newshub_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_h6_styles');
}

if (!function_exists('newshub_mikado_text_styles')) {

    function newshub_mikado_text_styles() {

        $text_styles = array();

        if (newshub_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = newshub_mikado_options()->getOptionValue('text_color');
        }
        if (newshub_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = newshub_mikado_get_formatted_font_family(newshub_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if (newshub_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('text_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('text_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = newshub_mikado_options()->getOptionValue('text_texttransform');
        }
        if (newshub_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = newshub_mikado_options()->getOptionValue('text_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = newshub_mikado_options()->getOptionValue('text_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('text_letterspacing')) . 'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo newshub_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_text_styles');
}

if (!function_exists('newshub_mikado_boxy_text_styles')) {

    function newshub_mikado_boxy_text_styles() {

        $text_styles = array();

        if (newshub_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = newshub_mikado_options()->getOptionValue('text_color');
        }
        if (newshub_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('text_fontsize')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('text_lineheight')) . 'px';
        }
        if (newshub_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = newshub_mikado_options()->getOptionValue('text_fontweight');
        }

        $text_selector = array(
            'body'
        );

        if (!empty($text_styles)) {
            echo newshub_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_boxy_text_styles');
}

if (!function_exists('newshub_mikado_link_styles')) {

    function newshub_mikado_link_styles() {

        $link_styles = array();

        if (newshub_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = newshub_mikado_options()->getOptionValue('link_color');
        }
        if (newshub_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = newshub_mikado_options()->getOptionValue('link_fontstyle');
        }
        if (newshub_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = newshub_mikado_options()->getOptionValue('link_fontweight');
        }
        if (newshub_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = newshub_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo newshub_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_link_styles');
}

if (!function_exists('newshub_mikado_link_hover_styles')) {

    function newshub_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if (newshub_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = newshub_mikado_options()->getOptionValue('link_hovercolor');
        }
        if (newshub_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = newshub_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo newshub_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if (newshub_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = newshub_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo newshub_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_link_hover_styles');
}

if (!function_exists('newshub_mikado_sidebar_styles')) {

    function newshub_mikado_sidebar_styles() {

        $sidebar_styles = array();

        if (newshub_mikado_options()->getOptionValue('sidebar_background_color') !== '') {
            $sidebar_styles['background-color'] = newshub_mikado_options()->getOptionValue('sidebar_background_color');
        }

        if (newshub_mikado_options()->getOptionValue('sidebar_padding_top') !== '') {
            $sidebar_styles['padding-top'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidebar_padding_top')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidebar_padding_right') !== '') {
            $sidebar_styles['padding-right'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidebar_padding_right')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidebar_padding_bottom') !== '') {
            $sidebar_styles['padding-bottom'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidebar_padding_bottom')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidebar_padding_left') !== '') {
            $sidebar_styles['padding-left'] = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('sidebar_padding_left')) . 'px';
        }

        if (newshub_mikado_options()->getOptionValue('sidebar_alignment') !== '') {
            $sidebar_styles['text-align'] = newshub_mikado_options()->getOptionValue('sidebar_alignment');
        }

        if (!empty($sidebar_styles)) {
            echo newshub_mikado_dynamic_css('aside.mkd-sidebar', $sidebar_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_sidebar_styles');
}

if (!function_exists('newshub_mikado_layout_widget_styles')) {

    function newshub_mikado_layout_widget_styles() {

        $widget_layout_styles = array();

        if (newshub_mikado_options()->getOptionValue('widget_layout_title_color') !== '') {
            $widget_layout_styles['color'] = newshub_mikado_options()->getOptionValue('widget_layout_title_color');
        }

        if (!empty($widget_layout_styles)) {
            echo newshub_mikado_dynamic_css('
            header .widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-title,
            mkd-side-menu .widget .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-title
            ', $widget_layout_styles);
        }

        $widget_layout_styles = array();

        if (newshub_mikado_options()->getOptionValue('widget_layout_light_title_color') !== '') {
            $widget_layout_styles['color'] = newshub_mikado_options()->getOptionValue('widget_layout_light_title_color');
        }

        if (!empty($widget_layout_styles)) {
            echo newshub_mikado_dynamic_css('
            header .widget.mkd-light .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-title
            mkd-side-menu .widget.mkd-light .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-title
            ', $widget_layout_styles);
        }

        $widget_layout_styles = array();

        if (newshub_mikado_options()->getOptionValue('widget_layout_dark_title_color') !== '') {
            $widget_layout_styles['color'] = newshub_mikado_options()->getOptionValue('widget_layout_dark_title_color');
        }

        if (!empty($widget_layout_styles)) {
            echo newshub_mikado_dynamic_css('
            header .widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-title
            mkd-side-menu .widget.mkd-dark .mkd-bnl-holder .mkd-bnl-outer .mkd-bnl-inner .mkd-post-item .mkd-post-item-inner .mkd-pt-title
            ', $widget_layout_styles);
        }
    }

    add_action('newshub_mikado_style_dynamic', 'newshub_mikado_layout_widget_styles');
}