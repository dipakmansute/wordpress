<?php
/**
 * Used to set up and fix common variables and include
 * the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package WordPress
 */

/**
 * Stores the location of the WordPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
define( 'WPINC', 'wp-includes' );

// Include files required for initialization.
//载入系统级函数：系统常量修正、禁用全局、计时函数、数据库连接、系统维护模式、调试、语言包目录、
//缓存、插件目录、判断管理员等，都是函数的载入而不执行
require( ABSPATH . WPINC . '/load.php' );

//常量与函数
//这种思维方式非常好，即将各种常量组合为组并对应有一个函数与之对应，当我们需要对应的常量组时，调用函数即可，而且里面所有的常量
//都可以在config中进行预先定义，如果没有定义系统会给你一个默认的值用于组建整个系统的默认模式
require( ABSPATH . WPINC . '/default-constants.php' );

//全局版本常量
require( ABSPATH . WPINC . '/version.php' );

// Set initial default constants including WP_MEMORY_LIMIT, WP_MAX_MEMORY_LIMIT, WP_DEBUG, WP_CONTENT_DIR and WP_CACHE.
//调用 wp_initial_constants() 函数，初始化常量 WP_MEMORY_LIMIT, WP_DEBUG, WP_CONTENT_DIR 和 WP_CACHE。
//开始调用并初始化系统运行基本常量【这些常量的使用都是通过函数按需加载，并且可以预先重定义】
wp_initial_constants( );

// Check for the required PHP version and for the MySQL extension or a database drop-in.
wp_check_php_mysql_versions();

// Disable magic quotes at runtime. Magic quotes are added using wpdb later in wp-settings.php.
@ini_set( 'magic_quotes_runtime', 0 );
@ini_set( 'magic_quotes_sybase',  0 );

// WordPress calculates offsets from UTC.
date_default_timezone_set( 'UTC' );

// Turn register_globals off.
//调用 wp_unregister_GLOBALS() 函数禁用 register_globals。
wp_unregister_GLOBALS();

// Standardize $_SERVER variables across setups.
//调用函数 wp_fix_server_vars() 兼容规范 $_SERVER 变量设置。
wp_fix_server_vars();

// Check if we have received a request due to missing favicon.ico
wp_favicon_request();

// Check if we're in maintenance mode.
//检查是否处于维护模式。包括升级进程600s
wp_maintenance();

// Start loading timer.
timer_start();

// Check if we're in WP_DEBUG mode./
//调试模式，有错误输出显示，保存到log文件
wp_debug_mode();

// For an advanced caching plugin to use. Uses a static drop-in because you would only want one.
//缓存接口【1.从配置文件配置。2.实现缓存接口】
if ( WP_CACHE )
	WP_DEBUG ? include( WP_CONTENT_DIR . '/advanced-cache.php' ) : @include( WP_CONTENT_DIR . '/advanced-cache.php' );

// Define WP_LANG_DIR if not set.
//设置默认语言相关常量
wp_set_lang_dir();

//以上过程完成了对系统的基本调整的测试的过程





// Load early WordPress files.
//载入兼容函数库【整理对各版本的PHP之间存在的差异，比如补全旧版本不存在的函数】
//它们是，字符串截取，加密函数，json处理
require( ABSPATH . WPINC . '/compat.php' );

//载入wp主要函数库，Main WordPress API，专门为wp系统设计的函数
//包括一些option.php对options表进行的处理，及为wp创建的全新的函数，这些函数很有含金量牛X
require( ABSPATH . WPINC . '/functions.php' );

//载入wp环境设置类WP对查询变量做了处理，WP_MatchesMapRegex？？？
require( ABSPATH . WPINC . '/class-wp.php' );

//载入系统错误处理类WP_Error
require( ABSPATH . WPINC . '/class-wp-error.php' );

//载入与动作钩子相关的函数集
require( ABSPATH . WPINC . '/plugin.php' );

//载入翻译类，按顺序分别是Translation_Entry，Translations，POMO_Reader，MO
require( ABSPATH . WPINC . '/pomo/mo.php' );


// Include the wpdb class and, if present, a db.php database drop-in.
//载入数据库类wpdb，并返回数据库全局对象$wpdb
require_wp_db();

// Set the database table prefix and the format specifiers for database table columns.
$GLOBALS['table_prefix'] = $table_prefix;

//设置数据库的列？
//设置数据库表前缀及设置其field_types表列对应的数据类型。
wp_set_wpdb_vars();

// Start the WordPress object cache, or an external object cache if the drop-in is present.
//启用对象缓存
wp_start_object_cache();

// Attach the default filters.
//为 WP 中的钩子设置默认的 action 和 filter
//开始依赖原生的金子系统为这个松散的系统进行组装，至少要组装出一个默认的基本架构，此处只添加了add_filter和add_action
require( ABSPATH . WPINC . '/default-filters.php' );

// Initialize multisite if enabled.
//载入多站点文件
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/ms-blogs.php' );
	require( ABSPATH . WPINC . '/ms-settings.php' );
} elseif ( ! defined( 'MULTISITE' ) ) {
	define( 'MULTISITE', false );
}

//当我们的脚本执行完成或意外死掉导致PHP执行即将关闭时,我们的这个函数将会 被调用.
//这个函数只创建了一个新动作do_action( 'shutdown' );
register_shutdown_function( 'shutdown_action_hook' );



//这是是基本功能和全功能的分隔处
// Stop most of WordPress from being loaded if we just want the basics.
if ( SHORTINIT )
	return false;

// Load the L10n library.
//载入与翻译相关的所有函数，即翻译API
require_once( ABSPATH . WPINC . '/l10n.php' );

// Run the installer if WordPress is not installed.
//通常查询数据库，判断程序是否安装，如果没有安装则进行安装
wp_not_installed();

// Load most of WordPress.
//载入一个树类
require( ABSPATH . WPINC . '/class-wp-walker.php' );
//发送XML响应回AJAX请求类
require( ABSPATH . WPINC . '/class-wp-ajax-response.php' );
//载入格式化函数集合
require( ABSPATH . WPINC . '/formatting.php' );
///载入角色功能类
require( ABSPATH . WPINC . '/capabilities.php' );
//载入wp查询类，及与类操作相关的函数
require( ABSPATH . WPINC . '/query.php' );
///载入主题，样式表，模板相关的函数
require( ABSPATH . WPINC . '/theme.php' );
///载入专门用来处理主题的类WP_Theme
require( ABSPATH . WPINC . '/class-wp-theme.php' );
///载入模板加载函数集合
require( ABSPATH . WPINC . '/template.php' );
//载入用户查询类及与用户相关的函数集
require( ABSPATH . WPINC . '/user.php' );
//载入元数据，，，
require( ABSPATH . WPINC . '/meta.php' );
//
require( ABSPATH . WPINC . '/general-template.php' );
//
require( ABSPATH . WPINC . '/link-template.php' );
//
require( ABSPATH . WPINC . '/author-template.php' );
//
require( ABSPATH . WPINC . '/post.php' );

require( ABSPATH . WPINC . '/post-template.php' );
require( ABSPATH . WPINC . '/post-thumbnail-template.php' );
require( ABSPATH . WPINC . '/category.php' );
require( ABSPATH . WPINC . '/category-template.php' );
require( ABSPATH . WPINC . '/comment.php' );
require( ABSPATH . WPINC . '/comment-template.php' );
require( ABSPATH . WPINC . '/rewrite.php' );
require( ABSPATH . WPINC . '/feed.php' );
require( ABSPATH . WPINC . '/bookmark.php' );
require( ABSPATH . WPINC . '/bookmark-template.php' );
require( ABSPATH . WPINC . '/kses.php' );
require( ABSPATH . WPINC . '/cron.php' );
require( ABSPATH . WPINC . '/deprecated.php' );
require( ABSPATH . WPINC . '/script-loader.php' );
require( ABSPATH . WPINC . '/taxonomy.php' );
require( ABSPATH . WPINC . '/update.php' );
require( ABSPATH . WPINC . '/canonical.php' );
require( ABSPATH . WPINC . '/shortcodes.php' );
require( ABSPATH . WPINC . '/class-wp-embed.php' );
require( ABSPATH . WPINC . '/media.php' );
require( ABSPATH . WPINC . '/http.php' );
require( ABSPATH . WPINC . '/class-http.php' );
require( ABSPATH . WPINC . '/widgets.php' );

//为博客菜单专门设计
require( ABSPATH . WPINC . '/nav-menu.php' );
require( ABSPATH . WPINC . '/nav-menu-template.php' );

require( ABSPATH . WPINC . '/admin-bar.php' );

// Load multisite-specific files.
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/ms-functions.php' );
	require( ABSPATH . WPINC . '/ms-default-filters.php' );
	require( ABSPATH . WPINC . '/ms-deprecated.php' );
}

// Define constants that rely on the API to obtain the default value.
// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
//调用定义与插件相关的常量
wp_plugin_directory_constants( );

// Load must-use plugins.
foreach ( wp_get_mu_plugins() as $mu_plugin ) {
	include_once( $mu_plugin );
}
unset( $mu_plugin );

// Load network activated plugins.
if ( is_multisite() ) {
	foreach( wp_get_active_network_plugins() as $network_plugin ) {
		include_once( $network_plugin );
	}
	unset( $network_plugin );
}

//系统中第一个被执行的钩子
do_action( 'muplugins_loaded' );

if ( is_multisite() )
	ms_cookie_constants(  );




// Define constants after multisite is loaded. Cookie-related constants may be overridden in ms_network_cookies().
//调用定义cookie相关常量
wp_cookie_constants( );

// Define and enforce our SSL constants
//与安全链接有关的常量
wp_ssl_constants( );

// Create common globals.
//客户端的各种判断，$pagenow, $is_lynx, $is_gecko, $is_winIE, $is_macIE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $is_IE, $is_apache, $is_IIS, $is_iis7;
//wp_is_mobile()
require( ABSPATH . WPINC . '/vars.php' );



// Make taxonomies and posts available to plugins and themes.
// @plugin authors: warning: these get registered again on the init hook.
//调用函数 create_initial_taxonomies() 和 create_initial_post_types() 
//使分类和文章对插件和主题可见。插件作者需要注意：这些在初始化 hook 时会被再次注册。???
create_initial_taxonomies();//在这里注册了分类类型register_taxonomy()
create_initial_post_types();//在这里注册了文章类型register_taxonomy()

// Register the default theme directory root
//get_theme_root();//D:\xampp\www\wordpress/wp-content/themes
//将主题绝对路径存储在$wp_theme_directories全局变量中
register_theme_directory( get_theme_root() );


/**
 * 到此，系统的文件基本就加载完成了，下面将加载用户插件，这些插件的载入在这个位置上会有一个很好的权限：
 * 即，可以修改系统中所有的add_action和apply_filter，所以此处加载插件意义非凡
 * 在插件加载的下面加入了：plugable.php,pluggable-deprecated.php两个可替换功能函数集，更让插件具有强大的系统核心修改能力
 */
// Load active plugins.
//******载入插件！！！
foreach ( wp_get_active_and_valid_plugins() as $plugin ) {
	include_once( $plugin );
	//D:\xampp\www\wordpress/wp-content/plugins/company_sys/company_sys.php
	//D:\xampp\www\wordpress/wp-content/plugins/p3-profiler/p3-profiler.php
}
unset( $plugin );

// Load pluggable functions.
//这些是可被插件修改的系统核心函数
require( ABSPATH . WPINC . '/pluggable.php' );
require( ABSPATH . WPINC . '/pluggable-deprecated.php' );

// Set internal encoding.
//***设置PHP系统的内部编码
wp_set_internal_encoding();

// Run wp_cache_postload() if object cache is enabled and the function exists.
if ( WP_CACHE && function_exists( 'wp_cache_postload' ) )
	wp_cache_postload();

do_action( 'plugins_loaded' );

// Define constants which affect functionality if not already defined.
//为系统的一些功能加载常量：自动保存时间AUTOSAVE_INTERVAL，自动清空垃圾的天数EMPTY_TRASH_DAYS，
//开启版本控制WP_POST_REVISIONS，CRON锁定超时WP_CRON_LOCK_TIMEOUT
wp_functionality_constants( );

// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
//清理get,post为转义G,P,C,S
wp_magic_quotes();

do_action( 'sanitize_comment_cookies' );

/**
 * WordPress Query object
 * 实例化查询对象
 * @global object $wp_the_query
 * @since 2.0.0
 */
$wp_the_query = new WP_Query();

/**
 * Holds the reference to @see $wp_the_query
 * Use this global for WordPress queries
 * $wp_the_query === $wp_the_query
 * 两者完成一样，都是对WP-Query对象的引用
 * @global object $wp_query
 * @since 1.5.0
 */
$wp_query = $wp_the_query;

/**
 * Holds the WordPress Rewrite object for creating pretty URLs
 * @global object $wp_rewrite
 * @since 1.5.0
 */
$GLOBALS['wp_rewrite'] = new WP_Rewrite();

/**
 * WordPress Object
 * @global object $wp
 * @since 2.0.0
 */
$wp = new WP();

/**
 * WordPress Widget Factory Object
 * 小工具类实例化对象
 * @global object $wp_widget_factory
 * @since 2.8.0
 */
$GLOBALS['wp_widget_factory'] = new WP_Widget_Factory();

/**
 * WordPress User Roles
 * 权限角色类实例化
 * @global object $wp_roles
 * @since 2.0.0
 */
$GLOBALS['wp_roles'] = new WP_Roles();

do_action( 'setup_theme' );

// Define the template related constants.
//加载与主题相关的路径常量
wp_templating_constants(  );

// Load the default text localization domain.
//加载导入语言包.MO文件
load_default_textdomain();

//载入语言包本地化文件，
//这个文件的作用就是整合系统的语言和js等各种前端包的语言问题
$locale = get_locale();
$locale_file = WP_LANG_DIR . "/$locale.php";

if ( ( 0 === validate_file( $locale ) ) && is_readable( $locale_file ) )
	require( $locale_file );
unset( $locale_file );

// Pull in locale data after loading text domain.
//载入日期，时间，区域类WP_Locale
require_once( ABSPATH . WPINC . '/locale.php' );

/**
 * WordPress Locale object for loading locale domain date and various strings.
 * @global object $wp_locale
 * @since 2.1.0
 */
$GLOBALS['wp_locale'] = new WP_Locale();

// Load the functions for the active theme, for both parent and child theme if applicable.
//不论父主题还是子主题，都加载对应的主题functions!!!
if ( ! defined( 'WP_INSTALLING' ) || 'wp-activate.php' === $pagenow ) {
	if ( TEMPLATEPATH !== STYLESHEETPATH && file_exists( STYLESHEETPATH . '/functions.php' ) )
		include( STYLESHEETPATH . '/functions.php' );
	if ( file_exists( TEMPLATEPATH . '/functions.php' ) )
		include( TEMPLATEPATH . '/functions.php' );
}

do_action( 'after_setup_theme' );

// Set up current user.
//获取当前用户到全局变量：$current_user
$wp->init();

// global $current_user;
// fb($current_user);
// exit;

/**
 * Most of WP is loaded at this stage, and the user is authenticated. WP continues
 * to load on the init hook that follows (e.g. widgets), and many plugins instantiate
 * themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.).
 *
 * If you wish to plug an action once WP is loaded, use the wp_loaded hook below.
 */
do_action( 'init' );

// Check site status
if ( is_multisite() ) {
	if ( true !== ( $file = ms_site_check() ) ) {
		require( $file );
		die();
	}
	unset($file);
}

/**
 * This hook is fired once WP, all plugins, and the theme are fully loaded and instantiated.
 *
 * AJAX requests should use wp-admin/admin-ajax.php. admin-ajax.php can handle requests for
 * users not logged in.
 *
 * @link http://codex.wordpress.org/AJAX_in_Plugins
 *
 * @since 3.0.0
 */
do_action('wp_loaded');






