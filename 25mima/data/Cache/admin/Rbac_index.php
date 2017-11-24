<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>管理员帐号</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>管理员帐号</p><a href="<?php echo U('/Rbac/add') ?>">添加管理员</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">登录ID</td>
      <td width="10%">笔名</td>
      <td width="10%">级别</td>
      <td width="20%">登陆情况</td>
      <td width="5%">管理项</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['userid'])){echo $v['userid'];} ?></td>
        <td><?php if(isset($v['uname'])){echo $v['uname'];} ?></td>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
        <td align="center" bgcolor="#FFFFFF">登录时间：<?php echo date('y-m-d H:i:s',$v['logintime']) ?>　登录IP：<?php if(isset($v['loginip'])){echo $v['loginip'];} ?></td>
        <td>
          <a href='<?php echo U("/Rbac/update/id/$v[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>&nbsp;
          <a href='<?php echo U("/Rbac/delete/id/$v[id]") ?>' onclick="if(!confirm('您确定要删除此管理员吗？')){return false;};" title="移除">
            <img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16" />
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>