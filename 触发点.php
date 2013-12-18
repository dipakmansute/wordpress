<?php 
//*****系统初始化****
do_action( 'plugins_loaded' );//插件加载完成触发
//在wp-settings.php文件中，
//系统初始化基本完成，加载插件，加载对齐函数，设置内容编码。触发此点


//在plugins_loaded后面是：
do_action( 'sanitize_comment_cookies' );//核查用户cookie
//紧接着便是：
$wp_the_query = new WP_Query();


do_action( 'setup_theme' );//主题安装触发点
//系统在进行语言包，主题载入之间进行的触发

//注意：主题安装的意思是，确定后台设置的主题路径、导入确定的语言包、载入并实例化日期时间类、加载主题函数完毕！

//随后便触发一个钩子
do_action( 'after_setup_theme' );//主题加载完毕后触发

//当系统加载完毕，主题加载完毕，当前用户加载完毕时，整个wp系统就完全加载了
do_action( 'init' );//整个单站点系统完全加载触完毕发点
//随后考虑多站点，随后触发以下触发点
do_action('wp_loaded');//整个站点系统完全加载完毕触发点



//****内容准备wp();****
wp();
//解析，路由，查询等等之后触发
do_action_ref_array('wp', array(&$this));//解析触发点【传递wp对象过去】





























