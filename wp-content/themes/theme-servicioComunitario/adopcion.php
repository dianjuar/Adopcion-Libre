<?php
/* 
 * Template Name: adopcion
 * Description: Plantilla la pagina adopta un amigo.
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
      <?php require_once("header.php"); ?>
      <?php require_once("menu.php"); ?>

      <article class="container">
        <section class="post no-margin padding-small">

          <div class="col-md-12 no-padding">
            <h1 class="titulo--azul"><span class="icon icon-Pata_vector"></span>Mascotas en adopción</h1>

            <?php if($user_ID){ ?>
            <a id="btn-dar" href="<?php echo admin_url( 'post-new.php?post_category=adopcion' ); ?>" class="btn btn-lg BtnAdopcion BtnPosicion">Dar en adopcion</a>
            <?php } ?>
          </div>
          
          <div class="col-md-12 pagina pagina--adopcion"></div>
          <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('post_status=publish&category_name=adopcion&paged='.$paged ) ?>

          <?php require_once("posts.php"); ?>

          <div class="col-md-12 pagina pagina--adopcion">
            <?php previous_posts_link('<span class="glyphicon glyphicon-backward"></span> Anteriores') ?>
            <?php next_posts_link('Siguientes <span class="glyphicon glyphicon-forward"></span>') ?>
          </div>
        </section>

      </article>
      <?php 
            require_once("footer.php");
            require_once("js/Scripts to login buttons.php");
        ?>
      
      <script>
        $(document).ready(function(){
          $("ul.nav-justified li:nth-child(2)").html("Adopta un amigo");
          $("ul.nav-justified li:nth-child(2)").addClass("Active");

          $(".post a").mouseover(function() {
              $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
              $('.post a').children('.post__info').css("display","none"); 
            });         
        });

      </script>
    </body>
</html>
