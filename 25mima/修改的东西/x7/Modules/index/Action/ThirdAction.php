<?php
/**
 *同程第三方接入
 */
class ThirdAction extends Action{

	//基因产品列表页面
	function genelist() {
		if (empty($_GET['userinfo']) || empty($_GET['token']) || empty($_GET['date'])) {
			echo '缺少参数';exit;
		}
		$userInfoData = $this->prarseUserAssign();//解析用户签名明和渠道信息
		if (empty($userInfoData)) {
			echo '解析错误';exit;
		}

		//查看该用户是否已经激活，已经使用了激活，不给再激活,激活后thirdtoid字段会被变0
		$sql ='select u.id,u.username from gs_user u left join gs_indent i on i.user_id=u.id where i.i_type=11 and u.thirdtoid>0 and u.username="'.$username.'"';
		$res = $this->db->getRow($sql);
		if ($res) {
			echo '您已经激活，请等待报告结果';exit;
		} else {
			$_SESSION['thirdusername'] = 'tyt同程';//$userInfoData['username'];
			//将用户的信息插入用户表，用户变为会员，此处需添加用户来源字段默认0，1来自同程的推荐，方便以后统计该平台的用户
			//1,增加一个第三方uid字段，thirduid，报告出了之后要把thirduid,和产品编号，发送第三方同程
			//2,增加该用户同程的产品编号，后面产生报告后，将该字段清零，之后如果多对多，新建一歌歌同程产品和用户对应表
			if (empty($_SESSION[C('APP_INDEX_NAME').'_thirdtotid'])) {
				$user = $this->register($userInfoData);
				if (!empty($user)) {
					//跳转到基因商品列表页面，用户激活，直接生成订单，生成订单之前通知第三方，权益扣减
				} else {
					echo '用户插入失败';
				}
			} else {
				//跳转到基因商品列表页面，用户激活，直接生成订单，生成订单之前通知第三方，权益扣减
			}
			
		}
	}

	//解析三方平台来的数据
	function prarseUserAssign() {
		$key = '23185558';
		$data = $_GET['userinfo'];
		//$data = '5C9CDE2C9848C4E7EBE5446DA5CBC671515CB4D545A9D1206980525368B3A4A5B86AF3B4CB8EC1F985B26543A3BC25CCA1451460960BA223';
		$des = new DES($key);
		$urldecode = true;
		$decryptRes = $des->decrypt($data,$urldecode);
		if (empty($decryptRes)) {
			echo 'userinfo prase false';exit;
		}
		return array();
	}

	//用户注册
	function register($user=array()) {
		if (empty($user)) {
			return false;
		}
		$data = array();

		//检测已注册则返回
		$username = $user['phone'];
		$sql ='select u.id,u.username,u.thirduid,u.thirdtotid from gs_user u where u.username="'.$username.'"';
		$res = $this->db->getRow($sql);
		if ($res) {
			$user['id'] = $res['id'];
			$_SESSION[C('APP_USER_NAME').'_id'] = $res['id'];
			$_SESSION[C('APP_USER_NAME').'_userid'] = $res['username'];
			$_SESSION[C('APP_INDEX_NAME').'_userid'] = $res['username'];
			$_SESSION[C('APP_INDEX_NAME').'_thriduid'] = $res['thirduid'];
			$_SESSION[C('APP_INDEX_NAME').'_thirdtotid'] = $res['thirdtotid'];
			return $user;
		}

		$data['username']  = $user['phone'];
		$data['name']  = $user['name'];
		$data['logintime'] = time();
		$data['frompart'] = 1;//原始用户来源，三方同程接入
		$data['thirduid'] = intval($user['thirduid']);//原始用户来源uid，三方同程接入
		$data['thirdtotid'] = intval($user['thirdproductid']);//原始用户产品id，三方同程接入
		$r = $this->db->insert($this->user,$data);
		if ($r) {
			$_SESSION[C('APP_USER_NAME').'_id'] = mysql_insert_id();
			$_SESSION[C('APP_USER_NAME').'_userid'] = $data['username'];
			$_SESSION[C('APP_INDEX_NAME').'_userid'] = $data['username'];
			$_SESSION[C('APP_INDEX_NAME').'_thriduid'] = $data['thirduid'];
			$_SESSION[C('APP_INDEX_NAME').'_thirdtotid'] = $data['thirdproductid'];
		}
		$user['id'] = mysql_insert_id();
		return $user;
	}

	//通知第三方平台
	function notifyThirdPart($param=array()) {
		if (empty($param)) {
			exit;
		}
		$url = $param['url'];
		unset($param['url']);
		$data = $param;
		$retJson = true;
		$setHeader = false;
		$res = do_post($url,$data,$retJson,$setHeader);
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
		if($field['cid']==14){ //肥胖
			$field['content1'] = array();
			$field['content'] = explode(',',$field['content']);
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['content1'][$v[0]] = array('jy'=>$v[1],'fs'=>($v[2]/100));
			}
			
			$sql = 'select z.*,p.title_c,p.SNP from '.$this->bg_zheye.' as z left join '.$this->bg_property.' as p on z.title=p.title where z.cid='.$field['cid'].' group by p.title';
			$zheye = $this->db->getAll($sql);
			
			foreach($zheye as $k=>$v){
				if($v['name']=='肥胖基因'){
					unset($zheye[$k]);
				}	
			}
			$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
			$this->field1 = $this->db->getRow($sql);
			$this->field=$field;
			$this->id=$id;
			print_r($zheye);exit;
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
			
		}else{
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
			if ($field['cid']==4) {
				foreach($zheye as $k=>$v){
					if($v['name']=='肥胖基因'){
						unset($zheye[$k]);
					}	
				}
			}
			
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
				$ctsql = 'select * from gs_bg_property where title in('.substr($tilestr, 0, -1).') and cid='.$field['cid'];
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
			/*if ($field['tuoye']['age']>54) {
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
			$this->dnaScore = intval($total/100*9+$yearScore);*/
			krsort($new_zheye);
			$this->zheye = $new_zheye;
			$this->fzheye = $zheye;
			$this->field = $field;
			//获取报告所属产品
			$sql = 'select * from '.$this->bg_chanpin.' where id='.$field['cid'];
			$this->field1 = $this->db->getRow($sql);

			if ($field['cid']==5) {
				$this->fzheye['4']['fenshu'] = sprintf( "%.1f",$this->fzheye['4']['fenshu']);
				$this->display('baogao4_merrong4');
			} elseif($field['cid']==2) {
				$this->fzheye['2']['fenshu'] = sprintf( "%.1f",$this->fzheye['2']['fenshu']);
				$this->avg = $this->fzheye['2']['totalscore']/($this->fzheye['2']['good']+$this->fzheye['2']['common']+$this->fzheye['2']['excellent']);
				$this->avg = sprintf( "%.1f",$this->avg);
				$this->display('baogao4_yundong4');
			} elseif($field['cid']==4) {
				$feipang = array();
				$feipang['fenshu'] = 0;
				$feipang['fenshu1'] = 0;
				$feipang['totalscore'] = 0;
				$feipang['good'] = 0;
				$feipang['common'] = 0;
				$feipang['excellent'] = 0;
				foreach ($zheye as $zkey => $zvalue) {
					foreach ($zvalue['CT'] as $vkey => $vvalue) {
						$feipang['CT'][$vkey] = $vvalue;
					}
					$feipang['fenshu'] += $zvalue['fenshu'];
					$feipang['fenshu1'] += $zvalue['fenshu1'];
					$feipang['totalscore'] += $zvalue['totalscore'];
					$feipang['good'] += $zvalue['good'];
					$feipang['common'] += $zvalue['common'];
					$feipang['excellent'] += $zvalue['excellent'];
				}
				$feipang['fenshu1'] = sprintf( "%.1f",$feipang['fenshu1']/4);
				$feipang['fenshu'] = sprintf( "%.1f",$feipang['fenshu']/4);
				$this->avg = 73.4;//$feipang['totalscore']/($feipang['good']+$feipang['common']+$feipang['excellent'])/4;
				$this->avg = sprintf( "%.1f",$this->avg);
				$this->feipang = $feipang;
				$this->display('baogao4_feipang4');
			}
		
		}
	}

	/**
	 *第三方商品列表
	 */
	function goodlist() {
		$ids = '21,23,24,25';//得到商品ID
		//得到商品详细并得到商品搭配列表
		$sql = 'select g.*,b.brand_name from '.$this->goods.' as g left join '.$this->brand.' as b on g.brand_id=b.brand_id where goods_id in(' .$ids. ')';
		$this->fields = $this->db->getAll($sql);
		if(empty($this->fields)){
			$this->error('访问出错！');
		}
		if(!DEBUG){
			$create = new CreateHtml();
			$create->start();
			$this->display('Article:goods');
			$create->end(C('REWRITE_GOODS').$id);
		}else{
			$this->display('Third:goods');
		}
	}


	//第三方购买的产品，需要支付0元，立即给激活
	function mima(){
		$_SESSION[C('APP_INDEX_NAME').'_thirdtotid'] = 1;
		$_SESSION['thirdusername'] = 'tyt同程';
		if (empty($_SESSION[C('APP_INDEX_NAME').'_thirdtotid'])) {
			exit;
		}
		//判断是否上线
		if(empty($_SESSION['user_id'])){
			$this->error('您还没有登录请先登录！','/index/Index/loginurl');	exit;	
		}
		$sql = 'select * from '.$this->goods.' where is_on_sale=1 and  goods_id='.$_POST['goods_id'][0];
		$num = $this->db->getNum($sql);
		if(empty($num)){
			$this->error('该产品暂未上线，尽请期待！');
		}
		$goods = array();
		foreach($_POST['goods_id'] as $k=>$v){
			$goods[$k]['goods_id'] 	= $v;
			$goods[$k]['number']    = $_POST['number'][$k];
		}
		$this->shopping = $this->IntegrationGoods($goods);
		//更多基因
		/*$sql = 'select goods_id from '.$this->goods.' where goods_id!='.$_POST['goods_id'][0].' and is_on_sale=1 limit 2';
		$goodslist = $this->db->getAll($sql);
		$this->goodslist = $this->IntegrationGoods($goodslist);*/
		$this->display();
	}
	function runmima(){
		if(empty($_POST['country']) || empty($_POST['address']) || empty($_POST['name']) || empty($_POST['mobile'])){
			$this->success('数据出错！',U('Index/index'));
		}
		$uid = $this->user_id = empty($_SESSION['user_id'])?0:$_SESSION['user_id'];
		//添加到购物车
		$sql = 'insert into '.$this->shopping.' (indent_id,goods_id,user_id,number,unit_price) values ';
		$_POST['price'] = 0;//订单价格
		foreach($_POST['number'] as $k=>$v){
			if(!empty($v)){
				$goods_id = $_POST['goods_id'][$k];
				$sql_price = 'select shop_price from '.$this->goods.' where goods_id='.$goods_id;
				$r1 = $this->db->getRow($sql_price);
				$_POST['price'] += $r1['shop_price'] * $v;
				$sql .= "(000,$goods_id,$uid,$v,".$r1['shop_price']."),";
			}
		}
		$sql = trim($sql,',');
		//通知同程通知同程权益递减
		
		//提交订单
		$data = array();
		$data['indent'] = time().rand(1,9999);
		$data['user_id'] = $this->user_id;
		$data['type'] = 1;//相当于已经付款
		$data['name'] = $_POST['name'];
		$data['phone'] = $_POST['mobile'];
		$data['size'] = $_POST['province'].$_POST['city'].$_POST['country'].$_POST['address'];
		$data['price'] = $_POST['price'];
		$data['addtime'] = time();
		$data['i_type'] = 11;//来自同程
		mysql_query('begin');//开始事务
		
		$r = $this->db->insert($this->indent,$data);
		$indent_id = mysql_insert_id();
		$sql = str_ireplace("(000,","(".$indent_id.',',$sql);
		$r1 = $this->db->query($sql);
		if (empty($r) || empty($r1)  ) {
	        mysql_query('rollback');
	        $this->success('订单出错！请重新提交！',U('Index/index'));
	    }else{
	        mysql_query('commit');
	        //$this->success('提交成功',U('/Alipay/index/id/'.$data['indent'],'user'));
	        //原来是跳转支付页面现在直接默认开通成功
	        //
	    }
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