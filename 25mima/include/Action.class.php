<?php
class Action{
	private $temp = '';//模板文件
	private $comp = '';// 编译文件
	protected $db =null;
	//	echo 111;exit;

	//设置每一个数据表
	//protected $category = C('DB_PREFIX');//分类表
	function __construct(){	
		$this->db = mysql::getIns();
		$this->table_name();
		$this->shop_config();//商店设置缓存
		$this->shop_brand();//商品列表缓存
		$this->shop_goods();//商品列表缓存
		//$this->shop_news();//商品列表缓存
		$this->shop_goods_list();//商品栏目列表缓存
		$this->shop_news_list();//文章栏目列表缓存
		//定期更新静态文件		//存在且戚时间大于3600
		if(file_exists('html/index.html') && (time() > filectime('html/index.html')+3600) ){
			$this->CreateHtml();
		}	
		//	echo 111;exit;

		$this->taglib = new Taglib();
		$this->tuoye_state = array('已绑定','已到实验室','DNA分析中','报告生成中','专家审核','已出报告','样本不合格，需要再次取样检测','删除');
		$log = empty($_SERVER['PATH_INFO'])?'/':$_SERVER['PATH_INFO'];
		log::write('当前访问的是'.__ROOT__.$log);
		
	}
	//邮箱验证
	function is_email($email) {
       $pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
       return  preg_match($pattern_test,$email);
    }
    //手机验证
	function is_phone($phone) {
		return preg_match("/^13[0-9]{1}[0-9]{8}$|15[01389]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/",$phone);
    }
    //防止重复提交
	function is_submit(){
		if(isset($_POST['code']) && !empty($_SESSION['code'])) {  
		    if($_POST['code'] == $_SESSION['code']){
		         $this->error('请不要重复提交');
		    }else{  
		         $_SESSION['code'] =$_POST['code']; //存储code
		    }  
		}
	}
	//输出提示后跳转
	protected function success($str,$url='null'){
		//除管理后台
		if($GLOBALS['path_info'][0] != 'admin'){
			$this->str = $str;
			if($url=='null'){
				$this->url='';
			}else{
				$this->url=$url;
			}
			$this->display('index:Index:error');//模块名：类名:方法名
			die();
		}
		echo '<script type="text/javascript">';
		if($str != 'null'){
			echo 'alert(\''.$str.'\');';
		}
		
		if($url=='null'){
			echo 'history.go(-1)';
		}else{
			echo 'window.location.href="'.$url.'";';
		}
		echo '</script>';
		die();
	}
	//报错后返回上一页
	protected function error($str,$url='null'){
		//除管理后台
		//print_r(111);exit;
		if($GLOBALS['path_info'][0] != 'admin'){
			$this->str = $str;
			//$this->url='';
			if($url=='null'){
				$this->url='';
			}else{
				$this->url=$url;
			}
			if($_SESSION['shibei'] == 'wap'){
				$this->display('index:Index:error2');
			}else{
				$this->display('index:Index:error');//模块名：类名:方法名
			}
			
			die();
		}
		
		echo '<script type="text/javascript">';
		echo 'alert(\''.$str.'\');';
		echo 'history.go(-1)';
		echo '</script>';
		die();
	}
	//  过滤$_GET[id]并判断
	protected function get_id($id='id'){
		//$id = empty($id)?'id':$id;
		$id = $_GET[$id]+0;
		if($id == 0){
			$this->error('数据不安全');
		}
		return $id;
	}
	//  获取栏目分类信息
	protected function cate_info(){
		$sql = 'select id,pid,typename,unit,is_show,show_in_nav,grade,rank from '.$this->category.' order by rank';
		return $this->db->getAll($sql);
	}
	private function table_name(){
		$sql = 'show tables';
		$table = $this->db->query($sql);
		//设置表字段
		$Tables_in_database = 'Tables_in_'.C('DB_NAME');
		while($rs = mysql_fetch_assoc($table)){
			$k = str_ireplace(C('DB_PREFIX'),'',$rs[$Tables_in_database]);
			$this->$k = $rs[$Tables_in_database];
		}
	}



	private function replace(){
		$content = file_get_contents($this->temp);
		$pattern = array(
			'/\{*\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/i',									//匹配模板中变量
			'/\{*\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\.([a-zA-Z0-9_\x7f-\xff]+)\}/i',		//匹配数组
			'/<foreach\sname=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s+item=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s*>/i',//foreach标识符,遍历数组中的值
			'/<foreach\sname=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s+key=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s+item=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s*>/i',	//foreach标识符,遍历数组中的键和值
			'/<foreach\sname=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\.([a-zA-Z0-9_\x7f-\xff]+)[\'"]\s+item=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s*>/i',//多层foreach标识符,遍历数组中的值
			'/<foreach\sname=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\.([a-zA-Z0-9_\x7f-\xff]+)[\'"]\s+key=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s+item=[\'"]([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)[\'"]\s*>/i',//多层foreach标识符,,遍历数组中的键和值
			'/<\/foreach>/',    //foreach结束标识符
			'/<if\s+condition=[\'"](.+?)[\'"]\s*>/',//if标识符
			'/<if\s+empty=[\'"](.+?)[\'"]\s*>/',// 判断是否为空
			'/<if\s+noempty=[\'"](.+?)[\'"]\s*>/',// 判断是否不为空
			'/<else\s+if\s+condition=[\'"](.+)[\'"]\s*>/',//else if 标识符
			'/<else>/',										//else 标识符
			'/<\/if>/',										//if结束标识符
			'/<include\s+file=[\'"](\S+)[\'"]\s*>/',//include标识符
			'/{:([^}]+)}/'							//echo标识符
		);

		$replacement = array(
			'<?php echo $${1}; ?>',												//匹配模板中变量
			'<?php if(isset($${1}[\'${2}\'])){echo $${1}[\'${2}\'];} ?>',		//匹配数组
			'<?php foreach ($${1} as $${2}){ ?>',								//foreach标识符,遍历数组中的值
			'<?php foreach ($${1} as $${2}=>$${3}){ ?>',						//foreach标识符,遍历数组中的键和值
			'<?php foreach ($${1}[\'${2}\'] as $${3}){ ?>',						//多层foreach标识符,遍历数组中的值
			'<?php foreach ($${1}[\'${2}\'] as $${3}=>$${4}){ ?>',						//多层foreach标识符,遍历数组中的键和值
			'<?php } ?>',														//foreach结束标识符
			'<?php if(${1}){ ?>',												//if标识符
			'<?php if(empty(${1})){ ?>',										//判断是否为空
			'<?php if(!empty(${1})){ ?>',										//判断是否不为空
			'<?php }else if(${1}){ ?>',											//else if 标识符
			'<?php }else{ ?>',													//else 标识符
			'<?php } ?>',														//if结束标识符
			'<?php $this->display(\'${1}\',\'lib\') ?>',						//include标识符
			'<?php echo ${1} ?>'												//echo标识符
		);
		//获取taglib类的参数后解析
		$taglibKey = $taglibValue =array();
		foreach($this->taglib->tags as $k=>$v){
			if($v['close']==1){
			$taglibKey[]	= '/<'.$k.'\s*([^>]*)?>([\s\S]*?)<\/'.$k.'>/';
			$taglibValue[]	= '<?php 
$attr =<<<Eof
${1}
Eof;
$c =<<<Eof
${2}
Eof;

	$data = $this->taglib->_'.$k.'($attr,$c);eval($data);?>';
			}else{
				//单闭合
			$taglibKey[]	= '/<'.$k.'\s*([^\/]*)?\/>/';
			$taglibValue[]	= '<?php 
$attr =<<<Eof
${1}
Eof;
	$data = $this->taglib->_'.$k.'($attr);?>';

			}
		}
		$k = array_merge($taglibKey,$pattern);
		$v = array_merge($taglibValue,$replacement);
		//$attr = '${1}';
		//var_dump($this->taglib->_arclist($attr,'${2}'));
		$repContent=preg_replace($k,$v,$content);

		//$repContent=preg_replace($pattern, $replacement, $content);
		//模板替换
		foreach(C('TMPL_PARSE_STRING') as $k=>$v){
			$repContent = str_replace($k,$v,$repContent);
		}
		file_put_contents($this->comp,$repContent);
	}

	//file=模块名：类名:方法名
	public function display($file=null,$type=null){
		$file_path = explode(':',$file);//转换样式
		//Type等于lib并且file_path没有模块名的时候
		if($type == 'lib' && !array_key_exists(2,$file_path)){
			$lib_dir = 'html/'.$GLOBALS['path_info']['0'].'_lib_'.$file;
			$lib_dir_name = ROOT.$lib_dir.'.html';
			if(is_file($lib_dir_name) && !DEBUG){
				return include($lib_dir_name);
				die();
			}
			$file = 'lib/'.$file;
		}else{
			$urlPath = $GLOBALS['urlPath'];
			if($file === null){
				$file = $urlPath['1'] . '_' . $urlPath['2'];
			}else{
				$file_path = array_reverse($file_path);
				$file_path['1'] = empty($file_path['1'])?$urlPath['1']:$file_path['1'];
				$file=$type=='lib'?'lib/'.$file_path['0']:$file_path['1'] . '_' . $file_path['0'];
			}
		}
		//模板文件和编译文件设置绝对路径
		$this->temp = TEMPLATE . $file . '.html';
		$this->comp = COMPLATE . $file . '.php';
		//如果有模块名
		if(!empty($file_path['2'])){
			$this->temp = GROUP . $file_path['2'].'/Tpl/' . $file . '.html';
			$this->comp = CACHE . $file_path['2'].'/'	 . $file . '.php';
		}
		//指定目录不存在则创建
		if(!file_exists(dirname($this->comp))){
			mkdir(dirname($this->comp),0775,true);
		}
		//对象转换成数组以便在模板调用
		$this->vars = get_object_vars($this);
		extract($this->vars);
		 // 判断模板是否已经存在,
		clearstatcache();
        if(DEBUG or !(file_exists($this->comp) && filemtime($this->temp) < filemtime($this->comp)) ) {
            $this->replace();
        }
        //生成静态lib下的页面
        if(!DEBUG && $type == 'lib' && !array_key_exists(2,$file_path) ){
        	$create = new CreateHtml();
			$create->start();
			include($this->comp);
        	$create->end($lib_dir,'.');
        	return;
        }
        include($this->comp);
	}
	
		//file=模块名：类名:方法名
	public function display2($file=null,$id){
		$file_path = explode(':',$file);//转换样式
		//Type等于lib并且file_path没有模块名的时候
		
		$urlPath = $GLOBALS['urlPath'];
		if($file === null){
			$file = $urlPath['1'] . '_' . $urlPath['2'];
		}else{
			$file_path = array_reverse($file_path);
			$file_path['1'] = empty($file_path['1'])?$urlPath['1']:$file_path['1'];
			$file=$file_path['1'] . '_' . $file_path['0'];
		}
		
		//模板文件和编译文件设置绝对路径
		$this->temp = TEMPLATE . $file . '.html';
		$this->comp = COMPLATE . $file . '.php';
		//如果有模块名
		if(!empty($file_path['2'])){
			$this->temp = GROUP . $file_path['2'].'/Tpl/' . $file . '.html';
			$this->comp = CACHE . $file_path['2'].'/'	 . $file . '.php';
		}
		//指定目录不存在则创建
		if(!file_exists(dirname($this->comp))){
			mkdir(dirname($this->comp),0775,true);
		}
		//对象转换成数组以便在模板调用
		$this->vars = get_object_vars($this);
		extract($this->vars);
		 // 判断模板是否已经存在,
		clearstatcache();
        if(DEBUG or !(file_exists($this->comp) && filemtime($this->temp) < filemtime($this->comp)) ) {
            $this->replace();
        }
		//print_r($lib_dir);exit;
        //生成静态lib下的页面
		$lib_dir = 'html/meirong_'.$id;
		$create = new CreateHtml();
		$create->start();
		include($this->comp);
		$create->end($lib_dir,'.');
		return;
     //   include($this->comp);
	}
	
	//设置商店系统配置缓存
	protected function shop_config(){
		$shopConfig = CACHE.'shop_config.php';
		if(!file_exists($shopConfig)){
			//查询数据库
			$sql = 'select varname,value from '.$this->sysconfig;
			$r   = $this->db->getAll($sql);
			$arr = array();
			foreach($r as $v){
				$arr[$v['varname']] = $v['value'];
			}
			//写入到文件
			$fp = fopen($shopConfig,'w');
			$content = "<?php\r\n";
			$content.= 'return ';
			$content.= var_export($arr,true).";\r\n";
			//$content.= 'return $shop_config;';
			$content.= '?>';
			fputs($fp,$content);
			fclose($fp);
		}
		return include $shopConfig;
	}
	//设置商品品牌缓存
	protected function shop_brand(){
		$shopConfig = CACHE.'shop_brand.php';
		if(!file_exists($shopConfig)){
			$sql = 'select brand_id,brand_name,brand_logo from '.$this->brand;
			$r = $this->db->getAll($sql);
			$arr = array();
			foreach($r as $v){
				$id = $v['brand_id'];
				$arr[$id] = $v;
			}
			//写入到文件
			$fp = fopen($shopConfig,'w');
			$content = "<?php\r\n";
			$content.= 'return ';
			$content.= var_export($arr,true).";\r\n";
			//$content.= 'return $shop_config;';
			$content.= '?>';
			fputs($fp,$content);
			fclose($fp);
		}
		return include $shopConfig;
	}
	//设置商品列表缓存
	protected function shop_goods(){
		$shopConfig = CACHE.'shop_goods.php';
		$shopStars = include(CACHE.'shop_stars.php');
		$shopbrand = include(CACHE.'shop_brand.php');
		if(!file_exists($shopConfig)){
			//查询数据库
			//$sql = 'select goods_id,goods_name,shop_price,market_price,goods_thumb from '.$this->goods.' where is_delete=0 and is_on_sale=1';

			$sql = 'select goods_id,cat_id,brand_id,goods_name,shop_price,market_price,goods_thumb,goods_img,typename,g.description from '.$this->goods.' as g left join '.$this->category.' on g.cat_id=id';
			$r   = $this->db->getAll($sql);
			$arr = array();
			foreach($r as $v){
				$id = $v['goods_id'];
				$arr[$v['goods_id']] = $v;
				$arr[$v['goods_id']]['stars']= empty($shopStars[$id])?100:$shopStars[$id];
				$arr[$v['goods_id']]['brand']= empty($v['brand_id'])?'':$shopbrand[$v['brand_id']]['brand_name'];
				$arr[$v['goods_id']]['url']= C('REWRITE_GOODS').$id.'.html';
				$arr[$v['goods_id']]['typeurl']= C('REWRITE_CATEGORY').$v['cat_id'].'.html';
			}
			//写入到文件
			$fp = fopen($shopConfig,'w');
			$content = "<?php\r\n";
			$content.= 'return ';
			$content.= var_export($arr,true).";\r\n";
			//$content.= 'return $shop_config;';
			$content.= '?>';
			fputs($fp,$content);
			fclose($fp);
		}
		return include $shopConfig;
	}
	//设置文章列表缓存
	/*protected function shop_news(){
		$shopConfig = CACHE.'shop_news.php';
		if(!file_exists($shopConfig)){
			$sql = 'select t.id,title,add_time,t.litpic,t.description as info,cat_id,typename from '.$this->article.' as t left join '.$this->arttype.' as n on cat_id=n.id';
			$r   = $this->db->getAll($sql);
			$arr = array();
			foreach($r as $v){
				$id = $v['id'];
				//文章内容去掉样式以及截图字符
				$arr[$id] = $v;
				$arr[$id]['url']= C('REWRITE_CONTENT').$id.'.html';
				$arr[$id]['typeurl']= C('REWRITE_NEWS').$v['cat_id'].'.html';
			}
			//写入到文件
			$fp = fopen($shopConfig,'w');
			$content = "<?php\r\n";
			$content.= 'return ';
			$content.= var_export($arr,true).";\r\n";
			//$content.= 'return $shop_config;';
			$content.= '?>';
			fputs($fp,$content);
			fclose($fp);
		}
		return include $shopConfig;
	}*/
	//设置商品栏目列表缓存
	protected function shop_goods_list(){
		$shopConfig = CACHE.'shop_goods_list.php';
		if(!file_exists($shopConfig)){
			//查询数据库
			$sql = 'select id,typename,pid,rank from '.$this->category.' order by rank,id';
			$r   = $this->db->getAll($sql);
			$arr = array();
			foreach($r as $v){
				$arr[$v['id']] = $v;
				$arr[$v['id']]['url']=C('REWRITE_CATEGORY').$v['id'].'.html';
			}
			//写入到文件
			$fp = fopen($shopConfig,'w');
			$content = "<?php\r\n";
			$content.= 'return ';
			$content.= var_export($arr,true).";\r\n";
			//$content.= 'return $shop_config;';
			$content.= '?>';
			fputs($fp,$content);
			fclose($fp);
		}
		return include $shopConfig;
	}
	//设置文章栏目列表缓存
	protected function shop_news_list(){
		$shopConfig = CACHE.'shop_news_list.php';
		if(!file_exists($shopConfig)){
			//查询数据库
			$sql = 'select id,typename,pid,litpic from '.$this->arttype.' order by rank';
			$r   = $this->db->getAll($sql);
			$arr = array();
			foreach($r as $v){
				$arr[$v['id']] = $v;
				$arr[$v['id']]['url']=C('REWRITE_NEWS').$v['id'].'.html';
			}

			//写入到文件
			$fp = fopen($shopConfig,'w');
			$content = "<?php\r\n";
			$content.= 'return ';
			$content.= var_export($arr,true).";\r\n";
			//$content.= 'return $shop_config;';
			$content.= '?>';
			fputs($fp,$content);
			fclose($fp);
		}
		return include $shopConfig;
	}
	//整合商品
	protected function IntegrationGoods($array,$type='goods'){
		if(empty($array)){
			return array();
		}else{
			$data = array();
			if($type == 'goods'){
				$cache_goods_list = $this->shop_goods();
				foreach($array as $k => $v){
					$data[] = array_merge($array[$k],$cache_goods_list[$v['goods_id']]);
				}
			}else{
				$cache_goods_list = $this->shop_news_list();
				foreach($array as $k => $v){
					$list = array();
					$list['typeurl'] = $cache_goods_list[$v['cat_id']]['url'];
					$list['typename'] = $cache_goods_list[$v['cat_id']]['typename'];
					$list['url'] = C('REWRITE_CONTENT').$v['id'].'.html';
					$data[] = array_merge($array[$k],$list);
				}
			}
			return $data;
		}
	}
	protected function CreateHtml(){
		$dir = 'html';
		$html = scandir($dir);
		foreach($html as $v){
			if($v=='.' || $v =='..'){
				continue;
			}
			unlink($dir.'/'.$v);
		}
	}
	//设置COOKIE购物车数量$id 用户ID
	function setShoppingNumber($id){
		$sql = 'select id from '.$this->shopping.' where indent_id=0 and user_id='.$id;
		$num = $this->db->getNum($sql);
		if(empty($num)){
			$num=0;
		}
		setcookie('shoppingNumber',$num,time()+360000,'/');
	}
	function get_access_token($url){
		if(empty($_SESSION['access_ticket']) || $_SESSION['access_token_time']+7000 >time()){
			$token = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxda2e66f036932f53&secret=4eef13a5523d5d2bc583c4824f354563');
			$token = json_decode($token);
			if(empty($token->access_token)){
				echo 'appid无效';
				die();
			}
			$_SESSION['access_token'] = $token->access_token;
			$_SESSION['access_token_time'] = time();

			$ticket = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token->access_token.'&type=jsapi');
			$ticket = json_decode($ticket);
			$_SESSION['access_ticket'] = $ticket->ticket;
		}
		//签名
		$array = array();
		$this->time = time();
		$array['jsapi_ticket'] = 'jsapi_ticket='.$_SESSION['access_ticket'];
		$array['noncestr'] = 'noncestr=4eef13a5523d5d2bc583c4824f354563';
		$array['timestamp'] = 'timestamp='.$this->time;
		$array['url'] = 'url='.$url;
		$str = implode("&",$array);
		$this->signature = sha1($str);
	}
}
?>
