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
      <?php if (!function_exists('dynamic_sidebar') || 
          !dynamic_sidebar('servicio-001')) : ?>
        <?php endif; ?>
      <div class="container searchBox">
          <?php 
          if (!function_exists('dynamic_sidebar') || 
                !dynamic_sidebar('servicio-002')) : ?>
          <?php endif; ?>
      </div>
      <article class="container padding-large-left">
        <div class="row no-margin margin-medium" >
          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <?php $data = get_post_meta( $post->ID, 'post', true );  ?>

          <section  class="col-md-6 no-padding BoxDetPet__ImgBox">
            <div  class="col-md-2">
              <?php $em_mtbx_img1 = get_post_meta( $post->ID, '_em_mtbx_img1', true );
                if($em_mtbx_img1 != '') { // Si existe el valor ?>
                  <img src="<?php echo $em_mtbx_img1; ?>" class="img-responsive BoxDetPet__ImgSmall BoxDetPet__ImgSmall--active" alt="" /> 
                <?php } ?>

              <?php $em_mtbx_img2 = get_post_meta( $post->ID, '_em_mtbx_img2', true );
                if($em_mtbx_img2 != '') { // Si existe el valor ?>
                  <img src="<?php echo $em_mtbx_img2; ?>" class="img-responsive BoxDetPet__ImgSmall" alt="" /> 
                <?php } ?>

              <?php $em_mtbx_img3 = get_post_meta( $post->ID, '_em_mtbx_img3', true );
                if($em_mtbx_img3 != '') { // Si existe el valor ?>
                  <img src="<?php echo $em_mtbx_img3; ?>" class="img-responsive BoxDetPet__ImgSmall" alt="" /> 
                <?php } ?>
              <?php $em_mtbx_img4 = get_post_meta( $post->ID, '_em_mtbx_img4', true );
                if($em_mtbx_img4 != '') { // Si existe el valor ?>
                  <img src="<?php echo $em_mtbx_img4; ?>" class="img-responsive BoxDetPet__ImgSmall" alt="" /> 
                <?php } ?>
              <?php $em_mtbx_img5 = get_post_meta( $post->ID, '_em_mtbx_img5', true );
                if($em_mtbx_img5 != '') { // Si existe el valor ?>
                  <img src="<?php echo $em_mtbx_img5; ?>" class="img-responsive BoxDetPet__ImgSmall" alt="" /> 
                <?php } ?>
            </div>
            <div  class="col-md-10 BoxDetPet__ImgBigBox no-padding">
              <img id="ImgBig" src="" class="img-responsive img-thumbnail BoxDetPet__ImgBig" alt="...">
            </div>
          </section>

          <section  class="col-md-6 no-padding">
            <div>
              <h1 class="BoxDetPet__title no-margin"><?php the_title(); ?> <small>Fecha de publicación: <?php the_date(); ?></small></h1>
            </div>

            <dl class="BoxDetPet__data no-margin">
              <dt>Descripción:</dt>
              <dd><?php the_content(); ?></dd>
              <dt>Tipo:</dt>
              <dd><?php if(!empty($data[ 'tipo' ])) {echo ($data[ 'tipo' ]); } ?></dd>
              <dt>Raza:</dt>
              <dd><?php if(!empty($data[ 'raza' ])) {echo $data[ 'raza' ];} ?></dd>
              <dt>Esterelizado:</dt>
              <dd><?php if(!empty($data[ 'esterilizacion' ])) {echo $data[ 'esterilizacion' ];} ?></dd>
              <dt>Estado:</dt>
              <dd><?php if(!empty($data[ 'estatus' ])) {echo $data[ 'estatus' ];} ?></dd>
            </dl> 
            <h3 class="no-margin margin-small-left">Información de contacto</h3> 
            <dl class="margin-small-left no-margin">
              <dt>Ubicación:</dt>
              <dd> <?php if(!empty($data[ 'direccion' ])) {echo $data[ 'direccion' ];} ?></dd>
              <dt><abbr title="Telefono">Tlf:</abbr></dt>
              <dd> <?php if(!empty($data[ 'telefono' ])) {echo $data[ 'telefono' ];} ?></dd>
            </dl>
          </section>
          <section class="col-md-12 BoxDetPet__labelBox margin-small-top">
            <span class="label BoxDetPet__label BoxDetPet__label__titulo">Etiquetas: </span> 
              <?php $mytags = get_the_tags(); ?> 
              <?php if ($mytags) : ?> 
                <?php foreach($mytags as $tag) : ?> 
                  <span class="label BoxDetPet__label"><?php echo $tag->name; ?></span> 
                <?php endforeach; ?> 
              <?php endif; ?>
          
          </section>
        </div>
        <h2><span class="icon icon-Pata_vector"></span> Comentarios:</h2>
        <section class="col-md-12">
          <?php comments_template( '', true ); ?>
        </section>
          
        <?php endwhile; // end of the loop. ?>
      </article>

      <footer class="container">
          <?php require_once("footer.php"); ?>
      </footer>  
      <script>
        $(document).ready(function(){

          $("#ImgBig").attr("src",$(".BoxDetPet__ImgSmall:nth-child(1)").attr("src"));
          $( ".BoxDetPet__ImgSmall" ).click(function() {
            $(this).addClass("BoxDetPet__ImgSmall--active");
            $(this).siblings().removeClass("BoxDetPet__ImgSmall--active");
            $("#ImgBig").attr("src",$(this).attr("src"));
          });
        });

      </script>
    </body>
</html>
