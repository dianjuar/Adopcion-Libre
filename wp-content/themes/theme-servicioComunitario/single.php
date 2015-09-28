<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
      <?php 
        require_once("head.php"); 
        require_once ("Funcionalidades/finalizar post.php");
      ?>
    </head>
    <body >
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
      <?php require_once("header.php"); ?>
      <?php require_once("menu.php"); ?>

      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php $data = get_post_meta( $post->ID, 'post', true );  ?>
      <article class="container padding-small">
        <div class="col-md-12 no-padding">
          <h1 class="titulo--naranja"><span class="icon icon-Pata_vector"></span>Información de la mascota</h1>
          <?php 
            $cu = wp_get_current_user(); 
            $post_id = $post->ID; 
            if(($cu->ID==$post->post_author) && ($post->post_status == "publish")){ ?>
              <button type="button" class="btn btn-lg BtnFinalizar BtnPosicion BtnFinalizarPosicion" data-toggle="modal" data-target="#myModal">
              	Finalizar publicación
              </button>
          <?php } ?>
        </div>

        <div class="row no-margin margin-medium" >
          <section  class="col-md-6 col-sm-7 col-xs-12 no-padding BoxDetPet__ImgBox">
            <div  class="col-md-2 col-sm-2 col-xs-12">
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
            <div  class="col-md-10 col-sm-10 col-xs-12 BoxDetPet__ImgBigBox no-padding">
              <img id="ImgBig" src="" class="img-responsive BoxDetPet__ImgBig" alt="...">
            </div>
          </section>

          <section  class="col-md-6 col-sm-5 col-xs-12 no-padding">
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
            </dl> 
            <h3 class="no-margin margin-small-left">Información de Contacto</h3> 
            <dl class="BoxDetPet__data no-margin">
              <dt>Nombre:</dt>
              <dd> <?php echo wp_get_current_user()->display_name; ?></dd>
              <dt>Ubicación:</dt>
              <dd> <?php if(!empty($data[ 'direccion' ])) {echo $data[ 'direccion' ];} ?></dd>
              <dt><abbr title="Teléfono">Tlf:</abbr></dt>
              <dd> <?php if(!empty($data[ 'telefono' ])) {echo $data[ 'telefono' ];} ?></dd>
            </dl>
            <?php if(!empty($data[ 'nombre-dueno' ]) && !empty($data[ 'telefono-dueno' ])){ ?>
            <h3 class="no-margin margin-small-left">Información del Dueño Actual</h3>
            <dl class="BoxDetPet__data no-margin">
              <dt>Nombre:</dt>
              <dd> <?php echo $data[ 'nombre-dueno' ]; ?></dd>
              <dt><abbr title="Teléfono">Tlf:</abbr></dt>
              <dd> <?php echo $data[ 'telefono-dueno' ]; ?></dd>
            </dl>
            <?php } ?>
          </section>
                     
          <section class="col-md-12 col-sm-12 col-xs-12 BoxDetPet__labelBox margin-small-top">
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
      </article>
      <?php endwhile; // end of the loop. ?>
      

      <?php 
            require_once("footer.php");
            require_once("js/Scripts to login buttons.php");
        ?>
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
