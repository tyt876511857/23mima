<html>
<head>
<title>管理中心</title>
<meta http-equiv='Content-Type' content='text/html';charset='utf-8'>
<?php $this->display('index:Index:css','lib') ?>
<?php $this->display('css','lib') ?>
</head>
<body id="site">
<?php $this->display('index:Index:header','lib') ?>
<div class="w1200">
	<?php $this->display('left','lib') ?>
	<div class="user_right">
        <p class="user_title">我的收藏</p>
		<div class="Favorite_list">
            <?php foreach ($list as $v){ ?>
              <a href="<?php if(isset($v['url'])){echo $v['url'];} ?>" target="_blank" title="<?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?>">
                <img src="<?php if(isset($v['goods_thumb'])){echo $v['goods_thumb'];} ?>">
                <p><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></p>
              </a>
            <?php } ?>
        </div>
	</div>
</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>