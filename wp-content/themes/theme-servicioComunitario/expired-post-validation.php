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
			//require_once("menu.php");


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

							wp_delete_post( $post_id, false );

							?>
							<script type="text/javascript">
							window.onload = function()
							{								
					            swal(
					              '¡Eliminada!',
					              'Tu mascota ha sido eliminada',
					              'success'
					            );
							};
							</script>
							<?php
						break;
						
						case 'conservarCode':

							$datetime = date("Y-m-d H:i:s");  							

							$wpdb->query( "
								UPDATE `wp_posts` 
								SET `post_modified` = '".$datetime."'
								WHERE `ID` = '".$post_id."'" );
							?>
							<script type="text/javascript">
							window.onload = function()
							{								
					            swal(
					              '¡Perfecto!',
					              'Tu mascota sigue activa.',
					              'success'
					            );
							};
							</script>
							<?php
						break;
					}

					delete_post_meta($post_id, 'eliminarCode'); 
					delete_post_meta($post_id, 'conservarCode'); 
				}
				else //no existe o ya se procesó.
				{
					?>
					<script type="text/javascript">
					window.onload = function()
					{								
			            swal(
			              'Lo siento :(',
			              'Enlace inválido',
			              'warning'
			            );
					};
					</script>
					<?php
				}
			}
		?>
		<!-- contenido de la página -->

		<header class="container">
        <?php if (!function_exists('dynamic_sidebar') || 
          !dynamic_sidebar('servicio-001')) : ?>
        <?php endif; ?>
        <div id="search" class="searchBox">
          <?php 
          if (!function_exists('dynamic_sidebar') || 
                !dynamic_sidebar('servicio-002')) : ?>
          <?php endif; ?>
        </div>
        <div class="col-md-12 BoxImgPrincipal"> 
          <img src="<?php bloginfo('template_url') ?>/img/Mascotas.jpg" class="img-responsive" alt="">
        </div> 
      </header>
      
      <article class="container text-center">
        <?php wp_nav_menu(
            array(
              'container'     => 'nav',
              'items_wrap'    =>' <ul id="menuIndex" class="boxMenuIndex">%3$s</ul>',
              'theme_location'=> 'menu-index'
            )
          );
        ?>
      </article>

      <br>
			
		<!-- contenido de la página -->
		<?php 
			require_once("footer.php");
			require_once("js/Scripts to login buttons.php");
		?>

		<script>
			$(document).ready(function(){
				// $("ul.nav-justified li:nth-child(4)").html("Mascotas perdidas");
				$("#menuIndex li:nth-child(1) a").append( "<span class='icon icon-Cat_and_Dog_Vector'></span><span>En esta sección podras dar y encontrar mascotas en adopción</span>" );
            $("#menuIndex li:nth-child(2) a").append( "<span class='icon icon-Lupa_Vector'></span><span>En esta sección podras reportar y ver las mascotas que han sido encontradas</span>" );
            $("#menuIndex li:nth-child(3) a").append( "<span class='icon icon-Dog_Vector'></span><span>En esta sección podras reportar y ver las mascotas que se han perdido</span>" );

            $("#menuIndexTop li:nth-child(1) a").append( "<span class='glyphicon glyphicon-log-in'></span>" );
            $("#menuIndexTop li:nth-child(2) a").append( "<span class='icon icon-edit3'></span>" );
            $("ul.post-categories li a").removeAttr("href");
            $("ul.post-categories li a").removeAttr("rel");
				 

				$('#search').children('article').removeClass("BoxLoginSingIm"); 
            	$('#search').removeClass("searchBox");
            	$('#search').addClass("searchBox--home");      

			});
		</script>
	</body>
</html>
