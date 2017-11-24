<?php
Class RbacAction extends CommonAction{
	//验证数据安全
	protected $_valid = array(
		array('usertype',1,'请选择系统用户组','non_zero'),
		array('userid',1,'必须有登录ID','require'),
        array('uname',1,'必须有登录名称','require'),
    );
    public function __construct(){
    	parent::__construct();
		$this->table = $this->admin;
		$this->fields = $this->db->desc_field($this->admin);
	}
	//系统用户组列表
	private function getAdmintype(){
		$sql = 'select id,name from '.$this->admintype;
		return $this->db->getAll($sql);
	}
	public function index(){
		$sql = 'select a.*,t.name from '.$this->table.' a left join '.$this->admintype .' t on a.usertype=t.id';
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->name = '添加';
		$this->usertype = $this->getAdmintype();
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->table,$id);
		$this->name = '修改';
		$this->usertype = $this->getAdmintype();
		$this->display('add');
	}
	function delete(){
		$id = $this->get_id();
		$r = $this->db->delete($this->table,$id);
		if($r){
			$this->success('删除成功！',U('/Rbac/index'));
		}
	}
	public function runadd(){
		$type = !empty($_POST['id'])?'update':'add';
		$data = $this->verify();
		if($type=='add'){
			if(!empty($data['pwd'])){
				$data['pwd']=md5($data['pwd']);
			}else{
				$this->error('请输入密码！');
			}
			$r = $this->db->insert($this->table,$data);
			$info = '添加';
		}else{
			if(empty($data['pwd'])){
				unset($data['pwd']);
			}else{
				$data['pwd']=md5($data['pwd']);
			}
			$r = $this->db->update($this->table,$data);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Rbac/index'));
		}
	}
	function group(){
		$this->list = $this->getAdmintype();
		$this->display();
	}
	function update_group(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->admintype.' where id='.$id;
		$this->data = $this->db->getRow($sql);
		$sql = 'select * from '.$this->purviews;
		$cate = $this->db->getAll($sql);
		$this->cate = Category::multidimensional($cate);
		$this->display();
	}
	function add_group(){
		$this->data = array('purviews'=>'');
		$sql = 'select * from '.$this->purviews;
		$cate = $this->db->getAll($sql);
		$this->cate = Category::multidimensional($cate);
		$this->display('update_group');
	}
	public function runupdate_group(){
		$type = !empty($_POST['id'])?'update':'add';
		$_POST['purviews'] = implode(',',$_POST['purviews']);
		if($type=='add'){
			$r = $this->db->insert($this->admintype,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->admintype,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Rbac/group'));
		}
	}
}
?>