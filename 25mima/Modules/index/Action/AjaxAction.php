<?php
class AjaxAction extends Action{
	function __construct(){
		parent::__construct();
		if(!isset($_SESSION[C('APP_USER_NAME').'_userid'])){
			//判断是否通过AJAX访问的
			if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){ 
		    // ajax 请求的处理方式 
				echo '请先登录！';
				die();
			}else{ 
		    // 正常请求的处理方式 
				$this->success('请先登录！');
			};
        }else{
        	//设置用户ID
        	$this->user_id = $_SESSION[C('APP_USER_NAME').'_id']+0;
        }
	}
	//整理数据
	private function data(){
		$data['user_id'] 	= 	$this->user_id;
		$data['goods_id'] 	= 	$_POST['goods_id']+0;
		return $data;
	}
	/*添加到收藏夹*/
	function favorite(){
		$data = $this->data();
		$data['add_time'] = time();
		$sql = 'select id from '.$this->favorite.' where user_id="'.$data['user_id'].'" and goods_id="'.$data['goods_id'].'"';
		$r = $this->db->getNum($sql);
		if($r){
			echo '您已收藏过了！';
		}else{
			$r = $this->db->insert($this->favorite,$data);
			if($r){
				echo '成功收藏！';
			}else{
				echo '收藏失败！';
			}
		}
	}
	/*商品页评论投票*/
	function vote(){
		$data['comment_id'] = $_POST['comment_id'];
		$data['user_id'] = $this->user_id;
		$sql = 'select id from '.$this->comment_list.' where comment_id='.$data['comment_id'].' and user_id='.$data['user_id'];
		if(!$this->db->getNum($sql)){
			$this->db->insert($this->comment_list,$data);
			$sql = 'update '.$this->comment.' set '.$_POST['type'].'='.$_POST['type'].'+1 where id='.$data['comment_id'];
			$this->db->query($sql);
			echo 'true';
		}
	}
	//添加到购物车
	public function addRow(){
		$_POST['user_id'] = $this->user_id;
		$data = $_POST;
		if(!empty($data['attr_value'])){
			$data['attr_value'] = implode(',',$data['attr_value']);
		}else{
			$data['attr_value'] = '';
		}
		$sql = 'select id from '.$this->shopping." where indent_id=0 and goods_id=$data[goods_id] and user_id=$data[user_id] and attr_value='$data[attr_value]'";
		if($id = $this->db->getRow($sql)){
			$sql = 'update '.$this->shopping.' set number=number+'.$data['number'].' where id='.$id['id'];
			$r = $this->db->query($sql);
		}else{
			$r = $this->db->insert($this->shopping,$data);
		}
		$this->setShoppingNumber($this->user_id);
		if($r){
			echo true;
			//$this->success('加入购物车成功！');
		}
	}
}
?>