<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>商品品牌</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>商品品牌</p><a href="<?php echo U('Brand/add') ?>">添加品牌</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">品牌名称</td>
      <td width="10%">品牌网址</td>
      <td width="10%">品牌描述</td>
      <td width="5%">排序</td>
      <td width="5%">是否显示</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['brand_id'])){echo $v['brand_id'];} ?></td>
        <td>
        
          <?php if(!empty($v["brand_logo"])){ ?>
            <a href="<?php if(isset($v['brand_logo'])){echo $v['brand_logo'];} ?>" target="_brank">
              <img src="<?php if(isset($v['brand_logo'])){echo $v['brand_logo'];} ?>" width="16" height="16" border="0" alt=品牌LOGO />
            </a>
          <?php } ?>
          <a href='<?php echo U("Brand/goods/id/$v[brand_id]") ?>'><?php if(isset($v['brand_name'])){echo $v['brand_name'];} ?></a>
        </td>
        <td><a href="<?php if(isset($v['site_url'])){echo $v['site_url'];} ?>" target="_brank"><?php if(isset($v['site_url'])){echo $v['site_url'];} ?></a></td>
        <td><?php if(isset($v['brand_desc'])){echo $v['brand_desc'];} ?></td>
        <td><?php if(isset($v['rank'])){echo $v['rank'];} ?></td>
        <td><img src="<?php if($v['is_show']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td>
          <a href='<?php echo U("/Brand/update/id/$v[brand_id]") ?>' title="编辑">编辑</a> |
          <a href='<?php echo U("/Brand/delete/id/$v[brand_id]") ?>' onclick="if(!confirm('您确定要移除此品牌吗？')){return false;};" title="编辑">移除</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>