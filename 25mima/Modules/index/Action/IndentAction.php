<?php
//订单
Class IndentAction extends CommonAction{
	//自动填充
	protected $_auto = array(
        array('addtime','function','time'),
	);
	public function __construct(){
    	parent::__construct();
		$this->table = $this->indent;
		$this->fields = $this->db->desc_field($this->table);
	}
	//提交订单
	public function indent(){
		//判断是否有选中商品
		if(empty($_POST['goods_list'])){
			$this->error('请选中商品！');
		}
		if(empty($_POST['site'])){
			$this->error('请选择地址！');
		}
		$cache_goods_list = $this->shop_goods();
		$_POST['indent'] = time().rand(1,9999);
		$_POST['user_id'] = $this->user_id;
		
		$goods_id = implode(',',array_unique($_POST['goods_list']));//拼接选中的商品
		//$sql = 'select * from '.$this->goods_attr.' where goods_id in('.$goods_id.')';
		$sql = 'select a.attr_id,attr_value,attr_price,attr_name,goods_id from '.$this->goods_attr.' as g INNER join '.$this->attribute.' as a on g.attr_id=a.attr_id where a.attr_type=2 and goods_id in('.$goods_id.')';
		$list = $this->db->getAll($sql);
		foreach($list as $k=>$v){
			$data[$v['goods_id']]['value'][] = $v['attr_value'];
			$data[$v['goods_id']]['price'][] = $v['attr_price'];
		}
		$sql = array();
		$_POST['price'] = 0;
		$_POST['fujia_price'] = 0;
		foreach($_POST['goods_list'] as $k=>$v){
			//获取对应属性所需加多少钱
			if(!empty($data[$v]['value'])){
				foreach($data[$v]['value'] as $key => $value){
					foreach($_POST['attr_value'][$k] as $j){
						if($j == $value){
							$_POST['fujia_price'] += $data[$v]['price'][$key] *$_POST['number'][$k];
						}
					}
				}
			}
			
			$_POST['price'] += $cache_goods_list[$v]['shop_price'] * $_POST['number'][$k] +$_POST['fujia_price'];
		}
		//避免为空
		$_POST['present'] = empty($_POST['present'])?$_POST['present']=Array():$_POST['present'];
		$_POST['probation'] = empty($_POST['probation'])?$_POST['probation']=Array():$_POST['probation'];
		$_POST['goods_array'] = array_merge($_POST['present'],$_POST['probation']);
		$_POST['goods_array'] = implode(',',$_POST['goods_array']);


		mysql_query('begin');//开始事务
		$post = $this->verify();
		$judge = $this->db->insert($this->table,$post);
		$indent_id = mysql_insert_id();
		foreach($_POST['goods_list'] as $k=>$v){
			if(!empty($_POST['attr_value'][$k])){
				$_POST['attr_value'][$k] = implode(',',$_POST['attr_value'][$k]);
			}else{
				$_POST['attr_value'][$k] = '';
			}
			$sql[] = 'update '.$this->shopping.' set attr_value="'.$_POST['attr_value'][$k].'",indent_id='.$indent_id.',number='.$_POST['number'][$k].' where id='.$k;
		}
		foreach ($sql as $v){
	    	Log::write($v);
		    if (!mysql_query($v)){
	            $judge = 0;
		    }
	    }
	    if ($judge == 0) {
	        mysql_query('rollback');
	        $this->error('提交失败');
	    }elseif ($judge == 1) {
	        mysql_query('commit');
	        $this->success('提交成功',U('/Shopping/shop3/id/'.$indent_id));
	    }
	}
}