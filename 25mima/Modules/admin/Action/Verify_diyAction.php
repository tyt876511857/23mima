<?php
class Verify_diyAction extends CommonAction{
	public function index(){
		$sql = 'select id,verify from '.$this->verify;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function runAdd(){
		$r = $this->db->insert($this->verify,$_POST);
		$info = '添加';
		if($r){
			$this->success($info.'成功！',U('/Verify_diy/index'));
		}
	}
	public function delete(){
		$id = $this->get_id();
		$r = $this->db->delete($this->verify,$id);
		$r?redirect():$this->error('删除失败');
	}
}
?>