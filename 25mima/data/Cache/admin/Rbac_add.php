<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加管理员</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p><?php echo $name; ?>管理员</p></div>
  <form action="<?php echo U('Rbac/runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="left">
    <tr> 
      <td>用户登录ID：</td>
      <td><input value='<?php if(isset($field['userid'])){echo $field['userid'];} ?>' name="userid" type="text" /></td>
    </tr>
    <tr> 
      <td>用户笔名：</td>
      <td><input value='<?php if(isset($field['uname'])){echo $field['uname'];} ?>' name="uname" type="text" /></td>
    </tr>
    <tr> 
      <td>用户密码：</td>
      <td><input name="pwd" type="text" /></td>
    </tr>
    <tr> 
      <td>用户组：</td>
      <td>
        <select name='usertype'>
          <?php foreach ($usertype as $v){ ?>
          <option value='<?php if(isset($v['id'])){echo $v['id'];} ?>' <?php if(!empty($field) && $v["id"]==$field["usertype"]){ ?>selected="selected"<?php } ?> ><?php if(isset($v['name'])){echo $v['name'];} ?></option>
          <?php } ?>
        </select>&nbsp;
        【<a href="<?php echo U('/Rbac/group') ?>"><u>用户组设定</u></a>】
      </td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
  </div>
  </form>
</div>
</body>
</html>
<script>


/*$(function(){
  if($('[name="id"]').val()){
    setTimeout(function (){
      $('[name="uname"]').val('<?php if(isset($field['uname'])){echo $field['uname'];} ?>');
      $('[name="pwd"]').val('<?php if(isset($field['pwd'])){echo $field['pwd'];} ?>');
    },2100);
  }
}); */
</script>