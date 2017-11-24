<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加栏目</title>
<?php $this->display('css','lib') ?>
<script type="text/javascript" src="/data/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/data/ueditor/ueditor.all.js"></script>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加栏目</p></div>
  <form method="post" action="<?php echo U('News/runadd') ?>" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>栏目名称</td>
      <td>
        <input type="text" name="typename" maxlength="60" size = "30" value="<?php if(isset($field['typename'])){echo $field['typename'];} ?>" /><span class="require-field">*</span>
      </td>
    </tr>
    <tr>
      <td>上级分类</td>
      <td>
        <select name="pid" onchange="catChanged()"  >
          <option value="0">顶级分类</option>
          <?php foreach ($cate as $v){ ?>
          <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if(!empty($field)&&$v["id"]==$field["pid"]){ ?>selected="ture"<?php } ?> ><?php if(isset($v['html'])){echo $v['html'];} ?><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>排序:</td>
      <td><input type="text" name='rank'  value="<?php if(empty($field)){ ?>50<?php }else{ ?><?php if(isset($field['rank'])){echo $field['rank'];} ?><?php } ?>" size="15" /></td>
    </tr>
    <tr>
      <td>关键字</td>
      <td><input type="text" name="keywords" maxlength="60" size="50" value="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>" /></td>
    </tr>
    <tr>
      <td>描述</td>
      <td><textarea  name="description" cols="60" rows="4"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
    <tr>
      <td>栏目图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>模板名称</td>
      <td><input type="text" name="site" maxlength="60" size="50" value="<?php if(empty($field)){ ?>List:news<?php }else{ ?><?php if(isset($field['site'])){echo $field['site'];} ?><?php } ?>" />类名:方法名(ps:List_news.html 写成 List:news)</td>
    </tr>
    <tr>
      <td>模板名称</td>
      <td><input type="text" name="art_site" maxlength="60" size="50" value="<?php if(empty($field)){ ?>Article:article<?php }else{ ?><?php if(isset($field['art_site'])){echo $field['art_site'];} ?><?php } ?>" />类名:方法名(ps:Article_article.html 写成 Article:article)</td>
    </tr>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;">
        <!--引入并配置百度编辑器-->
          <script name="content" id="editor" type="text/plain" style="width:100%;height:300px;"><?php if(isset($field['content'])){echo $field['content'];} ?></script>
          
        <!--引入并配置百度编辑器-->
        
      </td>
    </tr>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;">
      <script name="content1" id="editor1" type="text/plain" style="width:100%;height:300px;"><?php if(isset($field['content1'])){echo $field['content1'];} ?></script>
      <script>
          window.UEDITOR_HOME_UER = '/data/Ueditor/';
          window.UEDITOR_CONFIG.imageUrl="<?php echo U('/Goods/upload') ?>";
          </script>
          <script type="text/javascript" src="/data/diy.ueditor.js"></script>
          <script>
          UE.getEditor('editor1');</script>
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