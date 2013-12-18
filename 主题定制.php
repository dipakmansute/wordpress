<?php 
//模板加载
/*
首页：home.php->index.php
日志：single.php->index.php
页面：pagetemplate.php->选模板->index.php
分类：category-7.php->category.php->archive.php->index.php
标签：tag-{标签名}.php->tag.php->archive.php->index.php
作者：author.php->archive.php->index.php
存档：date.php->archive.php->index.php
404页：search.php/404.php->index.php
附件 页：image.php, audio.php, video.php, application.php->attachment.php/single.php->index.php
 */





//主题定制的功能分功能注册，前台应用和后台操作三个阶段

//功能注册阶段
//在模板函数文件中functions通过以下注册
add_action( 'after_setup_theme', 'twentytwelve_setup' );
//在系统注册的时候会提供一些默认参数，为以后找不到相关资源做后备
//最后将要使用的自定义功能返回到全局变量
global $_wp_theme_features;//内容如下：
/*
array(
['menus'] =>1
['editor-style'] =>1
['automatic-feed-links'] =>1
['post-formats'] =>
	array([0] =>
		array([0] =>'aside'
			[1] =>'image'
			[2] =>'link'
			[3] =>'quote'
			[4] =>'status'
		)
	)
['custom-background'] =>
	array(
		[0] =>
			array(
				['default-image'] =>
				['default-color'] =>'e6e6e6'
				['wp-head-callback'] =>'_custom_background_cb'
				['admin-head-callback'] =>
				['admin-preview-callback'] =>
			)
		)
['post-thumbnails'] =>1
['custom-header'] =>
	array(
		[0] =>
			array(
				['default-image'] =>
				['random-default'] =>
				['width'] =>960
				['height'] =>250
				['flex-height'] =>1
				['flex-width'] =>1
				['default-text-color'] =>515151
				['header-text'] =>1
				['uploads'] =>1
				['wp-head-callback'] =>'twentytwelve_header_style'
				['admin-head-callback'] =>'twentytwelve_admin_header_style'
				['admin-preview-callback'] =>'twentytwelve_admin_header_image'
				['max-width'] =>2000
			)
		)
['widgets'] =>1
)
*/



//前台应用阶段
//比如获取前台的背景的功能，是将css片段嵌入到wp_head动作中，如下便是启动的总动作！
add_action( 'wp_loaded', '_custom_header_background_just_in_time' );//theme.php
//接着便是：【$args = get_theme_support( 'custom-background' );】
add_action( 'wp_head', $args[0]['wp-head-callback'] );
//$args[0]['wp-head-callback'] === _custom_background_cb

//这样，实现前台调用css片段的过程就由_custom_background_cb();来完成，它进行了如下工作：
//get_theme_mod( $name );$name可以为background_repeat
//最后生成相应的css片段即可【其它的思路都差不多】
/*
array(
	['nav_menu_locations'] =>
		array(
			['side-menu'] =>0
			['footer-menu'] =>20
			['primary'] =>16
		)
	['header_image'] =>'http://localhost/wordpress/wp-content/uploads/2013/08/cropped-cc.jpg'
	['header_textcolor'] =>515151
	['background_color'] =>'e6e6e6'
	['background_image'] =>'http://localhost/wordpress/wp-content/uploads/2013/08/cc-2.jpg'
	['background_repeat'] =>'no-repeat'
	['background_position_x'] =>'center'
	['background_attachment'] =>'scroll'
	['header_image_data'] =>
		array(
			['attachment_id'] =>334
			['url'] =>'http://localhost/wordpress/wp-content/uploads/2013/08/cropped-cc.jpg'
			['thumbnail_url'] =>'http://localhost/wordpress/wp-content/uploads/2013/08/cropped-cc.jpg'
			['width'] =>951
			['height'] =>247
		)
)
 */



//后台操作阶段















//与自定义相关的函数
add_custom_background();//开启背景图片支持
//本质还是调用了：add_theme_support( 'custom-background', array('default-color' => 'e6e6e6') );

















