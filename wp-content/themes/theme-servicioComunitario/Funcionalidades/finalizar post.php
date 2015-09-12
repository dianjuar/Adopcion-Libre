<?php 

//si envían por URL la opción archivados se cambiará el estado a archivado
function cambiarEstado_archivado()
{   
	if ($_GET['archived'] == 'yes') 
	{
	    $post = get_post( $_GET['postID'] );
	    $post->post_status = "archive";

	    wp_update_post( $post );
	}
}

add_action( 'load-edit.php', 'cambiarEstado_archivado' );



?>