<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>广告管理</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>广告管理</p><a href="<?php echo U('/Myad/add') ?>">添加新广告</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">调用代码</td>
      <td width="10%">广告名称</td>
      <td width="10%">广告说明</td>
      <td width="5%">是否开启</td>
      <td width="5%">排序</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($data as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['type'])){echo $v['type'];} ?></td>
        <td><?php if(isset($v['title'])){echo $v['title'];} ?></td>
        <td><?php if(isset($v['description'])){echo $v['description'];} ?></td>
        <td><img src="<?php if($v['switch']){ ?>/Modules/admin/Tpl/public/images/yes.gif<?php }else{ ?>/Modules/admin/Tpl/public/images/no.gif<?php } ?>" /></td>
        <td><?php if(isset($v['rank'])){echo $v['rank'];} ?></td>
        <td>
          <a href='<?php echo U("Myad/update/id/$v[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>
          <a href='<?php echo U("/Myad/delete/id/$v[id]") ?>' onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">
            <img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16" />
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>