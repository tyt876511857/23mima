<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>编码生成列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>编码生成列表</p>
  <a href='<?php echo U("Code/add") ?>'>添加编码</a>
	<a href='<?php echo U("Code/download_code") ?>'>下载编码</a>
  </div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
	  <td width="10%">产品名称</td>
      <td width="10%">状态</td>
	  <td width="10%">时间</td>
      
    </tr>
	<?php $status=array('0'=>'已生成','1'=>'已出厂','2'=>'已绑定'); ?>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['code'])){echo $v['code'];} ?></td>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
        <td><?php echo $status[$v['status']]; ?></td>
        <td>
          <?php if(isset($v['createtime'])){echo $v['createtime'];} ?>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>