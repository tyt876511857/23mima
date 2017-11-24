<?php
Class AlipayAction extends Action{
	function index(){
		!empty($_GET['id']) or die();
		$sql = 'select * from '.$this->indent.' where indent='.$_GET['id'];
		$this->data = $this->db->getRow($sql);
		$_SESSION['WIDout_trade_no'] = $this->data['indent'];
		$_SESSION['WIDprice'] = $this->data['price'];

		if(!empty($_SESSION['weixin'])){
			$this->success('确认支付'.$_SESSION['WIDprice'],'http://23mima.com/data/WxpayAPI/example/jsapi.php');
		}else{
			$this->display();
		}
	}
	// 判断是否已支付
	function zhifu(){
		$id = $_POST['indent'];
		$sql = 'select type from '.$this->indent.' where indent='.$id;
		$r = $this->db->getRow($sql);
		echo $r['type'];
	}
	
	function zhifusuccess(){
		$this->success('支付成功',U('Index/index'));
	}
}
?>