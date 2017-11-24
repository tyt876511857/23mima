<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>订单列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p <?php if (empty($_GET['i_type'])) echo 'style="background:#ccc;"';?>><a href="/admin/indent/index/">订单列表</a></p><p <?php if (!empty($_GET['i_type'])) echo 'style="background:#ccc;"';?> ><a style="float:left" href="/admin/indent/index/i_type/11">同程订单列表</a></p></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="15%">订单号</td>
      <td>交易号</td>
      <td width="10%">订单金额</td>
      <td width="10%">提交时间</td>
      <td width="10%">支付人</td>
      <td width="10%">状态</td>
      <td width="8%">快递公司</td>
      <td width="10%">快递单号</td>
      <td>标识</td>
      <td width="5%">管理项</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['indent'])){echo $v['indent'];} ?><?php if ($v['i_type']==11) {echo '(同程)';}?></td>
        <td><?php if(isset($v['WIDtrade_no'])){echo $v['WIDtrade_no'];} ?></td>
        <td><?php if(isset($v['price'])){echo $v['price'];} ?></td>
        <td><?php echo date('y-m-d H:i:s',$v['addtime']); ?></td>
        <td><?php if(isset($v['username'])){echo $v['username'];} ?></td>
        <td class="color<?php if(isset($v['type'])){echo $v['type'];} ?>"><?php if(isset($v['typename'])){echo $v['typename'];} ?> <?php if(isset($v['REFUND_STATUS'])){echo $v['REFUND_STATUS'];} ?></td>
        <td><?php if(isset($v['company'])){echo $v['company'];} ?></td>
        <td><?php if(isset($v['express'])){echo $v['express'];} ?></td>
        <td><?php if(isset($v['i_type'])){echo $v['i_type'];} ?></td>
        <td>
          <a href='<?php echo U("/Indent/info/id/$v[id]") ?>'>
            查看
          </a>&nbsp;
        </td>
      </tr>
    <?php } ?>
    
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>
<style>
  .color1{color:red;}
  .color0{color:green;}
</style>