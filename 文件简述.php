wordpress目录文件结构
********** 
根目录
**********
1.index.php：wordpress核心索引文件，即博客输出文件。
2.license.txt：WordPress GPL许可证文件。
3.my-hacks.php：定义了博客输出之前处理的追加程序。
默认安装中并没有这个文件，但如果存在，它就会被管理页面引用。
4.readme.html：WordPress安装导言。
5.wp-atom.php：输出Atom信息聚合内容。
6.wp-blog-header.php：根据博客参数定义博客页面显示内容。
7.wp-cron.php：完成定时任务
8.wp-comments-post.php：接收评论，并把其添加到数据库。
9.wp-commentsrss2.php：用来生成日志评论的RSS2信息聚合内容。
10.wp-config-sample.php：把WordPress连接到MySQL数据库的示例配置文件。
11.wp-config.php：这是真正把WordPress连接到MySQL数据库的配置文件。默认安装中虽不包括它，但由于WordPress运行需要这一文件，因此，用户需要编辑这个文件以更改相关设置。
12.wp-feed.php：根据请求定义feed类型并其返回feed请求文件。
13.wp-links-opml.php：生成OPML格式的链接(通过WordPress管理菜单添加）列表。
14.wp-login.php：定义注册用户的登陆页面。
15.wp-mail.php：用来获取通过邮件提交的博文。
这个文件的URL通常被添加到cron任务中，这样cron就会定期检索文件并接收邮件日志。
16.wp-pass.php：审核受密码保护文章的密码并显示被保护文章。
17.wp-rdf.php：生成RDF信息聚合内容。
18.wp-register.php：允许新用户通过联机表单注册用户名。
19.wp-rss.php：生成RSS信息聚合内容。
20.wp-rss2.php：生成RSS2信息聚合内容。
21.wp-settings.php：运行执行前的例行程序，包括检查安装是否正确，使用辅助函数，应用用户
插件，初始化执行计时器等等。
22.wp-trackback.php：处理trackback请求。
23.wp.php：显示博客日志的简单模板。并没有什么神奇之处，但包括了部分index.php内容。
24.xmlrpc.php：处理xmlrpc请求。用户无需通过内置的网络管理界面就可发布文章。 
********** 
wp-admin
**********
1.wp-admin/admin.php：管理文件的核心文件。用来连接数据库，整合动态菜单数据，显示非核心控制页面等。
2.wp-admin/admin-db.php
3.wp-admin/admin-footer.php：定义所有管理控制台的页脚。
4.wp-admin/admin-functions.php：定义了管理控制台使用的多种函数。5.wp-admin/admin- header.php：定义了管理控制台的上半部分内容，包括菜单逻辑 （menu logic）的 menu-header.php文件。
6.wp-admin/bookmarklet.php：使用书签功能时，定义弹出页面。撰写日志时使用默认的edit-form.php文件。
7.wp-admin/categories.php：定义管理页面的类别管理。参考: Manage – Categories
8.wp-admin/cat-js.php
9.wp-admin/edit.php：定义管理页面的日志管理。参考:  Manage – Posts
10.wp-admin/edit-comments.php：定义管理页面的评论管理。参考:  Manage – Comments
11.wp-admin/edit-form-advanced.php：定义管理页面的日志高级编辑形式管理，包括post.php。参考:  Write – Write Post – Advanced
12.wp-admin/edit-form.php：定义管理页面的日志简单编辑形式管理，包括post.php。参考:  Write – Write Post
13.wp-admin/edit-form-comment.php：编辑特定日志评论。
14.wp-admin/edit-form-ajax-cat.php
15.wp-admin/edit-link-form.php
16.wp-admin/edit-page-form.php：定义管理模块页面的页面编辑，包括post.php和page-new.php。参考: Write – Write Page
17.wp-admin/edit-pages.php：定义管理模块页面的页面管理。参考:  Manage – Pages
18.wp-admin/execute-pings.php
19.wp-admin/import.php
20.wp-admin/index.php：默认管理页面。根据用户请求显示相应的页面。
21.wp-admin/inline-uploading.php
22.wp-admin/install-helper.php：定义数据库维护函数，包括popular-in-plugins maybe_create_table() 和maybe_add_column()。
23.wp-admin/install.php：安装WordPress。
24.wp-admin/link-add.php：链接添加。参考:  Links – Add Link
25.wp-admin/link-categories.php：链接分类管理。参考: Links – Link Categories
26.wp-admin/link-import.php：导入链接。参考: Links – Import Links
27.wp-admin/link-manager.php：链接管理。参考:  Links – Manage Links
28.wp-admin/link-parse-opml.ph：导入链接时，用来解析OPML文件。
29.wp-admin/list-manipulation.js
30.wp-admin/list-manipulation.php
31.wp-admin/menu-header.php：用于在管理界面显示菜单。
32.wp-admin/menu.php：定义了默认管理菜单结构。
33.wp-admin/moderation.php：定义了评论审核函数。
34.wp-admin/options.php：升级后，用来更改所有设置。
35.wp-admin/options-discussion.php：管理评论和trackback相关选项。参考:  Options – Discussion
36.wp-admin/options-general.php：管理基本配置选项。参考: Options – General
37.wp-admin/options-head.php
38.wp-admin/options-misc.php：设置文件上传，链接跟踪，自定义”hacks”等相关选项。参考：Options – Miscellaneous
39.wp-admin/options-permalink.php：管理永久链接选项。参考: Options – Permalinks
40.wp-admin/options-reading.php：设置如何把网站信息发送到读者浏览器或其它应用程序。参考: Options – Reading
41.wp-admin/options-writing.php：管理日志撰写界面。参考:Options – Writing
42.wp-admin/page-new.php：创建新页面。
43.wp-admin/plugin-editor.php：编辑插件文件。
44.wp-admin/plugins.php：管理插件。
45.wp-admin/post.php：创建新日志。
46.wp-admin/profile-update.php
47.wp-admin/profile.php：管理个人资料或配置。
48.wp-admin/setup-config.php：安装时，用来创建wp-config.php文件。
49.wp-admin/sidebar.php
50.wp-admin/templates.php：编辑服务器可写文件。
51.wp-admin/theme-editor.php：编辑特定主题中的文件。
52.wp-admin/themes.php：管理主题。
53.wp-admin/update-links.php
54.wp-admin/upgrade-functions.php：定义了版本升级函数。
55.wp-admin/upgrade-schema.php：定义了升级中使用的默认表格结构和选项。
56.wp-admin/upgrade.php：版本升级。
57.wp-admin/user-edit.php：编辑用户。
58.wp-admin/users.php：管理用户。
59.wp-admin/wp-admin.css：定义了管理控制台的默认样式表。
60.wp-admin/xfn.js
********** 
wp-includes
**********
wp-includes目录
1.wp-includes/cache.php
2.wp-includes/capabilities.php
3.wp-includes/class-IXR.php：Incutio XML-RPC库。包括了 XML RPC支持函数。
由http://scripts.incutio.com/xmlrpc/提供支持。
4.wp-includes/classes.php：包括了基本的类，如核心文章提取机制WP_Query和改写管理WP_Rewrite。
5.wp-includes/class-pop3.php：包括了支持使用POP邮箱的类。可供wp-mail.php 使用。
6.wp-includes/class-snoopy.php：Snoopy是一个PHP类，用来模仿Web浏览器的功能，
它能自动完成检索网页和发送表单的任务。
7.wp-includes/comment-functions.php
8.wp-includes/default-filters.php
9.wp-includes/feed-functions.php
10.wp-includes/functions-compat.php：即新版本PHP中用来支持老版本PHP的函数文件。
11.wp-includes/functions-formatting.php：用于清理XHTML和用特定字符集正确格式化文本。
12.wp-includes/functions-post.php：定义了在数据库中管理日志，查询用户权限，提取和撰写评论等函数。
13.wp-includes/functions.php：包含许多重要的支持函数，它是WordPress中最大的文件，函数数量几乎是第二大文件的两倍。
14.wp-includes/gettext.php：PHP-gettext GPL 翻译库组成部分。
15.wp-includes/kses.php：用来渲染和过滤日志或评论中的HTML。
16.wp-includes/links.php：用来管理和使用WordPress的链接功能。
17.wp-includes/locale.php：用来替代默认的星期和月份值。
18.wp-includes/pluggable-functions.php
19.wp-includes/registration-functions.php
20.wp-includes/rss-functions.php
21.wp-includes/streams.php：定义了包装文件流和字符流的类。
22.wp-includes/template-functions-author.php：包含了与日志作者或评论人相关的主题函数。
23.wp-includes/template-functions-category.php：包含了与类别相关的主题函数。
24.wp-includes/template-functions-comment.php：包含了与评论相关的主题函数。
25.wp-includes/template-functions-general.php：包含了常规主题函数。
26.wp-includes/template-functions-links.php：包含了与链接相关的主题函数。
27.wp-includes/template-functions-post.php：包含了与日志相关的主题函数。
28.wp-includes/template-functions.php：包含了以上所有”template-”文件。
29.wp-includes/template-loader.php
30.wp-includes/vars.php：用来设置杂项变量。
31.wp-includes/version.php：用来设置当前使用的WordPress版本。
32.wp-includes/wp-db.php：包含了用来连接MySQL数据库的函数。
33.wp-includes/wp-l10n.php：提供支持多语言版本的函数。








