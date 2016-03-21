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

		<?php  if(isset($_GET['s'])): ?>
					<input type="hidden" name="s" value="<?php echo $_GET['s']; ?>">  </input>
					<div style="display:block;">
						<span>Categoria:</span>
						<input type="radio" name="FILTRO_CMASCOTA" value="t" checked>Todas</input>
						<input type="radio" name="FILTRO_CMASCOTA" value="a" <?php if($_GET['FILTRO_CMASCOTA']=='a') echo 'checked';?> >Adopcion</input>
						<input type="radio" name="FILTRO_CMASCOTA" value="e" <?php if($_GET['FILTRO_CMASCOTA']=='e') echo 'checked';?> >Encontrados</input>
						<input type="radio" name="FILTRO_CMASCOTA" value="p" <?php if($_GET['FILTRO_CMASCOTA']=='p') echo 'checked';?> >Perdidos</input>
					</div>
		<?php endif;?>


		<div style="display:block;">
			<span>Tipo:</span>
			<input type="checkbox" name="FILTRO_TMASCOTA_P" <?php echo isset($_GET['FILTRO_TMASCOTA_P'])? 'checked' : ''?> >Perro</input>
			<input type="checkbox" name="FILTRO_TMASCOTA_G" <?php echo isset($_GET['FILTRO_TMASCOTA_G'])? 'checked' : ''?> >Gato</input>
			<input type="checkbox" name="FILTRO_TMASCOTA_O" <?php echo isset($_GET['FILTRO_TMASCOTA_O'])? 'checked' : ''?> >Otro</input>
		</div>

		<div style="display:block;">
			<span>Esterilizado:</span>
			<input type="checkbox" name="FILTRO_EMASCOTA_S" <?php echo isset($_GET['FILTRO_EMASCOTA_S'])? 'checked' : ''?> >Si</input>
			<input type="checkbox" name="FILTRO_EMASCOTA_N" <?php echo isset($_GET['FILTRO_EMASCOTA_N'])? 'checked' : ''?> >No</input>
			<input type="checkbox" name="FILTRO_EMASCOTA_NS" <?php echo isset($_GET['FILTRO_EMASCOTA_NS'])? 'checked' : ''?> >El dueño no lo sabe</input>		
		</div>

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