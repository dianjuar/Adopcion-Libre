<?php 
global $estado, $municipio;

if ( isset($_GET['FILTRO_ESTADO']) ) :
	$estado = $_GET['FILTRO_ESTADO'];
	$municipio = $_GET['FILTRO_MUNICIPIO'];
else:
	$estado = get_user_meta( get_current_user_id(), 'rpr_estado', true); 
	$municipio = get_user_meta( get_current_user_id(), 'rpr_municipio', true);	
endif;
?>

<div>
	<form method="get" action="">
	<span>Ubicación: </span>
		<select id="rpr_estado" name="FILTRO_ESTADO"></select>
		<select id="rpr_municipio" name="FILTRO_MUNICIPIO"></select>

		<button type='submit' >
			Filtrar
		</button>
	</form>
</div>