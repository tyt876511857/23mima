<?php
Class SiteAction extends CommonAction{
	//验证数据安全
	protected $_valid = array(
		array('name',1,'请填写收货人姓名','require'),
		array('phone',1,'请填写手机号码','require'),
		array('sheng',1,'请填写收货地址','require'),
		array('shi',1,'请填写收货地址','require'),
		array('xian',1,'请填写收货地址','require'),
		array('site',1,'请填写收货地址','require'),
    );
	public function __construct(){
    	parent::__construct();
		$this->table = $this->site;
		$this->fields = $this->db->desc_field($this->table);
	}
	function index(){
		//收货地址
		$sql = 'select id,name,phone,sheng,shi,xian,site,encoding from '.$this->site.' where user_id='.$this->user_id;
		$this->site = $this->db->getAll($sql);
		$this->display();
	}
	//ajax增加收货地址
	function addSite(){
		//去除默认地址
		$sql = 'update '.$this->table.' set acquiesce=0 where user_id='.$this->user_id;
		$this->db->query($sql);

		$_POST['user_id'] = $this->user_id;
		$data = $this->verify();
		if($data['id'] == 0){
			$this->db->insert($this->table,$data);
			$data['id'] = mysql_insert_id();
		}else{
			$sql = 'update '.$this->table ." set acquiesce=1,name='$data[name]',phone='$data[phone]',sheng='$data[sheng]',shi='$data[shi]',xian='$data[xian]',site='$data[site]',encoding='$data[encoding]' where id=$data[id] and user_id=$this->user_id";
			$this->db->query($sql);
		}
		//p($data);
		echo json_encode($data);
	}
	//删除对应收货地址
	function delete(){
		$id = $this->get_id();
		$sql = 'delete from '.$this->table .' where id='.$id.' and user_id='.$this->user_id;
		$r = $this->db->query($sql);
		if($r){
			$this->success('删除成功！',U('/Site/index'));
		}else{
			$this->error('删除失败！ ');
		}
	}
}
?>