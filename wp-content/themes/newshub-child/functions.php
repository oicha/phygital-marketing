<?php

/*** Child Theme Function  ***/

function newshub_mikado_child_theme_enqueue_scripts() {

    $parent_style = 'newshub_mikado_default_style';

    wp_enqueue_style('newshub_mikado_child_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
}

add_action( 'wp_enqueue_scripts', 'newshub_mikado_child_theme_enqueue_scripts' );