<?php
	/*===== SITIO Funcion para mostar menus ON ==========================================*/
	register_nav_menus(
    	array(
        	'menu-index'=>'Menu home',
        	'menu-top'=>'Menu Top',
        ));
	/*===== SITIO Funcion para mostar menus OFF =========================================*/
	/*===== SITIO Funcion para mostar widgets ON ========================================*/
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
	/*===== SITIO Funcion para mostar widgets OFF =======================================*/
	/*===== ADMIN Declarar meta box - Post ON ===========================================*/
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
		"telefono" => array(
    		"nombre" => "telefono",
    		"titulo" => "Telefono:",
    		"descripcion" => "Telefono del actual dueño de la mascota"),
		"dirección" => array(
    		"nombre" => "direccion",
    		"titulo" => "Dirección:",
    		"descripcion" => "Dirección actual de la mascota"),
		/*"nombre-dueno" => array(
    		"nombre" => "nombre-dueno",
    		"titulo" => "Nombre del dueño:",
    		"descripcion" => "Nombre de la persona que sera la encargada de la mascota"),
		"telefono-dueno" => array(
    		"nombre" => "telefono-dueno",
    		"titulo" => "Telefono del dueño:",
    		"descripcion" => "Telefono de la persona que sera la encargada de la mascota"),*/
	);

	
	/*===== ADMIN Declarar meta box - Post OFF ==========================================*/
	/*===== ADMIN Crear meta box - Post ON ==============================================*/
	function crear_meta_box() {
	   global $key;
	 
	   if( function_exists( 'add_meta_box' ) ) {
	       add_meta_box( 'nuevo-meta-boxes', ucfirst( $key ) . ' Datos:', 'mostrar_meta_box', 'post', 'normal', 'high' );
	   }
	}
	add_action( 'admin_menu', 'crear_meta_box' );
	/*===== ADMIN Crear meta box - Post OFF =============================================*/
	/*===== ADMIN Mostar meta box - Post ON =============================================*/
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
		        <?php } 
		        	if($meta_box[ 'nombre' ]=="nombre-dueno") { ?> 
		        	<input type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" value="<?php if(!empty($data[ 'tipo' ])) echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?>" />
		        <?php }
		        	if($meta_box[ 'nombre' ]=="telefono-dueno") { ?>
		        	<input type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" value="<?php if(!empty($data[ 'tipo' ])) echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?>" />
		    	<?php }
		        ?>
		        <p><?php echo $meta_box[ 'descripcion' ]; ?></p>
		    </div>
		 
		<?php } // Fin del foreach?>
		</div>
		<?php
	}
	/*===== ADMIN Mostar meta box - Post OFF=============================================*/
	/*===== ADMIN Grabar meta box - Post ON =============================================*/
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
	add_action( 'save_post', 'grabar_meta_box' );
 	/*===== ADMIN Grabar meta box - Post OFF ============================================*/
 	/*===== ADMIN Editar tabla - Post OFF ===============================================*/
	function editar_titulos_columnas($columns){
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => "Título",
				"description" => "Descripción",
				"tipo" => "Tipo",
				"raza" => "Raza",
				"esterilizacion" => "Esterilizado"
			);
			return $columns;
	}
	add_filter("manage_edit-post_columns", "editar_titulos_columnas");
	/*===== ADMIN Editar tabla - Post OFF ===============================================*/
	/*===== ADMIN Mostrar meta box en tabla - Post ON ===================================*/
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
    	}
	}
	add_action("manage_posts_custom_column",  "obt_valores_columnas");
	/*===== ADMIN Mostrar meta box en tabla - Post OFF ==================================*/
	/*===== Set a custom role for a new user ON =========================================*/
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
	/*===== Set a custom role for a new user OFF ========================================*/
	/*===== This filter is applied to the roles of new users ON =========================*/
	add_filter('oa_social_login_filter_new_user_role', 'oa_social_login_set_new_user_role');
	/*===== This filter is applied to the roles of new users OFF ========================*/
	/*===== ADMIN Quitar link a la barra superior ON ====================================*/
	function remove_admin_bar_links() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('new-content');
	}
	add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
	/*===== ADMIN Quitar link a la barra superior OFF ===================================*/
	/*===== ADMIN Agregar link a la barra superior ON ===================================*/
	function add_sumtips_admin_bar_link() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
		'id' => 'ir_a_sitio',
		'title' => __( 'Volver al sitio'),
		'href' => __( site_url()),
		) );
	}
	add_action('admin_bar_menu', 'add_sumtips_admin_bar_link',25);
	/*===== ADMIN Agregar link a la barra superior OFF ==================================*/
	/*===== ADMIN Agregar hoja CSS ON ===================================================*/
	function wb_admin_css() {
		$url = content_url('/themes/theme-servicioComunitario/css/wp-admin.css', __FILE__);
	    //$url = get_settings('siteurl') . '/wp-content/plugins/wp-admin-theme/wp-admin.css';
	    echo '
	    <link rel="stylesheet" type="text/css" href="' . $url . '" />
	    <link rel="stylesheet" href="/wp-admin/css/upload.css" type="text/css" />
	    ';
	}
	add_action('admin_head','wb_admin_css', 1000);
	/*===== ADMIN Agregar hoja CSS OFF ==================================================*/
	/*===== ADMIN esconder opciones personales - perfil ON ==============================*/
	function hide_personal_options(){
	?>
	<script type="text/javascript">
	  jQuery(document).ready(function(){
	    jQuery("#your-profile .form-table:first, #your-profile h3:first").remove();
	  });
	</script>
	<?php
	}
	add_action('admin_head','hide_personal_options');
	/*===== ADMIN esconder opciones personales - perfil OFF =============================*/
	/*===== ADMIN Deshabilita la funcion de autoguardado de los post ON =================*/
	function disableAutoSave(){
		wp_deregister_script('autosave');
	}
	add_action( 'wp_print_scripts', 'disableAutoSave' );
	/*===== ADMIN Deshabilita la funcion de autoguardado de los post ON =================*/
	/*===== LOGIN-FORM Agregar hoja CSS ON ==============================================*/
	function my_login_stylesheet() {
	    wp_enqueue_style( 'custom-login', content_url('/themes/theme-servicioComunitario/css/wp-login.css', __FILE__) );
	    wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/style-login.js' );
	}
	add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
	/*===== LOGIN-FORM Agregar hoja CSS OFF =============================================*/
	/*===== ADMIN esconder opciones de pantalla ON ======================================*/
	function remove_screen_options(){
	    return false;
	}
	add_filter('screen_options_show_screen', 'remove_screen_options');
	/*===== ADMIN esconder opciones de pantalla OFF =====================================*/
	/*===== ADMIN esconder ayuda ON =====================================================*/
	add_action('admin_head', 'mytheme_remove_help_tabs');
	function mytheme_remove_help_tabs() {
	    $screen = get_current_screen();
	    $screen->remove_help_tabs();
	}
	/*===== ADMIN esconder ayuda OFF ====================================================*/
	/*===== ADMIN esconder widgets - escritorio ON ======================================*/
	function remove_dashboard_widgets() {

		global $wp_meta_boxes;

		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);

		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	}
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
	/*===== ADMIN esconder widgets - escritorio OFF =====================================*/
	/*===== LOGIN-FORM Titulo Inicio Sesion ON ==========================================*/
	function titulo_inicio_sesion() { ?>
	    <script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery(".login h1 ").html("Inicia sesión");
		  });
		</script>
		<?php
	}
	add_action( 'login_form', 'titulo_inicio_sesion' );
	/*===== LOGIN-FORM Titulo Inicio Sesion OFF =========================================*/
	/*===== LOGIN-FORM Titulo Registro ON ===============================================*/
	function titulo_registro() { ?>
	    <script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery(".login h1 ").html("Registrate");
		  });
		</script>
		<?php
	}
	add_action( 'register_form', 'titulo_registro' );
	/*===== LOGIN-FORM Titulo Registro OFF ==============================================*/
	/*===== LOGIN-FORM Titulo Olvido su contraseña ON ===================================*/
	function titulo_contrasena() { ?>
	    <script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery(".login h1 ").html("¿Olvido su contraseña?");
		  });
		</script>
		<?php
	}
	add_action( 'lostpassword_form', 'titulo_contrasena' );
	/*===== LOGIN-FORM Titulo Olvido su contraseña OFF ==================================*/
	/*===== LOGIN-FORM Titulo reset contraseña ON =======================================*/
	function titulo_reset() { ?>
	    <script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery(".login h1 ").html("Recuperar contraseña");
		  });
		</script>
		<?php
	}
	add_action( 'resetpass_form', 'titulo_reset' );
	/*===== LOGIN-FORM Titulo reset contraseña OFF ======================================*/
	/*===== LOGIN-FORM Y ADMIN agregar footer ON ========================================*/
	function showFooter() {
		get_footer();
	}
	add_action( 'login_footer', 'showFooter' );
	/*===== LOGIN-FORM Y ADMIN agregar footer OFF =======================================*/
	/*===== LOGIN-FORM Y ADMIN agregar header ON ========================================*/
	function showHeader() {
		 get_header();
	}
	add_action( 'login_head', 'showHeader' );
	add_action( 'admin_head', 'showHeader' );
	/*===== LOGIN-FORM Y ADMIN agregar header OFF =======================================*/
	/*===== ADMIN Bienvanida - Escritorio ON ============================================*/
	function nuevos_widgets_escritorio() {
		wp_add_dashboard_widget( 'tutorial_bienvenido_escritorio', 'Bienvenido a la sección de administración', 'escritorio_bienvenida' );
	}
	function escritorio_bienvenida(){ ?>
		<p>En esta sección se compone de:</p>
		<ul>
		<li><strong>Mascotas</strong> - Alli podras crear mascotas para darlas en adopcion, para reportarlas como encontradas o perdidas</li>
		<li><strong>Comentarios</strong> - Alli podras ver todos los comentarios que han hecho en tus entradas</li>
		<li><strong>Perfil</strong> - Alli podras cambiar los datos de tu perfil</li>
		</ul>
		
	<?php }
	add_action( 'wp_dashboard_setup', 'nuevos_widgets_escritorio' );
	/*===== ADMIN Bienvanida - Escritorio OFF ===========================================*/
	/*===== ADMIN Titulos descripcion - Post ON =========================================*/
	function titulo_des() { ?>
	    <script type="text/javascript">
		  jQuery(document).ready(function(){
		    jQuery(".wp-editor-expand #wp-content-editor-tools").html("<span>Introduce una descripción</span>");
		  });
		</script>
		<?php
	}
	add_action('edit_form_top', 'titulo_des');
	/*===== ADMIN Titulos descripcion - Post OFF ========================================*/
	/*===== ADMIN Cambiar nombre - Post ON ==============================================*/
	function revcon_change_post_label() {
	    global $menu;
	    global $submenu;
	    $menu[5][0] = 'Mascotas';
	    $submenu['edit.php'][5][0] = 'Mascotas';
	    $submenu['edit.php'][10][0] = 'Nueva mascota';
	    $submenu['edit.php'][16][0] = 'Etiquetas de mascotas';
	    echo '';
	}
	function revcon_change_post_object() {
	    global $wp_post_types;
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = 'Mascotas';
	    $labels->singular_name = 'Mascotas';
	    $labels->add_new = 'Nueva mascota';
	    $labels->add_new_item = 'Nueva Mascota';
	    $labels->edit_item = 'Editar Mascotas';
	    $labels->new_item = 'Mascotas';
	    $labels->view_item = 'Ver mascota';
	    $labels->search_items = 'Buscar mascotas';
	    $labels->not_found = 'No se encontraron mascotas';
	    $labels->not_found_in_trash = 'No se encontraron en la papelera';
	    $labels->all_items = 'Todas las Mascotas';
	    $labels->menu_name = 'Mascotas';
	    $labels->name_admin_bar = 'Mascotas';
	}
	 
	add_action( 'admin_menu', 'revcon_change_post_label' );
	add_action( 'init', 'revcon_change_post_object' );
	/*===== ADMIN Cambiar nombre - Post OFF =============================================*/
	/*===== ADMIN Eliminar cosas de head - ON ===========================================*/
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	/*===== ADMIN Eliminar cosas de head - OFF ==========================================*/
	/*===== ADMIN Desabilitar movimiento metaboxes - ON ================================*/
	function fb_remove_postbox() {
	    wp_deregister_script('postbox');
	}
	add_action( 'admin_init', 'fb_remove_postbox' );
	/*===== ADMIN Desabilitar movimiento metaboxes - OFF ================================*/
	/*function myplugin_add_meta_box() {

	$screens = array( 'post');

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Finalizar ', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/*function myplugin_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	/*$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="myplugin_new_field">';
	_e( 'Description for this field', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}*/

?>

<?php

include 'Funcionalidades/listarPosts.php';
include 'Funcionalidades/Quitar opciones del dashboard.php';
include 'Funcionalidades/ListarEditarUsuarios.php';
include 'Funcionalidades/Modificar acciones del listado de post.php';
include 'Funcionalidades/finalizar post.php';

?>