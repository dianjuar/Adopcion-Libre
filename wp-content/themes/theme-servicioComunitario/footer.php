<footer class="container">
  <div class="boxFooter">
  	<div class="row">
  		<?php wp_nav_menu(
            array(
              'container'     => false,
              'items_wrap'    =>' <ul id="MenuFooter" class="">%3$s</ul>',
              'theme_location'=> 'menu-footer'
            )
          );
        ?>
  	</div>
  	<div class="row">
  		<ul id="redesSociales">
  			<a href="https://twitter.com/AdopcionLibre"><li><span class="icon icon-twitter"></span></li></a>
  			<a href="https://www.facebook.com/adopcion.libre.9?fref=ts"><li><span class="icon icon-facebook2"></span></li></a>
  		</ul>
  	</div>
  	<div class="row">
  		inserte aqui copiright
  	</div>
    
  </div>
</footer> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url') ?>/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
<script src="<?php bloginfo('template_url') ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/plugins.js"></script>
<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>