<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加新检测项目</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加新检测项目</p></div>
  
  <form method="post" action="<?php echo U('/Goods/runjadd') ?>" enctype="multipart/form-data" name="theForm">
  <div id='tabs0'>
  <table class="addtable" border="0" align="center" >
    <tr>
      <td>检测项目名称：</td>
      <td><input type="text" name="title" value="<?php if(isset($field['title'])){echo $field['title'];} ?>" size="30" />&nbsp;
            <span>*</span>
      </td>
    </tr>
   
    <tr>
      <td>商品：</td>
      <td>
        <select name="gid">
          <option value="0">请选择...</option>
          <?php foreach ($cgoods as $v){ ?>
           
              <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if(!empty($field) && $v["id"]==$field["gid"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></option>
            
          <?php } ?>
        </select>
      </td>
    </tr>
   
    <tr>
      <td>上传图标图片：</td>
      <td>
        <input type='text' name='thumb' id='thumb' class='txt' value="<?php if(isset($field['thumb'])){echo $field['thumb'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="thumb" class="file" onchange="document.getElementById('thumb').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>是否显示：</td>
      <td>
        <input type="checkbox" name="ishidden" value="1" <?php if(!empty($field["ishidden"])){ ?>checked="checked"<?php } ?> /> 打勾表示隐藏，否则显示。
      </td>
    </tr>
	<tr>
	<td>说明文字：</td>
      <td colspan="2" style="width:80%;text-align:left;">
        <!--引入并配置百度编辑器-->
          <script type="text/javascript" src="/data/ueditor/ueditor.config.js"></script>
          <script type="text/javascript" src="/data/ueditor/ueditor.all.min.js"></script>
          <script name="desc" id="editor" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['pdesc'])){echo $field['pdesc'];} ?></script>
          <script>
          window.UEDITOR_HOME_UER = '/data/Ueditor/';
          window.UEDITOR_CONFIG.imageUrl="<?php echo U('/Goods/upload') ?>";
          </script>
          <script type="text/javascript" src="/data/diy.ueditor.js"></script>
        <!--引入并配置百度编辑器-->
      </td>
    </tr>
  </table>
  </div>
  
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
	  <?php if(empty($field)){ ?><?php }else{ ?><input type="hidden" name="type" value="update" /><?php } ?>
      <input type="hidden" name="id" value="<?php if(empty($field)){ ?>0<?php }else{ ?><?php if(isset($field['id'])){echo $field['id'];} ?><?php } ?>" />
  </div>
  </form>
</div>
</body>
</html>
<script type="text/javascript">
function getAttrList(){
  if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }else{// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function(){
    if(xmlhttp.readyState==4 && xmlhttp.status==200){
      document.getElementById("attrTable").innerHTML=xmlhttp.responseText;
    }
  }
  var selGoodsType = document.forms['theForm'].elements['goods_type'];
  if(selGoodsType != undefined){
    var goodsType = selGoodsType.options[selGoodsType.selectedIndex].value;
  }
  xmlhttp.open("GET","<?php echo U('Goods/type_info/id') ?>/"+goodsType,true);
  xmlhttp.send();
}

/*增加图片上传框*/
function addImg(obj){
    var src  = obj.parentNode.parentNode;
    var idx  = src.rowIndex;
    var tbl  = document.getElementById('gallery-table');
    var row  = tbl.insertRow(idx + 1);
    var cell = row.insertCell(-1);
    cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
}
/*删减图片上传框*/
function removeImg(obj){
      var row = obj.parentNode.parentNode.rowIndex;
      var tbl = document.getElementById('gallery-table');
      tbl.deleteRow(row);
}
//增加搭配商品
function add_goods_group(goods_id,goods_name){
  var str = '<li id="goods_group_'+goods_id+'" onclick="yichu(this);">'+goods_name+'<input type="hidden" name="goods_group[]" value="'+goods_id+'"/></li>';
  var kin = $('#goods_group');
  //alert($('#goods_group #goods_group_'+goods_id).html() );
  //判断左边已有的话就不需要再添加
  if(!$('#goods_group #goods_group_'+goods_id).html() ){
    $(str).appendTo(kin);
  }
}
//移除搭配商品
function yichu(obj){
  $('#'+obj.id).detach();
}
//商品属性添加复选框
function addSpec(obj){
    var src   = obj.parentNode.parentNode;
    var idx   = src.rowIndex;
    var tbl   = document.getElementById('attrTable');
    var row   = tbl.insertRow(idx + 1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var regx  = /<a([^>]+)<\/a>/i;

    cell1.className = 'label';
    cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");
    cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');
}
</script>