<?php
class AttributeAction extends CommonAction{
	protected $_auto = array(
		array('attr_values','value',''),
		array('rank','value',50)
	);
	//验证数据安全
	protected $_valid = array(
		array('attr_name',1,'必须有属性名','require'),
		array('cat_id',1,'请选商品类型','non_zero'),
		
    );
	public function __construct(){
    	parent::__construct();
		$this->table = $this->attribute;
		$this->fields = $this->db->desc_field($this->table);
	}
	private function data(){
		$sql = 'select cat_id,typename from '.$this->goods_type;
		return $this->db->getAll($sql);
	}
	public function index(){
		$this->id = $id = $id = $this->get_id();
		$sql = 'select a.attr_id,attr_name,attr_input_type,attr_values,rank,g.typename from '.$this->attribute. ' as a left join '.$this->goods_type .' as g on a.cat_id=g.cat_id where a.cat_id='.$id;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->case=$this->data();
		$this->cid =  $this->get_id('cid');
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->attribute,$id);
		$this->case=$this->data();
		$this->cid = $this->get_id('cid');
		$this->display('add');
	}
	public function runadd(){
		$type = !empty($_POST['attr_id'])?'update':'add';
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->attribute,$data);
			$info = '添加';
		}else{
			$r = $this->db->update($this->attribute,$data);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Attribute/index/id/'.$_POST['cat_id']));
		}
	}
	public function delete(){
		$id = $this->get_id();
		$sql = 'delete g,a from '.$this->attribute.' a left join '.$this->goods_attr.' g on a.attr_id=g.attr_id where a.attr_id='.$id;
		$r = $this->db->query($sql);
		if($r){
			$this->success('移除成功！');
		}
	}
}
?>