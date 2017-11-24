<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>产品基因管理</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>基因值管理</p><a href='<?php echo U("Report/fenshu_add/pid/$_GET[id]") ?>'>添加基因值</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">名称</td>
      <td width="10%">分数</td>
      <td width="10%">描述</td>
      <td width="10%">生物学功能</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
        <td><?php if(isset($v['sum'])){echo $v['sum'];} ?></td>
        <td><?php if(isset($v['description'])){echo $v['description'];} ?></td>
        <td><?php if(isset($v['secdes'])){echo $v['secdes'];} ?></td>
        <td>
          <a href='<?php echo U("Report/fenshu_update/id/$v[id]/pid/$_GET[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>
          <a href='<?php echo U("/Report/fenshu_delete/id/$v[id]") ?>' onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">
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