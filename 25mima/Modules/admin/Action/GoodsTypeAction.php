<?php
//商品类型
class GoodsTypeAction extends CommonAction{
	//验证数据安全
	protected $_valid = array(
		array('typename',1,'必须有类型名','require')
    );
	public function __construct(){
    	parent::__construct();
    	$this->table  = $this->goods_type;
		$this->fields = $this->db->desc_field($this->table);

	}
	public function index(){
		$sql = 'select * from '.$this->goods_type;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->goods_type,$id);
		$this->display('add');
	}
	public function runadd(){
		$type = !empty($_POST['cat_id'])?'update':'add';
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->goods_type,$data);
			$info = '添加';
		}else{
			$r = $this->db->update($this->goods_type,$data);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/GoodsType/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();
		$sql = 'delete g,a from '.$this->goods_type.' g left join '.$this->attribute.' a on g.cat_id=a.cat_id where g.cat_id='.$id;
		$r = $this->db->query($sql);
		if($r){
			$this->success('移除成功！',U('/GoodsType/index'));
		}
	}
}
?>