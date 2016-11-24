<?php

if(!function_exists('mkd_core_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function mkd_core_version_class($classes) {
        $classes[] = 'mkd-core-'.MIKADO_CORE_VERSION;

        return $classes;
    }

    add_filter('body_class', 'mkd_core_version_class');
}

if(!function_exists('mkd_core_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function mkd_core_theme_installed() {
        return defined('MIKADO_ROOT');
    }
}

if(!function_exists('mkd_core_init_shortcode_loader')) {
    function mkd_core_init_shortcode_loader() {

        include_once 'shortcode-loader.php';
    }

    add_action('newshub_mikado_shortcode_loader', 'mkd_core_init_shortcode_loader');
}

if(!function_exists('mkd_core_init_news_shortcode_loader')) {
    function mkd_core_init_news_shortcode_loader() {

        include_once 'shortcode-news-loader.php';
    }

    add_action('newshub_mikado_news_shortcode_loader', 'mkd_core_init_news_shortcode_loader');
}