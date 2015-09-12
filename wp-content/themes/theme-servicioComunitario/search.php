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
      <?php require_once("header.php"); ?>
      <?php require_once("menu.php"); ?>

      <article class="container">
        <section class="post no-margin">
          <div class="col-md-12 no-padding">
            <h1 class="titulo--naranja"><span class="icon icon-Pata_vector"></span>Resultados de la busqueda</h1>
          </div>
        	<h3 class="page-title"><?php printf( __( 'Resultados de: "%s"', 'twentyfifteen' ), get_search_query() ); ?></h3>
            
          <?php require_once("posts.php"); ?>

          <div class="col-md-12 pagina pagina--busqueda">
            <?php previous_posts_link('<span class="glyphicon glyphicon-backward"></span> Anteriores') ?>
            <?php next_posts_link('Siguientes <span class="glyphicon glyphicon-forward"></span>') ?>
          </div>
        </section>

      </article>
      <?php require_once("footer.php"); ?> 
      
      <script>
        $(document).ready(function(){

          $(".post a").mouseover(function() {
              $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
              $('.post a').children('.post__info').css("display","none"); 
            });
          <?php if ( is_user_logged_in() ) { 
            ?>
            $('.BoxLoginSingIm ul li:nth-child(2) a').text("Cerrar sesión");
            $('.BoxLoginSingIm ul li:nth-child(1) a').text("Hola, <?php echo $current_user->user_firstname; ?>");

          <?php
          } else {?>

            $('.BoxLoginSingIm ul li:nth-child(2) a').text("Iniciar sesión");

          <?php
          } ?>
        });

      </script>
    </body>
</html>