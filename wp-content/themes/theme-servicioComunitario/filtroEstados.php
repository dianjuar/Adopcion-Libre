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

<div class="col-md-3 filtar">
	<form method="get" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

		<?php  if(isset($_GET['s'])): ?>
					<input type="hidden" name="s" value="<?php echo $_GET['s']; ?>">  </input>
						<label>Categoria:</label>

						<div>
							<input type="radio" name="FILTRO_CMASCOTA" value="t" checked>
							<span>Todas</span>
						</div>
						
						<div>
							<input type="radio" name="FILTRO_CMASCOTA" value="a" <?php if($_GET['FILTRO_CMASCOTA']=='a') echo 'checked';?> >
							<span>Adopción</span>
						</div>

						<div>
							<input type="radio" name="FILTRO_CMASCOTA" value="e" <?php if($_GET['FILTRO_CMASCOTA']=='e') echo 'checked';?> >
							<span>Encontrados</span>
						</div>
						
						<div>
							<input type="radio" name="FILTRO_CMASCOTA" value="p" <?php if($_GET['FILTRO_CMASCOTA']=='p') echo 'checked';?> >
							<span>Perdidos</span>
						</div>

						<br>
		<?php endif;?>

		<label>Tipo:</label>

		<div>
			<input type="checkbox" name="FILTRO_TMASCOTA_P" <?php echo isset($_GET['FILTRO_TMASCOTA_P'])? 'checked' : ''?>>
			<span>Perro</span>
		</div>
		<div>
			<input type="checkbox" name="FILTRO_TMASCOTA_G" <?php echo isset($_GET['FILTRO_TMASCOTA_G'])? 'checked' : ''?> >
			<span>Gato</span>
		</div>
		<div>
			<input type="checkbox" name="FILTRO_TMASCOTA_O" <?php echo isset($_GET['FILTRO_TMASCOTA_O'])? 'checked' : ''?> >
			<span>Otro</span>
		</div>
		
		<br>

		<label>Esterilizado:</label>

		<div>
			<input type="checkbox" name="FILTRO_EMASCOTA_S" <?php echo isset($_GET['FILTRO_EMASCOTA_S'])? 'checked' : ''?> >
			<span>Si</span>
		</div>

		<div>
			<input type="checkbox" name="FILTRO_EMASCOTA_N" <?php echo isset($_GET['FILTRO_EMASCOTA_N'])? 'checked' : ''?> >
			<span>No</span>
		</div>

		<div>
			<input type="checkbox" name="FILTRO_EMASCOTA_NS" <?php echo isset($_GET['FILTRO_EMASCOTA_NS'])? 'checked' : ''?> >
			<span>El dueño no lo sabe</span>
		</div>

		<br>

		<label>Ubicación: </label>

		<div>
			<select id="rpr_estado" name="FILTRO_ESTADO"></select>
			<span class="glyphicon glyphicon-chevron-down"></span>
		</div>
		
		<div>
			<select id="rpr_municipio" name="FILTRO_MUNICIPIO"></select>
			<span class="glyphicon glyphicon-chevron-down"></span>
		</div>
				
		<button type='submit' >
			Filtrar
		</button>
	</form>
</div>