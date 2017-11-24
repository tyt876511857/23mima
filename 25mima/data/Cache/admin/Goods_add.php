<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加新商品</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加新商品</p></div>
  <ul id="tabs">
      <li onclick="nTabs(this,0)" class="li2">通用信息</li>
      <li onclick="nTabs(this,1)">详细描述</li>
      <li onclick="nTabs(this,2)">其他信息</li>
      <li onclick="nTabs(this,3)">手机描述</li>
      <!-- <li onclick="nTabs(this,3)">商品属性</li>
      <li onclick="nTabs(this,4)">商品相册</li>
      <li onclick="nTabs(this,5)">商品搭配</li> -->
  </ul> 
  <form method="post" action="<?php if(empty($field)){ ?><?php echo U('/Goods/runadd') ?><?php }else{ ?><?php echo U('/Goods/runadd/type/updata') ?><?php } ?>" enctype="multipart/form-data" name="theForm">
  <div id='tabs0'>
  <table class="addtable" border="0" align="center" >
    <tr>
      <td>商品名称：</td>
      <td><input type="text" name="goods_name" value="<?php if(isset($field['goods_name'])){echo $field['goods_name'];} ?>" size="30" />&nbsp;
            <span>*</span>
      </td>
    </tr>
    <tr>
      <td>商品货号：<br />&nbsp;</td>
      <td>
        <input type="text" name="goods_sn" value="<?php if(isset($field['goods_sn'])){echo $field['goods_sn'];} ?>" size="20" onblur="checkGoodsSn(this.value,'0')" /><br />
        <span>如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
      </td>
    </tr>
    <tr>
      <td>商品分类：</td>
      <td>
        <select name="cat_id">
          <option value="0">请选择...</option>
          <?php foreach ($cate as $v){ ?>
            <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>"  <?php if(!empty($field) && $v["id"]==$field["cat_id"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
            <?php foreach ($v['child'] as $j){ ?>
              <option value="<?php if(isset($j['id'])){echo $j['id'];} ?>" <?php if(!empty($field) && $j["id"]==$field["cat_id"]){ ?>selected='ture'<?php } ?>>&nbsp;&nbsp;<?php if(isset($j['typename'])){echo $j['typename'];} ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>商品品牌：</td>
      <td>
        <select name="brand_id">
          <option value="0">请选择...
          <?php foreach ($brand as $v){ ?>
            <option value="<?php if(isset($v['brand_id'])){echo $v['brand_id'];} ?>" <?php if(!empty($field) && $field["brand_id"]==$v["brand_id"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['brand_name'])){echo $v['brand_name'];} ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>示例报告：</td>
      <td>
        <select name="bg_id">
          <option value="0">请选择...</option>
          <?php foreach ($baogao as $v){ ?>
            <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if(!empty($field) && $field["bg_id"]==$v["id"]){ ?>selected='ture'<?php } ?>><?php if(isset($v['name'])){echo $v['name'];} ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>本店售价：</td>
      <td>
        <input type="text" name="shop_price" value="<?php if(empty($field)){ ?>0<?php }else{ ?><?php if(isset($field['shop_price'])){echo $field['shop_price'];} ?><?php } ?>" size="20" />
        <span class="require-field">*</span></td>
    </tr>
    <tr>
      <td>市场售价：</td>
      <td><input type="text" name="market_price" value="<?php if(empty($field)){ ?>0<?php }else{ ?><?php if(isset($field['market_price'])){echo $field['market_price'];} ?><?php } ?>" size="20" /></td>
    </tr>
    <tr>
      <td>商品浏览数：</td>
      <td><input type="text" name="click" value="<?php if(empty($field)){ ?>50<?php }else{ ?><?php if(isset($field['click'])){echo $field['click'];} ?><?php } ?>" size="20" /></td>
    </tr>
    <tr>
      <td>商品排序：</td>
      <td><input type="text" name="rank" value="<?php if(empty($field)){ ?>50<?php }else{ ?><?php if(isset($field['rank'])){echo $field['rank'];} ?><?php } ?>" size="20" /></td>
    </tr>
    <tr>
      <td>手机 检测项目：</td>
      <td>
        <input type='text' name='textfield2' id='textfield2' class='txt' value="<?php if(isset($field['goods_img1'])){echo $field['goods_img1'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="goods_img1" class="file" onchange="document.getElementById('textfield2').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>上传商品图片：</td>
      <td>
        <input type='text' name='textfield' id='textfield' class='txt' value="<?php if(isset($field['goods_img'])){echo $field['goods_img'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="goods_img" class="file" onchange="document.getElementById('textfield').value=this.value" />
      </td>
    </tr>
    <tr>
      <td>上传商品缩略图：</td>
      <td>
        <input type='text' name='textfield1' id='textfield1' class='txt' value="<?php if(isset($field['goods_thumb'])){echo $field['goods_thumb'];} ?>"/> 
        <input type='button' value='浏览...' /> 
        <input type="file" name="goods_thumb" class="file" onchange="document.getElementById('textfield1').value=this.value" />
        <Br /> 留空则自动生成
      </td>
    </tr>
  </table>
  </div>
  <div id='tabs1'>
  <table class="addtable" border="0" align="center">
    <tr>
      <td colspan="2" style="width:100%;text-align:left;">
        <!--引入并配置百度编辑器-->
          <script type="text/javascript" src="/data/ueditor/ueditor.config.js"></script>
          <script type="text/javascript" src="/data/ueditor/ueditor.all.min.js"></script>
          <script name="goods_brief" id="editor" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['goods_brief'])){echo $field['goods_brief'];} ?></script>
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
  <div id='tabs2'>
  <table class="addtable" border="0" align="center">
    <tr>
      <td>商品重量：</td>
      <td>
        <input type="text" name="goods_weight" value="<?php if(empty($field)){ ?>0<?php }else{ ?><?php if(isset($field['goods_weight'])){echo $field['goods_weight'];} ?><?php } ?>" size="20" />
        <select name="weight_unit">
          <option value="1" selected>千克</option>
          <option value="0.001">克</option>
        </select>
        </td>
    </tr>
    <tr>
      <td>商品库存数量：</td>
      <td><input type="text" name="goods_number" value="<?php if(empty($field)){ ?>500<?php }else{ ?><?php if(isset($field['goods_number'])){echo $field['goods_number'];} ?><?php } ?>" size="20" /></td>
    </tr>
    <tr>
      <td>库存警告数量：</td>
      <td><input type="text" name="warn_number" value="<?php if(empty($field)){ ?>10<?php }else{ ?><?php if(isset($field['warn_number'])){echo $field['warn_number'];} ?><?php } ?>" size="20" /></td>
    </tr>
    <tr>
      <td>加入推荐：</td>
      <td>
<input type="checkbox" name="is_best" value="1" <?php if(!empty($field)&&$field["is_best"]==1){ ?>checked="checked"<?php } ?> />精品 
<input type="checkbox" name="is_new" value="1"  <?php if(!empty($field)&&$field["is_new"]==1){ ?>checked="checked"<?php } ?> />新品 
<input type="checkbox" name="is_hot" value="1"  <?php if(!empty($field)&&$field["is_hot"]==1){ ?>checked="checked"<?php } ?> />热销
      </td>
    </tr>
    <tr>
      <td>上架：</td>
      <td>
        <input type="checkbox" name="is_on_sale" value="1" <?php if(empty($field)||$field["is_on_sale"]!=0){ ?>checked="checked"<?php } ?> /> 打勾表示允许销售，否则不允许销售。
      </td>
    </tr>
    <tr>
      <td>能作为普通商品销售：</td>
      <td>
        <input type="checkbox" name="is_alone_sale" value="1" <?php if(empty($field)||$field["is_alone_sale"]!=0){ ?>checked="checked"<?php } ?> /> 打勾表示能作为普通商品销售，否则只能作为配件或赠品销售。
      </td>
    </tr>
    <tr>
      <td>是否为免运费商品</td>
      <td><input type="checkbox" name="is_shipping" value="1" <?php if(!empty($field)&&$field["is_shipping"]!=0){ ?>checked="checked"<?php } ?> /> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。</td>
    </tr>
    <tr>
      <td>商品关键词：</td>
      <td><input type="text" name="keywords" value="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>" size="40" /> 用空格分隔</td>
    </tr>
    <tr>
      <td>商品简单描述：</td>
      <td><textarea name="description" cols="40" rows="3"><?php if(isset($field['description'])){echo $field['description'];} ?></textarea></td>
    </tr>
    <tr>
      <td>商家备注：</td>
      <td>
        <textarea name="seller_note" cols="40" rows="3"><?php if(isset($field['seller_note'])){echo $field['seller_note'];} ?></textarea><br />
        <span class="notice-span" style="display:block"  id="noticeSellerNote">仅供商家自己看的信息</span>
      </td>
    </tr>
  </table>
  </div>
  <div id='tabs3'>
    <table class="addtable" border="0" align="center">
    <tr>
      <td colspan="2" style="width:100%;text-align:left;">
        <!--引入并配置百度编辑器-->
          <script name="goods_brief1" id="editor1" type="text/plain" style="width:100%;height:500px;"><?php if(isset($field['goods_brief1'])){echo $field['goods_brief1'];} ?></script>
          <script>
          window.UEDITOR_HOME_UER = '/data/Ueditor/';
          window.UEDITOR_CONFIG.imageUrl="<?php echo U('/Goods/upload') ?>";
          </script>
          <script>
          UE.getEditor('editor1');</script>
        <!--引入并配置百度编辑器-->
      </td>
    </tr>
  </table>
  </div>
  <!-- <div id='tabs131'>
  <table class="addtable" border="0" align="center">
    <tr>
      <td>商品类型：</td>
      <td>
        <select name="goods_type" onchange="getAttrList(0)">
            <option value="0">请选择商品类型<br />&nbsp;</option>
            <?php foreach ($goods_type as $v){ ?>
            <option value='<?php if(isset($v['cat_id'])){echo $v['cat_id'];} ?>' <?php if(!empty($field) && $v["cat_id"]==$field["goods_type"]){ ?>selected='ture'<?php } ?> ><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
            <?php } ?>
        </select>
        <span>请选择商品的所属类型，进而完善此商品的属性</span>
      </td>
    </tr>
    <tr>
      <td id="tbody-goodsAttr" colspan="2" style="padding:0">
        <table id="attrTable">
          <?php echo $type_info; ?>
        </table>
      </td>
    </tr>
  </table>
  </div>
  <div id='tabs4'>
  <table class="addtable" border="0" align="center" id="gallery-table">
    <?php if(!empty($gallery)){ ?>
    <tr height='180'>
      <td>
      <?php foreach ($gallery as $v){ ?>
        <div id="gallery_<?php if(isset($v['img_id'])){echo $v['img_id'];} ?>" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
        <a href='<?php echo U("/Goods/dele_gallery/id/$v[img_id]") ?>' onclick="if(!confirm('您确实要删除该图片吗？')){return false;};">[-]</a><br />
        <a href="<?php if(isset($v['img_url'])){echo $v['img_url'];} ?>" target="_blank">
        <img src="<?php if(isset($v['img_url'])){echo $v['img_url'];} ?>" width="100" height="100" border="0" />
        </a><br />
        <input type="text" value="<?php if(isset($v['img_desc'])){echo $v['img_desc'];} ?>" size="15" name="old_img_desc[<?php if(isset($v['img_id'])){echo $v['img_id'];} ?>]" />
        </div>
      <?php } ?> 
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td>
        <a href="javascript:;" onclick="addImg(this)">[+]</a>
        图片描述 <input type="text" name="img_desc[]" size="20" />
        上传文件 
        <input type="file" name="img_url[]"  />
      </td>
    </tr>
  </table>
  </div>
  <div id='tabs5'>
  <table class="addtable" border="0" align="center">
    <tr>
      <td>
        <h3>商品搭配列表(点击移除)</h3>
        <ul id="goods_group" class="right">
          <?php foreach ($goods_group as $v){ ?>
            <li id='goods_group_<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>' onclick="yichu(this);"><?php echo $cache_goods_list[$v['group_goods_id']]['goods_name'];?><input type="hidden" name="goods_group[]" value='<?php if(isset($v['group_goods_id'])){echo $v['group_goods_id'];} ?>'></li>
          <?php } ?>
        </ul>
      </td>
      <td>
        <h3>选择搭配的商品(点击添加至左边)</h3>
        <ul>
          <?php foreach ($cache_goods_list as $v){ ?>
            <li onclick="add_goods_group('<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>','<?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?>');"><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></li>
          <?php } ?>
        </ul>
      </td>
    </tr>
  </table>
  </div> -->
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
      <input type="hidden" name="goods_id" value="<?php if(empty($field)){ ?>0<?php }else{ ?><?php if(isset($field['goods_id'])){echo $field['goods_id'];} ?><?php } ?>" />
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