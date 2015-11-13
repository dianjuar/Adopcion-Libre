<?php
/*
Plugin Name: Estadisticas para Adopcion Libre
Plugin URI: http://about.me/dianjuar
Description: Habilita una seccion de estadísticas para ciertos usuarios definidos en el tema Adopcion Libre.
Author: Diego Juliao, Yossely Mendoza
Version: 0.0001
Author URI: http://about.me/dianjuar
License: GPLv3 or later
*/

/////////////////////////////////////  Define Constants START  ///////////////////////////////////////
if (!defined('ESTADISTICAS_AL_PLUGIN_DIR')) define('ESTADISTICAS_AL_PLUGIN_DIR',  plugin_dir_path( __FILE__ ));
if (!defined('ESTADISTICAS_AL_PLUGIN_DIRNAME'))	define('ESTADISTICAS_AL_PLUGIN_DIRNAME', plugin_basename(dirname(__FILE__)));
if (!defined('estadisticasAL')) define('estadisticasAL', 'Estadisticas Adopcion Libre');

function create_global_menus_for_estadisticas_al()
{
	global $wpdb,$current_user;
	
	$role = $wpdb->prefix . 'capabilities';
	$current_user->role = array_keys($current_user->$role);
	$role = $current_user->role[0];

	include ESTADISTICAS_AL_PLUGIN_DIR . '/lib/wp-include-menus.php';
}

function css_scripts_estadisticas_al()
{
	global $pagenow;

	if($pagenow == 'admin.php' && strpos($_GET['page'], 'estAL-')!==false )
	{
		wp_enqueue_style('estadisticas.css', plugins_url('/assets/css/estadisticas.css',__FILE__));
		wp_enqueue_style('infografia.css', plugins_url('/assets/css/infografia.css',__FILE__));

		// sweetalert
		wp_enqueue_style('sweetalert.css', plugins_url('/assets/js/sweetalert2-master/dist/sweetalert2.css',__FILE__));
		wp_enqueue_scripts('sweetalert.js',plugins_url('/assets/js/sweetalert2-master/dist/sweetalert2.min.js',__FILE__), array(), '', true);
	}
		
	
	
}

function imprimirMeses_select($valGet)
{
	$meses = array (
					__('Enero',estadisticasAL),
					__('Febrero',estadisticasAL),
					__('Marzo',estadisticasAL),
				    __('Abril',estadisticasAL),
				    __('Mayo',estadisticasAL),
				    __('Junio' ,estadisticasAL),
				    __('Julio',estadisticasAL),
				    __('Agosto',estadisticasAL),
				    __('Septiembre',estadisticasAL),
				    __('Octubre',estadisticasAL),
				    __('Noviembre',estadisticasAL),
				    __('Diciembre',estadisticasAL) );

	$mesNum = 1;

	echo '<option value="-1">'.__('Mes',estadisticasAL).'</option>';
	foreach ($meses as $mes)	
		echo '<option '.(($valGet!==false && $valGet==$mesNum) ? 'selected':'').' value="'.$mesNum++.'">'.$mes.'</option>';
	
}

function imprimirAnos_select($valGet)
{
	$anoIni = 2015;
	$anoFin = date("Y");	

	echo '<option value="-1">'.__('Año',estadisticasAL).'</option>';	
	for ($i=$anoIni; $i <= $anoFin; $i++) 	
	 	echo '<option '.(($valGet!==false && $valGet==$i) ? 'selected':'').' value="'.$i.'">'.$i.'</option>';		
	
}
/////////////////////////////////////  Define Constants END  ///////////////////////////////////////

add_action('network_admin_menu', 'create_global_menus_for_estadisticas_al' );
add_action('admin_menu','create_global_menus_for_estadisticas_al');
add_action('admin_init','css_scripts_estadisticas_al');

?>