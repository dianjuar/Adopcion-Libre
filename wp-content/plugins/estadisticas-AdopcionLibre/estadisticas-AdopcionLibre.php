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
if (!defined("ESTADISTICAS_AL_PLUGIN_DIR")) define("ESTADISTICAS_AL_PLUGIN_DIR",  plugin_dir_path( __FILE__ ));
if (!defined("ESTADISTICAS_AL_PLUGIN_DIRNAME"))	define("ESTADISTICAS_AL_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if (!defined("estadisticasAL")) define("estadisticasAL", "Estadisticas Adopcion Libre");

function create_global_menus_for_estadisticas_al()
{
	global $wpdb,$current_user;
	
	$role = $wpdb->prefix . "capabilities";
	$current_user->role = array_keys($current_user->$role);
	$role = $current_user->role[0];

	include ESTADISTICAS_AL_PLUGIN_DIR . "/lib/wp-include-menus.php";
}
/////////////////////////////////////  Define Constants END  ///////////////////////////////////////

add_action("network_admin_menu", "create_global_menus_for_estadisticas_al" );
add_action("admin_menu","create_global_menus_for_estadisticas_al");

?>