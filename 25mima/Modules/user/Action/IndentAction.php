<?php
Class IndentAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
		$this->table = $this->indent;
		//$this->fields = $this->db->desc_field($this->table);
		$this->when = '(CASE i.type WHEN 0 THEN "未付款" WHEN 1 THEN "已付款" WHEN 2 THEN "已发货" end) as typename ';
		$this->cache['goods_list'] = $this->shop_goods();
	}
	function index(){
		//print_r(11);exit;
		$pagesize = 100;									//每页显示多少条
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sql = 'select id from '.$this->table.' where user_id='.$this->user_id;
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);					//实例化类
		$this->showpage = $Page->showpage();			//调用
		//获取手机号
		$sql = 'select username from '.$this->user.' where id='.$this->user_id;
		$r = $this->db->getRow($sql);

		//判断不同状态
		$i_type = !isset($_GET['i_type'])?10:$_GET['i_type'];
		$i_where = '';
		if($i_type != 10){
			$i_where = ' i.type='.$i_type.' and ';
		}
		$sql = 'select i.id,indent,i.name,i.size,price,addtime,uname,goods_array,i.type,'.$this->when.' from '.$this->table.' as i left join '.$this->admin.' as a on i.user_id=a.id where '.$i_where.' (user_id = '.$this->user_id.' or phone='.$r['username'].')  order by i.id desc limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		foreach($this->list as $k=>$v){
			$sql = 'select * from '.$this->shopping.' where indent_id='.$v['id'];
			$this->list[$k]['child'] = $this->db->getAll($sql);
			$this->list[$k]['child'] = $this->IntegrationGoods($this->list[$k]['child']);
			$goods_array = empty($v['goods_array'])?array():explode(',',$v['goods_array']);
			foreach($goods_array as $l => $j){
				$this->list[$k]['present'][$l] = $this->cache['goods_list'][$j];
			}
		}
		//唾液
		$sql = 'select t.*,b.id as bid,b.pdfurl,b.pdfname from '.$this->bg_tuoye.' t left join gs_bg_baogao b on t.identifier=b.title where t.state<7 and t.uid='.$this->user_id;
		$tuoye = $this->db->getAll($sql);

		foreach($tuoye as &$v){
			$v['bgtime']=$v['time'.$v['state']];
		}
		$this->tuoye = $tuoye;
		//报告
		$sql = 'select * from '.$this->bg_tuoye.' where state=5 and uid='.$this->user_id;
		$this->baogao = $this->db->getAll($sql);

		//优惠码
		$sql = 'select * from '.$this->youhuijuan.' where (user_id = '.$this->user_id.' or phone='.$r['username'].') and state=0 and endtime>'.time();
		$this->youhui = $this->db->getAll($sql);
		$this->display('index:baogao');
	}
	function info(){
		$id = $this->get_id();
		$field = 'i.id,i.name,i.phone,i.size,i.indent,i.coupon_array,i.goods_array,i.price,(case delivery when 1 then "均可" when 2 then "假日送" when 3 then "工作日送" end) as delivery,'.$this->when.',i.addtime,i.company,i.express,';
		//$field.= 's.name,s.phone,s.encoding,s.sheng,s.shi,s.xian,s.site,';
		$field.= 'g.goods_id,g.number,g.attr_value,g.unit_price ';
		$sql = 'select '.$field.' from '.$this->table.' as i ';
		$sql.= ' left join '.$this->shopping.' as g on i.id = g.indent_id where i.id='.$id;
		$array = $this->db->getAll($sql);
		//p($array);
		$data = $array[0];
		foreach($array as $k => $v){
			$data['goosinfo'][$k] = $this->cache['goods_list'][$v['goods_id']];
			$data['goosinfo'][$k]['number'] = $v['number'];
			$data['goosinfo'][$k]['attr_value'] = $v['attr_value'];
			$data['goosinfo'][$k]['unit_price'] = $v['unit_price'];
		}
		$this->data = $data;
		$this->display();
	}
}
?>