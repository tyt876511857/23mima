<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>商品列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>商品列表</p></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="27%">商品名称</td>
      <td width="15%">商品分类</td>
      <td width="8%">货号</td>
      <td width="8%">价格</td>
      <td width="4%">上架</td>
      <td width="4%">精品</td>
      <td width="4%">新品</td>
      <td width="4%">热销</td>
      <td width="7%">推荐排序</td>
      <td width="7%">库存</td>
      <td width="6%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?></td>
        <td><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></td>
        <td><?php if($v['typename']){ ?><?php if(isset($v['typename'])){echo $v['typename'];} ?><?php }else{ ?><span style='color:red;'>请选择分类</span><?php } ?></td>
        <td><?php if(isset($v['goods_sn'])){echo $v['goods_sn'];} ?></td>
        <td><?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></td>
        <td><img src="<?php if($v['is_on_sale']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><img src="<?php if($v['is_best']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><img src="<?php if($v['is_new']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><img src="<?php if($v['is_hot']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><?php if(isset($v['rank'])){echo $v['rank'];} ?></td>
        <td><?php if(isset($v['goods_number'])){echo $v['goods_number'];} ?></td>
        <td>
          <a href="<?php echo C('REWRITE_GOODS') ?><?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>.html" target="_blank" title="查看"><img src="/Modules/admin/Tpl/public/images/icon_view.gif" width="16" height="16" border="0" /></a>
          <a href='<?php echo U("/Goods/update/id/$v[goods_id]") ?>' title="编辑"><img src="/Modules/admin/Tpl/public/images/icon_edit.gif" width="16" height="16" border="0" /></a>
          <a href='<?php echo U("/Goods/totrack/id/$v[goods_id]/type/1") ?>' onclick="if(!confirm('您确定要把此商品移入回收站吗？')){return false;};" title="回收站"><img src="/Modules/admin/Tpl/public/images/icon_trash.gif" width="16" height="16" border="0" /></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>