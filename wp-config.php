<?php
/** 
 * WordPress 基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL 设置、数据库表名前缀、密钥、
 * WordPress 语言设定以及 ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑 wp-config.php} Codex 页面。MySQL 设置具体信息请咨询您的空间提供商。
 *
 * 这个文件用在于安装程序自动生成 wp-config.php 配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后输入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress 数据库的名称 */
define('DB_NAME', 'wordpress');

/** MySQL 数据库用户名 */
define('DB_USER', 'root');

/** MySQL 数据库密码 */
define('DB_PASSWORD', '123456');

/** MySQL 主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密匙设定。
 *
 * 您可以随意写一些字符
 * 或者直接访问 {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org 私钥生成服务}，
 * 任何修改都会导致 cookie 失效，所有用户必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$+l}k1Q_6|2c;:=AqWL,HO-U[x^}I*427bjtYHR)Iayl*mJ_aOWOl@)m _gZ_Q9:');
define('SECURE_AUTH_KEY',  'N-n2xYH]gh8[wRN`CY5>qsJJ cFZHhqJ}tg^n]nE[e&v/W (@KVh#*reeFnmF5al');
define('LOGGED_IN_KEY',    '/@-paI!8Vr<^nhXy#2;2Y*5v}a1Ub0:$r@%i9-qEFa6Y(g wn<:8%ddy:!;mZUyK');
define('NONCE_KEY',        'i,qadb[/{`~~qKU!w-^C!u67z]8Ftx(~x/t*r.1VG0.Stz==4a*`K^-!!SO{FdQS');
define('AUTH_SALT',        '=KjphDP3cJ{*5TGgyJ}USKFvFDKx%Zx,Z]P4P_yhR|YC!/BP=kH]p4h`.o$RyRio');
define('SECURE_AUTH_SALT', '$K.&+n+nD/PlY8_F_;_![KyCy#xzzO?Y;e)trMaA!g7{VI8)4GH@!GxJN[hC|ABu');
define('LOGGED_IN_SALT',   '[LG!#CcnsiyX.@6&YyxOo6]uuSgs/V>7p tk|Fwz:-k<9,Dm4f6ct4?&n+DWOn^n');
define('NONCE_SALT',       '`xnOtwig!!}:].|l@<W3JhotCDG]^I=`kb/A[S,w?RY`~k<}ie#4Z6IfX^kh6%!U');

/**#@-*/

/**
 * WordPress 数据表前缀。
 *
 * 如果您有在同一数据库内安装多个 WordPress 的需求，请为每个 WordPress 设置不同的数据表前缀。
 * 前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * WordPress 语言设置，中文版本默认为中文。
 *
 * 本项设定能够让 WordPress 显示您需要的语言。
 * wp-content/languages 内应放置同名的 .mo 语言文件。
 * 要使用 WordPress 简体中文界面，只需填入 zh_CN。
 */
define('WPLANG', 'zh_CN');

/**
 * 开发者专用：WordPress 调试模式。
 *
 * 将这个值改为“true”，WordPress 将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用本功能。
 */
define('WP_DEBUG', true);
//数据库调试
define('SAVEQUERIES', true);
/**
//开启调试
define('WP_DEBUG', true);
//禁止显示
define('WP_DEBUG_DISPLAY', true);
//调试错误在log中
define('WP_DEBUG_LOG', true);
*/



/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress 目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置 WordPress 变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
