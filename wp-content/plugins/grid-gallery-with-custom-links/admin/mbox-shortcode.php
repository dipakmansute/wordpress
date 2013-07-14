<?php
/**
 * Meta box: Shortcode
 *
*/
add_action( 'add_meta_boxes', 'abcfggcl_add_mbox_shortcode', 10, 2 );

function abcfggcl_add_mbox_shortcode($post_type) {
    if ( abcfggcl_inputbldr_display_mbox($post_type) ) {
        add_meta_box(
            'abcfggcl-mbox-shortcode',
            __('Shortcode', 'abcfggcl-td'),
            'abcfggcl_mbox_get_shortcode',
            $post_type,
            'normal',
            'high'
            );
    }
}

function abcfggcl_mbox_get_shortcode( $post) {

    $args = array( 'id' => $post->ID );

    $scode = abcfggcl_scodes_build_scode( $args );
    echo abcfggcl_inputbldr_input_txt_readonly('abcclgpScode', '', $scode, '', '', 0,15, '100%', 'abcfInputB');
}