<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>

<link href="/public/gaiban/css/zhaopin.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="/public/gaiban/js/jquery-1.8.3.min.js"></script>

<!--[if lt IE 9]>
    <script type="text/javascript" src="js/PIE_IE678.js"></script>
	</script>
    <![endif]-->
<!--[if gt IE 8]>
	<script type="text/javascript" src="js/PIE_IE9.js"></script>
 <![endif]-->


</head>
<body>
	<?php $this->display('index:Index:header','lib') ?>
	
	<div class="w1000">
		<div class="row list">
			
			<img src='/public/gaiban/images/zhaopin.jpg' width="100%" />
			<ul class="list">
			<?php foreach ($list as $v){ ?>
			<li>
				<h3><?php if(isset($v['title'])){echo $v['title'];} ?></h3>
				<a href="javascript:dialog(<?php if(isset($v['id'])){echo $v['id'];} ?>);">了解更多▼</a>
			</li>
			<?php } ?>
			
			</ul>
		</div>
	</div>
	<div class="dialog">
		<div class="dialog_bg"></div>
		<div class="dialog_cont">
			<h3>产品经理</h3>
			<div class="dialog_c">
				<p>暂时没有相关信息</p>
				
			</div>
			<a href="javascript:;" class="close_dialog">关闭窗口</a>
		</div>
	</div>
	<?php $this->display('index:Index:footer','lib') ?>
</body>


<script language="javascript" >
function dialog(id){
$.get("/index/article/zhaopin",{'id':id},function(e){
	var status=e.status;
	if(status==1){
		$(".dialog .dialog_cont").html('<h3>'+e.title+'</h3><p>'+e.cont+'</p><a href="javascript:close_dialog();" class="close_dialog" >关闭窗口</a>')
	}else{
		$(".dialog .dialog_cont").html('<p>暂时没有相关信息</p><a href="javascript:close_dialog();" class="close_dialog">关闭窗口</a>')
	}
	$('.dialog').fadeIn();
	$('body').css('overflow','hidden');
},'json')


}
$('.dialog_bg').click(function(){
$('body').css('overflow','auto');
$('.dialog').fadeOut();
})
function close_dialog(){
$('body').css('overflow','auto');
$('.dialog').fadeOut();
}
</script>
</html>