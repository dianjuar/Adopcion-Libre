<?php
/*
* Template Name: Mascota caducada
* Description: Página para validar cuando las expiraciones de los post
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 

<html class="no-js"> <!--<![endif]-->
	<head>
        <?php require_once("head.php"); ?>		
	</head>       

	<body >
		<!--[if lt IE 7]>
		<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<?php 
			require_once("header.php");
			require_once("menu.php");


			if(isset($_GET['code']) && isset($_GET['action']))
			{	
				$code = $_GET['code'];
				$action = $_GET['action'];

				global $wpdb;
				$query = "
				SELECT post_id FROM `wp_postmeta`
					WHERE meta_value = '".$code."' AND
  					meta_key = '".$action."' ";

				$post_id = $wpdb->get_results($query)[0]->post_id;
				
				if($post_id !== NULL )
				{
					switch ($action)
					{
						case 'eliminarCode':
							// eliminar
						break;
						
						case 'conservarCode':
							// actualizar el post_modified
						break;
					}
				}
				else
				{
					// mostrar un mensaje "codigo erroneo";
				}

			}
		?>
		<!-- contenido de la página -->
			<!-- agregar el buscado que está en la página principal -->
		<!-- contenido de la página -->
		<?php 
			require_once("footer.php");
			require_once("js/Scripts to login buttons.php");
		?>

		<script>
			$(document).ready(function(){
				$("ul.nav-justified li:nth-child(4)").html("Mascotas perdidas");

				$(".post a").mouseover(function() {	
					$(this).children('.post__info').css("display","block");
				}).mouseout(function (){
					$('.post a').children('.post__info').css("display","none"); 
				});         

			});
		</script>

	</body>
</html>
