
<footer>
	<?php
		$args = array(
			'theme_location' => 'header-menu',
			'container'      => 'nav',
			'after'          => '<span class="separador"> | </span>'
		);
		
		wp_nav_menu($args);
	?>
	
	<div class="ubicacion">
		<p>Av. Enrique Meiggs 1748 - Lima</p>
		<p>Telefono: (511)4251988</p>
	</div>
	
	<p class="copyright"> Todos los derechos reservados <?php echo date('Y'); ?></p>
</footer>



<?php wp_footer(); ?>	
</body>
</html>
