<?php
/*
Plugin Name: WP Admin Theme
Plugin URI: 
Description: WP Admin Theme - Upload and Activate.  This is a very basic admin theme which adds an admin css file and a custom footer.
Author: David Smith
Version: 1.0
Author URI: http://www.cibydesign.co.uk
*/

/**
 * Add admin menu
 * @return
 */
function add_menu() {
	add_option('wp_admin_theme_footer');
	add_options_page('WP Admin Theme', 'WP Admin Theme', 'manage_options', 'wp-admin-theme', 'wp_admin_theme_options');
}

/**
 * Sanitize options
 * @return
 */
function wp_admin_theme_options_validate($input) {
	return $input;
}

/**
 * Include options page
 * @return
 */
function wp_admin_theme_options() {
	include 'wp-admin-theme-options.php';
}

/**
 * Add CSS file link
 */
function wb_admin_css() {
	$url = plugins_url('/wp-admin.css', __FILE__);
    //$url = get_settings('siteurl') . '/wp-content/plugins/wp-admin-theme/wp-admin.css';
    echo '
    <link rel="stylesheet" type="text/css" href="' . $url . '" />
    <link rel="stylesheet" href="/wp-admin/css/upload.css" type="text/css" />
    ';
}

/**
 * Add custom footer
 */
function wb_admin_theme_footer($content) {
	$content = stripslashes(get_option('wp_admin_theme_footer'));
	return $content;
}


add_action('admin_menu', 'add_menu');
//Priority is set to 1000 to make sure CSS is added after all others so you can override other css files used by other plugins etc.
add_action('admin_head','wb_admin_css', 1000);
add_filter('admin_footer_text', 'wb_admin_theme_footer');

?>
