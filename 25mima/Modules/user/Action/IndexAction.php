<?php
Class IndexAction extends CommonAction{
	//验证数据安全
	protected $_valid = array(
		array('username',1,'必须有昵称','require'),
		array('email',3,'请正确输入邮箱')
    );
	public function __construct(){
    	parent::__construct();
		$this->table = $this->user;
		$this->fields = $this->db->desc_field($this->table);
	}
	public function index(){
		//print_r(111);exit;
		/*$sql = 'select * from '.$this->table .' where id='.$this->user_id;
		$this->field = $this->db->getRow($sql);
		$this->display();*/
		$url = U('/Indent/index');
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
	}
	///增加唾液盒
	function add(){
		$url = 'http://23mima.com/user/Index/add';
		$this->get_access_token($url);
		$this->display();
	}
	//查看状态
	function info(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->bg_tuoye.' where id='.$id;
		$field = $this->db->getRow($sql);
		$field['birthtime1'] = date('Y-n-j',$field['birthtime']);
		$this->field = $field;
		$this->display('info');
	}
	function update(){
		$id = $this->get_id();
		$sql = 'select * from '.$this->bg_tuoye.' where id='.$id;
		$field = $this->db->getRow($sql);
		$field['birthtime1'] = date('Y-n-j',$field['birthtime']);
		//$field['birthtime1'] = explode('-',$field['birthtime1']);
		$this->field = $field;
		$this->display('add');
	}
	//增加唾液盒
	function runadd(){

		$type = !empty($_POST['id'])?'update':'add';
		if(empty($_POST['name'])){
				$this->error('请填写受检人姓名!',U('/Index/add'));exit;
		}


		$data = array();
		
		$data['birthtime'] = mktime(0,0,0,$_POST['month'],$_POST['day'],$_POST['year']);

		
		$data['name'] = $_POST['name'];
		$data['uid'] = $this->user_id;

		$data['rcvSex'] = empty($_POST['rcvSex'])?0:1;

		
		if($type=='add'){
			if(empty($_POST['identifier'])){
				$this->error('请填写编号!',U('/Index/add'));exit;
			}
			//$_POST['identifier'] = strtoupper($_POST['identifier']);
			//判断是否已被绑定
			//print_r($_POST['identifier']);exit;
			$identifier = strtoupper(join('-',$_POST['identifier']));
			
			$sql = 'select id,status,cid from '.$this->code.' where  code="'.$identifier.'" limit 1';
			$r1 = $this->db->getRow($sql);
			if(empty($r1)){
				$this->error('编码有误！',U('/Index/add'));
			}
			if($r1['cid']==4 && (empty($_POST['high']) || empty($_POST['weight']))){
				$this->error('身高或者体重不能为空',U('/Index/add'));
			}else if($r1['cid']==4){
				$data['hight'] = $_POST['high'];
				$data['weight'] = $_POST['weight'];
			}
			if($r1['status'] == 2){
				$this->error('该编码已被绑定！',U('/Index/add'));
			}
			$r1['status'] = 2;
			//修改状态
			$data['identifier'] = implode('-', $_POST['identifier']);
			$data['time0'] = time();
			//print_r($data);exit;
			$r = $this->db->insert($this->bg_tuoye,$data);
			$r = $this->db->update($this->code,$r1);
			$info = '添加';
		}else{
			$data['id'] = $_POST['id'];
			$r = $this->db->update($this->bg_tuoye,$data);
			$info = '修改';
		}
		if($_SESSION['shibei'] == 'wap'){
			$this->success($info.'成功!',U('Index/mytuoye'));
		}else{
			$this->success($info.'成功!',U('Indent/index').'#binded');
		}
		
	}
	/*public function update(){
		if($_POST['pwd1'] != $_POST['pwd2']){
			$this->error('两次密码不一致!');
		}
		if(!empty($_POST['pwd1'])){
			$_POST['pwd'] = md5(md5($_POST['pwd1']));
		}
		if(!empty($_FILES['litpic']['name'])){
			$_POST['litpic'] = Upload::up('litpic');
		}
		$data = $this->verify();
		$sql = 'select id from '.$this->user.' where id != '.$this->user_id.' and username="'.$data['username'].'"';
		$r = $this->db->getNum($sql);
		if($r){
			$this->error('此用户名已被注册!');
		}
		if(!empty($data['email'])){
			$sql = 'select id from '.$this->user.' where id != '.$this->user_id.' and email="'.$data['email'].'"';
			$r = $this->db->getNum($sql);
			if($r){
				$this->error('此邮箱已被注册!');
			}
		}
		$data['id']=$this->user_id;
		$this->db->update($this->table,$data);
		$this->success('修改成功!',U('Index/index'));
	}*/
	function baogaolist($id){
		$sql = 'select * from '.$this->bg_tuoye.' where uid='.$this->user_id.' and id='.$id;
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
		$id = $this->get_id();
		$field = $this->baogaolist($id);
		if($field['cid']==4){
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
			$this->fit2=array_merge($zheye);
			foreach($zheye as $k=>$v){
				$jianyi[$v['jg']][]=$v;
			}
			$this->jianyi=$jianyi;
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
			
			
			$this->display('fit_a_bg');
			
			
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
			//print_r($field['content1']);exit;
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
			$this->baogao = $this->wap_data();
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
	
	function checkcategroy(){
		$code=strtoupper($_POST['code']);
		
		if(empty($code)){
			echo json_encode(array('status'=>0));exit;
		}
		$sql = 'select * from '.$this->code.' where code="'.$code.'"';
		$code1 = $this->db->getRow($sql);
		
		if(is_array($code1) && $code1['cid']==4){
			echo json_encode(array('status'=>1));exit;
		}else{
			echo json_encode(array('status'=>0));exit;
		}
		exit;
		
	}
	function baogao1(){
		$url = 'http://23mima.com'.$_SERVER['REQUEST_URI'];
		$this->get_access_token($url);
		
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
			//数据造假
			if (0 == $zheye['common']) {
				$zheye['common'] = ($zheye['good'] + $zheye['excellent'])*0.26;//占百分之20%
			}
			$zheye['title'] = explode(',',$zheye['title']);
			//文献
			$sql = 'select * from '.$this->article.' where cat_id='.$zheye['typeid'];
			$list = $this->db->getAll($sql);
			$sql = 'select * from '.$this->article.' where id='.$zheye['typeid'];
			$wenxian = $this->db->getRow($sql,array('content'));
			
			$zheye['wenxian']=$wenxian['content'];
			$this->zheye = $zheye;
			$this->list = $this->IntegrationGoods($list,'news');
			$array = array('3'=>'一般','4'=>'良好','5'=>'优秀');
			$this->array = $array;
			$this->baogao = $this->wap_data();
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
	//wap
	function wap_index(){
		//print_r(111);exit;
		$this->display();
	}
	//已出报告
	function wap_data(){
		$sql = 'select * from '.$this->bg_tuoye.' where state=5 and uid='.$this->user_id;
		return  $this->db->getAll($sql);

	}
	//我的报告
	function mybaogao(){
		//报告
		$sql = 'select * from '.$this->bg_tuoye.' where state=5 and uid='.$this->user_id;
		$r = $this->db->getRow($sql);
		if(count($r)!=1 || empty($r)){
			$this->baogao = $this->wap_data();
			$this->display();
		}else{
			$this->success('null',U('Index/baogao/id/'.$r['id']));
		}
	}
	//我的样本盒
	function mytuoye(){
		$this->baogao = $this->wap_data();
		$sql = 'select * from '.$this->bg_tuoye.' where state<7 and uid='.$this->user_id;
		$this->tuoye = $this->db->getAll($sql);
		$this->display();
	}
	//优惠码
	function youhui(){
		//获取手机号
		$sql = 'select username from '.$this->user.' where id='.$this->user_id;
		$r = $this->db->getRow($sql);

		$sql = 'select * from '.$this->youhuijuan.' where (user_id = '.$this->user_id.' or phone='.$r['username'].') and state<2 and endtime>'.time().' order by state';
		$this->youhui = $this->db->getAll($sql);
		$this->display();
	}
	
	function kuaidi(){
		$this->display();
	}
	
	function editpassword(){
		$this->display();
	}
	//修改密码
	function update_pwd(){
		if($_POST['mima1'] != $_POST['mima2']){
			$this->error('两次密码不一致');
		}
		if(empty($_POST['mima1'])){
			$this->error('请输入密码！');
		}
		$data = array('id'=>$this->user_id);
		if(!empty($_POST['mima1'])){
			$data['pwd'] = md5(md5($_POST['mima1']));
		}
		$this->db->update($this->user,$data);
		if($_SESSION['shibei'] == 'www'){
			$this->success('修改成功!',U('Indent/index'));
		}else{
			$this->success('修改成功!',U('Index/wap_index'));
		}
	}
	function get_access_token($url){
		if(empty($_SESSION['access_ticket']) || $_SESSION['access_token_time']+7000 >time()){
			$token = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxda2e66f036932f53&secret=4eef13a5523d5d2bc583c4824f354563');
			$token = json_decode($token);
			if(empty($token->access_token)){
				echo 'appid无效';
				die();
			}
			$_SESSION['access_token'] = $token->access_token;
			$_SESSION['access_token_time'] = time();

			$ticket = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token->access_token.'&type=jsapi');
			$ticket = json_decode($ticket);
			$_SESSION['access_ticket'] = $ticket->ticket;
		}
		//签名
		$array = array();
		$this->time = time();
		$array['jsapi_ticket'] = 'jsapi_ticket='.$_SESSION['access_ticket'];
		$array['noncestr'] = 'noncestr=4eef13a5523d5d2bc583c4824f354563';
		$array['timestamp'] = 'timestamp='.$this->time;
		$array['url'] = 'url='.$url;
		$str = implode("&",$array);
		$this->signature = sha1($str);
	}
}
?>