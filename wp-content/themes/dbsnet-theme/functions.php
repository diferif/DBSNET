<?php

function dbsnettheme_enqueue_styles(){
	wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
	$dependencies = array('bootstrap');
	wp_enqueue_style('dbsnettheme-style', get_stylesheet_uri(), $dependencies );
}

function dbsnettheme_enqueue_scripts(){
	$dependencies = array( 'jquery' );
	wp_enqueue_script('boot', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.7', false );

add_action('wp_enqueue_scripts', 'dbsnettheme_enqueue_styles');
add_action('wp_enqueue_scripts', 'dbsnettheme_enqueue_scripts');

pu'dbsnettheme_enqueue_scripts' {	wp_enqueue_script('handle_name', 'source', array('jquery'), 'version', ffalse );

pu'dbsnettheme_enqueue_styles' {
add_action('wp_enqueue_scripts', 'dbsnettheme_enqueue_scripts');
	
	pu'dbsnettheme_enqueue_scripts' {		wp_enqueue_script('handle_name', 'source', array('jquery'), 'version', false);
	}	wp_enqueue_script('handle_name', 'source', array('jquery'), 'version', false);
}

?>