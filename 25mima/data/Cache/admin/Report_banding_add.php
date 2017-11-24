<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加绑定</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加绑定</p></div>
  <form action="<?php echo U('Report/banding_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>编码：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/></td>
    </tr>
    <tr>
      <td>产品名称：</td>
      <td>
        <select name="cid">
          <?php foreach ($list as $v){ ?>
            <option value='<?php if(isset($v['id'])){echo $v['id'];} ?>' <?php if(!empty($field)&&$field["cid"]==$v["id"]){ ?>selected='ture'<?php } ?> ><?php if(isset($v['name'])){echo $v['name'];} ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
      <input type="hidden" name="code" value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>">
  </div>
  </form>
</div>
</body>
</html>
<style>
  #image{max-width:80%;}
</style>