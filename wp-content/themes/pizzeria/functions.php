<?php

function pizzeria_setup(){
	add_theme_support('post-thumbnails');
}

add_action('after_setup_theme','pizzeria_setup');

function pizzeria_styles(){
	
	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css' , array(), '7.0.0');
	wp_register_style('style', get_template_directory_uri() . '/style.css' , array('normalize'), '1.0.0');
	wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' , array('normalize'), '4.0.0');
	wp_register_style('google_fonts' , 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', array(), '1.0.0');
	
	wp_enqueue_style('style');
	wp_enqueue_style('normalize');
	wp_enqueue_style('fontawesome');
	
	//registrar js
	wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js' , array() , '1.0.0' , true);
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('scripts');
}

add_action('wp_enqueue_scripts','pizzeria_styles');

function pizzeria_menus(){
	register_nav_menus(array(
		'header-menu' => __('Header Menu' , 'pizzeria'),
		'social-menu' => __('Social Menu' , 'pizzeria')
	));
}

add_action('init','pizzeria_menus');