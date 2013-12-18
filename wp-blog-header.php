<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( !isset($wp_did_header) ) {

	$wp_did_header = true;

	//系统初始化
	require_once( dirname(__FILE__) . '/wp-load.php' );

	//内容准备
	wp();
	//查询对象$wp_the_query === $wp_query
	//执行$wp->main( $query_vars );执行以下动作
	/*  wp();将执行WP::main()
	 * 	function main($query_args = '') {
		//获取当前用户到全局：$current_user中
		$this->init();
		//解析，路由parse_request方法, 
		$this->parse_request($query_args);
		//手动发送header??为何
		$this->send_headers();
		//WP从这里开始解析URL并建立主循环。按照url进行查询并获取正确内容
		$this->query_posts();
		//从数据库的层面告诉客户端当前的请求将返回一种什么状态，404，200.。。。
		$this->handle_404();
		//注册全局,将从数据库取得的所有信息内容，存储到相应的全局变量
		//
		$this->register_globals();
		//创建钩子
		do_action_ref_array('wp', array(&$this));
	}
	 */
	//注册全局
	//fb($wp_query->query_vars);//['category_name'] =>'xxyizhan'
	/*
	foreach ( (array) $wp_query->query_vars as $key => $value) {
		$GLOBALS[$key] = $value;
	}
	$GLOBALS['query_string'] = $this->query_string;
	$GLOBALS['posts'] = & $wp_query->posts;
	$GLOBALS['post'] = (isset($wp_query->post)) ? $wp_query->post : null;
	$GLOBALS['request'] = $wp_query->request;
	*/
	//fb($GLOBALS['query_string']);//category_name=xxyizhan
	//fb($GLOBALS['posts']);//因查询而生成的首个WP_Post对象
	//fb($GLOBALS['post']);//因查询而生成的所有WP_Post对象
	//fb($GLOBALS['request']);//SELECT SQL_CALC_FOUND_ROWS wp_posts.ID FROM wp_posts INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN (4,10) ) AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 10
	
	

	//主题应用阶段
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