<?php

/*Añadir opcion finalizar a los post en estado publicados publicados*/
/*function add_cambiarRolUsuario($actions) {
 
	unset($actions['edit']);

    return $actions;
}

add_filter('user_row_actions','add_cambiarRolUsuario',10,1); */


// removes the `profile.php` admin color scheme options

function remove_unnecesaryThings_at_userEdit()
{	
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

		if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'user-edit.php' ) !== false )
		{
			//aqui se modificarán los campos que no deben ser editados por otros usuarios con esta capasidad. 
		}
}

remove_unnecesaryThings_at_userEdit();

?>