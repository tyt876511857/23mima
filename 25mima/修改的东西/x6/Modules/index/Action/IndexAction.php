<?php
use Dompdf\Dompdf;
class IndexAction extends Action{
	function index(){
	//	echo 111;exit;
		$cache_config = $this->shop_config();
		$field['title'] 		= 	$cache_config['cfg_shop_title'];
		$field['description'] 	= 	$cache_config['cfg_shop_description'];
		$field['keywords'] 		= 	$cache_config['cfg_shop_keywords'];
		$this->field = $field;
		$sql = 'select * from '.$this->article.' where cat_id=10 order by add_time desc limit 0,10';
		$this->news = $this->db->getAll($sql);
		$this->brand = $this->shop_brand();
		if(!DEBUG){
			$create = new CreateHtml();
			$create->start();
			$this->display();
			$create->end('index');
		}else{
			$this->display();
		}
	}
	function wap(){
		$this->display('wap');
	}
	function successpage(){
		$this->display();
	}
	function yzm(){
		$phone = $_POST['phone'];
		$_SESSION['phone'] = $phone;
		$_SESSION['yzm'] = rand(100000,999999);
		//print_r(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?phone=$phone&yzm=$_SESSION[yzm]");exit;
		file_get_contents(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?phone=$phone&yzm=$_SESSION[yzm]");
		echo '已发送！';
	}
	function yzm1(){
		//if(md5($_POST['yzm2']) != $_SESSION['verify']){
		//	echo '验证码错误！';
		//	return false;
		//}
		////unset($_SESSION['verify']);
		$phone = $_POST['phone'];
		$_SESSION['phone'] = $phone;
		$_SESSION['yzm'] = rand(100000,999999);
		file_get_contents(__ROOT__ ."/data/duanxin/SendTemplateSMS.php?phone=$phone&yzm=$_SESSION[yzm]");
		echo '已发送！';
	}
	function out(){
		unset($_SESSION['user_id']);
		$this->success('成功退出！','/');
	}
	function loginurl(){		
		$parent_id = 0 ;
	//	print_r($_SESSION);exit;
		if(!empty($_GET['parent_id'])){
			$this->parent_id = $_GET['parent_id'] ;
			$_SESSION['parent_id'] = $parent_id;
		//	print_r($this->parent_id);exit;
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {			
				if(empty($_SESSION['openId'])){
					 header('location:http://23mima.com/index/Login/wapwechat/type/base');
					 die();
				}else{
					$sql = 'select * from '.$this->user.' where openid="'.$_SESSION['openId'].'"';
					$r = $this->db->getRow($sql);
					if($r){ //success
						$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
						$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
						$_SESSION['index_userid']				= $r['username'];
						//更新登录新意
						$sql = 'update '.$this->user.' set openid="'.$_SESSION['openId'].'", logintime='.time().' where id='.$r['id'];
						$this->db->query($sql);					
						$this->display('erweima');
						die();
					}else{
					//	$this->success('请先登录!',$_SESSION['loginurl']);
					}
				}	
			}				
		}else{
			if(!empty($_SESSION['user_id'])){
				header('location:/user/index');	
				exit;				
			}else{
				if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {			
					if(empty($_SESSION['openId'])){
						 header('location:http://23mima.com/index/Login/wapwechat/type/base');
						 die();
					}else{
						$sql = 'select * from '.$this->user.' where openid="'.$_SESSION['openId'].'"';
						$r = $this->db->getRow($sql);
						if($r){ //success
							$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
							$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
							$_SESSION['index_userid']				= $r['username'];
							//更新登录新意
							$sql = 'update '.$this->user.' set openid="'.$_SESSION['openId'].'", logintime='.time().' where id='.$r['id'];
							$this->db->query($sql);						
							header('location:/user/index/wap_index');
							die();
						}
					}	
				}				
			}

		}	
		
		$this->display();
	}
	//登录
	function login(){
		
		//if(!empty($_SESSION['verify']) && md5($_POST['yzm2']) != $_SESSION['verify']){
		//	$this->error('验证码错误！');
		//	die();
		//}
		//	print_r($_POST);exit;
	
		if($_POST['phone']==$_SESSION['phone'] && $_POST['yzm']==$_SESSION['yzm']){
			$sql = 'select * from '.$this->user.' where username='.$_POST['phone'];
			$r = $this->db->getRow($sql);
			if($r){
				if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
					if(empty($_SESSION['openId'])){						
						 header('location:http://23mima.com/index/Login/wapwechat/type/base');
						// die();
					}

				}	
				$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
				$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
				$_SESSION['index_userid']				= $r['username'];
				//更新登录新意
				$sql = 'update '.$this->user.' set logintime='.time().' where id='.$r['id'];
				$this->db->query($sql);
			}else{
				$data = array();
				if(!empty($_POST['parent_id'])){
					$data['parent_id']=$_POST['parent_id'];
				}
				
				
				
				if(!empty($_SESSION['parent_id'])){
					$data['parent_id']  = $_SESSION['parent_id'];				
				}
				if(!empty($_SESSION['openId'])){
					$data['openid']  = $_SESSION['openId'];				
				}
				$data['username']  = $_POST['phone'];
				$data['logintime'] = $data['register'] = time();
				$r = $this->db->insert($this->user,$data);
				if($r){
					$type = C('APP_INDEX_NAME');
					$_SESSION[C('APP_USER_NAME').'_id']=mysql_insert_id();
					$_SESSION[C('APP_USER_NAME').'_userid']=$data['username'];
					$_SESSION[C('APP_INDEX_NAME').'_userid']=$data['username'];
				}
			}
			
			
			//判断是否是微信登录
			if(!empty($_SESSION['openId'])){
				$openid = array('id'=>$_SESSION[C('APP_USER_NAME').'_id'],'openid'=>$_SESSION['openId']);
				$this->db->update($this->user,$openid);
			}else{
				//pc登录
				$sql = 'select * from '.$this->user.' where username='.$_POST['phone'];
				$r = $this->db->getRow($sql);
				if(empty($r['pwd'])){
					//跳转到设置密码
					$this->success('登录成功,请设置密码以方便下次登录！',U('Index/editpassword','user'));
				}else{
					//$this->success('登录成功！',$_SERVER['HTTP_REFERER']);
				}
			}
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
				if(!empty($_POST['parent_id'])){
				//	print_r($_POST['parent_id']);exit;
					$this->display('erweima');
					exit;						
				}
			header('location:/user/index');exit;
				
			}else{
					header('location:/user/index');exit;
			}		
		}else{
			$this->error('手机验证码错误！');
		}
	}
	function login_mima(){
		$username = $_POST['username'];
		$password = md5(md5($_POST['pwd']));
		$sql ='select id,username from '.$this->user . ' where username="'.$username.'" and pwd="'.$password.'"';
		$r = $this->db->getRow($sql);
		if(empty($r['id'])){
			$this->error('帐号或密码错误！');
		}
		$_SESSION[C('APP_USER_NAME').'_id']		= $r['id'];
		$_SESSION[C('APP_USER_NAME').'_userid']	= $r['username'];
		$_SESSION['index_userid']				= $r['username'];
		//更新登录新意
		$sql = 'update '.$this->user.' set logintime='.time().' where id='.$r['id'];
		$this->db->query($sql);
		//$this->success('登录成功！',$_SERVER['HTTP_REFERER']);
		$this->success('登录成功！','/');
	}
	function chr(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->bg_property.' where id='.$id;
		$this->data = $this->db->getRow($sql);
		$this->display();
	}

	function baogaolist($id,$true = false){
		if(empty($id)){
			$id = 1;
		}
		$sql = 'select * from '.$this->bg_tuoye.' where id='.$id;
		$r = $this->db->getRow($sql);
		if(empty($r)){
			$this->error('数据出错！');
		}else{
			$sql = 'select * from '.$this->bg_baogao.' where title="'.$r['identifier'].'"';
			$r1 = $this->db->getRow($sql);
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
		if($field['cid']==4){ //肥胖
			$field['content1'] = array();
			$field['content'] = explode(',',$field['content']);
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['content1'][$v[0]] = array('jy'=>$v[1],'fs'=>($v[2]/100));
			}
			
			$sql = 'select z.*,p.title_c,p.SNP from '.$this->bg_zheye.' as z left join '.$this->bg_property.' as p on z.title=p.title where z.cid='.$field['cid'].' group by p.title';
			$zheye = $this->db->getAll($sql);
			
			$fit1=array();
			foreach($zheye as $k=>$v){
				if($v['name']=='肥胖基因'){
					$fit1[]=$v;
					unset($zheye[$k]);
				}	
			}
			//print_r($zheye);exit;
			$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
			$this->field1 = $this->db->getRow($sql);
			$this->field=$field;
			$this->id=$id;
			foreach($zheye as $k=>$v){
				$zheye[$k]['fs']=($field['content1'][$v['title']]['fs']/0.5)+3;
				$sql = 'select f.*,p.title from '.$this->bg_fenshu.' as f left join '.$this->bg_property.' as p on f.pid=p.id where p.title="'.$v['title'].'" and f.name="'.$field['content1'][$v['title']]['jy'].'"';
				$test = $this->db->getRow($sql);
				$zheye[$k]['jg']=$test['description'];
			}
			//print_r($zheye);exit;
			$this->fit2=array_merge($zheye);
			foreach($zheye as $k=>$v){
				$jianyi[$v['jg']][]=$v;
			}
			$this->jianyi=$jianyi;
			//print_r($jianyi);exit;
			$this->baogao = $this->wap_data();
			$this->bmi=round($field['tuoye']['weight']/(($field['tuoye']['hight']/100)*($field['tuoye']['hight']/100)),2);
			$fx=1;
			//$aa=array();
			foreach($fit1 as $k=>$v){
				$fx=$fx*$field['content1'][$v['title']]['fs'];
				$fit1[$k]['fs']=$field['content1'][$v['title']]['fs'];
				$fit1[$k]['jy']=$field['content1'][$v['title']]['jy'];
				$typeid[]=$v['typeid'];
			}
			$this->zfxxs=round($fx,2);
			$age=$field['tuoye']['age'];
			if($age<=14){
				
				if($field['tuoye']['hight']>=175){
					$sql = 'select * from '.$this->fit.' where (hight_s<='.$field['tuoye']['hight'].' ) and sex='.$field['tuoye']['rcvSex'].' and (start<='.$this->bmi.' and end>'.$this->bmi.') and age=0 ';
				}else{
					$sql = 'select * from '.$this->fit.' where (hight_s<='.$field['tuoye']['hight'].' and hight_e>'.$field['tuoye']['hight'].') and sex='.$field['tuoye']['rcvSex'].' and (start<='.$this->bmi.' and end>'.$this->bmi.') and age=0 ';
				}
				
				$fit_shuoming = $this->db->getRow($sql);
			}else{
				$sql = 'select * from '.$this->fit.' where (start<='.$this->bmi.' and end>'.$this->bmi.') and age=1 ';
				$fit_shuoming = $this->db->getRow($sql);
			}
			$this->bmi_shuoming=$fit_shuoming['shuoming'];
			$this->fit1=$fit1;
			$typeid=join(',',$typeid);
			$sql = 'select title,content from '.$this->article.'  where id in ('.$typeid.') ';
			$this->articles = $this->db->getAll($sql);
			
			if($_SESSION['shibei'] == 'wap'){
				$this->display('fit_a_bg');
			}else{
				$this->display('fit_a_bg');
			}
			
		}elseif($field['cid']==5){ //美容
			$field['content'] = explode(',',$field['content']);
			$field['content1'] = array();
			$field['contentCT'] = array();//类似AA;
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['content1'][$v[0]] = $v[2];
				$field['contentCT'][$v[0]] = $v;
			}
			//特长
			$sql = 'select * from '.$this->bg_zheye.' where cid='.$field['cid'];
			$zheye = $this->db->getAll($sql);
			
			$new_zheye = array();
			$tilestr = '';//获取基因信息，如位点等
			$total = 0;//总分
			foreach($zheye as $k => &$v){
				$zheye[$k]['fenshu'] = 0;
				$v['title'] = explode(',',$v['title']);
				$v['value'] = explode(',',$v['value']);
				foreach($v['title'] as $l => &$j){
					$j = trim($j);
					$tilestr .= '\''.$j.'\',';
					if(!empty($field['content1'][$j])){
						$zheye[$k]['fenshu'] += $field['content1'][$j] * $v['value'][$l] /100;
						
					}
					$v['CT'][$j] = $field['contentCT'][$j];
				}
				$total += $zheye[$k]['fenshu'];
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
			if (!empty($tilestr)) {
				$ctsql = 'select * from gs_bg_property where title in('.substr($tilestr, 0, -1).')';
				$ctlist = $this->db->getAll($ctsql);
				if (!empty($ctlist)) {
					foreach ($ctlist as $value) {
						$temp[$value['title']] = $value;
					}
					foreach ($zheye as &$value) {
						foreach ($value['CT'] as $key=>&$cvalue) {
							$key = trim($key);
							$cvalue[] = $temp[$key]['title_c'];
							$cvalue[] = $temp[$key]['name'];
							//$value['jiyin'] = array($temp[$key]['title_c'],$temp[$key]['name'],$temp[$key]['title'],$cvalue[1],$cvalue[2]);
						}
					}
				}
			}

			//计算dna年龄
			if ($field['tuoye']['age']>54) {
				$yearScore = 2;
			} else if($field['tuoye']['age']>44) {
				$yearScore = 4;
			} else if($field['tuoye']['age']>34) {
				$yearScore = 6;
			} else if($field['tuoye']['age']>24) {
				$yearScore = 8;
			} else {
				$yearScore = 10;
			}
			$this->dnaScore = intval($total/100*9+$yearScore);
			krsort($new_zheye);
			$this->zheye = $new_zheye;
			$this->fzheye = $zheye;
			//print_r($zheye);exit;
			$this->field = $field;
			//获取报告所属产品
			$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
			$this->field1 = $this->db->getRow($sql);
			$this->display('baogao4');
		
		}else{
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
			$this->zheye = $new_zheye;
			$this->field = $field;
			//获取报告所属产品
			$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
			$this->field1 = $this->db->getRow($sql);
			
			if($_SESSION['shibei'] == 'wap'){
				$this->display($this->field1['moban']);
			}else{
				$this->display('baogao2');
			}
		}
	}
	
	
	function baogao1(){
		$bid = $this->get_id();
		$id = $this->get_id('key');//特长
		//报告数据
		$field = $this->baogaolist($bid);
		if($field['cid']==4){
			$field['content'] = explode(',',$field['content']);
			$field['content1'] = array();
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['content1'][$v[0]] = $v;
			}
			$this->field=$field;
			
			$sql = 'select z.*,p.title_c,p.id as pid,p.SNP from '.$this->bg_zheye.' as z left join '.$this->bg_property.' as p on p.title=z.title where z.id='.$id.' and p.cid=4';
			$zheye = $this->db->getRow($sql,array('jianyi1','content1','content2','content3'));
			$zheye['yichuanglv']=explode(',',$zheye['yichuanglv']);
			$sql = 'select * from '.$this->article.' where id='.$zheye['typeid'];
			$wenxian = $this->db->getRow($sql,array('content'));
			
			$zheye['wenxian']=$wenxian['content'];
			$this->zheye = $zheye;
			$fenshu=$field['content1'][$zheye['title']];
			$sql = 'select * from '.$this->bg_fenshu.' where pid='.$zheye['pid'].' and name="'.trim($fenshu[1]).'"';
			$fenshu1 = $this->db->getRow($sql);
			
			
			$this->fenshu1 =$fenshu1;
			
			$this->display('fit_f_bg');
			
			
			
		}else{
			$field['content'] = explode(',',$field['content']);
			$field['content1'] = array();
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['content1'][$v[0]] = $v;
			}
			$this->field=$field;
			//基因中文名称
			$sql = 'select name,title from '.$this->bg_property.' where cid='.$field['cid'];
			$jiyin = $this->db->getAll($sql);
			$jiyin1 = array();
			foreach($jiyin as $k=>$v){
				$jiyin1[$v['title']] = $v['name'];
			}
			$this->jiyin = $jiyin1;

			//特长
			$sql = 'select * from '.$this->bg_zheye.' where id='.$id;
			$zheye = $this->db->getRow($sql,array('common','good','excellent','content1','content2','content3'));
			//兼容第三方来的分报告类似http://www.23mima.com/index/Index/baogao1/id/263/key/4
			if (empty($_GET['f'])) {
				$zheye['fenshu'] = 0;
				$temptitle = explode(',',$zheye['title']);
				$tempvalue = explode(',',$zheye['value']);
				foreach($temptitle as $l => $j){
					if(!empty($field['content1'][$j])){
						$zheye['fenshu'] += $field['content1'][$j][2] * $tempvalue[$l] /100;
					}
				}
				if($zheye['fenshu']>93){
					$_GET['f'] = 5;
				}elseif($zheye['fenshu']>86){
					$_GET['f'] = 4;
				}else{
					$_GET['f'] = 3;
				}
			}
			//数据造假
			if (0 == $zheye['common']) {
				$zheye['common'] = ($zheye['good'] + $zheye['excellent'])*0.26;//占百分之20%
			}
			$zheye['title'] = explode(',',$zheye['title']);
			$this->zheye = $zheye;
			//文献
			$sql = 'select * from '.$this->article.' where cat_id='.$zheye['typeid'];
			$list = $this->db->getAll($sql);
			$sql = 'select * from '.$this->article.' where id='.$zheye['typeid'];
			$wenxian = $this->db->getRow($sql,array('content'));
			
			$zheye['wenxian']=$wenxian['content'];
			$this->zheye = $zheye;
			$this->list = $this->IntegrationGoods($list,'news');

			$array = array('3'=>'一般','良好','优秀');
			$this->array = $array;
			//获取报告所属产品
			$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
			$this->field1 = $this->db->getRow($sql);

			//获取基因属性
			$sql = 'select * from '.$this->bg_property.' where cid='.$field['cid'];
			$jiyin2= $this->db->getAll($sql);
			$jiyin_new = array();
			foreach($jiyin2 as $k=>$v){
				if(in_array($v['title'],$zheye['title'])){
					//获取对应分数描述
					$sql = 'select * from '.$this->bg_fenshu.' where pid='.$v['id'];
					$son = $this->db->getAll($sql);
					foreach($son as $j){
						$v['son'][$j['name']] = $j['description'];
					}
					$jiyin_new[$v['title']] = $v;
				}
			}
			
			$this->jiyin_new = $jiyin_new;
			if($_SESSION['shibei'] == 'wap'){
				$this->display($this->field1['moban1']);
			}else{
				$this->display('baogao1');
			}
		}
	}
	
	function fenxiang1(){
		$bid = $this->get_id();
		$id = $this->get_id('key');//特长
		//报告数据
		$field = $this->baogaolist($bid,true);
		$field['content'] = explode(',',$field['content']);
		$field['content1'] = array();
		foreach($field['content'] as $v){
			$v = explode('=',$v);
			$field['content1'][$v[0]] = $v;
		}
		
		//采样盒
		$sql = 'select name from '.$this->bg_tuoye.' where identifier="'.$field['title'].'"';
		$tuoye = $this->db->getRow($sql);
		$field['tuoye']=$tuoye['name'];
		$this->field=$field;
		
		//基因中文名称
		$sql = 'select name,title from '.$this->bg_property.' where cid='.$field['cid'];
		$jiyin = $this->db->getAll($sql);
		$jiyin1 = array();
		foreach($jiyin as $k=>$v){
			$jiyin1[$v['title']] = $v['name'];
		}
		$this->jiyin = $jiyin1;

		//特长
		$sql = 'select * from '.$this->bg_zheye.' where id='.$id;
		$zheye = $this->db->getRow($sql,array('content1','content2','content3'));
		$zheye['title'] = explode(',',$zheye['title']);
		$this->zheye = $zheye;
		//文献
		$sql = 'select * from '.$this->article.' where cat_id='.$zheye['typeid'];
		$list = $this->db->getAll($sql);
		$sql = 'select * from '.$this->article.' where id='.$zheye['typeid'];
		$wenxian = $this->db->getRow($sql,array('content'));
		
		$zheye['wenxian']=$wenxian['content'];
		$this->zheye = $zheye;
		$this->list = $this->IntegrationGoods($list,'news');

		$array = array('3'=>'一般','良好','优秀');
		$this->array = $array;
		//获取报告所属产品
		$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
		$this->field1 = $this->db->getRow($sql);
		
		//获取基因属性
		$sql = 'select * from '.$this->bg_property.' where cid='.$field['cid'];
		$jiyin2= $this->db->getAll($sql);
		$jiyin_new = array();
		
		foreach($jiyin2 as $k=>$v){
			if(in_array($v['title'],$zheye['title'])){
				//获取对应分数描述
				$sql = 'select * from '.$this->bg_fenshu.' where pid='.$v['id'];
				$son = $this->db->getAll($sql);
				
				foreach($son as $j){
					$v['son'][$j['name']] = ($j['sum']/10)-5;
				}
				$jiyin_new[$v['title']] = $v;
			}
		}
		$this->jiyin_new = $jiyin_new;
		$_GET['type'] = empty($_GET['type'])?1:$_GET['type'];
		$this->display('fenxiang'.$_GET['type']);
		
	}
	//已出报告
	function wap_data(){
		$sql = 'select * from '.$this->bg_tuoye.' where state=5';
		return  $this->db->getAll($sql);

	}
	
	
	function fit_z(){
		$id = $this->get_id();
		$field = $this->baogaolist($id);
		
			$field['content1'] = array();
			$field['content'] = explode(',',$field['content']);
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['content1'][$v[0]] = array('jy'=>$v[1],'fs'=>($v[2]/100));
			}
			
			
			$sql = 'select z.*,p.title_c,p.SNP from '.$this->bg_zheye.' as z left join '.$this->bg_property.' as p on z.title=p.title where z.cid='.$field['cid'].' group by p.title';
			$zheye = $this->db->getAll($sql);
			
			$fit1=array();
			foreach($zheye as $k=>$v){
				if($v['name']=='肥胖基因'){
					$fit1[]=$v;
				}	
			}
			unset($zheye);
			
			
			$this->baogao = $this->wap_data();
			
			//$aa=array();
			foreach($fit1 as $k=>$v){
				
				$fit1[$k]['fs']=$field['content1'][$v['title']]['fs'];
				$jy1=array();
				$jy=$field['content1'][$v['title']]['jy'];
				$jy=str_split($jy);
				asort($jy);
				foreach($jy as $vv){
						$jy1[]=$vv;
				}
				$fit1[$k]['jy']=join('',$jy1);
				$sql = 'select f.name,(f.sum/100) as sum from '.$this->bg_fenshu.' as f left join '.$this->bg_property.' as p on p.id=f.pid where p.title="'.$v['title'].'"';
				$jys = $this->db->getAll($sql);
				$jyss = array();
				
				foreach($jys as $vv){
					$str = array();
					$str1 = '';
					$str2 = array();
					//$str[]=substr($v['name'],0,1);
					//$str[]=substr($v['name'],1,1);
					$str=str_split($vv['name']);
					
					asort($str);
					
					foreach($str as $ss){
						$str2[]=$ss;
					}
					$str1=join('',$str2);
					$jyss[$str1]['name']=$str1;
					$jyss[$str1]['sum']=$vv['sum'];
					
					
				}
				
				$fit1[$k]['jys']=$jyss;
				
			}
			
			$this->fit1=$fit1;
			
		
			$this->display('fit_z_bg');
			
			
		
	}

	/**
	 *查询报告
	 */
	function queryBaogao() {
		if (empty($_SESSION['openId'])) {
			if (isset($_COOKIE["openId"])) {
				$_SESSION['openId'] = $_COOKIE["openId"];
				$db = mysql::getIns();
				$sql = 'select id,username from gs_user where openid="'.$_COOKIE["openId"].'"';
				$r = $db->getRow($sql);
				if(!empty($r['id'])){
					$_SESSION[C('APP_USER_NAME').'_id']     =   $r['id'];
					$_SESSION[C('APP_USER_NAME').'_userid'] =   $r['username'];
					$_SESSION['index_userid']               =   $r['username'];
					//更新登录新意
					$sql = 'update gs_user set logintime='.time().' where id='.$r['id'];
					$db->query($sql);
					$this->getBaogaoList($r['username']);
				} else {
					$this->error('此用户不存在！');
				}
			} else {
				$this->display();
			}
		} else {
			if (isset($_SESSION['index_userid'])) {
				$this->getBaogaoList($_SESSION['index_userid']);
			} else {
				$db = mysql::getIns();
				$sql = 'select id,username from gs_user where openid="'.$_SESSION['openId'].'"';
				$r = $db->getRow($sql);
				if(!empty($r['id'])){
					$_SESSION[C('APP_USER_NAME').'_id']     =   $r['id'];
					$_SESSION[C('APP_USER_NAME').'_userid'] =   $r['username'];
					$_SESSION['index_userid']               =   $r['username'];
					//更新登录新意
					$sql = 'update gs_user set logintime='.time().' where id='.$r['id'];
					$db->query($sql);
					$this->getBaogaoList($r['username']);
				}
				$this->display();
			}
		}
	}

	//通过手机验证获取报告列表,兼注册
	function getBaogaoList($username=0) {
		if ($username) {
			$sql = 'select * from '.$this->user.' where username='.$username;
			$r = $this->db->getRow($sql);
			if($r){
				//获取用户报告列表
				$sql = 'select z.*,b.pdfurl,b.pdfname,b.id as bid,b.state as bstate from '.$this->bg_tuoye. ' z left join '. $this->bg_baogao.' b on b.title=z.identifier where z.uid='.$r['id'];
				$this->tuoye = $this->db->getAll($sql);
				$this->display('mytuoye');
			}else{
				$this->error('此用户不存在！');
			}
		} else {
			if (isset($_SESSION['index_userid'])) {
				$sql = 'select * from '.$this->user.' where username='.$_SESSION['index_userid'];
				$r = $this->db->getRow($sql);
				if($r){
					//获取用户报告列表
					if ($r['openid']) {
						setcookie("openId",$r['openid'],time()+315360000,'/');
					} else {
						if (empty($_SESSION['openId'])) {
							$_SESSION['login_url'] = '/index/Index/getBaogaoList';
							header('location:http://23mima.com/index/Login/wapwechat/type/base');
						} else {
							$openid = array('id'=>$r['id'],'openid'=>$_SESSION['openId']);
							$this->db->update($this->user,$openid);
							setcookie("openId",$_SESSION['openId'],time()+315360000,'/');
						}
					}
					
					$sql = 'select z.*,b.pdfurl,b.pdfname,b.id as bid,b.state as bstate from '.$this->bg_tuoye. ' z left join '. $this->bg_baogao.' b on b.title=z.identifier where z.uid='.$r['id'];
					$this->tuoye = $this->db->getAll($sql);
					$this->display('mytuoye');
				}
			} else {
				if (empty($_SESSION['phone']) || empty($_SESSION['yzm'])) {
					echo '请先验证再查询';exit;
				}
				if($_POST['phone']==$_SESSION['phone'] && $_POST['yzm']==$_SESSION['yzm']){
					//$_POST['phone'] = '13758267885';
					//$_SESSION['downPower'] = 1;//下载的权限
					$sql = 'select * from '.$this->user.' where username='.$_POST['phone'];
					$r = $this->db->getRow($sql);
					if($r){
						//获取用户报告列表
						if ($r['openid']) {
							setcookie("openId",$r['openid'],time()+315360000,'/');
						} else {
							if (empty($_SESSION['openId'])) {
								$_SESSION['index_userid'] = $_POST['phone'];
								$_SESSION['login_url'] = '/index/Index/getBaogaoList';
								header('location:http://23mima.com/index/Login/wapwechat/type/base');
							} else {
								$openid = array('id'=>$r['id'],'openid'=>$_SESSION['openId']);
								$this->db->update($this->user,$openid);
								setcookie("openId",$_SESSION['openId'],time()+315360000,'/');
							}
						}
						
						$sql = 'select z.*,b.pdfurl,b.pdfname,b.id as bid,b.state as bstate from '.$this->bg_tuoye. ' z left join '. $this->bg_baogao.' b on b.title=z.identifier where z.uid='.$r['id'];
						$this->tuoye = $this->db->getAll($sql);
						$this->display('mytuoye');
					}else{//注册
						$data = array();
						if(!empty($_POST['parent_id'])){
							$data['parent_id']=$_POST['parent_id'];
						}
						if(!empty($_SESSION['parent_id'])){
							$data['parent_id']  = $_SESSION['parent_id'];				
						}
						if(!empty($_SESSION['openId'])){
							$data['openid']  = $_SESSION['openId'];				
						}
						$data['username']  = $_POST['phone'];
						$data['logintime'] = $data['register'] = time();
						$r = $this->db->insert($this->user,$data);
						if($r){
							$type = C('APP_INDEX_NAME');
							$_SESSION[C('APP_USER_NAME').'_id']=mysql_insert_id();
							$_SESSION[C('APP_USER_NAME').'_userid']=$data['username'];
							$_SESSION[C('APP_INDEX_NAME').'_userid']=$data['username'];
						}
						if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {			
							if(empty($_SESSION['openId'])){
								$_SESSION['login_url'] = '/index/Index/getBaogaoList';
								 header('location:http://23mima.com/index/Login/wapwechat/type/base');
								 die();
							}
						}
					}
				}else{
					$this->error('手机验证码错误！');
				}
			}
			
		}
		
	}

	/**
	 *下载pdf到文件服务器
	 *http://www.25mima.com/index/Index/downloadpdf/id/613
	 *http://www.25mima.com/index/Index/downloadpdf/wid/613 wkhtmltopdf
	 */
	public function downloadpdf($id=0) {
		if (intval($_GET['wid'])) {
			$id = intval($_GET['wid']);
			if (!$id) {
				echo '参数错误';
				exit;
			}
			$outfilename = '基因检测报告';
			$filename = '基因检测报告_'.$id;
			shell_exec("wkhtmltopdf http://www.23mima.com/index/Index/baogao/id/{$id}.html {$filename}.pdf");
			ob_end_clean();
	        if(file_exists("{$filename}.pdf")){
	            header("Content-type:application/pdf");
	            header("Content-Disposition:attachment;filename={$outfilename}.pdf");
	            echo file_get_contents("{$filename}.pdf");
	            unlink($filename.'pdf');
	        }else{
	        	echo '文件生成失败';
	            exit;
	        }
		} else {
			if (!$id) {
				$id = intval($_GET['id']);
			}
			if (!$id /*|| empty($_SESSION['downPower'])*/) {
				echo '无权限下载';
				exit;
			}
			$fileInfo = $this->db->getRow('select * from gs_bg_baogao where id='.$id);
			if (empty($fileInfo)) {
				exit;
			}
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
		
	}

	/**
	 *输出pdf
	 */
	function outPdf() {
		$id = intval($_GET['id']);
		$filename = '基因检测报告';
		shell_exec("wkhtmltopdf http://www.25mima.com/1.php {$filename}.pdf");
		ob_end_clean();
        if(file_exists("{$filename}.pdf")){
            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename={$filename}.pdf");
            echo file_get_contents("{$filename}.pdf");
            //echo "{$filename}.pdf";
        }else{
            exit;
        }
	}


}//class end
?>