<?php
/**
 * Loads the correct template based on the visitor's url
 * @package WordPress
 */
if ( defined('WP_USE_THEMES') && WP_USE_THEMES )
	do_action('template_redirect');

// Halt template load for HEAD requests. Performance bump. See #14348
if ( 'HEAD' === $_SERVER['REQUEST_METHOD'] && apply_filters( 'exit_on_http_head', true ) )
	exit();

// Process feeds and trackbacks even if not using themes.
if ( is_robots() ) :
	do_action('do_robots');
	return;
elseif ( is_feed() ) :
	do_feed();
	return;
elseif ( is_trackback() ) :
	include( ABSPATH . 'wp-trackback.php' );
	return;
endif;


if ( defined('WP_USE_THEMES') && WP_USE_THEMES ) :
	$template = false;

	if     ( is_404()            && $template = get_404_template()            ) :
	echo '404';
	elseif ( is_search()         && $template = get_search_template()         ) :
	echo '搜索';
	elseif ( is_tax()            && $template = get_taxonomy_template()       ) :
	echo '分类';
	elseif ( is_front_page()     && $template = get_front_page_template()     ) :
	echo 'front_page';
	elseif ( is_home()           && $template = get_home_template()           ) :
	echo '首页';
	elseif ( is_attachment()     && $template = get_attachment_template()     ) :
	echo '附件';
		remove_filter('the_content', 'prepend_attachment');
	elseif ( is_single()         && $template = get_single_template()         ) :
	echo '文章页面';
	elseif ( is_page()           && $template = get_page_template()           ) :
	echo '页面';
	elseif ( is_category()       && $template = get_category_template()       ) :
	echo '又是分类？';
	elseif ( is_tag()            && $template = get_tag_template()            ) :
	echo '标签';
	elseif ( is_author()         && $template = get_author_template()         ) :
	echo '作者';
	elseif ( is_date()           && $template = get_date_template()           ) :
	echo '日期';
	elseif ( is_archive()        && $template = get_archive_template()        ) :
	echo '归档';
	elseif ( is_comments_popup() && $template = get_comments_popup_template() ) :
	echo '留言';
	elseif ( is_paged()          && $template = get_paged_template()          ) :
	echo '又是页面？';
	else :
		$template = get_index_template();//如果以上页面都不是则取index.php页面
	echo '最终的选择';
	endif;
	
	
	if ( $template = apply_filters( 'template_include', $template ) ) {
		echo $template;
		include( $template );
	}
	
	return;
endif;



