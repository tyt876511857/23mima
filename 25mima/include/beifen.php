<?php
//header ( "content-Type: text/html; charset=utf-8" );
//备份数据库
$conf = require('config.inc.php');//引入配置文件
$host		=$conf['DB_HOST'];  
$user		=$conf['DB_USER'];			//数据库账号
$password	=$conf['DB_PWD'];			//数据库密码
$dbname		=$conf['DB_NAME'];		//数据库名称
//这里的账号、密码、名称都是从页面传过来的
if(!mysql_connect($host,$user,$password))  //连接mysql数据库
{
 echo '数据库连接失败，请核对后再试';
 exit;
}
if(!mysql_select_db($dbname))  //是否存在该数据库
{
 echo '不存在数据库:'.$dbname.',请核对后再试';
 exit;
}
mysql_query("set names 'utf8'");
$mysql= "set charset utf8;\r\n";  
$q1=mysql_query("show tables");
while($t=mysql_fetch_array($q1)){
    $table=$t[0];
    $q2=mysql_query("show create table `$table`");
    $sql=mysql_fetch_array($q2);
	$mysql.="DROP TABLE IF EXISTS `$table`".";\r\n";
    $mysql.=$sql['Create Table'].";\r\n";
    $q3=mysql_query("select * from `$table`");
    while($data=mysql_fetch_assoc($q3)){
        $keys=array_keys($data);
        $keys=array_map('addslashes',$keys);
        $keys=join('`,`',$keys);
        $keys="`".$keys."`";
        $vals=array_values($data);
        $vals=array_map('addslashes',$vals);
        $vals=join("','",$vals);
        $vals="'".$vals."'";
        $mysql.="insert into `$table`($keys) values($vals);\r\n";
    }
}
//$filedir = trim($_SERVER["DOCUMENT_ROOT"].'/data/backupdata','/');// 指定存放目录
//指定目录不存在则创建
if(!file_exists(BACKUPDATA)){
	mkdir(BACKUPDATA,777,true);
}
//$filename=$filedir."/".date('y-m-d').".sql";  //存放路径，默认存放到项目最外层

$fp = fopen(BACKUPDATA_NAME,'w');

if(!$fp){
    echo '打开或创建文件失败！';die();
}
fputs($fp,$mysql);
fclose($fp);
unset($mysql);
?>