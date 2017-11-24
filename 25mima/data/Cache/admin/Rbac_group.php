<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>权限用户组</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>权限用户组</p><a href="<?php echo U('/Rbac/add_group') ?>">添加用户组</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">ID</td>
      <td width="20%">组名称</td>
      <td width="5%">管理项</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
        <td>
          <a href='<?php echo U("/Rbac/update_group/id/$v[id]") ?>' title="编辑">
            [权限设定]
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>