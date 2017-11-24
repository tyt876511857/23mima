<?php
Class JsgetAction{
	//ajax获取商品评分
	function goods_stars(){
		$data = include_once(CACHE.'shop_stars.php');
		echo json_encode($data);
	}
	//获取用户信息
	function get_name(){
		$name = '';
		if(!empty($_SESSION["user_userid"])){
			$name = '<a>欢迎</a> <span><a href="'.U('Index/index','user').'">'.$_SESSION['user_userid'].'</a></span>';
			$log = '<a href="/user/Login/logout" class="li1">退出</a>';
		}else{
			$log = ' <a href="javascript:;" onclick="login();" class="li1">登录</a>';
		}
		$str = $name.''.$log;
		echo $str;
		die();
	}
	function erweima(){
		include 'data/phpqrcode/phpqrcode.php';
		QRcode::png('http://23mima.com/index/Index/index/i_type/'.$_GET['url'],'uploads/'.$_GET['url'].'.png');
	}
}
?>