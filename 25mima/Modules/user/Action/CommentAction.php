<?php
Class CommentAction extends CommonAction{
	// 自动填充
	protected $_auto = array(
                            array('add_time','value',TIME),
                            array('ip','value',CLIENT_IP),
                            array('ding','value','0'),
                            array('cai','value','0')
    );
	//验证数据安全
	protected $_valid = array(
                            array('goods_id',1,'必须有商品ID','require'),
                            array('type',0,'只能是0或1','in','0,1'),
                            array('content',1,'必须有评论内容','require'),
                            array('comment_rank',0,'只能是1到5','in','1,2,3,4,5')         
    );
    public function __construct(){
    	parent::__construct();
		$this->table = $this->comment;
		$this->fields = $this->db->desc_field($this->table);
	}
	function add(){
		$data = $this->verify();
		$data['user_id']=$this->user_id;
		$data['user_name']=$this->user_name;
		$sql = 'select id from '.$this->comment.' where user_id='.$data['user_id'].' and goods_id='.$data['goods_id'].' and add_time>'.($data['add_time']-300);
		if($this->db->getNum($sql)){
			$this->error('请不要频繁评论！');
		}
		$r = $this->db->insert($this->comment,$data);
		//是否开启星级级别
		if($data['type'] == 0 && file_exists(ROOT.'html/goods_'.$data['goods_id'].'.html')){
			unlink(ROOT.'html/goods_'.$data['goods_id'].'.html');// 删除商品页缓存
		}
		if($data['type'] == 1 && file_exists(ROOT.'html/category_'.$data['goods_id'].'.html')){
			unlink(ROOT.'html/category_'.$data['goods_id'].'.html');// 删除商品页缓存
		}
		if(STARS && $data['type'] == 0 && file_exists(CACHE.'shop_stars.php')){
			unlink(CACHE.'shop_stars.php');// 删除缓存
		}
		if($r){
			$this->success('感谢您的评论！');
		}
	}
}
?>