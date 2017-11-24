<?php
class Taglib {
	function __construct(){
		$this->db = mysql::getIns();
		$sql = 'show tables';
		$table = $this->db->query($sql);
		//设置表字段
		$Tables_in_database = 'Tables_in_'.C('DB_NAME');
		while($rs = mysql_fetch_assoc($table)){
			$k = str_ireplace(C('DB_PREFIX'),'',$rs[$Tables_in_database]);
			$this->$k = $rs[$Tables_in_database];
		}
		//引入栏目缓存
		$this->cache['shop_goods_list'] = include(CACHE.'shop_goods_list.php');
		$this->cache['shop_news_list'] = include(CACHE.'shop_news_list.php');
	}
	//标签属性里面的特殊模板变量解析
	protected function parseThinkVar($varStr){
		// 如果没有传过来变量的话则返回
		if(empty($varStr)){
			return;
		}
		$varStr = trim($varStr,' ');
		$varStr = explode(' ',$varStr);
		foreach($varStr as $v){
			$str  = explode('=',$v);
			$str['1'] = trim($str['1'],'\'"');
			$data[$str['0']]=$str['1'];
		}
		return $data;
	}
	//过滤传过来的$content
	protected function content($content){
		$content = addslashes($content);
		$content = preg_replace('/\[field:(\w*)\s*\/\]/','$${1} ',$content);
		return '"'.$content.'"';
	}

	public $tags = array(
		'top_menu'			=>	array('attr'=>'','close'=>1),//  导航菜单
		'myad'				=>  array('attr'=>'type,limit','close'=>1),//广告
		'brand'				=>  array('attr'=>'limit','close'=>1),//品牌
		'search_keywords'	=>  array('attr'=>'limit','close'=>0),//热门关键词
		'arclist'			=>  array('attr'=>'type,limit,typeid,is_news','close'=>1),
		'channelartlist'	=>  array('attr'=>'type','close'=>0),
		'link'				=>  array('attr'=>'type','close'=>1),//友情链接
		'position'			=>  array('attr'=>'type','close'=>0),//当前位置
		'type'				=>	array('attr'=>'type,typeid,limit','close'=>1),//栏目
		'prenext'			=>	array('attr'=>'type','close'=>1),
	);

	public function _top_menu($attr,$content){
		$content = $this->content($content);
		$attr = $this->parseThinkVar($attr);
		$str  = '$sql = "select * from $this->category where show_in_nav=1";';
		$str .= '$r = $this->db->getAll($sql);';
		$str .= 'foreach($r as $v){';
		$str .= '$url = "'.C('REWRITE_CATEGORY').'$v[id].html";';
		$str .= 'extract($v);';
		$str .= "echo $content;";
		$str .= '}';
		//p($str);
		return $str;
	}
	public function _myad($attr,$content){
		$content = $this->content($content);
		$attr = $this->parseThinkVar($attr);
		$limit = empty($attr['limit'])?'':'limit '.$attr['limit'];
		$str = '$sql = "select * from $this->myad where switch=1 and type=\''.$attr['type'].'\' order by rank '.$limit.'";';
		//echo $str;
		$str .= '$Unfiltered=array("content");';
		$str .= '$r = $this->db->getAll($sql,$Unfiltered);';
		$str .= 'foreach($r as $v){';
		$str .= 'extract($v);';
		$str .= "echo $content;";
		$str .= '}';
		return $str;
	}
	public function _brand($attr,$content){
		$content = $this->content($content);
		$attr = $this->parseThinkVar($attr);
		$limit = empty($attr['limit'])?'':'limit '.$attr['limit'];
		$str = '$sql = "select * from $this->brand where is_show=1 order by rank '.$limit.'";';
		$str .= '$r = $this->db->getAll($sql);';
		$str .= 'foreach($r as $v){';
		$str .= 'extract($v);';
		$str .= "echo $content;";
		$str .= '}';
		return $str;
	}
	public function _search_keywords($attr){
		$sql = 'select value from '.$this->sysconfig.' where varname = "cfg_search_keywords"';
		$query = $this->db->getRow($sql);
		$query = explode(',',$query['value']);
		foreach($query as $v){
			echo '<a href="">'.$v.'</a>';
		}
	}
	public function _arclist($attr,$content){
		$content = $this->content($content);
		$attr = $this->parseThinkVar($attr);
		$limit = empty($attr['limit'])?'':'limit '.$attr['limit'];
		//如果is_news==1 代表调用文章
		$where = '';
		if(!empty($attr['is_news']) && $attr['is_news']==1){
			if(!empty($attr['typeid'])){
				$typeid = Category::getChildsId($this->cache['shop_news_list'],$attr['typeid']);
				$typeid[] = $attr['typeid'];
				$typeid = implode(',',$typeid);
				$where = 'cat_id in ('.$typeid.')';
			}
			$where .= empty($attr['type'])?'':' and article_type='.$attr['type'];
			$str = '$sql = "select id,title,add_time,litpic,description as info,cat_id from $this->article where '.$where.' order by id desc '.$limit.'";';
			$type = 'news';
		}else{
			if(!empty($attr['typeid'])){
				$typeid = Category::getChildsId($this->cache['shop_goods_list'],$attr['typeid']);
				$typeid[] = $attr['typeid'];
				$typeid = implode(',',$typeid);
				$where = ' and cat_id in ('.$typeid.') ';
			}
			$where .= empty($attr['type'])?'':' and '.$attr['type'].'=1 ';
			$str = '$sql = "select goods_id from $this->goods where is_delete=0 '.$where.'order by rank,goods_id desc '.$limit.'";';
			$type = 'goods';
		}
		$str .= '$r = $this->db->getAll($sql);';
		$str .= '$r = $this->IntegrationGoods($r,"'.$type.'");';
		$str .= 'foreach($r as $i=>$v){';
		$str .= '$i++;';
		//$str .= '$url = "'.C('REWRITE_GOODS').'$v[goods_id].html";';
		$str .= 'extract($v);';
		$str .= "echo $content;";
		$str .= '}';
		return $str;
	}
	public function _channelartlist($attr){
		//$content = $this->content($content);
		$attr = $this->parseThinkVar($attr);
		$sql = "select * from $this->category";
		$r = $this->db->getAll($sql);
		return $data = Category::multidimensional($r);

		// $str  = '$sql = "select * from $this->category";';
		// $str .= '$r = $this->db->getAll($sql);';
		// $str .= '$data = Category::multidimensional($r);';
		// $str .= 'foreach($data as $v){';
		// $str .= 'extract($v);';
		// $str .= "echo $content;";
		// $str .= '}';
		// p($str);
		//return $str;
	}
	public function _link($attr,$content){
		$content = $this->content($content);
		$attr = $this->parseThinkVar($attr);
		$str = '$sql = "select * from $this->link order by rank';
		$str .= '$r = $this->db->getAll($sql);';
		$str .= 'foreach($r as $v){';
		$str .= 'extract($v);';
		$str .= "echo $content;";
		$str .= '}';
		return $str;
	}

	public function _position($attr){
		$attr = $this->parseThinkVar($attr);
		$id = $this->GetTypeId();
		if($attr['type'] == 'category'){
			$list = $this->cache['shop_goods_list'];
			$data = Category::getParentsid($list,$id);
		}else{
			$list = $this->cache['shop_news_list'];
			$data = Category::getParentsid($list,$id);
		}
		$str = '<a href="/">首页</a>';
		foreach($data as $v){
			$str .= ' > <a href="'.$list[$v]['url'].'">'.$list[$v]['typename'].'</a>';
		}
		echo $str;
	}
	public function _type($attr,$content){
		$attr = $this->parseThinkVar($attr);
		$content = $this->content($content);
		$limit = isset($attr['limit'])?$attr['limit']+1:-1;
		$id = isset($attr['typeid'])?$attr['typeid']:$this->GetTypeId();
		if($attr['type'] == 'category'){
			$str = '$list = $this->shop_goods_list();';
		}elseif($attr['type'] == 'news'){
			$str = '$list = $this->shop_news_list();';
		}
		$str .= '$data = Category::linearArray($list,"&nbsp;&nbsp;",'.$id.');';
		$str .= '$i = 0;';
		$str .= 'foreach($data as $v){';
		$str .= 'if($v["level"] == 1){$i++;}';
		$str .= 'if($i == '.$limit.'){break;}';
		$str .= 'extract($v);';
		$str .= "echo $content;";
		$str .= '}';
		return $str;
	}
	//文章上下篇
	public function _prenext($attr,$content){
		$attr 		= $this->parseThinkVar($attr);
		$content 	= $this->content($content);
		$id   		= $_GET['a_id']+0;
		$tid    	= $this->GetTypeId();
		if($attr['type']=='pre'){
			$where	= 'id < '.$id;
			$order  = 'id desc';
		}elseif($attr['type']=='next'){
			$where	= 'id > '.$id;
			$order  = 'id asc';
		}
		$str    = '$sql = "select * from $this->article where '.$where.' and cat_id='.$tid.' order by '.$order.' limit 1";';
		$str   .= '$_prenext = $this->db->getRow($sql);';
		$str   .= 'if(!empty($_prenext)){';
		$str   .= 'extract($_prenext);';
		$str   .= '$url = "'.C('REWRITE_CONTENT').'$id.html";';
		$str   .= '}else{';
		$str   .= '$title="没有了";$url="";';
		$str   .= '}';
		$str   .= "echo $content;";
		$str   .= 'unset($id); unset($title);';
		return $str;
	}
	//获得栏目页或文章页对应的栏目ID
	function GetTypeId(){
		if(!empty($_GET['c_id'])){
			$id = $_GET['c_id'] + 0;
		}elseif(!empty($_GET['g_id'])){
			$sql = 'select cat_id from '.$this->goods.' where goods_id='.$_GET['g_id'];
			$id = $this->db->getRow($sql);
			$id = $id['cat_id'];
		}elseif(!empty($_GET['n_id'])){
			$id = $_GET['n_id'] + 0;
		}elseif(!empty($_GET['a_id'])){
			$sql = 'select cat_id from '.$this->article.' where id='.$_GET['a_id'];
			$id = $this->db->getRow($sql);
			$id = $id['cat_id'];
		}
		return $id;
	}
}
?>