<?php

function pizzeria_styles(){
	
	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css' , array(), '7.0.0');
	wp_register_style('style', get_template_directory_uri() . '/style.css' , array('normalize'), '1.0.0');
	
	wp_enqueue_style('style');
	wp_enqueue_style('normalize');
}

add_action('wp_enqueue_scripts','pizzeria_styles');

function pizzeria_menus(){
	register_nav_menus(array(
		'header-menu' => __('Header Menu' , 'pizzeria'),
		'social-menu' => __('Social Menu' , 'pizzeria')
	));
}

add_action('init','pizzeria_menus');