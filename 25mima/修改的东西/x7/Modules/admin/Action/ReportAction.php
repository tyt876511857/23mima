<?php
class ReportAction extends CommonAction{
	public function __construct(){
    	parent::__construct();
    	$this->chanpin = $this->bg_chanpin;//基因表
    	$this->property = $this->bg_property;//属性表
    	$this->fenshu = $this->bg_fenshu;//基因值
    	$this->zheye = $this->bg_zheye;//
    	$this->baogao = $this->bg_baogao;//
    	$this->tuoye = $this->bg_tuoye;//
    	$this->banding = $this->bg_tuoye_changpin;
	}

	/**
	 *所有的报告特长统计归于0 UPDATE gs_bg_baogao SET seg =  0;
	 */
	public function intSetCount() {
		$intSql = 'UPDATE gs_bg_zheye SET common =  0;';
		$this->db->query($intSql);
		$this->db->query('UPDATE gs_bg_zheye SET excellent =  0;');
		$this->db->query('UPDATE gs_bg_zheye SET totalscore =  0;');
		$this->db->query('UPDATE gs_bg_baogao SET seg =  0;');
		$this->db->query('UPDATE gs_fit_count SET high =  0;');
		$this->db->query('UPDATE gs_fit_count SET common =  0;');
		$res = $this->db->query('UPDATE gs_bg_zheye SET good =  0;');
		echo empty($res)?'执行失败':'执行成功';
	}

	/**
	 *每次导入报告后，执行更新总的特长各个段位的人数
	 */
	function countZheyeLevel() {
		$param['seg'] = 0;//已完成报告统计的为1,0是未完成，如果是全部可以不传
		$param['cid'] = '2,3,4,5';//基因的产品类型
		$param['pagesize'] = 10;//每次执行多少条
		
		if (isset($param['seg'])) {
			$whereArr[] = 'seg = '.$param['seg'];
		}
		if (isset($param['cid'])) {
			$whereArr[] = 'cid in ('.$param['cid'].')';
		}
		$sql = 'select * from '.$this->baogao;
		$countsql = 'select id from '.$this->baogao;
		if (!empty($whereArr)) {
			$countsql.= ' WHERE '.implode(' AND ',$whereArr);
			$sql.= ' WHERE '.implode(' AND ',$whereArr);
		}
		$sum = $this->db->getNum($countsql);
		if (empty($sum)) {
			echo "<script>alert('已经统计完毕');history.go(-1);</script>";exit;
		}
		$totalPage = $sum/$param['pagesize'];

		//特长
		if (isset($param['cid'])) {
			$zheyeSql = 'select * from '.$this->bg_zheye.' where cid in('.$param['cid'].')';
		} else {
			$zheyeSql = 'select * from '.$this->bg_zheye;
		}
		$zheye = $this->db->getAll($zheyeSql);
		$updateArr = array();
		$fitArr = array();
		//原始统计人数获取
		if (!empty($zheye)) {
			foreach ($zheye as $value) {
				$updateArr[$value['id']]['common'] = $value['common'];
				$updateArr[$value['id']]['good'] = $value['good'];
				$updateArr[$value['id']]['excellent'] = $value['excellent'];
				$updateArr[$value['id']]['totalscore'] = $value['totalscore'];
			}
		}
		for ($i=0; $i < $totalPage; $i++) {
			$listSql = $sql.' limit '.$i*$param['pagesize'].','.$param['pagesize'];
			$baogoList = $this->db->getAll($listSql);
			$updateArr = $this->doUpdateState($baogoList,$zheye,$updateArr,$fitArr);//循环去统计人数，更新比例
		}
		//print_r($fitArr);exit;
		$cid = isset($param['cid'])? $param['cid'] :'';
		$res = $this->doUpdateTeChang($updateArr,$cid,$fitArr);//循环完了更新特长的字段; 
		echo empty($res)?"<script>alert('执行失败');history.go(-1);</script>":"<script>alert('执行成功');history.go(-1);</script>";
	}

	/**
 	 *获取报告列表后，循环更新特长的基因
	 */
	public function doUpdateState($list=array(),$zheye=array(),&$score,&$fitArr=array()) {
		$field = array();//列表暂存数组
		if (empty($list) || empty($zheye)) {
			return '';
		}
		$fx = 1;
		$highCount = 0;
		$commonCount = 0;
		foreach ($list as $key => $value) {
			if ($value['cid'] == 4) {//肥胖基因统计另一种算法
				$value['content'] = explode(',',$value['content']);
				foreach($value['content'] as $c){
					$c = explode('=',$c);
					$fit[$c[0]] = array('jy'=>$c[1],'fs'=>($c[2]/100));
				}
				foreach($zheye as $k=>$v) {
					if($v['name']=='肥胖基因') {
						$fits[]=$v;
					}
				}
				foreach($fits as $k=>$v){
					if (!isset($fit[$v['title']])) {
						$fx=$fx*1;
					} else {
						$fx=$fx*$fit[$v['title']]['fs'];
					}
				}
				if ($fx>1) {
					if (isset($fitArr['highCount'])) {
						$fitArr['highCount'] += 1;
					} else {
						$fitArr['highCount'] = 1;
					}
				} else {
					if (isset($fitArr['commonCount'])) {
						$fitArr['commonCount'] += 1;
					} else {
						$fitArr['commonCount'] = 1;
					}
				}
			} else {//其他基因还是按他之前的套路
				$field[$key]['cid'] = $value['cid'];
				$content = explode(',',$value['content']);
				foreach($content as $v){
					$v = explode('=',$v);
					$field[$key]['content'][$v[0]] = $v[2];
				}
			}
		}
		if (empty($field)) {
			return '';
		} else {
			foreach ($field as $fkey => $fvalue) {
				foreach($zheye as $k => $v) {
					$score[$v['id']]['fenshu'] = 0;//报告的特长分数
					$v['title'] = explode(',',$v['title']);
					$v['value'] = explode(',',$v['value']);
					foreach($v['title'] as $l => $j) {
						if(!empty($fvalue['content'][$j]) && $fvalue['cid'] == $v['cid']) {
							$score[$v['id']]['fenshu'] += $fvalue['content'][$j] * $v['value'][$l] / 100;
						}
					}
					//统计分数
					if (!empty($score[$v['id']]['fenshu'])) {
						$score[$v['id']]['totalscore'] += $score[$v['id']]['fenshu'];
						if($score[$v['id']]['fenshu'] >93){
							if (empty($score[$v['id']]['excellent'])) {
								$score[$v['id']]['excellent'] = 1;
							} else {
								$score[$v['id']]['excellent'] += 1;
							}
						}elseif($score[$v['id']]['fenshu']>86){
							if (empty($score[$v['id']]['good'])) {
								$score[$v['id']]['good'] = 1;
							} else {
								$score[$v['id']]['good'] += 1;
							}
						}else{
							if (empty($score[$v['id']]['common'])) {
								$score[$v['id']]['common'] = 1;
							} else {
								$score[$v['id']]['common'] += 1;
							}
						}
					}
				}
			}
			return $score;
		}
	}

	/**
	 *批量更新特长表的字段
	 */
	public function doUpdateTeChang($updateArr=array(),$cid=0,$fitArr) {
		if (empty($updateArr) && empty($fitArr)) {
			return '';
		}
		if (!empty($updateArr)) {
			$ids = implode(',', array_keys($updateArr));
			$sql = '';
			$commonSet = "UPDATE $this->bg_zheye SET common = CASE id ";
			$goodSet = " good = CASE id ";
			$excellentSet = " excellent = CASE id ";
			$totalscoreSet = " totalscore = CASE id ";
			foreach ($updateArr as $id => $ordinal) {
			    $commonSet .= sprintf("WHEN %d THEN %d ", $id, $ordinal['common']);
			    $goodSet .= sprintf("WHEN %d THEN %d ", $id, $ordinal['good']);
			    $excellentSet .= sprintf("WHEN %d THEN %d ", $id, $ordinal['excellent']);
			    $totalscoreSet .= sprintf("WHEN %d THEN %d ", $id, $ordinal['totalscore']);
			}
			$sql .= $commonSet.' END, '. $goodSet.' END, '.$excellentSet.' END, '.$totalscoreSet;
			$sql .= "END WHERE id IN ($ids)";
			$res = $this->db->query($sql);
			
		}

		if (!empty($fitArr)) {
			$fitArr['high'] = empty($fitArr['highCount'])?0:intval($fitArr['highCount']);
			$fitArr['common'] = empty($fitArr['commonCount'])?0:intval($fitArr['commonCount']);
			$fitInfo = $this->db->getRow('select * from '.$this->fit_count);
			if (empty($fitInfo)) {//不存在就插入一条数据
				$insertsql = 'insert into '.$this->fit_count.'  (high,common) VALUES('.$fitArr['high'].','.$fitArr['common'].'); ';
				$res = $this->db->query($insertsql);
			} else {
				$updatesql = ' update '.$this->fit_count.' set high=high+'.$fitArr['high'].' ,'.' common=common+'.$fitArr['common'];
				$res = $this->db->query($updatesql);
			}
		}

		if (!empty($res)) {
			if ($cid) {
				$baogaoSql = 'UPDATE gs_bg_baogao SET seg =  1 where seg=0 and cid in ('.$cid.');';
			} else {
				$baogaoSql = 'UPDATE gs_bg_baogao SET seg =  1 where seg=0;';
			}
			return $this->db->query($baogaoSql);
		}
		return false;
		
	}
	
	//获取所有基因产品
	function chanpin_list(){
		$sql = 'select id,name from '.$this->chanpin;
		return $this->db->getAll($sql);
	}
	public function index(){
		$sql = 'select * from '.$this->chanpin;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function update(){
		$id = $this->get_id();
		$Unfiltered=array('content');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->chanpin,$id,$Unfiltered);
		$this->display('add');
	}
	public function runadd(){
		$this->is_submit();
		if(empty($_POST['name'])){
			$this->error('请填写基因名称！');
		}
		$type = !empty($_POST['id'])?'update':'add';
		unset($_POST['code']);
		if($type=='add'){
			$r = $this->db->insert($this->chanpin,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->chanpin,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/index'));
		}
	}
	function delete(){
		$id = $this->get_id();
		$this->db->delete($this->chanpin,$id);
		$this->success('删除成功！');
	}
	//增加属性
	function property_index(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->property.' where cid='.$id;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	function property_add(){
		$this->list = $this->chanpin_list();
		$this->display();
	}
	function property_update(){
		$this->list = $this->chanpin_list();
		$id = $this->get_id();
		$this->field = $this->db->getField($this->property,$id);
		$this->display('property_add');
	}
	function property_runadd(){
		$this->is_submit();
		if(empty($_POST['name']) || empty($_POST['title'])){
			$this->error('请填写属性名称！');
		}
		$type = !empty($_POST['id'])?'update':'add';
		$_POST['litpic'] = empty($_FILES['litpic']['name'])?$_POST['textfield']:Upload::up('litpic');
		unset($_POST['textfield']);
		
		$_POST['title'] = trim($_POST['title']);
		unset($_POST['code']);
		if($type=='add'){
			$r = $this->db->insert($this->property,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->property,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/property_index/id/'.$_POST['cid']));
		}
	}
	function property_delete(){
		$id = $this->get_id();
		$this->db->delete($this->property,$id);
		$this->success('删除成功！');
	}
	//基因值
	function fenshu_index(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->fenshu.' where pid='.$id;
		$this->list = $this->db->getAll($sql);
		$this->display('fenshu');
	}
	function fenshu_add(){
		$this->display();
	}
	function fenshu_update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->fenshu,$id);
		$this->display('fenshu_add');
	}
	function fenshu_runadd(){
		$this->is_submit();
		if(empty($_POST['name']) || empty($_POST['sum'])){
			$this->error('请填写完整！');
		}
		$_POST['name']= trim($_POST['name']);
		$type = !empty($_POST['id'])?'update':'add';
		unset($_POST['code']);
		if($type=='add'){
			$r = $this->db->insert($this->fenshu,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->fenshu,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/fenshu_index/id/'.$_POST['pid']));
		}
	}
	function fenshu_delete(){
		$id = $this->get_id();
		$this->db->delete($this->fenshu,$id);
		$this->success('删除成功！');
	}
	//职业
	function zheye_index(){
		$sql = 'select * from '.$this->zheye.' where cid='.$_GET['id'];
		$this->list = $this->db->getAll($sql);
		$this->display('zheye');
	}
	function zheye_add(){
		$sql = 'select id,title from '.$this->article.' where cat_id=12';
		$this->typelist = $this->db->getAll($sql);
		$this->display();
	}
	function zheye_update(){
		$sql = 'select id,title from '.$this->article.' where cat_id=12';
		$this->typelist = $this->db->getAll($sql);

		$id = $this->get_id();
		$Unfiltered=array('content','content1','content2','content3','jianyi1','yichuanglv');//不过滤键名为这些的html标签
		$this->field = $this->db->getField($this->zheye,$id,$Unfiltered);
		$this->display('zheye_add');
	}
	function zheye_runadd(){

		$this->is_submit();
		if(empty($_POST['name']) || empty($_POST['title']) || empty($_POST['value']) ){
			$this->error('请填写完整！');
		}
		$type = !empty($_POST['id'])?'update':'add';
		$_POST['litpic'] = empty($_FILES['litpic']['name'])?$_POST['textfield']:Upload::up('litpic');
		$_POST['litpic1'] = empty($_FILES['litpic1']['name'])?$_POST['textfield1']:Upload::up('litpic1');
		$_POST['litpic2'] = empty($_FILES['litpic2']['name'])?$_POST['textfield2']:Upload::up('litpic2');
		if($_POST['cid']!=4){
		$_POST['litpic3'] = empty($_FILES['litpic3']['name'])?$_POST['textfield3']:Upload::up('litpic3');
		$_POST['litpic4'] = empty($_FILES['litpic4']['name'])?$_POST['textfield4']:Upload::up('litpic4');
		$_POST['litpic5'] = empty($_FILES['litpic5']['name'])?$_POST['textfield5']:Upload::up('litpic5');
		}
		$_POST['jianyi1'] = empty($_POST['jianyi1'])?'':$_POST['jianyi1'];
		$_POST['jianyi2'] = empty($_POST['jianyi2'])?'':$_POST['jianyi2'];
		$_POST['jianyi3'] = empty($_POST['jianyi3'])?'':$_POST['jianyi3'];
		unset($_POST['textfield']);
		unset($_POST['textfield1']);
		unset($_POST['textfield2']);
		unset($_POST['textfield3']);
		unset($_POST['textfield4']);
		unset($_POST['textfield5']);
		unset($_POST['code']);
		if($type=='add'){
			$r = $this->db->insert($this->zheye,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->zheye,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/zheye_index/id/'.$_POST['cid']));
		}
	}
	function zheye_delete(){
		$id = $this->get_id();
		$this->db->delete($this->zheye,$id);
		$this->success('删除成功！');
	}



	//报告 
	function baogao(){
		$where='';
		$paramts=array();
		if(!empty($_GET['cid']) || !empty($_GET['keyword']) || !empty($_GET['state'])){
			$where=' where ';
			$wheres=array();
			if(!empty($_GET['cid'])){
				$wheres[]='b.cid='.$_GET['cid'];
			}
			
			if(!empty($_GET['keyword'])){
				$keyword=array(
				'0'=>'t.name like "%'.$_GET['keyword'].'%"',
				'1'=>'t.identifier="'.$_GET['keyword'].'"',
				);
				$keyword=join(' or ',$keyword);
				$wheres[]=' ( '.$keyword.' ) ';
			}
			$wheres=join(' and ',$wheres);
			$where.=$wheres.' ';
		}
		$this->catechanpin=$this->db->getAll('select name,id from gs_bg_chanpin');
		$pagesize='15';
		$sql = 'select b.*,t.id as tid,t.name,t.time5  from '.$this->baogao.' b left join '.$this->tuoye.' as t on t.identifier=b.title '.$where;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用

		$sql = 'select * from '.$this->chanpin;
		$r = $this->db->getAll($sql);
		$data = array();
		foreach($r as $v){
			$data[$v['id']] = $v;
		}

		$this->data = $data;
		$sql = 'select b.*,t.id as tid,t.uid,t.name,t.time5  from '.$this->baogao.' b left join '.$this->tuoye.' as t on t.identifier=b.title '.$where.' order by id desc  limit '.$page*$pagesize.','.$pagesize;
		$this->list = $this->db->getAll($sql);
		//判断是否需要通知第三方同程
		$uids = '';
		foreach($this->list as $v){
			if (!empty($v['uid']))
				$uids .= $v['uid'].',';
		}
		if (!empty($uids)) {
			$sql = 'select * from gs_user u  where u.id in('.substr($uids,0,-1).')';
			$userInfos = $this->db->getAll($sql);
		}
		if (!empty($userInfos)) {
			foreach ($userInfos as $key => $value) {
				$userArr[$value['id']] = $value;
			}
			foreach ($this->list as &$lvalue) {
				if (isset($userArr[$lvalue['uid']])) {
					$lvalue['thirdtoid'] = $userArr[$lvalue['uid']]['thirdtoid'];
				}
			}
		}
		$this->display();
	}
	function baogao_add(){
		$id = $this->get_id('cid');
		//获取属性
		$sql = 'select * from '.$this->property.' where cid='.$id;
		$data = $this->db->getAll($sql);
		foreach($data as $k => $v){
			$sql = 'select * from '.$this->fenshu.' where pid='.$v['id'];
			$data[$k]['fenshu'] = $this->db->getAll($sql);
		}
		$this->data = $data;
		$this->display('baogao_add');
	}
	function baogao_update(){
		$id = $this->get_id();
		//值
		$this->field = $this->db->getField($this->baogao,$id);
		$_GET['cid'] = $this->field['cid'];
		//获取属性
		$sql = 'select * from '.$this->property.' where cid='.$_GET['cid'];
		$data = $this->db->getAll($sql);
		foreach($data as $k => $v){
			$sql = 'select * from '.$this->fenshu.' where pid='.$v['id'];
			$data[$k]['fenshu'] = $this->db->getAll($sql);
		}
		$this->data = $data;

		$this->field['content'] = explode(',',$this->field['content']);
		$this->field['content1'] = array();
		foreach($this->field['content'] as $v){
			$v = explode('=',$v);
			$this->field['content1'][$v[0]] = $v[1];
		}
		$this->display('baogao_add');
	}
	function baogao_runadd(){
		$this->is_submit();
		if(empty($_POST['title'])  ){
			$this->error('请填写编号！');
		}
		$type = !empty($_POST['id'])?'update':'add';
		
		$_POST['content'] = '';
		foreach($_POST['property'] as $k=>$v){
			if(!empty($v)){
				$_POST['content'] .= $k.'='.$v.',';
			}
		}
		$_POST['content'] = trim($_POST['content'],',');
		unset($_POST['code']);
		unset($_POST['property']);
		if($type=='add'){
			$r = $this->db->insert($this->baogao,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->baogao,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/baogao'));
		}
	}
	function baogao_delete(){
		$id = $this->get_id();
		$this->db->delete($this->baogao,$id);
		$this->success('删除成功！');
	}
	//
	function tuoye(){
		$pagesize='15';
		$where='';
		$paramts=array();
		if(!empty($_GET['cid']) || !empty($_GET['keyword']) || !empty($_GET['state']) || !empty($_GET['mobile'])){
			$where=' where ';
			$wheres=array();
			if(!empty($_GET['cid'])){
				$wheres[]='c.cid='.$_GET['cid'];
			}
			if(!empty($_GET['state'])){
				$wheres[]='t.state="'.$_GET['state'].'"';
			}
			if(!empty($_GET['keyword'])){
				$keyword=array(
				'0'=>'t.name like "%'.$_GET['keyword'].'%"',
				'1'=>'t.identifier like "%'.$_GET['keyword'].'%"',
				'2'=>'u.username = "'.$_GET['keyword'].'"',
				);
				$keyword=join(' or ',$keyword);
				$wheres[]=' ('.$keyword.') ';
			}
			
			$wheres=join(' and ',$wheres);
			$where.=$wheres.' ';
			
		}
		
		if(!empty($_POST['status']) && !empty($_POST['ids'])){
			$status=$_POST['status'];
			//获取手机号
			$sql = 'select u.username from '.$this->tuoye.' as t left join '.$this->user.' as u on t.uid=u.id where t.id in('.$_POST['ids'].')';
			$r = $this->db->getAll($sql);
			foreach($r as $v){
			$phone = $v['username'];
			//zhuangtai = $this->tuoye_state[$_POST['state']];
			switch ($status){
				case 6:
				  $zhuangtai = '样本不合格，需再次取样检测，稍后将为您重新发放取样盒，请注意查收。咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 0:
				  $zhuangtai = '样本已绑定，咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 1:
				  $zhuangtai = '样本已到实验室，咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 2:
				  $zhuangtai = '样本正在分析中，咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 3:
				  $zhuangtai = '检测报告正在生成中，咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 4:
				  $zhuangtai = '检测报告专家正在审核，咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 5:
				  $zhuangtai = '样本报告已经发出，请登录官网或23密码官方微信号查看报告，咨询：400-109-2599，微信公众号：Mima-23';
				  break;
				case 7:
				  $zhuangtai = '删除';
				  break;
			}
				if($status!=7){
					file_get_contents(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?phone=$phone&zhuangtai=$zhuangtai");
				}
			}
			$sql="update ".$this->tuoye." set state='".$status."',time".$status."=".time()." where id in (".$_POST['ids'].")";
			$this->db->query($sql);
			
		}		
		
		$this->catechanpin=$this->db->getAll('select name,id from gs_bg_chanpin');
		$sql = 'select t.id from '.$this->tuoye.' as t left join gs_code as c on t.identifier=c.code left join gs_user as u on u.id=t.uid'.$where;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize,$paramts);				//实例化类
		$this->showpage = $Page->showpage();			//调用

		$sql = 'select t.*,u.username,cp.name as cname from '.$this->tuoye.' as t left join gs_user as u on u.id=t.uid left join gs_code as c on t.identifier=c.code left join gs_bg_chanpin as cp on cp.id=c.cid '.$where.'order by t.state asc,t.id desc limit '.$page*$pagesize.','.$pagesize;
		$list = $this->db->getAll($sql);
		$this->list = $list;
		$this->display();
	}
	function tuoye_add(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->tuoye.' where id='.$id;
		$this->field = $this->db->getRow($sql);
		$this->display();
	}
	function addtuoYeView(){
		$this->display();
	}
	function tuoye_runadd(){
		if(empty($_POST['time'.$_POST['state']]) ){
			$_POST['time'.$_POST['state']] = time();
			//获取手机号
			$sql = 'select u.username from '.$this->tuoye.' as t left join '.$this->user.' as u on t.uid=u.id where t.id='.$_POST['id'];
			$r = $this->db->getRow($sql);
			$phone = $r['username'];
			//zhuangtai = $this->tuoye_state[$_POST['state']];
			switch ($_POST['state']){
				case 0:
				  $zhuangtai = '样本已绑定';
				  break;
				case 1:
				  $zhuangtai = '样本已到实验室';
				  break;
				case 2:
				  $zhuangtai = '样本正在分析中';
				  break;
				case 3:
				  $zhuangtai = '检测报告正在生成中';
				  break;
				case 4:
				  $zhuangtai = '检测报告专家正在审核';
				  break;
				case 5:
				  $zhuangtai = '样本报告已经发出，请登录官网或23密码官方微信号查看报告';
				  break;
			}
			file_get_contents(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?phone=$phone&zhuangtai=$zhuangtai");
		}
		unset($_POST['code']);
		unset($_POST['time']);
		$_POST['birthtime']=strtotime($_POST['birthtime']);
		$r = $this->db->update($this->tuoye,$_POST);
		$info = '修改';
		if($r){
			if(empty($_SESSION['weixin'])){
				$this->success($info.'成功！',U('/Report/tuoye'));
			}else{
				$this->success($info.'成功！',U('Index/wap_index'));
			}
		}
	}

	//样本盒绑定产品
	function banding(){
		$pagesize='15';
		$sql = 'select id from '.$this->banding;
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用

		$sql = 'select b.*,c.name from '.$this->banding.' as b left join '.$this->chanpin.' as c on b.cid=c.id order by b.id desc limit '.$page*$pagesize.','.$pagesize;;
		$this->list = $this->db->getAll($sql);

		$sql = 'select * from '.$this->chanpin;
		$this->chanpin = $this->db->getAll($sql);

		$this->display();
	}
	function banding_add(){
		$sql = 'select * from '.$this->chanpin;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	function banding_update(){
		$sql = 'select * from '.$this->chanpin;
		$this->list = $this->db->getAll($sql);

		$id = $this->get_id();
		$this->field = $this->db->getField($this->banding,$id);
		$this->display('banding_add');
	}
	function banding_runadd(){
		$this->is_submit();
		if(empty($_POST['title']) ){
			$this->error('请填写完整！');
		}
		$type = !empty($_POST['id'])?'update':'add';
		unset($_POST['code']);
		if($type=='add'){
			$r = $this->db->insert($this->banding,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->banding,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/banding'));
		}
	}
	//导入execl
	function excel(){
		$this->display();
	}
	//优惠卷
	function youhui(){
		$pagesize='15';
		$sql = 'select id from '.$this->youhuijuan.' where state<2';
		$page = empty($_GET['page'])?0:$_GET['page']-1;	//当前页码-1
		$sum = $this->db->getNum($sql);
		$Page= new Page($sum,$pagesize);				//实例化类
		$this->showpage = $Page->showpage();			//调用

		$sql = 'select * from '.$this->youhuijuan.' where state<2 order by id desc limit '.$page*$pagesize.','.$pagesize;;
		$this->list = $this->db->getAll($sql);
		
		$this->display();
	}
	function identify(){
		$sql = 'select * from '.$this->identify;
		$this->list = $this->db->getAll($sql);
		$this->display();
	}
	function identify_add(){
		$this->display();
	}
	function identify_update(){
		$id = $this->get_id();
		$this->field = $this->db->getField($this->identify,$id);
		$this->display('identify_add');
	}
	function identify_runadd(){
		$this->is_submit();
		if(empty($_POST['name'])){
			$this->error('请填写标识！');
		}
		$_POST['name']= trim($_POST['name']);
		$type = !empty($_POST['id'])?'update':'add';
		unset($_POST['code']);
		if($type=='add'){
			$r = $this->db->insert($this->identify,$_POST);
			$info = '添加';
		}else{
			$r = $this->db->update($this->identify,$_POST);
			$info = '修改';
		}
		if($r){
			$this->success($info.'成功！',U('/Report/identify'));
		}
	}
	function identify_delete(){
		$id = $this->get_id();
		$this->db->delete($this->identify,$id);
		$this->success('删除成功！');
	}

	//增加唾液盒
	function bindTuoYe(){
		if(empty($_POST['realname'])){
			echo json_encode(array('code'=>-1,'msg'=>'请填写受检人姓名'));exit;
		}

		$data = array();
		$day = intval($_POST['day']);
		$year = intval($_POST['year']);
		$month = intval($_POST['month']);
		$data['birthtime'] = mktime(0,0,0,$month,$day,$year);

		
		$data['name'] = $_POST['realname'];
		$data['uid'] = intval($_POST['uid']);

		$data['rcvSex'] = empty($_POST['rcvSex'])?0:1;

		
		if(empty($_POST['identifier'])){
			echo json_encode(array('code'=>-1,'msg'=>'没有绑定码'));exit;
		}
		$identifier = $_POST['identifier'];
		//$identifier = strtoupper(join('-',$_POST['identifier']));
		
		$sql = 'select id,status,cid from '.$this->code.' where  code="'.$identifier.'" limit 1';
		$r1 = $this->db->getRow($sql);
		if(empty($r1)){
			echo json_encode(array('code'=>-1,'msg'=>'编码有误！'));exit;
		}
		if($r1['cid']==4 && (empty($_POST['high']) || empty($_POST['weight']))){
			echo json_encode(array('code'=>-1,'msg'=>'身高或者体重不能为空'));exit;
		}else if($r1['cid']==4){
			$data['hight'] = intval($_POST['high']);
			$data['weight'] = intval($_POST['weight']);
		}
		if($r1['status'] == 2){
			echo json_encode(array('code'=>-1,'msg'=>'该编码已被绑定！'));exit;
		}
		$r1['status'] = 2;
		//修改状态
		$data['identifier'] = $identifier;
		$data['time0'] = time();
		
		$r = $this->db->insert($this->bg_tuoye,$data);
		$r = $this->db->update($this->code,$r1);
		$info = '添加';
		if ($r) {
			echo json_encode(array('code'=>0,'msg'=>'绑定成功'));exit;
		} else {
			echo json_encode(array('code'=>-1,'msg'=>'该编码已被绑定！'));exit;
		}
		
	}

	/**
	 *上传pdf报告视图页面
	 */
	public function baogao_uppdf() {
		$this->id = $this->get_id();
		$this->display();
	}

	/**
	 *上传pdf到文件服务器
	 */
	public function uppdf() {
		$uploader = new Uploader();
        //上传配置
        $config = array(
            "savePath" => "uploads/", //存储文件夹
            "showPath" => "uploads/", //显示文件夹
            "maxSize" => 209715200000, //允许的文件最大尺寸，单位字节
            "allowFiles" => array(".pdf",".jpg",".jpeg",".gif")  //允许的文件格式
        );
        $savepath = ROOT."uploads/pdf/";
        $showpath =	ROOT."uploads/pdf/";
        $upload_name = 'upfile';
        $config['savePath'] = $savepath;
        $config['showPath'] = $showpath;

        $uploader->init($upload_name, $config);
        $info = $uploader->getFileInfo();
        if ($info['state'] == 'SUCCESS') {//上传成功处理
        	$id = intval($_POST['id']);
        	$param['id'] = $id;
        	$param['pdfname'] = $info['originalName'];
        	$param['pdfurl'] = $info['url'];
        	$param['id'] = $id;
        	if ($this->db->update($this->baogao,$param)) {

        		//发送短信
        		$userSql = 'select * from '.$this->baogao.' b left join gs_bg_tuoye t on t.identifier=b.title left join gs_user u on u.id = t.uid where b.id='.$id;
        		$res = $this->db->getRow($userSql);
        		if (!empty($res['username'])) {
        			$zhuangtai = '检测报告已出';
	        		$phone = $res['username'];
	        		file_get_contents(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?phone=$phone&zhuangtai=$zhuangtai");
        		}
        		
        		echo "<script>alert('上传成功');window.location.href='/admin/Report/baogao'</script>";
        	} else {
        		echo "失败";
        	}
        }
        exit(0);
	}

	/**
	 *下载pdf到文件服务器
	 */
	public function downloadpdf() {
		$id = intval($_GET['id']);
		if (!$id) {
			exit;
		}
		$fileInfo = $this->db->getRow('select * from '.$this->baogao .' where id='.$id);
		$fileName = $fileInfo['pdfname'];
		$filePath = ROOT."uploads/pdf/".$fileInfo['pdfurl'];
		//检查文件是否存在    
		if (! file_exists ($filePath)) {    
		    echo "文件找不到";    
		    exit ();    
		} else {    
		    //打开文件    
		    $file = fopen ( $filePath, "r" );    
		    //输入文件标签     
		    Header ( "Content-type: application/octet-stream" );    
		    Header ( "Accept-Ranges: bytes" );    
		    Header ( "Accept-Length: " . filesize ( $filePath ) );    
		    Header ( "Content-Disposition: attachment; filename=" . $fileName );    
		    //输出文件内容     
		    //读取文件内容并直接输出到浏览器    
		    echo fread ( $file, filesize ( $filePath ) );    
		    fclose ( $file );    
		    exit;
		}
	}


}//class end

?>