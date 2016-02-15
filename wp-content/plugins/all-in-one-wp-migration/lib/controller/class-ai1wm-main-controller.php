<?php
/**
 * Copyright (C) 2014 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wm_Main_Controller {

	/**
	 * Main Application Controller
	 *
	 * @return Ai1wm_Main_Controller
	 */
	public function __construct() {
		register_activation_hook( AI1WM_PLUGIN_BASENAME, array( $this, 'activation_hook' ) );

		// Activate hooks
		$this->activate_actions()
			 ->activate_filters()
			 ->activate_textdomain();
	}

	/**
	 * Activation hook callback
	 *
	 * @return Object Instance of this class
	 */
	public function activation_hook() {

	}

	/**
	 * Initializes language domain for the plugin
	 *
	 * @return Object Instance of this class
	 */
	private function activate_textdomain() {
		load_plugin_textdomain( AI1WM_PLUGIN_NAME, false, false );

		return $this;
	}

	/**
	 * Register listeners for actions
	 *
	 * @return Object Instance of this class
	 */
	private function activate_actions() {
		if ( is_multisite() ) {
			if ( apply_filters( 'ai1wm_multisite_menu', false ) ) {
				add_action( 'network_admin_menu', array( $this, 'admin_menu' ) );
			} else {
				add_action( 'network_admin_notices', array( $this, 'multisite_notice' ) );
			}
		} else {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		}

		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_init', array( $this, 'router' ) );
		add_action( 'admin_init', array( $this, 'create_folders' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'get_header', array( $this, 'get_header' ) );

		// Add automatic plugins updates
		add_action( 'wp_maybe_auto_update', 'Ai1wm_Updater_Controller::check_for_updates' );

		// Add updater scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'register_updater_scripts_and_styles' ) );

		return $this;
	}

	/**
	 * Register listeners for filters
	 *
	 * @return Object Instance of this class
	 */
	private function activate_filters() {
		// Add a links to plugin list page
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );

		// Add export buttons
		add_filter( 'ai1wm_export_buttons', 'Ai1wm_Export_Controller::buttons' );

		// Add import buttons
		add_filter( 'ai1wm_import_buttons', 'Ai1wm_Import_Controller::buttons' );

		// Add chunk size limit
		add_filter( 'ai1wm_max_chunk_size', 'Ai1wm_Import_Controller::max_chunk_size' );

		// Add plugins api
		add_filter( 'plugins_api', 'Ai1wm_Updater_Controller::plugins_api', 20, 3 );

		// Add plugins updates
		add_filter( 'pre_set_site_transient_update_plugins', 'Ai1wm_Updater_Controller::pre_update_plugins' );

		// Add plugins metadata
		add_filter( 'site_transient_update_plugins', 'Ai1wm_Updater_Controller::update_plugins' );

		// Add "Check for updates" link to plugin list page
		add_filter( 'plugin_row_meta', 'Ai1wm_Updater_Controller::plugin_row_meta', 10, 2 );

		return $this;
	}

	/**
	 * Display multisite notice
	 *
	 * @return void
	 */
	public function multisite_notice() {
		Ai1wm_Template::render( 'main/multisite-notice' );
	}

	/**
	 * Display storage directory notice
	 *
	 * @return void
	 */
	public function storage_notice() {
		Ai1wm_Template::render( 'main/storage-notice' );
	}

	/**
	 * Display index file notice
	 *
	 * @return void
	 */
	public function index_notice() {
		Ai1wm_Template::render( 'main/index-notice' );
	}

	/**
	 * Display backups directory notice
	 *
	 * @return void
	 */
	public function backups_notice() {
		Ai1wm_Template::render( 'main/backups-notice' );
	}

	/**
	 * Add a links to plugin list page
	 *
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( $file == AI1WM_PLUGIN_BASENAME ) {
			$links[] = Ai1wm_Template::get_content( 'main/get-support' );
		}

		return $links;
	}

	/**
	 * Show maintenance page
	 *
	 * @return void
	 */
	public function get_header() {
		Ai1wm_Maintenance::display();
	}

	/**
	 * Register initial parameters
	 *
	 * @return void
	 */
	public function init() {
		// Set secret key
		if ( ! get_site_option( AI1WM_SECRET_KEY, false, false ) ) {
			update_site_option( AI1WM_SECRET_KEY, wp_generate_password( 12, false ) );
		}

		// Set username
		if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
			update_site_option( AI1WM_AUTH_USER, $_SERVER['PHP_AUTH_USER'] );
		} else if ( isset( $_SERVER['REMOTE_USER'] ) ) {
			update_site_option( AI1WM_AUTH_USER, $_SERVER['REMOTE_USER'] );
		}

		// Set password
		if ( isset( $_SERVER['PHP_AUTH_PW'] ) ) {
			update_site_option( AI1WM_AUTH_PASSWORD, $_SERVER['PHP_AUTH_PW'] );
		}

		// Check for updates
		if ( isset( $_GET['ai1wm_updater'] ) ) {
			if ( current_user_can( 'update_plugins' ) && check_admin_referer( 'ai1wm_updater_nonce' ) ) {
				Ai1wm_Updater::check_for_updates();
			}
		}
	}

	/**
	 * Register initial router
	 *
	 * @return void
	 */
	public function router() {
		// Public
		add_action( 'wp_ajax_nopriv_ai1wm_export', 'Ai1wm_Export_Controller::export' );
		add_action( 'wp_ajax_nopriv_ai1wm_import', 'Ai1wm_Import_Controller::import' );
		add_action( 'wp_ajax_nopriv_ai1wm_resolve', 'Ai1wm_Resolve_Controller::resolve' );

		// Update
		if ( current_user_can( 'update_plugins' ) ) {
			add_action( 'wp_ajax_ai1wm_updater', 'Ai1wm_Updater_Controller::updater' );
		}

		// Export
		if ( current_user_can( 'export' ) ) {
			add_action( 'wp_ajax_ai1wm_export', 'Ai1wm_Export_Controller::export' );
		}

		// Import
		if ( current_user_can( 'import' ) ) {
			add_action( 'wp_ajax_ai1wm_import', 'Ai1wm_Import_Controller::import' );
		}

		// Both
		if ( current_user_can( 'export' ) || current_user_can( 'import' ) ) {
			add_action( 'wp_ajax_ai1wm_backup_delete', 'Ai1wm_Backup_Controller::delete' );
			add_action( 'wp_ajax_ai1wm_leave_feedback', 'Ai1wm_Feedback_Controller::leave_feedback' );
			add_action( 'wp_ajax_ai1wm_report_problem', 'Ai1wm_Report_Controller::report_problem' );
			add_action( 'wp_ajax_ai1wm_close_message', 'Ai1wm_Message_Controller::close_message' );
			add_action( 'wp_ajax_ai1wm_disable_maintenance', 'Ai1wm_Maintenance::disable' );
			add_action( 'wp_ajax_ai1wm_resolve', 'Ai1wm_Resolve_Controller::resolve' );
		}
	}

	/**
	 * Create folders needed for plugin operation, if they don't exist
	 *
	 * @return void
	 */
	public function create_folders() {
		// Check if storage folder exist
		if ( ! file_exists( AI1WM_STORAGE_PATH ) ) {

			// Folder doesn't exist, attempt to create it
			if ( ! mkdir( AI1WM_STORAGE_PATH ) ) {

				// We couldn't create the folder, so let's tell the user
				if ( is_multisite() ) {
					return add_action( 'network_admin_notices', array( $this, 'storage_notice' ) );
				} else {
					return add_action( 'admin_notices', array( $this, 'storage_notice' ) );
				}
			}
		}

		// Create index.php in storage folder
		Ai1wm_File_Index::create( AI1WM_STORAGE_INDEX );

		// Check if backups folder exist
		if ( ! file_exists( AI1WM_BACKUPS_PATH ) ) {

			// Folder doesn't exist, attempt to create it
			if ( ! mkdir( AI1WM_BACKUPS_PATH ) ) {

				// We couldn't create the folder, so let's tell the user
				if ( is_multisite() ) {
					return add_action( 'network_admin_notices', array( $this, 'backups_notice' ) );
				} else {
					return add_action( 'admin_notices', array( $this, 'backups_notice' ) );
				}
			}
		}

		// Create index.php in backups folder
		Ai1wm_File_Index::create( AI1WM_BACKUPS_INDEX );
	}

	/**
	 * Creates a index.php file in specific folder
	 *
	 * The method will create index.php file with contents '<?php // silence is golden' without the single quotes
	 * at the path specified by the argument. The file is only created if it doesn't exist. If the file is unable to
	 * be created, the method will call wp_die to notify the user and stop the execution
	 *
	 * @param  $path string Path to the folder where the index.php file needs to be created
	 * @return void
	 */
	protected function create_index_file( $path ) {
		// Name of the index file with the path
		$file = $path . DIRECTORY_SEPARATOR . AI1WM_DIRECTORY_INDEX;

		// Check if the file exists
		if ( ! file_exists( $file ) ) {

			// File doesn't exist attempt to create ti
			$handle = fopen( $file, 'w' );

			// Check if we were able to open the file
			if ( false === $handle ) {

				// We couldn't create the folder, so let's tell the user
				if ( is_multisite() ) {
					return add_action( 'network_admin_notices', array( $this, 'index_notice' ) );
				} else {
					return add_action( 'admin_notices', array( $this, 'index_notice' ) );
				}
			}

			fwrite( $handle, '<?php // silence is golden' );
			fclose( $handle );
		}
	}

	/**
	 * Register plugin menus
	 *
	 * @return void
	 */
	public function admin_menu() {
		// top level WP Migration menu
		add_menu_page(
			'All-in-One WP Migration',
			'All-in-One WP Migration',
			'export',
			'site-migration-export',
			'Ai1wm_Export_Controller::index',
			'',
			'76.295'
		);
		// sublevel Export menu
		$export_page_hook_suffix = add_submenu_page(
			'site-migration-export',
			__( 'Export', AI1WM_PLUGIN_NAME ),
			__( 'Export', AI1WM_PLUGIN_NAME ),
			'export',
			'site-migration-export',
			'Ai1wm_Export_Controller::index'
		);
		add_action(
			'admin_print_scripts-' . $export_page_hook_suffix,
			array( $this, 'register_export_scripts_and_styles' )
		);
		// sublevel Import menu
		$import_page_hook_suffix = add_submenu_page(
			'site-migration-export',
			__( 'Import', AI1WM_PLUGIN_NAME ),
			__( 'Import', AI1WM_PLUGIN_NAME ),
			'import',
			'site-migration-import',
			'Ai1wm_Import_Controller::index'
		);
		add_action(
			'admin_print_scripts-' . $import_page_hook_suffix,
			array( $this, 'register_import_scripts_and_styles' )
		);
		// sublevel Backups menu
		$backup_page_hook_suffix = add_submenu_page(
			'site-migration-export',
			__( 'Backups', AI1WM_PLUGIN_NAME ),
			__( 'Backups', AI1WM_PLUGIN_NAME ),
			'export',
			'site-migration-backup',
			'Ai1wm_Backup_Controller::index'
		);
		add_action(
			'admin_print_scripts-' . $backup_page_hook_suffix,
			array( $this, 'register_backup_scripts_and_styles' )
		);
	}

	/**
	 * Outputs menu icon between head tags
	 *
	 * @return void
	 */
	public function admin_head() {
		global $wp_version;

		Ai1wm_Template::render( 'main/admin-head', array( 'version' => $wp_version ) );
	}

	/**
	 * Register scripts and styles for Export Controller
	 *
	 * @return void
	 */
	public function register_export_scripts_and_styles() {
		do_action( 'ai1mw-register-export-scripts-and-styles' );

		// we don't want heartbeat to occur when exporting
		wp_deregister_script( 'heartbeat' );

		wp_enqueue_script(
			'ai1wm-js-export',
			Ai1wm_Template::asset_link( 'javascript/export.min.js' ),
			array( 'jquery' )
		);
		wp_enqueue_style(
			'ai1wm-css-export',
			Ai1wm_Template::asset_link( 'css/export.min.css' )
		);
		wp_localize_script( 'ai1wm-js-export', 'ai1wm_feedback', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_leave_feedback' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-export', 'ai1wm_report', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_report_problem' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-export', 'ai1wm_message', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_close_message' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-export', 'ai1wm_maintenance', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_disable_maintenance' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-export', 'ai1wm_export', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_export' ) ),
			),
			'status' => array(
				'php' => wp_make_link_relative( plugins_url( 'status.php', AI1WM_PLUGIN_BASENAME ) ),
				'js'  => wp_make_link_relative( plugins_url( 'storage/status.js', AI1WM_PLUGIN_BASENAME ) ),
			),
			'secret_key' => get_site_option( AI1WM_SECRET_KEY, false, false ),
		) );
	}

	/**
	 * Register scripts and styles for Backup Controller
	 *
	 * @return void
	 */
	public function register_backup_scripts_and_styles() {
		do_action( 'ai1mw-register-backup-scripts-and-styles' );
		wp_enqueue_script(
			'ai1wm-js-backup',
			Ai1wm_Template::asset_link( 'javascript/backup.min.js' ),
			array( 'jquery' )
		);
		wp_enqueue_style(
			'ai1wm-css-backup',
			Ai1wm_Template::asset_link( 'css/backup.min.css' )
		);
		wp_localize_script( 'ai1wm-js-backup', 'ai1wm_feedback', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_leave_feedback' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-backup', 'ai1wm_report', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_report_problem' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-backup', 'ai1wm_maintenance', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_disable_maintenance' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-backup', 'ai1wm_backup', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_backup_delete' ) ),
			),
		) );
	}

	/**
	 * Register scripts and styles for Import Controller
	 *
	 * @return void
	 */
	public function register_import_scripts_and_styles() {
		do_action( 'ai1mw-register-import-scripts-and-styles' );

		// we don't want heartbeat to occur when importing
		wp_deregister_script( 'heartbeat' );

		wp_enqueue_script(
			'ai1wm-js-import',
			Ai1wm_Template::asset_link( 'javascript/import.min.js' ),
			array( 'plupload-all', 'jquery' )
		);
		wp_enqueue_style(
			'ai1wm-css-import',
			Ai1wm_Template::asset_link( 'css/import.min.css' )
		);
		wp_localize_script( 'ai1wm-js-import', 'ai1wm_uploader', array(
			'runtimes'            => 'html5,silverlight,flash,html4',
			'browse_button'       => 'ai1wm-import-file',
			'container'           => 'ai1wm-plupload-upload-ui',
			'drop_element'        => 'ai1wm-drag-drop-area',
			'file_data_name'      => 'upload-file',
			'chunk_size'          => apply_filters( 'ai1wm_max_chunk_size', AI1WM_MAX_CHUNK_SIZE ),
			'max_retries'         => apply_filters( 'ai1wm_max_chunk_retries', AI1WM_MAX_CHUNK_RETRIES ),
			'url'                 => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_import' ) ),
			'flash_swf_url'       => includes_url( 'js/plupload/plupload.flash.swf' ),
			'silverlight_xap_url' => includes_url( 'js/plupload/plupload.silverlight.xap' ),
			'multiple_queues'     => false,
			'multi_selection'     => false,
			'urlstream_upload'    => true,
			'unique_names'        => true,
			'multipart'           => true,
			'multipart_params'    => array(
				'provider'   => 'file',
				'method'     => 'import',
				'secret_key' => get_site_option( AI1WM_SECRET_KEY, false, false ),
			),
			'filters'             => array(
				'ai1wm_archive_extension' => array( 'wpress', 'bin' ),
				'ai1wm_archive_size'      => apply_filters( 'ai1wm_max_file_size', AI1WM_MAX_FILE_SIZE ),
			),
		) );
		wp_localize_script( 'ai1wm-js-import', 'ai1wm_feedback', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_leave_feedback' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-import', 'ai1wm_report', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_report_problem' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-import', 'ai1wm_maintenance', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_disable_maintenance' ) ),
			),
		) );
		wp_localize_script( 'ai1wm-js-import', 'ai1wm_import', array(
			'ajax' => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_import' ) ),
			),
			'status' => array(
				'php' => wp_make_link_relative( plugins_url( 'status.php', AI1WM_PLUGIN_BASENAME ) ),
				'js'  => wp_make_link_relative( plugins_url( 'storage/status.js', AI1WM_PLUGIN_BASENAME ) ),
			),
			'secret_key' => get_site_option( AI1WM_SECRET_KEY, false, false ),
			'oversize'   => sprintf(
				__(
					'The file that you are trying to import is over the maximum upload file size limit of <strong>%s</strong>.' .
					'<br />You can remove this restriction by purchasing our ' .
					'<a href="https://servmask.com/products/unlimited-extension" target="_blank">Unlimited Extension</a>.',
					AI1WM_PLUGIN_NAME
				),
				size_format( apply_filters( 'ai1wm_max_file_size', AI1WM_MAX_FILE_SIZE ) )
			),
			'invalid_extension' =>
				sprintf(
					__(
						'Version 2.1.1 of All in One WP Migration introduces new compression algorithm. ' .
						'It makes exporting and importing 10 times faster.' .
						'<br />Unfortunately, the new format is not back compatible with backups made with earlier ' .
						'versions of the plugin.' .
						'<br />You can either create a new backup with the latest version of the ' .
						'plugin, or convert the archive to the new format using our tools ' .
						'<a href="%s" target="_blank">here</a>.',
						AI1WM_PLUGIN_NAME
					),
					AI1WM_ARCHIVE_TOOLS_URL
			),
		) );
	}

	/**
	 * Register scripts and styles for Updater Controller
	 *
	 * @return void
	 */
	public function register_updater_scripts_and_styles( $hook ) {
		if ( 'plugins.php' !== $hook ) {
			return;
		}

		do_action( 'ai1mw-register-updater-scripts-and-styles' );

		wp_enqueue_style(
			'ai1wm-css-updater',
			Ai1wm_Template::asset_link( 'css/updater.min.css' )
		);
		wp_enqueue_script(
			'ai1wm-js-updater',
			Ai1wm_Template::asset_link( 'javascript/updater.min.js' ),
			array( 'jquery' )
		);
		wp_localize_script( 'ai1wm-js-updater', 'ai1wm_updater', array(
			'ajax' => array(
				'url' => admin_url( 'admin-ajax.php?action=ai1wm_updater' ),
			),
		) );
	}
}
