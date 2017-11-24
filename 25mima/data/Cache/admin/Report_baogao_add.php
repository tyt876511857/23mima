<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加基因</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加基因</p></div>
  <form action="<?php echo U('Report/baogao_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>报告编号：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/></td>
    </tr>
    <?php
    foreach($data as $v){
      echo "<tr><td>$v[name]($v[title])：</td><td><select name='property[$v[title]]'>";
      echo '<option value="">请选择</option>';
      foreach($v['fenshu'] as $j){
        
        if($j['name'] == $field['content1'][$v['title']]){
          $str = 'selected="ture"';
        }else{$str='';}
        echo "<option value='$j[name]=$j[sum]' ".$str.">$j[name]</option>";
      }
      echo "</select></tr>";
    }
    ?>

  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
      <input type="hidden" name="cid" value="<?php if(isset($_GET['cid'])){echo $_GET['cid'];} ?>" />
      <input type="hidden" name="code" value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>">
  </div>
  </form>
</div>
</body>
</html>
<style>
  #image{max-width:80%;}
  select{width:100px;}
</style>