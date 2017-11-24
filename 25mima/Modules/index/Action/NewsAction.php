<?php
Class NewsAction extends Action{
	public function index(){
		$id =$_GET['n_id'];//得到文章栏目ID
		$sql = 'select * from '.$this->arttype.' where id='.$id;
		$Unfiltered=array('content','content1');//不过滤键名为这些的html标签
		$this->field = $this->db->getRow($sql,$Unfiltered);
		if(empty($this->field)){
			$this->error('访问出错！');
		}
		$cache_config = $this->shop_config();
		$cache_shop_goods_list = $this->shop_goods_list();
		$this->field['title'] = $this->field['typename'].'_'.$cache_config['cfg_shop_title'];
		//文章列表
		$pagesize = '10';
		$id = $this->get_id('n_id');
		$cache_shop_news_list = $this->shop_news_list();
		$id.= ','.implode(',',Category::getChildsId($cache_shop_goods_list,$id));
		$id = trim($id,',');
		$page = empty($_GET['page'])?0:$_GET['page']-1;
		$where = ' cat_id in ('.$id.')';
		$field = 'id,title,add_time,litpic,description as info,cat_id ';
		$sql = 'select '.$field.' from '.$this->article.' where '.$where.' order by rank,id desc';
		$num = $this->db->getNum($sql);//取得总条数
		$sql .= ' limit '.$page*$pagesize.','.$pagesize;
		$list = $this->db->getAll($sql);
		$this->list = $this->IntegrationGoods($list,'news');
		$pagelist = new Page($num,$pagesize);
		$this->page = $pagelist->showpage();

		if(!DEBUG){
			$create = new CreateHtml();
			$create->start();
			$this->display($this->field['site']);
			$create->end(C('REWRITE_NEWS').$id);
		}else{
			$this->display($this->field['site']);
		}
	}
}
?>