<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $this->display('css','lib') ?>

<title>23密码-提示页</title>
</head>
<body>

  <!-- 用户菜单 -->
<?php $this->display('header','lib') ?>

<section class="ui-notice">
   
	<div class="ui-tips ui-tips-warn">
    <i></i><span><?php echo $str; ?></span>
	</div>
    <div class="ui-notice-btn">
        <button onclick="a()" class="ui-btn-primary ui-btn-lg">确定</button>
    </div>
</section>
<?php $this->display('footer','lib') ?>


</body>
<script>
function a(){
    <?php
    if(empty($url)){
       echo 'window.location.href=history.back(-1)';
    }else{
       echo 'window.location.href="'.$url.'";';
    }
    ?>
}
</script>
</html>