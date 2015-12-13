<?php
	//mensajes de periodos de tiempo
	global $msj_desde, $msj_hasta, $cant_usuarios;
	global $catAdopcion_termID,$catEncontrado_termID,$catPerdido_termID;

	wp_enqueue_style('est-generales.css', plugins_url('../assets/css/est-generales.css',__FILE__));

	get_registeredUsers();
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
				<span class=''> <?php echo get_Nmascotas($catAdopcion_termID); ?> </span>

			</div>
			<div class='est-gen-cuadro est-gen-perdido'>
				<h4> <?php echo _e('Se Encontraron', estadisticasAL); ?> </h4>
				<!-- <span class='icon icon-Lupa_Vector'></span> -->
				<span class=''> <?php echo get_Nmascotas($catEncontrado_termID); ?> </span>

			</div>
			<div class='est-gen-cuadro est-gen-encontrado'>
				<h4> <?php echo _e('Se Recuperaron', estadisticasAL); ?> </h4>
				<!-- <span class='icon icon-Dog_Vector'></span> -->
				<span class=''> <?php echo get_Nmascotas($catPerdido_termID); ?> </span>

			</div>	
		</div>

		<div id="est-gen-footer">
			<h2> 
				<?php 
					echo _e('Gracias a la colaboración de',estadisticasAL);
					echo ' '.get_registeredUsers().' ';
					echo _e('usuarios',estadisticasAL);
				 ?> 
			</h2>
		</div>

	</div>
</div>

<?php

function get_registeredUsers()
{
	global $fechas;
	global $fechaBigBang;

	//$desde = $fechas['anoDesde'].'-'.$fechas['mesDesde'].'-'.$fechas['diaDesde'].' 00:00:00';
	$hasta = $fechas['anoHasta'].'-'.$fechas['mesHasta'].'-'.$fechas['diaHasta'].' 23:59:59';

	$query = "SELECT count(*) as Nusers FROM `wp_users`
			 WHERE (`user_registered` >= '".$fechaBigBang."' AND `user_registered` <= '".$hasta."')";

	//echo $query;

	global $wpdb;
	$users = $wpdb->get_results( $query );

	return $users[0]->Nusers;
}

function get_Nmascotas($category)
{
	global $fechas;

	$desde = $fechas['anoDesde'].'-'.$fechas['mesDesde'].'-'.$fechas['diaDesde'].' 00:00:00';
	$hasta = $fechas['anoHasta'].'-'.$fechas['mesHasta'].'-'.$fechas['diaHasta'].' 23:59:59';

	global $wpdb;
	$query = "
	SELECT count(*) as nMascotas FROM $wpdb->posts
	LEFT JOIN $wpdb->term_relationships ON
	($wpdb->posts.ID = $wpdb->term_relationships.object_id)
	LEFT JOIN $wpdb->term_taxonomy ON
	($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
	WHERE $wpdb->posts.post_status = 'archive'
	AND ($wpdb->posts.post_modified BETWEEN '".$desde."' AND '".$hasta."')
	AND $wpdb->term_taxonomy.taxonomy = 'category'
	AND $wpdb->term_taxonomy.term_id = ".$category;

	$results = $wpdb->get_results($query);

	// var_dump($results);
	// die();


	return $results[0]->nMascotas;		 
}

?>