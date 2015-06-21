<?php

	//Funcion para menus
	register_nav_menus(
    	array(
        	'menu-index'=>'Menu home',
        	'menu-top'=>'Menu Top',
        ));

	//funcion para widget
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
		'name'=> 'Inicio sesion',
		'id' => 'servicio-001',
		'before_widget' => '<article id="%1$s" class="col-md-12 BoxLoginSingIm">',
		'after_widget' => '</article>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
		));

		register_sidebar(array(
		'name'=> 'Busqueda ',
		'id' => 'servicio-002',
		'before_widget' => '<article id="%1$s" class="col-md-12 BoxLoginSingIm">',
		'after_widget' => '</article>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
		));
	}
	// Campos personalizados
	$key = "post";
	$meta_boxes = array(
		"tipo" => array(
    		"nombre" => "tipo",
    		"titulo" => "Tipo de mascota:",
    		"descripcion" => "Ingrese el tipo de mascota"),
		"raza" => array(
    		"nombre" => "raza",
    		"titulo" => "Raza de la mascota:",
    		"descripcion" => "Ingrese la raza de la mascota"),
		"esterilizacion" => array(
    		"nombre" => "esterilizacion",
    		"titulo" => "Esterilizado:",
    		"descripcion" => "Indicar si la mascota esta esterilizada"),
		"estatus" => array(
    		"nombre" => "estatus",
    		"titulo" => "Estatus de la mascota:",
    		"descripcion" => "Indicar el estatus de la publicación"),
		"telefono" => array(
    		"nombre" => "telefono",
    		"titulo" => "Telefono:",
    		"descripcion" => "Telefono del actual dueño de la mascota"),
		"dirección" => array(
    		"nombre" => "direccion",
    		"titulo" => "Dirección:",
    		"descripcion" => "Dirección actual de la mascota"),
	);
	 
	//Crear campos personalizados
	function crear_meta_box() {
	   global $key;
	 
	   if( function_exists( 'add_meta_box' ) ) {
	       add_meta_box( 'nuevo-meta-boxes', ucfirst( $key ) . ' Datos:', 'mostrar_meta_box', 'post', 'normal', 'high' );
	   }
	}

	//Mostrar campos de la entrada
	function mostrar_meta_box() {
		global $post, $meta_boxes, $key;
		global $current_user;
              get_currentuserinfo();
		?>
		 
		<div class="form-wrap">
		 
		<?php
		wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
		 
		foreach($meta_boxes as $meta_box) {
		    $data = get_post_meta($post->ID, $key, true);
		    ?>
		 
		    <div class="form-field form-required">
		        <label for="<?php echo $meta_box[ 'nombre' ]; ?>"><?php echo $meta_box[ 'titulo' ]; ?></label>
		        
		        <?php if($meta_box[ 'nombre' ]=="esterilizacion"){ ?>
		        	<select required name="<?php echo $meta_box[ 'nombre' ]; ?>" id="<?php echo $meta_box[ 'nombre' ]; ?>">
						<option value="" <?php if(empty($data[ $meta_box[ 'nombre' ] ])) {?>selected<?php } ?> >Seleccionar</option>  
						<option value="Si" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Si") {?>selected<?php } ?> >Si</option>
		        		<option value="No" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="No") {?>selected<?php } ?> >No</option>
		        		<option value="No se" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="No se") {?>selected<?php } ?> >No se</option>
		        	</select>		        	
		        <?php } 
		        	if($meta_box[ 'nombre' ]=="estatus"){ ?>
						<select required name="<?php echo $meta_box[ 'nombre' ]; ?>" id="<?php echo $meta_box[ 'nombre' ]; ?>">
							<option value="" <?php if(empty($data[ $meta_box[ 'nombre' ] ])) {?>selected<?php } ?> >Seleccionar</option>  
							<option value="En adopción" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="En adopción") {?>selected<?php } ?> >En adopción</option>
		        			<option value="Adoptado" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Adoptado") {?>selected<?php } ?> >Adoptado</option>
		        			<option value="Encontrado" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Adoptado") {?>selected<?php } ?> >Encontrado</option>
		        			<option value="Perdido" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Adoptado") {?>selected<?php } ?> >Perdido</option>
		        			<option value="Devuelto" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Adoptado") {?>selected<?php } ?> >Devuelto</option>
		        		</select>	
		        <?php }
		        	if($meta_box[ 'nombre' ]=="tipo"){ ?>
						<select required name="<?php echo $meta_box[ 'nombre' ]; ?>" id="<?php echo $meta_box[ 'nombre' ]; ?>">
							<option value="" <?php if(empty($data[ $meta_box[ 'nombre' ] ])) {?>selected<?php } ?> >Seleccionar</option>  
							<option value="Perro" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Perro") {?>selected<?php } ?> >Perro</option>
		        			<option value="Gato" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Gato") {?>selected<?php } ?> >Gato</option>
		        			<option value="Otro" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Otro") {?>selected<?php } ?> >Otro</option>
		        		</select>	
		        <?php }
		        	 if($meta_box[ 'nombre' ]=="telefono") { ?>
		        	<input required type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" value="<?php if(empty($data[ $meta_box[ 'nombre' ] ])) echo $current_user->rpr_tel; else  echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?> " />
		        <?php }
		        	if($meta_box[ 'nombre' ]=="direccion") { ?>
		        		<input required type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" value="<?php if(empty($data[ $meta_box[ 'nombre' ] ])) echo $current_user->rpr_direccin; else  echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?> " />
		        <?php }
		        	if($meta_box[ 'nombre' ]=="raza") { ?>	
		        	<input required type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" value="<?php if(!empty($data[ 'tipo' ])) echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?>" />
		        <?php } ?>
		        <p><?php echo $meta_box[ 'descripcion' ]; ?></p>
		    </div>
		 
		<?php } // Fin del foreach?>
		</div>
		<?php
	}

	//Guardar datos de la entrada
	function grabar_meta_box( $post_id ) {
	    global $post, $meta_boxes, $key, $aux;
	 
	    foreach( $meta_boxes as $meta_box ) {
	        	$data[ $meta_box[ 'nombre' ] ] = $_POST[ $meta_box[ 'nombre' ] ];
	    }
	 
	    if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
	        return $post_id;
	 
	    if ( !current_user_can( 'edit_post', $post_id ))
	        return $post_id;

	 		update_post_meta( $post_id, $key, $data );
	    
	}
 	
 	//Titulos de la entrada
	function editar_titulos_columnas($columns){
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => "Título",
				"description" => "Descripción",
				"tipo" => "Tipo",
				"raza" => "Raza",
				"esterilizacion" => "Esterilizado",
	            "estatus" => "Estatus"
			);
			return $columns;
	}
	
	//Mostrar valores de la entrada
	function obt_valores_columnas($column){
    	global $post, $meta_boxes, $key;
 
    	foreach($meta_boxes as $meta_box) {
    	    $data = get_post_meta($post->ID, $key, true);
    	}
    	switch ($column)
    	{
    	        case "description":
    	                the_excerpt();
    	                break;
    	        case "raza":
     	               	if(empty($data['raza'])) echo "--"; else echo $data['raza'];
    	                break;
     	       case "esterilizacion":
     	       			if(empty($data['esterilizacion'])) echo "--"; else echo $data['esterilizacion'];
    	                break;
    	        case "tipo":
     	               	if(empty($data['tipo'])) echo "--"; else echo $data['tipo'];
    	                break;
    	        case "estatus":
    	                if(empty($data['estatus'])) echo "--"; else echo $data['estatus'];
    	                break;
    	}
	}

	//Eventos action y filter
	add_action( 'admin_menu', 'crear_meta_box' );
	add_action( 'save_post', 'grabar_meta_box' );
	add_filter("manage_edit-post_columns", "editar_titulos_columnas");
	add_action("manage_posts_custom_column",  "obt_valores_columnas");
	add_filter( 'the_search_query', 'searchAll' );


	//Set a custom role for a new user
	function oa_social_login_set_new_user_role ($user_role)
	{
	  //This is an example for a custom setting with one role
	  $user_role = 'al_suscriptor';
	   
	  //This is an example for a custom setting with two roles
	  //$user_role = 'author editor';
	  
	  //Comprobado que si llama esta funcion
	  //die("funcion new user role: $user_role");

	  //The new user will be created with this role
	  return $user_role;
	}
	 
	//This filter is applied to the roles of new users
	add_filter('oa_social_login_filter_new_user_role', 'oa_social_login_set_new_user_role');

	function remove_admin_bar_links() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('new-content');
	}
	add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

	function add_sumtips_admin_bar_link() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
		'id' => 'ir_a_sitio',
		'title' => __( 'Volver al sitio'),
		'href' => __( site_url()),
		) );
	}
	add_action('admin_bar_menu', 'add_sumtips_admin_bar_link',25);

	/* Agregar hoja de estilo */
	function wb_admin_css() {
		$url = content_url('/themes/theme-servicioComunitario/css/wp-admin.css', __FILE__);
	    //$url = get_settings('siteurl') . '/wp-content/plugins/wp-admin-theme/wp-admin.css';
	    echo '
	    <link rel="stylesheet" type="text/css" href="' . $url . '" />
	    <link rel="stylesheet" href="/wp-admin/css/upload.css" type="text/css" />
	    ';
	}
	add_action('admin_head','wb_admin_css', 1000);

	function hide_personal_options(){
	?>
	<script type="text/javascript">
	  jQuery(document).ready(function(){
	    jQuery("#your-profile .form-table:first, #your-profile h3:first, #contextual-help-link-wrap").remove();
	  });
	</script>
	<?php
	}
	add_action('admin_head','hide_personal_options');


	//Deshabilita la funcion de autoguardado de los post
	function disableAutoSave(){
		wp_deregister_script('autosave');
	}
	add_action( 'wp_print_scripts', 'disableAutoSave' );

	//Login estilos

	function my_login_stylesheet() {
	    wp_enqueue_style( 'custom-login', content_url('/themes/theme-servicioComunitario/css/wp-login.css', __FILE__) );
	    wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/style-login.js' );
	}
	add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

	function my_login_logo() { ?>
	    <style type="text/css">
	        .login h1 a {
	        	background-image:none;
	        	height: 0;
	            /*background-image: url(<?php echo  content_url('/themes/theme-servicioComunitario/img/Cat_and_Dog_Vector.svg', __FILE__); ?>);
	            height: 100px;
	            background-size: 100px;*/
	        }
	    </style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );

	/* Esconder opciones de pantalla */
	function remove_screen_options(){
	    return false;
	}
	/*add_filter('screen_options_show_screen', 'remove_screen_options');*/
?>

<?php

include 'Funcionalidades/listarPosts.php';
include 'Funcionalidades/Quitar opciones del dashboard.php';
include 'Funcionalidades/ListarEditarUsuarios.php';

?>