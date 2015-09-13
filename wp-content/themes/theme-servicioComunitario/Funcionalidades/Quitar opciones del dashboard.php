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
        global $pagenow;

        remove_menu_page('tools.php');
        remove_menu_page('upload.php');

        if ( $pagenow  == 'tools.php'||
            ( !al_isProgrammerLogged()  &&  $pagenow == 'user-edit.php' ) //solo el adminsitrador(programador) puede acceder a esta página 
        	 //strpos( $_SERVER[ 'REQUEST_URI' ], 'edit-comments.php' ) !== false ||
        	 //strpos( $_SERVER[ 'REQUEST_URI' ], 'upload.php' ) !== false
        	)
        {
        	wp_die( __( 'No tienes suficientes permisos para entrar a esta página.' ) );
        }
    }

    add_action( 'admin_menu', 'my_remove_menu_pages' );

    //Manage Your Media Only
    function mymo_parse_query_useronly( $wp_query ) 
    {
        global $pagenow;

        if ( $pagenow == 'upload.php' ) {
            if ( current_user_can('al_suscriptor') || current_user_can('al_moderador') ) {
                global $current_user;
                $wp_query->set( 'author', $current_user->id );
            }
        }
    }

    add_filter('parse_query', 'mymo_parse_query_useronly' );

    //*************************************************************************************
    // This filter is aplied to remove the media library tab.
    function remove_media_library_tab($tabs) {
        unset($tabs['library']);
        return $tabs;
    }
    add_filter('media_upload_tabs', 'remove_media_library_tab');
?>