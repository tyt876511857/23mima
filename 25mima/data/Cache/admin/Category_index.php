<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>商品分类</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>商品分类</p><a href="<?php echo U('/Category/add') ?>">添加分类</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">分类名称</td>
      <td width="5%">排序</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><a href='<?php echo U("/Goods/index/id/$v[id]") ?>' title="查看商品"><?php if(isset($v['typename'])){echo $v['typename'];} ?></a></td>
        <td><?php if(isset($v['rank'])){echo $v['rank'];} ?></td>
        <td><?php if($v['child']){ ?><a href='<?php echo U("/Category/index/id/$v[id]") ?>'>下级栏目</a> |<?php } ?>
        <a href="<?php echo C('REWRITE_CATEGORY') ?><?php if(isset($v['id'])){echo $v['id'];} ?>.html" target="_blank">查看</a> |
        <a href='<?php echo U("/Category/move/id/$v[id]") ?>'>转移商品</a> |
      <a href='<?php echo U("/Category/update/id/$v[id]") ?>'>编辑</a> |
      <a href='<?php echo U("/Category/delete/id/$v[id]") ?>' onclick="if(!confirm('确实要删除此栏目以及所有子栏目吗?')){return false;};" title="移除">移除</a></td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>