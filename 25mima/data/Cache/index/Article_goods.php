<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/goods.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
<script>
$('.header ul li:eq(1) a').addClass('active');
</script>
	
	
	
	
	<div class="row" style=" position:relative">
	`<form action="<?php echo U('Shopping/mima') ?>" method="post">
		<input type="hidden" name="number[]" value="1" />
        <input type="hidden" name='goods_id[]' value="<?php if(isset($field['goods_id'])){echo $field['goods_id'];} ?>">
	  
		<?php if(isset($field['goods_brief'])){echo $field['goods_brief'];} ?>
		</form>
	</div>
	
	
	
	
<?php $this->display('index:Index:footer','lib') ?>
</body>
<script>
function dialog(id){
	$.get('<?php echo U("Goods/xianmuRow") ?>/id/'+id,function(data,status){
	var json = eval('(' + data + ')');
	$('#title').html(json['title']);
    $('#desc').html(json['pdesc']);
    $('.dialog').fadeIn();
  	});
}
$('.dialog').siblings().click(function(){
	$('.dialog').fadeOut();
})
</script>
</html>
<style>
	.ljgm{    border-radius: 10px;
    width: 200px;
	position:absolute;
	z-index:999;
	left:440px;
	top:400px;
    height: 52px;
    background: #d1bfb1;
    color: #fff;
    text-align: center;
    line-height: 52px;
    font-size: 28px;
    display: block;
    margin: 0 auto;}
</style>