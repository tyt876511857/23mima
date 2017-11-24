<?php
Class FavoriteAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
		$this->table = $this->favorite;
		$this->fields = $this->db->desc_field($this->table);
	}
	function index(){
		$sql = 'select goods_id from '.$this->table .' where user_id='.$this->user_id;
		$list = $this->db->getAll($sql);
		$this->list = $this->IntegrationGoods($list);
		$this->display();
	}
}
?>