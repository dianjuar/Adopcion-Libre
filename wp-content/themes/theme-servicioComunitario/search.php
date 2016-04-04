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
      <strong></strong>
      <article class="container">
        <section class="post no-margin">
          
          <h1 class="titulo--naranja"><span class="icon icon-Pata_vector"></span>Resultados de la busqueda</h1>
            
          <div class="row">
            <?php 
                require_once('filtroEstados.php');
            ?>
            <div class="col-md-9 container-fluid">
              <h3 class="page-title"><?php printf( __( 'Resultados de: "<strong>%s</strong>"', 'twentyfifteen' ), get_search_query() ); ?></h3>
            <?php
                if (have_posts()): 
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content');
                    endwhile;
                else:
                    get_template_part( 'template-parts/content','none');
                endif;
            ?>
            </div>

          </div>
            
          <div class="col-md-12 pagina pagina--busqueda">
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

          $('#advanced-search-widget-2-s').val( $('.page-title strong').text() );

        });

      </script>
    </body>
</html>