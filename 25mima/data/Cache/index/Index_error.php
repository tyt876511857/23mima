<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>提示页面</title>
    <?php $this->display('index:Index:css','lib') ?>
    <link href="/public/gaiban/css/info.css" rel="stylesheet" type="text/css" />
    <script language="javascript" src="/public/gaiban/js/login.js"></script>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
 <?php $this->display('index:Index:header','lib') ?>
<div class="mainContent">
		 <div class="info_con">
            <h3><?php echo $str; ?></h3>
            <p></p>
            <a href="javascript:;" style=" width:30%; height:30px;" onclick="a()" class="returnBtn">确定</a>
        </div>
	</div>
<div style='clear:both; height:2px; width:100%'></div>


<script>
function a(){
    <?php
    if(empty($url)){
       echo 'if(history.go(-1)==undefined){window.location.href="/index/Index/loginurl";}else{ window.location.href=history.go(-1);}';
    }else{
       echo 'window.location.href="'.$url.'";';
    }
    ?>
}
</script>