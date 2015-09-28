<?php 
//session_start();
/*===== USER Archivar publicación - Post ON =========================================*/
if(isset($_POST["Guardar_Datos_DuenoActual"]))
{   
    
  cambiarEstado_archivado();
    
}
/*===== USER Archivar publicación - Post OFF ========================================*/

//Cambia el estado de un post a archivado.
function cambiarEstado_archivado()
{ 
    ?>
    <script type="text/javascript">
    window.onload = function() {
        alert('vite');
    };
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Prueba de modales</title>

  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/js/sweetalert2-master/dist/sweetalert2.css"> 

  
</head>
<body>


<!-- Button trigger modal -->

<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>
<p> Pizza </p>

    <script type="text/javascript">
    window.onload = function() {
        swal(
        '¡Que Bien!',
        '¡Nos alegra mucho que esta mascota haya encontrado un hogar!',
        'success'
        );
    };
    </script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url') ?>/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/sweetalert2-master/dist/sweetalert2.min.js"></script>


</body>
</html>