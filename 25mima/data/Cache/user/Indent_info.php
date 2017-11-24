<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>订单详情</title>
<?php $this->display('index:Index:css','lib') ?>
<?php $this->display('css','lib') ?>
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
<div class="w1200" style="height:500px;">
    <?php $this->display('left','lib') ?>
    <div class="user_right">
        <p class="user_title">订单详情</p>  
        <div class="info">
          <p><span>订单编号：</span><?php if(isset($data['indent'])){echo $data['indent'];} ?></p>
          <p><span>提交时间：</span><?php echo date('y-m-d H:i:s',$data['addtime']) ?></p>
          <p><span>收货地址：</span><?php if(isset($data['name'])){echo $data['name'];} ?>,<?php if(isset($data['phone'])){echo $data['phone'];} ?>,<?php if(isset($data['size'])){echo $data['size'];} ?></p>
          <p><span>商品总价：</span><?php if(isset($data['price'])){echo $data['price'];} ?></p>
          <p><span>快递公司：</span><?php if(isset($data['company'])){echo $data['company'];} ?></p>
          <p><span>快递单号：</span><?php if(isset($data['express'])){echo $data['express'];} ?></p>
        </div>
    </div>
</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>
<style>
.info p{line-height:30px;}
</style>