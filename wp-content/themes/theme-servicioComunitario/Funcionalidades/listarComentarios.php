<?php

	// Remueve los tabs que no son necesarios.
	function modificarTabs_comments($views) 
	{
	  unset($views['moderated']);
	  unset($views['approved']);

	  $views['Enviados']="<a id='com_enviados' href='edit-comments.php?comment_status=enviados' >Enviados</a>";
	  $views['Recibidos']="<a id='com_recibidos' href='edit-comments.php?comment_status=recibidos' >Recibidos</a>";

	  if( al_isSuperAdministradorLogged() )
	  	$views['mios']="<a href='edit-comments.php?comment_status=mios' >Mios</a>";

	  return $views;
	}

	add_filter('views_edit-comments', 'modificarTabs_comments');
	//------------------------------------------------------------------------------
	/*REMOVER EDICION RAPIDA, EDITAR Y RECHAZAR*/
	function remove_actions_comments( $actions ) {

		unset($actions['unapprove']);
		unset($actions['approve']);

		if ( !al_isProgrammerLogged() )
		{			
			unset($actions['quickedit']);
			unset($actions['edit']);
		}

		return $actions;
	}

	add_filter('comment_row_actions','remove_actions_comments');
    add_filter('bulk_actions-edit-comments','remove_actions_comments');
	//------------------------------------------------------------------------------
	/**
	 * Show only the Comments MADE BY the current logged user
	 * and the Comments MADE TO his/hers posts.
	 * Runs only for the programador and superadmi role.
	 *
	 * Si la variable comment_status tiene el valor "enviados" o "recibidos" se filtrarán
	 * los mensajes dependiendo del valor recibido.
	 */

	add_filter('the_comments', 'filter_comments');

	function filter_comments($comments){
	    global $pagenow;
	    global $user_ID;

	    if($pagenow == 'edit-comments.php' && 
	       ( ( $_GET['comment_status']=='enviados' || $_GET['comment_status']=='recibidos' || $_GET['comment_status']=='mios'  ) ||
	      (!al_isProgrammerLogged() && !al_isSuperAdministradorLogged() ) ) )
	    {

	        foreach($comments as $i => $comment)
	        {
	            $the_post = get_post($comment->comment_post_ID);
	            /*Elimina los comentarios que no son propios ni los hechos en un post que soy propietario
	            	o los comentarios de los posts ya finalizados
	            */ 
	            if(($comment->user_id != $user_ID && $the_post->post_author != $user_ID)
	            	||$the_post->post_status == 'archive')
	                unset($comments[$i]);

	           if( isset( $_GET['comment_status'] ) )		    	
		    		switch ($_GET['comment_status'] ) 
					{
		    			case 'enviados':
		    				if($comment->user_id != $user_ID)
	                			unset($comments[$i]);
		    				break;

		    			case 'recibidos':
		    				if($the_post->post_author != $user_ID)
	                			unset($comments[$i]);
		    				break;

		    		}
		    	
	        }
	    }

	    return $comments;
	}
	
	//------------------------------------------------------------------------------
	/*REMOVER LINK "EDITAR" EN COMMENTARIOS EN EL SITIO*/

	//Ojo: Esto también elimina todas las opciones de row_comments_action :/ por eso está comentado el filtro
	
	function restrict_comment_editing( $caps, $cap, $user_id, $args ) {
	
		global $pagenow;

		if($pagenow == "index.php" )
		{
			if ( 'edit_comment' == $cap ) 
			{
				$comment = get_comment( $args[0] );
				$caps[] = 'moderate_comments';
			}
		}

		
	  
		return $caps;
	}

	add_filter( 'map_meta_cap', 'restrict_comment_editing', 10, 4 );

	//---------------------------------------------------------------------


?>