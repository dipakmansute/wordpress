<?php
//1.将数据库时间转化为PHP常用时间
mysql2date( $format, $date, $translate = true );

//2.函数current_time("mysql", $gmt)返回格式为“年-月-日 时:分:秒”的时间。如果$gmt=1，返回的时间为GMT时间；
//如果$gmt=0，返回的时间为浏览器客户端本地时间（由WordPress选项gmt_offset决定，在“常规”菜单下的“时区”选项中进行设置）
current_time( $type, $gmt = 0 );

//3.根据时间标记检索本地格式的日期
date_i18n( 'Y 年 n 月 j 日' );
//返回2013 年 7 月 9 日

//4.国际化数字格式
number_format_i18n( '2251.5555', 2 );
//返回2,251.56

//5.
size_format( $bytes, $decimals = 0 );

//6.判断是否为字符串，且已经序列化【牛】
is_serialized($data);

//7.判断是否为序列化字符串
is_serialized_string($data);

//8.检查内容为多媒体，加入数据库
do_enclose();

//9.设置脚本请求的浏览器端缓存时间
cache_javascript_headers();
























