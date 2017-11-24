<?php
function p($str){
  echo '<pre>';
  print_r($str);
  echo '</pre>';
}
//得到所有行数据
function getAll($sql,$array=null) {
      $rs = mysql_query($sql);
      $list = array();
      while($row = mysql_fetch_assoc($rs)){
          $list[] = $row;
      }
      return $list;
  }
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';
include 'Classes/PHPExcel/Writer/Excel5.php';
require_once('Classes/PHPExcel/IOFactory.php');
//数据库
$conf = require('../../include/config.inc.php');//引入配置文件
include('../../include/diy_mysql.class.php');
//获取分数

$sql = 'select p.title,p.cid,f.name,f.sum from '.$conf['DB_PREFIX'].'bg_fenshu as f left join '.$conf['DB_PREFIX'].'bg_property as p on f.pid=p.id';
$list1 = array();

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
	$list1[]=array('title'=>$row['title'],'name'=>$row['name'],'cid'=>$row['cid'],'sum'=>$row['sum']);
  }
function excel_run($file,$list1){
  global $error;
  $objPHPExcel = PHPExcel_IOFactory::load($file);
  $sheet = $objPHPExcel->getSheet(0);
	$doule = 0;//判断双基因的个数
  //获取行数与列数,注意列数需要转换
  $highestRowNum = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();
  $highestColumnNum = PHPExcel_Cell::columnIndexFromString($highestColumn);

  //取得字段，这里测试表格中的第一行为数据的字段，因此先取出用来作后面数组的键名
  $filed = array();
  for($i=0; $i<$highestColumnNum;$i++){
    $cellName = PHPExcel_Cell::stringFromColumnIndex($i).'1';
    $cellVal = $sheet->getCell($cellName)->getValue();//取得列内容
    $filed []= $cellVal;
  }
	$jiyin=array('rs1044396','rs4680','rs6265','rs9939609');
  //开始取出数据并存入数组
  $data = array();
  for($i=2;$i<=$highestRowNum;$i++){//ignore row 1
    $row = array();
    for($j=0; $j<5;$j++){
      $cellName = PHPExcel_Cell::stringFromColumnIndex($j).$i;
      $cellVal = $sheet->getCell($cellName)->getValue();
      $row[ $filed[$j] ] = $cellVal;
	  if($j==3){
		  if(empty($cellVal)){
			  
			  $row[ $filed[$j] ] = $row['Allele 1'];
			  
		  }
	  
	  }
    }
	
    $data []= $row;
  }
  $arr=array();
 
  foreach($data as $k=>$v){
  	if (empty($v['Allele 2'])) {
		$ji=$v['Allele 1'].$v['Allele 1'];
  	} else {
  		$ji=$v['Allele 1'].$v['Allele 2'];
  	}	
	  if(in_array($v['Marker'],$jiyin)){
		  for($i=1;$i<=2;$i++){
  			foreach($list1 as $vv){
  				if($vv['title']==$v['Marker'].$i && $vv['name']==$ji && $v['code']==$vv['cid']){
  					$doule += 1;
  					$arr[$v['Sample Name']]['val'][$v['Marker'].$i]=$v['Marker'].$i.'='.$ji.'='.$vv['sum'];
  					$arr[$v['Sample Name']]['code']=$v['code'];
  				}
  			}
		  }		
		  
	  }else{
		  foreach($list1 as $vv){
				if($vv['title']==$v['Marker'] && $vv['name']==$ji && $v['code']==$vv['cid']){
					$arr[$v['Sample Name']]['val'][$v['Marker']]=$v['Marker'].'='.$ji.'='.$vv['sum'];
					$arr[$v['Sample Name']]['code']=$v['code'];
				}
		  }
	  }
		
  }
  foreach($arr as $k=>$v){
  	  if (count($v['val']) != count($data)+$doule/2) {//是否报错
  	  	 $error = 1;
  	  }
	  $arr1[]='("'.$k.'",'.$v['code'].',"'.join(',',$v['val']).'")';
  }
  
  
  $str = join(',',$arr1);
 //print_r($str);exit;
  return $str;
}


//p($fenshu);
$sql = 'INSERT INTO '.$conf['DB_PREFIX'].'bg_baogao (title,cid,content) values';
foreach($_FILES['file']['tmp_name'] as $k=>$v){
  if(!empty($v)){
    $sql .= excel_run($v,$list1);
  }
}

$r = mysql_query($sql);
if($r && empty($error)){
  echo '导入成功！';
}else{
  echo '有部分基因不完整，需要编辑修改';
}

?>