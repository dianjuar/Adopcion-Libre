<?php
/*
* Template Name: equipo
* Description: Plantilla la pagina mascotas perdidas.
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 

<?php 
	$developers = 	array(
						array(
							'titulo1'	=> 'Nuestro',
							'titulo2' 	=> 'Equipo',
							'cantPersonas' 	=> 4,
							'infoPersonas' => array(
													array('nombre' => 'Diego Juliao', 
														   'cargo' 	=> '???/Developer',
														   'foto'	=> 'member-1.jpg',
														   'redes'	=> array('fa-facebook'	=> 'https://www.facebook.com/diego.juliao.9',
														   					 'fa-twitter' 	=> 'https://twitter.com/Dianjuar',
														   					 'fa-linkedin' 	=> 'https://ve.linkedin.com/in/dianjuar',
														   					 'fa-linkedin' 	=> 'https://ve.linkedin.com/in/dianjuar',
														   					 'fa-envelope' 	=> 'https://ve.linkedin.com/in/dianjuar',
														   					 'fa-car' 	=> 'https://ve.linkedin.com/in/dianjuar',
														   					 'fa-globe' 	=> 'https://about.me/dianjuar')
													),
												    array('nombre' 	=> 'Yossely Mendoza', 
														  'cargo' 	=> '???/Developer',
														  'foto'	=> 'member-2.jpg',
														  'redes'	=> array('fa-facebook'	=> 'https://www.facebook.com/yossely.mendozameneses',
														   					 'fa-twitter' 	=> 'https://twitter.com/yosse_31',
														   					 'fa-linkedin' 	=> 'abc.com',
														   					 'fa-envelope' 	=> 'mailto:yossely7@gmail.com')
													),
												    array('nombre' 	=> 'Ingrid Lazaro', 
														  'cargo' 	=> 'Desinger',
														  'foto'	=> 'member-3.jpg',
														  'redes'	=> array('fa-facebook'	=> 'facebok.com',
														   					 'fa-twitter' 	=> 'https://twitter.com/',
														   					 'fa-linkedin' 	=> 'abc.com',
														   					 'fa-dribbble' 	=> 'muchosbebes.com')
													),
												    array('nombre' 	=> 'José Paz', 
														  'cargo' 	=> 'preguntele a él',
														  'foto'	=> 'member-4.jpg',
														  'redes'	=> array('fa-facebook'	=> 'facebok.com',
														   					 'fa-twitter' 	=> 'https://twitter.com/',
														   					 'fa-linkedin' 	=> 'abc.com',
														   					 'fa-dribbble' 	=> 'muchosbebes.com')
													)
											)
				    	),
						array(
							'titulo1' 	=> 'Agradecimientos',
							'titulo2' 	=> 'Especiales',
							'cantPersonas' 	=> 2,
							'infoPersonas' => array(
												array('nombre' => 'Marian Le Boulenge Manrique', 
													   'cargo' 	=> 'Cargo',
													   'foto'	=> 'member-1.jpg',
													   'redes'	=> array('fa-facebook'	=> 'https://www.facebook.com/diego.juliao.9',
													   					 'fa-twitter' 	=> 'https://twitter.com/Dianjuar',
													   					 'fa-linkedin' 	=> 'https://ve.linkedin.com/in/dianjuar',
													   					 'fa-globe' 	=> 'https://about.me/dianjuar')
												),
											    array('nombre' 	=> 'Zona Educativa', 
													  'cargo' 	=> '???/Developer',
													  'foto'	=> 'member-2.jpg',
													  'redes'	=> array('fa-facebook'	=> 'https://www.facebook.com/yossely.mendozameneses',
													   					 'fa-twitter' 	=> 'https://twitter.com/yosse_31',
													   					 'fa-linkedin' 	=> 'abc.com',
													   					 'fa-envelope' 	=> 'mailto:yossely7@gmail.com')
												)
											)
						)
					);

?>

<html class="no-js"> <!--<![endif]-->
	<head>
		<!-- Main Stylesheet -->
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/equipo/mainStyle.css">
		<?php require_once("head.php"); ?>

		<!-- Animate.css -->
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/equipo/animate.css">

        <!-- Fontawesome Icon font -->
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/equipo/font-awesome.min.css">
        <!--
		Google Font
		=========================== -->                    
		
		<!-- Oswald / Title Font -->
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
		
		<!-- Modernizer Script for old Browsers -->		
        <script src="<?php bloginfo('template_url') ?>/js/equipo/modernizr-2.6.2.min.js"></script>

	</head>          
	<body >
		<!--[if lt IE 7]>
		<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<?php 
			require_once("header.php");
			require_once("menu.php");
		?>

		<!-- Start Our Team
		=========================================== -->
		<?php for ($j=0; $j < count($developers); $j++): ?>
		<section id="our-team">
			<div class="container">
				<div class="row">				
				
					<!-- section title -->
					<div class="title text-center wow fadeInUp" data-wow-duration="500ms">
						<h2><?php echo $developers[$j]['titulo1']; ?> <span class="color"><?php echo $developers[$j]['titulo2']; ?></span></h2>
						<div class="border"></div>
					</div>
					<!-- /section title -->

					<div class='membersContainer'>						
						<?php 
							$personas = $developers[$j]['infoPersonas'];
							for ($i=0; $i < $developers[$j]['cantPersonas']; $i++) : 
						?>

						<!-- team member -->
						<div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-duration="500ms" data-wow-delay="<?php echo $i*200;?>ms">
	                       <article class="team-mate">
								<div class="member-photo">
									<!-- member photo -->
									<img class="img-responsive" src="<?php bloginfo('template_url') ?>/img/team/
									<?php echo $personas[$i]['foto'];?>" alt="<?php echo $personas[$i]['nombre'];?>">
									<!-- /member photo -->
									
									<!-- member social profile -->
									<div class="mask">
										<ul class="clearfix">
											<?php
												foreach ($personas[$i]['redes'] as $key => $red):
													echo '<li><a target="_blank" href="'.$red.'"><i class="fa '.$key.'"></i></a></li>';
												endforeach;
											?>										
										</ul>
									</div>
									<!-- /member social profile -->
								</div>
								
								<!-- member name & designation -->
								<div class="member-title">
									<h3><?php echo $personas[$i]['nombre'];?></h3>
									<span><?php echo $personas[$i]['cargo'];?></span>
								</div>
								<!-- /member name & designation -->

							   
	                       </article>
	                    </div>
						<!-- end team member -->						
						<?php endfor;?>
					</div>

				</div>  	<!-- End row -->
			</div>   	<!-- End container -->
		</section>   <!-- End section -->
		<?php endfor;?>
	
	
		<div class="container wow fadeInUp" data-wow-duration="500ms">
			<div class="row">
				<div class="title col-md-8 col-md-push-2">
					<h2>						
						<a target="_blank" href="https://github.com/dianjuar/Adopcion-Libre" class='githublink'> 
					 		<i class="fa fa-github fa-2x"></i>
					 		Código Fuente del Sitio
					 		<i class="fa fa-github fa-2x"></i>
			 			</a>
					</h2>
			 		 
		 		</div>
	 		</div>
 		</div>
		

		<?php 
			require_once("footer.php");
			require_once("js/Scripts to login buttons.php");
		?>

		<script>
			$(document).ready(function(){
				$("ul.nav-justified li:nth-child(4)").html("Mascotas perdidas");

				$(".post a").mouseover(function() {	
					$(this).children('.post__info').css("display","block");
				}).mouseout(function (){
					$('.post a').children('.post__info').css("display","none"); 
				});         

			});
		</script>

		<!-- Custom Scrollbar -->
		<script src="<?php bloginfo('template_url') ?>/js/equipo/jquery.nicescroll.min.js"></script>
		<!-- For video responsive -->
		<script src="<?php bloginfo('template_url') ?>/js/equipo/jquery.fitvids.js"></script>

		<!-- wow.min Script -->
		<script src="<?php bloginfo('template_url') ?>/js/equipo/wow.min.js"></script>
		<!-- Custom js -->
		<script src="<?php bloginfo('template_url') ?>/js/equipo/custom.js"></script>
	</body>
</html>
