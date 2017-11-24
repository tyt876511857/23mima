<?php
Class GoodsAction extends Action{
	public function index(){
		$id =$_GET['g_id'];//得到商品ID
		//得到商品详细并得到商品搭配列表
		$sql = 'select g.*,b.brand_name from '.$this->goods.' as g left join '.$this->brand.' as b on g.brand_id=b.brand_id where goods_id='.$id;
		$Un = array('goods_brief','goods_brief1');
		$field = $this->db->getRow($sql,$Un);
		if(empty($field)){
			$this->error('访问出错！');
		}
		if($field['is_delete'] == 1){
			$this->error('该商品已下架！');
		}
		//获取检测项目
		$this->xianmu();
		//得到商品所属类型下参数
		$sql = 'select a.attr_id,attr_name,attr_type,attr_values,g.attr_value,g.attr_price from '.$this->attribute.' as a,'.$this->goods_attr.' as g where a.attr_id=g.attr_id and cat_id='.$field['goods_type'].' and g.goods_id='.$field['goods_id'].' ORDER BY rank';
		$this->attribute = $this->db->getAll($sql);
		//p($this->attribute);
		//得到可供用户选择的属性(改进的)
		$this->option=array();
		$this->attrlist=array();
		foreach($this->attribute as $k => $v){
			if($v['attr_type'] == 2){
				$this->option[$v['attr_id']]['attr_name']   = $v['attr_name'];
				$this->option[$v['attr_id']]['option'][] = $v['attr_value'];
				$this->option[$v['attr_id']]['attr_price'][] = $v['attr_price'];
				//$this->option[$k]['option'] = explode(',',$v['attr_values']);
			}else{//列出其他的商品属性
				$this->attrlist[$v['attr_id']]['attr_name'] = $v['attr_name'];
				$this->attrlist[$v['attr_id']]['attr_value'] = $v['attr_value'];
			}
		}

		//设置标题
		$cache_config = $this->shop_config();
		$field['title']=$field['goods_name'].'_'.$cache_config['cfg_shop_title'];
		
		$this->field = $field;
		//得到评论列表
		$sql = 'select id,user_name,content,comment_rank,add_time,ding,cai from  '.$this->comment.' where type=0 and goods_id='.$id.' order by id desc';
		$this->comments = $this->db->getAll($sql);
		$this->comments_sum = count($this->comments);
		$this->comments_sum1 = $this->comments_sum+1;
		//得到搭配列表
		$sql = 'select group_goods_id from  '.$this->goods_group.' where goods_id='.$id;
		$goods_group = $this->db->getAll($sql);
		$cache_goods_list = $this->shop_goods();
		$this->field['stars'] = $cache_goods_list[$id]['stars'];//设置商品星级
		foreach($goods_group as $k=>$v){
			$goods_group[$k] = $cache_goods_list[$v['group_goods_id']];
		}
		$this->goods_group = $goods_group;
		if(STARS){
			$goods_stars = CACHE.'shop_stars.php';
			if(!file_exists($goods_stars)){
				$sql = 'select goods_id,count(id) as count,sum(comment_rank) as sum from '.$this->comment.' where type=0 GROUP BY goods_id';
				$r = $this->db->getAll($sql);
				foreach($r as $v){
					$arr[$v['goods_id']] = round($v['sum']/$v['count']*20);
				}
				//写入到文件
				$fp = fopen($goods_stars,'w');
				$content = "<?php\r\n";
				$content.= 'return ';
				$content.= var_export($arr,true).";\r\n";
				//$content.= 'return $shop_config;';
				$content.= '?>';
				fputs($fp,$content);
				fclose($fp);
			}
		}
		$this->_history($id);//我的浏览足迹
		if(!DEBUG){
			$create = new CreateHtml();
			$create->start();
			$this->display('Article:goods');
			$create->end(C('REWRITE_GOODS').$id);
		}else{
			$this->display('Article:goods');
		}
	}
	//ajax获取商品评分
	function goods_stars(){
		$data = include_once(CACHE.'shop_stars.php');
		echo json_encode($data);
	}

	/**  * 商品历史浏览记录  * $data 商品记录信息  */
	private function _history($id){
		if(!isset($_COOKIE["history"])){
			$his[] = $id;
		}else{
			$his = explode('|',$_COOKIE['history']);
			array_unshift($his,$id);
    		$his = array_unique($his);
    		if(count($his) > 7) {
        		array_pop($his);
    		}
		}
		setcookie('history',implode('|',$his),time()+31536000);
	}
	//获取检测项目
	function xianmu(){
		$id =$_GET['g_id'];
		$sql = 'select * from '.$this->goodspo.' where gid='.$id;
		$this->xianmu = $this->db->getAll($sql);
	}
	function xianmuRow(){
		$id = $_GET['id'];
		$sql = 'select * from '.$this->goodspo.' where id='.$id;
		$r = $this->db->getRow($sql);
		echo json_encode($r);
	}
}
?>