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
小工具注册事件：
这里使用 widgets_init 动作钩子。
这个钩子在默认的小工具注册到 WordPress 中之后被触发。


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
//在插件开始载入前触发【不能直接在系统中创建一个钩子，而是要在原有钩子的基础之上创建】
add_action( 'plugins_loaded', 'boj_myplugin_setup' );
function boj_myplugin_setup() {
	do_action( 'boj_myplugin_setup_pre' );
	if( !defined( 'BOJ_MYPLUGIN_ROOT_SLUG' ) ) define( 'BOJ_MYPLUGIN_ROOT_SLUG', 'articles' );
}
//在开发新的钩子时要实现一个功能，一定要保证这个功能使用这个挂载到此钩子的功能有修改的权限

//变量钩子：
//一个很好的例子就是 load-$pagenow 动作钩子。变量 $pagenow 根据 WordPress 中当前浏览的 admin 页面而改变。
//do_action( "load-$pagenow" );
//变量 $pagenow 会变成当前访问页面的名字。例如 new post 页面的钩子是 load-post-new.php，而编辑页面的是 load-post.php。
//这就使得插件仅仅对特定的 admin 页面执行代码。WordPress 有几个动作和过滤器钩子的名称里面是含有变量的。
//通常，这些钩子的名字变成给定的内容，使得插件开发者可以在特定的环境下执行代码。
*/





/*
//***为后台添加顶级菜单
//为后台添加顶级菜单【add_menu_page不能裸奔】
//经测试：add_menu_page()此函数所在文件，只有当add_action('admin_menu')才会被加载，否则此函数是不存在的！！！
//add_menu_page( page_title, menu_title, capability, menu_slug, function, icon_url, position );
//add_menu_page() 所接受的参数：
//    page_title – 页面的 title, 和显示在 <title> 标签里的一样
//    menu_title – 在控制面板中显示的名称
//    capability – 要浏览菜单所要的最低权限
//    menu_slug – 要引用该菜单的别名; 必须是唯一的
//    function – 点击后，显示在主区域的函数，即点击才会触发
//    icon_url – 菜单的 icon 图片的 URL
//    position – 出现在菜单列表中的次序
add_action('admin_menu', 'register_admin_menu01', 1);
function register_admin_menu01($param) {//$param空参数
	add_menu_page(
		'产品展示', //点击进去后的title标题
		'产品', //当前显示的链接名
		'edit_others_posts', //权限
		'hello_world', //链接将生成?page=hello_world
		'goods', //触发的函数
		plugins_url('images/matchalabs.png', __FILE__), 
		26
	);
}
function goods(){echo '点击触发后，显示在这个区域的内容';}



//***为后台子菜单项
//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
//parent_slug-父级菜单项的别名
//page_title--页面的title信息
//menu_title-菜单标题
//capability-权限
//menu_slug-别名
//function-执行的函数
add_action ( 'admin_menu', 'boj_menuexample_create_menu' );
function boj_menuexample_create_menu() {
add_menu_page (// 创建顶级菜单【顶级菜单也就是第一个子菜单】
		'产品展示',
		'所有产品',
		'manage_options',//权限
		'all_products',
		'function001',//触发函数
		plugins_url ( 'images/matchalabs.png', __FILE__ ),
		1000//位置排序
);
add_submenu_page (// 创建子菜单
		'all_products',//父菜单别名
		'管理产品',
		'管理产品',
		'manage_options',//权限
		'ma_product',
		'function002'//触发函数
);
add_submenu_page (// 创建子菜单
		'all_products',//父菜单别名
		'添加产品',
		'添加产品',
		'manage_options',//权限
		'add_product',
		'function003'//触发函数
);
}
function function001(){echo '所有产品';}
function function002(){echo '产品管理';}
function function003(){echo '增加新产品';}
//echo $_GET['page'];


//***向已经存在的菜单中添加子菜单【特殊的子菜单】
add_action ( 'admin_menu', 'boj_menuexample_create_menu' );
function boj_menuexample_create_menu() {
	add_options_page (// 在 Settings 下添加子菜单
			'title测试哦',
			'测试哦',
			'manage_options',//权限
			'set_xxx',//别名
			'boj_menuexample_settings_page'//触发的函数
	);
}

function boj_menuexample_settings_page(){}

// 下面是所有可用的添加子菜单的函数：
// add_dashboard_page//控制面板中添加
// add_posts_page//文章中添加
// add_media_page//多媒体中添加
// add_links_page//链接中添加
// add_pages_page//页面中添加
// add_comments_page//评论中添加
// add_theme_page//主题中添加
// add_plugins_page//插件中添加
// add_users_page//用户中添加
// add_management_page//工具中添加
// add_options_page//设置中添加


//***创建小工具
class My_Widget extends WP_Widget {
	function My_Widget() {
		//processes the widget  构造函数
	}
	function form( $instance ) {
		//在管理面板中显示小工具的表单
	}
	function update( $new_instance, $old_instance ) {
		//小工具选项的保存过程
	}
	function widget( $args, $instance ) {
		//显示小工具
	}
}
*/

//创建小工具
// boj_widgetexample_widget_my_info class
class boj_widgetexample_widget_my_info extends WP_Widget {
	// 开始处理小工具process the new widget
	function __construct() {
		$widget_ops = array(
				'classname' => 'widget_style',//边栏的class名
				'description' => '小工具下面的描述'
		);// $widget_ops 来存储小工具的选项
		$this->WP_Widget( 'boj_widgetexample_widget_my_info', '小工具名称', $widget_ops );
	}
	// 创建小工具的设置表单
	function form($instance) {//$instance原来的保存值
		$defaults = array( 'title' => '标题', 'movie' => '电影', 'song' => '歌曲' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$movie = $instance['movie'];
		$song = $instance['song'];
		?>
<p>
	<label for="widget-title01">Title: </label><input id="widget-title01"
		class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>"
		type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="widget-title02">Favorite Movie: </label><input
		id="widget-title02" class="widefat"
		name="<?php echo $this-> get_field_name( 'movie' ); ?>" type="text"
		value="<?php echo esc_attr( $movie ); ?>" />
</p>
<p>
	<label for="widget-title03">Favorite Song: </label>
	<textarea id="widget-title03" class="widefat"
		name="<?php echo $this-> get_field_name( 'song' ); ?>"><?php echo esc_attr( $song ); ?></textarea>
</p>
<?php
    }
    
    // 保存小工具设置
    function update( $new_instance, $old_instance ) {
//         $instance = $old_instance;
//         //对数据进行过滤后保存
//         $instance['title'] = strip_tags( $new_instance['title'] );
//         $instance['movie'] = strip_tags( $new_instance['movie'] );
//         $instance['song'] = strip_tags( $new_instance['song'] );
        
        return wp_parse_args( (array) $new_instance, $old_instance );
    }
    // 显示小工具
    function widget( $args, $instance ) {
        extract( $args );
        
        echo $before_widget;
        $title = apply_filters( 'widget_title', $instance['title'] );
        $movie = empty( $instance['movie'] ) ? ' ' : $instance['movie'];
        $song = empty( $instance['song'] ) ? ' ' : $instance['song'];
 
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        echo '<p> Fav Movie: ' . $movie . '</p>';
        echo '<p> Fav Song: ' . $song . '</p>';
        echo $after_widget;
    }
}
//触发点
add_action( 'widgets_init', 'boj_widgetexample_register_widgets' );
function boj_widgetexample_register_widgets() {
	register_widget( 'boj_widgetexample_widget_my_info' );// 注册小工具【注册的是一个类】
}



//创建小工具
class boj_awe_widget extends WP_Widget {
	// process the new widget
	function boj_awe_widget() {
		$widget_ops = array ('classname' => 'boj_awe_widget_class', 'description' => 'Display an RSS feed with options.' );
        $control_ops = array( 'width'=>'300', 'height'=>'500' );/* Widget control settings. */
        //id_base_name:在样式中取名
        //$control_ops:对小工具在后台进行编辑时展开时的尺寸！！通常就是这两个元素
		$this->WP_Widget ( 'id_base_name', '高级RSS小工具', $widget_ops, $control_ops );
	}
	
	// 创建小工具的设置表单【只有保存的时候才会触发此提交】
	function form($instance) {
		$defaults = array ('title' => 'RSS Feed', 'rss_feed' => 'http://feeds2.feedburner.com/transposh', 'rss_items' => '2', 'rss_date' => 'on', 'rss_summary' => 'on' );
		$instance = wp_parse_args ( ( array ) $instance, $defaults );
		
		$title = $instance ['title'];
		$rss_feed = $instance ['rss_feed'];
		$rss_items = $instance ['rss_items'];
		$rss_date = empty($instance ['rss_date'])?'':$instance ['rss_date'];
		$rss_summary = empty($instance ['rss_summary'])?'':$instance ['rss_summary'];
		?>
<p>
	Title: <input class="widefat"
		name=" <?php echo $this->get_field_name ( 'title' ); ?>" type="text"
		value="<?php echo esc_attr ( $title ); ?>" />
</p>
<p>
	RSS Feed: <input class="widefat"
		name="<?php echo $this->get_field_name ( 'rss_feed' ); ?>" type="text"
		value="<?php echo esc_attr ( $rss_feed ); ?>" />
</p>
<p>
	Items to Display: <select
		name="<?php echo $this->get_field_name ( 'rss_items' ); ?>">
		<option value="1" <?php selected ( $rss_items, 1 ); ?>>1</option>
		<option value="2" <?php selected ( $rss_items, 2 ); ?>>2</option>
		<option value="3" <?php selected ( $rss_items, 3 ); ?>>3</option>
		<option value="4" <?php selected ( $rss_items, 4 ); ?>>4</option>
		<option value="5" <?php selected ( $rss_items, 5 ); ?>>5</option>
	</select>
</p>
<p>
	Show Date?: <input
		name=" <?php echo $this->get_field_name ( 'rss_date' ); ?>"
		type="checkbox" <?php checked ( $rss_date, 'on' ); ?> />
</p>
<p>
	Show Summary?: <input
		name=" <?php echo $this->get_field_name ( 'rss_summary' ); ?>"
		type="checkbox" <?php checked ( $rss_summary, 'on' ); ?> />
</p>
<?php
	}
	
	// 保存小工具设置【创建或保存的时就触发了】
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance ['title'] = strip_tags ( $new_instance ['title'] );
		$instance ['rss_feed'] = strip_tags ( $new_instance ['rss_feed'] );
		$instance ['rss_items'] = strip_tags ( $new_instance ['rss_items'] );
		$instance ['rss_date'] = strip_tags ( $new_instance ['rss_date'] );
		$instance ['rss_summary'] = strip_tags ( $new_instance ['rss_summary'] );
		
		return $instance;
	}
	
	// 显示小工具
	function widget($args, $instance) {
		extract ( $args );

		//fb($before_widget);//<aside id="id_base_name-17" class="widget boj_awe_widget_class">
		//fb($after_widget);//</aside>
		//fb($this->control_options);//array(['id_base'] =>'id_base_name'['width'] =>100['height'] =>100)
		
		echo $before_widget;
		// load the widget settings
		$title = apply_filters ( 'widget_title', $instance ['title'] );
		$rss_feed = empty ( $instance ['rss_feed'] ) ? '' : $instance ['rss_feed'];
		$rss_items = empty ( $instance ['rss_items'] ) ? 2 : $instance ['rss_items'];
		$rss_date = empty ( $instance ['rss_date'] ) ? 0 : 1;
		$rss_summary = empty ( $instance ['rss_summary'] ) ? 0 : 1;
		if (! empty ( $title )) {
			echo $before_title . $title . $after_title;
		}
		if ($rss_feed) {
			wp_widget_rss_output ( $rss_feed, array ('title' => $title, 'items' => $rss_items, 'show_summary' => $rss_summary, 'show_author' => 0, 'show_date' => $rss_date ) );
		}
		echo $after_widget;
	}
}
//触发点
add_action( 'widgets_init', 'boj_awe_register_widgets' );
function boj_awe_register_widgets() {
	register_widget ( 'boj_awe_widget' );
}
/*
注意：如果你要写widget你必须继承自WP_Widget类。
$this->WP_Widget('MyWidget', $options, $controls); 
有三个参数,第一个为widget的类名，第二和第三个参数都可以传数组或者是字符串。
options的值为数组array('classname'=>, description=>"")等。
$controls待定？？？？？
***以下四个变量来自于register_sidebar()注册的侧边栏，它是统一修饰整个侧边栏外观的参数***
before_widget
after_widget
before_title
after_title
*/

//创建好了小工具，还可以创建放置小工具的后台版位！
//这个版位可以在前台直接调用，所以这个与主题相关的版位定义在模板中！

function side_widgets_init() {
	register_sidebar ( array (
						'name' => '自定义侧栏模块区', 
						'id' => 'sidebar-sec', 
						'description' => '可以为每种文章类型指定一个不同的小工具组合，也可以创建多个小工具区块位，这两种方式各有所长，前者复杂，后者简单',
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget' => '</aside>',
						'before_title' => '<h3 class="widget-title">', 
						'after_title' => '</h3>' )
					);
}
add_action ( 'widgets_init', 'side_widgets_init' );

//%1$s, %2$s两个参数来自系统本身下面就是对他们的描述
/*
范例中register_sidebar()里的before_widget如何设定？
怎么有 %1$s 和 %2$s 这种东西？
在此就要特别说明一下这个部份代表【"模块"与其放置的"版位"之间其实是有javascript沟通管道的】
观察一下自定义Widget类别里的widget()的$args参数可以协助我们在描绘Widget前台外观时，顺便参照当时所处容器(版位)的相关设定。
// 描述widget显示于前台时的外观
function widget( $args, $instance ) {
	// $args里可以拿到所在版位的相关信息，如before_widget、after_widget..等
	extract( $args );
	echo $before_widget;
	$myname = $instance['myname'];
	echo "<h2>$myname</h2>";        
	echo $after_widget;
}
在widget()里，会在显示名字的前后包上before_widget和after_widget，其内容就是来自register_sidebar中的同名变量设定。
而%1$s，就像printf的意思差不多，只是参数会由wp帮你放进去，主要是拿你在widget初始化时的id_base后接上流水号作为widget的id。
如果你重复拉进很多相同的Widget里同一个版位，你就会在前台发现每一个Widget输出时的ID都会接有流水号，
如果前台要进行javascript操作时，你就会发现这是很必要的。
其二参数%2$s代表的是widget的classname，它是参照在widget初始化中的classname设定。
有了这些沟通设定，我们就可以很有弹性的为自定义Widget标示上ID并且区分容器(版位)和Widget间的classname。
以我们的例子来看，假设我拉进两个「我的名字」模块到「侧栏模块区」这个版位，其输出的HTML可能就像这样：
<div id="side_ex-widget-1" class="side_ex sidebar_frm"><h2>Audi Lu</h2></div>
<div id="side_ex-widget-2" class="side_ex sidebar_frm"><h2>mrmu</h2></div>
如果你删除了其中的Widget，又新增了一个Widget，它的流水号不会归零，会一直累加下去。
响应给 WordPress自定义模块(widget )及显示版位
分析结果很明显，他们就是前台版位与后台小工具模块通信的桥梁！
*/
//前台调用版位代码：
	//if ( is_active_sidebar( 'sidebar-sec' ) ) :
		//<div id="secondary" class="widget-area" role="complementary">
			//dynamic_sidebar( 'sidebar-sec' ); //版位注册ID
		//</div><!-- #secondary -->
	//endif;

/*你也可以删除widget
 * function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
 }
 add_action('widgets_init', 'unregister_default_widgets', 11);
 */


//***控制板小工具
//创建控制板的小工具，要用到wp_add_dashboard_widget()函数和wp_dashboard_setup钩子
/*
wp_add_dashboard_widget()函数接受下面的参数：
    widget_id — 添加到 widget DIV 元素的 CSS ID
    widget_name — 在小插件头部显示的名称
    callback — 被调用的用来显示插件的函数
    control_callback — 被调用的用来处理元素和提交的函数
*/
add_action ( 'wp_dashboard_setup', 'boj_dashboard_example_widgets' );
function boj_dashboard_example_widgets() {
	// 创建一个自定义的控制板小工具
	wp_add_dashboard_widget ( 
						'widget_id_str', //自定义ID号
						'你好世界信息', //标题
						'boj_dashboard_example_display', //显示内容函数
						'boj_dashoboard_example_display'//可选，配置功能函数
						);
}
//内容显示
function boj_dashboard_example_display() {
	//取出控制板小工具配置参数
	//dashboard_widget_options【数据库options的元素】
	//子内容dashboard_test_number是我自己定义的
	$widgets = get_option( 'dashboard_widget_options' );
	if(isset( $widgets['dashboard_test_number'] ) && isset( $widgets['dashboard_test_number']['items'] ) && isset( $widgets['dashboard_test_number']['items2'] )){
		echo '<p>您的配置参数为：'.$widgets['dashboard_test_number']['items'].'</p>';
		echo '<p>您的配置参数2为：'.$widgets['dashboard_test_number']['items2'].'</p>';
	} else {
		echo '<p>配置为空，请后台管理员配置一个新的数据。</p>';
	}
}
//此函数在配置时生效，主要是判断生成提交表单以及接收数据更新到数据库
//数据填写和保存
function boj_dashoboard_example_display() {
	//加载所有控制板小工具配置项数据
	if ( !$widget_options = get_option( 'dashboard_widget_options' ) )
		$widget_options = array();
	
	//取当前控制板小工具配置数据
	if ( !isset($widget_options['dashboard_test_number']) )
		$widget_options['dashboard_test_number'] = array();
	
	//提交并更新配置数据
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['dashboard_test_number']) ) {
		$number = absint( $_POST['dashboard_test_number']['items'] );
		$number2 = absint( $_POST['dashboard_test_number']['items2'] );
		$widget_options['dashboard_test_number']['items'] = $number;
		$widget_options['dashboard_test_number']['items2'] = $number2;
		update_option( 'dashboard_widget_options', $widget_options );
	}

	$number = isset( $widget_options['dashboard_test_number']['items'] ) ? (int) $widget_options['dashboard_test_number']['items'] : '';
	$number2 = isset( $widget_options['dashboard_test_number']['items2'] ) ? (int) $widget_options['dashboard_test_number']['items2'] : '';
	echo '<p><label for="comments-number">' . __('配置参数设置：') . '</label>';
	echo '<input id="comments-number" name="dashboard_test_number[items]" type="text" value="' . $number . '" size="3" /></p>';
	echo '<p><label for="comments-number">' . __('配置参数设置2：') . '</label>';
	echo '<input id="comments-number" name="dashboard_test_number[items2]" type="text" value="' . $number2 . '" size="3" /></p>';
}





//***添加meta内容框到页面编辑，元数据框 ( meta boxes )
/*
add_meta_box( $id, $title, $callback, $post_type, $context, $priority, $callback_args );//函数接受下面的参数：
	//$id：面板的的id属性(html)。
	//$title：面板标题
	//$callback--调用的函数
	//$post_type：要在编辑页面创建面板的文章类型，比如(post, page, link)自定义的文章类型等
	//$context：(可选)面板默认要显示的位置，可以使用normal\advanced\side分别为普通、高级(貌似跟普通效果差不多)、边栏
	//$priority：(可选)显示的优先级，可以使用high\core\default\low 如果设置为high那么它会显示在默认的那些自定义字段、评论、作者什么的前面
	//$callback_args：(可选、数组)要传给那个$callback函数的参数
*/
//为面板添加自定义面板【显示】
add_action ( 'add_meta_boxes', 'create_meta_box2post' );
$new_meta_boxes = array (
		"keywords" => array ("name" => "keywords", "title" => "关键字:", "std" => "默认关键字", "type" => "input" ),
		"description" => array ("name" => "description", "title" => "网页描述:", "std" => "默认网页描述", "type" => "text" )
	);
function new_meta_boxes() {
	global $post, $new_meta_boxes;
	//fb(get_metadata('post', $post->ID));
	$metadata = array();
	$key_str = '无关键字';
	$des_str = '无网页描述';
	$metadata = get_metadata('post', $post->ID);
	
	if(isset($metadata[$new_meta_boxes['keywords']['name'].'_value']))
	$key_str = implode(',', $metadata[$new_meta_boxes['keywords']['name'].'_value']);
	if(isset($metadata[$new_meta_boxes['description']['name'].'_value']))
	$des_str = implode(',', $metadata[$new_meta_boxes['description']['name'].'_value']);
	
	foreach ( $new_meta_boxes as $meta_box ) {
		$meta_box_value = get_post_meta ( $post->ID, $meta_box ['name'] . '_value', true );
		if ($meta_box_value == "")
			$meta_box_value = $meta_box ['std'];
			// 提交验证信息！确保数据的来源是安全的
			
		// wp_create_nonce();// 创建唯一的令牌
		echo '<input type="hidden" name="' . $meta_box ['name'] . '_noncename" id="' . $meta_box ['name'] . '_noncename" value="' . wp_create_nonce ( plugin_basename ( __FILE__ ) ) . '" />';
		// 自定义字段标题
		echo '<h4>' . $meta_box ['title'] . '</h4>';
		// 自定义字段输入框
		if ($meta_box ['type'] == 'input')
			echo '<input type="text" name="' . $meta_box ['name'] . "_value" . '" value="' . $key_str . '" />';
		elseif ($meta_box ['type'] == 'text')
			echo '<textarea cols="60" rows="3" name="' . $meta_box ['name'] . '_value">' . $des_str . '</textarea>';
	}
}
function create_meta_box2post() {
	if (function_exists ( 'add_meta_box' )) {
		add_meta_box ( 'new-meta-boxes', '自定义模块 seo meta', 'new_meta_boxes', 'post', 'side', 'high' );
		// 测试这些参数必须要禁用、启用插件才可以
	}
}

//【保存】
add_action('save_post', 'save_postdata');
function save_postdata($post_id) {
	global $post, $new_meta_boxes;
	
	foreach ( $new_meta_boxes as $meta_box ) {
		//安全验证
		if (! wp_verify_nonce ( $_POST [$meta_box ['name'] . '_noncename'], plugin_basename ( __FILE__ ) )) {
			return $post_id;
		}
		
		//判断权限，至少要有可编辑的权限
		if ('page' == $_POST ['post_type']) {
			if (! current_user_can ( 'edit_page', $post_id ))
				return $post_id;
		} else {
			if (! current_user_can ( 'edit_post', $post_id ))
				return $post_id;
		}
		
		//保存入库
		$data = $_POST [$meta_box ['name'] . '_value'];
		
		if (get_post_meta ( $post_id, $meta_box ['name'] . '_value' ) == "")
			add_post_meta ( $post_id, $meta_box ['name'] . '_value', $data, true );
		elseif ($data != get_post_meta ( $post_id, $meta_box ['name'] . '_value', true ))
			update_post_meta ( $post_id, $meta_box ['name'] . '_value', $data );
		elseif ($data == "")
			delete_post_meta ( $post_id, $meta_box ['name'] . '_value', get_post_meta ( $post_id, $meta_box ['name'] . '_value', true ) );
	}
}



//注册自定义的类型，不一定是文章
add_action ( 'init', 'my_custom_init' );
function my_custom_init() {
	$labels = array (
			'name' => '书', 
			'singular_name' => '书本singularname', 
			'add_new' => '添加', 
			'add_new_item' => '添加一本新书', 
			'edit_item' => '编辑书', 
			'new_item' => '新书', 
			'view_item' => '浏览', 
			'search_items' => '搜索书', 
			'not_found' => '没有发现书', 
			'not_found_in_trash' => 'not_found_in_trash', 
			'parent_item_colon' => '000', 
			'menu_name' => '所有书' 
			);
	$args = array (
			'labels' => $labels, 
			'public' => true, 
			'publicly_queryable' => true, 
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true, 
			'rewrite' => true, 
			'capability_type' => 'post', 
			'has_archive' => true, 
			'hierarchical' => false, 
			'menu_position' => null, 
			'supports' => array ('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ) 
			);
	register_post_type ( 'book', $args );
}









































