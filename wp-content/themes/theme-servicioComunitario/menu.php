<nav class="BoxMenu">
	<div class="container">
		<?php wp_nav_menu(
            array(
              'container'     => false,
              'items_wrap'    =>' <ul id="menuTop" class="nav-justified">%3$s</ul>',
              'theme_location'=> 'menu-top'
            )
          );
        ?>
	</div>
</nav>

