<?php
/**
 * Uninstall plugin. Fired when the plugin is uninstalled.
 *
*/

// If uninstall, not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit; }

/** Delete All the Custom Post Types */
$abcfPostTypes = array( 'abcfggcl_post_type' );
foreach ( $abcfPostTypes as $postType ) {
	$items = get_posts( array( 'post_type' => $postType, 'numberposts' => -1, 'fields' => 'ids' ) );
	if ( $items ) {
		foreach ( $items as $item ) {
			wp_delete_post( $item, true);
		}
	}
}