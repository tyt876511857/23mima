<?php
//商品分类
Class CategoryAction extends CommonAction{
	// 自动填充
	protected $_auto = array(
                            array('rank','value',50),
                            array('grade','value',0),
    );
	//验证数据安全
	protected $_valid = array(
                            array('typename',1,'必须有分类名','require'),
                            array('pid',1,'栏目id必须是整型值','number'),
							array('rank',1,'排序必须是整型值','number'),
    );
    public function __construct(){
    	parent::__construct();
		$this->table = $this->category;
		$this->fields = $this->db->desc_field($this->table);
	}
	private function goodsType(){
		$sql = 'select cat_id,typename from '.$this->goods_type.' where enabled=1';
		$r = $this->db->getAll($sql);
		$data = '';//定义变量
		foreach($r as $v){
			$sql = 'select attr_id,attr_name from '.$this->attribute.' where cat_id='.$v['cat_id'];
			$v['attr'] = $this->db->getAll($sql);
			$data[]=$v;
		}
		if(empty($data)){
			$data = array();
		}
		return $data;
	}
	public function index(){
		$id = empty($_GET['id'])?0:$_GET['id']+0;
		$list = $this->shop_goods_list();
		$this->list = Category::multidimensional($list,'child',$id,'nourl');
		$this->display();
	}
	public function add(){
		$this->goods_types = $this->goodsType();
		$cate = $this->shop_goods_list();
		$this->cate = Category::multidimensional($cate);
		$this->goodsType = array();
		$this->display();
	}
	public function update(){
		$this->goods_types = $this->goodsType();
		$cate = $this->shop_goods_list();
		$this->cate = Category::multidimensional($cate);
		$id = $this->get_id();
		$Unfiltered=array('content');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->table,$id,$Unfiltered);
		//商品类型
		$sql = 'select a.attr_id,a.attr_name,a.cat_id,t.typename from '.$this->attribute.' a left join '.$this->goods_type.' t on a.cat_id=t.cat_id where a.attr_id in ('.$this->field['filter_attr'].')';
		$this->goodsType = $this->db->getAll($sql);
		$this->display('add');
	}
	public function runadd(){
		$type = !empty($_POST['id'])?'update':'add';
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->category,$data);
			$info = '添加';
		}else{
			$cache_shop_goods_list = $this->shop_goods_list();
			$id_all = Category::getChildsId($cache_shop_goods_list,$_POST['id']);
			$id_all[] = $_POST['id'];
			if(in_array($_POST['pid'],$id_all)){
				$this->error('父栏目不可以为自身或者其子栏目！');
			}
			$r = $this->db->update($this->category,$data);
			$info = '修改';
		}
		unlink(CACHE.'shop_goods_list.php');// 删除缓存
		if($r){
			$this->success($info.'成功！',U('/Category/index'));
		}
	}

	public function move(){
		$cate = $this->cate_info();
		$this->cate = Category::multidimensional($cate);
		$this->id = $this->get_id();
		$this->display();		
	}
	public function runMove(){
		$id = $_POST['cat_id'];
		$tid = $_POST['target_cat_id'];
		$cate = $this->cate_info();
		$child = Category::getChildsId($cate,$id);
		$child[] = $id;
		$str = implode(',',$child);
		$sql = 'update '.$this->goods.' SET  cat_id='.$tid.' WHERE cat_id in ('.$str.')';
		$r = $this->db->query($sql);
		if($r){
			$this->success('转移商品成功！',U('/Category/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();

		$cate = $this->cate_info();
		$child = Category::getChildsId($cate,$id);
		$child[] = $id;
		$str = implode(',',$child);
		$r = $this->db->delete($this->category,$str);
		if($r){
			$this->success('删除成功！',U('/Category/index'));
		}
	}
}
?>