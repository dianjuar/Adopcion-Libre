<?php

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
		$idRol = key($roles);
		
		foreach ($roles as $rol) 
		{		
			$rolName = $rol['name'];			
			$href = admin_url("users.php?updateUserRol=yes&userID=".$user->ID."&rolID=".$idRol);
    		$actions['cambiarRol_'.$rolName] = '<span class="actionsROL_'.$rolName.'"> 
    												<a href='.$href.'>'.$rolName.'</a>	    											
    						  	 			  	</span>';

    		$idRol = key($roles);
    		next($roles);
		}
	}

    return $actions;
}
add_filter('user_row_actions','modify_UserActions',10,2);
//////////////////////////////////////////////////////
add_action('load-users.php', function()
{
	if ( !current_user_can( 'manage_options' ))
	{
		if($_GET['updateUserRol']=='yes')
		{
			$userID = $_GET['userID']; 
			$rolID = $_GET['rolID']; 

			$user = get_user_by( 'id', $userID );

			if(al_rolUser_CanEdit($user->roles))
			{
				//remove role
				foreach ($user->roles as $rol) 
					$user->remove_role( $rol );
				
				//Add role
				$user->add_role( $rolID );	
				//mensaje al usuario

				?>
				<script type="text/javascript">
				window.onload = function() {
					swal({
				    title: '¡Rol Cambiado con Exito!',
				    type:  'success'
					});
				};
				</script>
			    <?php
			}else
			{
				?>
				<script type="text/javascript">
				window.onload = function() {
					swal({
				    title: 'Haciendo Trampa, ¿Eh?',
				    type:  'warning'
					});
				};
				</script>
			    <?php

			}
		}
	}
});
////////////////////////////////////////////////////////////
//los usuarios que pueden modificar otros roles no tienen acceso a editar el perfil.
add_action( 'admin_footer', function()
{
	global $pagenow;

	if($pagenow == 'users.php')
	{
	?>
		<script>
	        jQuery(document).ready(function(){
	        	jQuery('.username').children('strong').children('a').removeAttr('href');
	    	});		
		</script>
	<?php
	}
} );



?>