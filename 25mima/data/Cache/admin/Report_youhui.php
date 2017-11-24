<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>优惠码列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>优惠码列表</p></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="27%">优惠码</td>
      <td width="8%">用户</td>
      <td width="15%">价格</td>
      <td>状态</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['title'])){echo $v['title'];} ?></td>
        <td><?php if(isset($v['phone'])){echo $v['phone'];} ?></td>
        <td><?php if(isset($v['price'])){echo $v['price'];} ?></td>
        <td><?php if($v['state']){ ?>已使用<?php }else{ ?>未使用<?php } ?></td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>