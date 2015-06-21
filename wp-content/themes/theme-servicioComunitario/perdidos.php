<?php
/*
 * Template Name: perdidos
 * Description: Plantilla la pagina mascotas perdidas.
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
                  Antes de reportar un animal como perdido busca primero en la sección “Mascotas encontradas” para asegurarte de que no haya sido reportada como encontrada.
                </p>
                <div class="ventana__btn">
                  <a class="btn BtnEncontrados" href="<?=get_permalink( get_page_by_title('Mascotas perdidas') );?>">Ir a mascotas Encontradas</a>
                </div>
              </div>
              <div class="modal-footer">
                <a class="btn BtnPerdidos" href="<?php echo admin_url( 'post-new.php', 'http' ); ?>">Reportar una mascota</a>
                <button id="Mclose" type="button" class="btn">Cerrar</button>
                
              </div>
            </div>
          </div>
      </div>
    <body >
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
      <?php require_once("header.php"); ?>
      <?php require_once("menu.php"); ?>

      <article class="container">
        <section class="post no-margin padding-small">

          <div class="col-md-12 no-padding">
            <h1 class="titulo--morado"><span class="icon icon-Pata_vector"></span>Mascotas perdidas</h1>
            
            <?php if($user_ID){ ?>
            <a id="btn-dar" class="btn BtnPerdidos BtnPosicion">Reportar una mascota</a>
            <?php } ?>
          </div>

          <div class="col-md-12 pagina pagina--perdidos"></div>

          <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('category_name=perdidos&paged='.$paged ) ?>
          
          <?php require_once("posts.php"); ?>

          <div class="col-md-12 pagina pagina--perdidos">
            <?php previous_posts_link('<span class="glyphicon glyphicon-backward"></span> Anteriores') ?>
            <?php next_posts_link('Siguientes <span class="glyphicon glyphicon-forward"></span>') ?>
          </div>

        </section>
      </article>
      <?php require_once("footer.php"); ?>
      
      <script>
        $(document).ready(function(){
          $("ul.nav-justified li:nth-child(4)").html("Mascotas perdidas");
          $("ul.nav-justified li:nth-child(4)").toggleClass("Active");

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

        });
      </script>
    </body>
</html>
