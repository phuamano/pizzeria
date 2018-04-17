<?php

require get_template_directory() . '/inc/database.php';

//funciones para las reservaciones
require get_template_directory() . '/inc/reservaciones.php';

//crear opciones para el template
require get_template_directory() . '/inc/opciones.php';

function pizzeria_setup(){
	add_theme_support('post-thumbnails');//con esto se agrega la imagen destacada

	add_image_size('nosotros', 437, 291, true);
	add_image_size('especialidades', 768, 515, true);
	add_image_size('especialidades_portrait', 435, 526, true);

	//cambiar el tramaño de las imagenes por defaul
	update_option('thumbnail_size_w', 253);
	update_option('thumbnail_size_h', 164);
}

add_action('after_setup_theme','pizzeria_setup');

function pizzeria_styles(){

	wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css' , array(), '7.0.0');
	wp_register_style('style', get_template_directory_uri() . '/style.css' , array('normalize'), '1.0.0');
	wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css' , array('normalize'), '4.0.0');
	wp_register_style('google_fonts' , 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', array(), '1.0.0');
	wp_register_style('fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css' , array('normalize'), '4.0.0');

	wp_enqueue_style('style');
	wp_enqueue_style('normalize');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('fluidboxcss');

	//registrar js

	$apikey = esc_html( get_option( 'pizzeria_gmap_apikey' ));
	wp_register_script( 'maps' , 'https://maps.googleapis.com/maps/api/js?key='.$apikey.'&callback=initMap', array(), '', true );
	wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js' , array() , '1.0.0' , true);
	wp_register_script('fluidbox', get_template_directory_uri() . '/js/jquery.fluidbox.min.js' , array() , '1.0.0' , true);

	wp_enqueue_script('maps');
	wp_enqueue_script('jquery');
	wp_enqueue_script('scripts');
	wp_enqueue_script('fluidbox');

	//pasar variables php a Javascript
	wp_localize_script(
			'scripts',
			'opciones',
			array(
				'latitud' => get_option('pizzeria_gmap_latitud'),
				'longitud' => get_option('pizzeria_gmap_longitud'),
				'zoom' => get_option('pizzeria_gmap_zoom'),
			)
	);
}

add_action('wp_enqueue_scripts','pizzeria_styles');


//Agregar Async y Defer
function agregar_async_defer($tag, $handle){
	if('maps' !== $handle)
		return $tag;
	return str_replace('src', 'async="async" defer="defer" src', $tag);


}
add_action( 'script_loader_tag','agregar_async_defer', 10, 2 );

//creacion de menus
function pizzeria_menus(){

	register_nav_menus(array(
		'header-menu' => __('Header Menu' , 'pizzeria'),
		'social-menu' => __('Social Menu' , 'pizzeria')
	));
}

add_action('init','pizzeria_menus');



function pizzeria_especialidades() {
	$labels = array(
		'name'               => _x( 'Pizzas', 'lapizzeria' ),
		'singular_name'      => _x( 'Pizzas', 'post type singular name', 'lapizzeria' ),
		'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria' ),
		'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
		'add_new'            => _x( 'Add New', 'book', 'lapizzeria' ),
		'add_new_item'       => __( 'Add New Pizza', 'lapizzeria' ),
		'new_item'           => __( 'New Pizzas', 'lapizzeria' ),
		'edit_item'          => __( 'Edit Pizzas', 'lapizzeria' ),
		'view_item'          => __( 'View Pizzas', 'lapizzeria' ),
		'all_items'          => __( 'All Pizzas', 'lapizzeria' ),
		'search_items'       => __( 'Search Pizzas', 'lapizzeria' ),
		'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria' ),
		'not_found'          => __( 'No Pizzases found.', 'lapizzeria' ),
		'not_found_in_trash' => __( 'No Pizzases found in Trash.', 'lapizzeria' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'lapizzeria' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'especialidades' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'          => array( 'category' ),
	);

	register_post_type( 'especialidades', $args );
}

add_action( 'init', 'pizzeria_especialidades' );

//widgets

function pizzeria_widgets(){
	register_sidebar(array(
		'name'			=> 'Blog Sidebar',
		'id'			=> 'blog_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget'	=> '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
}

add_action('widgets_init','pizzeria_widgets');

/**ADVANCE CUSTOM FIELD**/
define( 'ACF_LITE', true );

include_once('advanced-custom-fields/acf.php');

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_especialidades',
		'title' => 'Especialidades',
		'fields' => array (
			array (
				'key' => 'field_5ad19467ef0b5',
				'label' => 'Precio',
				'name' => 'precio',
				'type' => 'text',
				'instructions' => 'Añada precio de platillo',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'especialidades',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_principal',
		'title' => 'Principal',
		'fields' => array (
			array (
				'key' => 'field_5ad209e738965',
				'label' => 'Contenido',
				'name' => 'contenido',
				'type' => 'wysiwyg',
				'default_value' => 'Agregar descripción',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5ad209fd38966',
				'label' => 'imagen',
				'name' => 'imagen',
				'type' => 'image',
				'instructions' => 'Agregue imagen',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_sobre-nosotros',
		'title' => 'Sobre Nosotros',
		'fields' => array (
			array (
				'key' => 'field_5ad190f6f72cf',
				'label' => 'Imagen 1',
				'name' => 'imagen_1',
				'type' => 'image',
				'instructions' => 'Suba una Imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5ad191acf72d2',
				'label' => 'Descripcion 1',
				'name' => 'descripcion_1',
				'type' => 'wysiwyg',
				'instructions' => 'Agregue aquí la descripción',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5ad19194f72d0',
				'label' => 'Imagen 2',
				'name' => 'imagen_2',
				'type' => 'image',
				'instructions' => 'Suba una Imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5ad191e3f72d3',
				'label' => 'Descripcion 2',
				'name' => 'descripcion_2',
				'type' => 'wysiwyg',
				'instructions' => 'Agregue aquí la descripción',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5ad191a1f72d1',
				'label' => 'Imagen 3',
				'name' => 'imagen_3',
				'type' => 'image',
				'instructions' => 'Suba una Imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_5ad191f0f72d4',
				'label' => 'Descripcion 3',
				'name' => 'descripcion_3',
				'type' => 'wysiwyg',
				'instructions' => 'Agregue aquí la descripción',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '7',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
