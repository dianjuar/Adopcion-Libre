<?php 

//si envían por URL la opción archivados se cambiará el estado a archivado
function cambiarEstado_archivado($postID)
{   
    $post = get_post( $postID );
    $post->post_status = "archive";

    wp_update_post( $post );
}

if ($_GET['archived'] == 'yes') {
    cambiarEstado_archivado($_GET['postID']);
}

?>