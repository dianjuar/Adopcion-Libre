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

     <article class="container padding-xlarge-left">
        <div class="searchBox">
          <?php 
          if (!function_exists('dynamic_sidebar') || 
                !dynamic_sidebar('servicio-002')) : ?>
          <?php endif; ?>
        </div>
        
        <?php if($user_ID){ ?>
          <a id="btn-dar" href="<?php echo admin_url( 'edit.php?post_type=post&mode=list', 'http' ); ?>" class="btn BtnPerdidos">Dar en adopcion</a>
        <?php } ?>
        
      </article>
      <br>
      <article class="container">
        <section class="post no-margin padding-medium-left">
          <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('cat=4&paged='.$paged ) ?>

          <?php if (have_posts()): while ( have_posts() ) : the_post(); ?>
            <?php $data = get_post_meta( $post->ID, 'post', true );  ?>
              <div class="col-md-4 no-padding">
                  <?php $variable = get_the_ID(); ?>
                  <a href="<?php the_permalink(); ?>" id="<?php echo $variable; ?>">
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
                      <div class="col-md-8 padding-medium"> 
                        <h4 class="no-margin"><?php the_title();?></h4>
                        <span><?php if(!empty($data[ 'raza' ])) {echo $data[ 'raza' ];} ?></span>
                      </div>
                      <div class="col-md-4 post__info__estatus <?php 
                            if(!empty($data[ 'estatus' ]) && $data[ 'estatus' ]=='En adopción') {echo 'post__info__estatus--adopcion';} else { 
                            if(!empty($data[ 'estatus' ]) && $data[ 'estatus' ]=='Perdido') {echo 'post__info__estatus--perdidos';} else {
                            if(!empty($data[ 'estatus' ]) && $data[ 'estatus' ]=='Encontrado') {echo 'post__info__estatus--encontrados';} else { 
                            if(empty($data[ 'estatus' ]) || $data[ 'estatus' ]!='Encontrado' || $data[ 'estatus' ]=='Perdido' || $data[ 'estatus' ]=='En adopcion')  {echo 'post__info__estatus--otros';} } } } ?>"> 
                        <?php if(!empty($data[ 'estatus' ])) {echo $data[ 'estatus' ];} ?>
                      </div>
                    </div>
                  </a>
                </div>      
          <?php endwhile; else: ?>
            <div class="BoxCardPet__NoPost">
              No hay publicaciones
            </div>
          <?php endif; ?>
          <div class="col-md-12 pagina pagina--perdidos">
            <?php previous_posts_link('<span class="glyphicon glyphicon-backward"></span> Anteriores') ?>
            <?php next_posts_link('Siguientes <span class="glyphicon glyphicon-forward"></span>') ?>
          </div>

        </section>
      </article>
      <footer class="container">
          <?php require_once("footer.php"); ?>
      </footer>  

      <script>
        $(document).ready(function(){
          $("#btn-dar").html("Reportar una mascota");
          $("ul.nav-justified li:nth-child(4)").html("Mascotas perdidas");
          $("ul.nav-justified li:nth-child(4)").toggleClass("BoxMenu--moradoActive");

          $(".post a").mouseover(function() {
              $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
              $('.post a').children('.post__info').css("display","none"); 
            });

        });
      </script>
    </body>
</html>
