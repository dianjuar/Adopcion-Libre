<?php
/*
Plugin Name: Moderador Contenido Viejo
Plugin URI: http://about.me/dianjuar
Description: Diseñado para que se le envíe un correo al creador de un post transcurrido cierto tiempo y este confirme si el post puede ser eliminado o no.
Author: Diego Juliao, Yossely Mendoza
Version: 0.0001
Author URI: http://about.me/dianjuar
License: GPLv3 or later
*/

/////////////////////////////////////  Define Constants START  ///////////////////////////////////////
if (!defined('moderadorContenidoViejo_PLUGIN_DIR')) define('moderadorContenidoViejo_PLUGIN_DIR',  plugin_dir_path( __FILE__ ));
if (!defined('moderadorContenidoViejo_PLUGIN_DIRNAME'))	define('moderadorContenidoViejo_PLUGIN_DIRNAME', plugin_basename(dirname(__FILE__)));
if (!defined('moderadorContenidoViejo')) define('moderadorContenidoViejo', 'Moderador de Contenido Viejo');

global $tiempoLimite; //expresado en días
global $subjectEmail;

global $primeraEjecuion;
global $recurrencia;


$tiempoLimite = 0;//105; // 3.5 meses

$subjectEmail = 'Tu Publicacion ha Caducado';

$primeraEjecuion = strtotime(date('23-01-2016'));
$recurrencia = 'hourly';


//wp_schedule_event($primeraEjecuion, $recurrencia, 'verificadorDePostViejos'); 

add_action( 'init', 'verificadorDePostViejos' );

function verificadorDePostViejos()
{
	global $tiempoLimite; //expresado en días
	global $subjectEmail;

	global $wpdb;
	$query = "
	SELECT wp_posts.ID,
		   post_title,
	       wp_users.display_name,
	       wp_users.user_email, 
	       guid as link_post, 
	       DATEDIFF(NOW(), post_modified) as tiempo_vencido 
	FROM `wp_posts` 
	join wp_users on wp_users.ID = post_author
		where post_status = 'publish' and post_type = 'post' AND
	    DATEDIFF(NOW(), post_modified) >= ".$tiempoLimite;

	$postVencidos = $wpdb->get_results($query);

	foreach ($postVencidos as $postVencido)
	{
		$post_title = $postVencido->post_title;
		$display_name = $postVencido->display_name;
		$user_email = $postVencido->user_email;
		$link_post = $postVencido->link_post;
		$tiempo_vencido = $postVencido->tiempo_vencido;

		$conservarCode = get_post_meta( $postVencido->ID, 'conservarCode', true);
		$eliminarCode = get_post_meta( $postVencido->ID, 'eliminarCode', true);
		
		// si no existen los códigos, se crean
		if($conservarCode === "" || $eliminarCode === "")
		{
			$eliminarCode = wp_generate_password(150,false);
			$conservarCode = wp_generate_password(150,false);

			update_post_meta( $postVencido->ID, 'eliminarCode', $eliminarCode);
			update_post_meta( $postVencido->ID, 'conservarCode', $conservarCode);
		}		
		
		/*var_dump($conservarCode);
		die();*/

		

		$mensajeAEnviar = file_get_contents(ABSPATH.'/wp-content/themes/theme-servicioComunitario/email-Templates/postVencido-rendered.html');

		$linkBase = get_page_link(530).'?code=';
		/*var_dump($linkBase);
		die();*/

		$mensajeAEnviar = str_ireplace('[url_activa]',$linkBase.$conservarCode.'&action=conservarCode', $mensajeAEnviar); 
		$mensajeAEnviar = str_ireplace('[url_borrar]',$linkBase.$eliminarCode.'&action=eliminarCode', $mensajeAEnviar); 
		$mensajeAEnviar = str_ireplace('[post_title]',$post_title, $mensajeAEnviar); 
		$mensajeAEnviar = str_ireplace('[display_name]',$display_name, $mensajeAEnviar); 
		$mensajeAEnviar = str_ireplace('[user_email]',$user_email, $mensajeAEnviar); 
		$mensajeAEnviar = str_ireplace('[link_post]',$link_post, $mensajeAEnviar); 
		

		$headers  = 'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$enviado = wp_mail( $user_email, $subjectEmail, $mensajeAEnviar, $headers);

		
		/*var_dump($user_email.'  '.$subjectEmail.'  '.$mensajeAEnviar.'\n');
		var_dump($enviado);
		die();*/
	}
	
}


?>