
          <?php if (have_posts()): while ( have_posts() ) : the_post(); ?>
            <?php $data = get_post_meta( $post->ID, 'post', true );  ?>
              <div class="col-md-4 col-sm-6 no-padding">
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
                      <div class="col-md-8 col-xs-7 padding-medium"> 
                        <h4 class="no-margin"><?php the_title(); ?></h4>
                        <span><?php if(!empty($data[ 'raza' ])) {echo $data[ 'raza' ];} ?></span>
                      </div>
                      <div class="col-md-4 col-xs-5 post__info__estatus <?php 
                            if(in_category('adopcion')) {echo 'post__info__estatus--adopcion';} else { 
                            if(in_category('perdidos')) {echo 'post__info__estatus--perdidos';} else {
                            if(in_category('encontrados')) {echo 'post__info__estatus--encontrados';} } } ?>"> 
                        <?php the_category(); ?>
                      </div>
                    </div>
                  </a>
                </div>      
          <?php endwhile; else: ?>
            <div class="post__NoPost">
              No hay publicaciones
            </div>
          <?php endif; ?>
          