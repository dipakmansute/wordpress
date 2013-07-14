<?php
/**
 * @package Test
 * @version 1.0
 */
/*
Plugin Name: 插件测试
Plugin URI: http://wordpress.org/extend/plugins/test/
Description: 此插件专门用作测试
Author: 夏又桥
Version: 1.0
Author URI: http://www.cooldea.com
*/

// This just echoes the chosen line, we'll position it later
function hello_footer1($arg) {
	echo "<p id='dolly'>大家好".$arg."</p>";
}

function hello_footer2($arg) {
	echo "<p id='dolly'>我叫夏又桥".$arg."</p>";
}
do_action_ref_array();
// Now we set that function up to execute when the admin_notices action is called
add_action( 'footer_bottom', 'hello_footer1', 1000, 1 );
add_action( 'footer_bottom', 'hello_footer2', 100, 1 );
//add_action($tag, $function_to_add, $priority, $accepted_args) ,$accepted_args为参数的个数


