<?php
Class RBAC extends Action{
	public function purviews(){
		$str = $GLOBALS['path_info'][1].$GLOBALS['path_info'][2];
		$str = str_replace('Action','_',$str);
		/*$sql = 'select name from '.$this->purviews.' where id>10';
		$r = $this->db->getAll($sql);
		foreach($r as $v){
			$array[] = $v['name'];
		}*/
		//管理员ID
		/*$admin_id = $_SESSION[$GLOBALS['path_info']['0'].'_id'];
		$sql = 'select t.purviews from '.$this->admin .' as a left join '.$this->admintype .' as t on a.usertype=t.id where a.id='.$admin_id;
		$r = $this->db->getRow($sql);
		$r = explode(',',$r['purviews']);*/
		if(in_array($str,$_SESSION['rbac']) && !in_array($str,$_SESSION['rbac1']) && !in_array('admin_all',$_SESSION['rbac1']) ){
			$this->error('权限不够！不可以访问');
		}
	}
}
?>