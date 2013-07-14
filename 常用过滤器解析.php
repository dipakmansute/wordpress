<?php
/*
 日志、页面、附件（上传）过滤器函数
数据库读取

本部分中的过滤器函数适用于从数据库读出、尚未显示到页面或编辑界面的数据。

accachment_icon

在get_attachment_icon函数中，该过滤器函数应用于附件图标。过滤器函数可接收的参数：图标文件（作为HTML IMG标签），附件ID。

attachment_innerHTML

在get_attachment_innerHTML函数中，若附件没有图标，该过滤器函数应用于附件标题。过滤器函数可接收的参数：内部HTML （默认为附件标题），附件ID。

content_edit_pre

应用于编辑前的日志正文

excerpt_edit_pre

应用于编辑前的日志摘要

get_attached_file

应用于由get_attached_file 函数检索出的附件文件信息。过滤器函数接收的参数：文件信息，附件ID。

get_enclosed

应用于get_enclosed函数中的日志附件列表

get_pages

应用于get_pages函数返回的页面列表。过滤器函数接收的参数：页面列表（每个词条中都包含一个页面数据组），get_pages 函数页面列表（get_pages函数可接收的参数列表，该列表可识别用户所请求的页面）。

get_pung

在get_pung函数中，应用于日志的引用通知URL链接列表

get_the_excerpt

在get_the_excerpt函数中，应用于日志摘要

get_the_guid

在get_the_guid函数中，应用于日志的全局唯一标识符（GUID）。

get_to_ping

在get_to_ping函数中，应用于日志的引用通知URL链接列表

icon_dir

在多个函数中，应用于模板的图片目录。其中插件能够规定，MIME类型的图标可以来自其它存储位置。

icon_dir_uri

在多个函数中，应用于模板图片目录URL。其中插件能够规定，MIME类型的图标可以来自其它存储位置。

prepend_attachment

应用于prepend_attachment函数预先存储的HTML代码。

sanitize_title

在sanitize_title函数中，删除HTML标签后，用于日志标题

single_post_title

在wp_title 和 single_post_title函数中，用于用以创建博客页面标题的日志标题

the_content

应用于从数据库中检索到、尚未显示在屏幕上的日志正文（也可用在“引用通告”等其它操作中）。

the_content_rss

在包含RSS订阅前，用于日志正文

the_editor_content

在将日志内容输入富编辑器窗口前，用于日志正文

the_excerpt

应用于从数据库中检索到、尚未显示在屏幕上的日志摘要（若没有日志摘要，可以应用于日志正文）（也可用在“引用通告”等其它操作中）。

the_excerpt_rss

在包含RSS订阅前，用于日志摘要

the_tags

应用于从数据库中检索到的、尚未显示在屏幕上的标签

the_title

应用于从数据库中检索到、尚未显示在屏幕上的日志标题（也可用在“引用通告”等其它操作中）。

the_title_rss

在包含RSS订阅前，用于日志标题（用the_title进行首次过滤后）。

the_edit_pre

显示编辑页面前，应用于日志标题

wp_dropdown_pages

应用于由wp_dropdown_pages函数生成的WordPress页面的HTML下拉列表。

wp_list_pages

应用于由wp_list_pages函数生成的HTML列表。

wp_list_pages_excludes

在wp_list_pages函数中，应用于被排除在外的页面列表（页面ID数组）

wp_get_attachment_metadata 

应用于wp_get_attachment_metadata 函数检索到的附件元数据。过滤器函数接收的参数：元数据，附件ID。

wp_get_attachment_thumb_file 

应用于wp_get_attachment_thumb_file 函数检索到的附件缩略图文件。过滤器函数接收的参数：缩略图文件，附件ID。

wp_get_attachment_thumb_url 

应用于wp_get_attachment_thumb_URL 函数检索到的附件缩略图URL。过滤器函数接收的参数：缩略图URL，附件 ID。

wp_get_attachment_url 

应用于wp_get_attachment_url 函数检索到的附件URL。过滤器函数接收的参数：URL，附件 ID。

wp_mime_type_icon 

应用于wp_mime_type_icon 函数为附件计算出的MIME类型图标。过滤器函数接收的参数：计算出的图标URI ， MIME 类型，日志 ID。

wp_title

在wp_title函数中，应用于尚未发送到浏览器的博客页面标题
数据库写入

本部分中的过滤器函数适用于尚未保存到数据库中的数据。

add_ping

应用于添加ping引用后、保存入数据库前的日志引用域的新值。

attachment_max_dims 

缩小图片前，应用于最大图片尺寸。过滤器函数输入值（以及返回的值）是false（若未规定最大尺寸）或一个两栏列表（宽度、高度）

category_save_pre 

应用于尚未保存到数据库前的、由逗号隔开的日志类别列表（也可用于附件）。

comment_status_pre

应用于尚未保存到数据库前的日志评论状态（也可用于附件）。

content_filtered_save_pre 

应用于尚未保存到数据库前、经过过滤的日志正文（也可用于附件）。

content_save_pre 

应用于尚未保存到数据库前的日志正文（也可用于附件）。

excerpt_save_pre

应用于尚未保存到数据库前的日志摘要（也可用于附件）。

name_save_pre

应用于尚未保存到数据库前的日志名称（也可用于附件）。

phone_content

应用于尚未保存到数据库前、由电子邮件提交的日志正文。

ping_status_pre

应用于尚未保存到数据库前的日志引用状态（也可用于附件）。

post_mime_type_pre 

应用于尚未保存到数据库中的插件的MIME类型

status_save_pre

应用于尚未保存到数据库中的日志状态。

thumbnail_filename

应用于上传图片时缩略图的文件名。

wp_thumbnail_creation_size_limit 

应用于上传图片时缩略图的大小。过滤器函数接收的参数：文件最大尺寸，附件 ID，附件文件名。

wp_thumbnail_max_side_length 

应用于上传图片时缩略图的大小。过滤器函数接收的参数：图片侧边最大尺寸， 附件ID，附件文件名。

title_save_pre

应用于尚未存储到数据库中的日志标题（也可用于附件）。

update_attached_file 

在update_attached_file 函数中，应用于尚未保存到日志元数据中的附件信息。过滤器函数接收的参数：附件信息，附件ID。

wp_delete_file

应用于被删除前的附件文件名

wp_generate_attachment_metadata 

应用于保存到数据库前的附件元数据数组。

wp_update_attachment_metadata 

应用于尚未保存到wp_update_attachment_metadata 函数的附件元数据。过滤器函数接收的参数：元数据，附件ID。
 
评论、引用通告、Ping过滤器
数据库读取

本部分中的过滤器函数适用于从数据库读出的、尚未显示到页面或编辑界面的数据。

commet_excerpt

在comment_excerpt函数中，应用于评论摘要。参见get_comment_excerpt。

comment_flood_filter

若有人试图评论轰炸某个博客，博客主人可以使用comment_flood_filter。过滤器函数接收的参数：已锁定（true/false，是否已经有过了插件锁定了此人的评论；可以在插件中将此参数值设为true并返回true以锁定评论）， 之前评论时间，当前评论时间。

comment_post_redirect

应用于有人发表评论后的重定向位置。过滤器函数接收的参数：重定向位置，评论信息数组。

comment_text

在comment_text函数和管理菜单中，应用于尚未显示在屏幕上的评论内容。

comment_text_rss

在包含RSS订阅前，应用于评论内容。

comments_array

在comments_template函数中，应用于日志的评论数组。过滤器函数可接收的参数：评论信息结构数组，日志 ID。

comments_number

应用于comments_number函数生成评论数量的格式化文本。参见get_comments_number。

get_comment_excerpt

应用于由get_comment_excerpt函数从数据库读出的评论摘要（comment_excerpt也会从数据库读出评论摘要）。参见comment_excerpt。

get_comment_ID

应用于get_comment_ID函数从全局变量$comments 中读出的评论ID。

get_comment_text

在get_comment_text函数中，应用于当前评论的评论内容，comment_text函数也会调用评论内容。

get_comment_type

在get_comment_type中，应用于评论类型（"comment", "trackback", 或 "pingback"），comment_type也会调用评论类型。

get_comments_number

应用于get_comments_number函数从全局变量$post中读出的评论总数（comments_number函数也会调用评论总数；参见comments_number过滤器）。

post_comments_feed_link

应用于comments_rss函数为评论feed生成的feed URL。
数据库写入

本部分中的过滤器函数适用于尚未保存到数据库中的数据。

comment_save_pre

应用于更新/编辑前的评论信息。函数接收的参数：评论信息数据，包括"comment_post_ID", "comment_author", "comment_author_email", "comment_author_url", "comment_content", "comment_type", 以及 "user_ID"。

pre_comment_approved

应用于当前评论的审核状态（true/false），以便于插件进行重写。返回true（或false）并将第一个参数设为true（或false），表示批准（或不批准）该评论，使用$comment_ID等全局变量获取该评论的信息。

pre_comment_content

当评论尚未写入数据库时，应用于评论内容。

preprocess_comment

将评论保存到数据库中，尚未进行其它操作时，应用于评论信息。函数可接收的参数：评论信息数组，包括"comment_post_ID", "comment_author", "comment_author_email", "comment_author_url", "comment_content", "comment_type", 以及"user_ID"。

wp_insert_post_data

更新数据库中的日志前，应用于wp_insert_post()中经过修改以及未经修改的日志信息。函数接收的参数：经过修改的日志数组与经过过滤的日志数组。
类别过滤器

参见下文中的管理界面过滤器。
数据库读取

本部分中的过滤器函数适用于从数据库读出的、尚未显示到页面或编辑界面的数据。

category_description

应用于category_description 以及wp_list_categories函数中的“description”字段类别。过滤器函数接收的参数：说明，（从category_description中调用的）类别 ID；说明，（从wp_list_categories中调用的）类别信息数组（包括该类别的类别表中所有字段）。

category_feed_link

应用于get_category_rss_link函数为类别feed生成的feed URL。

category_link

应该用于get_category_link函数为类别生成的URL。过滤器函数接收的参数：链接 URL，类别 ID。

get_categories

应用于get_categories函数生成的类别列表（很多其它函数会使用get_categories函数所生成的类别列表）。过滤器函数接收的参数：类别列表,，get_categories选项列表。

get_category

应用于get_category函数查找到的类别信息。该信息是一个数组，数组包括WordPress类别表中某个指定类别ID的所有字段。

list_cats

应用于两种不同情况下：

1. wp_dropdown_categories函数用list_cats过滤器过滤show_option_all 与show_option_none参数（这两个参数可在类别下拉列表中添加“All”和“None”选项）。过滤器函数不接受其它参数。

2. wp_list_categories函数将list_cats过滤器用在类别名称中。过滤器函数接收的参数：类别名称，类别信息列表（类别表中该类别的所有字段）。

list_cats_exclusions

get_categories函数将排除一些类别，list_cats_exclusions应用于可给出这些类别的SQL WHERE语句。插件也可以排除类别列表中的类别或类别组。过滤器函数接收的参数：排除类别的WHERE语句，get_categories选项列表。

single_cat_title

生成博客页面标题时，wp_title函数 与single_cat_title函数将single_cat_title用于类别名称。

the_category

在et_the_category_list函数中，应用于类别列表（带有链接的HTML列表）。过滤器函数接收的参数：生成的HTML文本，当前使用的列表分隔符（空字符串表示默认LI列表），父参数为get_the_category_list。

the_category_rss

包含RSS 订阅前，在get_the_category_rss函数中应用于日志的类别列表（类别XML元素列表）。过滤器函数接收的参数包括列表内容和类型（一般是"rdf"或"rss"）。

wp_dropdown_cats

应用于wp_dropdown_categories函数生成的下拉类别列表（含有HTML选项元素的文本字符串）。

wp_list_categories

应用于wp_list_categories函数生成的类别列表（HTML列表）。
数据库写入

本部分中的过滤器函数适用于尚未保存到数据库中的数据。

pre_category_description

应用于尚未保存到数据库中的类别说明

pre_category_name

应用于尚未保存到数据库中的类别名称。

pre_category_nicename

应用于尚未保存到数据库中的类别别名。
链接过滤器

注意：本部分是关于日志、页面、存档、订阅等链接的过滤器函数。博客反向链接过滤器函数见下文。

attachment_link

在get_attachment_link函数中，应用于总计出的附件永久链接。过滤器函数接收的参数：链接 URL，附件ID。

author_feed_link

应用于get_author_rss_link 函数为作者订阅生成的订阅URL。

author_link

应用于get_author_posts_url 函数生成的作者存档永久链接。过滤器函数接收的参数：链接URL，作者别名， 作者 ID。注意，get_author_posts_url在wp_list_authors与the_author_posts_link内被调用。

comment_reply_link

应用于get_comment_reply_link函数为回复某个特定评论而生成的链接。get_comment_reply_link函数在comments_template函数中被调用。过滤器函数接收的参数：链接（字符串），自定义选项（数组），当前评论（对象），当前日志（对象）。

day_link

在get_day_link函数中，应用于日存档文章的链接URL。过滤器函数接收的参数：URL，年，月，日。

feed_link

在get_feed_link函数中，应用于订阅的链接URL。过滤器函数接收的参数：URL，订阅类型（如"rss2"，"atom"等）。

get_comment_author_link

在get_comment_author_link函数中，应用于评论中为作者链接而生成的HTML（comment_author_link也会调用此HTML）。动作函数接收的参数：用户名。

get_comment_author_url_link

在get_comment_author_url_link函数中，应用于评论中为作者链接而生成的HTML（comment_author_link也会调用此HTML）。

month_link

在get_month_link函数中，应用于月存档日志的链接URL。过滤器函数接收的参数：URL，年，月。

page_link

在get_page_link函数中，应用于计算出的页面URL。过滤器函数接收的参数：URL，页面 ID。注意：有一个内部过滤器函数被称为_get_page_link，该过滤器也可过滤非博客主页上的页面URL（_get_page_link与page_link参数相同）。

post_link

在get_permalink函数中，应用于计算出的页面永久链接。the_permalink, post_permalink, previous_post_link以及next_post_link函数也会调用此类页面永久链接。过滤器函数接收的参数：永久链接，日志信息列表。

the_permalink

在the_permalink函数中，应用于尚未显示在浏览器上的日志永久链接。

year_link

在get_year_link函数中，应用于年存档日志的链接。过滤器函数接收的参数：URL，年。
日期和时间过滤器函数

get_comment_date

应用于get_comment_date函数生成的格式统一的评论日期（comment_date函数也会调用此类评论日期）。

get_comment_time

在get_comment_time函数中应用于格式统一的评论时间（comment_time函数也会调用此类评论时间）。

get_the_modified_date

应用于由get_the_modified_date函数生成的、格式统一的日志修改日期（the_modified_date函数也会调用此类日志日期）。

get_the_modified_time

应用于由get_the_modified_time和get_post_modified_time函数生成的、格式统一的日志修改时间（the_modified_time也会调用此类时间）。

get_the_time

应用于get_the_time和get_post_time函数生成的、格式统一的日志时间（the_time函数也会调用此类日志时间）。

the_date

应用于the_date函数所生成的、格式统一的日志发表日期。

the_modified_date

应用于由the_modified_date函数生成的、格式统一的日志修改日期。

the_modified_time

应用于由the_modified_time函数生成的、格式统一的日志修改时间。

the_time

应用于由the_time函数生成的、格式统一的日志发表时间。

the_weekday

应用于由the_weekday函数生成的日志发表日期当天的星期数。

the_weekday_date

应用于由the_weekday_date函数生成的日志发表日期当天的星期数。函数接收的参数包括：星期数（周一、周二、周三、周四、周五、周六、周日），before text与after text。
作者和用户过滤器函数

login_redirect

在用户登录过程中，应用于redirect_to post/get变量。
数据库读取

本部分中的过滤器函数适用于从数据库读出的、尚未显示到页面或编辑界面的数据。

author_email

应用于comment_author_email函数从数据库检索到的评论者的电子邮件地址。参见get_comment_author_email。

comment_author

应用于comment_author函数从数据库检索到的评论者的名称。参见get_comment_authorl。

comment_author_rss

包含RSS订阅前，应用于评论者的名称。

comment_email

应用于comment_author_email_link函数从数据库检索到的评论者的电子邮件地址。

comment_url

应用于comment_author_url函数从数据库检索到的评论者的URL地址（参见get_comment_author_url）。

get_comment_author

应用于get_comment_author函数从数据库检索到的评论者的名称，comment_author函数也会调用此类评论者名称。参见comment_author。

get_comment_author_email

应用于get_comment_author_email函数从数据库检索到的评论者的电子邮件地址。comment_author_email也会调用此类电子邮件地址。参见author_email。

get_comment_author_IP

应用于get_comment_author_IP函数从数据库检索到的评论者的IP地址。comment_author_IP函数也会调用此类IP地址。

get_comment_author_url

应用于get_comment_author_url函数从数据库检索到的评论者的URL。comment_author_url函数也会调用此类URL地址。参见comment_url。

login_errors

应用于显示在登录界面上的登录错误信息。

login_headertitle

应用于显示在登录界面上的登录信息头URL（WordPress默认显示）标题。

login_headerurl

应用于显示在登录界面上的登录信息头URL（默认指向WordPress.org）。

login_message

应用于显示在登录界面上的登录信息。

role_has_cap

在WP_Role->has_cap函数中应用于某位用户的权限列表。过滤器函数接收的参数包括：将要被过滤的权限列表，目前还无法使用的权限，以及用户名称。

sanitize_user

在sanitize_user函数中应用于用户名。过滤器函数接收的参数包括：用户名 （整理后），原始用户名，strict（true或者false，表示使用/不使用精确的ASCII码）。

the_author

在get_the_author函数中，应用于日志作者所显示的名称。the_author函数也会调用该名称。

the_author_email

在the_author_email函数中，应用于日志作者的点知邮件地址。
数据库写入

本部分中的过滤器函数适用于尚未保存到数据库中的数据。

pre_comment_author_email

应用于评论尚未保存到数据库时该评论作者的电子邮件地址。

pre_comment_author_name

应用于评论尚未保存到数据库时该评论作者的用户名。

pre_comment_author_url

应用于评论尚未保存到数据库时该评论作者的URL。

pre_comment_user_agent

应用于评论尚未保存到数据库时该评论作者的用户代理。

pre_comment_user_ip

应用于评论尚未保存到数据库时该评论作者的IP地址。

pre_user_id

应用于评论尚未保存到数据库时该评论作者的用户ID。

pre_user_description

应用于尚未保存到数据库中的用户说明。

pre_user_display_name

应用于尚未保存到数据库中的用户显示名。

pre_user_email

应用于尚未保存到数据库中的用电子邮箱地址。

pre_user_first_name

应用于尚未保存到数据库中的用户的名字。

pre_user_last_name

应用于尚未保存到数据库中的用户的姓。

pre_user_login

应用于尚未保存到数据库中的用户登录名。

pre_user_nicename

应用于尚未保存到数据库中的用户别名。

pre_user_display_name

应用于尚未保存到数据库中的用户昵称。

pre_user_url

应用于尚未保存到数据库中的用户URL。

registration_errors

应用于注册新用户所生成的注册错误列表。

user_registration_email

在用户首次登录时，应用于从注册页面读取到的该用户电子邮件地址。

validate_username

应用户新用户名的验证结果。过滤器函数接收的参数：valid (true/false), 被验证的用户名。
反向链接过滤器

注意：本部分是关于反向链接的过滤器函数。日志、页面、类别等连接过滤器函数见上文。

get_bookmarks

在get_bookmarks函数中，应用于反向链接数据库查询结果。过滤器函数接收的参数：数据库查询结果列表，get_bookmarks参数列表。

link_category

在get_links_list 和 wp_list_bookmarks函数中，应用于链接说明。

link_rating

在get_linkrating函数中，应用于链接评价值。

link_title

在get_links和wp_list_bookmarks函数中，应用于链接标题。（自WordPress 2.2起）

pre_link_description

应用于尚未保存到数据库中的链接说明。

pre_link_image

应用于尚未保存到数据库中的链接图片。

pre_link_name

应用于尚未保存到数据库中的链接名称。

pre_link_notes

应用于尚未保存到数据库中的链接注释。

pre_link_rel

应用于尚未保存到数据库中的链接联系信息。

pre_link_rss

应用于尚未保存到数据库中的链接RSS URL地址。

pre_link_target

应用于尚未保存到数据库中的链接目标信息。

pre_link_url

应用于尚未保存到数据库中的链接URL。
博客信息和选项过滤器函数

all_options

应用于get_alloptions函数从数据库中检索到的选项列表。

bloginfo

应用于get_bloginfo函数检索博客选项信息后，bloginfo函数再次从数据库中检索出的博客选项信息。第二个参数$show给出所请求的bloginfo选项名称。注意：bloginfo("url")，bloginfo("directory") 与bloginfo("home")不使用该过滤器函数（参见bloginfo_url）。

bloginfo_rss

在get_bloginfo_rss函数中， get_bloginfo函数首次检索过博客选项信息、过滤HTML标签、转换相应字符后，应用于博客选项信息（bloginfo_rss函数也调用此类信息）。参数$show给出所请求的bloginfo选项名称。

bloginfo_url

应用于bloginfo("url"), bloginfo("directory") 以及bloginfo("home")尚未返回的输出结果。

loginout

应用于wp_loginout函数为用户登录和退出生成的HTML链接。

option_(option name) 

应用于反序列化（解码基于数组的选项）后，get_option函数从数据库检索到的选项值。使用该过滤器函数时需要为特定选项名称添加过滤器函数，例如为 "option_foo"添加过滤器以过滤get_option("foo")的输出结果。

pre_option_(option name)

应用于反序列化后get_alloption函数从数据库检索到的选项值（解码基于数组的选项）。使用该过滤器函数时需要为特定选项名称添加过滤器函数，例如为 "pre_option_foo"添加过滤器以过滤"foo"选项。

register

应用于wp_register函数为用户创建的、用以注册（在允许注册的情况下）或访问控制板（已登录用户）的侧边栏链接。

upload_dir

应用于wp_upload_dir函数用以上传文件的文件目录。过滤器函数接收的参数是一个带有"dir"（上传目录路径）、"url"（上传目录的URL）、"error"（如果需要生成错误信息，可将此项设为true）元素的数组。

upload_mimes

若没有MIME列表输入wp_check_filetype函数，upload_mimes允许过滤器函数返回MIME类型列表以供上传。
一般性文章过滤器函数

attribute_escape

在attribute_escape函数中，应用于日志正文和其它内容。WordPress在多处地方调用attribute_escape以在内容发送到浏览器前，将某些字符改为HTML属性。

js_escape

在js_escape函数中，内容发送到浏览器窗口前，应用于Javascript代码。
管理界面过滤器函数

本部分是关于包括内容编辑界面在内的WordPress管理界面的过滤器函数。

autosave_interval 

应用于自动保存日志的时间间隔中。

cat_rows

在管理菜单中，应用于为管理类别而生成的类别行HTML。

comment_edit_pre

应用于尚未显示到编辑界面上的评论内容。

comment_edit_redirect

当有人在管理菜单中编辑评论后，应用于重定向。过滤器函数接收的参数：重定向地址，评论ID。

 

comment_moderation_subject

应用于通知网站管理人员审核新评论时发送的电子邮件的邮件主题。过滤器函数接收的参数：邮件主题，评论 ID。注意：该过程发生在 wp_notify_moderator 函数中。 wp_notify_moderator 是一个“可插入式”函数，即插件能够改写该函数；参见插件API。

comment_moderation_text

应用于通知网站管理人员审核新评论时发送的电子邮件的邮件正文。过滤器函数接收的参数：邮件正文内容，评论 ID。注意：该过程发生在 wp_notify_moderator 函数中。 wp_notify_moderator 是一个“可插入式”函数，即插件能够改写该函数；参见插件API。

comment_notification_headers

应用于通知日志作者有新评论时所发送的电子邮件的邮件标头。过滤器函数接收的参数：邮件标头，评论 ID。注意：该过程发生在 wp_notify_postauthor函数中。 wp_notify_postauthor是一个“可插入式”函数，即插件能够改写该函数；参见插件API。

comment_notification_subject

应用于通知日志作者有新评论时所发送的电子邮件的邮件主题。过滤器函数接收的参数：邮件主题，评论ID。注意：该过程发生在 wp_notify_postauthor函数中。 wp_notify_postauthor是一个“可插入式”函数，即插件能够改写该函数；参见插件API。

comment_notification_text

应用于通知日志作者有新评论时发送的电子邮件的邮件正文。过滤器函数接收的参数：邮件正文，评论 ID。注意：该过程发生在 wp_notify_postauthor函数中。 wp_notify_postauthor是一个“可插入式”函数，即插件能够改写该函数；参见插件API。

cron_schedules

在wp_get_schedules函数中，应用于一个空数组，让插件能够生成计划任务。

default_content

应用于尚未打开新日志的编辑框时默认的日志内容。

default_excerpt

应用于尚未打开新日志的编辑框时默认的日志摘要。

default_title

应用于尚未打开新日志的编辑框时默认的日志标题。

editable_slug

在get_sample_permalink函数中，应用于日志、页面、标签以及类别的别名。

explain_nonce_(verb)-(noun)

允许过滤器函数定义文本，用文本来解释WordPress核心代码没有解释的随机数。使用此参数前用户需要定义特别的动词/名词过滤器。例如，如果我们开发的插件为升级标签定义了一个随机数，我们就需要为“explain_nonce_update-tag”定义一个过滤器。过滤器函数接收的参数： 将要显示的文本（默认为常见的 "Are you sure you want to do this?"）以及动作URL末尾部分的信息。

format_to_edit

在format_to_edit函数中，应用于正文、摘要、标题和密码，管理菜单会调用format_to_edit函数来设定需要编辑的日志。在管理菜单中编辑评论时也可用到该参数。

format_to_post

在format_to_post函数中，应用于日志内容。默认情况下WordPress不使用这个参数。

manage_link-manager_columns

在WordPress 2.7以前，这个参数被称为manage_link_columns。应用于栏列表，以在反向链接管理界面上输入内容。过滤器函数的参数值/返回的值是一个关联列表，其中的元素关键字是栏名称，元素值是该栏页眉处的文本。参见动作函数manage_link_custom_column，这个函数将栏信息放在编辑界面中。

manage_posts_columns

应用于栏列表，以在日志管理界面上输入内容。过滤器函数的参数值/返回的值是一个关联数组，其中的元素关键字是栏名称，元素值是该栏页眉处的文本。参见动作函数manage_posts_custom_column，这个函数将栏信息放入编辑界面。

manage_pages_columns

应用于栏列表，以在页面管理界面上输入内容。过滤器函数的参数值/返回的值是一个关联数组，其中的元素关键字是栏名称，元素值是该栏页眉处的文本。参见动作函数manage_pages_custom_column，这个函数将栏信息放入编辑界面。

postmeta_form_limit

应用于日志编辑界面上的日志meta信息项的个数。

pre_upload_error

上传文件时，允许插件生成XMLRPC错误。

preview_page_link

应用于页面编辑界面上的链接，页面预览效果显示在界面下方。

preview_post_link

应用于日志编辑界面上的链接，日志预览效果显示在界面下方。

richedit_pre

在wp_richedit_pre函数中，应用于尚未显示到富文本编辑器的日志内容。

show_password_fields

应用于true/false变量，该变量决定用户是否选择在用户资料界面上更改密码（若变量值为true，显示密码修改项；变量值为false，表示用户无需修改密码）。

the_editor

应用于尚未显示在屏幕上的HTML DIV，该DIV用以存放富文本编辑器。过滤器函数的参数/返回的值是一个字符串。

user_can_richedit

在user_can_richedit函数中，用于统计用户的浏览器是否具有富编辑功能，以及用户是否希望使用富文本编辑器。若当前用户能够/不能够使用富文本编辑器时，过滤器函数的参数（返回值）为true/false。

user_has_cap

在WP_User->has_cap函数中，应用于用户的权限列表（current_user_can 函数调用WP_User->has_cap函数）。该过滤器函数的参数是将要被过滤的权限列表，以及参数列表（若用户能够编辑日志，参数列表中将包括日志ID等内容）。

wp_handle_upload

应用于上传文件时的相关上传信息。该过滤器函数的参数：带有"file"（文件名）、"url"、"type"元素的数组。

wp_upload_tabs

应用于自定义表的列表，以显示在上传管理界面上。该参数用动作函数upload_files_(tab)显示自定义表的页面。
富文本编辑器相关过滤器函数

本部分中的过滤器函数修改了富文本编辑器的配置。

mce_spellchecker_languages 

应用于拼写检查器中有效的语言选择。

mce_buttons, mce_buttons_2, mce_buttons_3, mce_buttons_4 

应用于富文本编辑器中的按钮行（每一行都是按钮名称的数组）。

mce_css

应用于富文本编辑器的CSS文件URL。

mce_external_plugins

应用于富文本编辑器加载的外部插件列表。

mce_external_languages

应用于外部插件加载的语言文件列表（参见 tinymce/langs/wp-langs.php）。

tiny_mce_before_init 

应用于编辑器的完整初始化数组。
模板过滤器函数

本部分是关于主题、模板和样式文件的链接过滤器函数。

kubrick_header_color 

应用于默认主题页眉处的颜色。

kubrick_header_display

应用于默认主题页眉处的显示设置。

kubrick_header_image

应用于默认主题的页眉图片文件。

locale_stylesheet_uri 

应用于get_locale_stylesheet_uri函数返回的、指定位置的样式表单URI。过滤器函数的参数：URI，样式表单目录URI。

stylesheet

应用于get_stylesheet函数返回的样式表单。

stylesheet_directory

应用于get_stylesheet_directory函数返回的样式表单目录。过滤器函数的参数：样式表单目录，样式表单。

stylesheet_directory_uri

应用于get_stylesheet_directory_uri函数返回的样式表单目录URI。过滤器函数的参数：样式表单目录URI，样式表单。

stylesheet_uri

应用于get_stylesheet_uri函数返回的样式表单URI。过滤器函数的参数：样式表单URI，样式表单。

template

应用于get_template函数返回的模板。

template_directory

应用于get_template_directory函数返回的模板目录。过滤器函数的参数：模板目录，模板。

template_directory_uri

应用于get_template_directory_uri函数返回的模板目录URI。过滤器函数的参数：模板目录URI，模板。

theme_root

应用于get_theme_root函数返回的主题根目录（正常情况下即wp-content/themes）.

theme_root_uri

应用于get_theme_root_uri函数返回的主题根目录URI。过滤器函数的参数：URI，网站URL。

我们也可以用以下过滤器钩子来代替主题中的单个模板文件。每个过滤器函数都将当前主题中相应的模板文件路径作为输入内容。插件可以为模板文件返回新的路径，以此修改将要使用的文件。

404_template 
     
archive_template 
     
attachment_template 
     
author_template 
     
category_template 
     
comments_popup_template 
     
comments_template 
     
date_template 
     
home_template 
     
page_template 
     
paged_template 
     
search_template 
     
single_template 

高等WordPress过滤器函数

本部分是与WordPress查询语句、重写规则、国际化以及其它WordPress核心功能相关的高等过滤器函数。

author_rewrite_rules

应用于已生成的、与作者相关的重写过则。

category_rewrite_rules

应用于已生成的、与类别相关的重写规则。

comments_rewrite_rules

应用于已生成的、与评论相关的重写规则。

creat_user_query

应用于尚未执行的、用以将新用户信息存入数据库的查询语句。

date_rewrite_rules

应用于已生成的、与日期相关的重写规则。

found_posts

应用于执行数据库查询后的日志列表。

found_posts_query

数据库查询过即将显示在页面上的日志列表后，WordPress会在查询结果中选择日志行。此时用户可用该过滤器函数来进行其它操作，而不是执行SELECT FOUND_ROWS()。

get_editable_authors

在get_editable_authors函数中，应用于当前用户有权管理的日志作者列表。

gettext

应用于 __ and _e国际化函数翻译的文本。过滤器函数的参数：翻译文本和未翻译文本。该过滤器函数只在国际化有效且已加载文本域后有效。

get_next_post_join

在get_next_post函数（该函数查找当前日志之后需要显示的日志）中，应用于SQL JOIN语句（当用户查看类别存档时，该语句通常与类别表相连接）。过滤器函数的参数：JOIN语句，stay in same category (true/false)，被排除的类别列表。

get_next_post_sort

在get_next_post函数（该函数查找当前日志之后需要显示的日志）中，应用于SQL ORDER BY语句（该语句通常按日志发表时间升序排列日志；至少需要有一篇日志）。过滤器函数的参数：ORDER BY语句。

get_next_post_where

在get_next_post函数（该函数查找当前日志之后需要显示的日志）中，应用于SQL WHERE语句（该语句通常按时间顺序查找下一篇已发表日志）。过滤器函数的参数：WHERE语句，stay in same category (true/false)，被排除的类别类表。

get_others_drafts

应用于查询语句，该查询语句能够选择其他用户的日志草稿并显示在管理菜单中。

get_previous_post_join

在get_previous_post函数（该函数查找当前日志之前所显示的日志）中，应用于SQL JOIN语句（当用户查看类别存档时，该语句通常与类别表相连接）。过滤器函数的参数：JOIN语句，stay in same category (true/false)，被排除的类别列表。

get_previous_post_sort

在get_previous_post函数（该函数查找当前日志之前所显示的日志）中，应用于SQL ORDER BY语句（该语句通常按日志发表时间降序排列日志；至少需要有一篇日志）。过滤器函数的参数：ORDER BY语句。

get_previous_post_where

在get_previous_post函数（该函数查找当前日志之前所显示的日志）中，应用于SQL WHERE语句（该语句通常按时间顺序查找上一篇已发表日志）。过滤器函数的参数：WHERE语句，stay in same category (true/false)，被排除的类别类表。

get_user_drafts

应用于查询语句，该查询语句能够选择其他用户的日志草稿并显示在管理菜单中。

locale

应用于get_locale函数的存储位置。

mod_rewrite_rules

应用于重写规则列表，用户更改永久链接结构时将该重写规则列表存入.htaccess文件。

post_limits

应用于查询的LIMIT语句，该查询可返回日志数组。

posts_distinct

允许插件将DISTINCTROW语句加入查询，该查询可返回日志数组。

posts_fields

应用于查询的字段列表，该查询可返回日志数组。

posts_groupby

应用于查询的GROUP BY语句，该查询返回日志数组（通常情况下该数组为空）。

posts_join_paged

应用于查询语句的JOIN语句。在计算出分页后，该查询返回日志列表（分页并不影响JOIN语句，因此该函数相当于posts_join）。

posts_orderby

应用于查询语句的ORDER BY语句。该查询返回日志数组。

posts_request

应用于尚未执行的、将返回日志数组的SQL查询语句整体。

post_rewrite_rules

应用于已生成的、与日志相关的重写规则。

root_rewrite_rules

应用于生成后的根目录级重写规则。

page_rewrite_rules

应用于已生成的、与页面相关的重写规则。

posts_where_paged

应用于查询的WHERE语句。在计算出分页后，该查询返回日志数组（分页并不影响WHERE语句，因此该函数相当于posts_where）。

posts_join

应用于查询的JOIN语句。该查询返回日志数组。这个过滤器函数与posts_where过滤器函数一并为JOIN语句添加了一个数据库表。

posts_where

应用于查询的WHERE语句。该查询返回日志数组。

query

应用于所有查询语句（至少加载插件后运行的所有查询语句）。

query_string

已停用——可用query_vars或request来代替该函数。

query_vars

在生成SQL查询语句前，应用于WordPress公共查询变量列表。适用于删除插件进行其它操作时多余的永久链接信息。

request

类似query_vars，但request用在添加了“额外”的私有查询变量后。

rewrite_rules_array

应用于已生成的所有重写规则。

search_rewrite_rules

应用于已生成的、与查找相关的重写规则。

the_posts

WordPress对只有一篇日志的网页进行许可权限和草稿状态的最简单处理后，将the_posts用在从数据库查询出的日志列表上。

excerpt_length

定义某一篇日志摘要的长度。

update_user_query

应用于更新查询语句。该查询语句可在执行查询前更新用户信息。

uploading_iframe_src（自WordPress 2.5后被删除）

为日志和页面编辑界面中所上传的内嵌框架使用HTML src标签。

wp_redirect

在wp_redirect函数中，应用于重定向的URL。过滤器函数的参数：URL，HTTP状态码。注意：wp_redirect是一个“可插入式”函数，插件能够改写该函数；参见插件API。

xmlrpc_methods

应用于已经为XMLRPC服务器定义的XMLRPC方法列表。

wp_mail_from

在wp_mail函数中，用于发出邮件前。该函数的输入值是邮件地址的计算结果，这里的邮件地址即当前主机名称下的WordPress（该值由$_SERVER['SERVER_NAME']规定）。过滤器函数wp_mail_from返回一个邮件地址，如“user@example.com”，或姓名和邮件地址的组合，如“Name <user@example.com>”（均无引号）。

wp_mail_from_name

在wp_mail函数中，用于发出邮件前。过滤器函数wp_mail_from_name返回一个名称字符串，该字符串将用作邮件发送人的名称。
 * 
 */