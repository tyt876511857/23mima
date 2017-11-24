<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>产品基因管理</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>产品基因管理</p><a href="<?php echo U('/Report/add') ?>">添加基因</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">名称</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><a href='<?php echo U("Report/property_index/id/$v[id]") ?>'><?php if(isset($v['name'])){echo $v['name'];} ?></a></td>
        <td>
          <a href='<?php echo U("Report/zheye_index/id/$v[id]") ?>'>特长管理</a>
          <a href='<?php echo U("Report/property_index/id/$v[id]") ?>'>属性列表</a>
          <a href='<?php echo U("Report/update/id/$v[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>
          <a href='<?php echo U("/Report/delete/id/$v[id]") ?>' onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">
            <img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16" />
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <!-- <ul id="page"><?php echo $showpage; ?></ul> -->
</div>
</body>
</html>