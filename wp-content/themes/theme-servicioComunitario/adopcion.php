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

            <div class="col-md-12 no-padding titulo__box">
                <h1 class="titulo--azul"><span class="icon icon-Pata_vector"></span>Mascotas en adopción</h1>

                <?php if($user_ID){ ?>
                <a id="btn-dar" href="<?php echo admin_url( 'post-new.php?post_category=adopcion' ); ?>" class="btn btn-lg BtnAdopcion BtnPosicion">Dar en adopcion</a>
                <?php } ?>
            </div>
            <div class="col-md-12 pagina pagina--adopcion"></div>
            
            <!-- <div class="col-md-12 pagina pagina--adopcion"></div> -->
            <div class="row">
                <?php
                //aquí es donde se llaman a los select y se cargan las variables estado y municipio.
                require_once('filtroEstados.php');
                ?>
                
                <?php 
                filtrarPost ('adopcion');
                ?>

                <div class="col-md-9 container-fluid">
                <?php
                    global $queryPost;
                    if ( $queryPost->have_posts()): 
                        while ( $queryPost->have_posts() ) :
                            $queryPost->the_post();
                            get_template_part( 'template-parts/content');
                        endwhile;
                    else:
                        get_template_part( 'template-parts/content','none');
                    endif;
                ?>
                </div>

            </div>
            


            <div class="col-md-12 pagina pagina--adopcion">
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
          $("ul.nav-justified li:nth-child(2)").html("Adopta un amigo");
          $("ul.nav-justified li:nth-child(2)").addClass("Active");
       
        });

      </script>
    </body>
</html>
