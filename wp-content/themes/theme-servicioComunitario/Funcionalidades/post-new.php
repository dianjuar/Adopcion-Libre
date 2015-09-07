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

?>