<?php
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
*
*
* 2.同样的道理$wp_json
* 系统中所有的以$wp_为开头的全局变量也是一样，
* 允许在系统中其它地方进修改，并且替代系统中原有的
* 
* 3.动作即在适当的位置处理入库之前的内容直到入库
* 过滤则是从数据库中读出的内容进行处理反馈到浏览器中的过程
* 动作：action
* 过滤：filter
* add_filter和add_action两个函数本质上是完全一样的，但为什么又要加以区分呢，
* 我们是不是随意使用两个函数呢，当然不是
* 我们在系统中会发现一个现象：就是apply_filter函数只在主题系统中出现，即数据输出阶段规律性的使用！
* 如：apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
* 这个过滤器的动作是twentytwelve_author_bio_avatar_size钩子下面挂载的函数，且传递参数68
* 它将返回处理后的数据
*
*
*
*
*
*
*
*
*
*
*
*
*
*/











