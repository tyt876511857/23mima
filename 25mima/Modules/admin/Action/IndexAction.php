<?php
Class IndexAction extends CommonAction{
	public function index(){
		$this->display('index');
	}
	public function wap_index(){
		$url = 'http://23mima.com/admin/Index/wap_index';
		$this->get_access_token($url);
		$this->display('wap_index');
	}
	function zhuangtai(){
		if(empty($_POST['name'])){
			echo 'false';
			return false;
		}
		$sql = 'select * from '.$this->bg_tuoye.' where identifier="'.$_POST['name'].'"';
		$r = $this->db->getRow($sql);
		if(empty($r)){
			echo 'false';
		}else{
			$r['zt'] = $this->tuoye_state[$r['state']];
			echo json_encode($r);
		}
	}
	public function top(){
		$this->admin = $_SESSION['admin_userid'];
		$this->display();
	}
	public function left(){
		$this->display();
	}
	public function drag(){
		$this->display();
	}
	public function right(){
		$this->display();
	}
	//清除缓存
	public function delete_cache(){
		unlink(CACHE.'shop_goods_list.php');// 删除缓存
		unlink(CACHE.'shop_news_list.php');// 删除缓存
		unlink(CACHE.'shop_goods.php');// 删除缓存
		$this->CreateHtml();//删除静态文件
		//生成缓存
		$this->shop_goods();//商品列表缓存
		$this->shop_goods_list();//商品栏目列表缓存
		$this->shop_news_list();//文章栏目列表缓存
		$this->success('清除成功！');

	}
	//清除图片
	public function delete_litpic(){
		$filedir = BACKUPDATA;// 指定存放目录
		$filename= BACKUPDATA_NAME;  //存放路径，默认存放到项目最外层
		$site = 'uploads';
		include './include/beifen.php';
		$r = file_get_contents(ROOT.$filename);
		//匹配出数据库里所有的图片地址
		preg_match_all('/\/upload([^(\'|\")]+)?/',$r,$c);

		foreach($c[0] as $v){
			$delete_litpic_data[] = '.'.trim($v,'\\');
		}
		$_COOKIE['delete_litpic_data'] = $delete_litpic_data;
		$files = scandir($site);
		//递归
		function get_litpic($array,$site){
			foreach($array as $v){
				$site_dir = $site.'/'.$v;
				clearstatcache();
				if($v=='.' || $v=='..'){
		 			continue;
	 			}else if(is_dir($site_dir)){
	 				$files = scandir($site_dir);
	 				get_litpic($files,$site_dir);
	 			}else{
	 				//是否出现在数据库中
	 				if(!in_array($site_dir,$_COOKIE['delete_litpic_data'])){
	 					unlink($site_dir);
	 				}else{
	 					$size = round(filesize($site_dir)/1024);
	 					if($size>200){
	 						$site_dir = trim($site_dir,'.');
	 						//echo '<a href="'.$site_dir.'" target="_blank">'.$site_dir.'</a> 图片大小：'.$size.'KB<br />';
	 					}
	 				}
	 			}

			}
		}
		//echo '以下是空间内大于200KB的图片：<br />';
		get_litpic($files,'./'.$site);
		$this->success('清除成功！');
	}
	//清除备份的数据
	function delete_sql(){
		$filedir = BACKUPDATA;// 指定存放目录
		$filename= BACKUPDATA_NAME;  //存放路径，默认存放到项目最外层
		$files = scandir($filedir);
		$newtime = time();
 		$newtime -=60*60*24*30; //一个月的时间

		foreach($files as $v){
			if($v=='.' || $v=='..'){
	 			continue;
 			}else{
 				$r = explode('.',$v);
 				$d = substr($r[0],-2);
 				$time = strtotime($r[0]);
 				if($time<$newtime && $d!='01'){
 					unlink($filedir.'/'.$v);
 				}
 			}
		}
		$this->success('清除成功！');
	}
}
?>