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
		"titulo" => "Teléfono:",
		"descripcion" => "Teléfono del actual dueño de la mascota. <abbr title='Ejemplo'>Ejm:</abbr> +58 (0426) 123.45.67. <u> Cambielo solo si la mascota le pertenece a otra persona. </u>"),
	"dirección" => array(
		"nombre" => "direccion",
		"titulo" => "Dirección:",
		"descripcion" => "Dirección actual de la mascota. <u> Cambielo solo si la mascota le pertenece a otra persona. </u>"),
	"estado" => array(
		"nombre" => "estado",
		"titulo" => "Estado:",
		"descripcion" => "Estado en el que se encuentra ubicada la mascota. <u> Cambielo solo si la mascota le pertenece a otra persona. </u>"),
	"municipio" => array(
		"nombre" => "municipio",
		"titulo" => "Municipio:",
		"descripcion" => "Municipio en el que se encuentra ubicada la mascota. <u> Cambielo solo si la mascota le pertenece a otra persona. </u>"),
);


/*===== ADMIN Declarar meta box - Post OFF ==========================================*/
/*===== ADMIN Crear meta box - Post ON ==============================================*/
function crear_meta_box() {
   global $key;
 
   if( function_exists( 'add_meta_box' ) ) {
       add_meta_box( 'nuevo-meta-boxes',  __('Datos de la mascota:'), 'mostrar_meta_box', 'post', 'normal', 'high' );
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
	 
	foreach($meta_boxes as $meta_box) 
	{
	    $data = get_post_meta($post->ID, $key, true);
	    ?>
	    <div class="form-field form-required">
	        <label for="<?php echo $meta_box[ 'nombre' ]; ?>"><?php echo $meta_box[ 'titulo' ]; ?></label>
	        
	        <?php
	        switch ($meta_box[ 'nombre' ]) 
	        {
	        	case "esterilizacion":
	        	?>
	        		<select required name="<?php echo $meta_box[ 'nombre' ]; ?>" id="<?php echo $meta_box[ 'nombre' ]; ?>">
						<option value="" <?php if(empty($data[ $meta_box[ 'nombre' ] ])) {?>selected<?php } ?> >Seleccionar</option>  
						<option value="Si" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Si") {?>selected<?php } ?> >Si</option>
		        		<option value="No" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="No") {?>selected<?php } ?> >No</option>
		        		<option value="No se" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="No se") {?>selected<?php } ?> >No se</option>
	        		</select>	
	        	<?php
	        	break;
	        	//---------
	        	case "tipo":
	        	?>
					<select required name="<?php echo $meta_box[ 'nombre' ]; ?>" id="<?php echo $meta_box[ 'nombre' ]; ?>">
						<option value="" <?php if(empty($data[ $meta_box[ 'nombre' ] ])) {?>selected<?php } ?> >Seleccionar</option>  
						<option value="Perro" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Perro") {?>selected<?php } ?> >Perro</option>
	        			<option value="Gato" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Gato") {?>selected<?php } ?> >Gato</option>
	        			<option value="Otro" <?php if(!empty($data[ $meta_box[ 'nombre' ] ]) && $data[ $meta_box[ 'nombre' ] ]=="Otro") {?>selected<?php } ?> >Otro</option>
	        		</select>	
	        	<?php
	        	break;
	        	//---------
	        	case "telefono":
	        	?>
					<input required type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" 
					value="<?php if(empty($data[ $meta_box[ 'nombre' ] ])) echo $current_user->rpr_tel; else  echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?> " 
	        		pattern="^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3,4})[-. )]*(\d{3})[-. ]*(\d{2})[-. ]*(\d{2})(?: *x(\d+))?\s*$"/>
	        	<?php
	        	break;
	        	//---------
	        	case "direccion":
	        	?>
	        		<textarea required name="<?php echo $meta_box[ 'nombre' ]; ?>" ><?php echo $current_user->rpr_direccin; ?> </textarea>
	        	<?php
	        	break;
	        	//---------
	        	case "raza":
	        	?>
	        		<input required type="text" name="<?php echo $meta_box[ 'nombre' ]; ?>" 
	        		value="<?php if(!empty($data[ 'tipo' ])) echo htmlspecialchars( $data[ $meta_box[ 'nombre' ] ] ); ?>" />
	        	<?php
	        	break;
	        	//---------
	        	case "estado":
	        	?>
        			<select requeried id="rpr_estado" name="<?php echo $meta_box[ 'nombre' ]; ?>">
        			</select>
	        	<?php
	        	break;
	        	//---------
	        	case "municipio":
	        	?>
        			<select requeried id="rpr_municipio" name="<?php echo $meta_box[ 'nombre' ]; ?>" >
        			</select>
	        	<?php
	        	break;
	        	//---------
	        }	        	
	        ?>
	        <p><?php echo $meta_box[ 'descripcion' ]; ?></p>
    	</div>
	 
	<?php 
	} // Fin del foreach?>
	</div>
	<?php
}
/*===== ADMIN Mostar meta box - Post OFF=============================================*/
/*===== ADMIN Grabar meta box - Post ON =============================================*/
function grabar_meta_box( $post_id ) {
    global $post, $meta_boxes, $key, $aux;

    foreach( $meta_boxes as $meta_box )
    {
    	if( $meta_box[ 'nombre' ] != 'estado' && $meta_box[ 'nombre' ] != 'municipio' )
    		$data[ $meta_box[ 'nombre' ] ] = $_POST[ $meta_box[ 'nombre' ] ];
    	
    }

    if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
        return $post_id;
 
    if ( !current_user_can( 'edit_post', $post_id ))
        return $post_id;

 	update_post_meta( $post_id, $key, $data );   

 	update_post_meta( $post_id, "estado", $_POST["estado"] );   
 	update_post_meta( $post_id, "municipio", $_POST["municipio"] );   

}

add_action( 'save_post', 'grabar_meta_box' );
	/*===== ADMIN Grabar meta box - Post OFF ============================================*/
	/*===== ADMIN Editar tabla - Post ON ===============================================*/
function editar_titulos_columnas($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Título",
			"description" => "Descripción",
			"tipo" => "Tipo",
			"estado" => "Estado",
			"municipio" => "Municipio",
		);
		return $columns;
}
add_filter("manage_edit-post_columns", "editar_titulos_columnas");
/*===== ADMIN Editar tabla - Post OFF ===============================================*/
/*===== ADMIN Mostrar meta box en tabla - Post ON ===================================*/
function obt_valores_columnas($column){
	global $post, $meta_boxes, $key;

	foreach($meta_boxes as $meta_box) 
	    $data = get_post_meta($post->ID, $key, true);
	

	switch ($column)
	{
        case "estado":
        	$est = get_post_meta($post->ID, 'estado', true);

           	if(empty($est)) 
           		echo "--"; 
           	else 
           		echo $est;
        break;

        case "municipio":
        	$mun = get_post_meta($post->ID, 'municipio', true);

           	if(empty($mun)) 
           		echo "--"; 
           	else 
           		echo $mun;
        break;

        case "tipo":
           	if(empty($data['tipo'])) 
           		echo "--"; 
           	else 
           		echo $data['tipo'];
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

    //Asignar Rol "Suscriptor." a los nuevos usuarios.
    add_filter('pre_option_default_role', function(){
        // You can also add conditional tags here and return whatever
        return 'al_suscriptor'; // This is changed
    });
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

/*===== ADMIN que los meta box se muestren in one row - ON ==========================*/
function my_screen_layout_columns( $columns ) {
    $columns["post"] = 1;
    return $columns;
}

function my_screen_layout() {
    return 1;
}

add_filter( 'screen_layout_columns', 'my_screen_layout_columns' );
add_filter( 'get_user_option_screen_layout_post', 'my_screen_layout' );
/*===== ADMIN que los meta box se muestren in one row - OFF =========================*/

/*===== ADMIN cambiar de posicion los meta boxes - ON ===============================*/
add_action('do_meta_boxes', 'move_meta_box');

function move_meta_box(){
	remove_meta_box( 'commentsdiv', 'post', 'side' );

    remove_meta_box( 'categorydiv', 'post', 'side' );
    add_meta_box('categorydiv', __('Categoria de la mascota:'), 'post_categories_meta_box', 'post', 'normal', 'high');

    remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );
    add_meta_box('tagsdiv-post_tag', __('Añadir etiquetas:'), 'post_tags_meta_box', 'post', 'normal', 'high');
    
    remove_meta_box( 'submitdiv', 'post', 'side' );
    add_meta_box('submitdiv', __('Publicar:'), 'post_submit_meta_box', 'post', 'normal', 'high');
}
/*===== ADMIN cambiar de posicion los meta boxes - OFF ==============================*/


include 'Funcionalidades/listarPosts.php';
include 'Funcionalidades/Quitar opciones del dashboard.php';
include 'Funcionalidades/ListarEditarUsuarios.php';
include 'Funcionalidades/Modificar acciones del listado de post.php';
include 'Funcionalidades/post-new.php';
include 'Funcionalidades/users.php';
include 'Funcionalidades/listarComentarios.php';
include 'Funcionalidades/estilos y scripts en parte administrativa.php';

//security esto no ejecuta código html en la caja de comentarios
add_filter('pre_comment_content', 'wp_specialchars');

//se le pasa por parametro los roles de otro usuario a editar y se retorna true o false si este puede editarlos o no.
function al_rolUser_CanEdit($rolesToEdit)
{
	foreach ($rolesToEdit as $rolToEdit) 
		foreach (wp_get_current_user()->roles as $userRol) 
			if($userRol == 'al_administrador' && $rolToEdit == 'al_administrador' ||
			   $userRol == 'al_administrador' && $rolToEdit == 'al_superadministrador')
			{
				//die("NOOOOO!! SE PUEDE!!!!!");
				return false;
			}

	//die("SIIIII SE PUEDE!!!!!");
	return true;
}

function al_isProgrammerLogged()
{
	return current_user_can('manage_options');
}

function al_isAdministradorLogged()
{
	return current_user_can('al_administrador');
}

function al_isModeradorLogged()
{
	return current_user_can('al_moderador');
}

function al_isSuscriptorLogged()
{
	return current_user_can('al_suscriptor');
}

function al_isSuperAdministradorLogged()
{		
	return current_user_can('al_superadministrador');
}

add_filter('login_redirect', function () {
  return home_url();
});

//ordena los roles según su jerarquía.
function get_sorted_roles(){

	$roles = get_editable_roles();

	$suscriptor = $roles["al_suscriptor"];
	$moderador = $roles["al_moderador"];
	$administrador = $roles["al_administrador"];
	$superadministrador = $roles["al_superadministrador"];

	$rolesSorted["al_suscriptor"] = $suscriptor;
	$rolesSorted["al_moderador"] = $moderador;
	$rolesSorted["al_administrador"] = $administrador;
	$rolesSorted["al_superadministrador"] = $superadministrador;

	return $rolesSorted;
}

//is role 1 lower than 2, roles are ids
function isLowerRole($role1, $role2)
{
	/*var_dump($role1);
	echo "-----------------------------------";
	var_dump($role2);
	die();*/

	if($role1 == $role2)
		return false;

	$roles = get_sorted_roles();

	$suscriptor = "al_suscriptor";
	$moderador = "al_moderador";
	$administrador = "al_administrador";
	$superadministrador = "al_superadministrador";

	if( $role1 == $suscriptor )
		return true;

	if( $role1 == $superadministrador )
		return false;

	if( $role1 == $administrador )
	{
		if($role2 == $superadministrador)
			return true;
		else
			return false;
	}
	else
	{
		//aquí entran todos los moderadores
		if( $role2 == $suscriptor)
			return false;
		else
			return true;
	}

}





?>