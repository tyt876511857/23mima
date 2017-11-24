<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加特长</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加特长</p></div>
  <form action="<?php echo U('Report/tuoye_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>编号：</td>
      <td><input name="identifier" type="text" disabled="true" value='<?php if(isset($field['identifier'])){echo $field['identifier'];} ?>'/></td>
    </tr>
	<tr>
      <td>姓名：</td>
      <td><input name="name" type="text"  value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
	<tr>
      <td>性别：</td>
      <td><input name="rcvSex" type="radio" <?php if($field['rcvSex'] == 1){echo 'checked';} ?> value='1'/>男<input name="rcvSex" <?php if($field['rcvSex'] == 0){echo 'checked';} ?> type="radio" value='0'/>女</td>
    </tr>
	<tr>
      <td>出生年月日：</td>
      <td><input name="birthtime" type="text"  value='<?php echo date('Y-m-d',$field['birthtime']); ?>'/></td>
    </tr>
	<tr>
      <td>身高：</td>
      <td><input name="hight" type="text"  value='<?php if(isset($field['hight'])){echo $field['hight'];} ?>'/>cm</td>
    </tr>
	<tr>
      <td>体重：</td>
      <td><input name="weight" type="text"  value='<?php if(isset($field['weight'])){echo $field['weight'];} ?>'/>kg</td>
    </tr>
    <tr>
      <td>状态：</td>
      <td>
        <select name="state">
          <?php
            for($i = $field['state'];$i<=$field['state']+1;$i++){
              if($i<6){
                echo "<option value='$i'>$tuoye_state[$i]</option>";
              }
            }
          ?>
        </select>
      </td>
    </tr>
	<tr>
      <td>备注：</td>
      <td><textarea name="msg"><?php if(isset($field['msg'])){echo $field['msg'];} ?></textarea></td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
      <?php
        for($i=0;$i<=7;$i++){
          $time = $field['time'.$i];
          echo "<input type='hidden' name='time$i' value='$time'>";
        }
      ?>
      <input type="hidden" name="code" value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>">
  </div>
  </form>
</div>
</body>
</html>
<style>
  #image{max-width:80%;}
</style>