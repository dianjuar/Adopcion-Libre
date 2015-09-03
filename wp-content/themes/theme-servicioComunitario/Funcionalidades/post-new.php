<?php

// RadioButton category on post page para todos los usuarios y es seleccionado la categoria correspondiente dependiendo de dond provenga el usuario
    if( (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || 
        strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php'))) {
            ob_start('one_category_only');
    }

    function one_category_only($content) 
    {
        $content = str_replace('type="checkbox" ', 'type="radio" ', $content);

        if( isset( $_GET['post_category']) )
        {
            die("perra");
            $content = str_replace('type="radio"', ' type="radio disabled ', $content);


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

?>