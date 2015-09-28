<?php 
//*************************************************************************************
	// This filter is aplied to remove the media library tab.
  	function remove_media_library_tab($tabs) {
    	unset($tabs['library']);
    	return $tabs;
	}
	add_filter('media_upload_tabs', 'remove_media_library_tab');
//*************************************************************************************
	// Remueve el tab Todos y Borradores en la lista de posts y pone pordefecto el tab publish
	function eliminar_tab_todos($views) 
	{
	  unset($views['all']);
	  unset($views['draft']);
	  return $views;
	}
	add_filter('views_edit-post', 'eliminar_tab_todos');

	////////////////////////////////////////////////////
	
	add_action( 'admin_footer', function() {

		global $pagenow;

		if($pagenow == "edit.php")
		{			
			?>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url') ?>/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
			<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>
			<script src="<?php bloginfo('template_url') ?>/js/vendor/bootstrap.min.js"></script>

			<script>
				jQuery(document).ready(function($){
					$('.btn-finalizar').on('click',function()
					{						
						/*En el area administrativa, para finalizar post, no es posible obtener facilmente 
						el PostId y el postName (Necesarios para finalizar el post) entonces a través de js 
						se obtien gracias a que wordpress guarda estos datos en cada row de la tabla donde se
						muestran los post publicados de cada usuario.*/
						var postId = $(this).closest('tr').attr('id').split("-");
						$("#post-id").val(postId[1]);

						var postName = $(this).closest('div').prev().children(".post_title").text();
						$("#nombre-mascota").text('"'+postName+'"');

						//alert($("#post-id").val()+" and "+$("#nombre-mascota").text());
					});
				});
			</script> 
			<?php


		}
	} );
	///////////////////////////////////////////////////

	add_action( 'load-edit.php', function() 
	{
		global $pagenow;
		if($pagenow == "edit.php")
		{
			?>
			<!-- Estilos de boostrap en la seccion administrativa de wordpress -->
			<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.min.css"> 
  		    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap-theme.min.css">
			
			<?php
			
		}


		if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'post_type' ) === false )
		{
		    wp_redirect( admin_url('edit.php?post_status=publish&post_type=post') ); exit;
		}   

	});

//*************************************************************************************
//añade los archivos necesarios para que en la parte de administrativa se pueda usar el sweetalert :))))
add_action( 'admin_head', function(){
		?>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/js/sweetalert2-master/dist/sweetalert2.css"> 
		    <script src="<?php bloginfo('template_url') ?>/js/sweetalert2-master/dist/sweetalert2.min.js"></script>
		<?php

		//necesario para mostar el modal de finalizar post.
		global $pagenow;

		if($pagenow == "edit.php")	
			require_once ("finalizar post.php");
		
});
//*************************************************************************************

	// Remueve los posts en estado "papelera" que no son del usuario actual
	function only_own_posts_parse_query_trash( $wp_query ) 
	{
	    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php?post_status=trash' ) !== false ) 
	    {
		  global $current_user;
		  $wp_query->set( 'author', $current_user->id );
	    }
	}

	add_filter('parse_query', 'only_own_posts_parse_query_trash' );


	// Remueve los posts en estado "publicados" que no son del usuario actual
	function only_own_posts_parse_query_publish( $wp_query ) 
	{
	    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php?post_status=publish' ) !== false ) 
	    {
		  global $current_user;
		  $wp_query->set( 'author', $current_user->id );
	    }
	}

	if( !current_user_can('al_superadministrador') )
		add_filter('parse_query', 'only_own_posts_parse_query_publish' );


	// Remueve los posts en estado "pendiente" que no son del usuario actual
	function only_own_posts_parse_query_pending( $wp_query ) 
	{
	    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php?post_status=pending' ) !== false ) 
	    {
		  global $current_user;
		  $wp_query->set( 'author', $current_user->id );
	    }
	}

	if( current_user_can('al_suscriptor') )
		add_filter('parse_query', 'only_own_posts_parse_query_pending' );
	

	// Remueve los posts en estado "archive" que no son del usuario actual
	function only_own_posts_parse_query_archive( $wp_query ) 
	{
	    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php?post_status=archive' ) !== false ) 
	    {
		  global $current_user;
		  $wp_query->set( 'author', $current_user->id );
	    }
	}

	if( current_user_can('al_suscriptor') || current_user_can('al_moderador') )
		add_filter('parse_query', 'only_own_posts_parse_query_archive' );

	//añade el tab 'mio' en edit.php al moderador, administrador y suscriptor
	function add_tab_mine( $views ) {
		global $current_user;
	    $views['mine'] = '<a href="'.admin_url().'edit.php?post_type=post&author='.$current_user->id.'">Mío <span class="count"></span> </a>';

	    return $views;
	}

	if( !current_user_can('al_suscriptor') )
		add_action( 'views_edit-post', 'add_tab_mine' );

//*************************************************************************************
//*************************************************************************************

//ADD AUTHOR COLUMN TO THE LIST OF POSTS

function add_author_column( $columns ) {
	
    $columns["autor"] = "Autor"; //if I set the the "author" instead "autor" I cann't modify its content
    unset($columns["description"]); //it works
    return $columns;
}
add_filter('manage_edit-post_columns', 'add_author_column'); //add the author to the columns names array
add_filter('manage_edit-post_sortable_columns', 'add_author_column'); //add the author to the columns names sortable array


//MODIFY CONTENT IN AUTHOR COLUMN (SET DISPLAY NAME)
function set_display_name_autor_column( $column) {

	global $post;

	$user = get_user_by( 'id', $post->post_author );
	
    switch ( $column ) {
      case 'autor':
        echo $user->display_name;
        break;

    }
}
add_action( 'manage_posts_custom_column' , 'set_display_name_autor_column' );

//*************************************************************************************
//*************************************************************************************

?>
