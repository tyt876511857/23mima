<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>转移商品</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>转移商品</p></div>
  <form action="<?php echo U('/Category/runMove') ?>" method="post">
  <table class="addtable" border="0" align="center">
    <div style="font-weight:bold;padding:10px 0 0 10px;line-height:28px;"><img src="/Modules/admin/Tpl/public/images/notice.gif" width="16" height="16" border="0" /> 什么是转移商品分类?</div>
    <ul style="padding-left:40px;">
      <li>在添加商品或者在商品管理中,如果需要对商品的分类进行变更,那么你可以通过此功能,正确管理你的商品分类。</li>
    </ul>
    <tr>
      <td>
        <strong>从此分类</strong>&nbsp;&nbsp;
        <select name="cat_id">
          <option value="0">请选择...</option>
          <?php foreach ($cate as $v){ ?>
            <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if($v["id"]==$id){ ?>selected='ture'<?php } ?>><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
            <?php foreach ($v['child'] as $j){ ?>
              <option value="<?php if(isset($j['id'])){echo $j['id'];} ?>" <?php if($j["id"]==$id){ ?>selected='ture'<?php } ?>>&nbsp;&nbsp;<?php if(isset($j['typename'])){echo $j['typename'];} ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </td>
      <td>
        <strong class='left'>转移到&nbsp;&nbsp;</strong>
        <select name="target_cat_id" class='left'>
          <option value="0">请选择...</option>
          <?php foreach ($cate as $v){ ?>
            <option value="<?php if(isset($v['id'])){echo $v['id'];} ?>" <?php if($v["id"]==$id){ ?>selected='ture'<?php } ?>><?php if(isset($v['typename'])){echo $v['typename'];} ?></option>
            <?php foreach ($v['child'] as $j){ ?>
              <option value="<?php if(isset($j['id'])){echo $j['id'];} ?>" <?php if($j["id"]==$id){ ?>selected='ture'<?php } ?>>&nbsp;&nbsp;<?php if(isset($j['typename'])){echo $j['typename'];} ?></option>
            <?php } ?>
          <?php } ?>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
    </tr>
  </table>
  <div class="button-div">
      <input type="submit" value=" 转移 " />
      <input type="reset" value=" 重置 " />
  </div>
  </form>
</div>
</body>
</html>