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
      <header class="container padding-large-left">
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

      <article class="container boxMenuIndex text-center">
        <?php wp_nav_menu(
            array(
              'container'     => 'nav',
              'items_wrap'    =>' <ul id="menuIndex" class="boxMenuIndex">%3$s</ul>',
              'theme_location'=> 'menu-index'
            )
          );
        ?>
      </article>
      <article class="container post padding-large-left"> 
        <div class="post__titulo">
          <h2>Publicaciones recientes:</h2>
        </div>
        
        <div class="row no-margin">
          <?php if (have_posts()): while ( have_posts() ) : the_post(); ?>
            <?php $myposts = get_posts('numberposts=6&offset=0');
              foreach($myposts as $post) { ?>
                <div class="col-md-4 no-padding">
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
                      <div class="col-md-8 padding-medium"> 
                        <h4 class="no-margin"><?php the_title();?></h4>
                        <span><?php if(!empty($data[ 'raza' ])) {echo $data[ 'raza' ];} ?></span>
                      </div>
                      <div class="col-md-4 post__info__estatus <?php 
                            if(!empty($data[ 'estatus' ]) && $data[ 'estatus' ]=='En adopción') {echo 'post__info__estatus--adopcion';} else { 
                            if(!empty($data[ 'estatus' ]) && $data[ 'estatus' ]=='Perdido') {echo 'post__info__estatus--perdidos';} else {
                            if(!empty($data[ 'estatus' ]) && $data[ 'estatus' ]=='Encontrado') {echo 'post__info__estatus--encontrados';} else { 
                            if(empty($data[ 'estatus' ]) || $data[ 'estatus' ]!='Encontrado' || $data[ 'estatus' ]=='Perdido' || $data[ 'estatus' ]=='En adopcion')  {echo 'post__info__estatus--otros';} } } } ?>"> 
                        <?php if(!empty($data[ 'estatus' ])) {echo $data[ 'estatus' ];} else {echo "Sin categoria";} ?>
                      </div>
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
      <footer class="container">
          <?php require_once("footer.php"); ?>
      </footer>  
      <script>
        $(document).ready(function(){
          $("#menuIndex li:nth-child(1) a").append( "<span class='icon icon-Cat_and_Dog_Vector'></span>" );
          $("#menuIndex li:nth-child(2) a").append( "<span class='icon icon-Lupa_Vector'></span>" );
          $("#menuIndex li:nth-child(3) a").append( "<span class='icon icon-Dog_Vector'></span>" );

          $("#menuIndexTop li:nth-child(1) a").append( "<span class='glyphicon glyphicon-log-in'></span>" );
          $("#menuIndexTop li:nth-child(2) a").append( "<span class='icon icon-edit3'></span>" );

          $(".post a").mouseover(function() {
              $(this).children('.post__info').css("display","block");
            }).mouseout(function (){
              $('.post a').children('.post__info').css("display","none"); 
            });

        });
      </script>
    </body>
</html>
