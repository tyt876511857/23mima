<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加分类</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加分类</p></div>
  <form action="<?php echo U('Category/runAdd') ?>" method="post" name="theForm" enctype="multipart/form-data">
  <table class="addtable" border="0" align="center" id="addtable">
    <tr>
      <td>分类名称:</td>
      <td><input type='text' name='typename' maxlength="20" value='<?php if(isset($field['typename'])){echo $field['typename'];} ?>' size='27' /> <font color="red">*</font></td>
    </tr>
    <tr>
      <td>上级分类:</td>
      <td>
        <select name="pid">
            <option value="0">顶级分类</option>
            <?php foreach ($cate as $v){ ?>
                <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if(!empty($field) && $v["id"]==$field["pid"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
                <?php foreach ($v['child'] as $j){ ?>
                    <option value="<?php if(isset($j['id'])){echo $j['id'];} ?>" >&nbsp;&nbsp;<?php if(isset($j['typename'])){echo $j['typename'];} ?></option>
                <?php } ?>
            <?php } ?>     
        </select>
      </td>
    </tr>
    <tr>
      <td>数量单位:</td>
      <td><input type="text" name='unit' value='' size="12" /></td>
    </tr>
    <tr>
      <td>排序:</td>
      <td><input type="text" name='rank'  value="50" size="15" /></td>
    </tr>
    <tr>
      <td>是否显示:</td>
      <td>
        <input type="radio" name="is_show" value="1"  <?php if(empty($field)||$field["is_show"]==1){ ?>checked="true"<?php } ?>/>是
        <input type="radio" name="is_show" value="0"  <?php if(!empty($field)&&$field["is_show"]==0){ ?>checked="true"<?php } ?>/>否        
      </td>
    </tr>
    <tr>
      <td>是否显示在导航栏:</td>
      <td>
        <input type="radio" name="show_in_nav" value="1" <?php if(!empty($field["show_in_nav"])==1){ ?>checked="true"<?php } ?> /> 是          
        <input type="radio" name="show_in_nav" value="0" <?php if(!empty($field["show_in_nav"])!=1){ ?>checked="true"<?php } ?> /> 否 
      </td>
    </tr>
    <tr>
      <td>筛选属性:</td>
      <td>
        <a href="javascript:;" onclick="addFilterAttr(this)">[+]</a> 
        <select onChange="changeCat(this)"><option value="0">请选择商品类型</option>
          <?php foreach ($goods_types as $v){ ?>
            <option value='<?php if(isset($v['cat_id'])){echo $v['cat_id'];} ?>'><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
          <?php } ?>
        </select>&nbsp;&nbsp;
        <select name="filter_attr[]"><option value="0">请选择筛选属性</option></select>
      </td>
      <script type="text/javascript">
          var arr = new Array();
          var sel_filter_attr = "请选择筛选属性";
          <?php foreach ($goods_types as $v){ ?>
            arr[<?php if(isset($v['cat_id'])){echo $v['cat_id'];} ?>] = new Array();
              <?php foreach ($v['attr'] as $k=>$j){ ?>
              arr[<?php if(isset($v['cat_id'])){echo $v['cat_id'];} ?>][<?php echo $k; ?>] = ["<?php if(isset($j['attr_name'])){echo $j['attr_name'];} ?>",<?php if(isset($j['attr_id'])){echo $j['attr_id'];} ?>];
              <?php } ?>
          <?php } ?>
          function changeCat(obj){
            var key = obj.value;
            var sel = window.ActiveXObject ? obj.parentNode.childNodes[4] : obj.parentNode.childNodes[5];
            sel.length = 0;
            sel.options[0] = new Option(sel_filter_attr, 0);
            if (arr[key] == undefined){
              return;
            }
            for (var i= 0; i < arr[key].length ;i++ ){
              sel.options[i+1] = new Option(arr[key][i][0], arr[key][i][1]);
            }
          }
          </script>
    </tr>
    <?php foreach ($goodsType as $j){ ?>
     <tr><td></td><td>
        <a href="javascript:;" onclick="reFilterAttr(this)">[-]</a> 
        <select onChange="changeCat(this)"><option value="0">请选择商品类型</option>
          <?php foreach ($goods_types as $v){ ?>
            <option value='<?php if(isset($v['cat_id'])){echo $v['cat_id'];} ?>' <?php if($j["cat_id"] == $v["cat_id"]){ ?>selected<?php } ?> ><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
          <?php } ?>
        </select>&nbsp;&nbsp;
        <select name="filter_attr[]"><option value="<?php if(isset($j['attr_id'])){echo $j['attr_id'];} ?>"><?php if(isset($j['attr_name'])){echo $j['attr_name'];} ?></option></select>
    </td></tr>   
    <?php } ?>
    <tr>
      <td>价格区间个数:</td>
      <td>
        <input class="left" type="text" name="grade" value="<?php if(!empty($field['grade'])){ ?><?php if(isset($field['grade'])){echo $field['grade'];} ?><?php }else{ ?>0<?php } ?>" size="4" />
        <span class="left" style="display:block">&nbsp;&nbsp;该选项表示该分类下商品最低价与最高价之间的划分的等级个数，填0表示不做分级，最多不能超过10个。</span>
      </td>
    </tr>
    <tr>
      <td>模板地址:</td>
      <td><input type="text" name="site" value="<?php if(empty($field)){ ?>List:category<?php }else{ ?><?php if(isset($field['site'])){echo $field['site'];} ?><?php } ?>" size="20" />类名:方法名(ps:List_category.html 写成 List:category)</td>
    </tr>
    <tr>
      <td>关键字:</td>
      <td><input type="text" name="keywords" value='<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>' size="50"></td>
    </tr>
    <tr>
      <td>分类描述:</td>
      <td><textarea name='description' rows="6" cols="48"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
    <tr>
      <td>html代码</td>
      <td>
      <textarea name="content" cols="80" rows="10"><?php if(isset($field['content'])){echo $field['content'];} ?></textarea>
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
<script>
  /*增加商品类型框*/
function addFilterAttr(obj){
    var src  = obj.parentNode.parentNode;
    var idx  = src.rowIndex;
    var tbl  = document.getElementById('addtable');
    var row  = tbl.insertRow(idx + 1);
    var cell = row.insertCell(-1);
    cell.innerHTML = src.cells[1].innerHTML.replace(/(.*)(addFilterAttr)(.*)(\[)(\+)/i, "$1reFilterAttr$3$4-");
    td = document.createElement("td");
    row.insertBefore(td,row.childNodes[0]);
}
/*删减商品类型框*/
function reFilterAttr(obj){
      var row = obj.parentNode.parentNode.rowIndex;
      var tbl = document.getElementById('addtable');
      tbl.deleteRow(row);
}
</script>