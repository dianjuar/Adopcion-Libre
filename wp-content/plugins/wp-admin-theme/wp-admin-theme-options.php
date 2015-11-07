<?php
if (isset($_POST['submitted'])) {
	update_option('wp_admin_theme_footer', $_POST['footer']);
	$path = WP_PLUGIN_DIR . '/wp-admin-theme/wp-admin.css';
	if (is_writeable($path)) {
		$admin_css = fopen($path, 'w') or die("can't open file");
		fwrite($admin_css, stripslashes($_POST['admin-css'])) or die('Could not write to file');
		fclose($admin_css);
	}else {
		echo "File not writable";
	}
}
?>
<div class="wrap">
<h2>WP Admin Theme</h2>

<form method="post" action="<?php echo get_option('siteurl').'/wp-admin/options-general.php?page=wp-admin-theme'; ?>">
	<table class="form-table">
		<tr valign="top">
			<td>
				<h3>Footer HTML</h3>
				<textarea rows="5" cols="70" name="footer"><?php echo stripslashes(get_option('wp_admin_theme_footer')); ?></textarea>
			</td>
		</tr>
		<tr valign="top">
			<td>
				<h3>Admin CSS</h3>
				<textarea rows="25" cols="70" name="admin-css"><?php echo file_get_contents(plugins_url('/wp-admin-theme/wp-admin.css'));?></textarea>
			</td>
		</tr>
	</table>
	<input type="hidden" name="submitted" />
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
</form>

</div>
