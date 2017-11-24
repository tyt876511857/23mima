<?php
class SystemAction extends CommonAction{
	//整理行语句
	public function layout($v){
		if($v['type']=='string'){
			return "<input type='text' name='$v[varname]' value=\"".htmlspecialchars($v['value'])."\" size='40' >";
		}else if($v['type']=='bstring'){
			return "<textarea name='$v[varname]' row='5' cols='40' >".htmlspecialchars($v['value'])."</textarea>";
		}else if($v['type']=='number'){
			return  "<input type='text' name='$v[varname]' id='$v[varname]' value='$v[value]' style='width:30%'>";
		}
	}
	public function index(){
		$sql = 'select * from '.$this->sysconfig;
		$query = $this->db->getAll($sql);
		foreach($query as $v){
			if($v['groupid']==1){
				$sys1[]=array('name'=>$v['varname'],'info'=>$v['info'],'str'=>$this->layout($v));
			}
		}
		$this->sys1 = $sys1;
		//$this->sys2 = $sys2;
		$this->display();
	}
	public function runsys(){
		$sql = "UPDATE $this->sysconfig set `value` = (case varname ";
		foreach($_POST as $k=>$v){
			$sql .= "WHEN '$k' THEN '$v' ";
		}
		$sql .= 'END)';
		$this->db->query($sql);
		unlink(CACHE.'shop_config.php');
		$this->success('修改成功！',U('/System/index'));
	}
}
?>