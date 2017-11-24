<?php

$table = $conf['DB_NAME'];
$conn = mysql_connect($conf['DB_HOST'],$conf['DB_USER'],$conf['DB_PWD']) or die(mysql_error());
mysql_select_db($table,$conn) or die('选择表不成功');
mysql_query('set names utf8');

?>