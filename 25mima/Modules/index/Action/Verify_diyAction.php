<?php

Class verify_diyAction extends Action{
	public function index(){
		$this->display();
	}
	public function index1(){
		$this->title = '会员验证';
		$this->color = '#39a269';
		$this->str   = '请在下面的方框内输入您的会员号';
		$this->display('Verify_diy:index1');
	}
	public function index2(){
		$this->title = '资质验证';
		$this->color = '#ffb83c';
		$this->str   = '请在下面的方框内输入资质证书号';
		$this->display('Verify_diy:index1');
	}
	public function index3(){
		$this->title = '代理验证';
		$this->color = '#694179';
		$this->str   = '请在下面的方框内输入资质证书号';
		$this->display('Verify_diy:index1');
	}
	public function running(){
		$str = $_POST['str'];
		$captcha = $_POST['yzm'];
		if(!verify($captcha)){
			$this->error('验证码错误！');
			return false;
		}

		$sql ='select * from '.$this->verify . ' where verify="'.$str.'"';
		$r = $this->db->query($sql);
		if(!mysql_num_rows($r)){
			$this->error('查询号错误！');
			return false;
		}
		//echo U('/Verify/index');
		$this->success('这是正品！',U('/Verify_diy/index'));
	}

}
?>