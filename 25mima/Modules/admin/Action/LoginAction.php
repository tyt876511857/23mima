<?php
Class LoginAction extends Action{
	function index(){
		$this->display('Login:index');
	}
	public function running(){
		$userid = $_POST['username'];
		$password = md5($_POST['password']);
		if(empty($_SESSION['weixin'])){
		//	$captcha = $_POST['captcha'];
			//if(!verify($captcha)){
				//$this->error('验证码错误！');
				//return false;
			//}
		}
		
		$sql ='select id from '.$this->admin . ' where userid="'.$userid.'" and pwd="'.$password.'"';
		$r = $this->db->getRow($sql);
		if(empty($r['id'])){
			$this->error('帐号或密码错误！');
		}
		//更新登录时间和IP
		$sql = 'update '.$this->admin .' set logintime='.time().',loginip="'.CLIENT_IP.'" where id='.$r['id'];
		$this->db->query($sql);
		$_SESSION[$GLOBALS['path_info']['0'].'_userid']=$userid;
		$_SESSION[$GLOBALS['path_info']['0'].'_id']=$r['id'];
		//rbac
		//权限表
		$sql = 'select name from '.$this->purviews.' where id>10';
		$r = $this->db->getAll($sql);
		$_SESSION['rbac'] = '';
		foreach($r as $v){
			$_SESSION['rbac'][] = $v['name'];
		}
		//管理员ID所拥有的权限
		$admin_id = $_SESSION[$GLOBALS['path_info']['0'].'_id'];
		$sql = 'select t.purviews from '.$this->admin .' as a left join '.$this->admintype .' as t on a.usertype=t.id where a.id='.$admin_id;
		$r = $this->db->getRow($sql);
		$_SESSION['rbac1'] = explode(',',$r['purviews']);
		if(empty($_SESSION['weixin'])){
			$this->success('登录成功！',U('Index/index'));
		}else{
			$this->success('null',U('Index/wap_index'));
		}
	}
	public function out(){
		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_userid']);
		$this->success('成功退出！',U('Login/index'));
	}
	public function captcha(){
		Images::captcha(48,22);
	}
}
?>