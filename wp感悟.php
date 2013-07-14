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
* 此函数将返回处理后的数据，即这类功能用用将数据库中的数据提取进一步加工到满意的格式为止，这些是约定
* 同样do_action()函数则更多是将扩展的功能挂载到了系统中，主题定制中非常少，即使有也是实现一些特殊的功能
*
*4.动作
do_action( $tag, $arg = '' );【do_action：钩子】
$tag — 动作钩子的名称
$arg — 传递给***已注册的动作***的值。
它看起来像一个单独的参数，但通常都不是这样的。
动作钩子可以传递任何个数的参数，或者根本不传参数。
对特殊的钩子，你需要查看 WordPress 的源码，因为参数个数在每个钩子的基础改变。如：
do_action( $tag, $arg_1, $arg_2, $arg_3 );//采用func_get_arg($num)来接收。
每个参数可以为任意数据类型，当然数组是可以的。
*
add_action( $tag, $function, $priority, $accepted_args );【add_action：注册动作】
$tag – 函数挂载到动作钩子的名称。
$function – WordPress 要调用的函数名。
$priority – 执行优先级，默认是10。数字越小，这个函数越早被调用。
$accepted_args – 动作钩子要传递给你的函数的***参数个数****默认只有一个参数。如：
add_action( 'wp_footer', 'boj_example_footer_message', 100 ,2);//定义函数或系统函数将接收两个参数
*
do_action_ref_arrray( $tag, $args );
上述的很简单，是因为他针对的是面向过程的程式，这个则不一样，它完全不需要返回值
$tag – 动作钩子的名字。
$args – 要传递给注册到这个钩子的函数的参数的数组。***通常，这是一个动作可以改变的对象***
do_action_ref_array('wp_authenticate', array(&obj1, &obj2));//可以通过数组的方式添加多个对象到动作钩子
ref:Reference,引用，即传递进去的是一个引用类型构成的数组
注册方式和前面是一样的，很明显的一个特点就是其参数只有两个，所以***它是只针对对象的动作***如：
add_action( 'pre_get_posts', 'blog_posts' );
function blog_posts( $query ) {
	if( $query -> is_home && empty( $query -> query_vars['suppress_filters']))
	$query -> set( 'rderby', 'rand' );
}
取博客文章的对象时，我们将它传递到bolg_posts函数，将此对象处理后，而改变原来的对象结构
*
悟：通过上面的学习，我们知道，我们可以在模板中自定义一些动作，也可以使用系统中原有的动作，并且为动作插入功能块，
这个功能块可以在那个挂载点上做任何想做的事，也可以使用这个功能块将传入的对象进行处理！
如果我们写的功能块是个类怎么办？当然，只要将动作处的参数、对象或什么也不传，我们就可以使用类去处理想处理的任何事
*
删除注册到钩子
remove_action( $tag, $function_to_remove, $priority, $accepted_args );
这个参数与add_action所使用的***参数必须完全一样***解绑成功返回true否则返回false
注意：***为了让开发者可以定制系统中的任何内容，WordPress、plugin 或者 theme 添加的任何动作都可以在插件中删除***
通常只删除 WordPress 添加的动作因为plugin动作太过核心不用打破规则，theme中也是由开发都定制的，没必须添加又删除浪费资源。
许多默认的动作都定义在 wp-includes/default-filters.php 文件中。
通过浏览这个文件你就会明白 WordPress 是如何使用动作钩子的。
*
remove_all_actions( $tag[钩子], $priority[优先级] );
只要满意条件都将被删除，如remove_all_actions( 'wp_head' );删除所有绑定在这个钩子上的功能
*
has_action( $tag, $function_to_check );
后面参数可选，也是满足条件即可，
has_action() 函数的返回值是 Boolean 或者 一个整型值。
如果 $function_to_check 参数为空，那么如果有动作已经添加到了钩子中就返回 true，反之，返回 false。
而如果 $function_to_check 设置了，而且这个函数已经添加到了钩子里面，则返回该动作的***优先级***否则返回 false。
*
*
*
*
*
*5.过滤
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
*
*
*
*
*
*
*/











