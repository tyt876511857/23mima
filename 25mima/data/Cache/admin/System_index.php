<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>商店设置</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>商店设置</p></div>
  <form enctype="multipart/form-data" method="post" action="<?php echo U('System/runsys') ?>">
  <table class="addtable" border="0" align="center">
    <?php foreach ($sys1 as $v){ ?>
      <tr>
        <td class="label" valign="top"><?php if(isset($v['info'])){echo $v['info'];} ?>:</td>
        <td><?php if(isset($v['str'])){echo $v['str'];} ?></td>
      </tr>
    <?php } ?>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
  </div>
  </form>
</div>
</body>
</html>