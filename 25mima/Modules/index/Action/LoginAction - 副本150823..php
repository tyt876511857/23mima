<?php

//第三方登录

Class LoginAction extends Action{
	public function qq(){
	  	//应用的APPID

	  	$app_id = "101233016";

		//应用的APPKEY

		$app_secret = "fe1b1a0813d129af49cb630ee8e5a2db";

		//成功授权后的回调地址

		$my_url = __ROOT__."/Qqlogin";

		$code = $_REQUEST["code"];

		if(empty($code)){

		 //state参数用于防止CSRF攻击，成功授权后回调时会原样带回

		 $_SESSION['state'] = md5(uniqid(rand(), TRUE));

		 //拼接URL     

		 $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 

		    . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="

		    . $_SESSION['state'];

		 echo("<script> top.location.href='" . $dialog_url . "'</script>");

		}



		if($_REQUEST['state'] == $_SESSION['QC_userData']['state']){

			//拼接URL   

			$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&" . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret=" . $app_secret . "&code=" . $code;

			$response = file_get_contents($token_url);

			if (strpos($response, "callback") !== false){

				$lpos = strpos($response, "(");

				$rpos = strrpos($response, ")");

				$response  = substr($response, $lpos + 1, $rpos - $lpos -1);

				$msg = json_decode($response);

				if (isset($msg->error)){

				   echo "<h3>error:</h3>" . $msg->error;

				   echo "<h3>msg  :</h3>" . $msg->error_description;

				   exit;

				}

			}

		 

		     //Step3：使用Access Token来获取用户的OpenID

		     $params = array();

		     parse_str($response, $params);

		     $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token'];

		     $str  = file_get_contents($graph_url);

		     if (strpos($str, "callback") !== false){

		        $lpos = strpos($str, "(");

		        $rpos = strrpos($str, ")");

		        $str  = substr($str, $lpos + 1, $rpos - $lpos -1);

		     }

		     $user = json_decode($str);

		     if (isset($user->error)){

		        echo "<h3>error:</h3>" . $user->error;

		        echo "<h3>msg  :</h3>" . $user->error_description;

		        exit;

		     }

		     //echo("Hello " . $user->openid);

		     //判断是否已注册

		    $sql = 'select id,username from '.$this->user.' where logintype=1 and openid="'.$user->openid.'"';

		    $r = $this->db->getRow($sql);

		    if(empty($r)){

		     	$get_user_url = 'https://graph.qq.com/user/get_user_info?access_token='.$params['access_token'].'&oauth_consumer_key='.$app_id.'&openid='.$user->openid;

		     	$info = file_get_contents($get_user_url);

		     	$info = json_decode($info,true);

		     	$info['nickname'] = $this->verifyName($info['nickname']);

		     	$data = array('username'=>$info['nickname'],'openid'=>$user->openid,'register'=>time(),'logintime'=>time(),'logintype'=>'1','loginip'=>CLIENT_IP);

		     	$this->db->insert($this->user,$data);

		     	$r['id'] = mysql_insert_id();

		    	$r['username']=$info['nickname'];

		    }

		    $this->communal($r);
		  }else{
		     echo("The state does not match. You may be a victim of CSRF.");

		  }

	}

	//微信

	function wapwechat(){
		$appid = 'wxa2391f272c58ec25';
		$secret = '88aa88f506cec8962d413950f6dc1163';
		$my_url = UrlEncode('http://alumduan.com/Login/wapwechat');

		if($_GET['type'] == 'base'){
			//通过oppid获取oppid
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$my_url.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
			header('location:'.$url);
			die();
		}elseif($_GET['type'] == 'userinfo'){
			//通过openid获取用户信息
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$my_url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
			header('location:'.$url);
			die();
		}

		if(!empty($_GET['code']) && !empty($_GET['state']) ){
			//获取unionid or oppid
			$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$_GET['code'].'&grant_type=authorization_code';
			$user = json_decode(file_get_contents($url));

			//没有错误则执行
			if(empty($user->errcode) && !empty($user->unionid)){

				$sql = 'select id,username from '.$this->user.' where logintype=2 and openid="'.$user->unionid.'"';
				$r = $this->db->getRow($sql);
				if($_GET['state'] == '123' && empty($r) ){
			    	header('location:http://alumduan.com/Login/wapwechat/type/userinfo');
			    	die();
				}elseif($_GET['state'] == 'STATE' && empty($r)){
					$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$user->access_token.'&openid='.$user->openid.'&lang=zh_CN';
					$info = json_decode(file_get_contents($url));
					if(!isset($info->errcode)){
						$info->nickname = $this->verifyName($info->nickname);
				     	$data = array('username'=>$info->nickname,'openid'=>$user->unionid,'register'=>time(),'logintime'=>time(),'logintype'=>'2','loginip'=>CLIENT_IP);
				     	$this->db->insert($this->user,$data);
						$r = '';
				     	$r['id'] = mysql_insert_id();
				    	$r['username']=$info->nickname;
					}
				}
			}
		}
	    $this->communal($r);
	}

	function wechat(){

		$appid  = 'wxa5d145d03ef4b055';

		$my_url = UrlEncode('http://alumduan.com/Login/wechat');

		$appSecret='aa0c54fc00ce504b48d4aee3935b36ca';

		//点击跳转至授权页面

		if(!empty($_GET['type']) && $_GET['type']=='login'){
			header('location:https://open.weixin.qq.com/connect/qrconnect?appid='.$appid.'&redirect_uri='.$my_url.'&response_type=code&scope=snsapi_login&state=3d6be0a4035d839573b04816624a415e#wechat_redirect');
			die();
		}

		if(empty($_GET['code'])){

			$this->error('请使用其他方式登录！');

		}else{

			//获取到openid

			$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appSecret.'&code='.$_GET['code'].'&grant_type=authorization_code';

			$user = file_get_contents($url);

			$user = json_decode($user);
			if($user->errcode == '-1'){
				$this->success('系统错误，请稍后登录',__ROOT__);
			}

				//判断是否已注册
				$sql = 'select id,username from '.$this->user.' where logintype=2 and openid="'.$user->unionid.'"';
			    $r = $this->db->getRow($sql);

			    if(empty($r) && !empty($user->unionid) ){

			    	//通过openid获取用户信息

					$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$user->access_token.'&openid='.$user->openid;

					$info = file_get_contents($url);

					$info = json_decode($info);

			     	$info->nickname = $this->verifyName($info->nickname);

			     	$data = array('username'=>$info->nickname,'openid'=>$user->unionid,'register'=>time(),'logintime'=>time(),'logintype'=>'2','loginip'=>CLIENT_IP);

			     	$this->db->insert($this->user,$data);
			     	$r = '';
			     	$r['id'] = mysql_insert_id();
			    	$r['username']=$info->nickname;
			    }
			    $this->communal($r);
			    

		}
	}

	//公用

	function communal($r){
		$_SESSION[C('APP_USER_NAME').'_id']		=	$r['id'];
		$_SESSION[C('APP_USER_NAME').'_userid']	=	$r['username'];
		$_SESSION['index_userid']				=	$r['username'];
		//更新登录新意
		$sql = 'update '.$this->user.' set logintime='.time().' where id='.$r['id'];
		$this->db->query($sql);
		//$this->success('登录成功！','/');
/*		if(empty($_COOKIE["login_url1"])){
			$url = '/';
		}else{
			$url =$_COOKIE["login_url1"];
		}*/
		if(empty($_SESSION['login_url'])){
			$url = '/';
		}else{
			$url = $_SESSION['login_url'];
		}
		setcookie("login_url1",'',time()-1,'/');
		echo("<script>window.location.href='".$url."';</script>");
		
		

	}

	//验证

	function verifyName($name){

		$sql = 'select id from '.$this->user.' where username="'.$name.'"';

		$r = $this->db->getRow($sql);

		if(empty($r)){

			return $name;

		}else{

			$name = $this->verifyName($name.'_'.rand(1,9999));

			return $name;

		}

	}

	//新浪登录

	function sinalogin(){

		include_once( 'data/wblogin/config.php' );

		include_once( 'data/wblogin/saetv2.ex.class.php' );

		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

		$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

		echo("<script>window.location.href='$code_url';</script>");

	}

	function sina(){

		include_once( 'data/wblogin/config.php' );

		include_once( 'data/wblogin/saetv2.ex.class.php' );

		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

		if (isset($_REQUEST['code'])) {

			$keys = array();

			$keys['code'] = $_REQUEST['code'];

			$keys['redirect_uri'] = WB_CALLBACK_URL;

			try {

				$token = $o->getAccessToken( 'code', $keys );

			} catch (OAuthException $e) {

			}

		}

		if ($token) {

			$_SESSION['token'] = $token;

			setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );

			//echo '授权完成,<a href="data/wblogin/weibolist.php">进入你的微博列表页面</a><br />';

		} else {

			$this->error('授权失败。');

		}

		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );

		$ms  = $c->home_timeline(); // done

		$uid_get = $c->get_uid();

		$uid = $uid_get['uid'];

		//判断是否已注册

	    $sql = 'select id,username from '.$this->user.' where logintype=3 and openid="'.$uid.'"';

	    $r = $this->db->getRow($sql);

	    if(empty($r)){

	     	$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

	     	$user_message['screen_name'] = $this->verifyName($user_message['screen_name']);

	     	$data = array('username'=>$user_message['screen_name'],'openid'=>$uid,'register'=>time(),'logintime'=>time(),'logintype'=>'3','loginip'=>CLIENT_IP);

	     	$this->db->insert($this->user,$data);

	     	$r['id'] = mysql_insert_id();

	    	$r['username']=$user_message['screen_name'];

	    }

	    $this->communal($r);

	}

	//豆瓣

	function douban(){

		//应用的key

	  	$app_key = "093099e3d8a747061b91cdab89f5d512";

		//应用的secret

		$app_secret = "ff969127d9ca2a0a";

		//成功授权后的回调地址

		$my_url = __ROOT__."Login/douban";

		//应用向豆瓣请求授权

		if(!empty($_GET['type'])){

			$code_url = 'https://www.douban.com/service/auth2/auth?client_id='.$app_key.'&redirect_uri='.$my_url.'&response_type=code';

			echo("<script>window.location.href='$code_url';</script>");

		}

		//用户拒绝授权

		if($_GET['error'] == 'access_denied'){

			$this->error('请使用其他方式登录！');

		}

		$code = $_GET['code'];

		if(!empty($code)){

			$url = 'https://www.douban.com/service/auth2/token';

			$data = array(

				'client_id' =>$app_key,

				'client_secret' => $app_secret,

				'redirect_uri' =>$my_url,

				'grant_type'=>'authorization_code',

				'code'=>$code

			);



			$ch = curl_init();

			// print_r($ch);

			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

			//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

			//curl_setopt($ch, CURLOPT_TIMEOUT, 30);

			curl_setopt ( $ch, CURLOPT_URL, $url);

			curl_setopt ( $ch, CURLOPT_POST,1);

			curl_setopt ( $ch, CURLOPT_HEADER,0);

			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER,1);

			curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query($data));

			$return = curl_exec ($ch);

			curl_close ($ch);

			$json_r=array();
			$json_r=json_decode($return, true);

			//判断是否已注册

		    $sql = 'select id,username from '.$this->user.' where logintype=4 and openid="'.$json_r['douban_user_id'].'"';

		    $r = $this->db->getRow($sql);

		    if(empty($r)){
		    	$json_r['douban_user_name'] = $this->verifyName($json_r['douban_user_name']);
		     	$data = array('username'=>$json_r['douban_user_name'],'openid'=>$json_r['douban_user_id'],'register'=>time(),'logintime'=>time(),'logintype'=>'4','loginip'=>CLIENT_IP);

		     	$this->db->insert($this->user,$data);

		     	$r['id'] = mysql_insert_id();

		    	$r['username']=$json_r['douban_user_name'];

		    }
		    $this->communal($r);

		}

	}



}

?>

