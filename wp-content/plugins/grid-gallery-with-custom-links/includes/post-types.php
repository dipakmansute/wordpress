<?php
/**
 * Custom post types setup
 *
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function abcfggcl_setup_post_types() {

    $labels = array(
            'name'               => __( 'Grid Gallery with Custom Links', 'abcfggcl-td' ),
            'add_new'            => __( 'Add New', 'abcfggcl-td' ),
            'add_new_item'       => __( 'Grid Gallery with Custom Links', 'abcfggcl-td' ),
            'edit_item'          => __( 'Grid Gallery with Custom Links', 'abcfggcl-td' ),
            'new_item'           => __( 'New', 'abcfggcl-td' ),
            'all_items'          => __( 'Grid Galleries', 'abcfggcl-td' ),
            'search_items'       => __( 'Search', 'abcfggcl-td' ),
            'not_found'          => __( 'No records found', 'abcfggcl-td' ),
            'not_found_in_trash' => __( 'No records found in the Trash', 'abcfggcl-td' )
    );
    $args = array(
            'labels'        => $labels,
            'description'   => '',
            'public'        => true,
            'hierarchical'  => false,
            'supports'      => array( 'title', 'editor' ),
            'has_archive'   => false,
            'show_ui'       => true,
            'show_in_menu'  => 'abcfggcl_menu'
    );
    register_post_type( 'abcfggcl_post_type', $args );
}

add_action( 'init', 'abcfggcl_setup_post_types', 100 );