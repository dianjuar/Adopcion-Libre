<?php

/*REMOVER EDICION RAPIDA*/
function remove_quick_edit( $actions ) {
	unset($actions['inline hide-if-no-js']);
	return $actions;
}

if ( !current_user_can( 'manage_options' ))
	add_filter('post_row_actions','remove_quick_edit',10,1);


/*REMOVER Papelera en archivados*/
function remove_trash( $actions, $post )
{
	if( $post->post_status == "archive" )
		unset($actions['trash']);
	
	return $actions;
}

if ( !current_user_can( 'manage_options' ))
	add_filter('post_row_actions','remove_trash',10,2);


/*Añadir opcion finalizar a los post en estado publicados publicados*/
function add_finalizar($actions, $post) {
 
    if( $post->post_status == "publish" && $post->post_author ==  wp_get_current_user()->ID)
    {
        $url = admin_url('post.php?post='.$post->ID.'&action=edit');
        $actions['finalizar'] = '<a title="Haga click para ir a editar y llenar el formulario que se encuentra al final" href="'.$url.'">Finalizar</a>';
    }
    
    return $actions;
}
add_filter('post_row_actions','add_finalizar',10,2);

?>