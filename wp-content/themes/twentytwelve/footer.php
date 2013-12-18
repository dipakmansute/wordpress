<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php 
//var_dump(wp_get_http('http://www.baidu.com'));

// global $wp_filter;
// echo '<pre>';
// echo count($wp_filter);
// var_dump($wp_filter);
// exit;

?>

<?php wp_footer(); ?>
</body>
</html>

<?php 
// echo '<pre>';
// var_dump($GLOBALS); ?>



<?php 
global $pagenow;
fb('测试当前的模板文件为：'.$pagenow); 


/*
fb('系统的执行过程如下：');
fb($GLOBALS['query_string']);//category_name=xxyizhan
fb($GLOBALS['posts']);//因查询而生成的首个WP_Post对象
fb($GLOBALS['post']);//因查询而生成的所有WP_Post对象
fb($GLOBALS['request']);//
*/


//echo '<pre>';
//系统中所有的常量
//print_r(@get_defined_constants());


global $_wp_theme_features;
fb($_wp_theme_features);




