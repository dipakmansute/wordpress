<?php
/*
 * Plugin Name: Grid Gallery with Custom Links
 * Plugin URI: http://abcfolio.com/help/grid-gallery-with-custom-links/
 * Description: Grid gallery with links to any page or post.
 * Author: abcFolio WordPress Themes for Photographers
 * Author URI: http://www.abcfolio.com
 * Version: 1.0.3
 * Text Domain: abcfmlcf-td
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/
 *
 * @package Grid Gallery with Custom Links
 * @category Core
 * @author abcFolio WordPress Themes for Photographers
 * @license   GPL-2.0+
 * @version 1.0.3
*/

if ( !defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'ABCFGGCL_Grid_Gallery' ) ) :

final class ABCFGGCL_Grid_Gallery {

    private static $instance;

    public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                    self::$instance = new ABCFGGCL_Grid_Gallery;
                    self::$instance->plugin_constants();
                    self::$instance->includes();
                    self::$instance->setup_actions();
                    self::$instance->load_textdomain();
            }
            return self::$instance;
    }

    private function plugin_constants() {

        if( ! defined( 'ABCFGGCL_VERSION' ) ){ define( 'ABCFGGCL_VERSION', '1.0.0' ); }
        // Plugin Folder URL
        if( ! defined( 'ABCFGGCL_PLUGIN_URL' ) ){ define( 'ABCFGGCL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );}
        // Plugin Folder Path
        if( ! defined( 'ABCFGGCL_PLUGIN_DIR' ) ){ define( 'ABCFGGCL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }
        // Plugin Root File
        if( ! defined( 'ABCFGGCL_PLUGIN_FILE' ) ){ define( 'ABCFGGCL_PLUGIN_FILE', __FILE__ ); }
    }

    private function includes() {

        require_once ABCFGGCL_PLUGIN_DIR . 'includes/post-types.php';
        require_once ABCFGGCL_PLUGIN_DIR . 'includes/scripts.php';
        require_once ABCFGGCL_PLUGIN_DIR . 'includes/lib-css-builders.php';
        require_once ABCFGGCL_PLUGIN_DIR . 'includes/lib-html-builders.php';
        require_once ABCFGGCL_PLUGIN_DIR . 'includes/shortcodes.php';
        require_once ABCFGGCL_PLUGIN_DIR . 'includes/gallery-builders.php';

        if( is_admin() ) {
            require_once ABCFGGCL_PLUGIN_DIR . 'admin/menu.php';
            require_once ABCFGGCL_PLUGIN_DIR . 'admin/mbox-shortcode.php';
            require_once ABCFGGCL_PLUGIN_DIR . 'admin/mbox-post-options.php';
            require_once ABCFGGCL_PLUGIN_DIR . 'admin/input-builders.php';
            require_once ABCFGGCL_PLUGIN_DIR . 'admin/mbox-save.php';
       }
    }

    private function setup_actions() {

        add_action( 'admin_print_styles-post-new.php', array( $this, 'remove_permalink' ), 1 );
        add_action( 'admin_print_styles-post.php', array( $this, 'remove_permalink' ), 1 );
        add_filter( 'post_row_actions', array( $this, 'remove_post_edit_links' ), 10, 1 );

    }

    //Remove permalink and preview buttons from post screen.
    public function remove_permalink() {
        global $post_type;
        if($post_type == 'abcfggcl_post_type') {
        echo '<style type="text/css">#edit-slug-box,#view-post-btn,#post-preview,.updated p a{display: none;}</style>';
        }
    }

    //Remove view  and quick edit from that you see when you mouse over a post.
    function remove_post_edit_links( $actions ){
        if( get_post_type() === 'abcfggcl_post_type' )
            unset( $actions['view'] );
            unset( $actions['inline hide-if-no-js'] );
        return $actions;
    }

    public function load_textdomain() {

        load_plugin_textdomain( 'abcfggcl-td', false, dirname( plugin_basename( ABCFGGCL_PLUGIN_FILE ) ) . '/languages/' );

    }
}
endif; // End if class_exists check

function ABCFCLG() {
	return ABCFGGCL_Grid_Gallery::get_instance();
}
ABCFCLG();