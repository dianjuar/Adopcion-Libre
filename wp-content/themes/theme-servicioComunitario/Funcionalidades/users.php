<?php
// removes the `profile.php` admin color scheme options
/*function remove_unnecesaryThings_at_userEdit()
{	
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

		if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'user-edit.php' ) !== false )
		{
			//aqui se modificarán los campos que no deben ser editados por otros usuarios con esta capasidad. 

		}
}

remove_unnecesaryThings_at_userEdit();*/


/*Quitar opcion editar usuario al momento de visualizar todos los usuarios al momento de cambiarles el perfil*/
function modify_UserActions($actions, $user) 
{
	if ( !current_user_can( 'manage_options' ))
	{
	    unset($actions['edit']); 

	    $actions['cambiarRol_Mensaje'] = '<span class="actionsMensaje"> 
	    							<a>Cambiar rol a:</a>	    							
	    						  </span>';

	    $roles = get_editable_roles();

		//quita todos los roles que ya es actualmente ese usuario. Así un usuario que ya es moderador no puede se puede cambiar a moderador
		foreach ($user->roles as $rolesUsuario) 		
			unset( $roles[ $rolesUsuario ] );

		//coloca los roles a los cuales puede ser cambiado
		foreach ($roles as $rol) 
		{						
			$rolName = $rol['name'];			
			$href = admin_url("users.php?updateUserRol=yes&userID=".$user->ID."&rolID=".key($roles));
    		$actions['cambiarRol_'.$rolName] = '<span class="actionsROL_'.$rolName.'"> 
    												<a href='.$href.'>'.$rolName.'</a>	    											
    						  	 			  	</span>';

    		next($roles);
		}
	}

    return $actions;
}

add_action('load-users.php', function()
{
	//ob_start('remove_editProfile');

	if ( !current_user_can( 'manage_options' ))
	{
		if($_GET['updateUserRol']==yes)
		{
			$userID = $_GET['userID'];
			$rolID = $_GET['rolID'];

			$user = get_user_by( 'id', $userID );


			if(al_rolUser_CanEdit($rolID))
			{
				//remove role
				$user->remove_role( $user->roles[0] );
				//Add role
				$user->add_role( $rolID );	
			}
		}
	}
});

/*function remove_editProfile($content)
{
	$content = preg_replace('Mascotas', 'Spunky', $content);
	//href=".user-edit\.php\?user_id=.\&amp;wp_http_referer=\%2FSC\%2Fwp-admin\%2Fusers\.php

	
	return $content;
}*/

add_filter('user_row_actions','modify_UserActions',10,2);


?>