<?php
//文章栏目表
class NewsAction extends CommonAction{
	//验证数据安全
	protected $_valid = array(
		array('typename',1,'必须有类型名','require')
    );
    public function __construct(){
    	parent::__construct();
		$this->table = $this->arttype;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function data(){
		$sql = 'select id,pid,typename from '.$this->arttype;
		return $field=$this->db->getAll($sql);
	}
	public function index(){
		$id = empty($_GET['id'])?0:$_GET['id']+0;
		$sql = 'select id,typename,rank,pid,description from '.$this->arttype.' order by rank';
		$list=$this->db->getAll($sql);
		$this->list =Category::multidimensional($list,'child',$id);
		$this->display();
	}
	public function add(){
		$cate = $this->data();
		$this->cate =Category::linearArray($cate);
		$this->display();
	}
	public function update(){
		$cate = $this->data();
		$this->cate =Category::linearArray($cate);
		$id = $this->get_id();
		$Unfiltered=array('content','content1');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->table,$id,$Unfiltered);
		$this->display('add');
	}
	public function runadd(){
		$type = !empty($_POST['id'])?'update':'add';
		$_POST['litpic'] = empty($_FILES['litpic']['name'])?$_POST['textfield']:Upload::up('litpic');
		$data = $this->verify();
		if($type=='add'){
			$r = $this->db->insert($this->arttype,$data);
			$info = '添加';
		}else{
			$cache_shop_news_list = $this->shop_news_list();
			$id_all = Category::getChildsId($cache_shop_news_list,$_POST['id']);
			$id_all[] = $_POST['id'];
			if(in_array($_POST['pid'],$id_all)){
				$this->error('父栏目不可以为自身或者其子栏目！');
			}
			$r = $this->db->update($this->arttype,$data);
			$info = '修改';
		}
		unlink(CACHE.'shop_news_list.php');// 删除缓存
		if($r){
			$this->success($info.'成功！',U('/News/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();

		$cate = $this->data();
		$child = Category::getChildsId($cate,$id);
		$child[] = $id;
		$str = implode(',',$child);
		$r = $this->db->delete($this->arttype,$str);
		if($r){
			$this->success('删除成功！',U('/News/index'));
		}
	}
}
?>