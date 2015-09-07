<?php
/*
Plugin Name: Remove Settings and Posts Menu
Description: Just don't want my settings menu anymore and I don't want to write any posts - what's the big deal?
Version: 0.1
License: GPL
Author: Sarah Gooding
Author URI: http://untame.net
*/


    function my_remove_menu_pages() 
    {
        remove_menu_page('tools.php');
        //remove_menu_page('edit-comments.php');
        remove_menu_page('upload.php');


        if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'tools.php' ) !== false ||
             ( current_user_can('manage_options')==false && strpos( $_SERVER[ 'REQUEST_URI' ], 'user-edit.php' ) !== false ) //solo el adminsitrador(programador) puede acceder a esta página 
        	 //strpos( $_SERVER[ 'REQUEST_URI' ], 'edit-comments.php' ) !== false ||
        	 //strpos( $_SERVER[ 'REQUEST_URI' ], 'upload.php' ) !== false
        	)
        {
        	wp_die( __( 'No tienes suficientes permisos para entrar a esta página.' ) );
        }
    }

    add_action( 'admin_menu', 'my_remove_menu_pages' );

    //Manage Your Media Only
    function mymo_parse_query_useronly( $wp_query ) {
        if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false ) {
            if ( current_user_can('al_suscriptor') || current_user_can('al_moderador') ) {
                global $current_user;
                $wp_query->set( 'author', $current_user->id );
            }
        }
    }

    add_filter('parse_query', 'mymo_parse_query_useronly' );
?>