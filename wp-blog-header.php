<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( !isset($wp_did_header) ) {

	$wp_did_header = true;

	require_once( dirname(__FILE__) . '/wp-load.php' );

	wp();

	require_once( ABSPATH . WPINC . '/template-loader.php' );

}



/*
 * wp变量和常量特点
if ( !isset($wp_did_header) ) {
	$wp_did_header = true;
}
或
if ( !defined('WP_DEBUG') )
	define( 'WP_DEBUG', false );
 * 
 * 这种定义的方式使用当前的wp环境更清洁
 * 而且我们在这个变量之前的任意位置可以通过赋值的形式激活它
 * 让系统改变运行方式，进而有效的阻止第三多改变源码！！！
 * 
 */