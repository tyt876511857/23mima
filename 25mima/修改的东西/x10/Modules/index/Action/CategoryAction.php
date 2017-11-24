<?php
Class CategoryAction extends Action{
	private $arctype = 'arctype';
	public function index(){
		$id = $this->get_id('c_id');
		$sql = 'select * from '.$this->category.' where id ='.$id;
		$field = $this->db->getRow($sql);
		if(empty($field)){
			$this->error('访问出错！');
		}
		$cache_config = $this->shop_config();
		$field['title']=$field['typename'].'_'.$cache_config['cfg_shop_title'];
		$this->field = $field;
		//商品分布及筛选
		list($this->list,$this->page) = $this->page(20);
		//$this->filter_attr = $this->filter_attr();//筛选属性
		//p($this->filter_attr);
		if(!DEBUG){
			$create = new CreateHtml();
			$create->start();
			$this->display($field['site']);
			$create->end(C('REWRITE_CATEGORY').$id);
		}else{
			$this->display($field['site']);
		}
	}
	//人气跟新品
	function hot(){
		$where = 'is_delete=0 ';
		$cache_config = $this->shop_config();
		if($_GET['type'] == 'hot'){
			$where .= ' and is_hot=1 ';
			$field['title'] = '热门单品_'.$cache_config['cfg_shop_title'];
			$field['title1'] = '>热门单品';
		}else{
			$field['title'] = '新品速递_'.$cache_config['cfg_shop_title'];
			$field['title1'] = '>新品速递';
		}
		$this->field = $field;
		$pagesize = 20;
		$page = empty($_GET['page'])?0:$_GET['page']-1;
		$field = 'goods_id';
		$sql = 'select '.$field.' from '.$this->goods.' where '.$where.' order by goods_id desc';
		$num = $this->db->getNum($sql);//取得总条数
		$sql .= ' limit '.$page*$pagesize.','.$pagesize;
		$list = $this->db->getAll($sql);
		$this->list = $this->IntegrationGoods($list);
		$pagelist = new Page($num,$pagesize);
		$this->page = $pagelist->showpage();

		$this->display('List:category');
	}
	//品牌所属商品
	function brand(){
		$id = $this->get_id();
		$cache_config = $this->shop_config();
		$cache_brand = $this->shop_brand();
		$field['title'] = $cache_brand[$id]['brand_name'].'_'.$cache_config['cfg_shop_title'];
		$field['title1'] = '>'.$cache_brand[$id]['brand_name'];
		$this->field = $field;
		$where .= 'is_delete=0 and brand_id='.$id;
		$pagesize = 20;
		$page = empty($_GET['page'])?0:$_GET['page']-1;
		$field = 'goods_id';
		$sql = 'select '.$field.' from '.$this->goods.' where '.$where.' order by goods_id desc';
		$num = $this->db->getNum($sql);//取得总条数
		$sql .= ' limit '.$page*$pagesize.','.$pagesize;
		$list = $this->db->getAll($sql);
		$this->list = $this->IntegrationGoods($list);
		$pagelist = new Page($num,$pagesize);
		$this->page = $pagelist->showpage();
		$this->display('List:category');
	}
	//商品分布及筛选
	private function page($pagesize = 5){
		//获取ID及子ID
		$id = $this->get_id('c_id');
		$cache_shop_goods_list = $this->shop_goods_list();
		$id.= ','.implode(',',Category::getChildsId($cache_shop_goods_list,$id));
		$id = trim($id,',');
		$page = empty($_GET['page'])?0:$_GET['page']-1;
		$where = ' cat_id in ('.$id.') and rank>0';
		//$field = 'goods_id,goods_name,click,shop_price,market_price,goods_thumb ';
		$field = 'goods_id,is_on_sale,rank';
		$sql = 'select '.$field.' from '.$this->goods.' where is_delete=0 and is_on_sale=1 and '.$where.' order by rank,goods_id desc';
		$num = $this->db->getNum($sql);//取得总条数
		$sql .= ' limit '.$page*$pagesize.','.$pagesize;
		$list = $this->db->getAll($sql);
		$list = $this->IntegrationGoods($list);
		$pagelist = new Page($num,$pagesize);
		$page = $pagelist->showpage();
		return array($list,$page);
	}
	private function filter_attr(){
		$id = $this->get_id('c_id');
		$sql = 'select filter_attr from '.$this->category.' where id='.$id;
		$attr = $this->db->getRow($sql);
		//如果没有筛选属性则返回
		if($attr['filter_attr']==0){
			return;
		}
		$attr_id = explode(',',$attr['filter_attr']);
		$present_url = $_SERVER['REDIRECT_URL'];//获取当前文件链接
		$str = '';
		foreach($attr_id as $v){
			$sql = 'select a.attr_id,attr_value,attr_name from '.$this->goods_attr.' as a left join '.$this->attribute.' as b on a.attr_id=b.attr_id  where a.attr_id='.$v;
			$row= $this->db->getAll($sql);
			$str.= '<div class="screeBox">';
			$str.= '<strong>'.$row['0']['attr_name'].'：</strong>';
			if(!empty($_SERVER['argv']['0'])&&strripos($_SERVER['argv']['0'],$v.'=')!==false){
				$url = $_SERVER['argv']['0'].'&';
				$first = stripos($url,$v.'=');
				$finally = stripos($url,'&',$first);
				$url = substr_replace($url,'',$first,$finally-$first);
				$url = trim($url,'&');
				$str.='<a href="'.$_SERVER['REDIRECT_URL'].'?'.$url.'">全部</a>&nbsp;';
			}else{
				$str.= '<span>全部</span>';
			}
			foreach($row as $k=>$j){
				$click_url = $j['attr_id'].'='.urlencode($j['attr_value']);//点击的参数url
				if(!empty($_SERVER['argv']['0'])){			//当有argv参数时执行
					$argv = explode('&',$_SERVER['argv']['0']);
					$argv[]=$click_url;
					//过滤相同参数
					foreach($argv as $v){
						$argv1 = explode('=',$v);
						$new_argv[$argv1['0']]=$argv1['1'];
					}
					$n_argv = '';
					foreach($new_argv as $k=>$v){
						$n_argv .= $k.'='.$v.'&';
					}
					$n_argv = rtrim($n_argv,'&');
					$present_url =$_SERVER['REDIRECT_URL'].'?'.$n_argv;
					$true = true;
				}
				$url = empty($true)?$present_url.'?'.$click_url:$present_url;
				if(!empty($_SERVER['argv']['0'])&&strripos($_SERVER['argv']['0'],$click_url)!==false){
					$str.='<span>'.$j['attr_value'].'</span>&nbsp;';
				}else{
					$str.='<a href="'.$url.'">'.$j['attr_value'].'</a>&nbsp;';
				}
			}
			$str.= '</div>';
		}
		return $str;
	}

}
?>