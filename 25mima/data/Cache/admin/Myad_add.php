<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加广告</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加广告</p></div>
  <form action="<?php echo U('Myad/runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>广告位标识：</td>
      <td>
        <input name="type" type="text" value='<?php if(isset($field['type'])){echo $field['type'];} ?>'/>（使用英文或数字表示的简洁标识）</td>
    </tr>
    <tr>
      <td>广告标题：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/></td>
    </tr>
    <tr>
      <td>广告描述：</td>
      <td><input name="description" type="text" value='<?php if(isset($field['description'])){echo $field['description'];} ?>'/></td>
    </tr>
    <tr>
      <td>广告链接：</td>
      <td><input name="url" type="text" id="url" size="30" class='iptxt' value='<?php if(isset($field['url'])){echo $field['url'];} ?>'/></td>
    </tr>
    <tr>
      <td>排序：</td>
      <td>
        <input name="rank" type="text" id="sortrank" size="10" class='iptxt' <?php if(empty($field)){ ?>value='50'<?php }else{ ?>value="<?php if(isset($field['rank'])){echo $field['rank'];} ?>"<?php } ?> />
      </td>
    </tr>
    <tr>
      <td>广告图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>是否开启：</td>
      <td>
        <select name='switch' style='width:60px'>
          <option value='1' <?php if(empty($field)||$field['switch']==='1'){ ?>selected<?php } ?>>开启</option>
          <option value='0' <?php if(!empty($field)&&$field['switch']==='0'){ ?>selected<?php } ?>>关闭</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>广告内容：</td>
      <td><textarea name="content" cols="3" rows="10" style="width:80%;height:100"><?php if(isset($field['content'])){echo $field['content'];} ?></textarea></td>
    </tr>
    <tr>
      <td>当前广告素材：</td>
      <td><img id="image" src='<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>'/></td>
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