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
			//将用户的信息插入用户表，用户变为会员，此处需添加用户来源字段默认0，1来自同程的推荐，方便以后统计该平台的用户
			//1,增加一个第三方uid字段，thirduid，报告出了之后要把thirduid,和产品编号，发送第三方同程
			//2,增加该用户同程的产品编号，后面产生报告后，将该字段清零，之后如果多对多，新建一歌歌同程产品和用户对应表
			if (empty($_SESSION[C('APP_INDEX_NAME').'_thriduid'])) {
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
		$
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

	//第三方查看报告结果http://www.23mima.com/index/Third/baogao/id/263/key/4/
	function baogao(){
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