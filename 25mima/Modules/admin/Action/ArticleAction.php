<?php
//文章表
Class ArticleAction extends CommonAction{
	//自动填充
	protected $_auto = array(
        array('add_time','function','time'),
	);
	//验证数据安全
	protected $_valid = array(
		array('title',1,'必须有文章名','require'),
		array('cat_id',1,'请选择栏目名','non_zero')
    );
	public function __construct(){
    	parent::__construct();
		$this->table = $this->article;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function data(){
		$sql = 'select id,pid,typename from '.$this->arttype;
		$cate = $field=$this->db->getAll($sql);
		return Category::linearArray($cate);
	}
	public function index(){
		$cid = empty($_GET['id'])?0:$_GET['id']+0;
		$this->cid = $cid;
		$where = '';
		if($cid!=0){
			$list = $this->shop_news_list();
			$list = Category::getChildsId($list,$cid);
			$list[]=$cid;
			$list = implode($list,',');
			$where = ' where cat_id in ('.$list.') ';
		}
		$pagesize = 15;
		$sql = 'select id from '.$this->article.$where;
		$sum = $this->db->getNum($sql);
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();
		$sql = 'select a.id,a.title,a.is_open,a.add_time,FROM_UNIXTIME(a.add_time)  as time,(case a.article_type when 0 then "普通" when 1 then "置顶" when 2 then "特荐" when 3 then "图片" when 4 then "热点" end) as article_type,t.typename from '.$this->article.' as a left join '.$this->arttype.' as t on a.cat_id = t.id '.$where.' order by a.id desc limit '.$page*$pagesize.','.$pagesize;;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->cate = $this->data();
		$this->display();
	}
	public function update(){
		$this->cate = $this->data();
		$id = $this->get_id();
		$Unfiltered=array('content');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->table,$id,$Unfiltered);
		$this->display('add');
	}
	public function runadd(){
		//防止重复提交
		$this->is_submit();
		if(empty($_POST)){$this->error('上传图片类型不正确');}
		$_POST['litpic'] = empty($_FILES['litpic']['name'])?$_POST['textfield']:Upload::up('litpic');
		$type = !empty($_POST['id'])?'update':'add';
		//替换掉标题中的空格
		$_POST['title'] = trim($_POST['title'],'　　');
		$_POST['title'] = trim($_POST['title']);
		$data = $this->verify();
		//如果没有缩略图则在内容里查找第一个图片执行
		/*if(empty($data['litpic'])){
			$pattern = '/img\s+src=\\\[\'\"]([\s\S]*?)\\\[\'\"]/';
			preg_match($pattern,$data['content'],$c);
			if(!empty($c['1'])){
				$data['litpic'] = $c['1'];
			}
		}*/
		//如果没有描述则调用正文前200个字符
		if(empty($data['description']) && !empty($data['content'])){
			$data['description'] = msubstr(_html($data['content']),0,60);
		}
		if($type=='add'){
			$r = $this->db->insert($this->table,$data);
			$info = '添加';
		}else{
			$r = $this->db->update($this->table,$data);
			$info = '修改';
		}
		//unlink(CACHE.'shop_news.php');// 删除缓存
		if($r){
			$this->success($info.'成功！',U('/Article/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();
		$r = $this->db->delete($this->article,$id);
		if($r){
			$this->success('删除成功！',U('/Article/index'));
		}
	}
	
}
?>