<?php
//品牌
class BrandAction extends CommonAction{
	//验证数据安全
	protected $_valid = array(
		array('brand_name',1,'必须有品牌名','require'),
        array('site_url',1,'必须有品牌网址','require')
    );
    public function __construct(){
    	parent::__construct();
		$this->table  = $this->brand;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function index(){
		$sql = 'select * from '.$this->brand;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->brand,$id);
		$this->display('add');
	}
	public function runadd(){
		$type = !empty($_POST['brand_id'])?'update':'add';
		$_POST['brand_logo'] = empty($_FILES['brand_logo']['name'])?$_POST['textfield']:Upload::up('brand_logo');
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->brand,$data);
			$info = '添加';
		}else{
			$r = $this->db->update($this->brand,$data);
			$info = '修改';
		}
		unlink(CACHE.'shop_brand.php');// 删除缓存
		if($r){
			$this->success($info.'成功！',U('/Brand/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();
		$r = $this->db->delete($this->brand,$id);
		if($r){
			$this->success('删除成功！',U('/Brand/index'));
		}
	}
	//列出所属品牌下的商品
	function goods(){
		$id = empty($_GET['id'])?0:$_GET['id']+0;
		$sql = 'select goods_id from '.$this->goods.' where is_delete=0 and brand_id='.$id;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$pagesize='15';
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$sql = 'select goods_id,goods_name,goods_sn,shop_price,is_on_sale,is_best,is_new,is_hot,g.rank,goods_number,typename from '.$this->goods.' as g left join '.$this->category.' as c on g.cat_id=c.id where is_delete=0 and brand_id='.$id.' order by goods_id desc limit '.$page*$pagesize.','.$pagesize;
		$this->list =  $this->db->getAll($sql);
		$this->display('Goods:index');

	}
}
?>