<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>管理员帐号</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>更改用户组：</p></div>
<form name='form1' method='post' action="<?php echo U('/Rbac/runupdate_group') ?>"> 
<table class="table" align="center">
<input type='hidden' name='id' value='<?php if(isset($data['id'])){echo $data['id'];} ?>'>
  <tr> 
    <td width="9%" height="30">组名称：</td>
    <td width="91%" style="text-align:left;"> <input name="name" type="text" id="typename" value="<?php if(isset($data['name'])){echo $data['name'];} ?>"> 
    </td>
  </tr>
    <?php foreach ($cate as $v){ ?>
     <tr> 
     <td colspan='2' style='text-align:left;font-weight:bold;'><?php if(isset($v['id'])){echo $v['id'];} ?>、<?php if(isset($v['title'])){echo $v['title'];} ?></td></tr>
     <tr><td colspan='2' style='text-align:left;'>
      <?php foreach ($v['child'] as $j){ ?>
     <p><input name='purviews[]' type='checkbox' id='purviews<?php if(isset($j['id'])){echo $j['id'];} ?>' value='<?php if(isset($j['name'])){echo $j['name'];} ?>' <?php if(strstr($data['purviews'],$j['name'])!==false){ ?>checked<?php } ?>><?php if(isset($j['title'])){echo $j['title'];} ?><!--<font color='#888888'>(<?php if(isset($j['name'])){echo $j['name'];} ?>)</font>--></p>
      <?php } ?>
     </td></tr>
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
<style>
.table tr{width:98%;margin: 0 auto;display:block;}
.table tr td{line-height:28px;}
.table tr td p{float:left;margin:0 15px 0 0;}
.table tr td p input{float:left;display:block;line-height:28px;margin:8px 4px 0 0;}
</style>