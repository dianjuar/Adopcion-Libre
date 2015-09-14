<?php

	// Remueve los tabs que no son necesarios.
	function modificarTabs_comments($views) 
	{
	  unset($views['moderated']);
	  unset($views['approved']);

	  $views['Enviados']="<a href='edit-comments.php?comment_status=enviados' >Enviados</a>";
	  $views['Recibidos']="<a href='edit-comments.php?comment_status=recibidos' >Recibidos</a>";

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
	 * los mensajes pedendiendo del valor recibido.
	 */

	add_filter('the_comments', 'wpse56652_filter_comments');

	function wpse56652_filter_comments($comments){
		/*
		Terminantemente PROHIBIDO mover estas 2 variables dentro del IF
		por alguna extraña razón deja de funcionar todo
		*/
	    global $pagenow;
	    global $user_ID;

	    if($pagenow == 'edit-comments.php' && 
	       ( ( $_GET['comment_status']=='enviados' || $_GET['comment_status']=='recibidos' || $_GET['comment_status']=='mios'  ) ||
	      (!al_isProgrammerLogged() && !al_isSuperAdministradorLogged() ) ) )
	    {

	        foreach($comments as $i => $comment)
	        {
	            $the_post = get_post($comment->comment_post_ID);
	            if($comment->user_id != $user_ID && $the_post->post_author != $user_ID)
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

		    			default:
		    				# Nothing
		    				break;
		    		}
		    	
	        }
	    }

	    return $comments;
	}
	
	//---------------------------------------------------------------------
	//add_filter('admin_comment_types_dropdown','__return_zero');
	//---------------------------------------------------------------------

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