<?php
/*
 * plugins_loaded:所有插件加载完成时触发
 * init:钩子在大多数的 WordPress 都建立之后,所有内容都就绪了,插件使用这个钩子差不多可以做任何需要的事情了.
 * admin_menu:钩子在管理员页面加载的时候调用。无论何时你的插件直接在管理页面下工作，你都要用这个钩子来执行你的代码。
 * template_redirect:动作钩子很有用，选择 theme template 之前前端触发执行,因为它是 WordPress 知道用户正在浏览的页面的关键.
 * 
 * 
 */
/*
日志、页面、附件以及类别相关的动作钩子函数

add_attachment

附件文件首次加入数据库时，执行add_attachment函数。函数接收的参数：附件ID。

add_category

与create_category相同。

clean_post_cache

清除日志缓存时，执行该动作函数。函数接收的参数：日志ID。参见clean_post_cache()。

create_category

生成新类别时，执行该动作函数。函数接收的参数：类别ID。

delete_attachment

从数据库和相应链接/日志中删除某个类别后，执行该动作函数。函数接收的参数：类别ID。

delete_post

将要删除某篇日志或页面时，执行该动作函数。函数接收的参数：日志ID或页面ID。

deleted_post

删除某篇日志或页面后，执行该动作函数。函数接收的参数：日志ID或页面ID。

edit_attachment

数据库中附件文件被更新时执行该动作函数。函数接收的参数：附件ID。

edit_category

更新/编辑某个类别时（包括添加/删除日志或博客反向链接，或更新日志/博客反向链接的类别），执行该动作函数。函数接收的参数：类别ID。

edit_post

更新/编辑某篇日志或页面时（包括添加/更新评论，这会导致日志评论总数的更新），执行该动作函数。函数接收的参数：日志ID或页面ID。

pre_post_update

更新日志或页面前执行该动作函数。函数接收的参数：日志ID。

private_to_publish

当日志状态从private（私密）更改为published（公开）时，执行该动作函数。函数接收的参数：日志对象。（用以翻译日志状态的动作函数目前可用；参见wp_transition_post_status()）。

publish_page

发表页面或编辑某个状态为“published”的页面时，执行该动作函数。函数接收的参数：页面ID。（警告：该动作函数不能在WordPress 2.3以及更高版本中运行；但动作函数'transition_post_status'能够运行。更新信息：publish_page动作函数可在WordPress 2.6及之后版本中运行。）

publish_phone

通过电子邮件添加新日志后，执行该动作函数。函数接收的参数：日志ID。

publish_post

发表日志或编辑某个状态为“published”的日志时，执行该动作函数。函数接收的参数：日志ID。

save_post

新建或更新一篇日志/页面时，执行该动作函数。更新可以来自导入、日志/页面编辑框、xmlrpc或邮件日志。函数接收的参数：日志ID。

更新信息存入数据库后执行该动作函数。

注意：日志ID可能会参照日志的修改版而不是最新发布版。wp_is_post_revision可获取日志最新版的ID。

wp_insert_post

与save_post相同，更新信息存入数据库后执行该动作函数。

xmlrpc_public_post

通过XMLRPC请求发表日志，或通过XMLRPC编辑某个状态为“published”的日志时，执行该动作函数。函数接收的参数：日志ID。
评论、Ping以及引用通告相关动作钩子函数

comment_closed

尝试显示评论输入框而日志却设置为不允许评论时，执行该动作函数。函数接收的参数：日志ID。

comment_id_not_found

试图显示评论或评论输入框却未找到日志ID时，执行该动作函数。函数接收的参数：日志ID。

comment_flood_trigger

调用wp_die以阻止接收评论前，若检测到评论数量异常增多，执行该动作函数。函数接收的参数：上一次评论发表时间，当前评论发表时间。

comment_on_draft

日志为草稿状态却试图显示评论或评论输入框时，执行该动作函数。函数接收的参数：日志ID。

comment_post

评论刚被存入数据库时，执行此动作函数。函数接收的参数：评论ID，评论审核状态（"spam"，0（表示未审核），1（表示已审核））。

edit_comment

数据库中的评论被更新或编辑后，执行此动作函数。函数接收的参数：评论ID。

delete_comment

评论即将被删除前，执行此动作函数。函数接收的参数：评论ID。

pingback_post

日志新添加pingback后，执行此动作函数。函数接收的参数：评论ID。

pre_ping

执行pingback前，执行此动作函数。函数接收的参数：将要处理的日志链接数组，以及日志的“pung”设置。

trackback_post

日志新添加trackback后，执行此动作函数。函数接收的参数：评论ID。

wp_blacklist_check

执行该动作函数以判断评论是否应被禁止。函数接收的参数：评论者的名称、电子邮件、URL、评论内容、IP地址、用户代理（浏览器）。该函数可执行wp_die以拒绝评论，也可以修改某个参数以使评论中可包含用户在WordPress选项中设置的黑名单关键词。

wp_set_comment_status

评论状态发生改变时，执行此动作函数。函数接收的参数：评论ID，表明新状态的状态字符串（"delete", "approve", "spam", "hold"）。
反向链接动作钩子函数

add_link

新反向链接首次加入数据库时，执行此动作函数。函数接收的参数：链接ID。

delete_link

删除反向链接时，执行此动作函数。函数接收的参数：链接ID。

edit_link

编辑反向链接时，执行此动作函数。函数接收的参数：链接ID。
Feed动作钩子函数

atom_entry

在atom订阅中，显示某篇博客日志信息后（但关闭该日志标签前），执行此动作函数。

atom_head

在atom订阅中，显示所订阅的某个博客信息后，还未显示该博客第一篇日志前，执行此动作函数。

atom_ns

为atom订阅的根XML元素执行此动作函数（以添加命名空间）。

commentrss2_item

在评论订阅中，显示某条评论信息后（但关闭该评论的标签前），执行此动作函数。函数接收的参数：评论ID，日志ID。

do_feed_(feed)

生成订阅信息时执行此动作函数，其中的订阅指的是订阅类型（rss2，atom，rdf等）。显示订阅信息所用优先级应低于10。函数接收的参数：true（评论订阅），或false（日志订阅）。

rdf_header

在rdf订阅中，显示所订阅的博客信息后，还未显示该博客第一篇日志前，执行此动作函数。

rdf_item

在RDF订阅中，显示某篇博客日志信息后（但关闭该日志标签前），执行此动作函数。

rdf_ns

为RDF订阅的根XML元素执行此动作函数（以添加命名空间）。

rss_head

在RSS订阅中，显示所订阅的博客信息后，还未显示该博客第一篇日志前，执行此动作函数。

rss_item

在RSS订阅中，显示某篇博客日志信息后（但关闭该日志标签前），执行此动作函数。

rss2_head

在RSS2订阅中，显示所订阅的博客信息后，还未显示该博客第一篇日志前，执行此动作函数。

rss2_item

在RSS2订阅中，显示某篇博客日志信息后（但关闭该日志标签前），执行此动作函数。

rss2_ns

为RSS2订阅的根XML元素执行此动作函数（以添加命名空间）。
模板相关动作钩子函数

comment_form

在标准WordPress主题中执行此动作函数以插入评论表单。函数接收的参数：日志ID。

do_robots

模板文件选择器认为这是一个来自robots.txt的请求时，执行该动作函数。

do_rebotstxt

在do_robots函数为robots.txt文件显示“Disallow”链接前，执行此动作函数。

get_footer

加载footer.php模板文件前，模板调用get_footer函数时执行此动作函数。

get_header

加载header.php模板文件前，模板调用get_header函数时执行此动作函数。

switch_theme

更改博客主题时执行此动作函数。函数接收的参数：新主题的名称。

template_redirect

决定用以显示所请求页面的模板文件前执行此动作函数，以便插件改写对模板文件的选择。示例（仅供参考，无实际用途）：将所有请求重定向到当前主题目录下的all.php模板文件。

function all_on_one () {
	include(TEMPLATEPATH . '/all.php');
	exit;
}

add_action('template_redirect', 'all_on_one');

wp_footer

模板在博客页面的最下方附近调用wp_footer函数时执行该动作函数。

wp_head

模板调用wp_head函数时执行动作函数wp_head。wp_head通常被放在页面模板最上方<head>和 </head>之间。该动作函数不接受参数。

wp_meta

模板文件sidebar.php调用wp_meta函数以允许插件在侧边栏加入内容时，执行此动作函数。

wp_print_scripts

WordPress将已记录的JavaScript脚本输入页面的页眉部分前，执行此动作函数。
管理界面相关的动作钩子函数

activate_(插件文件名)

首次激活某插件时执行此动作函数。参见常用函数-register_activation_hook。

activity_box_end

在控制板界面上的活动框末端执行该动作函数。

add_category_form_pre

添加分类的文本框尚未显示在管理菜单的界面上时，执行此动作函数。

admin_head

在控制板的HTML版块<head>中执行此动作函数。

admin_head-(page_hook)或admin_head-(plguin_page)

在插件所生成页面的控制板的HTML版块<head>中执行此动作函数。

admin_init

加载管理界面前执行该动作函数。参见wp-admin/admin.php，wp-admin/admin-post.php，以及wp-admin/admin-ajax.php。

admin_footer

在主标签中的控制板末端执行该动作函数。

admin_print_scripts

在HTML的信息头部分执行此动作函数，以使插件将JavaScript脚本添加到所有管理界面。

admin_print_styles

在HTML的信息头部分执行此动作函数，以使插件将CSS或样式表单添加到所有管理界面。

admin_print_scripts-(page_hook) 或 admin_print_scripts-(plugin_page)

执行此动作函数，以便将JavaScript脚本输入某个由插件生成的管理页面的HTML信息头部分。使用add_management_page(), add_options_page()等函数将插件菜单选项添加到管理菜单中时，返回(page_hook)。示例如下：

function myplugin_menu() {
if ( function_exists('add_management_page') ) {
$page = add_management_page( 'myplugin', 'myplugin', 9, __FILE__, 'myplugin_admin_page' );
add_action( "admin_print_scripts-$page", 'myplugin_admin_head' );
}

check_passwords

创建新用户账号时，执行该动作函数以验证两次输入的密码是否一致。函数接收的参数：登录名数组，首次输入的密码，第二次输入的密码。

dbx_page_advanced

在管理菜单的页面编辑界面上“advanced”版块的最下方执行此动作函数。

dbx_page_sidebar

在管理菜单的页面编辑界面工具条的最下方执行此动作函数。

dbx_post_advanced

在管理菜单的日志编辑界面上“advanced”版块的最下方执行此动作函数。

dbx_post_siderbar

在管理菜单的日志编辑界面工具条的最下方执行此动作函数。WordPress 2.5或更高版本中则执行 add_meta_box()函数。

deactivate_(插件文件名)

禁用插件时执行此动作函数。

delete_user

删除用户时执行此动作函数。函数接收的参数：用户ID。

edit_category_form

添加/编辑分类表显示在界面上后（HTML表标签结束前），执行此动作函数。

edit_category_form_pre

编辑分类表显示在管理菜单界面前，执行此动作函数。

edit_tag_form

添加/编辑标签表显示在界面上后（HTML表标签结束前），执行此动作函数。

edit_tag_form_pre

编辑标签表显示在管理菜单界面前，执行此动作函数。

edit_form_advanced

在管理菜单中日志编辑框的“advanced”版块前执行此动作函数。

edit_page_form

在管理菜单中页面编辑框的“advanced”版块前执行此动作函数。

edit_user_profile

在管理菜单中用户资料的最后部分执行此动作函数。



load_(page)

加载管理菜单页面时执行此动作函数。该动作函数不能直接添加——添加管理菜单过程参见定制插件管理菜单。如果希望直接添加该函数，add_options_page和类似函数返回的值能够给出动作函数名称。

login_form

在登录框的结尾部分前执行此动作函数。

login_head

在登录界面HTML页眉部分的结尾部分前执行此动作函数。

lost_password

在“通过电子邮件找回密码”显示在登录界面前执行此动作函数。

lostpassward_form

在通过电子邮件找回密码的表格尾部执行此动作函数，使插件能够提供更多字段。

lostpassward_post

用户要求通过电子邮件找回密码时执行此动作函数，使插件能够在找回密码前修改PHP $_POST变量。

manage_link_custom_column

反向链接管理界面中出现未知列名称时执行此动作函数。函数接收的参数：列名称，链接ID。参见插件API/常用过滤器函数中的过滤器函数manage_links_columns，该函数可添加自定义列。

manage_posts_custom_column

日志管理界面中出现未知列名称时执行此动作函数。函数接收的参数：列名称，日志ID。参见插件API/常用过滤器函数中的过滤器函数manage_posts_columns，该函数可添加自定义列。（具体用法和示例参见 Scompt's tutorial ）。

manage_pages_custom_column

页面管理界面中出现未知列名称时执行此动作函数。函数接收的参数：列名称，页面ID。参见插件API/常用过滤器函数中的过滤器函数manage_pages_columns，该函数可添加自定义列。

password_reset

用户将旧密码更改为新密码前执行此动作函数。

personal_options_update

用户在控制板中更新设置时执行此动作函数。

plugins_loaded

所有插件加载完毕后执行此动作函数。

profile_personal_options

在用户资料编辑iemian的“关于您自己”版块结尾处执行此动作函数。

profile_update

更新用户资料时执行此动作函数。函数结合搜的参数：用户ID。

register_form

在新用户注册表结尾部分前执行此动作函数。

register_post

处理新用户注册请求前执行此动作函数。

restrict_manage_posts

需要编辑的日志列表显示在管理菜单界面前，执行此动作函数。

retrieve_password

检索用户密码以发送密码提醒邮件时执行此动作函数。函数接收的参数：登录名。

set_current_user

默认函数wp_set_current_user更改用户后，执行此动作函数。注意：wp_set_current_user是一个“插入式”函数，即插件可以改写该函数；参见插件API。

show_user_profile

在用户资料编辑界面结尾部分执行此动作函数。

simple_edit_form

在控制板的“简单”日志编辑框的结尾部分执行此动作函数（默认情况下，简单编辑框仅用于书签工具——没有“高级”选项）。

update_option_(option_name)

update_option函数更新WordPress选项后，执行该动作函数。函数接收的参数：原选项值，新选项值。用户需要为希望更新的选项添加一个动作函数，例如更新“foo”时用函数update_option_foo来呼应。

upload_files_(tab)

执行该动作函数以显示上传文件管理界面上的某个页面；“tab”是自定义动作函数表的名称。可以用过滤器函数wp_upload_tabs来定义自定义表（参见插件API/常用过滤器函数）。

user_register

首次创建用户资料时执行此动作函数。函数接收的参数：用户ID。

wp_ajax_(action)

在管理菜单中执行此动作函数以运行未知类型的AJAX。

wp_authenticate

用户登录时，执行该动作函数以验证用户身份。函数接收的参数：用户名和密码数组。

wp_login

用户登录时执行此动作函数。

wp_logout

用户退出登录时执行此动作函数。
高级动作函数

本部分介绍的都是与WordPress查询（决定该显示哪一篇日志）、WordPress主循环、激活插件以及WordPress基础代码相关的动作函数。

admin_menu

控制板中的菜单结构显示无误后，执行此动作函数。

admin_notices

管理菜单显示在页面上时执行此动作函数。

blog_privacy_selector

博客默认隐私选项显示在页面上时，执行此动作函数。

check_admin_referer

系统出于安全考虑检查随机数后在默认函数check_admin_referrer中执行check_admin_referer动作钩子，使插件因安全原因而强制WordPress停止运行。注意：check_admin_referrer也是一个“插入式”函数，即插件可以改写该函数；参见插件API。

check_ajax_referer

系统从cookies中成功验证用户的登录名和密码后，在默认函数 check_ajax_referer（这是在有AJAX请求进入wp-admin/admin-ajax.php脚本时所调用的函数）中执行此动作函数，使插件能够因安全原因强制WordPress停止运行。注意： check_ajax_referer函数也是一个“插入式”函数，即插件可以改写该函数；参见插件API。

generate_rewrite_rules

重写规则生成后，执行此动作函数。函数接收的参数：WP_Rewrite类变量列表。注意：在修改重写规则时，使用rewrite_rules_array过滤器函数比使用该动作函数更加方便。

init

WordPress加载完毕但尚未发送页眉信息时执行该动作函数。函数适用于解析$_GET or $_POST 触发器。

loop_end

WordPress主循环最后一篇日志执行完毕后，执行此动作函数。

loop_start

执行WordPress主循环第一篇日志前，执行此动作函数。

parse_query

在主查询或WP_Query 的任何实例（如 query_posts，get_posts或get_children）中查询解析结束时，执行此动作函数。函数接收的参数：$wp_query 对象内容列表。

parse_request

在主WordPress函数wp中解析查询请求后，执行该动作函数。函数接收的参数：引用全局变量$wp对象的数组。

pre_get_posts

在get_posts函数开始操作查询前执行此动作函数。函数接收的参数：$wp_query对象的内容列表。

sanitize_comment_cookies

HTTP请求读取cookies后执行此动作函数。

send_headers

在WordPress主函数wp中发送基本HTTP页眉后执行此动作函数。函数接收的参数：引用全局变量$wp对象的数组。

shutdown

页面内容输出完毕后执行此动作函数。

wp

在WordPress主函数wp中解析查询、页面加载完毕后，执行模板前，执行此动作函数。函数接收的参数：引用全局变量$wp对象的数组。

*/


