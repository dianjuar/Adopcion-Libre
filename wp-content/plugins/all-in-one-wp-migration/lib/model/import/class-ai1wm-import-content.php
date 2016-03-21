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

class Ai1wm_Import_Content {

	public static function execute( $params ) {

		// Read blogs.json file
		$handle = fopen( ai1wm_blogs_path( $params ), 'r' );
		if ( $handle === false ) {
			throw new Ai1wm_Import_Exception( 'Unable to read blogs.json file' );
		}

		// Parse blogs.json file
		$blogs = fread( $handle, filesize( ai1wm_blogs_path( $params ) ) );
		$blogs = json_decode( $blogs );

		// Close handle
		fclose( $handle );

		// Set content offset
		if ( isset( $params['content_offset'] ) ) {
			$content_offset = $params['content_offset'];
		} else {
			$content_offset = 0;
		}

		// Set archive offset
		if ( isset( $params['archive_offset']) ) {
			$archive_offset = $params['archive_offset'];
		} else {
			$archive_offset = 0;
		}

		// Get total files
		if ( isset( $params['total'] ) ) {
			$total = (int) $params['total'];
		} else {
			$total = 1;
		}

		// Get processed files
		if ( isset( $params['processed'] ) ) {
			$processed = (int) $params['processed'];
		} else {
			$processed = 0;
		}

		// What percent of files have we processed?
		$progress = (int) ( ( $processed / $total ) * 100 );

		// Set progress
		if ( empty( $content_offset ) ) {
			Ai1wm_Status::info( sprintf( __( 'Restoring %d files...<br />%.2f%% complete', AI1WM_PLUGIN_NAME ), $total, $progress ) );
		}

		// Start time
		$start = microtime( true );

		// Flag to hold if all files have been processed
		$completed = true;

		// Open the archive file for reading
		$archive = new Ai1wm_Extractor( ai1wm_archive_path( $params ) );

		// Set the file pointer to the one that we have saved
		$archive->set_file_pointer( null, $archive_offset );

		$old_paths = array();
		$new_paths = array();

		// Set extract paths
		foreach ( $blogs as $blog ) {
			$old_paths[] = ai1wm_sites_path( $blog->Old->Id );
			$new_paths[] = ai1wm_sites_path( $blog->New->Id );
		}

		while ( $archive->has_not_reached_eof() ) {
			try {

				// Extract a file from archive to WP_CONTENT_DIR
				if ( ( $content_offset = $archive->extract_one_file_to( WP_CONTENT_DIR, array( AI1WM_PACKAGE_NAME, AI1WM_MULTISITE_NAME, AI1WM_DATABASE_NAME, AI1WM_MUPLUGINS_NAME ), $old_paths, $new_paths, $content_offset, 3 ) ) ) {

					// Set progress
					if ( ( $sub_progress = ( $content_offset / $archive->get_current_filesize() ) ) < 1 ) {
						$progress += $sub_progress;
					}

					// Set progress
					Ai1wm_Status::info( sprintf( __( 'Restoring %d files...<br />%.2f%% complete', AI1WM_PLUGIN_NAME ), $total, $progress ) );

					// Set content offset
					$params['content_offset'] = $content_offset;

					// Set archive offset
					$params['archive_offset'] = $archive_offset;

					// Set completed flag
					$params['completed'] = false;

					// Close the archive file
					$archive->close();

					return $params;
				}

				// Set content offset
				$content_offset = 0;

				// Set archive offset
				$archive_offset = $archive->get_file_pointer();

			} catch ( Exception $e ) {
				// Skip bad file permissions
			}

			// Increment processed files counter
			$processed++;

			// More than 3 seconds have passed, break and do another request
			if ( ( microtime( true ) - $start ) > 3 ) {
				$completed = false;
				break;
			}
		}

		// Set content offset
		$params['content_offset'] = $content_offset;

		// Set archive offset
		$params['archive_offset'] = $archive_offset;

		// Set processed files
		$params['processed'] = $processed;

		// Set completed flag
		$params['completed'] = $completed;

		// Close the archive file
		$archive->close();

		return $params;
	}
}
