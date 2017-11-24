<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加特长</title>
<?php $this->display('css','lib') ?>
<style>textarea{width:100%}</style>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加特长</p></div>
  <form action="<?php echo U('Report/zheye_runadd') ?>" method="post" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center">
  <?php if($field['cid']==4){?>
	<tr>
      <td>名称：</td>
      <td><input name="name" type="text" value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
    <tr>
      <td>对应基因：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/>(多个以,隔开)</td>
    </tr>
    <tr>
      <td>对应权重：</td>
      <td><input name="value" type="text" value='<?php if(isset($field['value'])){echo $field['value'];} ?>'/>(多个以,隔开)</td>
    </tr>
    <tr>
      <td>参考文献：</td>
      <td>
        <select name="typeid">
          <?php foreach ($typelist as $v){ ?>
          <option value='<?php if(isset($v['id'])){echo $v['id'];} ?>' <?php if(!empty($field)&&$field["typeid"]==$v["id"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['title'])){echo $v['title'];} ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>文字颜色：</td>
      <td><input name="yichuanglv" type="text" value='<?php if(isset($field['yichuanglv'])){echo $field['yichuanglv'];} ?>'/></td>
    </tr>
    <tr>
      <td>描述：</td>
      <td><textarea name="description" cols="40" rows="8"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
    <tr>
      <td>基因解读：</td>
      <td><script name="jianyi1" id="editor3" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['jianyi1'])){echo $field['jianyi1'];} ?></script></td>
    </tr>
    
<!--<tr>
  <td>培育建议3：</td>
  <td><textarea name="jianyi3" cols="40" rows="8"><?php if(isset($field['jianyi3'])){echo $field['jianyi3'];} ?></textarea></td>
</tr> -->
   
    <tr>
      <td>PC端图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>手机端图片：</td>
      <td>
        <input type='text' name='textfield1' id='textfield1' class='txt' value="<?php if(isset($field['litpic1'])){echo $field['litpic1'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic1" class="file" onchange="document.getElementById('textfield1').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>特长子页面：</td>
      <td>
        <input type='text' name='textfield2' id='textfield2' class='txt' value="<?php if(isset($field['litpic2'])){echo $field['litpic2'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic2" class="file" onchange="document.getElementById('textfield2').value=this.value" />
      </td>
    </tr>
    
<!--     <tr>
  <td>PC端图片：</td>
  <td>
    <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
    <input type='button' value='浏览...' /> 
    <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
  </td>
</tr> -->
    <tr>
      <td>减肥建议-无效：</td>
      <td>
	  <!--引入并配置百度编辑器-->
         
          <script name="content1" id="editor" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content1'])){echo $field['content1'];} ?></script>
		   
        <!--引入并配置百度编辑器-->
	 
	 </td>
    </tr>
    <tr>
      <td>减肥建议-部分有效</td>
      <td> <!--引入并配置百度编辑器-->
          
          <script name="content2" id="editor1" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content2'])){echo $field['content2'];} ?></script>
         
        <!--引入并配置百度编辑器--></td>
    </tr>
    <tr>
      <td>减肥建议-有效：</td>
      <td> <!--引入并配置百度编辑器-->
         
          <script name="content3" id="editor2" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content3'])){echo $field['content3'];} ?></script>
         
        <!--引入并配置百度编辑器--></td>
    </tr>
  <?php }else{?>
    <tr>
      <td>名称：</td>
      <td><input name="name" type="text" value='<?php if(isset($field['name'])){echo $field['name'];} ?>'/></td>
    </tr>
    <tr>
      <td>对应基因：</td>
      <td><input name="title" type="text" value='<?php if(isset($field['title'])){echo $field['title'];} ?>'/>(多个以,隔开)</td>
    </tr>
    <tr>
      <td>对应权重：</td>
      <td><input name="value" type="text" value='<?php if(isset($field['value'])){echo $field['value'];} ?>'/>(多个以,隔开)</td>
    </tr>
    <tr>
      <td>参考文献：</td>
      <td>
        <select name="typeid">
          <?php foreach ($typelist as $v){ ?>
          <option value='<?php if(isset($v['id'])){echo $v['id'];} ?>' <?php if(!empty($field)&&$field["typeid"]==$v["id"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['title'])){echo $v['title'];} ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>遗传率：</td>
      <td><input name="yichuanglv" type="text" value='<?php if(isset($field['yichuanglv'])){echo $field['yichuanglv'];} ?>'/></td>
    </tr>
    <tr>
      <td>描述：</td>
      <td><textarea name="description" cols="40" rows="8"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
    <tr>
      <td>能力提升：</td>
      <td><textarea name="jianyi1" cols="200" rows="8"><?php if(isset($field['jianyi1'])){echo $field['jianyi1'];} ?></textarea></td>
    </tr>
     <tr>
  <td>能力激发：</td>
  <td><textarea name="jianyi2" cols="200" rows="8"><?php if(isset($field['jianyi2'])){echo $field['jianyi2'];} ?></textarea></td>
</tr>
<!--<tr>
  <td>培育建议3：</td>
  <td><textarea name="jianyi3" cols="40" rows="8"><?php if(isset($field['jianyi3'])){echo $field['jianyi3'];} ?></textarea></td>
</tr> -->
    <tr>
      <td>优秀评价：</td>
      <td><textarea name="description1" cols="40" rows="2"><?php if(isset($field['description1'])){echo $field['description1'];} ?></textarea>(ps:未来小刘翔 情景记忆小天才 小小莫扎特)</td>
    </tr>
    <tr>
      <td>PC端图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>手机端图片：</td>
      <td>
        <input type='text' name='textfield1' id='textfield1' class='txt' value="<?php if(isset($field['litpic1'])){echo $field['litpic1'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic1" class="file" onchange="document.getElementById('textfield1').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>特长子页面：</td>
      <td>
        <input type='text' name='textfield2' id='textfield2' class='txt' value="<?php if(isset($field['litpic2'])){echo $field['litpic2'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic2" class="file" onchange="document.getElementById('textfield2').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>科学基础：</td>
      <td>
        <input type='text' name='textfield3' id='textfield3' class='txt' value="<?php if(isset($field['litpic3'])){echo $field['litpic3'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic3" class="file" onchange="document.getElementById('textfield3').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>基因知识</td>
      <td>
        <input type='text' name='textfield4' id='textfield4' class='txt' value="<?php if(isset($field['litpic4'])){echo $field['litpic4'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic4" class="file" onchange="document.getElementById('textfield4').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>基因故事：</td>
      <td>
        <input type='text' name='textfield5' id='textfield5' class='txt' value="<?php if(isset($field['litpic5'])){echo $field['litpic5'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="litpic5" class="file" onchange="document.getElementById('textfield5').value=this.value" />
      </td>
    </tr>
<!--     <tr>
  <td>PC端图片：</td>
  <td>
    <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>"/> 
    <input type='button' value='浏览...' /> 
    <input type="file" name="litpic" class="file" onchange="document.getElementById('textfield').value=this.value" />
  </td>
</tr> -->
    <tr>
      <td>科学基础：</td>
      <td>
	  <!--引入并配置百度编辑器-->
         
          <script name="content1" id="editor" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content1'])){echo $field['content1'];} ?></script>
		   
        <!--引入并配置百度编辑器-->
	 
	 </td>
    </tr>
    <tr>
      <td>基因知识</td>
      <td> <!--引入并配置百度编辑器-->
          
          <script name="content2" id="editor1" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content2'])){echo $field['content2'];} ?></script>
         
        <!--引入并配置百度编辑器--></td>
    </tr>
    <tr>
      <td>基因故事：</td>
      <td> <!--引入并配置百度编辑器-->
         
          <script name="content3" id="editor2" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['content3'])){echo $field['content3'];} ?></script>
         
        <!--引入并配置百度编辑器--></td>
    </tr>
	<?php }?>
  </table>
  <script type="text/javascript" src="/data/ueditor/ueditor.config.js"></script>
          <script type="text/javascript" src="/data/ueditor/ueditor.all.min.js"></script>
          <script>
          window.UEDITOR_HOME_UER = '/data/Ueditor/';
          window.UEDITOR_CONFIG.imageUrl="<?php echo U('/Report/upload') ?>";
          </script>
          <script type="text/javascript" src="/data/diy.ueditor.js"></script>
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
</style>