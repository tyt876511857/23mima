<?php
Class LoginAction extends CommonAction{
	// 自动填充
	//public $this->time = time();
	protected $_auto = array(
                            array('logintime','value',TIME),
                            array('register','value',TIME),
                            array('loginip','value',CLIENT_IP),
    );
	//验证数据安全
	protected $_valid = array(
                            array('username',1,'必须有用户名','require'),
                            array('pwd',1,'必须有密码','require'),
                            array('email',3,'请正确输入邮箱',1)
    );
    public function __construct(){
    	parent::__construct();
    	$this->table = $this->user;
		$this->fields = $this->db->desc_field($this->table);
	}

	public function index(){
		if(strchr($_SESSION['loginurl'],'/user/') != false){
			$this->success('请先登录!','/#h_logio');
		}elseif($_SESSION['shibei'] == 'www'){
			$this->success('请先登录!',$_SESSION['loginurl']);
		}else{
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
			
				if(empty($_SESSION['openId'])){
					//$this->success('请先登录!',$_SESSION['loginurl']);
					 header('location:http://23mima.com/index/Login/wapwechat/type/base');
					// die();
				}else{
					$sql = 'select * from '.$this->user.' where openid="'.$_SESSION['openId'].'"';
					$r = $this->db->getRow($sql);
					if($r){
						$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
						$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
						$_SESSION['index_userid']				= $r['username'];
						//更新登录新意
						$sql = 'update '.$this->user.' set logintime='.time().' where id='.$r['id'];
						$this->db->query($sql);
						exit($_SESSION['login_url']);
						header('location:'.$_SESSION['login_url']);
						die();
					}else{
						$this->success('请先登录!',$_SESSION['loginurl']);
					}
				}
			}
		}
		die();
	}
	/*注册过程*/
	public function RunRegister(){
		$data = $this->verify($this->user);
		if($data['pwd'] != $_POST['pwd1']){
			$this->error('两次密码不一致！');
		}
		$data['pwd'] = md5(md5($data['pwd']));
		$sql = 'select id from '.$this->user.' where username="'.$data['username'].'"';
		$r = $this->db->getNum($sql);
		if($r){
			$this->error('此用户名已被注册!');
		}
		$sql = 'select id from '.$this->user.' where email="'.$data['email'].'"';
		$r = $this->db->getNum($sql);
		if($r){
			$this->error('此邮箱已被注册!');
		}
		$r = $this->db->insert($this->user,$data);
		if($r){
			$type = C('APP_INDEX_NAME');
			$_SESSION[C('APP_USER_NAME').'_id']=mysql_insert_id();
			$_SESSION[C('APP_USER_NAME').'_userid']=$data['username'];
			$_SESSION[C('APP_INDEX_NAME').'_userid']=$data['username'];
			$this->success('注册成功！',U('',$type));
		}
	}
	/*登录 */
	public function login(){
		$username = $_POST['username'];
		$password = md5(md5($_POST['pwd']));
		$sql ='select id,username from '.$this->table . ' where (username="'.$username.'" or email="'.$username.'") and pwd="'.$password.'"';
		$r = $this->db->getRow($sql);
		if(empty($r['id'])){
			$this->error('帐号或密码错误！');
		}
		$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
		$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
		$_SESSION['index_userid']				= $r['username'];
		//更新登录新意
		$sql = 'update '.$this->user.' set logintime='.time().' where id='.$r['id'];
		$this->db->query($sql);
		$this->success('登录成功！',$_SERVER['HTTP_REFERER']);
	}
	//退出登录
	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user_userid']);
		unset($_SESSION['index_userid']);
		$this->success('成功退出！','/');
	}
}
?>