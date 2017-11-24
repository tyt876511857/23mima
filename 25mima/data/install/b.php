<?php
//建立数据库
	header("content-type:text/html;charset=utf-8");
	$conf = require('../include/config.inc.php');//引入配置文件
	$table = $conf['DB_NAME'];
	$conn = mysql_connect($conf['DB_HOST'],$conf['DB_USER'],$conf['DB_PWD']) or die(mysql_error());
	mysql_select_db($table);

	//删除已存在的所有表
	$r = mysql_query("show tables") or die('查询表名不成功！'.mysql_error());
	while($v = mysql_fetch_array($r)){
		mysql_query('DROP TABLE  '.$v[0]);
		//print_r($v);
	}
	
?>