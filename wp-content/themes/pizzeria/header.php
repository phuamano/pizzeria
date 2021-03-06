<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="mobile-wep-app-capable" content="yes">
    <meta name="theme-color" content="#a61206">
    <meta name="application-name" content="La Pizzeria">
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/icono.png" sizes="192x192">


		<?php wp_head();?>
    </head>
    <body <?php body_class() ?>>

		<header class="encabezado_sitio">
			<div class="contenedor">

				<div class="logo">
					<a href="<?php echo esc_url( home_url('/'));?>">
						<!--<img src="<?php echo get_template_directory_uri();?>/img/logo.svg" class="logotipo">-->
            <?php
              if(function_exists('the_custom_logo')){
                the_custom_logo();
              }
            ?>
					</a>
				</div>

				<div class="informacion-encabezado">
					<div class="redes-sociales">
						<?php
							$args = array(
								'theme_location'  => 'social-menu',
								'container'       => 'nav',
								'container_class' => 'sociales',
								'container_id'    => 'sociales',
								'link_before'     => '<span class="sr-text">',
								'link_after'      => '</span>'
							);

							wp_nav_menu($args);
						?>
					</div>

					<div class="direccion">
						<p><?php echo esc_html( get_option('pizzeria_direccion') ); ?></p>
						<p>Teléfono: <?php echo esc_html( get_option('pizzeria_telefono') ); ?></p>
					</div>
				</div>

			</div>
		</header>

		<div class="menu-principal">

			<div class="mobile-menu">
				<a href="#" class="mobile"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a>
			</div>

			<div class="contenedor navegacion">
					<?php
					$args = array(
						'theme_location'  => 'header-menu',
						'container'       => 'nav',
						'container_class' => 'menu-sitio'
					);

					wp_nav_menu($args);

					?>
			</div>

		</div>
