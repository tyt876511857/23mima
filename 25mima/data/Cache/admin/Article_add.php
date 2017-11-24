<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加新文章</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加新文章</p></div>
  <form  action="<?php echo U('/Article/runadd') ?>" method="post" enctype="multipart/form-data" onSubmit="return CheckSubmit();" name="form1">
  <table class="addtable" border="0" align="center">
    <tr>
      <td>文章标题</td>
      <td><input type="text" name="title" size ="40" maxlength="60" value="<?php if(isset($field['title'])){echo $field['title'];} ?>" /><span>*</span></td>
    </tr>
    <tr>
      <td>文章分类</td>
      <td>
        <select name="cat_id" id='cat_id'>
            <option value="0">请选择...</option>
            <?php foreach ($cate as $v){ ?>
            <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if(!empty($field)&&$field["cat_id"]==$v["id"]){ ?>selected='ture'<?php }else if(!empty($_GET["cid"]) && $_GET["cid"]==$v["id"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['html'])){echo $v['html'];} ?><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
            <?php } ?>
        </select>
         <span>*</span>
      </td>
    </tr>
    <tr>
      <td>文章重要性</td>
      <td>
        <input type="radio" name="article_type" value="0" <?php if(empty($field)||$field["article_type"]==0){ ?>checked="true"<?php } ?>>普通      
        <input type="radio" name="article_type" value="1"<?php if(!empty($field)&&$field["article_type"]==1){ ?>checked="true"<?php } ?>>置顶        
        <input type="radio" name="article_type" value="2" <?php if(!empty($field)&&$field["article_type"]==2){ ?>checked="true"<?php } ?>>特荐
        <input type="radio" name="article_type" value="3" <?php if(!empty($field)&&$field["article_type"]==3){ ?>checked="true"<?php } ?>>图片
        <input type="radio" name="article_type" value="4" <?php if(!empty($field)&&$field["article_type"]==4){ ?>checked="true"<?php } ?>>热点      <span class="require-field">*</span>
      </td>
    </tr>
    <tr>
      <td>是否显示</td>
      <td>
        <input type="radio" name="is_open" value="1" <?php if(empty($field)||$field["is_open"]==1){ ?>checked="true"<?php } ?>> 显示      
        <input type="radio" name="is_open" value="0" <?php if(!empty($field)&&$field["is_open"]==0){ ?>checked="true"<?php } ?>> 不显示<span class="require-field">*</span>
      </td>
    </tr>
    <tr>
      <td>文章作者</td>
      <td><input type="text" name="author" maxlength="60" value="<?php if(isset($field['author'])){echo $field['author'];} ?>" /></td>
    </tr>
    <tr>
      <td>文章图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>关键字</td>
      <td><input type="text" name="keywords" maxlength="60" value="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>" /></td>
    </tr>
    <tr>
      <td>网页描述</td>
      <td><textarea name="description" id="description" cols="40" rows="3"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
    <tr>
      <td>排序</td>
      <td><input type="text" name="rank" maxlength="60" value="<?php if(isset($field['rank'])){echo $field['rank'];} ?>" /></td>
    </tr>
    <tr>
      <td colspan="2" style="width:100%;text-align:left;">
        <!--引入并配置百度编辑器-->
          <script type="text/javascript" src="/data/ueditor/ueditor.config.js"></script>
          <script type="text/javascript" src="/data/ueditor/ueditor.all.min.js"></script>
          <script name="content" id="editor" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content'])){echo $field['content'];} ?></script>
          <script>
          window.UEDITOR_HOME_UER = '/data/Ueditor/';
          window.UEDITOR_CONFIG.imageUrl="<?php echo U('/Goods/upload') ?>";
          </script>
          <script type="text/javascript" src="/data/diy.ueditor.js"></script>
        <!--引入并配置百度编辑器-->
      </td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="id" value="<?php if(isset($field['id'])){echo $field['id'];} ?>" />
      <input type="hidden" name='code' value="<?php if(isset($GLOBALS['code'])){echo $GLOBALS['code'];} ?>" />
  </div>
  </form>
</div>
<script language='javascript'>
function CheckSubmit()
{
  if(document.form1.title.value=="")
  {
      document.form1.title.focus();
      alert("必须有文章名");
      $(':submit').css('display','inline');
      return false;
  }
  if(document.getElementById("cat_id").value=='0')
  {
      document.form1.title.focus();
      alert("请选择栏目");
      $(':submit').css('display','inline');
      return false;
  }
  return true;
}
</script>
</body>
</html>