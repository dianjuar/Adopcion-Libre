<?php
/**
 * Copyright (C) 2014-2016 ServMask Inc.
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

class Ai1wm_Export_Enumerate {

	public static function execute( $params ) {

		// Set progress
		Ai1wm_Status::info( __( 'Retrieving a list of all WordPress files...', AI1WM_PLUGIN_NAME ) );

		// Set exclude filters
		$exclude_filters = ai1wm_content_filters();

		// Exclude themes
		if ( isset( $params['options']['no_themes'] ) ) {
			$exclude_filters[] = 'themes';
		}

		// Exclude plugins
		if ( isset( $params['options']['no_plugins'] ) ) {
			$exclude_filters = array_merge( $exclude_filters, array( 'plugins', 'mu-plugins' ) );
		} else {
			$exclude_filters = array_merge( $exclude_filters, ai1wm_plugin_filters() );
		}

		// Exclude media
		if ( isset( $params['options']['no_media'] ) ) {
			$exclude_filters[] = 'uploads';
		}

		// Get total files
		if ( isset( $params['total_files'] ) ) {
			$total_files = (int) $params['total_files'];
		} else {
			$total_files = 0;
		}

		// Get total size
		if ( isset( $params['total_size'] ) ) {
			$total_size = (int) $params['total_size'];
		} else {
			$total_size = 0;
		}

		// Create map file
		$filemap = fopen( ai1wm_filemap_path( $params ) , 'a+' );

		// Start time
		$start = microtime( true );

		// Flag to hold if all files have been processed
		$completed = true;

		try {

			// Iterate over content directory
			$iterator = new Ai1wm_Recursive_Directory_Iterator( WP_CONTENT_DIR );

			// Exclude uploads, plugins or themes
			$iterator = new Ai1wm_Recursive_Exclude_Filter( $iterator, $exclude_filters );

			// Recursively iterate over content directory
			$iterator = new RecursiveIteratorIterator( $iterator, RecursiveIteratorIterator::LEAVES_ONLY, RecursiveIteratorIterator::CATCH_GET_CHILD );

			// Limit content directory
			$iterator = new LimitIterator( $iterator, $total_files );

			// Write path line
			foreach ( $iterator as $item ) {
				if ( $item->isFile() ) {
					if ( fwrite( $filemap, $iterator->getSubPathName() . PHP_EOL ) ) {
						$total_files++;

						// Add current file size
						$total_size += filesize( $iterator->getPathname() );
					}
				}

				// More than 3 seconds have passed, break and do another request
				if ( ( microtime( true ) - $start ) > 3 ) {
					$completed = false;
					break;
				}
			}

		} catch ( Exception $e ) {
			// Skip bad file permissions
		}

		// Set progress
		if ( $completed ) {
			Ai1wm_Status::info( __( 'Done retrieving a list of all WordPress files.', AI1WM_PLUGIN_NAME ) );
		}

		// Set total files
		$params['total_files'] = $total_files;

		// Set total size
		$params['total_size'] = $total_size;

		// Set completed flag
		$params['completed'] = $completed;

		// Close the filemap file
		fclose( $filemap );

		return $params;
	}
}
