<?php

function pizzeria_eliminar(){
	if(isset($_POST['tipo'])){
		if($_POST['tipo'] == 'eliminar'){
			global $wpdb;
			$tabla = $wpdb->prefix . 'reservaciones';
			
			$id_registro = $_POST['id'];
			
			$resultado = $wpdb->delete($tabla, array('id' => $id_registro), array('%d'));
			
			if($resultado == 1){
				$respuesta = array(
					'respuesta' => 1,
					'id' => $id_registro											
				);
			}else{
				$respuesta = array(
					'respuesta' => 0,
					'id' => $id_registro
						);
			}
		
		}
	}
	
	die( json_encode($respuesta));
}
add_action('wp_ajax_pizzeria_eliminar','pizzeria_eliminar');

function pizzeria_guardar(){

	global $wpdb;

	if(isset($_POST['enviar']) && $_POST['oculto'] == "1"):

			$nombre = sanitize_text_field($_POST['nombre']);
			$fecha = sanitize_text_field($_POST['fecha']);
			$correo = sanitize_text_field($_POST['correo']);
			$telefono = sanitize_text_field($_POST['telefono']);
			$mensaje = sanitize_text_field($_POST['mensaje']);

			$tabla = $wpdb->prefix . 'reservaciones';

			$datos = array(
				'nombre' => $nombre,
				'fecha' => $fecha,
				'correo' => $correo,
				'telefono' => $telefono,
				'mensaje' => $mensaje
			);

			$formato = array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			);

			$wpdb->insert($tabla, $datos, $formato);

			$url = get_page_by_title('Gracias por su reserva');
			wp_redirect(get_permalink($url->ID));

			exit();

	endif;


}

add_action('init','pizzeria_guardar');
