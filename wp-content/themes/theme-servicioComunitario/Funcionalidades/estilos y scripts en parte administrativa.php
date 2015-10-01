<?php
//*************************************************************************************
//añade los archivos necesarios para que en la parte de administrativa se pueda usar el sweetalert :))))
add_action( 'admin_head', function(){
		?>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/js/sweetalert2-master/dist/sweetalert2.css"> 
		    <script src="<?php bloginfo('template_url') ?>/js/sweetalert2-master/dist/sweetalert2.min.js"></script>
		<?php

		//necesario para mostar el modal de finalizar post.
		global $pagenow;

		if($pagenow == "edit.php")	
			require_once ("finalizar post.php");
		
});
//*************************************************************************************
////////////////////////////////////////////////////	
	add_action( 'admin_footer', function() {

		global $pagenow;

		if($pagenow == "edit.php" || $pagenow == "profile.php")
		{			
			?>
			<!-- links JQuery y bootstrap.js  -->
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
			<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url') ?>/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
			<script src="<?php bloginfo('template_url') ?>/js/main.js"></script>
			<script src="<?php bloginfo('template_url') ?>/js/vendor/bootstrap.min.js"></script> 

			<?php

			if ($pagenow == "edit.php")
			{
				?>
				<script>
					jQuery(document).ready(function($){
						$('.btn-finalizar').on('click',function()
						{						
							/*En el area administrativa, para finalizar post, no es posible obtener facilmente 
							el PostId y el postName (Necesarios para finalizar el post) entonces a través de js 
							se obtien gracias a que wordpress guarda estos datos en cada row de la tabla donde se
							muestran los post publicados de cada usuario.*/
							var postId = $(this).closest('tr').attr('id').split("-");
							$("#post-id").val(postId[1]);

							var postName = $(this).closest('div').prev().children(".post_title").text();
							$("#nombre-mascota").text('"'+postName+'"');

							//alert($("#post-id").val()+" and "+$("#nombre-mascota").text());
						});
					});
				</script> 
				<?php
			}// if ($pagenow == "edit.php")
			else
				if( $pagenow == "profile.php" )
				{
					?>
					<script>
						//jQuery(document).ready(function($){
							//alert("ASD");
							//$("#rpr_tel").attr("pattern",'^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3,4})[-. )]*(\d{3})[-. ]*(\d{2})[-. ]*(\d{2})(?: *x(\d+))?\s*$');
							//$("#rpr_tel").attr("pattern",'^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3,4})[-. )]*(\d{3})[-. ]*(\d{2})[-. ]*(\d{2})(?: *x(\d+))?\s*$');
							//$("#rpr_tel").attr("required",'');
						//};
					</script>
					<?php
				}
		}// if($pagenow == "edit.php" || $pagenow == "profile.php")
	} );
	///////////////////////////////////////////////////
	add_action( 'load-edit.php', function() 
	{
			?>
			<!-- Estilos de boostrap en la seccion administrativa de wordpress -->
			<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap.min.css"> 
  		    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/bootstrap-theme.min.css">
			<?php
	});
	////////////////////////////////////////////////////
?>