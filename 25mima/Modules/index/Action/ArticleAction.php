<?php
//文章表
Class ArticleAction extends Action{
	public function index(){
		$id =$_GET['a_id'];//得到文章ID
		$sql = 'select * from '.$this->article.' where id='.$id;
		$Unfiltered=array('content');//不过滤键名为这些的html标签
		$this->field = $this->db->getRow($sql,$Unfiltered);
		if(empty($this->field)){
			$this->error('访问出错！');
		}		
		$this->field['postname'] = $this->field['title'];
		$cache_config = $this->shop_config();
		$this->field['title'] = $this->field['title'].'_'.$cache_config['cfg_shop_title'];
		//获取模板名
		$sql = 'select * from '.$this->arttype.' where id='.$this->field['cat_id'];
		$r = $this->db->getRow($sql);
		$site = empty($r['art_site'])?'Article:article':$r['art_site'];
		//得到评论列表
		$sql = 'select c.id,user_name,content,comment_rank,add_time,ding,cai,u.litpic from  '.$this->comment.' as c left join '.$this->user.' as u on c.user_id=u.id where type=1 and goods_id='.$id.' order by id desc';
		$this->comments = $this->db->getAll($sql);
		$this->comments_sum = count($this->comments);
		//只针对美舍
		/*if($this->field['cat_id'] == '12' || $this->field['cat_id'] == '14'){
			$site = 'Article:article2';
		}*/
		
		if(!DEBUG){
			$create = new CreateHtml();
			$create->start();
			$this->display($site);
			$create->end(C('REWRITE_CONTENT').$id);
		}else{
			$this->display($site);
		}
	}
	
	public function zhaopin(){
		$id =$_GET['id'];
		$sql = 'select * from '.$this->article.' where id='.$id.' and cat_id=4';
		$Unfiltered=array('content');//不过滤键名为这些的html标签
		$field = $this->db->getRow($sql,$Unfiltered);
		if($field){
		echo json_encode(array('status'=>1,'title'=>$field['title'],'cont'=>$field['content']));
		}else{
		echo json_encode(array('status'=>0));	
		}
	}
}
?>