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
            <a id="btn-dar" class="btn btn-lg BtnPerdidos BtnPosicion">Reportar una mascota</a>
            <?php } ?>
          </div>

          <div class="col-md-12 pagina pagina--perdidos"></div>

          <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('post_status=publish&category_name=perdidos&paged='.$paged ) ?>
          <?php require_once("posts.php"); ?>

          <div class="col-md-12 pagina pagina--perdidos">
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
          $("ul.nav-justified li:nth-child(4)").html("Mascotas perdidas");
          $("ul.nav-justified li:nth-child(4)").toggleClass("Active");

          $(".post a").mouseover(function() {
              $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
              $('.post a').children('.post__info').css("display","none"); 
            });

            $("#btn-dar").click( function(){
                swal({
                    title: 'Importante',
                    html: 'Revisa primero en la sección ' +
                          '<a target="_blank" href="<?php echo get_permalink( get_page_by_title("Mascotas encontradas") ); ?>"><b>"Mascotas Encontradas"</b></a>' +
                          ' a ver si alguien reportó tu mascota.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#E01F95',
                    confirmButtonText: 'Reportar Mascota',
                    cancelButtonText: 'Cerrar'
                },
                function() {
                    window.location.replace(  '<?php echo admin_url( "post-new.php?post_category=perdido" ); ?>' );
                });
            });
         
        });
      </script>
    </body>
</html>
