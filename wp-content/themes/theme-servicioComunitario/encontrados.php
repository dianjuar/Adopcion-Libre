<?php
/*
 * Template Name: encontrados
 * Description: Plantilla la pagina mascotas encontradas.
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
      <div class="ventana" id="myModal">
          <div class="modal-dialog">
           <div class="modal-content">
              <div class="modal-header">
                <button id="btnClose" type="button" class="close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <div class="ventana__warning">
                  <span class="glyphicon glyphicon-warning-sign"></span>
                </div>
                <p> 
                  Antes de reportar un animal como encontrado busca primero en la sección “Mascotas perdidas” a ver si el dueño reporto a su mascota.
                </p>
                <div class="ventana__btn">
                  <a class="btn BtnPerdidos" href="<?=get_permalink( get_page_by_title('Mascotas perdidas') );?>">Ir a mascotas perdidas</a>
                </div>
              </div>
              <div class="modal-footer">
                <a class="btn BtnEncontrados" href="<?php echo admin_url( 'post-new.php?post_category=encontrado', 'http' ); ?>">Reportar una mascota</a>
                <button id="Mclose" type="button" class="btn">Cerrar</button>
                
              </div>
            </div>
          </div>
      </div>

      <?php require_once("header.php"); ?>
      <?php require_once("menu.php"); ?>

      <article class="container">
        <section class="post no-margin padding-small">

          <div class="col-md-12 no-padding">
            <h1 class="titulo--verde"><span class="icon icon-Pata_vector"></span> Mascotas encontradas</h1>
            <?php if($user_ID){ ?>
              <a id="btn-dar" class="btn btn-lg BtnEncontrados BtnPosicion">Reportar una mascota</a>
            <?php } ?>
          </div>

          <div class="col-md-12 pagina pagina--encontrados"></div>
        
          <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('category_name=encontrados&paged='.$paged ) ?>
          <?php $category_name = "encontrados" ?>
          <?php require_once("posts.php"); ?>

          <div class="col-md-12 pagina pagina--encontrados">
            <?php previous_posts_link('<span class="glyphicon glyphicon-backward"></span> Anteriores') ?>
            <?php next_posts_link('Siguientes <span class="glyphicon glyphicon-forward"></span>') ?>
          </div>

        </section>
      </article>
      <?php require_once("footer.php"); ?>

      <script>
        $(document).ready(function(){
          $("ul.nav-justified li:nth-child(3)").html("Mascotas encontradas");
          $("ul.nav-justified li:nth-child(3)").toggleClass("Active");

          $(".post a").mouseover(function() {
              $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
              $('.post a').children('.post__info').css("display","none"); 
            });

          $("#btn-dar").click(function() {
              $("#myModal").css("display","block");
            });

          $("#Mclose").click(function() {
              $("#myModal").css("display","none");
          });

          $("#btnClose").click(function() {
              $("#myModal").css("display","none");
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
