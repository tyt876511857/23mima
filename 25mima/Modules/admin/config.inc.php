<?php
/*
file config.inc.php
配置文件
*/

return array(
	'DB_HOST' 	=>	'localhost',
	'DB_USER'	=>	'root',
	'DB_PWD' 	=> 	'123456',
	'DB_NAME' 	=> 	'boolshop',

	'DB_USER' 	=> 	'alumduancom',
	'DB_PWD' 	=> 	'4C08xcBy2w',
	'DB_NAME' 	=> 	'alumduancom',
	
	'DB_PREFIX'	=>	'gs_',
	'DB_CHAR' 	=> 	'utf8',

	 //模板替换规则
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' 	=> 	__ROOT__ . 'public',//前台公用
		'__SKIN__'		=> 	GROUP_ADMIN.'Tpl/public',//后台公用
		'__ROOT__'		=> 	__ROOT__,//后台公用
		'__DATA__'		=> 	__ROOT__. 'data',//后台公用
		'__TIME__'		=> 	time(),
	),
	// 其它
	'APP_ADMIN_NAME' 	=> 'admin',  //后台模块名称
	'APP_INDEX_NAME' 	=> 'index',  //前台模块名称
	'APP_USER_NAME' 	=> 'user',  //用户模块名称
	'APP_GRUOP_PATH' 	=> 'Modules',//独立分组路径
	//伪静态
	'REWRITE_CATEGORY' 	=>'/category_',
	'REWRITE_GOODS'		=>'/goods_',
	'REWRITE_NEWS'		=>'/news_',
	'REWRITE_CONTENT'	=>'/content_',
	
);


