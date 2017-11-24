<?php
class CodeAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
    	/*$this->chanpin = $this->bg_chanpin;//基因表
    	$this->property = $this->bg_property;//属性表
    	$this->fenshu = $this->bg_fenshu;//基因值
    	$this->zheye = $this->bg_zheye;//
    	$this->baogao = $this->bg_baogao;//
    	$this->tuoye = $this->bg_tuoye;//
    	$this->banding = $this->bg_tuoye_changpin;*/
		
	}
	//获取所有基因产品
	
	public function index(){
		$pagesize='100';
		
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();
		$sql = 'select * from gs_code order by createtime desc  limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	
	public function add(){
		$codearr=$this->createCode('TC',10);
		foreach($codearr as $k=>$v){
			$codearr[$k]="('".$v."',0,".date('Y-m-d H:i:s').")";
		}
		$codearr=join(',',$codearr);
		
		$sql='INSERT INTO gs_code(code,status,createtime) VALUE'.$codearr;
		
		$rest=$this->db->query($sql);
		if($rest){
			echo json_encode(array('status'=>1,'info'=>'生成成功'));
			exit;
		}else{
			echo json_encode(array('status'=>1,'info'=>'生成失败'));
			exit;
		}
	}
	
	function createCode($dh,$num){
		for($i=0;$i<$num;$i++){
			$code1=$this->getRandChar(4);
			$code2=$this->getRandChar(4);
			$code3=$this->getRandChar(4);
			$str=$dh.'-'.$code1.'-'.$code2.'-'.$code3;
			$str=$this->check($str);
			$arr[]=$str;
			
		}
		return $arr;
	}
	
	function check($str){
		$sql='select* from gs_code where code="'.$str.'"';
			$rest=$this->db->query($sql);
			if(!$res){
			
			return $str;
			}else{
				$this->check($str);
			}
		
	}
	
	function getRandChar($length){
	   $str = null;
	   $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	   $max = strlen($strPol)-1;

	   for($i=0;$i<$length;$i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	   }

	   return $str;
	 }
}
?>