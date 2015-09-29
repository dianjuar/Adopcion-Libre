<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
      <?php require_once("head.php"); 
      ?>
      <!-- Boton g+ -->
      <link rel="canonical" href="http://bepra.zet.edu.ve/" />
      <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
      <!-- Boton g+ -->
    </head>
    <div class="ventana" id="myModal">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php $post_id = $post->ID; ?>
        <div class="modal-dialog">
           <div class="modal-content">
            <form  method="post" action="">
              <div class="modal-header">
                <button id="btnClose" type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <h3>Finalizar publicación</h3>
              </div>
              <div class="modal-body">
                <p> 
                  Para finalizar la publicación por favor llenar el formulario con los datos
                  de la persona que quedara a cargo de la mascota que se encuentra al final
                  de la pagina de editar publicación
                </p>
                <div class="ventana__btn">
                  <a href="<?php echo admin_url( 'post.php?post='.$post_id.'&action=edit', 'http' ); ?>" class="btn BtnFinalizar">Ir a editar publicación</a>
                </div>
              </div>
              <div class="modal-footer">
                <button id="Mclose" type="button" class="btn">Cancelar</button>
              </div>
            </form>
            </div>
        </div>
      <?php endwhile; // end of the loop. ?>
    </div>
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
          <h1 class="titulo--naranja margin-medium-bottom "><span class="icon icon-Pata_vector"></span>Información de la mascota</h1>
          <?php $cu = wp_get_current_user(); ?>
          <?php $autor = get_the_author(); ?> 
          <?php $post_id = $post->ID; ?> 
          <?php if($autor==$cu->display_name){ ?>
            <a id="btn-dar" class="btn btn-lg BtnFinalizar BtnPosicion BtnFinalizarPosicion">Finalizar publicación</a>
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
            <section class="redes_sociales">
              <div class="fb-share-button btn_fb_margin" data-href="http://bepra.zet.edu.ve/" data-layout="button_count"></div>
              <a href="https://twitter.com/share" class="twitter-share-button" data-via="karilaz">Tweet</a>
              <g:plus action="share" annotation="none"></g:plus>
            </section>
          </section>

          <section  class="col-md-6 col-sm-5 col-xs-12 no-padding">
            <div>
              <h1 class="BoxDetPet__title no-margin"><?php the_title(); ?> </h1>
              <small>Fecha de publicación: <?php the_date(); ?></small>
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
          </section>

          <section class="<?php if(!empty($data[ 'nombre-dueno' ]) && !empty($data[ 'telefono-dueno' ])){ ?>col-md-6 col-sm-6 <?php }else { ?> col-md-12 col-sm-12  <?php } ?>col-xs-12 info_mas">
            <h3 class="titulo--naranja margin-small-top"><span class="icon icon-Pata_vector"></span>Información de contacto:</h3>
            <dl class="BoxDetPet__data no-margin">
              <dt>Ubicación:</dt>
              <dd> <?php if(!empty($data[ 'direccion' ])) {echo $data[ 'direccion' ];} ?></dd>
              <dt><abbr title="Telefono">Tlf:</abbr></dt>
              <dd> <?php if(!empty($data[ 'telefono' ])) {echo $data[ 'telefono' ];} ?></dd>
            </dl>
          </section>

          <?php if(!empty($data[ 'nombre-dueno' ]) && !empty($data[ 'telefono-dueno' ])){ ?>
          <section class="col-md-6 col-sm-6 col-xs-12 info_mas">
            <h3 class="titulo--naranja margin-small-top"><span class="icon icon-Pata_vector"></span>Datos del dueño actual:</h3>
            <dl class="BoxDetPet__data no-margin">
              <dt>Nombre:</dt>
              <dd> <?php echo $data[ 'nombre-dueno' ]; ?></dd>
              <dt><abbr title="Telefono">Tlf:</abbr></dt>
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
      

      <?php require_once("footer.php"); ?>
      <script>
        $(document).ready(function(){

          $("#ImgBig").attr("src",$(".BoxDetPet__ImgSmall:nth-child(1)").attr("src"));
          $( ".BoxDetPet__ImgSmall" ).click(function() {
            $(this).addClass("BoxDetPet__ImgSmall--active");
            $(this).siblings().removeClass("BoxDetPet__ImgSmall--active");
            $("#ImgBig").attr("src",$(this).attr("src"));
          });

          $("#btn-dar").click(function() {
              $("#myModal").css("display","block");
            });
          $("#Mclose").click(function() {
              $("#myModal").css("display","none");
          });
          $("#btnClose").click(function() {
              $("#myModal").css("display","none");
          });

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
