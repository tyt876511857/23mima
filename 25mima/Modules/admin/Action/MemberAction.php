<?php
class MemberAction extends CommonAction{
    public function __construct(){
    	parent::__construct();
    	$this->table = $this->user;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function index(){
		$pagesize='15';
		$sql = 'select id from '.$this->table;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用
		$sql = 'select *,(case logintype when 0 then "网站" when "1" then "qq" when "2" then "微信" when "3" then "新浪" when "4" then "豆瓣" end) as qudao from '.$this->table.' order by logintime desc limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function delete(){
		$id = $this->get_id();
		$this->db->delete($this->table,$id);
		$this->success('删除成功！');
	}

	/**
	 * ajax获取用户列表解析
	 */
	public function getUserList() {
		$pagesize='15';
		$htmlstr = '';
		$username = $_POST['keyword'];
		if (!empty($username)) {
			$whereArr[] = 'username like \'%'.$this->db->escape_str($username).'%\'';
		}
		$curpage = intval($_POST['page']);
		$countsql = 'select id from '.$this->table;
		$sql = 'select * from '.$this->table;
		if (!empty($whereArr)) {
			$countsql.= ' WHERE '.implode(' AND ',$whereArr);
			$sql.= ' WHERE '.implode(' AND ',$whereArr);
		}

		$page = empty($curpage)?0:$curpage-1;	//当前页码-1
		$sum = $this->db->getNum($countsql);
		if (empty($sum)) {
			echo '<tr><td colspan="4"><font color="red">未找到符合条件的用户！</font></td></tr>';exit;
		}

		$pagestr = Page::show_page_ajax($sum, $pagesize);
		$sql .= ' order by logintime desc limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		foreach($this->list as $value)
		{
			$htmlstr .= '<tr style="cursor:pointer" onclick="checkCrItem(\'' . $value['id'] . '\', \'' . $value['username'] . '\')"><td><input type="radio" name="crid" id="crid_' . $value['id'] . '" value="' . $value['id'] . '" onclick="checkCrItem(\'' . $value['id'] . '\', \'' . $value['username'] . '\')" /></td><td>' . $value['name'] . '</td><td>' . $value['username'] . '</td><td>' . date("Y-m-d", $value['register']) . '</td></tr>';
		}
		$htmlstr .= '<tr><td colspan="4">'. $pagestr . '</td></tr>';
		echo $htmlstr;exit;
	}
}
?>