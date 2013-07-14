<?php
/**
 *
1.index.php->wp-blog-header.php->wp-load.php->wp-config.php->wp-setting.php
从wp-setting.php开始：载入初始化文件及环境

2.default-constants.php定义全局可覆盖的常量【强制常量】
在配置文件里面能手动定义系统中的任何常量！
比如：WP_CONTENT_URL,WP_PLUGIN_DIR,WP_PLUGIN_URL,COOKIEHASH,系统默认模板,是否开启缓存,调试模式等
这些常量在系统中明确的声明了,但在任何default-constants.php这个文件定义之前声明均有效！

3.table_prefix是全局允许的唯一变量
兼容整个系统中的$_SERVER数组的值



WP初始化过程：
基本过程是index.php ->wp-blog.header.php ->wp-load.php
通过wp-load.php 先后包含了wp-config.php, wp-setting.php,classes.php,fucntions.php query.php等文件,

建 立变量：在wp-setting.php文件中建立了三个全局变量,$wp_the_query,$wp_rewrite和$wp ,
分别为WP_Query,WP_Rewrite和WP类的实例,另外建立了一个$wp_query=&$wp_the_query,
$wp_the_query = & new WP_Query();
$wp_query     = & $wp_the_query;
$wp_rewrite   = & new WP_Rewrite();
$wp           = & new WP();

!!!(之所以这样做是为了通过$query_posts等方式新建自定义查询时不会损坏WP主循环,
在自定义查询结束后可以调用$wp_reset_query把$wp_query还原为$wp_the_query引用). 

然后,wp-blog-header执行wp()函数,并通过其调用$wp所属WP类的main方法,这个方法又调用一系列方法




wordpress启动过程

本文的侧重点是：展示和解读WordPress从启动(即从index.php入口进入)到在网页上展示模板和内容的过程。这个过程可以分为3个阶段:
一是初始化阶段，即初始化常量、环境、加载核心文件等等；
二是内容处理阶段，即根据用户的请求调用相关函数获取和处理数据，为前端展示准备数据；
三是主题应用阶段，在这个阶段，需要展示的数据已经准备完毕，需要根据用户的请求加载相应的主题模板，即对主题进行路由。
经过这三各阶段，用户请求的页面就可以完全的展现出来了~_~

初始化阶段
从WordPress入口(大部分情况下是index.php)进入，到这部分结束为止，我们看到WordPress主要做了如下几件事情：
定义常量和全局变量；
设置环境参数；
进行初始化判断(例如WordPress是否已经安装)；
加载WordPress核心文件；
处理action和filter相关事务；
创建功能对象(如$wp,$wp_rewrite等)；
因而这一阶段可以看作是WordPress的初始化阶段。


WordPress的初始化阶段是一个相当繁琐的过程，详细见如下列表：
定义 WP_USE_THEMES 常量，当该常量定义为 false 时，即不使用主题，站点会显示为空白,为 true 时则正常显示。
设置 $wp_did_header 变量，相当于一个 flag ，确保每次刷新时 wp-blog-header.php 文件只执行一次。
设置 WordPress 目录的绝对路径 ABSPATH。
设置错误报告模式。
在wp-config.php文件中设置可配置项。
定义 WPINC 常量，版本相关变量，并对这些变量进行赋值。
调用 wp_initial_constants() 函数，初始化常量 WP_MEMORY_LIMIT, WP_DEBUG, WP_CONTENT_DIR 和 WP_CACHE。

关闭运行期的魔术引用，魔术引用稍后将在 wp-settings.php 中通过 wpdb 添加。
//magic_quotes_runtime,magic_quotes_sybase

设置 PHP5 的默认时区。

调用 wp_unregister_GLOBALS() 函数禁用 register_globals。
unset 全局变量 $wp_filter, $cache_lastcommentmodified, $cache_lastpostdate，以确保他们不会存在。
调用函数 wp_fix_server_vars() 兼容规范 $_SERVER 变量设置。
调用函数 wp_check_php_mysql_versions() 检查所需的 PHP 版本和 MySQL 扩展或数据库 drop-in。
调用函数 wp_favicon_request() 检查是否收到由于缺少 favicon.ico 的而产生请求。
检查是否处于维护模式，或者判断当前是否在升级进入维护状态
开启加载计时器。
检查是否处于 WP_DEBUG 模式。
根据 WP_CACHE 和 WP_DEBUG 常量判断是否载入以及以何种方式载入文件：
WP_CONTENT_DIR/advanced-cache.php，属于drop-in，供高级的缓存插件使用。
调用 wp_set_lang_dir() 函数设置常量 WP_LANG_DIR。


加载兼容性函数库，以function_exist()为判断
加载wp主要函数库，Main WordPress API
加载wp环境设置类
加载//插件类plagin.php


调用 require_wp_db() 函数，引入 wpdb 类，或者数据库 drop-in db.php (如果存在的话)。
调用 wp_set_wpdb_vars() 函数，设置数据库表前缀和数据库表列的格式说明符
调用 wp_start_object_cache() 函数，开启WP对象缓存，或者扩展对象缓存（如果相应 drop-in 存在的话）。


加载WP文件：
WPINC/default-filters.php，为 WP 中的钩子设置默认的 action 和 filter；
如果开启了多站点，则加载文件，否则设置常量 MULTISITE 为 false:
WPINC/ms-blogs.php，定义一组 Site/blog 函数，用于操作 blogs 表及相关数据；
WPINC/ms-settings.php（涉及多站点的文件暂不考虑）。
————如果只需要基本功能（即 SHORTINIT 常量为真），则 wp-setting.php 文件执行到此即返回！————
调用 wp_not_installed() 函数，如果还没有安装 WP，则启动安装程序。



加载 WP 的*大头（most of WP）*：
WPINC/capabilities.php，定义一组类WP_Roles, WP_Role, WP_User和函数，用于操作角色和权限；
WPINC/post.php，定义一组文章相关的函数，并添加 add_action('init','create_initial_post_types', 0 )；
WPINC/rewrite.php，定义一组 WP 的重写 API 以及 WP_Rewrite 类，用于重写链接的格式；并且该文件还定义了一组常量 EP_NONE，EP_PERMALINK，EP_ATTACHMENT，EP_DATE，EP_YEAR，EP_MONTH，EP_DAY，EP_ROOT，EP_COMMENTS，EP_SEARCH，EP_CATEGORIES，EP_TAGS，EP_AUTHORS，EP_PAGES，EP_ALL；
WPINC/kses.php，定义一组 HTML/XHTML 的过滤器 API，并定义一组标签数组，添加了两个action：add_action(‘init','kses_init');add_action(‘set_current_user','kses_init');
WPINC/script-loader.php，WP 中脚本和样式表的默认加载器 API，并加载了如下文件：
/class.wp-styles.php，定义类 WP_Styles，继承自 WP_Dependencies，用于反压样式表队列；
并添加了如下的 action 和 filter：
add_action('wp_default_scripts','wp_default_scripts' );
add_filter('wp_print_scripts','wp_just_in_time_script_localization' );
add_filter('print_scripts_array','wp_prototype_before_jquery' );
add_action('wp_default_styles','wp_default_styles' );
add_filter('style_loader_src','wp_style_loader_src', 10, 2 );

WPINC/update.php，定义一组 API 用于检查版本升级信息，添加了一组action，并进行事件调度：
add_action('admin_init','_maybe_update_core' );
add_action('wp_version_check','wp_version_check' );
add_action('load-plugins.php','wp_update_plugins' );
add_action('load-update.php','wp_update_plugins' );
add_action('load-update-core.php','wp_update_plugins' );
add_action('admin_init','_maybe_update_plugins' );
add_action('wp_update_plugins','wp_update_plugins' );
add_action('load-themes.php','wp_update_themes' );
add_action('load-update.php','wp_update_themes' );
add_action('load-update-core.php','wp_update_themes' );
add_action('admin_init','_maybe_update_themes' );
add_action('wp_update_themes','wp_update_themes' );
WPINC/canonical.php，定义一组重定向规范函数，用于处理 WP 中重定向，并添加 action：
add_action(‘template_redirect','redirect_canonical');
WPINC/shortcodes.php，定义一组 WP 的简码 API，并定义数组 $shortcode_tags，添加 filter：
add_filter(‘the_content','do_shortcode', 11);
WPINC/media.php，定义一组媒体（视频、图片等）显示相关的 API 和类 WP_Embed，并创建 $wp_embed = new WP_Embed() 变量，添加简码：
add_shortcode(‘wp_caption','img_caption_shortcode');
add_shortcode(‘caption','img_caption_shortcode');
add_shortcode(‘gallery','gallery_shortcode');
WPINC/widgets.php，定义一组创建动态侧边栏的 API 和类 WP_Widget，WP_Widget_Factory，并定义了一组全局变量；




加载多站点特定文件：
WPINC/ms-functions.php，
WPINC/ms-default-filters.php，
WPINC/ms-deprecated.php。
调用 wp_plugin_directory_constants() 函数，定义依赖于API获取默认值的常量，定义必须使用的插件文件夹常量，后者可能会在 sunrise.php drop-in 中被覆盖。
利用函数 wp_get_mu_plugins() 加载必须使用的插件，并触发挂载点 do_action('muplugins_loaded' );
调用函数 ms_cookie_constants() 为多站点设置 cookie 常量。
调用函数 wp_cookie_constants() 在多站点加载后定义常量，cookie 相关的常量可能会在 ms_network_cookies() 中被覆盖。
调用函数 wp_ssl_constants() 定义和执行 SSL 常量。
加载文件创建公共全局变量：
WPINC/vars.php，为 WP 的剩余部分创建公共变量。
调用函数 create_initial_taxonomies() 和 create_initial_post_types() 使分类和文章对插件和主题可见。插件作者需要注意：这些在初始化 hook 时会被再次注册。
利用函数 wp_get_active_and_valid_plugins() 加载已激活的插件。
调用函数 wp_set_internal_encoding() 设置内部编码。
如果 WP_CACHE 开启并且 wp_cache_postload() 函数存在，则调用该函数。
触发挂载点 do_action('plugins_loaded' )。
调用函数 wp_functionality_constants() 定义那些尚未被定义但会影响功能的常量。
调用函数 wp_magic_quotes() 添加魔术引用并装配 $_REQUEST ( $_GET + $_POST )。
触发挂载点 do_action('sanitize_comment_cookies' )（无害的评论 cookie）。
创建全局的WP查询对象 $wp_the_query =& new WP_Query()，并保存 $wp_the_query 的引用到 $wp_query，使用 $wp_query 进行查询。
创建 WP 的重写对象 $wp_rewrite =& new WP_Rewrite()，以创建漂亮的 URLs。
创建WP对象 $wp =& new WP()。
创建 WP Widget 工厂对象 $wp_widget_factory =& new WP_Widget_Factory()。
触发挂载点 do_action('setup_theme' )。
调用函数 wp_templating_constants() 设置模板相关常量。
调用函数 load_default_textdomain() 加载默认的文本本地化域。
找到博客区域设置 $locale = get_locale()。
创建本地化对象 $wp_locale =& new WP_Locale() 用以加载本地化域数据和各种字符串。
加载激活的主题的函数库文件：
TEMPLATEPATH/functions.php，加载模板自带函数。
触发挂载点 do_action('after_setup_theme' )。
注册关闭函数 register_shutdown_function('shutdown_action_hook' )。
建立当前用户 $wp->init()。
触发挂载点 do_action('init' )，在这个阶段WP 的大部分已被加载，用户也已认证。WP 会继续加载 init 钩子上的挂载者，如widgets和各种插件实例。如果你想在WP加载后插入一个action，请使用下面的 wp_loaded 钩子。
如果是多站点，则检查站点的状态。
触发挂载点 do_action(‘wp_loaded')，当WP、所有插件以及主题都被完全加载和实例化后，该钩子将被解除。Ajax请求应该使用 wp-admin/admin-ajax.php，admin-ajax.php 能够处理未登录用户的请求。



内容处理阶段
在这一阶段，调用wp()函数对数据库内容进行查询，并将查询的内容赋值给一些全局变量，方便在模板中使用模板标签获取相应的数据并展示在前端。
调用 wp() 函数。
调用 $wp->main() 函数。
初始化，调用wp_get_current_user()函数(pluggable.php中)，获取当前用户信息，即设置全局变量$current_user。
调用parse_request()函数，对查询参数进行解析。
调用send_headers()函数，发送附加的http头信息。
调用query_posts()函数，进行查询操作。
调用handle_404()函数，处理404错误。
调用register_globals()函数，注册全局变量。
调用do_action_ref_array()函数(在wp-includes/plugin.php文件中)，设置本对象作为wp钩子上的函数的参数。

 
主题应用阶段
WordPress主题的路由和加载主要在 WPINC/template-loader.php 文件中进行，该文件相当于是一个模板加载的路由器，根据 url 加载相应的模板。
如果 WP_USE_THEMES 常量为真，则触发挂载点 do_action(‘template_redirect');
根据判断函数is_robots(), is_feed() 和 is_trackback()的返回结果，处理 feeds 和 trackbacks，即使没有使用任何主题；
如果 WP_USE_THEMES 常量为真，则根据下列判断函数的结果，调用相应函数获取主题：
is_404()–>get_404_template()
is_search()–>get_search_template()
is_tax()–>get_taxonomy_template()
is_front_page()–>get_front_page_template()
is_home()–>get_home_template()
is_attachment()–>get_attachment_template()
is_single()–>get_single_template()
is_page()–>get_page_template()
is_category()–>get_category_template()
is_tag()–>get_tag_template()
is_author()–>get_author_template()
is_date()–>get_date_template()
is_archive()–>get_archive_template()
is_comments_popup()–>get_comments_popup_template()
is_paged()–>get_paged_template()
Other–>get_index_template()
如果对主题应用filter成功 apply_filters('template_include', $template )，则加载该主题。
模板路由完成以后，被调用的模板会被加载，模板中的模板标签也会访问在内容准备阶段所设置的全局变量，获取所需的数据，并且将这些数据输出到模板中，最终完成样式+内容在前端的显示！
 * 
 */