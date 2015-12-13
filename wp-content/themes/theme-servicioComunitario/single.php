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
      <!-- Boton g+ -->
      <link rel="canonical" href="http://bepra.zet.edu.ve/" />
      <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
      <!-- Boton g+ -->
    </head>
    <body >     
      <!-- Boton fb -->
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.4&appId=1597708607152911";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <!-- Boton fb -->
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
              <button type="button" class="btn btn-lg BtnFinalizar BtnPosicion" data-toggle="modal" data-target="#myModal">
              	Finalizar publicación
              </button>
          <?php } ?>
         <?php 
            if (in_category('adopcion')){ 
               echo '<div type="button" class="btn btn-lg BtnMarcarPost BtnAdopcion">Mascota en adopción</div>';
            } 
            if (in_category('perdidos')){ 
               echo '<div type="button" class="btn btn-lg BtnMarcarPost BtnPerdidos">Mascota perdida</div>';
            } 
            if (in_category('encontrados')){ 
               echo '<div type="button" class="btn btn-lg BtnMarcarPost BtnEncontrados">Mascota encontrada</div>';
            }?>
        </div>

        <div class="row no-margin margin-medium" >
          <section  class="col-md-6 col-sm-7 col-xs-12 no-padding">
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
            <section class="col-md-12 redes_sociales">
              <div class="fb-share-button" data-href="http://bepra.zet.edu.ve/" data-layout="button_count"></div>
              <a href="https://twitter.com/share" class="twitter-share-button" data-via="karilaz">Tweet</a>
              <g:plus action="share" annotation="none"></g:plus>
            </section>
          </section>

          <section  class="col-md-6 col-sm-5 col-xs-12 no-padding">
            <div>
              <h1 class="BoxDetPet__title no-margin"><?php the_title(); ?> </h1>
              <small class="padding-small-left"><strong>Fecha de publicación:</strong> <?php the_date(); ?></small>
            </div>

            <dl class="BoxDetPet__data no-margin">
              <dt>Descripción:</dt>
              <dd><?php the_content(); ?></dd>
              <dt>Tipo:</dt>
              <dd><?php if(!empty($data[ 'tipo' ])) {echo ($data[ 'tipo' ]); } ?></dd>
              <?php 
                if(!empty($data[ 'raza' ])) { ?>
                  <dt>Raza:</dt>
                  <dd><?php echo $data[ 'raza' ]; ?></dd>
                <?php
                }  ?>
              <dt>Esterelizado:</dt>
              <dd><?php if(!empty($data[ 'esterilizacion' ])) {echo $data[ 'esterilizacion' ];} ?></dd>
            </dl> 
          </section>

          <section class="col-md-6 col-sm-6 col-xs-12 info_mas">
            <h3 class="titulo--naranja margin-small-top"><span class="icon icon-Pata_vector"></span>Información de contacto:</h3>
            <dl class="BoxDetPet__data no-margin">
              <dt>Nombre:</dt>
              <dd> <?php echo get_user_by('id', $post->post_author )->display_name; ?></dd>
              <dt>Estado:</dt>
              <dd> <?php echo get_post_meta( $post->ID, 'estado', true ); ?></dd>
              <dt>Municipio:</dt>
              <dd> <?php echo get_post_meta( $post->ID, 'municipio', true ); ?></dd>
              <dt>Ubicación:</dt>
              <dd> <?php if(!empty($data[ 'direccion' ])) {echo $data[ 'direccion' ];} ?></dd>
              <dt><abbr title="Teléfono">Tlf:</abbr></dt>
              <dd> <?php if(!empty($data[ 'telefono' ])) {echo $data[ 'telefono' ];} ?></dd>
            </dl>
          </section>

          <?php if(!empty($data[ 'nombre-dueno' ]) && !empty($data[ 'telefono-dueno' ])){ ?>
          <section class="col-md-6 col-sm-6 col-xs-12 info_mas">
            <h3 class="titulo--naranja margin-small-top"><span class="icon icon-Pata_vector"></span>Datos del dueño actual:</h3>
            <dl class="BoxDetPet__data no-margin">
              <dt>Nombre:</dt>
              <dd> <?php echo $data[ 'nombre-dueno' ]; ?></dd>
              <dt><abbr title="Teléfono">Tlf:</abbr></dt>
              <dd> <?php echo $data[ 'telefono-dueno' ]; ?></dd>
            </dl>
          </section>
          <?php } ?>
                     
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

        <h2 class="titulo--naranja margin-large-top"><span class="icon icon-Pata_vector"></span> Comentarios:</h2>
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
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      <script type="text/javascript">
        window.___gcfg = {
          lang: 'en-US'
        };

        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
      </script>
    </body>
</html>
