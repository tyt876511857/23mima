<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>友情链接</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>友情链接</p><a href="<?php echo U('/Link/add') ?>">添加新链接</a></div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="5%">编号</td>
      <td width="10%">链接名称</td>
      <td width="10%">链接地址</td>
      <td width="10%">链接LOGO</td>
      <td width="5%">显示顺序</td>
      <td width="10%">操作</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['title'])){echo $v['title'];} ?></td>
        <td><a href="<?php if(isset($v['url'])){echo $v['url'];} ?>" target="_blank"><?php if(isset($v['url'])){echo $v['url'];} ?></a></td>
        <td><?php if(!empty($v["logo"])){ ?><img src="<?php if(isset($v['logo'])){echo $v['logo'];} ?>" width="88" height="31"><?php }else{ ?>无logo<?php } ?></td>
        <td><?php if(isset($v['rank'])){echo $v['rank'];} ?></td>
        <td>
          <a href='<?php echo U("/Link/update/id/$v[id]") ?>' title="编辑">
            <img src="/Modules/admin/Tpl/public/images/icon_edit.gif" border="0" height="16" width="16" />
          </a>&nbsp;
          <a href='<?php echo U("/Link/delete/id/$v[id]") ?>' onclick="if(!confirm('您确定要移除此条友情链接吗？')){return false;};" title="移除">
            <img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16" />
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>