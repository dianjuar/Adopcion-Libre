<?php

// RadioButton category on post page para todos los usuarios y es seleccionado la categoria correspondiente dependiendo de dond provenga el usuario
    
    add_action( 'load-post-new.php', 'Checbox2RadioButton');
    add_action( 'load-post.php', 'Checbox2RadioButton');

    function Checbox2RadioButton()
    {        
        ob_start('one_category_only');
    }
    function one_category_only($content) 
    {
        $content = str_replace('type="checkbox" ', ' type="radio" ', $content);

        if( isset( $_GET['post_category']) )
        {
            $content = str_replace('type="radio"', ' type="radio" disabled ', $content);


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
        }
        
        return $content;
    }
/////////////////////////////////////////////////////////////////////////////////
    add_action( 'load-post-new.php', 'remover_enviarALaPapelera');

    function remover_enviarALaPapelera()
    {
        ob_start('remove_trahsLink');   
    }

    function remove_trahsLink($content)
    {
        $content = str_replace('"delete-action"', 
                               '"delete-action" style="display:none" ', $content);
        return $content;
    }


    add_filter('redirect_post_location', function($location)
    {
        global $post;

        if(  $_POST["post_status"] == "pending" ) // cuando envia a revisión
        {
            $location = admin_url("edit.php?post_status=pending&post_type=post&mensaje=pendiente");
        }
        else if( $_POST["post_status"] == "publish" && !isset($_POST['save']) )  //publica o aprueba
        {
            if( $post->post_author != wp_get_current_user()->ID ) //aprobar publicación, redirige al tab pendiente     
                $location = admin_url("edit.php?post_status=pending&post_type=post&mensaje=aprobado");
            else //publicó un post
            {
                if( al_isModeradorLogged() )     //se redirige al tab publicadas       
                    $location = admin_url("edit.php?post_status=publish&post_type=post&mensaje=publicado");
                else //es el administrador o superadministrador se redirige a tab mío.
                    $location = admin_url("edit.php?post_type=post&author=".wp_get_current_user()->ID ."&post_type=post&mensaje=publicado");
            }
        }
        else if( $_POST["post_status"] == "publish" && isset($_POST['save']) ) //edita (actualiza)
        {
            if( $post->post_author != wp_get_current_user()->ID ) // publicacion que no es mia, solo administrador y superadministrador
                $location = admin_url("edit.php?post_status=publish&post_type=post&mensaje=editado");
            else //solo post publicados propios
            {
                if( al_isSuscriptorLogged() || al_isModeradorLogged() )
                    $location = admin_url("edit.php?post_status=publish&post_type=post&mensaje=editado");
                else //administrador y superadministrador
                    $location = admin_url("edit.php?post_type=post&author=".wp_get_current_user()->ID ."&post_type=post&mensaje=editado");
            }
        }

        return $location."&postID=".$post->ID;
    });
?>