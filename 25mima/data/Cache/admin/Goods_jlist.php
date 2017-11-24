<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>检测项目列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>检测项目列表</p><a href="<?php echo U('/goods/jadd') ?>">添加新检测项目</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="27%">商品名称</td>
      <td width="15%">检测项目名称</td>
      <td width="8%">是否显示</td>
      
      <td width="4%">图标</td>
     
      <td width="6%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></td>
		 <td><?php if(isset($v['title'])){echo $v['title'];} ?></td>
		 <td><img src="<?php if($v['ishidden']==0){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><img src="<?php if(isset($v['thumb'])){echo $v['thumb'];} ?>" width="100%"/></td>
       
        <td>
          <a href="<?php echo C('REWRITE_GOODS') ?><?php if(isset($v['gid'])){echo $v['gid'];} ?>.html" target="_blank" title="查看"><img src="/Modules/admin/Tpl/public/images/icon_view.gif" width="16" height="16" border="0" /></a>
          <a href='<?php echo U("/Goods/jupdate/id/$v[id]") ?>' title="编辑"><img src="/Modules/admin/Tpl/public/images/icon_edit.gif" width="16" height="16" border="0" /></a>
          <a href='<?php echo U("/Goods/jdelete/id/$v[id]") ?>' onclick="if(!confirm('您确定要把此检测项目删除吗？')){return false;};" title="删除"><img src="/Modules/admin/Tpl/public/images/icon_trash.gif" width="16" height="16" border="0" /></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>