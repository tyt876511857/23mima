<?php
Class LinkAction extends CommonAction{
	protected $_auto = array(
    	array('rank','value','50'),
    );
	//验证数据安全
	protected $_valid = array(
		array('title',1,'必须有链接名称','require'),
        array('rank',1,'排序必须是整型值','number')
    );
    public function __construct(){
    	parent::__construct();
		$this->table = $this->link;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function index(){
		$sql = 'select * from '.$this->link;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->link,$id);
		$this->display('add');
	}
	public function runadd(){
		$type = !empty($_POST['id'])?'update':'add';
		$_POST['logo'] = empty($_FILES['logo']['name'])?$_POST['textfield']:Upload::up('logo');
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->link,$data);
			$info = '添加';
		}else{
			$r = $this->db->update($this->link,$data);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Link/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();
		$r = $this->db->delete($this->link,$id);
		if($r){
			$this->success('删除成功！',U('/Link/index'));
		}
	}
}
?>