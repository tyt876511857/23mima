<?php
class CommonAction extends Action{
    protected $_auto = array();
    //验证数据安全
    protected $_valid = array();
    public  function __construct(){
        parent::__construct();
        $this->is_login();// 是否已登录
        //是否有权限
        if($GLOBALS['path_info'][0] == C('APP_ADMIN_NAME')){
            $this->_initialize();
        }
    }
    // 是否已登录
    public function _initialize(){
        $RBAC = new RBAC();
        $RBAC->purviews();
    }
    protected function is_login(){
        $array = array('/user/Login/login','/user/Login/RunRegister','/user/Login/index');//在此数组内的不需要
        if(!isset($_SESSION[$GLOBALS['path_info']['0'].'_userid'])  && !in_array($GLOBALS['_SERVER']['REQUEST_URI'],$array) ){
            //判断跳转到哪一个登录页面 
           if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
				if(empty($_SESSION['openId'])){
							//$this->success('请先登录!',$_SESSION['loginurl']);
							 header('location:http://23mima.com/index/Login/wapwechat/type/base');
							 die();
				}else{
					$sql = 'select * from '.$this->user.' where openid="'.$_SESSION['openId'].'"';
					$r = $this->db->getRow($sql);
					if($r){
						$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
						$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
						$_SESSION['index_userid']				= $r['username'];
						//更新登录新意
						$sql = 'update '.$this->user.' set openid="'.$_SESSION['openId'].'",logintime='.time().' where id='.$r['id'];
						$this->db->query($sql);
						exit($_SESSION['login_url']);
						header('location:'.$_SESSION['login_url']);
						die();
					}else{
						$this->success('请先登录!',$_SESSION['loginurl']);
					}
				}
			}else{
			    $type = $GLOBALS['path_info']['0'] == C('APP_ADMIN_NAME')?C('APP_ADMIN_NAME'):C('APP_USER_NAME');
				header('Location:'.U('/Login/index',$type));
				die();
			}

        }else{
            if($GLOBALS['path_info']['0'] != C('APP_ADMIN_NAME')){
                if(!empty($_SESSION['user_id'])){
                    $this->user_name    = $_SESSION['user_userid'];
                    $this->user_id      = $_SESSION['user_id'];
                }
            }else{
                $this->admin_name    = $_SESSION['admin_userid'];
                $this->admin_id      = $_SESSION['admin_id'];
            }
        }
    }
	//提交前先验证数据安全
    protected function verify(){
    	$data = $this->_facade($_POST); // 自动过滤
		$data = $this->_autoFill($data,$_POST); // 自动填充
        $data = $this->_overflow($data,$this->table);//控制溢出
		//自动验证
		if(!$this->_validate($data)){
		    //$str = '数据不合法:';
		    $str = implode(',',$this->getErr());
            $this->error($str);
            die();
		}
		return $data;
    }
    /*控制溢出*/
    public function _overflow($data,$table){
        //验证数据是否超出
        $sql = 'desc '.$table;
        $r = $this->db->getAll($sql);
        foreach($r as $v){
            if(preg_match('/char\(\d*\)/',$v['Type'],$c)){
                $arr[$v['Field']] = substr($c['0'],5,-1);
            }
        }
        foreach($arr as $k=>$v){
            if(!empty($data[$k]) && is_string($data[$k])){
                if(mb_strlen($data[$k],C('DB_CHAR'))>$v){
                    $this->error($k.'字段不可以超过'.$v.'个字！');
                }
            }
        }
        return $data;
    }

	/*
        自动过滤:
    */
	public function _facade($array=array()) {
        $data = array();
        foreach($array as $k=>$v) {
            if(in_array($k,$this->fields)) {  // 判断$k是否是表的字段
                $data[$k] = $v;
            }
        }

        return $data;
    }

	
    /*
    自动填充
    */
    public function _autoFill($data,$_POST) {
        foreach($this->_auto as $k=>$v) {
            if(empty($_POST[$v[0]]) || !array_key_exists($v[0],$data)) {
                switch($v[1]) {
                    case 'value':
                    $data[$v[0]] = $v[2];
                    break;

                    case 'function':
                    $data[$v[0]] = call_user_func($v[2]);
                    break;
                }
            }
        }

        return $data;
    }
    /*
        格式 $this->_valid = array(
                    array('验证的字段名',0/1/2(验证场景),'报错提示','require/in(某几种情况)/between(范围)/length(某个范围)','参数')
        );

        array('goods_name',1,'必须有商品名','require'),
        array('cat_id',1,'栏目id必须是整型值','number'),
		array('cat_id',1,'栏目id必须是整型值并非0','non_zero'),
        array('is_new',0,'in_new只能是0或1','in','0,1')
        array('goods_breif',2,'商品简介就在10到100字符','length','10,100')
        array('email',3,'邮箱不正确','1')1为必须填写邮箱
    */
    public function _validate($data) {
        if(empty($this->_valid)) {
            return true;
        }

        $this->error = array();

        foreach($this->_valid as $k=>$v) {
            switch($v[1]) {
                case 1:
                    if(!isset($data[$v[0]])) {
                        $this->error[] = $v[2];
                        return false;
                    }
                    
                    if(!$this->check($data[$v[0]],$v[3])) {
                        $this->error[] = $v[2];
                        return false;
                    }
                    break;
                case 0:
                    if(isset($data[$v[0]])) {
                        if(!$this->check($data[$v[0]],$v[3],$v[4])) {
                            $this->error[] = $v[2];
                            return false;
                        }
                    }
                    break;
                case 2:
                    if(isset($data[$v[0]]) && !empty($data[$v[0]])) {
                        if(!$this->check($data[$v[0]],$v[3],$v[4])) {
                            $this->error[] = $v[2];
                            return false;
                        }
                    }
                    break;
                case 3:
                    if(empty($data[$v[0]]) && empty($v[3]) ){
                        return true;
                    }
                    if(!$this->is_email($data[$v[0]])){
                        $this->error[] = $v[2];
                        return false;
                    }
                    break;
            }
        }

        return true;

    }
    public function getErr(){
        return $this->error;
    }

    protected function check($value,$rule='',$parm='') {
        switch($rule) {
            case 'require':
                return !empty($value);
            case 'number':
                return is_numeric($value);
			case 'non_zero':
				return is_numeric($value)&&$value!=0;
            case 'in':
                $tmp = explode(',',$parm);
                return in_array($value,$tmp);
            case 'between':
                list($min,$max) = explode(',',$parm);
                return $value >= $min && $value <= $max;
            case 'length':
                list($min,$max) = explode(',',$parm);
                return strlen($value) >= $min && strlen($value) <= $max;
            default:
                return false;
        }
    }
}
?>