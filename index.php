<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */

require_once('FirePHPCore/fb.php');
ob_start();
fb('追踪开始！');


define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
/* 加载环境和模板 */
require('./wp-blog-header.php');


//FB::trace();
fb('运行时间：'.timer_stop(0).'s');
fb('追踪开始！');

fb(@get_defined_constants());
if (current_user_can('level_10')) {
	global $wpdb;
	fb($wpdb->queries);
}
