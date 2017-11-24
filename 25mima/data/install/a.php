<?php
//建立数据库
	header("content-type:text/html;charset=utf-8");
	$conf = require('../include/config.inc.php');//引入配置文件
	$table = $conf['DB_NAME'];
	$conn = mysql_connect($conf['DB_HOST'],$conf['DB_USER'],$conf['DB_PWD']) or die(mysql_error());
	//判断数据库是否存在，存在则执行

	if(mysql_select_db($table)){
		echo '<script type="text/javascript">';
		echo 'alert("'.$table.'数据库已经存在，请在配置文件里重命名！");';
		//echo '  javascript:history.go(-1);';
		echo '</script>';
		die();
	}
	//添加数据库
	if(!mysql_query('create database '.$table)){
		echo mysql_error();
		die();
	}
	//
	mysql_select_db($table,$conn) or die('选择表不成功');
	mysql_query('set names utf8');
	$file = file_get_contents("sql.sql");
	$file_arr = explode(';',$file);
	foreach($file_arr as $v){
		//解析sql文件
		$v = str_ireplace('#@__',$conf['DB_PREFIX'],$v);
		if(mysql_query($v)){
			echo '插入成功！<br />';
		}else{
			echo mysql_error().'<br />';
			echo $v;
		}

	}
?>