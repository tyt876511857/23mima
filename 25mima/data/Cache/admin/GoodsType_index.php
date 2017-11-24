<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>商品类型</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>商品类型</p><a href="<?php echo U('/GoodsType/add') ?>">添加商品类型</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">商品类型名称</td>
      <td width="5%">属性分组</td>
      <td width="5%">属性数</td>
      <td width="5%">状态</td>
      <td width="5%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
          <td><?php if(isset($v['cat_id'])){echo $v['cat_id'];} ?></td>
          <td><?php if(isset($v['typename'])){echo $v['typename'];} ?></td>
          <td></td>
          <td align="right">19</td>
          <td><img src="<?php if($v['enabled']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" ></td>
        <td align="center">
          <a href='<?php echo U("Attribute/index/id/$v[cat_id]") ?>' title="属性列表">属性列表</a> |
          <a href='<?php echo U("GoodsType/update/type/update/id/$v[cat_id]") ?>' title="编辑">编辑</a> |
          <a href='<?php echo U("/GoodsType/delete/id/$v[cat_id]") ?>' onclick="if(!confirm('确实要移除吗?')){return false;};" title="移除">移除</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>