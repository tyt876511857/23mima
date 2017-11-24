<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加新链接</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加新链接</p></div>
  <form action="<?php echo U('/Link/runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>链接名称</td>
      <td>
        <input type="text" name="title" value="<?php if(isset($field['title'])){echo $field['title'];} ?>" size="30"  />当你添加文字链接时, 链接LOGO为你的链接名称.
      </td>
    </tr>
    <tr>
      <td>链接地址</td>
      <td><input type='text' name='url' value='<?php if(isset($field['url'])){echo $field['url'];} ?>' size="30"  /></td>
    </tr>
    <tr>
      <td>显示顺序</td>
      <td><input type='text' name='rank'  value="<?php if(empty($field)){ ?>50<?php }else{ ?><?php if(isset($field['rank'])){echo $field['rank'];} ?><?php } ?>"  size="30"  /></td>
    </tr>
    <tr>
      <td>链接LOGO</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['logo'])){echo $field['logo'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="logo" class="file" onchange="document.getElementById('textfield').value=this.value" />
        <br /><span style="display:block">在指定远程LOGO图片时, LOGO图片的URL网址必须为http:// 或 https://开头的正确URL格式!</span>
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