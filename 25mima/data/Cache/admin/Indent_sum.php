<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>订单列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>订单统计</p></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="15%">订单标识</td>
      <td width="8%">标识说明</td>
      <td width="10%">订单数</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
        <td><?php if(isset($v['title'])){echo $v['title'];} ?></td>
        <td><?php if(isset($v['count'])){echo $v['count'];} ?></td>
      </tr>
    <?php } ?>
    
  </table>
</div>
</body>
</html>