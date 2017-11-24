<?php
/*
file lib_base.php
作用:辅助函数
*/
defined('HSJ')||die('您没有权限进入此页面');

// 递归转义数组
function _addslashes($arr){
	foreach($arr as $k=>$v){
		if(is_string($v)){
			$arr[$k] = addslashes($v);
		}else if(is_array($v)){
			$arr[$k] = _addslashes($v);
		}
	}
	return $arr;
}

//自定义打印字符串
function p($str){
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

function C($conf){
	$array = include ROOT . 'include/config.inc.php';
	return $array[$conf];
	// $str = conf::getIns();
	// $str = get_object_vars($str);
}
function U($url,$type=1){
	$type = $type == 1 ?$GLOBALS['path_info']['0']:$type;
	$url = '/'.$type .'/'.trim($url,'/');
	return $url;
}
//跳转
function redirect($url=null){
	if($url==null){
		echo '<script type="text/javascript">';
		echo 'history.go(-1)';
		echo '</script>';
	}else{
		header('Location:'.$url);
	}
}
//过滤html标签并将预定义的字符转换为 HTML 实体
function _html($_string,$Unfiltered=null){//$Unfiltered是数组形式
	if(is_array($_string)){
		foreach($_string as $_key => $_value){
			//如果有传$Unfiltered过来并且当前键名在$Unfiltered中则为真
			if($Unfiltered!=null && in_array($_key,$Unfiltered)){
				$_string[$_key]=$_value;
			}else{
				$_string[$_key]=_html($_value);
			}
		}
	}else{
		return htmlspecialchars(strip_tags($_string));
	}
	return $_string;
}
/*
判断输入验证码是否一致
$str = $_POST['verify'];
*/
function verify($str){
	$r = md5(strtolower($str)) == $_SESSION['verify']?1:0;
	return $r;
}
/*事务管理
$sql = array[];
*/
function Tran( $sql ) {
    $judge = 1;
    mysql_query('begin');//开始事务
    //循环执行mysql语句
    foreach ($sql as $v) {
    	Log::write($v);
	    if (!mysql_query($v)) {
            $judge = 0;
	    }
    }
    if ($judge == 0) {
        mysql_query('rollback');
        return false;
    }elseif ($judge == 1) {
        mysql_query('commit');
        return true;
    }
}
/**
 * 字符串截取，支持中文和其他编码
 * static 
 * access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * return string
 */
 function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=false) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
 }
//利用function_exists函数来判断php是否支持一个函数可以轻松写出下面函数
 function vita_get_url_content($url) {
	if(function_exists('file_get_contents')) {
		$file_contents = file_get_contents($url);
	}else{
		$ch = curl_init();
		$timeout = 5; 
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
	}
	return $file_contents;
}

function do_post($url, $data , $retJson = true ,$setHeader = false){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($setHeader) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
    }
    if(!empty($_SERVER['HTTP_USER_AGENT'])){
        curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
    }
    curl_setopt($ch, CURLOPT_POST, TRUE); 
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);
    curl_close($ch);
    if($retJson == false){
        $ret = json_decode($ret);
    }
    return $ret;
}
?>