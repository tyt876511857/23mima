<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>评论列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>评论列表</p></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="10%">名称</td>
      <td width="30%">评论内容</td>
      <td width="5%">评价者</td>
      <td width="5%">星级</td>
      <td width="10%">评论时间</td>
      <td width="5%">IP</td>
      <td width="5%">顶</td>
      <td width="5%">踩</td>
      <td width="5%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></td>
        <td><?php if(isset($v['content'])){echo $v['content'];} ?></td>
        <td><?php if(isset($v['user_name'])){echo $v['user_name'];} ?></td>
        <td><?php if(isset($v['comment_rank'])){echo $v['comment_rank'];} ?></td>
        <td><?php echo date('y-m-d H:i:s',$v['add_time']); ?></td>
        <td><?php if(isset($v['ip'])){echo $v['ip'];} ?></td>
        <td><?php if(isset($v['ding'])){echo $v['ding'];} ?></td>
        <td><?php if(isset($v['cai'])){echo $v['cai'];} ?></td>
        <td><a href='<?php echo U("/Comment/delete/id/$v[id]") ?>' onclick="if(!confirm('确实要删除这条评论吗?')){return false;};" title="删除">删除</a></td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>