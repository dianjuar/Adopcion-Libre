<?php 
//session_start();
/*===== USER Archivar publicación - Post ON =========================================*/
if(isset($_POST["Guardar_Datos_DuenoActual"]))
{	
	$post_id = $_POST["post-id"];
  cambiarEstado_archivado($post_id);
	$data = get_post_meta( $post_id, 'post', true );

	$data['nombre-dueno'] = $_POST['nombre-Dueno'];
	$data['telefono-dueno'] = $_POST['telefono-Dueno'];

	update_post_meta( $post_id, 'post', $data);
}
/*===== USER Archivar publicación - Post OFF ========================================*/

//Cambia el estado de un post a archivado.
function cambiarEstado_archivado($postID)
{ 
    //Esto es cambiar le estado a archivado --open--
    $post = get_post( $postID );
    $post->post_status = "archive";
    wp_update_post( $post );
    //Esto es cambiar le estado a archivado --close--

    ?>
	<script type="text/javascript">
	window.onload = function() {
		swal(
	    '¡Que Bien!',
	    '¡Nos alegra mucho que esta mascota haya encontrado un hogar!',
	    'success'
		);
	};
	</script>
    <?php
}
?>

<!-- MODAL --> <!-- Cuando se quiera mostar este modal. Se debe incluir este php y  colocar en la página el script  
				$("NOMBRE_DEL_BOTON").click(function() { ("#myModal").css("display","block"); }); -->
    <div class="ventana" id="myModal" >
      <?php //if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div class="modal-dialog">
           <div class="modal-content">
            <form  method="post" action="">
              <div class="modal-header">
                <button id="btnClose" type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <h3>Finalizar publicación</h3>
              </div>
              <div class="modal-body">
                <p> 
                  Por favor ingresa los datos de la persona que quedara a cargo de la mascota 
                  <label id="nombre-mascota">"<?php echo $post->post_title; ?>"</label>
                </p>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre:</label>
                    <input type="text" class="form-control" name="nombre-Dueno" id="nombre-Dueno" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input type="text" class="form-control" name="telefono-Dueno" id="telefono-Dueno" placeholder="telefono" required>
                  </div>
                   <input type="hidden" id="post-id" name="post-id" value="<?php echo $post->ID; ?>">
              </div>
              <div class="modal-footer">
                <button name="Guardar_Datos_DuenoActual" type="submit" class="btn">Guardar</button>
                <button id="Mclose" type="button" class="btn">Cancelar</button>
              </div>
            </form>
            </div>
        </div>
        <?php //endwhile; // end of the loop. ?>
      </div>
      <!-- MODAL -->

<script>
    /* //Con esto funciona en single.php pero no en listarPosts.php
      window.onload = function(){
    	alert("Cargó la pag on finalizar post.php");

      $("#Mclose").click(function() {
          $("#myModal").css("display","none");
          alert("Mclose on finalizar post.php");
      });

      $("#btnClose").click(function() {
          $("#myModal").css("display","none");
          alert("btnClose on finalizar post.php");
      });

    };*/

    //SOLUCIONE CON UN SCRIPT EN CADA .PHP

    /*//Con esto funciona en listarPosts.php pero no en single.php
      jQuery(document).ready(function(){

      alert("Cargó la pag");

          jQuery('#Mclose').on('click',function()
          {
            $("#myModal").css("display","none");
            alert("Mclose");
          });

          jQuery('#btnClose').on('click',function()
          {
            $("#myModal").css("display","none"); 
            alert("btnClose");
          });

    });*/
</script>