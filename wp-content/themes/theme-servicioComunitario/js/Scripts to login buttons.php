<script>
    $(document).ready(function(){
        //Agregar un link a los "botones" iniciar sesion, registrarse, cerrar session, y el panel de administracion
        $('.BoxLoginSingIm ul li:nth-child(2)').click(function() 
        {
            window.location.href = $('.BoxLoginSingIm ul li:nth-child(2) a').attr('href');
        });
        $('.BoxLoginSingIm ul li:nth-child(1)').click(function() 
        {
            window.location.href = $('.BoxLoginSingIm ul li:nth-child(1) a').attr('href');
        });

      <?php if ( is_user_logged_in() ) { 
        ?>
        $('.BoxLoginSingIm ul li:nth-child(2) a').text("Cerrar sesión");
        $('.BoxLoginSingIm ul li:nth-child(1) a').text("<?php echo $current_user->display_name; ?> ");
        $('.BoxLoginSingIm ul li:nth-child(1) a').append("<span class='glyphicon glyphicon-user'></span>");
      <?php
      } else {?>

        $('.BoxLoginSingIm ul li:nth-child(2) a').text("Iniciar sesión");

      <?php
      } ?>
    });
</script>