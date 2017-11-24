<?php

//第三方登录

Class LoginAction extends Action{
	function aa(){
		$sql = 'select * from '.$this->user.' where logintype=4';
		$user = $this->db->getAll($sql);
		p($user);
	}
	function clear(){
		unset($_SESSION['openId']);
		p($_SESSION);
	}

	//微信

	function wapwechat(){
		$appid = 'wxda2e66f036932f53';
		$secret = '4eef13a5523d5d2bc583c4824f354563';
		$my_url = UrlEncode('http://23mima.com/Login/wapwechat');
		if(!empty($_GET['type'])  && $_GET['type']== 'base'){ //
			//通过oppid获取oppid
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$my_url.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
			header('location:'.$url);
			die();
		}elseif(!empty($_GET['type'])  && $_GET['type'] == 'userinfo'){
			log::write(3);
			//通过openid获取用户信息
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$my_url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
			header('location:'.$url);
			die();
		}

		if(!empty($_GET['code']) && !empty($_GET['state']) ){
			log::write(4);
			//获取unionid or oppid
			$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$_GET['code'].'&grant_type=authorization_code';
			$user = json_decode(file_get_contents($url));
			
			$_SESSION['openId'] = $user->openid;
			//查找是否已绑定手机
			$sql = 'select id,username from '.$this->user.' where openid="'.$user->openid.'"';
			$r = $this->db->getRow($sql);
		}
	    $this->communal($r);
	}

	//公用

	function communal($r){
		if(empty($_SESSION['login_url']) or strchr($_SESSION['login_url'],'Login/wapwechat')){
			$url = '/';
		}else{
			$url = $_SESSION['login_url'];
		}

		if(!empty($r['id'])){
			$_SESSION[C('APP_USER_NAME').'_id']		=	$r['id'];
			$_SESSION[C('APP_USER_NAME').'_userid']	=	$r['username'];
			$_SESSION['index_userid']				=	$r['username'];
			//更新登录新意
			$sql = 'update '.$this->user.' set logintime='.time().' where id='.$r['id'];
			$this->db->query($sql);
		}
		
		setcookie("login_url1",'',time()-1,'/');
		echo("<script>window.location.href='".$url."';</script>");
	}

}

?>

