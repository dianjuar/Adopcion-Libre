<?php 

//si envían por URL la opción archivados se cambiará el estado a archivado
function cambiarEstado_archivado($postID)
{   
    $post = get_post( $postID );
    $post->post_status = "archive";
    wp_update_post( $post );

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