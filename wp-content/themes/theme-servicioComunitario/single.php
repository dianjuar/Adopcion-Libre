<?php 
  session_start();
  /*===== USER Archivar publicación - Post ON =========================================*/
  if(isset($_POST["Boton"])){
    $post_id = $_POST["post-id"];
    echo '<script language="javascript">alert("'.$post_id.'");</script>';
    
    $data['nombre-Dueño'] = $_POST['nombre-Dueño'];
    $data['dueño-telefono'] = $_POST['dueño-telefono'];
    
    // update_post_meta( $_POST["post-id"], 'nombre-Dueño',  $_POST['nombre-dueno'] );
    // update_post_meta( $_POST["post-id"], 'dueño-telefono',  $_POST['telefono-dueno'] );
    update_post_meta( $post_id, 'post', $data);
  }
  /*===== USER Archivar publicación - Post OFF ========================================*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
      <?php require_once("head.php"); 
      ?>
    </head>
    <div class="ventana" id="myModal">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="modal-dialog">
           <div class="modal-content">
            <form  method="post" action="">
              <div class="modal-header">
                <button id="btnClose" type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <h3>Finalizar publicación</h3>
              </div>
              <div class="modal-body">
                <p> 
                  Por favor ingresa los datos de la persona que quedara a cargo de la mascota,
                  <?php $post_id = $post->ID; echo $post_id; ?> 
                </p>
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre:</label>
                    <input type="text" class="form-control" name="nombre-Dueño" id="nombre-Dueño" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input type="text" class="form-control" name="telefono-dueno" id="telefono-dueno" placeholder="telefono" required>
                  </div>
                   <input type="hidden" name="post-id" value="<?php echo $post_id; ?>">
              </div>
              <div class="modal-footer">
                <button name="Boton" type="submit" class="btn" >Guardar</button>
                <button id="Mclose" type="button" class="btn">Cancelar</button>
              </div>
            </form>
            </div>
        </div>
        <?php endwhile; // end of the loop. ?>
      </div>
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
          <?php $cu = wp_get_current_user(); ?>
          <?php $autor = get_the_author(); ?> 
          <?php if($autor==$cu->display_name){ ?>
            <a id="btn-dar" class="btn BtnFinalizar BtnPosicion">Finalizar publicación</a>
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
              <dt>Estado:</dt>
              <dd><?php if(!empty($data[ 'estatus' ])) {echo $data[ 'estatus' ];} ?></dd>
            </dl> 
            <h3 class="no-margin margin-small-left">Información de contacto</h3> 
            <dl class="BoxDetPet__data no-margin">
              <dt>Ubicación:</dt>
              <dd> <?php if(!empty($data[ 'direccion' ])) {echo $data[ 'direccion' ];} ?></dd>
              <dt><abbr title="Telefono">Tlf:</abbr></dt>
              <dd> <?php if(!empty($data[ 'telefono' ])) {echo $data[ 'telefono' ];} ?></dd>
            </dl>
            <dl class="BoxDetPet__data no-margin">
              <dt>Datos del dueño actual:</dt>
              <dd> <?php if(!empty($data[ 'nombre-dueno' ])) {echo $data[ 'nombre-dueno' ];} ?></dd>
              <dt><abbr title="Telefono">Tlf:</abbr></dt>
              <dd> <?php if(!empty($data[ 'telefono-dueno' ])) {echo $data[ 'telefono-dueno' ];} ?></dd>
            </dl>
          </section>
           <?php global $post_id; ?> 
          <?php $post_id = $post->ID; echo $post_id; ?> 
          
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
          
        <?php endwhile; // end of the loop. ?>
      </article>

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
        });

      </script>
    </body>
</html>
