<?php 

/*MODIFICAR DROPDOWN DE ROLES EN LA PAGINA PRINCIPAL users.php Y EN user-edit.php*/

add_filter( 'remove_default_wp_roles' , 'func_remove_default_wp_roles' );
add_filter( 'editable_roles' , 'func_remove_higher_roles_SC' );

function func_remove_higher_roles_SC($allRoles){

	$allRoles = apply_filters('remove_default_wp_roles', $allRoles);

	$user = new WP_User( get_current_user_id() );


	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	    foreach ( $user->roles as $role ){
	    	if ( $role ==  'al_administrador') {
	    		if(isset($allRoles['al_administrador']))
					unset($allRoles['al_administrador']);

				if(isset($allRoles['al_superadministrador']))
					unset($allRoles['al_superadministrador']);
			}
	    }
	}
	//var_dump($allRoles);

	return $allRoles;
}

function func_remove_default_wp_roles($allRoles){

	//array ( [administrator] => Administrator [editor] => Editor [author] => Author [contributor] =>
	//Contributor [subscriber] => Subscriber [basic_contributor] => Basic Contributor  ) 
	if( isset( $allRoles['editor'] ) )	
		unset($allRoles['editor']);

	if( isset( $allRoles['author'] ) )	
		unset($allRoles['author']);

	if( isset( $allRoles['contributor'] ) )	
		unset($allRoles['contributor']);

	if( isset( $allRoles['subscriber'] ) )	
		unset($allRoles['subscriber']);

	if( isset( $allRoles['rpr_unverified'] ) )	
		unset($allRoles['rpr_unverified']);


	return $allRoles;
}


/*REMOVER VIEWS */

/* - Set user filter links according to users pages
 * - Set Role Change dropdown menu
 * */
function custom_user_filter_links( $views ) {
  

  if( current_user_can('al_administrador') ){


    /* For role: Administrador */

    $amt       = count_users();
  	$amtCustom = $amt['avail_roles']['al_suscriptor'] + $amt['avail_roles']['al_moderador'] ; // Count custom users

    /* Modify users count for the 'All' link*/
    $views['all'] = preg_replace( '/(.*\().*(\).*)/', '${1}'.($amt['total_users'] - $amtCustom).'$2', $views['all'] );


    /* Remove 'Subscriber' & 'Pending' user links  */
    unset($views['al_administrador']);
    unset($views['al_superadministrador']);

  }

  return $views;
}
add_filter( 'views_users', 'custom_user_filter_links' );


/*MODIFICAR ALL VIEW*/
add_action('pre_user_query','list_moderador_suscriptor');

function list_moderador_suscriptor($user_search) {

	global $pagenow;
    if( 'users.php' != $pagenow)
        return;

    $user = wp_get_current_user();

    if ( al_isAdministradorLogged() ) 
    { 
        global $wpdb;

        $user_search->query_where = 
        str_replace('WHERE 1=1', 
            "WHERE 1=1 AND {$wpdb->users}.ID IN (
                 SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta 
                    WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities' 
                    AND ({$wpdb->usermeta}.meta_value LIKE '%al_moderador%'
                    	OR {$wpdb->usermeta}.meta_value LIKE '%al_suscriptor%')
                 )", 
            $user_search->query_where
        );
    }
}
?>
