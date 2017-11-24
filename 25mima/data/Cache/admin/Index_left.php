<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理页面</title>
<script src="/Modules/admin/Tpl/public/js/prototype.lite.js" type="text/javascript"></script>
<script src="/Modules/admin/Tpl/public/js/moo.fx.js" type="text/javascript"></script>
<script src="/Modules/admin/Tpl/public/js/moo.fx.pack.js" type="text/javascript"></script>
<style>
body {
  font:12px Arial, Helvetica, sans-serif;
  color: #000;
  background-color: #EEF2FB;
  margin: 0px;
}
#container {
  width: 182px;
}
H1 {
  font-size: 12px;
  margin: 0px;
  width: 182px;
  cursor: pointer;
  height: 30px;
  line-height: 20px;  
}
H1 a {
  display: block;
  width: 182px;
  color: #000;
  height: 30px;
  text-decoration: none;
  moz-outline-style: none;
  background-image: url(/Modules/admin/Tpl/public/images/menu_bgs.gif);
  background-repeat: no-repeat;
  line-height: 30px;
  text-align: center;
  margin: 0px;
  padding: 0px;
}
.content{
  width: 182px;
  height: 26px;
  
}
.MM ul {
  list-style-type: none;
  margin: 0px;
  padding: 0px;
  display: block;
}
.MM li {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  line-height: 26px;
  color: #333333;
  list-style-type: none;
  display: block;
  text-decoration: none;
  height: 26px;
  width: 182px;
  padding-left: 0px;
}
.MM {
  width: 182px;
  margin: 0px;
  padding: 0px;
  left: 0px;
  top: 0px;
  right: 0px;
  bottom: 0px;
  clip: rect(0px,0px,0px,0px);
}
.MM a:link {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  line-height: 26px;
  color: #333333;
  background-image: url(/Modules/admin/Tpl/public/images/menu_bg1.gif);
  background-repeat: no-repeat;
  height: 26px;
  width: 182px;
  display: block;
  text-align: center;
  margin: 0px;
  padding: 0px;
  overflow: hidden;
  text-decoration: none;
}
.MM a:visited {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  line-height: 26px;
  color: #333333;
  background-image: url(/Modules/admin/Tpl/public/images/menu_bg1.gif);
  background-repeat: no-repeat;
  display: block;
  text-align: center;
  margin: 0px;
  padding: 0px;
  height: 26px;
  width: 182px;
  text-decoration: none;
}
.MM a:active {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  line-height: 26px;
  color: #333333;
  background-image: url(/Modules/admin/Tpl/public/images/menu_bg1.gif);
  background-repeat: no-repeat;
  height: 26px;
  width: 182px;
  display: block;
  text-align: center;
  margin: 0px;
  padding: 0px;
  overflow: hidden;
  text-decoration: none;
}
.MM a:hover {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  line-height: 26px;
  font-weight: bold;
  color: #006600;
  background-image: url(/Modules/admin/Tpl/public/images/menu_bg2.gif);
  background-repeat: no-repeat;
  text-align: center;
  display: block;
  margin: 0px;
  padding: 0px;
  height: 26px;
  width: 182px;
  text-decoration: none;
}
</style>
</head>

<body>
<table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEF2FB">
  <tr>
    <td width="182" valign="top"><div id="container">
      <h1 class="type"><a href="javascript:void(0)">商品管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="MM">
          <li><a href="<?php echo U('/Goods/index') ?>" target="main">商品列表</a></li>
          <li><a href="<?php echo U('/Goods/add') ?>" target="main">添加商品</a></li>
          <li><a href="<?php echo U('/Category/index') ?>" target="main">商品分类</a></li>
		  <li><a href="<?php echo U('/Goods/jlist') ?>" target="main">检测项目</a></li>
          <!-- <li><a href="<?php echo U('/Brand/index') ?>" target="main">商品品牌</a></li>
          <li><a href="<?php echo U('/GoodsType/index') ?>" target="main">商品类型</a></li>
          <li><a href="<?php echo U('/Goods/recycle') ?>" target="main">商品回收站</a></li> -->
          
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">缓存管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="MM">
          <li><a href="<?php echo U('/Index/delete_cache') ?>" target="main">清除缓存</a></li>
          <!-- <li><a href="<?php echo U('/Index/delete_litpic') ?>" target="main">清除无用图片</a></li> -->
          <li><a href="<?php echo U('/Index/delete_sql') ?>" target="main">清除备份数据</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">辅助插件</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="MM">
          <li><a href="<?php echo U('/Myad/index') ?>" target="main">广告列表</a></li>
          <li><a href="<?php echo U('/Link/index') ?>" target="main">友情链接</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">栏目内容管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="MM">
          <li><a href="<?php echo U('/News/index') ?>" target="main">栏目管理</a></li>
          <li><a href="<?php echo U('/Article/index') ?>" target="main">文章列表</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">会员管理</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="MM">
          <li><a href="<?php echo U('Member/index') ?>" target="main">会员列表</a></li>
          <li><a href="<?php echo U('Indent/handle') ?>" target="main">待处理订单</a></li>
          <li><a href="<?php echo U('Indent/index') ?>" target="main">订单列表</a></li>
          <li><a href="<?php echo U('Indent/sum') ?>" target="main">订单统计</a></li>
<!--           <li><a href="<?php echo U('Comment/index') ?>" target="main">商品评论列表</a></li>
<li><a href="<?php echo U('Comment/index/type/news') ?>" target="main">文章评论列表</a></li> -->
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">系统设置</a></h1>
      <div class="content">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
          </tr>
        </table>
        <ul class="MM">
          <li><a href="<?php echo U('System/index') ?>" target="main">商店设置</a></li>
          <li><a href="<?php echo U('Mysql/add') ?>" target="main">操作数据库</a></li>
          <li><a href="<?php echo U('Rbac/index') ?>" target="main">系统用户管理</a></li>
          <li><a href="<?php echo U('Rbac/group') ?>" target="main">用户组设定</a></li>
        </ul>
      </div>
      <h1 class="type"><a href="javascript:void(0)">其他扩展</a></h1>
      <div class="content">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
            </tr>
          </table>
        <ul class="MM">
          <li><a href="<?php echo U('/Report/index') ?>" target="main">产品基因</a></li>
          <li><a href="<?php echo U('/Report/baogao') ?>" target="main">报告列表</a></li>
          <li><a href="<?php echo U('/Report/tuoye') ?>" target="main">已绑定列表</a></li>
          <!--<li><a href="<?php echo U('/Report/banding') ?>" target="main">编码绑定列表</a></li> -->
          <!-- <li><a href="<?php echo U('/Report/zheye_index') ?>" target="main">特长管理</a></li> -->
		      <li><a href="<?php echo U('/Code/index') ?>" target="main">编码生成列表</a></li>
          <li><a href="<?php echo U('/Report/youhui') ?>" target="main">优惠码列表</a></li>
          <li><a href="<?php echo U('/Report/identify') ?>" target="main">二维码标识</a></li>
        </ul>
      </div>
       <h1 class="type"><a href="javascript:void(0)">经销商管理</a></h1>
      <div class="content">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><img src="/Modules/admin/Tpl/public/images/menu_topline.gif" width="182" height="5" /></td>
            </tr>
          </table>
        <ul class="MM">
          <li><a href="<?php echo U('/Jingxiaoshang/index') ?>" target="main">经销商列表</a></li>
          <li><a href="<?php echo U('/Jingxiaoshang/users') ?>" target="main">会员管理</a></li>
          <li><a href="<?php echo U('/Jingxiaoshang/orders') ?>" target="main">消费明细</a></li>
          
        </ul>
      </div>   </div>
        <script type="text/javascript">
    var contents = document.getElementsByClassName('content');
    var toggles = document.getElementsByClassName('type');
  
    var myAccordion = new fx.Accordion(
      toggles, contents, {opacity: true, duration: 400}
    );
    myAccordion.showThisHideOpen(contents[0]);
  </script>
        </td>
  </tr>
</table>
</body>
</html>