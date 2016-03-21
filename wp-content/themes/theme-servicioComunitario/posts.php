<?php
   /*Return false cuando no se debe mostrar el post OJO solo para search widget*/
   function filtrarResultadoSearch($post){
      global $estado, $municipio;

      if($estado == '')
         return true;

      $estadoPost = get_post_meta($post->ID, 'estado', true);
      
      if($estado == $estadoPost && $municipio == '')
         return true;

      $municipioPost = get_post_meta($post->ID, 'municipio', true);
      
      if($estado == $estadoPost && $municipio == $municipioPost)
         return true;

      return false;
   }
?>

<div class="col-md-12 container-fluid">
   <?php
	//antes de querer usar las variables estado y municipio deben añadir este archivo.
	// global $queryPost;
   $mostroAlgo = false;

      if (/*$queryPost->*/have_posts()): 
         while ( /*$queryPost->*/have_posts() ) :
            /*$queryPost->*/the_post(); 
      
            $mostroAlgo = true;

            $data = get_post_meta( $post->ID, 'post', true );  
            $variable = get_the_ID();

            echo '<a class="col-md-4 col-sm-6 post no-padding" href="';the_permalink();echo '" id="'.$variable.'">';

               $em_mtbx_img1 = get_post_meta( $post->ID, '_em_mtbx_img1', true );
               if($em_mtbx_img1 != '') { 
                  echo '<div class="post__imgContainer">
                           <img src="'.$em_mtbx_img1.'" class="post__imgPost img-responsive" alt="Foto de mascota" /> 
                        </div>';
               }else{
                  echo '<div class="post__imgContainer post__imgPost post__imgPost--noFound ">
                           Imagen no disponible
                        </div>';
               }

               echo '<div class="post__info no-margin">'; ?>
                        <div class="col-md-8 col-xs-7 padding-medium"> 
                           <h4 class="no-margin"><?php the_title();?></h4>
                           <span><?php if(!empty($data[ 'raza' ])) {echo $data[ 'raza' ];} ?></span>
                        </div>
                        <?php 
                           if (in_category('adopcion')){
                              echo '<div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--adopcion">Mascota en adopción</div>';
                           }else{
                              if (in_category('perdidos')){
                                 echo '<div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--perdidos">Mascota perdida</div>';
                              }else{
                                 if (in_category('encontrados')){
                                    echo '<div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--encontrados"> Mascota encontrada</div>';
                                 }else{
                                    echo '<div class="col-md-4 col-xs-5 post__info__estatus post__info__estatus--otros"> Sin categoria </div>';
                                 }
                              }
                           }
                        ?>
            <?php echo '</div></a>';
         endwhile; 
      endif; 
      
      if(!$mostroAlgo)
      {
         echo '<div class="post__NoPost">
                  No hay publicaciones
               </div>';
      }
      
   ?>
</div>          