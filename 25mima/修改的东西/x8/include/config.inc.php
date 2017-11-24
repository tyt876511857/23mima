<?php
/*
file config.inc.php
配置文件
*/

return array(
	'DB_HOST' 	=>	'localhost',
	'DB_USER' 	=> 	'root',
	'DB_PWD' 	=> 	'123456',
	'DB_NAME' 	=> 	'test',
	
	'DB_PREFIX'	=>	'gs_',
	'DB_CHAR' 	=> 	'utf8',

	 //模板替换规则
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' 	=>  '/public',//前台公用
		'__SKIN__'		=> 	'/Modules/admin/Tpl/public',//后台公用
		'__ROOT__'		=> 	'http://'.$_SERVER['HTTP_HOST'] . '/',//后台公用
		'__DATA__'		=> 	'/data',//后台公用
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
	'THIRD_KEY'	=>'23185558',//第三方秘钥
	'THIRD_URL'	=>' https://m.ly.com/itravel/order/ordercenter'//第三方跳转地址,
	
);


