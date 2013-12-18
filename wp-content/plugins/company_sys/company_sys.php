<?php
/**
Plugin Name: 企业站系统
Plugin URI: http://www.yuzixing.com
Description: 插件的详细说明，其实也没有什么好说明的
Version: 1.1 beta
Author: Seaqi
Author URI: http://www.cooldea.com
License: GPL2
	
	Copyright 2011  Montania System AB  (email : seaqi@cooldea.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/** 插件开发规范 **/
//注意：要想执行插件上的任何文件，前提必须是插件被启用，否则文件将不会被执行

//获取当前插件本地路径
//echo plugin_dir_path(__FILE__);//返回绝对路径'E:/xampp/www/wordpress/wp-content/plugins/hello-world/'
//echo plugin_dir_path( 'hello-world' );//返回相对路径'./'


//URL路径
/*
 plugins_url() — 插件目录的 URL (例如：http://example.com/wp-content/plugins)
include_url() — includes 目录的 URL (例如：http://example.com/wp-includes)
content_url() — content 目录的 URL (例如：http://example.com/wp-content)
admin_url() — admin 目录的 URL (例如：http://example.com/wp-admin/)
site_url() — 当前网站的 URL (例如：http://example.com)
home_url() — 当前网站首页的 URL (例如：http://example.com)

site_url() 和 home_url() 很相似，容易混淆。
site_url() 返回的是数据库中 wp_options 表里面的 siteurl 字段值。
这是指向 WordPress 核心文件的 URL。如果你的 WordPress 核心文件在你的服务器的子目录中，
比如 /wordpress，那么 site_url() 的值就会是 http://example.com/wordpress。
【即它是由URL指向wordpress文件本身】

home_url() 则从 wp_option 表中取得 home 字段的值。
这个地址是你希望访问你的 WordPress 网站的 URL 地址。
例如，你的 WordPres 核心文件放在 /wordpress 目录下，但是你希望你的 URL是 http://example.com，
那么就要把 home 的值设置成 http://example.com。

重点函数：
plugins_url() 函数在写 WordPress 插件的时候很有用。这个函数可以确定在插件目录下的任何文件的完全 URL。
参数：
$path — (string)(可选) — 相对于 插件 URL 的路径
$plugin — (string)(可选) — 要相对的插件文件(如果是自己，就传 __FILE__ )

例如：要在插件中引用一个图片文件，可以这样子：
echo '<img src="'.plugins_url('images/icon.png', __FILE__). '"/>';
第一个参数是要用到的图片文件的相对路径。
第二个参数是要取相对路径时的参考文件，本例中直接是 —__FILE__。上面的代码会生成下面的 HTML 标签：
<img src="http://example.com/wp-content/plugins/my-custom-plugin/images/icon.png"/>

插件启用事件：
register_activation_hook( $file, $function );
$file — (string)(必须) — 主插件文件的路径。
$function — (string)(必须) — 当插件启用时要执行的函数。

register_activation_hook( __FILE__, 'hello_world_install');
function hello_world_install() {
if( version_compare( get_bloginfo( 'version' ), '4.0', '<' ) ) {
//deactivate_plugins( basename( __FILE__ )); //禁用插件
//这里我们可以判断兼容性，也可以为当前插件设置默认项
}
}
插件禁用事件：
register_deactivation_hook( __FILE__, 'boj_myplugin_uninstall' );
function boj_myplugin_unstall() {
// 执行内容
}
插件御载事件：
register_uninstall_hook( __FILE__, 'boj_myplugin_uninstaller' );
function boj_myplugin_uninstaller() {
delete_option( 'boj_myplugin_options' );// 删除插件创建的选择，表等等
}
*/


//企业网站的开发，
/**
 * 1.整理原系统中的功能，将用不上的功能去除
 * 2.添加企业系统必要的功能块
 * 3.为系统定制模板
 */

// ****整理控制面板
function example_remove_dashboard_widgets() {
	global $wp_meta_boxes;// Globalize the metaboxes array, this holds all the widgets for wp-admin
	// "快速发布"
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_quick_press'] );
	// "引入链接"
	//unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_incoming_links'] );
	// "插件"
	//unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_plugins'] );
	// "近期评论"
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_recent_comments'] );
	// "近期草稿"
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_recent_drafts'] );
	// "WordPress 开发日志"
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_primary'] );
	// "其它 WordPress 新闻"
	unset ( $wp_meta_boxes ['dashboard'] ['side'] ['core'] ['dashboard_secondary'] );
	// "概况"
	unset ( $wp_meta_boxes ['dashboard'] ['normal'] ['core'] ['dashboard_right_now'] );
}
add_action ( 'wp_dashboard_setup', 'example_remove_dashboard_widgets' );

// 以下这一行代码将删除 "Welcome" 面板
//add_action ( 'load-index.php', 'remove_welcome_panel' );
function remove_welcome_panel() {
	remove_action ( 'welcome_panel', 'wp_welcome_panel' );
}

//****删除整理wedgit
add_action ( 'widgets_init', 'unregister_default_widgets');
function unregister_default_widgets() {
	//unregister_widget ( 'WP_Widget_Pages' );
	//unregister_widget ( 'WP_Widget_Calendar' );
	//unregister_widget ( 'WP_Widget_Archives' );
	//unregister_widget ( 'WP_Widget_Links' );
	//unregister_widget ( 'WP_Widget_Meta' );
	//unregister_widget ( 'WP_Widget_Search' );
	//unregister_widget ( 'WP_Widget_Text' );
	//unregister_widget ( 'WP_Widget_Categories' );
	//unregister_widget ( 'WP_Widget_Recent_Posts' );
	//unregister_widget ( 'WP_Widget_Recent_Comments' );
	//unregister_widget ( 'WP_Widget_RSS' );
	//unregister_widget ( 'WP_Widget_Tag_Cloud' );
	//unregister_widget ( 'WP_Nav_Menu_Widget' );
}

//is_admin()用以判断当前是否处于管理面板页面
//****整理侧边栏主菜单
if (is_admin ()) {
	// 删除左侧菜单
	add_action ( 'admin_menu', 'remove_menus' );
}
function remove_menus() {
	global $menu;
	//$restricted = array (__ ( 'Dashboard' ), __ ( 'Posts' ), __ ( 'Media' ), __ ( 'Links' ), __ ( 'Pages' ), __ ( 'Appearance' ), __ ( 'Tools' ), __ ( 'Users' ), __ ( 'Settings' ), __ ( 'Comments' ), __ ( 'Plugins' ) );
	$restricted = array (  __ ( 'Settings' ), __ ( 'Comments' ) );
	end ( $menu );
	while ( prev ( $menu ) ) {
		$value = explode ( ' ', $menu [key ( $menu )] [0] );//解决有提示信息的特殊链接
		if (in_array ( $value [0] != NULL ? $value [0] : "", $restricted )) {
			//unset ( $menu [key ( $menu )] );
		}
	}
}

//****去除子菜单
global $current_user;
if (is_admin ()) {
	add_action ( 'admin_init', 'remove_submenu' );
}
function remove_submenu() {
	// 去除的方法就是功能所在的文件名
	// 删除"设置"-"隐私"
	//remove_submenu_page ( 'options-general.php', 'options-privacy.php' );
	// 删除"外观"-"编辑"
	//remove_submenu_page ( 'themes.php', 'theme-editor.php' );
	// 插件-安装插件
	remove_submenu_page ( 'plugins.php', 'plugin-install.php' );
}
/*
    0 级对应 订阅者
    1 级对应 投稿者
    2 – 4 级对应 作者
    5 – 7 级对应 编辑
    8 – 10 级对应 管理员
 */


//****关闭自动保存的功能
//这个功能一方面直接将他们删除掉，另一方面正常使用，再发布后再用插件清理即可
//还有一个更好的功能，即编辑时正常使用，文章发布后自动完成清理工作
add_action ( 'wp_print_scripts', 'disable_autosave' );
function disable_autosave() {
	//wp_deregister_script ( 'autosave' );
}


//****修改会员登录跳转，WordPress替换登陆后的默认首页
add_filter("login_redirect", "my_login_redirect");
function my_login_redirect($redirect_to){
	if( !empty( $redirect_to ) && ($redirect_to == 'wp-admin/' || $redirect_to == admin_url()) )
		return home_url("/wp-admin/edit.php");
	else
		return $redirect_to;
}


//关闭一些更新提示?????
// remove_action( 'admin_init', '_maybe_update_core' );
// remove_action( 'admin_init', '_maybe_update_plugins' );
// remove_action( 'admin_init', '_maybe_update_themes' );


















//****添加导航菜单
//首先，为主题注入两个菜单
register_nav_menus ( 
		array (
			'side-menu' => __ ( '侧边栏副菜单' ), 
			'footer-menu' => __ ( '底部副菜单' ) 
			) 
		);
//其次，将菜单附加到前台html中【我们可以用钩子向主题中注入，也可以直接在主题中调用函数即可】
add_action('wp_footer', 'add_new_nav');
function add_new_nav(){
	wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 2) );
	
	
	//添加一个重新定义的菜单
	echo '<ul id="menu">';
	//解说：
	/*
	get_terms(),其中category,link_category,nav_menu,post_tag等都同一个数据类型
	*/
	$terms = get_terms(array('category', 'link_category'), 'orderby=name&hide_empty=0' );// 获取分类
	$count = count($terms);// 获取到的分类数量
	if($count > 0){
		// 循环输出所有分类信息
		foreach ($terms as $term) {
			echo '<li><a href="'.get_term_link($term, $term->slug).'" title="'.$term->name.'">'.$term->name.'</a></li>';
		}
	}
	echo '</ul>';
}

//****添加功能
add_action ( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );
function example_add_dashboard_widgets() {
	wp_add_dashboard_widget ( 'custom_help_widget', '企业系统帮助', 'custom_dashboard_help' );
}
function custom_dashboard_help() {
	echo '这里填使用说明的内容，可填写HTML代码';
	echo '<p><ol>
			<li>投稿，请依次点击 文章 - 添加新文章，点击 &quot;送交审查&quot;即可提交</li>
			<li>修改个人资料，请依次点击 资料 -我的资料</li>
			<li>请认真填写“个人说明”，该信息将会显示在文章末尾</li>
			<li>有事请与我联系，Email:xiayouqiao2008@gmail.com&nbsp;&nbsp;&nbsp;QQ: 980522557</li>
		</ol></p>';
}















add_filter('pre_term_name', 'gggg', 10 , 2);
function gggg($d1, $d2){
	return $d1.$d2;
}

$str1 = 'sssss';
$str2 = 'tttt';

//fb(apply_filters('pre_term_name', $str1, $str2));


add_action('shutdown', 'gggg0');
function gggg0(){
	//echo '不好意思，程序发生了一个致命的错误，我想我应该做点什么';
}
// $a = new FooClass();


add_action( 'after_setup_theme', 'aaaaa' );
function aaaaa(){
 	global $wp;
 	$wp->add_query_var('abcd');
}










add_filter('accachment_icon', 'jjjj');
function jjjj(){
	fb(func_get_args());
}








