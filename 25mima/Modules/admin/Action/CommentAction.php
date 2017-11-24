<?php
//评论类
Class CommentAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
		$this->table = $this->comment;
		//$this->fields = $this->db->desc_field($this->table);
	}
	function index(){
		$pagesize = 15;							//每页显示多少条
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		if(empty($_GET['type'])){//没有type就调用goods
			$sql = 'select id from '.$this->table.' where type=0';
			$sql1 = 'select c.*,g.goods_name from '.$this->table.' as c left join '.$this->goods.' as g on c.goods_id=g.goods_id where c.type=0 order by c.id desc limit '.$page*$pagesize.','.$pagesize;
			$type = 'goods';
		}else{
			$sql = 'select id from '.$this->table.' where type=1';
			$sql1 = 'select c.*,n.title as goods_name from '.$this->table.' as c left join '.$this->article.' as n on c.goods_id=n.id where c.type=1 order by c.id desc limit '.$page*$pagesize.','.$pagesize;
			$type = 'news';
		}
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$this->list = $this->db->getAll($sql1);
		$this->display();
	}
	function delete(){
		$id = $this->get_id();
		$sql= 'delete t,c from '.$this->table.' as t left join '.$this->comment_list.' as c on t.id=c.comment_id where t.id='.$id;
		$r = $this->db->query($sql);
		if($r){
			$this->success('删除成功！');
		}
	}
	
}
?>