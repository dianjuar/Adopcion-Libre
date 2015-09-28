<?php 
/*
Plugin Name: Imágenes en campos personalizados
Plugin URI: http://www.emenia.es/plugin-subir-imagenes-campo-personalizado-wordpress
Description: Para añadir imágenes en Entradas, Páginas o Entradas personalizadas
Version: 1.0
Author: Emenia
Author URI: http:www.emenia.es
License: GPLv2
*/
 
//hook para crear el meta box
add_action( 'add_meta_boxes', 'em_mtbx_img_crear' );
 
function em_mtbx_img_crear() {
 
	// Creamos el meta box personalizado
	add_meta_box( 
                'em-img-meta', // atributo ID
                'Fotos de la mascota:', // Título
                'em_mtbx_img_function', // Función que muestra el HTML que aparecerá en la pantalla
                'post', // Tipo de entrada. Puede ser 'post', 'page', 'link', o 'custom_post_type'
                'normal', // Parte de la pantalla donde aparecerá. Puede ser 'normal', 'advanced', o 'side'
                'high' // Prioridad u orden en el que aparecerá. Puede ser 'high', 'core', 'default' o 'low'
                );
	
}

function em_mtbx_img_function( $post ) { ?>
        <strong>Nota:</strong><span>Debe cargar minimo dos (2) fotos de la mascota</span><br><br>

        <?php
        $em_mtbx_img1 = get_post_meta( $post->ID, '_em_mtbx_img1', true );
        ?>
        <strong>Foto 1:</strong><br>
        <input required id="em_mtbx_img1" class="em_mtbx_img" type="text" size="40" name="em_mtbx_img1" value="<?php echo esc_url( $em_mtbx_img1 ); ?>" />
          <input id="img_boton1" type="button" value="Seleccionar imagen" class="img_boton button-secondary"  />
          <br /><br />
          <?php if($em_mtbx_img1 && $em_mtbx_img1 != '') echo '<img src="' . esc_url( $em_mtbx_img1 ) .'" width="150" height="150" alt="" />'; ?>  
          <div class="clear"></div>
          <br />
          
        <?php //si ya existe esa imagen obtemos su valor
        $em_mtbx_img2 = get_post_meta( $post->ID, '_em_mtbx_img2', true );
        ?>
        <strong>Foto 2:</strong><br>
        <input required id="em_mtbx_img2" class="em_mtbx_img" type="text" size="40" name="em_mtbx_img2" value="<?php echo esc_url( $em_mtbx_img2 ); ?>" />
          <input id="img_boton2" type="button" value="Seleccionar imagen" class="img_boton button-secondary"  />
          <br /><br />
          <?php if($em_mtbx_img2 && $em_mtbx_img2 != '') echo '<img src="' . esc_url( $em_mtbx_img2 ) .'" width="150" height="150" alt="" />'; ?>
          <div class="clear"></div>
          <br />
          
        <?php //si ya existe esa imagen obtemos su valor
        $em_mtbx_img3 = get_post_meta( $post->ID, '_em_mtbx_img3', true );
        ?>
        <strong>Foto 3:</strong><br>
        <input id="em_mtbx_img3" class="em_mtbx_img" type="text" size="40" name="em_mtbx_img3" value="<?php echo esc_url( $em_mtbx_img3 ); ?>" />
          <input id="img_boton3" type="button" value="Seleccionar imagen" class="img_boton button-secondary"  />
          <br /><br />
          <?php if($em_mtbx_img3 && $em_mtbx_img3 != '') echo '<img src="' . esc_url( $em_mtbx_img3 ) .'" width="150" height="150" alt="" />'; ?>
          <div class="clear"></div>
          <br />

        <?php //si ya existe esa imagen obtemos su valor
        $em_mtbx_img4 = get_post_meta( $post->ID, '_em_mtbx_img4', true );
        ?>
        <strong>Foto 4:</strong><br>
        <input id="em_mtbx_img4" class="em_mtbx_img" type="text" size="40" name="em_mtbx_img4" value="<?php echo esc_url( $em_mtbx_img4 ); ?>" />
          <input id="img_boton4" type="button" value="Seleccionar imagen" class="img_boton button-secondary"  />
          <br /><br />
          <?php if($em_mtbx_img4 && $em_mtbx_img4 != '') echo '<img src="' . esc_url( $em_mtbx_img4 ) .'" width="150" height="150" alt="" />'; ?>
          <div class="clear"></div>
          <br />     

        <?php //si ya existe esa imagen obtemos su valor
        $em_mtbx_img5 = get_post_meta( $post->ID, '_em_mtbx_img5', true );
        ?>
        <strong>Foto 5:</strong><br>
        <input id="em_mtbx_img5" class="em_mtbx_img" type="text" size="40" name="em_mtbx_img5" value="<?php echo esc_url( $em_mtbx_img5 ); ?>" />
          <input id="img_boton5" type="button" value="Seleccionar imagen" class="img_boton button-secondary"  />
          <br /><br />
          <?php if($em_mtbx_img5 && $em_mtbx_img5 != '') echo '<img src="' . esc_url( $em_mtbx_img5 ) .'" width="150" height="150" alt="" />'; ?>
          <div class="clear"></div>
          <br />
          <?php 
}

//para cargar el archivo imagenes-meta-box.js sólo al crear y editar una entrada
add_action('admin_print_scripts-post.php', 'em_mtbx_img_admin_scripts');
add_action('admin_print_scripts-post-new.php', 'em_mtbx_img_admin_scripts');
 
function em_mtbx_img_admin_scripts() {
        wp_enqueue_script( 'em-image-upload', plugins_url( '/imagenes-meta-box/imagenes-meta-box.js' ), array( 'jquery','media-upload','thickbox' ) );
}
 
//usando thickbox para subir la imagen al crear o editar una entrada
add_action('admin_print_styles-post.php', 'em_mtbx_img_admin_styles');
add_action('admin_print_styles-post-new.php', 'em_mtbx_img_admin_styles');
 
function em_mtbx_img_admin_styles() {
        wp_enqueue_style( 'thickbox' );
}

//Para grabar los campos. Añadir uno nuevo por cada campo existente, en este caso tres.
add_action( 'save_post', 'em_mtbx_img_save_meta' );
 
function em_mtbx_img_save_meta( $post_id ) {
 
        if ( isset( $_POST['em_mtbx_img1'] ) ) {
        
                update_post_meta( $post_id, '_em_mtbx_img1', esc_url_raw( $_POST['em_mtbx_img1'] ) );
 
        }
 
        if ( isset( $_POST['em_mtbx_img2'] ) ) {
        
                update_post_meta( $post_id, '_em_mtbx_img2', esc_url_raw( $_POST['em_mtbx_img2'] ) );
 
        }   
 
        if ( isset( $_POST['em_mtbx_img3'] ) ) {
        
                update_post_meta( $post_id, '_em_mtbx_img3', esc_url_raw( $_POST['em_mtbx_img3'] ) );
 
        }  

        if ( isset( $_POST['em_mtbx_img4'] ) ) {
        
                update_post_meta( $post_id, '_em_mtbx_img4', esc_url_raw( $_POST['em_mtbx_img4'] ) );
 
        }     
        if ( isset( $_POST['em_mtbx_img5'] ) ) {
        
                update_post_meta( $post_id, '_em_mtbx_img5', esc_url_raw( $_POST['em_mtbx_img5'] ) );
 
        }
}


?>