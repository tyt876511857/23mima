<?php
class JingxiaoshangAction extends CommonAction{
    public function __construct(){
    	parent::__construct();
    	$this->table = $this->user;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function index(){
		$pagesize='15';
		$sql = 'select id from '.$this->table.' where leixing = 1';
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$sql = 'select *,(case logintype when 0 then "网站" when "1" then "qq" when "2" then "微信" when "3" then "新浪" when "4" then "豆瓣" end) as qudao from '.$this->table.' where leixing = 1 order by logintime desc limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function delete(){
		$id = $this->get_id();
		$this->db->delete($this->table,$id);
		$this->success('删除成功！');
	}
	//添加经销商
	public function adduser(){

		if(!$_POST){
			
				$this->display();
	
		}else{
			
			if($_POST['pwd']!=$_POST['pwd2']){
				$this->error('两次密码不一致！');exit;
			}
			$sql = 'select id from '.$this->user.' where username = "'.$_POST['username'].'"';
			$id = $this->db->getRow($sql);
			if(!empty($id)){
				$this->error('用户名已存在！');exit;
			}
			$pwd=md5($_POST['pwd']);
			$this->db->query(' insert into '.$this->user.' (leixing,username,pwd,qq,email,name) values(1,"'.$_POST['username'].'","'.$pwd.'","'.$_POST['qq'].'","'.$_POST['email'].'","'.$_POST['name'].'")');			
			//exit;
			$this->success('添加成功！',U('/Jingxiaoshang/index'));
			
		}

	}
	//添加优惠码
	public function addcard(){
		
		if(!$_POST){
			$this->cards=array();
			$this->userid = $_GET['userid'];
			$sql = 'select username from '.$this->user.' where id = '.$_GET['userid'];
			$username = $this->db->getRow($sql);
			$this->username = $username['username'];
			
			$sql = 'select * from gs_cards where state=1 and userid = '.$_GET['userid'];
			$this->lists = $this->db->getAll($sql);
			if(isset($_GET['id'])){ //修改
			//print_r(111);exit;
				$sql = 'select * from gs_cards where id = '.$_GET['id'];
				$this->cards = $this->db->getRow($sql);			
			}
			
			$this->display();
	
		}else{
			if($_POST['id']){ //修改
				$tm=time();
				$sql = 'select id from gs_cards where id = '.$_POST['id'];
				$id = $this->db->getRow($sql);
				if(empty($id)){
					$this->error('优惠码不存在！');exit;
				}		
				$this->db->query(' update gs_cards set addtime='.$tm.' ,jiage='.$_POST['jiage'].' where id= '.$_POST['id']);			
				//exit;
				$this->success('成功！','/admin/Jingxiaoshang/addcard?userid='.$_POST['userid']);
				
			}else{
				$tm=time();
				$sql = 'select id from gs_cards where card = "'.$_POST['card'].'"';
				$id = $this->db->getRow($sql);
				if(!empty($id)){
					$this->error('优惠码已存在！');exit;
				}		
				$this->db->query(' insert into gs_cards (addtime,card,jiage,userid) values ('.$tm.',"'.$_POST['card'].'",'.$_POST['jiage'].','.$_POST['userid'].')');			
				//exit;
				$this->success('添加成功！','/admin/Jingxiaoshang/addcard?userid='.$_POST['userid']);
			}
		}		
	}
	//添加优惠码
	public function delcard(){

		$this->db->query('update gs_cards set state = 0 where id ='.$_GET['id'].'');
		$this->success('删除成功！','/admin/Jingxiaoshang/addcard?userid='.$_GET['userid']);
		
	}
}
?>