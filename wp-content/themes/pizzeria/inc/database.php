<?php

function pizzeria_database(){

	global $wpdb;
	global $pizzeria_dbversion;
	$pizzeria_dbversion = '0.1';
	
	$tabla = $wpdb->prefix . 'reservaciones';
	
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE $tabla (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		nombre varchar(50) NOT NULL,
		fecha datetime NOT NULL,
		correo varchar(50) DEFAULT '' NOT NULL,
		telefono varchar(10) NOT NULL,
		mensaje longtext NOT NULL,
		PRIMARY KEY (id)
	) $charset_collate;";
	
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta($sql);
	
	add_option('pizzeria_dbversion', $pizzeria_dbversion);
	
	//ACTUALIZAR EN CASO DE SER NECESARIO
	$version_actual = get_option('pizzeria_dbversion');
	
	if($pizzeria_dbversion != $version_actual){
		
		$tabla = $wpdb->prefix . 'reservaciones';
	
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "CREATE TABLE $tabla (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			nombre varchar(50) NOT NULL,
			fecha datetime NOT NULL,
			correo varchar(50) DEFAULT '' NOT NULL,
			telefono varchar(10) NOT NULL,
			mensaje longtext NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);
	
		update_option('pizzeria_dbversion', $pizzeria_dbversion);
		
	}
}




add_action('after_setup_theme','pizzeria_database');

//FUNCION PARA COMPROBAR QUE LA VERSION INSTALADA ES IGUAL A LA BASE NUEVA
function pizzeria_db_revisar(){
	global $pizzeria_dbversion;
	
	if( get_site_option( 'pizzeria_dbversion') != $pizzeria_dbversion){
		pizzeria_database();
	}
}

add_action('plugins_loaded' , 'pizzeria_db_revisar');