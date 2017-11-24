<?php
Class UserAction extends Action{
	public function __construct(){
    	parent::__construct();
		$this->table = $this->t_user;
	}
	public function index(){
		$this->display();
	}
	public function update(){
		//判断邮箱是否合法
		if(!$this->is_email($_POST['email']) ){
			$this->error('邮箱不正确！');
		}
		//验证码是否正确
		$captcha = $_POST['captcha'];
		if(!verify($captcha)){
			$this->error('验证码错误！');
		}
		//判断是否有该邮箱
		$email = $_POST['email'];
		$sql = 'select id from '.$this->user.' where email="'.$email.'"';
		if(!$this->db->getNum($sql)){
			$this->error('该邮箱未注册');
		}
		//防止重复提交
		$sql = 'select id from '.$this->t_user.' where type=0 and time>'.time().' and email="'.$email.'"';
		if($this->db->getNum($sql)){
			$this->error('请不要重复提交');
		}
		$data['email'] = $email;
		//1天内有效
		$data['time']  = time()+3600*24;
		$data['rand']  = md5(rand(1,9999));
		$this->db->insert($this->table,$data);
		$url = __ROOT__.'User/runupdate/rand/'.$data['rand'].'/email/'.$data['email'];
		$cache_config = $this->shop_config();
		$array = array (
	        'address' => $data['email'],
	        'title'   => '找回密码',
	        'FromName'=> $cache_config['cfg_shop_name'],
	        'body'    => "亲爱的".$data['email']."：<br/>您在我们网站提交了找回密码请求。请点击下面的链接重置密码 
（按钮24小时内有效）。<br/><a href='".$url."'target='_blank'>".$url."</a>"
		);
		$this->email($array);
		$this->success('已发送邮件至您的邮箱!','/');
	}
	function runupdate(){
		$sql = 'select id from '.$this->table.' where type=0 and rand="'.$_GET['rand'].'" and email="'.$_GET['email'].'" and time>'.time();

		if($this->db->getNum($sql)){
			$this->display();
		}else{
			$this->success('链接已失效！','/');
		}
	}
	function email($data){
		$uri = __ROOT__.'data/email/index.php';
		// 参数数组
		$ch = curl_init();
		// print_r($ch);
		curl_setopt ( $ch, CURLOPT_URL, $uri );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data);
		$return = curl_exec ($ch);
		curl_close ($ch);
	}
	//修改密码
	function update1(){
		if(!( $_POST['pwd']!='' && $_POST['pwd']==$_POST['pwd1'] ) ){
			$this->error('两次密码不一致');
		}
		$sql = 'select id from '.$this->table.' where type=0 and rand="'.$_POST['rand'].'" and email="'.$_POST['email'].'" and time>'.time();
		if($this->db->getNum($sql)){
			$pwd = md5(md5($_POST['pwd']));
			$sql = 'update '.$this->user.' set pwd="'.$pwd.'" where email="'.$_POST['email'].'"';
			$this->db->query($sql);
			$sql = 'update '.$this->table.' set type=1 where rand="'.$_POST['rand'].'" and email="'.$_POST['email'].'"';
			$this->db->query($sql);
			$this->success('修改成功!','/');
		}else{
			$this->error('链接已失效！');
		}
	}
}
?>