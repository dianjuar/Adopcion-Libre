<nav class="navbar BoxMenu">
	<div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed MenuBoton" data-toggle="collapse" data-target="#menu1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar MenuBoton__lineas"></span>
        <span class="icon-bar MenuBoton__lineas"></span>
        <span class="icon-bar MenuBoton__lineas"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="menu1">
		<?php wp_nav_menu(
            array(
              'container'     => false,
              'items_wrap'    =>' <ul id="menuTop" class="nav nav-justified">%3$s</ul>',
              'theme_location'=> 'menu-top'
            )
          );
        ?>
    <article>
        <?php if (!function_exists('dynamic_sidebar') || 
          !dynamic_sidebar('servicio-001')) : ?>
        <?php endif; ?>
        <div class="searchBox">
          <?php 
          if (!function_exists('dynamic_sidebar') || 
                !dynamic_sidebar('servicio-002')) : ?>
          <?php endif; ?>
        </div>
      </article>
    </div>
	</div>
</nav>
