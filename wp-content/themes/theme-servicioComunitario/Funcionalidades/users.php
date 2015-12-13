<?php
	//ADD AUTHOR COLUMN TO THE LIST OF POSTS
	function add_roles_column( $columns ) {
	    unset($columns['ure_roles']); //Eliminar columna "Otros roles"

		    //Ordenar columnas 
		    $aux = $columns["role"];
		    unset($columns['role']);	   
			$columns["role"] = $aux;$columns["posts"] = "Mascotas";

	    $columns["roles"] = "Cambiar rol a"; //Agregar columna "Cambiar rol a"

		//var_dump($columns);die();

	    return $columns;
	}
	add_filter('manage_users_columns', 'add_roles_column'); //add the author to the columns names array

	//MODIFY CONTENT IN AUTHOR COLUMN (SET DISPLAY NAME)
	function set_roles_column( $value, $column_name, $user_id) {

		$user = get_userdata( $user_id );
		
	    switch ( $column_name ) {
	      case 'roles':

	      	$roles = get_sorted_roles();

	      	//quita todos los roles que ya es actualmente ese usuario. Así un usuario que ya es moderador no puede se puede cambiar a moderador
			foreach ($user->roles as $rolesUsuario) 		
				unset( $roles[ $rolesUsuario ] );

			//coloca los roles a los cuales puede ser cambiado

			/*obtengo el ultimo rol del vector de roles pero establece el puntero interno del 
			vector en la última posición*/
			end($roles);
			$ultimoRol = key( $roles );

			//establece el puntero interno del vector a la primera posición.
			reset($roles);
			$idRol = key($roles);
			
			$value = "<div class='row-actions' style='visibility: visible;' >";

			foreach ($roles as $rol) 
			{		
				foreach ($user->roles as $rolesUsuario)
					if( isLowerRole($rolesUsuario, $idRol) )
						$class = "rolehigher";
					else
						$class = "rolelower";


				$rolName = $rol['name'];			
				$href = admin_url("users.php?updateUserRol=yes&userID=".$user->ID."&rolID=".$idRol);
	    		
	    		$value = $value.'<span class="'.$class.'"> 									
									<a href='.$href.'> <span class="glyphicon glyphicon-user"></span>'.$rolName.' </a>';
				
				if( $ultimoRol != $idRol )
					$value = $value.'|';

			  	 			  	$value = $value.'</span>';

	    		$idRol = key($roles);
	    		next($roles);
			}
			$value = $value.'</div>';


	        break;

	    }

	    return $value;
	}
	add_action( 'manage_users_custom_column' , 'set_roles_column', 10, 3 );
 
//////////////////////////////////////////////////////
/*Quitar opcion "editar" al momento de visualizar todos los usuarios*/
add_filter('user_row_actions', function ($actions) 
{
	if ( !al_isProgrammerLogged() )	
	    unset($actions['edit']); 

    return $actions;
});
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