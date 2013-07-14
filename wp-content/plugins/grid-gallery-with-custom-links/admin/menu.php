<?php
/**
 * Admin menu
*/
if (!class_exists("ABCFGGCL_Admin_Menu")) {

    class ABCFGGCL_Admin_Menu {

    function __construct() {
        add_action( 'admin_menu', array (&$this, 'add_menu') );
    }

    function add_menu() {
        add_menu_page('Grid Gallery', 'Grid Gallery', 'edit_pages', 'abcfggcl_menu', '', ABCFGGCL_PLUGIN_URL . '/images/icon_16x16.png', '57.54872154722');

        add_submenu_page('abcfggcl_menu', 'Help', __('Help', 'abcfggcl-td'), 'edit_pages', 'abcfggcl_menu', array(&$this, 'submenu_page'));
    }


function submenu_page() {
?>
<div class="wrap">
    <div id="icon-edit" class="icon32 icon32-posts-abcfggcl_post_type">
        <br>
    </div>
    <h2>
        Grid Gallery with Custom Links - <?php echo(__('Help', 'abcfggcl-td')) ?>
    </h2>
    <div class="ggclDocs">Full Documentation and Help Files:</a>
        <p><a href="http://abcfolio.com/help/grid-gallery-with-custom-links/">http://abcfolio.com/help/grid-gallery-with-custom-links/</a><p>
    </div>
</div>
<?php
        }
    }
}

$wpdpd = new ABCFGGCL_Admin_Menu();
?>