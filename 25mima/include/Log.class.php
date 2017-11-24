<?php
/**
file log.class.php
作用: 记录信息到日志
**/
defined('HSJ')||die('您没有权限进入此页面');

class Log{
	const LOGFILE = 'curr.log'; //建一个常量,代表日志文件的名称

	 //写日志的 
	public static function write($cont){
		$cont .= "\r\n";
		//判断是否备份
		$log = self::isBak();// 计算出日志文件的地址

		$fh = fopen($log,'ab');
		fwrite($fh,$cont);
		fclose($fh);
	}

	// 备份日志
	private function Bak(){
		// 改成 年-月-日.bak这种形式
		$log = ROOT . 'data/log/' .self::LOGFILE;
		$bak = ROOT . 'data/log/' .date('ymd') . mt_rand(10000,99999) . '.bak';
		return rename($log,$bak);
	}

	// 读取并判断日志的大小
	private function isBak(){
		$log = ROOT . 'data/log/' . self::LOGFILE;
		if(!file_exists($log)){ //如果文件不存在,则创建该文件
			touch($log);	// touch在linux也有此命令,是快速的建立一个文件
		}

		// 要是存在,则判断大小
        // 清除缓存
		clearstatcache();
		if(filesize($log) <= 1024 * 1024){//小于1M
			return $log;
		}
		// 走到这一行,说明>1M
		if(!self::Bak()){
			return $log;
		}else{
			touch($log);
			return $log;
		}
	}
}
?>