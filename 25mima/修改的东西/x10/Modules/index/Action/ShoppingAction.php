<?php
/*购物车*/
//Class ShoppingAction extends CommonAction{
Class ShoppingAction extends Action{
	//自动填充
	protected $_auto = array(
        array('number','value',1),
	);
    public function __construct(){
    	parent::__construct();
		$this->table = $this->shopping;
		$this->fields = $this->db->desc_field($this->table);
		$this->user_id = empty($_SESSION['user_id'])?0:$_SESSION['user_id'];
		//$this->setShoppingNumber($this->user_id);
	}
	public function shop(){
		$user_id = $this->user_id;
		$sql = 'select * from '.$this->table.' where indent_id = 0 and user_id='.$user_id;
		$list = $this->db->getAll($sql);
		if(empty($list)){
			$this->error('购物车为空哦');
		}
		$cache_goods_list = $this->shop_goods();
		foreach($list as $k=>$v){
			$list[$k] = array_merge($list[$k],$cache_goods_list[$v['goods_id']]);
			if($list[$k]['market_price'] == 0){
				$list[$k]['chajia'] = 0;
			}else{
				$list[$k]['chajia'] = $list[$k]['market_price'] - $list[$k]['shop_price'];
			}
			$sql = 'select a.attr_id,attr_value,attr_price,attr_name from '.$this->goods_attr.' as g INNER join '.$this->attribute.' as a on g.attr_id=a.attr_id where a.attr_type=2 and goods_id='.$v['goods_id'];
			$data = $this->db->getAll($sql);
			foreach($data as $j){
				$list[$k]['option'][$j['attr_id']]['attr_name'] = $j['attr_name'];
				$list[$k]['option'][$j['attr_id']]['option'][] = $j['attr_value'];
				$list[$k]['option'][$j['attr_id']]['attr_price'][] = $j['attr_price'];
			}
		}
		$this->list =$list;
		//收货地址
		$sql = 'select id,name,phone,sheng,shi,xian,site,encoding from '.$this->site.' where user_id='.$user_id;
		$this->site = $this->db->getAll($sql);
		//我收藏过的商品
		$sql = 'select goods_id from '.$this->favorite.' where user_id='.$user_id.' order by id desc limit 7';
		$this->favorite = $this->db->getAll($sql);
		$this->favorite = $this->IntegrationGoods($this->favorite);
		//p($this->favorite);
		$sql = 'select DISTINCT goods_id from '.$this->shopping.' where indent_id!=0 and user_id='.$user_id.' order by id desc limit 7';
		$shopping = $this->db->getAll($sql);
		$this->shopping = $this->IntegrationGoods($shopping);
		if(empty($_COOKIE['history'])){
			$this->history = array();
		}else{
			$history = explode('|',$_COOKIE['history']);
			foreach($history as $k => $v){
				
				if( empty($cache_goods_list[$v]) ){continue;}//假如缓存没有该商品则跳过
				
				$history[$k] =$cache_goods_list[$v];
			}
			$this->history = $history;
		}
		$this->display();
	}
	//添加到购物车
	public function addRow(){
		$_POST['user_id'] = $this->user_id;
		$data = $this->verify();
		$data['goods_id'] = $this->get_id();
		if(!empty($data['attr_value'])){
			$data['attr_value'] = implode(',',$data['attr_value']);
		}else{
			$data['attr_value'] = '';
		}
		$sql = 'select id from '.$this->table." where indent_id=0 and goods_id=$data[goods_id] and user_id=$data[user_id] and attr_value='$data[attr_value]'";
		if($id = $this->db->getRow($sql)){
			$sql = 'update '.$this->table.' set number=number+'.$data['number'].' where id='.$id['id'];
			$r = $this->db->query($sql);
		}else{
			$r = $this->db->insert($this->table,$data);
		}
		if($r){
			$this->success('加入购物车成功！');
		}
	}
	//从购物车中删除
	public function delete(){
		$id = $this->get_id();
		$this->db->delete($this->table,$id);
		$this->success('删除成功!');
	}
	// 订单提交成功
	public function shop3(){
		$id = $this->get_id();
		$sql = 'select indent,price,payment from '.$this->indent.' where id='.$id.' and user_id='.$this->user_id;
		$this->indent=$this->db->getRow($sql);
		$this->display();
	}
	//获取优惠码
	function getRandChar($length){
	   $str = null;
	   $strPol = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
	   $max = strlen($strPol)-1;

	   for($i=0;$i<$length;$i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	   }
	   $sql = 'select id from '.$this->youhuijuan.' where title="'.$str.'" limit 1';
	   $r = $this->db->getRow($sql);
	   if(empty($r)){
	   	return $str;
	   }else{
	   	return $this->getRandChar($length);
	   }
	 }
	//mima
	function mima(){
		//判断是否上线
		if(empty($_SESSION['user_id'])){
			$this->error('您还没有登录请先登录！','/index/Index/loginurl');	exit;	
		}
		//print_r($_SESSION);exit;
		$sql = 'select * from '.$this->goods.' where is_on_sale=1 and  goods_id='.$_POST['goods_id'][0];
		$num = $this->db->getNum($sql);
		if(empty($num)){
			$this->error('该产品暂未上线，尽请期待！');
		}
		$goods = array();
		foreach($_POST['goods_id'] as $k=>$v){
			$goods[$k]['goods_id'] 	= $v;
			$goods[$k]['number']    = $_POST['number'][$k];
		}
		$this->shopping = $this->IntegrationGoods($goods);
		//更多基因
		$sql = 'select goods_id from '.$this->goods.' where goods_id!='.$_POST['goods_id'][0].' and is_on_sale=1 limit 2';
		$goodslist = $this->db->getAll($sql);
		$this->goodslist = $this->IntegrationGoods($goodslist);
		$this->display();
	}
	function runmima(){
		if(empty($_POST['country']) || empty($_POST['address']) || empty($_POST['name']) || empty($_POST['mobile'])){
			$this->success('数据出错！',U('Index/index'));
		}
			//print_r($_POST['card']);exit;
		//添加到购物车
		$sql = 'insert into '.$this->shopping.' (indent_id,goods_id,user_id,number,unit_price) values ';
		$uid = $this->user_id;
		$_POST['price'] = 0;//订单价格
		foreach($_POST['number'] as $k=>$v){
			if(!empty($v)){
				$goods_id = $_POST['goods_id'][$k];
				$sql_price = 'select shop_price from '.$this->goods.' where goods_id='.$goods_id;
				$r1 = $this->db->getRow($sql_price);
				$_POST['price'] += $r1['shop_price'] * $v;
				$sql .= "(000,$goods_id,$uid,$v,".$r1['shop_price']."),";
			}
		}
		if(!$_POST['price']){
			//没选择商品
			$this->success('数据出错！',U('shopping/mima'));exit;
		}
		$sql = trim($sql,',');
		//提交订单
		$data = array();
		$data['indent'] = time().rand(1,9999);
		$data['user_id'] = $this->user_id;
		$data['name'] = $_POST['name'];
		$data['phone'] = $_POST['mobile'];
		$data['size'] = $_POST['province'].$_POST['city'].$_POST['country'].$_POST['address'];
		$data['price'] = $_POST['price'];
		$data['addtime'] = time();
		$data['i_type'] = empty($_SESSION['i_type'])?'':$_SESSION['i_type'];
		//发票信息
		$data['fapiao'] = $_POST['fapiao'];
		if($_POST['fapiao'] == 2){
			$data['companyName'] = $_POST['companyName'];
		}elseif($_POST['fapiao'] == 3){
			if(empty($_POST['vat_country']) || empty($_POST['vat_receive_address']) ){
				$this->error('请正确填写发票信息!');exit;
			}
			$data['vat_companyName'] = $_POST['vat_companyName'];
			$data['vat_code'] = $_POST['vat_code'];
			$data['vat_address'] = $_POST['vat_address'];
			$data['vat_tel'] = $_POST['vat_tel'];
			$data['vat_bank'] = $_POST['vat_bank'];
			$data['vat_bank_num'] = $_POST['vat_bank_num'];
			$data['vat_name'] = $_POST['vat_name'];
			$data['vat_message_tel'] = $_POST['vat_message_tel'];
			$data['vat_province'] = $_POST['vat_province'];
			$data['vat_city'] = $_POST['vat_city'];
			$data['vat_country'] = $_POST['vat_country'];
			$data['vat_receive_address'] = $_POST['vat_receive_address'];
		}
		mysql_query('begin');//开始事务
		//减去优惠价格
		$r3 = 1;
		if(!empty($_POST['card'])){
			$yh_sql = 'select * from gs_cards where card ="'.$_POST['card'].'" and state=1 ';
			$yh_sql = $this->db->getRow($yh_sql);
			if(!empty($yh_sql)){
				$data['price'] -= $yh_sql['jiage'];
				$data['coupon_array'] = $yh_sql['id'];
				$yh_sql1 = array();
				$yh_sql1['id'] = $yh_sql['id'];
				$yh_sql1['usetime'] = time();
				$yh_sql1['state'] = 1;
			//	$r3 = $this->db->update($this->youhuijuan,$yh_sql1);
			}else{				
					$this->error('请填写正确的优惠码！');exit;		
			}
		}
		//print_r($yh_sql);exit;
		
		$r = $this->db->insert($this->indent,$data);
		$indent_id = mysql_insert_id();
		$sql = str_ireplace("(000,","(".$indent_id.',',$sql);
		$r1 = $this->db->query($sql);
		//优惠卷
		$cache_config = $this->shop_config();
		$youhui = array();
		$youhui['i_id'] = $data['indent'];
		$youhui['title'] = $this->getRandChar(6);
		$youhui['user_id'] = $data['user_id'];
		$youhui['phone'] = $data['phone'];
		$youhui['addtime'] = time();
		$youhui['endtime'] =  $youhui['addtime'] + $cache_config['cfg_yh_ma']*86400;
		$youhui['price'] = $cache_config['cfg_yh_price'];
		//$r2 = $this->db->insert($this->youhuijuan,$youhui);
		if (empty($r) || empty($r1)  ) {
	        mysql_query('rollback');
	        $this->success('订单出错！请重新提交！',U('Index/index'));
	    }else{
	        mysql_query('commit');
	        file_get_contents(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?&notice=1");
	        $this->success('提交成功',U('/Alipay/index/id/'.$data['indent'],'user'));
	    }
	}
	//赠品
	function present(){
		$num = $_POST['number']+0;
		$sql = 'select goods_id from '.$this->goods.' where cat_id=11 and is_delete=0 limit '.$num;
		$list = $this->db->getAll($sql);
		$list = $this->IntegrationGoods($list);
		$str = '';
		foreach($list as $v){
			$str.= '<a href="'.$v['url'].'" target="_blank">';
			$str.= '<img src="'.$v['goods_thumb'].'" />';
			$str.= '<span>'.$v['goods_name'].'</span>';
			$str.= '<p>赠完为此赠完为此赠完为此赠完为此赠完为此赠完为此</p>';
			$str.= '<input name="present[]" type="checkbox" value="'.$v['goods_id'].'" checked="checked" />';
			$str.= '</a>';
		}
		echo $str;
	}
	//试用
	function shiyong(){
		$num = $_POST['number']+0;
		$sql = 'select goods_id from '.$this->goods.' where cat_id=12 and is_delete=0 limit '.$num;
		$list = $this->db->getAll($sql);
		$list = $this->IntegrationGoods($list);
		$str = '';
		foreach($list as $v){
			$str .= '<div class="probation_list">';
			$str .= '<a href="'.$v['url'].'" target="_blank"><img src="'.$v['goods_thumb'].'" /></a>';
			$str .= '<input name="probation[]" type="checkbox" value="'.$v['goods_id'].'"  />';
			$str .= '<a href="'.$v['url'].'" target="_blank"><p>'.$v['goods_name'].'</p></a>';
			$str .= '</div>';
		}
		echo $str;
	}
}
?>