<?php
/*
file init.php
作用:框架初始化
*/
defined('HSJ')||die('您没有权限进入此页面');
date_default_timezone_set ('Asia/Hong_Kong');//设置时间
header("Content-type:text/html;charset=utf-8");
//开启 session
session_start();

// 初始化当前的绝对路径
// 换成正斜线是因为 win/linux都支持正斜线,而linux不支持反斜线
define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))) . '/');
define('CACHE',ROOT.'data/Cache/');         /*  /data/Cache     */
require(ROOT .'include/lib_base.php');
require(ROOT .'include/mysql.class.php');
define('GROUP',ROOT . C('APP_GRUOP_PATH') . '/');

define('DEBUG',true);//设置报错级别以及模板缓存 true开启报错以及不缓存
define('STARS',true);//开启商品星级分组查询
// 用于模板的常量
define('__ROOT__','http://'.$_SERVER['HTTP_HOST'] . '/');
define('__GROUP__','/' . C('APP_GRUOP_PATH') . '/');
define('GROUP_ADMIN',__GROUP__ . C('APP_ADMIN_NAME') . '/');
define('GROUP_NAME',__GROUP__ . C('APP_INDEX_NAME') . '/');

$code = time().rand(1000,9999);//防止重复提交的随机码);
//微信访问则先跳转登录
$user_agent = $_SERVER['HTTP_USER_AGENT'];
//session_unset();
//session_destroy();
$_SESSION['weixin'] = 0;
//$currUrlArr = explode('/',$_SERVER['REQUEST_URI']);
//print_r($currUrlArr[3]);exit;
//print_r(substr($_SERVER['REQUEST_URI'], 0,strrpos($_SERVER['REQUEST_URI'],'/' )));exit;
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false && empty($_SESSION['openId'])) {
    $notGetOpenidArr = array('getBaogaoList','queryBaogao','downloadpdf');
    $currUrlArr = explode('/',$_SERVER['REQUEST_URI']);
    $_SESSION['weixin'] = '1';
    if (isset($_COOKIE["openId"])) {
        $_SESSION['openId'] = $_COOKIE["openId"];
        $db = mysql::getIns();
        $sql = 'select id,username from gs_user where openid="'.$_COOKIE["openId"].'"';
        $r = $db->getRow($sql);
        if(!empty($r['id'])){
            $_SESSION[C('APP_USER_NAME').'_id']     =   $r['id'];
            $_SESSION[C('APP_USER_NAME').'_userid'] =   $r['username'];
            $_SESSION['index_userid']               =   $r['username'];
            //更新登录
            $sql = 'update gs_user set logintime='.time().' where id='.$r['id'];
            $db->query($sql);
        }
    } else {
         if (!empty($currUrlArr[3])) {
             if (!in_array($currUrlArr[3], $notGetOpenidArr)) {
                if(empty($_SESSION['openId'])){
                     header('location:http://23mima.com/index/Login/wapwechat/type/base');  
                }
            }
        } else {
            if(empty($_SESSION['openId'])){
                header('location:http://23mima.com/index/Login/wapwechat/type/base');  
            }
        }
    }
   
   
  //print_r($_SESSION);exit;
    
  // setcookie("login_url1", trim(__ROOT__,'/').$_SERVER['REQUEST_URI'],0,'/');
  //  echo('<script>window.location.href="'.__ROOT__.'Login/wapwechat/type/base";</script>');
  //  die();
}else{
 //  print_r(11);exit;
//  echo('<script>window.location.href="http://23mima.com/"'.$_SESSION['loginurl'].';</script>');
}



//没有登录且不是微信返回的话
if(empty($_SESSION['openId']) && empty($_SESSION['login_url']) && $_SESSION['weixin']==1 && strpos($_SERVER['REQUEST_URI'],'wapwechat') === false ){
	if(!empty($_SESSION['login_url'])){
        unset($_SESSION['login_url']);
    }
	//print_r($_SESSION['login_url']);
	
 //   $_SESSION['login_url'] = $_SERVER['REQUEST_URI'];
	
	
  //  echo('<script>window.location.href="http://23mima.com/Login/wapwechat/type/base";</script>');
}

if(!empty($_COOKIE["login_url1"]) && empty($_SESSION['weixin'])){
    $_SESSION['login_url'] = $_COOKIE["login_url1"];
}



//伪静态设置
if(!DEBUG && file_exists('./html/index.html') && $_SERVER['REQUEST_URI'] == '/' && $_SERVER['HTTP_HOST'] != 'www.mshe.cc'){
    include('./html/index.html');
    die();
}
preg_match('/([^_]+)_(\d+).html/',$_SERVER['REQUEST_URI'],$c);
$c['1']=empty($c['1'])?'':$c['1'];
if(!DEBUG && !empty($c['0']) && file_exists('./html'.$c['0']) && empty($_SERVER['REDIRECT_QUERY_STRING']) ){
    include('./html'.$c['0']);
    die();
}

$_SERVER['PATH_INFO'] = $_SERVER['QUERY_STRING'];
if (strpos($_SERVER['QUERY_STRING'], '&')) {
    $_SERVER['PATH_INFO'] = substr($_SERVER['QUERY_STRING'],0,strpos($_SERVER['QUERY_STRING'], '&'));
}

switch ($c['1'].'_'){
    //商品列表页
    case C('REWRITE_CATEGORY'):
        $_SERVER['PATH_INFO'] = '/Category/index/c_id/'.$c['2'];
        break;
    case C('REWRITE_GOODS'):
        $_SERVER['PATH_INFO'] = '/Goods/index/g_id/'.$c['2'];
        break;
    case C('REWRITE_NEWS'):
        $_SERVER['PATH_INFO'] = '/News/index/n_id/'.$c['2'];
        break;
    case C('REWRITE_CONTENT'):
        $_SERVER['PATH_INFO'] = '/Article/index/a_id/'.$c['2'];
        break;
}

//伪静态设置end

 /* 获取客户端IP */
if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
    define("CLIENT_IP", getenv("HTTP_CLIENT_IP"));
}elseif(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
    define("CLIENT_IP", getenv("HTTP_X_FORWARDED_FOR"));
}elseif(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
    define("CLIENT_IP", getenv("REMOTE_ADDR"));
}elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){
    define("CLIENT_IP", $_SERVER['REMOTE_ADDR']);
}else{
    define("CLIENT_IP", "unknown");
}
//当前时间
define('TIME',time());

//判断是否有get_magic_quotes_gpc并是否打开
if(!( function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc() )){
    if(!empty($_GET)){
        $_GET       =   _addslashes($_GET);
    }
    if(!empty($_POST)){
        $_POST      =   _addslashes($_POST);
    }
    $_COOKIE    =   _addslashes($_COOKIE);
    $_REQUEST   =   _addslashes($_REQUEST);
}


//设置报错级别
if(DEBUG){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

//url路由
//自定义自动加载函数
function loader($class){
    $classPath = get_path_info();
	
    $file = GROUP .$classPath['0'].'/Action/'. $class . '.php';
    if(is_file($file)) {
        include_once($file);
    } else {
        //print_r("your access is denied");exit;
    }
}
function __autoload($class) {
	
    if(strtolower(substr($class,-5)) == 'model') {
        if(is_file(ROOT . 'Model/' . $class . '.class.php')) {
            require(ROOT . 'Model/' . $class . '.class.php');
        } else {
            print_r("your access is denied");exit;
        }
    }else{
        if(is_file(ROOT . 'include/' . $class . '.class.php')) {
            require(ROOT . 'include/' . $class . '.class.php');
        } else {
            //print_r("your access is denied");exit;
        }
    }
}
spl_autoload_register('loader');
spl_autoload_register('__autoload');
//spl_autoload_register(array('loader', '__autoload'));


//得到脚本文件后的路径内容
function get_path_info(){
	
    if(!empty($_SERVER['PATH_INFO'])){
        $path_info = trim($_SERVER['PATH_INFO'],'/');
        $path_info = explode('/',$path_info);
        //判断是否有加模块名称
        if($path_info['0'] != C('APP_ADMIN_NAME') && $path_info['0'] != C('APP_INDEX_NAME') && $path_info['0'] != C('APP_USER_NAME')){

            array_unshift($path_info,'index');

        }
    }else{
       $path_info['0'] = 'index';
    }

    $path_info['1'] = !empty($path_info['1'])?$path_info['1']:'Index';
    $path_info['1'].= 'Action';
    $path_info['2'] = !empty($path_info['2'])?$path_info['2']:'index';
    return $path_info;
}
//判断是手机还是PC
function isMobile(){  
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';        
    function CheckSubstrs($substrs,$text){  
        foreach($substrs as $substr)  
            if(false!==strpos($text,$substr)){  
                return true;  
            }  
            return false;  
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  
          
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  
              CheckSubstrs($mobile_token_list,$useragent);  
          
    if ($found_mobile){  
        return true;  
    }else{  
        return false;  
    }  
 }

$urlPath = $path_info = get_path_info();
$urlPath['1']=substr($urlPath['1'],0,-6);
global $urlPath;
//if() ){//手机站
if (isMobile()){
    define('TEMPLATE',GROUP . $path_info['0'] . '/Tpl_wap/');           //模板路径
    define('COMPLATE',CACHE . $path_info['0'] .'_wap/');                //编译路径
    $_SESSION['loginurl'] = '/index/Index/loginurl';
    $_SESSION['shibei'] = 'wap';
}else{
    define('TEMPLATE',GROUP . $path_info['0'] . '/Tpl/');           //模板路径
    define('COMPLATE',CACHE . $path_info['0'] .'/');                //编译路径
    $_SESSION['loginurl'] = empty($_SERVER['HTTP_REFERER'])?'/#h_logio':$_SERVER['HTTP_REFERER'].'/#h_logio';
    $_SESSION['shibei'] = 'www';
}
//如果手机访问不是微信则跳转
if(empty($_SESSION['weixin']) && $_SESSION['shibei']=='wap'){
 //   $obj = new IndexAction();
 //   $obj->wap();
 //   die();
}

//把方法后的参数添加到$_GET
$len = count($path_info);

for($i = 3;$i<$len;$i+=2){
    $key = $path_info[$i];
	if(empty($path_info[$i+1])){
		$path_info[$i+1]=3;
	}
    $_GET[$key] = $path_info[$i+1];
}

//加上订单标识
if(!empty($_GET['i_type'])){
$_SESSION['i_type'] = $_GET['i_type'];
}

$obj = new $path_info['1']();

$obj->$path_info['2']();

?>