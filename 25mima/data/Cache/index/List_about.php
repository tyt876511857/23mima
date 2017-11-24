<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('css','lib') ?>
</head>
<body id="list_news">
<?php $this->display('header','lib') ?>
<?php if(empty($field['litpic'])){?>
    <?php 
$attr =<<<Eof
type='type_banner'
Eof;
$c =<<<Eof
<div class="banner" style="background-image:url([field:litpic /]);"></div>
Eof;

	$data = $this->taglib->_myad($attr,$c);eval($data);?>
  <?php }else{ ?>
    <div class="banner" style="background-image:url(<?php if(isset($field['litpic'])){echo $field['litpic'];} ?>);"></div>
<?php } ?>
<div class="about w1000">
  
  <div id="position">
    <div class="position w1000">
      <a href="/">首页</a> &gt; <?php if(isset($field['typename'])){echo $field['typename'];} ?>
    </div>
  </div>
  <div class='left'>
    <h3>联系我们</h3>
    <?php if(isset($field['content'])){echo $field['content'];} ?>
  </div>
  <div class="right">
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="百度地图,百度地图API，百度地图自定义工具，百度地图所见即所得工具" />
    <meta name="description" content="百度地图API自定义地图，帮助用户在可视化操作下生成百度地图" />
    <title>百度地图API自定义地图</title>
    <!--引用百度地图API-->
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=jSUl3Y4ffESte3RSGzmIXltg"></script>
  </head>
  
  <body>
    <!--百度地图容器-->
    <div style="width:642px;height:475px;border:#ccc solid 1px;font-size:12px" id="map"></div>
  </body>
  <script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
      createMap();//创建地图
      setMapEvent();//设置地图事件
      addMapControl();//向地图添加控件
      addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){ 
      map = new BMap.Map("map"); 
      map.centerAndZoom(new BMap.Point(120.207021,30.19685),15);
    }
    function setMapEvent(){
      map.enableScrollWheelZoom();
      map.enableKeyboard();
      map.enableDragging();
      map.enableDoubleClickZoom()
    }
    function addClickHandler(target,window){
      target.addEventListener("click",function(){
        target.openInfoWindow(window);
      });
    }
    function addMapOverlay(){
    }
    //向地图添加控件
    function addMapControl(){
      var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
      scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
      map.addControl(scaleControl);
      var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
      map.addControl(navControl);
      var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
      map.addControl(overviewControl);
    }
    var map;
      initMap();
  </script>
</html>
  </div>
</div>
<?php $this->display('footer','lib') ?>
<script src="/public/js/index.js"></script>
</body>
</html>