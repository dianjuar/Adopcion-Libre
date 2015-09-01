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


        if ( strpos( $_SERVER[ 'REQUEST_URI' ], 'tools.php' ) !== false //||
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
                die('sdad');
                global $current_user;
                $wp_query->set( 'author', $current_user->id );
            }
        }
    }

    add_filter('parse_query', 'mymo_parse_query_useronly' );



    // RadioButton category on post page para todos los usuarios y es seleccionado la categoria correspondiente dependiendo de dond provenga el usuario
     if( (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || 
        strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php'))) {
            ob_start('one_category_only');
     }

     function one_category_only($content) 
     {
        $content = str_replace('type="checkbox" ', 'type="radio" disabled ', $content);


        switch ( $_GET['post_category'] ) {
            case 'adopcion':
                //<input value="2" name="post_category[]" id="in-category-2" type="radio">
                $content = str_replace('<input value="2" ', 
                                       '<input value="2" checked ', 
                                       $content);
                break;

            case 'encontrado':
                $content = str_replace('<input value="3" ', 
                                       '<input value="3" checked ', 
                                       $content);
                break;

            case 'perdido':
                $content = str_replace('<input value="4" ', 
                                       '<input value="4" checked ', 
                                       $content);
                break;

            default:
                # nothing
                break;
        }

        return $content;
     }


     //Asignar Rol "Suscriptor." a los nuevos usuarios.
    add_filter('pre_option_default_role', function(){
        // You can also add conditional tags here and return whatever
        return 'al_suscriptor'; // This is changed
    });


?>