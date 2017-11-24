<?php
//订单类
Class IndentAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
		$this->table = $this->indent;
		//$this->fields = $this->db->desc_field($this->table);
		$this->when = '(CASE i.type WHEN 0 THEN "未付款" WHEN 1 THEN "已付款" WHEN 2 THEN "已发货" end) as typename,(case REFUND_STATUS when 0 then "" when 1 then "申请退款" when 2 then "退款成功" when 3 then "退款进行中" end) as REFUND_STATUS ';
	}
	function index(){
		$pagesize = 15;									//每页显示多少条
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		if (!empty($_GET['i_type'])) {
			$sql = 'select id from '.$this->table.' where i_type='.intval($_GET['i_type']);
		} else {
			$sql = 'select id from '.$this->table;
		}
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);					//实例化类
		$this->showpage = $Page->showpage();			//调用
		if (!empty($_GET['i_type'])) {
			$sql = 'select i.id,WIDtrade_no,indent,i_type,price,addtime,username,i.type,company,express,'.$this->when.' from '.$this->table.' as i left join '.$this->user.' as a on i.user_id=a.id where i.i_type='. intval($_GET['i_type']).' order by i.id desc limit '.$page*$pagesize.','.$pagesize;
		} else {
			$sql = 'select i.id,WIDtrade_no,indent,i_type,price,addtime,username,i.type,company,express,'.$this->when.' from '.$this->table.' as i left join '.$this->user.' as a on i.user_id=a.id order by i.id desc limit '.$page*$pagesize.','.$pagesize;
		}
		
		$this->list = $this->db->getAll($sql);
		$this->display();

	}
	//待处理订单
	function handle(){
		$pagesize = 15;									//每页显示多少条
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sql = 'select id from '.$this->table.' where type=1 or REFUND_STATUS=1';
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);					//实例化类
		$this->showpage = $Page->showpage();
		$sql = 'select i.i_type,i.id,WIDtrade_no,indent,price,addtime,username,i.type,'.$this->when.' from '.$this->table.' as i left join '.$this->user.' as a on i.user_id=a.id  where i.type=1 or REFUND_STATUS=1 order by i.id desc limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		$this->display('index');
	}
	function info(){
		$id = $this->get_id();
		$field = 'i.*,(case delivery when 1 then "均可" when 2 then "假日送" when 3 then "工作日送" end) as delivery,'.$this->when.',';
		//$field.= 's.name,s.phone,s.encoding,s.sheng,s.shi,s.xian,s.site,';
		$field.= 'g.goods_id,g.number,g.attr_value,g.unit_price ';
		$sql = 'select '.$field.' from '.$this->table.' as i ';
		$sql.= ' left join '.$this->shopping.' as g on i.id = g.indent_id where i.id='.$id;
		$array = $this->db->getAll($sql);
		$data = $array[0];
		$cache_goods_list = $this->shop_goods();
		foreach($array as $k => $v){
			$data['goosinfo'][$k] = $cache_goods_list[$v['goods_id']];
			$data['goosinfo'][$k]['number'] = $v['number'];
			$data['goosinfo'][$k]['attr_value'] = $v['attr_value'];
			//$data['goosinfo'][$k]['unit_price'] = $v['unit_price'];
		}
		//赠品级
		if(!empty($data['goods_array'])){
			$goods_array = explode(',',$data['goods_array']);
			foreach($goods_array as $k => $v){
				$this->goods_array[$k] = $cache_goods_list[$v];
			}
		}else{
			$this->goods_array = array();
		}
		
		$this->data = $data;
		$this->display();
	}
	


	
	public function update(){
		$_POST['id'] +=0;
		if(empty($_POST['express']) or empty($_POST['company'])){
			$this->success('请填写发货信息');
		}
		//支付宝提交发货信息
		$sql = 'select WIDtrade_no,type from '.$this->table.' where id='.$_POST['id'];
		$list = $this->db->getRow($sql);
		if( ($list['type']==1 or $list['type']==2) && !empty($list['WIDtrade_no']) && substr($list['WIDtrade_no'],0,3)!='wx_' ){
			$uri = "http://alumduan.com/data/alipay_send/alipayapi.php";
			// 参数数组
			$data = array (
			        'WIDtrade_no' 			=> $list['WIDtrade_no'],
			        'WIDlogistics_name'   	=> $_POST['company'],
			        'WIDinvoice_no'			=> $_POST['express'],
			        'WIDtransport_type'    	=> 'EXPRESS'
			);
			$ch = curl_init();
			// print_r($ch);
			curl_setopt ( $ch, CURLOPT_URL, $uri );
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
			$return = curl_exec ($ch);
			curl_close ($ch);

			$sql = 'update '.$this->table.' set company="'.$_POST['company'].'",express="'.$_POST['express'].'" where type in(1,2) and id='.$_POST['id'];
			$r = $this->db->query($sql);
		}
		//微信
		if(!empty($list['WIDtrade_no']) && substr($list['WIDtrade_no'],0,3)=='wx_'){
			$sql = 'update '.$this->table.' set type=2,company="'.$_POST['company'].'",express="'.$_POST['express'].'" where type in(1,2) and id='.$_POST['id'];
			$r = $this->db->query($sql);
		} else {//同程的订单
			$sql = 'update '.$this->table.' set type=2,company="'.$_POST['company'].'",express="'.$_POST['express'].'" where type in(1,2) and i_type=11 and id='.$_POST['id'];
			$r = $this->db->query($sql);
		}
		if($r){
			$this->success('提交成功！');
		}
	}
	function sum(){
		$sql = 'select count(t.id) as count,i.name,title from '.$this->table.' as t left join '.$this->identify.' as i on t.i_type=i.name group by i_type';
		$list = $this->db->getAll($sql);
		$data = array();
		foreach($list as $v){
			if(!empty($v['name'])){
				$data[] = $v;
			}
		}
		$this->list = $data;
		$this->display();
	}
}
?>