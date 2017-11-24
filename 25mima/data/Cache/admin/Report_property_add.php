<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加属性</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加属性</p></div>
  <form action="<?php echo U('Report/property_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>所属基因</td>
      <td>
        <select name="cid">
            <?php foreach ($list as $v){ ?>
                <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if($v["id"]==$_GET["cid"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['name'])){echo $v['name'];} ?></option>
            <?php } ?>     
        </select>
      </td>
    </tr>
    <tr>
      <td>唯一识别码：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/>（请不要填写重复的标识）</td>
    </tr>
	<tr>
      <td>名称：</td>
      <td><input name="title_c" type="text" value='<?php if(isset($field['title_c'])){echo $field['title_c'];} ?>'/></td>
    </tr>
	<tr>
      <td>SNP位点：</td>
      <td><input name="SNP" type="text" value='<?php if(isset($field['SNP'])){echo $field['SNP'];} ?>'/></td>
    </tr>
	<tr>
      <td>染色体位置：</td>
      <td><input name="chr" type="text" value='<?php if(isset($field['chr'])){echo $field['chr'];} ?>'/></td>
    </tr>
	<tr>
      <td>说明：</td>
      <td><textarea name="shuoming" cols="40" rows="8"><?php if(isset($field['shuoming'])){echo $field['shuoming'];} ?></textarea></td>
    </tr>
	<tr>
      <td>基因位点图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>中文名称：</td>
      <td><input name="name" type="text" value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
    <tr>
      <td>描述：</td>
      <td><textarea name="description" cols="40" rows="8"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
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