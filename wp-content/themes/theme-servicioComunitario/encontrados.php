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


      <?php require_once("header.php"); ?>
      <?php require_once("menu.php"); ?>

      <article class="container">
        <section class="post no-margin padding-small">

          <div class="col-md-12 no-padding">
            <h1 class="titulo--verde"><span class="icon icon-Pata_vector"></span> Mascotas encontradas</h1>
            <?php if($user_ID){ ?>
              <a id="btn-dar" class="btn btn-lg BtnEncontrados BtnPosicion" data-toggle="modal" data-target="#myModal">
                Reportar una mascota
              </a>
            <?php } ?>
          </div>

            <?php
            //aquí es donde se llaman a los select y se cargan las variables estado y municipio.
            require_once('filtroEstados.php');
            ?>

          <div class="col-md-12 pagina pagina--encontrados"></div>

           
          <?php 
          filtrarPost ('encontrados');
          require_once("posts.php");
           ?>

          <div class="col-md-12 pagina pagina--encontrados">
            <?php
                previous_posts_link('<span class="glyphicon glyphicon-backward"></span> Anteriores');
                // la variable $queryPost; está declarada como global en posts.php y por lo tanto ya está declarada
                next_posts_link('Siguientes <span class="glyphicon glyphicon-forward"></span>',$queryPost->max_num_pages);
            ?>
          </div>

        </section>
      </article>
        <?php 
            require_once("footer.php");
            require_once("js/Scripts to login buttons.php");
        ?>

      <script>
        $(document).ready(function(){
            $("ul.nav-justified li:nth-child(3)").html("Mascotas encontradas");
            $("ul.nav-justified li:nth-child(3)").toggleClass("Active");

            $(".post a").mouseover(function() {
                $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
                $('.post a').children('.post__info').css("display","none"); 
            });

            $("#btn-dar").click( function(){
                swal({
                    title: 'Importante',
                    html: 'Revisa primero en la sección ' +
                          '<a target="_blank" href="<?php echo get_permalink( get_page_by_title("Mascotas perdidas") ); ?>"><b>"Mascotas Perdidas"</b></a>' +
                          ' a ver si el dueño reportó a su mascota.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#15DB5B',
                    confirmButtonText: 'Reportar Mascota',
                    cancelButtonText: 'Cerrar'
                },
                function() {
                    window.location.replace(  '<?php echo admin_url( "post-new.php?post_category=encontrado" ); ?>' );
                });
            });
        });
      </script>
    </body>
</html>
