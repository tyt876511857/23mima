<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title> 商品回收站</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>商品回收站</p></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">商品名称</td>
      <td width="10%">货号</td>
      <td width="10%">价格</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?></td>
        <td><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></td>
        <td><?php if(isset($v['goods_sn'])){echo $v['goods_sn'];} ?></td>
        <td><?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></td>
        <td>
          <a href='<?php echo U("/Goods/totrack/id/$v[goods_id]/type/0") ?>' onclick="if(!confirm('您确定要把此商品还原吗？')){return false;};">还原</a> |
          <a href='<?php echo U("/Goods/delete/id/$v[goods_id]") ?>' onclick="if(!confirm('您确定要删除该商品吗？')){return false;};">删除</a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>