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

<div class="col-md-12 filtar">
	<form method="get" action="">
		<div><span>Ubicación: </span></div>
		<select id="rpr_estado" name="FILTRO_ESTADO"></select>
		<span class="glyphicon glyphicon-chevron-down"></span>
		<select id="rpr_municipio" name="FILTRO_MUNICIPIO"></select>
		<span class="glyphicon glyphicon-chevron-down"></span>
		<button type='submit' >
			Filtrar
		</button>
	</form>
</div>