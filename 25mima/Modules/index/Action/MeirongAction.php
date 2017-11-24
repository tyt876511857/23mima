<?php
class MeirongAction extends Action{
	
	function baogaolist($id,$true = false){
		
		$sql = 'select * from '.$this->bg_tuoye.' where id='.$id;
		$r = $this->db->getRow($sql);
		//print_r(11);exit;
		if(empty($r)){
			$this->error('数据出错！');
		}else{
			$sql = 'select * from '.$this->bg_baogao.' where title="'.$r['identifier'].'"';
			$r1 = $this->db->getRow($sql);
			//计算性别
			if($r['rcvSex']==1){
				$r['sex']= '男';
			}else{
				$r['sex']= '女';
			}
			//计算年龄
			$birthday = date('Y-m-d',$r['birthtime']);
			$age = strtotime($birthday);  
			if($age === false){   return false;}
			list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age));  
			$now = strtotime("now");  
			list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now));
			$age = $y2 - $y1;  
			if((int)($m2.$d2) < (int)($m1.$d1)){
				$age -= 1;
				$new_age = $m2+12-$m1;
			}else{
				$new_age = $m2-$m1;
			}
			$r['age']=$age+($new_age/12);
			$age .= '岁'.$new_age.'个月';
			$r['birthtime']= $age;

			$r1['tuoye'] = $r;
			return $r1;
		}
	}
	function baogao(){
		$array = array('3'=>'一般','良好','优秀');
		//报告数据
		$id = $_GET['id'] = empty($_GET['id'])?1:$_GET['id']+0;
		$field = $this->baogaolist($id);
		$field['content'] = explode(',',$field['content']);
		$field['content1'] = array();
		foreach($field['content'] as $v){
			$v = explode('=',$v);
			$field['content1'][$v[0]] = $v[2];
		}
		//特长
		$sql = 'select * from '.$this->bg_zheye.' where cid='.$field['cid'];
		$zheye = $this->db->getAll($sql);

		$new_zheye = array();
		foreach($zheye as $k => $v){
			$zheye[$k]['fenshu'] = 0;
			$v['title'] = explode(',',$v['title']);
			$v['value'] = explode(',',$v['value']);
			foreach($v['title'] as $l => $j){
				if(!empty($field['content1'][$j])){
					$zheye[$k]['fenshu'] += $field['content1'][$j] * $v['value'][$l] /100;
				}
			}
			if($zheye[$k]['fenshu']>93){
				$zheye[$k]['fenshu1'] = 5;
			}elseif($zheye[$k]['fenshu']>86){
				$zheye[$k]['fenshu1'] = 4;
			}else{
				$zheye[$k]['fenshu1'] = 3;
			}
			//$zheye[$k]['fenshu1'] = floor($zheye[$k]['fenshu'] / 20);
			@$zheye[$k]['pingjia'] = $array[$zheye[$k]['fenshu1']];
			//以分数为键值
			$new_zheye[$zheye[$k]['fenshu1']][] = $zheye[$k];
		}
		krsort($new_zheye);
	print_r($new_zheye);exit;
		$this->zheye = $new_zheye;
		$this->field = $field;
		//获取报告所属产品
		$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
		$this->field1 = $this->db->getRow($sql);
			
		
		$this->display2('baogao4',$id);
		
	}
	
	

}
?>