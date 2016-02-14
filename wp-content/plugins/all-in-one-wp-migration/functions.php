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

/**
 * URL encode
 *
 * @param  mixed $value Value to encode
 * @return mixed
 */
function ai1wm_urlencode( $value ) {
	return is_array( $value ) ? array_map( 'ai1wm_urlencode', $value ) : urlencode( $value );
}

/**
 * URL decode
 *
 * @param  mixed $value Value to decode
 * @return mixed
 */
function ai1wm_urldecode( $value ) {
	return is_array( $value ) ? array_map( 'ai1wm_urldecode', $value ) : urldecode( stripslashes( $value ) );
}

/**
 * Get active plugins
 *
 * @param  array $plugins List of plugins
 * @return array
 */
function ai1wm_active_plugins( $plugins = array() ) {
	// WP Migration Plugin
	if ( defined( 'AI1WM_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WM_PLUGIN_BASENAME;
	}

	// Dropbox Extension
	if ( defined( 'AI1WMDE_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMDE_PLUGIN_BASENAME;
	}

	// Google Drive Extension
	if ( defined( 'AI1WMGE_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMGE_PLUGIN_BASENAME;
	}

	// Amazon S3 Extension
	if ( defined( 'AI1WMSE_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMSE_PLUGIN_BASENAME;
	}

	// Multisite Extension
	if ( defined( 'AI1WMME_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMME_PLUGIN_BASENAME;
	}

	// Unlimited Extension
	if ( defined( 'AI1WMUE_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMUE_PLUGIN_BASENAME;
	}

	// FTP Extension
	if ( defined( 'AI1WMFE_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMFE_PLUGIN_BASENAME;
	}

	// URL Extension
	if ( defined( 'AI1WMLE_PLUGIN_BASENAME' ) ) {
		$plugins[] = AI1WMLE_PLUGIN_BASENAME;
	}

	return $plugins;
}
