<?php
class MyadAction extends CommonAction{
	protected $_auto = array(
    	array('rank','value','50'),
    );
	//验证数据安全
	protected $_valid = array(
		array('type',1,'必须有广告位标识','require'),
		array('rank',1,'必须是整数型','number'),
    );
    public function __construct(){
    	parent::__construct();
    	$this->table = $this->myad;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function index(){
		$pagesize='15';
		$sql = 'select id from '.$this->table;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$sql = 'select id,type,title,description,switch,rank from '.$this->table.' order by type,rank,id limit '.$page*$pagesize.','.$pagesize;
		$this->data = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$Unfiltered=array('content');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->myad,$id,$Unfiltered);
		$this->display('add');
	}
	public function runadd(){
		$this->is_submit();
		log::write('这是ID：'.$_POST['id']);
		$type = !empty($_POST['id'])?'update':'add';
		log::write($type);
		$_POST['litpic'] = empty($_FILES['litpic']['name'])?$_POST['textfield']:Upload::up('litpic');
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->myad,$data);
			$info = '添加';
		}else{
			$r = $this->db->update($this->myad,$data);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Myad/index'));
		}
	}
	//删除
	public function delete(){
		$id = $this->get_id();
		$this->db->delete($this->table,$id);
		$this->success('删除成功！');
	}
}
?>