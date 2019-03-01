<?php

function add_theme_scripts(){
    wp_enqueue_style('custom-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime());
    wp_enqueue_script('script', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
   
    
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function university_features(){
    
    register_nav_menu('header_menu_location', 'Header Menu');
    register_nav_menu('footer_menu_location_one', 'Footer Menu One');
    register_nav_menu('footer_menu_location_two', 'Footer Menu Two');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'university_features');




?>
