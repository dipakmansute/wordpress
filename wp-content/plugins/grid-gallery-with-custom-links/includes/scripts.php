<?php
/**
 * Load scripts, styles and icons
 *
*/
if ( ! defined( 'ABSPATH' ) ) exit;

function abcfggcl_enq_scripts() {

    //Script is loaded only on pages that have a shortcode.
    wp_register_script( 'ggcl-equal-heights-js', ABCFGGCL_PLUGIN_URL . 'js/abcf-equal-heights-01.js', array( 'jquery' ), ABCFGGCL_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'abcfggcl_enq_scripts' );


function abcfggcl_enq_styles() {

    $custom = 'abcfolio/grid-gallery.css';
    $childTheme    = trailingslashit( get_stylesheet_directory() ) . $custom;
    $parentTheme   = trailingslashit( get_template_directory() ) . $custom;
    $url = '';

    // Look in the child theme directory first, followed by the parent theme
    if ( file_exists( $childTheme ) ) {
        $url = trailingslashit( get_stylesheet_directory_uri() ) . $custom;
    }
    elseif ( file_exists( $parentTheme ) ) {
        $url = trailingslashit( get_template_directory_uri() ) . $custom;
    }

    wp_register_style('ggcl-style', ABCFGGCL_PLUGIN_URL . 'css/grid-gallery-with-custom-links.css', array(), ABCFGGCL_VERSION, 'all');
    wp_enqueue_style('ggcl-style');

    if(!empty($url)){ wp_enqueue_style( 'ggcl-style-custom', $url, array() ); }
}

add_action( 'wp_enqueue_scripts', 'abcfggcl_enq_styles', 10000 );


function abcfggcl_enq_admin_style() {

    wp_register_style('ggcl-admin', ABCFGGCL_PLUGIN_URL . '/css/admin.css', ABCFGGCL_VERSION, 'all');
    wp_enqueue_style('ggcl-admin');

}
add_action( 'admin_enqueue_scripts', 'abcfggcl_enq_admin_style', 100 );


function abcfggcl_add_plugin_icons() {
    $icon_url = ABCFGGCL_PLUGIN_URL . 'images/icon_32x32.png';

?>  <style type="text/css" media="screen">
    #icon-abcfggcl_menu.icon32-posts-abcfggcl_post_type { background:transparent url( "<?php echo $icon_url; ?>" ) no-repeat 0px 0px; !important;}
    #icon-edit.icon32-posts-abcfggcl_post_type { background:transparent url( "<?php echo $icon_url; ?>" ) no-repeat 0px 0px; !important;}
    </style><?php
}
add_action( 'admin_head', 'abcfggcl_add_plugin_icons' );




