<?php
/**
Plugin Name: 您好世界
Plugin URI: http://www.yuzixing.com
Description: 插件的详细说明，其实也没有什么好说明的
Version: 1.0 beta
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











/*
 * **钩子应用实例**
//plugins_loaded:系统环境准备好了，系统插件也挂载完成了，开始执行插件之前
add_action( 'plugins_loaded', 'boj_footer_message_plugin_setup' );
function boj_footer_message_plugin_setup() {
	add_action( 'wp_footer', 'boj_example_footer_message', 100 );
}
function boj_example_footer_message() {
	echo '基于 <a href="http://wordpress.org" >WordPress </a>架设。';
}

//admin_head:生成后台模板head标签时创建
add_action( 'admin_head', 'add_css' );
function add_css(){
//不建议这样写哦
	echo '<link media="all" type="text/css" href="'.plugins_url('css/add_css.css', __FILE__).'" rel="stylesheet">';
}

//为后台增加子菜单
add_action( 'admin_menu', 'boj_admin_settings_page' );
function boj_admin_settings_page() {
	add_options_page(
		'BOJ Settings',
		'菜单栏项名',
		'manage_options',
		'boj_admin_settings',//链接文件名page=boj_admin_settings
		'boj_admin_settings_page'
	);
}

//template_redirect:前台模板切换时触发
//以下是为is_singular指定的模板加载样式表
add_action( 'template_redirect', 'boj_singular_post_css' );
function boj_singular_post_css() {
	if( is_singular( 'post' ) ) {
		wp_enqueue_style (
			'boj-singular-post',
			'boj-example.css',
			false,
			0.1,
			'screen'
		);
	}
}
//wp_title:<head></head>之间的内容
add_filter( 'wp_title', 'boj_add_site_name_to_title', 10, 2 );
function boj_add_site_name_to_title( $title, $seq ) {
	$name = get_bloginfo( 'name' );
	$title .= $seq.' , '.$name;
	return $title;
}
//the_content:过滤post和page单篇文章【类似这样的称为元标签，WP中每个元标签都有apply_filter()】
add_filter( 'the_content', 'boj_add_related_posts_to_content' );
function boj_add_related_posts_to_content( $content ) {
	//fb($content);
	return $content.' by seaqi版权哦';
}
//还有the_title,the_time,the_categories

//comment_text:过滤处理评论的内容
//插件完成的功能：检查一条评论是否是网站的注册用户发表的。如果是注册用户，你可以附加一段用户信息的说明
add_filter( 'comment_text', 'boj_add_role_to_comment_text' );
function boj_add_role_to_comment_text( $text ) {//$text为评论的内容
	global $comment;
	if( $comment -> user_id > 0 ) {
		$user = new WP_User( $comment -> user_id );
		if( is_array( $user -> roles ) )//如果用户有一个角色，添加到评论内容中
			$text .= '<p>User Role: ' .$user -> roles[0]. '</p>';
	}
	return $text;
}

//与类方法绑定，方法一
class jiji{
	public function test($text){
		return $text.'abc';
	}
}
$ohoh = new jiji;
add_filter( 'comment_text', array( &$ohoh, 'test' ));

//与类方法绑定，方法二
class jiji{
	function __construct(){
		add_filter( 'comment_text', array( &$this, 'test' ));
	}
	public function test($text){
		return $text.'abc';
	}
}
new jiji;



//如何创建一个新的钩子，创建钩子的原则！！！



*/
























