<?php
define('HSJ',true);
//备份数据库
define('BACKUPDATA',trim('data/backupdata','/'));// 指定存放目录
define('BACKUPDATA_NAME',BACKUPDATA."/".date('y-m-d').".sql");//存放路径，默认存放到项目最外层 
if(!file_exists(BACKUPDATA_NAME)){
	include './include/beifen.php';
}
//ini_set('session.cookie_domain', '23mima.com');
//ini_set('session.use_trans_sid', 1);
require('./include/init.php');
?>