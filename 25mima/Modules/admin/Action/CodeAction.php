<?php
class CodeAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
    	$this->chanpin = $this->bg_chanpin;//基因表
    	/*$this->property = $this->bg_property;//属性表
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
		$sql = 'select id from gs_code';
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();
		$sql = 'select b.*,c.name from gs_code as b left join '.$this->chanpin.' as c on b.cid=c.id order by createtime desc  limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$sql = 'select id,name from '.$this->chanpin;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function post_add(){
		if($_POST){
			$dh=$_POST['dh'];	
			$num=intval($_POST['num']);
			$cid=$_POST['cid'];
			if (!$num) {
				echo 'not num';exit;
			}
			//没有dh，随机生成，7位数和代码
			if (empty($dh) || $dh=='NUM') {
				$allNum = $dh=='NUM'?1:0;
				$cid = 0;//这个不属于产品系列
				$codearr=$this->createCodeRandom($allNum,$num);
			} else if(preg_match("/([\x81-\xfe][\x40-\xfe])/", $dh, $match)) {
				echo "faild";exit;
			} else {
				$codearr=$this->createCode($dh,$num);
			}
			if (empty($codearr)) {
				echo '';exit;
			}
			foreach($codearr as $k=>$v){
				$codearr[$k]="('".$v."',".$cid.",0,'".date('Y-m-d H:i:s')."')";
			}
			$codearr=join(',',$codearr);
			
			$sql='INSERT INTO gs_code(code,cid,status,createtime) VALUE'.$codearr;
			
			$rest=$this->db->query($sql);
			if($rest){
				echo json_encode(array('status'=>1,'info'=>'生成成功'));
				exit;
			}else{
				echo json_encode(array('status'=>1,'info'=>'生成失败'));
				exit;
			}
		}else{
			echo json_encode(array('status'=>-1,'info'=>'操作失败'));
				exit;
		}
	}
	
	function createCode($dh,$num){
		for($i=0;$i<$num;$i++){
			$code1=$this->getRandChar(4);
			$code2=$this->getRandChar(4);
			
			$str=$dh.'-'.$code1.'-'.$code2;
			$str=$this->check($str,$dh);
			$arr[]=$str;
			
		}
		return $arr;
	}

	function createCodeRandom($allNum,$num){
		for($i=0;$i<$num;$i++){
			$str=$this->getUnicardNumber($allNum);
			$str=$this->checkAOther($str,$allNum);
			$arr[]=$str;
			
		}
		return $arr;
	}
	/**
	 *获取唯一的年卡序列号
	 *激活码为:123456789012 一共12位激活码不允许重复
	 *激活码去除易混淆的字符,如: 1,l,L,0 ,Oo剔除
	 */
	public function getUnicardNumber($allNum=0) {
		$pattern = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';
	    $cardpass = '';
	    if (!$allNum) {
	    	for ($i = 0; $i < 7; $i++) {
		        $cardpass .= $pattern{mt_rand(0, 30)};
		    }
		    if (preg_match('/.*\d.*[a-zA-Z]|.*[a-z][A-Z].*\d/',$cardpass)) {
		    	return $cardpass;
		    } else {
		    	$cardpass = $this->getUnicardNumber($allNum);
		    	return $cardpass;
		    }
	    } else {//全数字
	    	for ($i = 0; $i < 7; $i++) {
		        $cardpass .= $pattern{mt_rand(0, 7)};
		    }
	    }
	    return $cardpass;
	}
	
	function check($str,$dh='T'){
		$sql='select * from gs_code where code="'.$str.'"';
			$rest=$this->db->getNum($sql);
			if($rest){
				$code1=$this->getRandChar(4);
				$code2=$this->getRandChar(4);
				$str=$dh.'-'.$code1.'-'.$code2;
			    $sql='select * from gs_code where code="'.$str.'"'; 
			    while($this->db->getNum($sql)) {
			    	$code1=$this->getRandChar(4);
					$code2=$this->getRandChar(4);
					$str=$dh.'-'.$code1.'-'.$code2;
			    	$sql = 'select * from gs_code where code="'.$str.'"'; 
			    }
			    return $str;
			}else{
				return $str;
			}	
	}

	function checkAOther($str,$allNum){
		$sql='select * from gs_code where code="'.$str.'"';
			$rest=$this->db->getNum($sql);
			if($rest){//存在的情况
			    $str = $this->getUnicardNumber($allNum);
			    $sql='select * from gs_code where code="'.$str.'"'; 
			    while($this->db->getNum($sql)) {
			    	$str = $this->getUnicardNumber($allNum);
			    	$sql = 'select * from gs_code where code="'.$str.'"'; 
			    }
			    return $str;
			}else{
				return $str;
			}	
	}
	
	function getRandChar($length){
	   $str = null;
	   $strPol = "ABCDEFGHJKLMNPRSTUVWXYZ23456789";
	   $max = strlen($strPol)-1;

	   for($i=0;$i<$length;$i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	   }

	   return $str;
	 }
	 
	 public function download_code(){
		$sql = 'select * from gs_code where status=0 order by id desc ';
		$list= $this->db->getAll($sql);
		if(count($list)){
			header("Content-type:application/vnd.ms-excel;charset=utf-8"); 
			header("Content-Disposition:filename=编码表".date('Ymd').".xls"); 
			
			
			foreach($list as $v){
				echo $v['code']."\t\n"; 
			}
			$sql='UPDATE gs_code SET status=1 WHERE status=0';
			$rest=$this->db->query($sql);
		}else{
			echo '已经全部下载！';
			echo '<a href="'.U('/Code/index').'">返回</a>';
			exit;
		}
	}
}
?>