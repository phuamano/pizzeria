<?php 

function pizzeria_ajustes(){
	add_menu_page( 'La Pizzeria', 'Pizzeria Ajustes', 'administrator', 'pizzeria_ajustes', 'pizzeria_opciones', '', 20 );
	add_submenu_page( 'pizzeria_ajustes','Reservaciones','Reservaciones','administrator','pizzeria_reservaciones','pizzeria_reservaciones');

	//lamar a registro de las opciones de nuestro tema

	add_action( 'admin_init','pizzeria_registrar_opciones');
} 

add_action( 'admin_menu' , 'pizzeria_ajustes' );

function pizzeria_registrar_opciones(){

	//registrar opciones por campo
	register_setting( 'pizzeria_opciones_grupo','pizzeria_direccion' );
	register_setting( 'pizzeria_opciones_grupo','pizzeria_telefono' );
}

function pizzeria_opciones(){
	?>
		<div class="wrap">
			<h1>Ajustes La Pizzeria</h1>

			<form action="options.php" method="post">

				<?php settings_fields( 'pizzeria_opciones_grupo' ); ?>
				<?php do_settings_sections( 'pizzeria_opciones_grupo' ); ?>

				<table class="form-table">
					<tr valign="top">
						<th scope="row">Dirección</th>
						<td><input type="text" name="pizzeria_direccion" value="<?php echo esc_attr(  get_option('pizzeria_direccion')); ?>"></td>
					</tr>

					<tr valign="top">
						<th scope="row">Teléfono</th>
						<td><input type="text" name="pizzeria_telefono" value="<?php echo esc_attr(get_option('pizzeria_telefono')); ?>"></td>
					</tr>

				</table>

				<?php submit_button(); ?>
				
			</form>
		</div>

<?php

}

function pizzeria_reservaciones(){
	?>

	<div class="wrap">
		<h1>Reservaciones</h1>

		<table class="wp-list-table widefat striped">
			<thead>
				<tr>
					<th class="manage-column">ID</th>
					<th class="manage-column">Nombre</th>
					<th class="manage-column">Fecha de Reserva</th>
					<th class="manage-column">Correo</th>
					<th class="manage-column">Teléfono</th>
					<th class="manage-column">Mensaje</th>
				</tr>
			</thead>

			<tbody>
				<?php 

					global $wpdb;

					$reservaciones = $wpdb->prefix . 'reservaciones';
					$registros = $wpdb->get_results("SELECT * FROM $reservaciones", ARRAY_A);
					foreach ($registros as $registro) {?>
						
						<tr>
							<td><?php echo $registro['id']; ?></td>
							<td><?php echo $registro['nombre']; ?></td>
							<td><?php echo $registro['fecha']; ?></td>
							<td><?php echo $registro['correo']; ?></td>
							<td><?php echo $registro['telefono']; ?></td>
							<td><?php echo $registro['mensaje']; ?></td>
						</tr>
					<?php } ?>
				 
			</tbody>
		</table>
	</div>


	<?php
}









?>