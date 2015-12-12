<?php
	//mensajes de periodos de tiempo
	global $msj_desde, $msj_hasta, $cant_usuarios;

	wp_enqueue_style('est-generales.css', plugins_url('../assets/css/est-generales.css',__FILE__));

	
?>

<div class="centered">
	<div class="est-gen-box">
		<div id="est-gen-header">
			<h2> <?php echo _e('Desde:',estadisticasAL).' '.$msj_desde; ?> </h2>
			<h2> <?php echo _e('Hasta:',estadisticasAL).' '.$msj_hasta; ?> </h2>
		</div>

		<div id="est-gen-body">
			<div class='est-gen-cuadro est-gen-adoptado'>
				<h4> <?php echo _e('Se Adoptaron', estadisticasAL); ?> </h4>
				<!-- <span class='icon icon-Cat_and_Dog_Vector'></span> -->
			</div>
			<div class='est-gen-cuadro est-gen-perdido'>
				<h4> <?php echo _e('Se Encontraron', estadisticasAL); ?> </h4>
				<!-- <span class='icon icon-Lupa_Vector'></span> -->
			</div>
			<div class='est-gen-cuadro est-gen-encontrado'>
				<h4> <?php echo _e('Se Recuperaron', estadisticasAL); ?> </h4>
				<!-- <span class='icon icon-Dog_Vector'></span> -->
			</div>	
		</div>

		<div id="est-gen-footer">
			<h2> 
				<?php 
					echo _e('Gracias a la colaboración de',estadisticasAL);
					echo ' '.$cant_usuarios.' ';
					echo _e('usuarios',estadisticasAL);
				 ?> 
			</h2>
		</div>

	</div>
</div>