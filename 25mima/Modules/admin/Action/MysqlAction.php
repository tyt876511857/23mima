<?php
Class MysqlAction extends CommonAction{
	//验证数据安全
	function add(){
		$this->display();
	}
	function runadd(){
		$_POST['sql'] = stripcslashes($_POST['sql']);
		if($_POST['str'] == '0411'){
			$r = $this->db->query($_POST['sql']) or die(mysql_error());
			if(is_resource($r)){
				$r=$this->db->getAll($_POST['sql']);
				p($r);
			}else{
				$this->success('操作成功！');
			}			
		}else{
			$this->error('密码不正确！');
		}
	}
}
?>