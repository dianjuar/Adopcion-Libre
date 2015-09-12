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
      <header class="container">
        <?php if (!function_exists('dynamic_sidebar') || 
          !dynamic_sidebar('servicio-001')) : ?>
        <?php endif; ?>
        <div class="searchBox">
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
      
      <article class="container post"> 
        <div class="post__titulo">
          <h2>Publicaciones recientes:</h2>
        </div>
        
        <div class="row no-margin">
          <?php if (have_posts()): while ( have_posts() ) : the_post(); ?>
            <?php $myposts = get_posts('numberposts=6&offset=0');
              foreach($myposts as $post) { ?>
                <div class="col-md-4 col-sm-6 no-padding">
                  <?php $variable = get_the_ID(); ?>
                  <a href="<?php the_permalink(); ?>" id="<?php echo $variable; ?>">
                    <?php $data = get_post_meta( $post->ID, 'post', true );  ?>
                    <?php $em_mtbx_img1 = get_post_meta( $post->ID, '_em_mtbx_img1', true );
                    if($em_mtbx_img1 != '') { // Si existe el valor ?>
                      <div class="post__imgContainer">
                        <img src="<?php echo $em_mtbx_img1; ?>" class="post__imgPost img-responsive" alt="" /> 
                      </div>
                    <?php } else { ?> 
                      <div class="post__imgContainer post__imgPost post__imgPost--noFound">
                      Imagen no disponible
                      </div>
                    <?php } ?>
                    <div class="post__info row no-margin">
                      <div class="col-md-8 col-xs-7 padding-medium"> 
                        <h4 class="no-margin"><?php the_title();?></h4>
                        <span><?php if(!empty($data[ 'raza' ])) {echo $data[ 'raza' ];} ?></span>
                      </div>
                      <?php 
                        if (in_category('adopcion')){
                          ?>
                          <div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--adopcion"> 
                            <?php the_category(); ?>
                          </div>
                          <?php
                        }
                        else{
                          if (in_category('perdidos')){
                            ?>
                            <div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--perdidos"> 
                              <?php the_category(); ?>
                            </div>
                            <?php
                          }
                          else{
                            if (in_category('encontrados')){
                              ?>
                              <div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--encontrados"> 
                                <?php the_category(); ?>
                              </div>
                              <?php
                            }
                            else{
                              ?>
                              <div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--otros"> 
                                <?php the_category(); ?>
                              </div>
                              <?php
                            }
                          }
                        }
                      ?>
                      
                    </div>
                  </a>
                </div>
            <?php } break; ?>
          <?php endwhile; else: ?>
              <div class="BoxCardPet__NoPost">
                No hay publicaciones
              </div>
          <?php endif; ?>
        </div>
        
      </article>
      <?php require_once("footer.php"); ?>
      <script>
        $(document).ready(function(){
          $("#menuIndex li:nth-child(1) a").append( "<span class='icon icon-Cat_and_Dog_Vector'></span><span>En esta sección podras dar y encontrar mascotas en adopción</span>" );
          $("#menuIndex li:nth-child(2) a").append( "<span class='icon icon-Lupa_Vector'></span><span>En esta sección podras reportar y ver las mascotas que han sido encontradas</span>" );
          $("#menuIndex li:nth-child(3) a").append( "<span class='icon icon-Dog_Vector'></span><span>En esta sección podras reportar y ver las mascotas que se han perdido</span>" );

          $("#menuIndexTop li:nth-child(1) a").append( "<span class='glyphicon glyphicon-log-in'></span>" );
          $("#menuIndexTop li:nth-child(2) a").append( "<span class='icon icon-edit3'></span>" );
          $("ul.post-categories li a").removeAttr("href");
          $("ul.post-categories li a").removeAttr("rel");

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
