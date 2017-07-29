<?php

function dbsnettheme_enqueue_styles(){
	wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
	$dependencies = array('bootstrap');
	wp_enqueue_style('dbsnettheme-style', get_stylesheet_uri(), $dependencies );
}

function dbsnettheme_enqueue_scripts(){
	$dependencies = array( 'jquery' );
	wp_enqueue_script('boot', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.7', false );
}

add_action('wp_enqueue_scripts', 'dbsnettheme_enqueue_styles');
add_action('wp_enqueue_scripts', 'dbsnettheme_enqueue_scripts');

function dbsnettheme_wp_setup() {
	add_theme_support('title-tag');
}
add_action('after_setup_theme','dbsnettheme_wp_setup');


?>