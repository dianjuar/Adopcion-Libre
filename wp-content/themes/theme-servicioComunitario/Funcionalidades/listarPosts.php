<?php 
//*************************************************************************************
	// This filter is aplied to remove the media library tab.
  	function remove_media_library_tab($tabs) {
    	unset($tabs['library']);
    	return $tabs;
	}
	add_filter('media_upload_tabs', 'remove_media_library_tab');
//*************************************************************************************
	// Remueve el tab Todos en la lista de posts y pone pordefecto el tab publish
	function eliminar_tab_todos($views) 
	{
	  unset($views['all']);
	  return $views;
	}
	add_filter('views_edit-post', 'eliminar_tab_todos');

	add_action( 'load-edit.php', function() 
	{

	if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'post_type' ) === false )
	{
	    wp_redirect( admin_url('edit.php?post_status=publish&post_type=post') ); exit;
	}   

	});

//*************************************************************************************
//*************************************************************************************
	// Remueve los posts en estado "borrador" que no son del usuario actual
	function only_own_posts_parse_query_draft( $wp_query ) 
	{
	    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php?post_status=draft' ) !== false ) 
	    {
		  global $current_user;
		  $wp_query->set( 'author', $current_user->id );
	    }
	}

	add_filter('parse_query', 'only_own_posts_parse_query_draft' );


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
	

	//añade el tab 'mio' en edit.php al moderador, administrador y suscriptor
	function add_tab_mine( $views ) {
		global $current_user;
	    $views['mine'] = '<a href="'.admin_url().'edit.php?post_type=post&author='.$current_user->id.'">Mío <span class="count"></span> </a>';

	    return $views;
	}

	if( !current_user_can('al_suscriptor') )
		add_action( 'views_edit-post', 'add_tab_mine' );

//*************************************************************************************

?>
