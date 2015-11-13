<?php

if( !isset($_GET['EstadisticasPeriodo']))
{
	$_GET['EstadisticasPeriodo'] = 3;
	$_GET['consultar'] = 'Consultar';
}

$isChecked1 = ($_GET['EstadisticasPeriodo'] == '1') ? 'checked':'';
$isChecked2 = ($_GET['EstadisticasPeriodo'] == '2') ? 'checked':'';
$isChecked3 = ($_GET['EstadisticasPeriodo'] == '3') ? 'checked':'';
$isChecked4 = ($_GET['EstadisticasPeriodo'] == '4') ? 'checked':'';


$pageOriginal = $_GET['page'];

$_GET['page']='estAL-estadisticas';
$Url_estAL_estadisticas = http_build_query($_GET);

$_GET['page']='estAL-usuarios';
$Url_estAL_usuarios = http_build_query($_GET);

$_GET['page']='estAL-visitas';
$Url_estAL_visitas = http_build_query($_GET);

$_GET['page']='estAL-publicaciones';
$Url_estAL_publicaciones = http_build_query($_GET);


$_GET['page'] = $pageOriginal;


if( isset($_GET['consultar']) && $_GET['EstadisticasPeriodo']==4 )
{
	echo "sadsdas";
	$mesIni = $_GET['mesIni'];
	$anoIni = $_GET['anoIni'];

	$mesFin = $_GET['mesFin'];
	$anoFin = $_GET['anoFin'];

	$dateIni = date_create($anoIni.'-'.$mesIni);
	$dateFin = date_create($anoFin.'-'.$mesFin);

	if ( $mesIni < 1 || $mesFin < 1)
	{
		$hasError = true;
		$msj = __("Tiene que seleccionar un mes", estadisticasAL );
	}
	elseif ( $anoIni < 1 || $anoFin < 1)
	{
		$hasError = true;
		$msj = __("Tiene que seleccionar un año", estadisticasAL );
	}
	elseif( $dateIni <= $dateFin === false )
	{
		$hasError = true;
		$msj = __("La fecha de inicio debe ser menor que la fecha final", estadisticasAL );
	}


	if($hasError):
		unset($_GET['consultar']);
	?>
		<script>
			sweetAlert('Oops...', '<?php echo $msj; ?>', 'error');
		</script>
	<?php
	endif;
}


?>



<div class="wrap">

	<h1><?php _e( "Estadísticas", estadisticasAL )?> </h1>


	<?php switch($role) //tabs para navegar entre las opciones
	{			
		case "al_superadministrador":
		case "administrator": 
	?>
		
		<ul class="subsubsub">
			<li class="generales">
				<a href="<?php echo admin_url('admin.php?'.$Url_estAL_estadisticas)?>" 
				class= "<?php echo ($_GET["page"] == "estAL-estadisticas") ? "current":"" ?>">
					Generales 
				</a> |
			</li>

			<li class="usuarios">
				<a href="<?php echo admin_url('admin.php?'.$Url_estAL_usuarios)?>" 
				class= "<?php echo ($_GET["page"] == "estAL-usuarios") ? "current":"" ?>">
				   	Por Usuarios 
				</a> |
			</li>

			<li class="visitas">
				<a href="<?php echo admin_url('admin.php?'.$Url_estAL_visitas)?>" 
				class= "<?php echo ($_GET["page"] == "estAL-visitas") ? "current":"" ?>">
					Por Visitas 
				</a> |
			</li>

			<li class="publicaciones">
				<a href="<?php echo admin_url('admin.php?'.$Url_estAL_publicaciones)?>" 
				class= "<?php echo ($_GET["page"] == "estAL-publicaciones") ? "current":"" ?>">
					Por Publicaciones 
				</a> 
			</li>
		</ul>
	<?php
		break;

	} ?>

	<form name="post" action="admin.php?>" method="get" id="post">


		<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>"/>
		<div id="poststuff" >
			<div id="postbox-container-2" class="postbox-container ">
				<div class="postbox" >	
					<h3 class="hndle"><span> <?php _e("Seleccionar el periodo a consultar:", estadisticasAL ) ?> </span></h3>
					<div class="inside" style="padding-top: 10px">

						<div class="categorydiv">
							<div id="ListaPeriodos_Estadisticas" class="tabs-panel">
								<ul>
									<li>
										<label >
											<input <?php echo $isChecked1; ?> value="1" 
											name="EstadisticasPeriodo" type="radio">

											<?php _e( "Este mes", estadisticasAL )?>
										</label>
									</li>

									<li>
										<label >
											<input <?php echo $isChecked2; ?> value="2" 
											name="EstadisticasPeriodo" type="radio">

											<?php _e( "Mes pasado", estadisticasAL )?>
										</label>
									</li>

									<li>
										<label >
											<input <?php echo $isChecked3; ?> value="3" 
											name="EstadisticasPeriodo" type="radio">

											<?php _e( "Desde el inicio de los tiempos", estadisticasAL )?>
										</label>
									</li>
								</ul>
							</div>
						</div>

					</div>

					<div class="inside" style="padding-top: 10px">

						<div class="categorydiv">
							<div id="ListaPeriodos_Estadisticas" class="tabs-panel">
								<ul>
									<li>
										<label >
											<input <?php echo $isChecked4; ?> value="4" 
											name="EstadisticasPeriodo" type="radio">

											<?php _e( "Periodo a consultar", estadisticasAL )?>
										</label>
									</li>
								</ul>

								<div class="margenIzq">
									<div>
										<label> Desde: </label>
										<div class="inOneLine">
											<select name="mesIni">
												<?php imprimirMeses_select( isset($_GET['mesIni']) ? $_GET['mesIni'] : false ); ?>
											</select>
											<select name="anoIni">
												<?php imprimirAnos_select( isset($_GET['anoIni']) ? $_GET['anoIni'] : false ); ?>
											</select>
										</div>
									</div>
									<div>
										<label> Hasta: </label>
										<div class="inOneLine">
											<select name="mesFin">
												<?php imprimirMeses_select( isset($_GET['mesFin']) ? $_GET['mesFin'] : false ); ?>
											</select>
											<select name="anoFin">
												<?php imprimirAnos_select( isset($_GET['anoFin']) ? $_GET['anoFin'] : false ); ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="inside centered">
						<input name="consultar" id="publish" class="btn-lg" value="<?php echo _e("Consultar",estadisticasAL) ?>" type="submit"/>
					</div>
				</div>
			</div>
		<br class="clear">
		</div><!-- /poststuff -->

	</form>
</div>