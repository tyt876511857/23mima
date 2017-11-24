<?php
//搜索页
Class SearchAction extends Action{
	public function index(){
		$cache_config = $this->shop_config();
		$field['title'] = '搜索结果_'.$cache_config['cfg_shop_title'];
		$field['title1'] = '>搜索结果';
		$this->field = $field;
		$sql = 'select goods_id from '.$this->goods.' where is_delete=0 and goods_name like "%'.$_POST['key'].'%"';
		$list = $this->db->getAll($sql);
		$this->list = $this->IntegrationGoods($list);
		$this->display('List:category');
	}
}
?>