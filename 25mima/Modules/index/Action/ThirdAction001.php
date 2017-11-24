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
		//print_r($userInfoData);exit;
		if (empty($userInfoData)) {
			echo '解析错误';
			echo '<script type="text/javascript">';
			$url = C('THIRD_URL');
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			exit;
		}

		//查看该用户是否已经激活，已经使用了激活，不给再激活,激活后thirdtoid字段会被变0
		$sql ='select u.id,u.username from gs_user u left join gs_indent i on i.user_id=u.id where i.i_type=11 and u.username="'.$userInfoData['phone'].'"';
		$res = $this->db->getRow($sql);
		if ($res) {
			echo '<script type="text/javascript">';
			$url = C('THIRD_URL');
			echo 'alert("您已经激活，请等待报告结果");';
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			exit;
		} else {
			$_SESSION['thirdusername'] = $userInfoData['name'];
			//将用户的信息插入用户表，用户变为会员，此处需添加用户来源字段默认0，1来自同程的推荐，方便以后统计该平台的用户
			//1,增加一个第三方uid字段，thirduid，报告出了之后要把thirduid,和产品编号，发送第三方同程
			//2,增加该用户同程的产品编号，后面产生报告后，将该字段清零，之后如果多对多，新建一歌歌同程产品和用户对应表
			//if (empty($_SESSION[C('APP_INDEX_NAME').'_thirduid'])) {
				$user = $this->register($userInfoData);
				if (!empty($user)) {
					//跳转到基因商品列表页面，用户激活，直接生成订单，生成订单之前通知第三方，权益扣减
					$this->goodlist();
				} else {
					echo '用户插入失败';
				}
			//} else {
				//$this->goodlist();
				//跳转到基因商品列表页面，用户激活，直接生成订单，生成订单之前通知第三方，权益扣减
			//}
			
		}
	}

	//解析三方平台来的数据
	function prarseUserAssign() {
		$key = C('THIRD_KEY');
		$data = $_GET['userinfo'];
		//$data = '5C9CDE2C9848C4E7EBE5446DA5CBC671515CB4D545A9D1206980525368B3A4A5B86AF3B4CB8EC1F985B26543A3BC25CCA1451460960BA223';
		$token = $_GET['token'];
		$tokentime = $_GET['date'];
		$des = new DES($key);
		$urldecode = true;
		$decryptRes = $des->decrypt($data,$urldecode);
		if (empty($decryptRes[0]) || empty($decryptRes[1]) || empty($decryptRes[2]) || empty($tokentime) || empty($token)) {
			echo '解析错误';
			echo '<script type="text/javascript">';
			$url = C('THIRD_URL');
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			exit;
		}
		$res['token'] = $token;
		$res['tokentime'] = strtotime($tokentime);
		//echo date('Y-m-d H:i',$res['tokentime']);
		$_SESSION['token'] = $token;
		$_SESSION['tokentime'] = $tokentime;
		$_SESSION[C('APP_INDEX_NAME').'_thirduid'] = $decryptRes[0];
		$res['thirduid'] = $decryptRes[0];
		$res['phone'] = $decryptRes[1];
		$res['name'] = $decryptRes[2];
		return $res;
	}

	//用户注册
	function register($user=array()) {
		if (empty($user)) {
			return false;
		}
		$data = array();

		//检测已注册则返回
		$username = $user['phone'];
		$sql ='select u.id,u.username,u.thirduid,u.token,u.tokentime from gs_user u where u.username="'.$username.'"';
		$res = $this->db->getRow($sql);
		if ($res) {
			$sql = 'update gs_user set tokentime='.intval($user['tokentime']).', token=\''.$user['token'].'\', logintime='.time().', thirduid='.intval($user['thirduid']).' where id='.$res['id'];
			$this->db->query($sql);
			$user['id'] = $res['id'];
			$_SESSION[C('APP_USER_NAME').'_id'] = $res['id'];
			$_SESSION[C('APP_USER_NAME').'_userid'] = $res['username'];
			$_SESSION[C('APP_INDEX_NAME').'_userid'] = $res['username'];
			$_SESSION[C('APP_INDEX_NAME').'_thirduid'] = $user['thirduid'];
			//$_SESSION[C('APP_INDEX_NAME').'_thirdtotid'] = $res['thirdtotid'];
			return $user;
		}

		$data['username']  = $user['phone'];
		$data['name']  = $user['name'];
		$data['logintime'] = time();
		$data['token'] = $user['token'];
		$data['tokentime'] = intval($user['tokentime']);//本地存的是时间戳
		$data['register'] = time();
		$data['frompart'] = 1;//原始用户来源，三方同程接入
		$data['thirduid'] = intval($user['thirduid']);//原始用户来源uid，三方同程接入
		//$data['thirdtotid'] = intval($user['thirdproductid']);//原始用户产品id，三方同程接入
		$r = $this->db->insert($this->user,$data);
		if ($r) {
			//$_SESSION['token'] = $data['token'];
			//$_SESSION['tokentime'] = $data['tokentime'];
			$_SESSION[C('APP_USER_NAME').'_id'] = mysql_insert_id();
			$_SESSION[C('APP_USER_NAME').'_userid'] = $data['username'];
			$_SESSION[C('APP_INDEX_NAME').'_userid'] = $data['username'];
			$_SESSION[C('APP_INDEX_NAME').'_thirduid'] = $data['thirduid'];
			//$_SESSION[C('APP_INDEX_NAME').'_thirdtotid'] = $data['thirdproductid'];
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
		$data = json_encode($param);
		$retJson = false;
		$setHeader = true;
		$res = do_post($url,$data,$retJson,$setHeader);
		return $res;
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
		$array = array('3'=>'良好','良好','优秀');
		//报告数据
		$id = $_GET['id'] = empty($_GET['id'])?1:$_GET['id']+0;
		/*$key = $_GET['k'];
		if (md5(C('THIRD_KEY').$id) != $key) {
			echo 'key不对';
			exit;
		}*/
		$field = $this->baogaolist($id);
		if($field['cid']==6){ //酒精
			$field['content'] = explode(',',$field['content']);
			$field['contentCT'] = array();//类似AA;
			foreach($field['content'] as $v){
				$v = explode('=',$v);
				$field['contentCT'][$v[0]] = $v;
			}
			//特长
			$sql = 'select * from '.$this->bg_zheye.' where cid='.$field['cid'];
			$zheye = $this->db->getAll($sql);

			$new_zheye = array();
			$tilestr = '';//获取基因信息，如位点等
			foreach($zheye as $k => &$v){
				$zheye[$k]['fenshu'] = '';
				$v['title'] = explode(',',$v['title']);
				$v['value'] = explode(',',$v['value']);
				foreach($v['title'] as $l => &$j){
					$j = trim($j);
					$tilestr .= '\''.$j.'\',';
					if(!empty($field['contentCT'][$j])){
						if ($j == 'rs1229984') {
							switch ($field['contentCT'][$j][1]) {
								case 'GG':
									$field['contentCT'][$j][3]='乙醇代谢慢';
									break;
								case 'AG':
									$field['contentCT'][$j][3]='乙醇代谢较快';
									break;
								case 'AA':
									$field['contentCT'][$j][3]='乙醇代谢快';
									break;
								case 'GA':
									$field['contentCT'][$j][3]='乙醇代谢较快';
									break;
								default:
									$field['contentCT'][$j][3]='未知';
									break;
							}
						} else {
							switch ($field['contentCT'][$j][1]) {
								case 'GG':
									$field['contentCT'][$j][3]='乙醛代谢快，喝酒不易脸红';
									break;
								case 'AG':
									$field['contentCT'][$j][3]='乙醛代谢慢，喝酒易脸红';
									break;
								case 'AA':
									$field['contentCT'][$j][3]='乙醛代谢慢，喝酒易脸红';
									break;
								case 'GA':
									$field['contentCT'][$j][3]='乙醛代谢慢，喝酒易脸红';
									break;
								default:
									$field['contentCT'][$j][3]='未知';
									break;
							}

						}
						$zheye[$k]['fenshu'] .= $field['contentCT'][$j][1];
						
					}
					$v['CT'][$j] = $field['contentCT'][$j];
				}
				if($zheye[$k]['fenshu']=='GGAG' || $zheye[$k]['fenshu']=='GGGA'){//1
					$zheye[$k]['fenshu1'] = 3;
					$zheye[$k]['result'] = '弱';
					$zheye[$k]['common'] = '奈酒量微增——还是弱';
					$zheye[$k]['ping'] = 1.1;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力一般，与您基因型相同人群的酒精代谢能力多数为一般，且酒量在1.1瓶啤酒左右。您分解乙醇的能力是正常的，分解乙醛的速度慢，过快的乙醇分解速度导致短时间内大量乙醛积累。酒红初上脸边霞，一场春梦日西斜。您喝酒是容易“上脸”滴，与您相同基因型的人群，有92.16%都是易脸红的。这是因为您的乙醛脱氢酶活性良好，一下子分解不了太多的乙醛，过多的乙醛使人脸红。酒量不多容我醒，喝酒无奈多吃菜......送您一句话：感情厚，别喝难受；感情铁，别喝出血。';
					$zheye[$k]['gushi'] = '据说刘怜经常抱着一壶酒乘车，命仆人提著锄头跟在车子后面跑，并说道：如果我醉死了，便就地把我埋葬了。这种精神，和那些带着棺材上战场的将军有得一拼。有一次，他喝醉了酒跟镇上人吵架，对方生气地卷起袖子，挥拳就要打他，刘伶却很镇定从容地说：我这像鸡肋般细瘦的身体，不足以使您的拳头舒服啊。对方听了，笑了起来，终於把拳头放了下来。  还有一次，他的酒病又发作得很厉害，要求妻子拿酒，他的妻子哭着把剩下的酒洒在地上，又摔破了酒瓶子，涕泗纵横地劝他说：你酒喝得太多了，这不是养生之道，请你一定要戒了吧！刘伶回答说：好呀！可是靠我自己的力量是没法戒酒的，必须在神明前发誓，才能戒得掉。就烦你准备酒肉祭神吧。他的妻子信以为真，听从了他的吩咐。于是刘伶把酒肉供在神桌前，跪下来祝告说：天生刘伶，以酒为名；一饮一斛，五斗解酲。妇人之言，慎不可听。说完，取过酒肉，结果又喝得大醉了。
';
				}elseif($zheye[$k]['fenshu']=='GGAA'){//1
					$zheye[$k]['fenshu1'] = 3;
					$zheye[$k]['result'] = '弱';
					$zheye[$k]['common'] = '主人许我轻狂，奈酒量——从来最弱';
					$zheye[$k]['ping'] = 1;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力一般，与您基因型相同人群的酒精代谢能力多数为一般，且酒量在1瓶啤酒左右。您分解乙醇的代谢能力一般，同时分解乙醛的代谢能力也一般。陈酿香浓一口饮，只叹脸红不胜酒。您喝酒是容易“上脸”滴，这是因为您的乙醛脱氢酶活性太一般，分解乙醛的速度慢。所以虽然酒逢知己千杯少，但是苦无酒量能陪饮。分解酒精的两种酶活性都一般不是您的错，但是不能喝还要强撑的话是您的不对哦，毕竟您的体质是容易酒精中毒的，是不是一种淡淡的忧桑袭来......送您一句话：酒逢知己千杯少，能喝多少喝多少，喝不了就赶紧跑。';
					$zheye[$k]['gushi'] = '太守与客来饮于此，饮少辄醉，而年又最高，故自号曰醉翁也。醉翁之意不在酒，在乎山水之间也。山水之乐，得之心而寓之酒也。  良好喜欢喝酒的人都不会承认自己酒量不行，欧阳修却毫不在乎地说自己年纪大了，酒量不复当年，喝一点点就醉，自号醉翁，真是可爱十足。颇有“我醉欲眠卿且去”的韵味。更难得的是，欧阳修不但酒醉，景也醉。千古名句“醉翁之意不在酒，在乎山水之间也”境界不是良好的高。';
				}elseif($zheye[$k]['fenshu']=='GGGG'){//1
					$zheye[$k]['fenshu1'] = 4.5;
					$zheye[$k]['result'] = '强';
					$zheye[$k]['common'] = '一人我饮酒醉——有点强';
					$zheye[$k]['ping'] = 2.5;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力较强，与您基因型相同人群的酒精代谢能力多数为较强，其中88.2%的人喝酒不易脸红，且酒量在2.5瓶啤酒左右。虽然您分解乙醇的酶活性一般，但分解乙醛的酶活性强，这意味着您喝了酒后，乙醇分解成的乙醛可以在体内被迅速分解，减少乙醛在身体内停留时间。相比与乙醇，乙醛对人体的毒性和伤害更强。虽然您的酒精代谢能力较强，但“酒量不禁频劝,便醉倒人侧。”也不是没有可能，所以您喝酒一定要慢慢喝，小口饮，给乙醇分解成乙醛足够时间。送您一句话：酒无情来人有情，少喝点酒我看行。';
					$zheye[$k]['gushi'] = '1959年3月，中共中央副主席朱德率中国党政代表团访问匈牙利。朱德是第一位访匈的新中国中央领导人，所以中国驻匈牙利的使馆人员都忙开了，大使特别吩咐厨师要做一道匈牙利的国菜——古雅斯（其实就是土豆烧牛肉）。但是要上什么酒呢？大使却犯愁了。朱德会喝酒，他老人家是四川人，四川名酒有五粮液；朱德与中国国酒茅台又有一段典故；匈牙利的国酒是托卡依酒。三种酒究竟该喝哪种，大使举棋不定，最后他还是决定由朱德自己定夺。 　　在大使馆的酒席上，大使问朱德：委员长，想喝什么酒。朱德随便地说：都可以，都可以。大使倒抽了一口气，朱委员长好厉害啊，一出口就点上匈牙利的国酒，幸好我有备无患。原来，大使将“都可以”听成是“托卡依”。 　　“托卡依”葡萄酒端上来后，朱德一喝，连连称赞：果然是好酒，好酒！大使开玩笑地问，委员长，要是有位匈牙利的官员问您，您认为是匈牙利的国酒好喝还是中国的茅台酒好喝？该怎么回答？朱德笑道：今天我是客人，您是主人，我受到了东道主的热情款待，十分感谢。这就好比一支管弦乐队，我只能说这把大提琴音域宽广，那支双簧管音色悦耳，各有各的长处。咱们当外交官的人都得学会说话的艺术。众人听了齐声称赞。
';
				}elseif($zheye[$k]['fenshu']=='AGAG' || $zheye[$k]['fenshu']=='AGGA'){//1
					$zheye[$k]['fenshu1'] = 4;
					$zheye[$k]['result'] = '一般';
					$zheye[$k]['common'] = '自知酒量防逾矩——一般';
					$zheye[$k]['ping'] = 2;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力良好，与您基因型相同人群的酒精代谢能力多数为良好，且酒量在2瓶啤酒左右。酒醒霞散脸边红，梦回山蹙眉间翠。您喝酒是容易“上脸”滴，这是因为您分解乙醇的速度较快，但过快的乙醇分解速度导致短时间内大量乙醛积累，而您的乙醛脱氢酶活性良好，代谢速度慢，一下子分解不了太多的乙醛，过多的乙醛使人脸红。与您相同基因型的人群，有92.16%都是易脸红的。“寻常酒量，喝酒不应分外豪”，只要感情有，喝什么都是酒，悠着点总是不会错的......送您一句话：万水千山总是情，少喝一杯我看行。';
					$zheye[$k]['gushi'] = '知章骑马似乘船，眼花落井水底眠。汝阳三斗始朝天，道逢麴车口流涎，恨不移封向酒泉。左相日兴费万钱，饮如长鲸吸百川，衔杯乐圣称避贤。宗之潇洒美少年，举觞白眼望青天，皎如玉树临风前。苏晋长斋绣佛前，醉中往往爱逃禅。李白斗酒诗百篇，长安市上酒家眠，天子呼来不上船，自称臣是酒中仙。张旭三杯草圣传，脱帽露顶王公前，挥毫落纸如云烟。  焦遂五斗方卓然，高谈雄辩惊四筵。杜甫在这首诗中写了八位爱喝酒的名人：李白、贺知章、李适之、李琎、崔宗之、苏晋、张旭、焦遂。他们或因醉酒发生窘态，耗费万钱，或因醉酒诗兴大发，落笔如飞，总之，每一位都对酒十分痴迷，堪称酒仙。';
				}elseif($zheye[$k]['fenshu']=='AGAA'){//1
					$zheye[$k]['fenshu1'] = 3;
					$zheye[$k]['result'] = '弱';
					$zheye[$k]['common'] = '愧我无酒量——弱';
					$zheye[$k]['ping'] = 1.1;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力一般，与您基因型相同人群的酒精代谢能力多数为一般，且酒量在1.1瓶啤酒左右。您乙醇分解速度较快，但乙醛分解能力一般。三杯竹叶穿心过，两朵桃花上脸来。您喝酒是容易“上脸”滴，这是因为您的乙醛脱氢酶活性一般，一下子分解不了太多的乙醛。千杯不醉，臣妾做不到啊。让我静一静，给我来碗“淡淡的忧伤面”。没有？那来碗担担面吧，多吃菜来少喝酒，不伤肝胃命长久。送您一句话：只要感情好，能喝多少，喝多少；只要感情深，不管一口闷不闷。点点滴滴都是情。';
					$zheye[$k]['gushi'] = '丰子恺因牙疼去医院拔牙，大夫嘱道：未愈期间不准饮酒。这下可难住了嗜酒如命的丰老先生。不听话吧，牙病要作怪，听话不喝吧，又是万万的舍不得。勉强按捺几天后，已是坐立不安，心痒难熬。最后，他终于想出了一个绝妙的办法：取一支干净的玻璃吸管，吸入几滴酒后，射到喉部直咽下去。这样既不让酒润到病牙，又暂时解了酒瘾。殊不知饮酒上火，并不是避开牙齿就太平无事的。牙病痊愈后，丰子恺特地写了一篇《口中剿匪记》，以恢谐的笔调历数因牙病使他不得饮酒的苦处。';
				}elseif($zheye[$k]['fenshu']=='AGGG'){//1
					$zheye[$k]['fenshu1'] = 5;
					$zheye[$k]['result'] = '强';
					$zheye[$k]['common'] = '胸次无忧酒量宽——最强';
					$zheye[$k]['ping'] = 3;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力强，与您基因型相同人群的酒精代谢能力多数为强，其中88.2%的人喝酒不易脸红，且酒量在3瓶啤酒左右。您分解乙醇的酶活性良好，同时分解乙醛的酶活性强，这意味着您喝了酒后，乙醇分解成乙醛的速度较快，同时，乙醛的分解速度也很快，正好匹配乙醇的分解速度，这样前后两个酶合作相得益彰，大大增加了您的酒精分解速度。您的酒量是当之无愧的NO.1，“会当凌绝顶，一览众山小。”无敌是多么的寂寞......送您一句话：莫言酒量全输我，自古喝酒误事多，英雄也要少点喝。';
					$zheye[$k]['gushi'] = '段誉未喝第三碗酒时，已感烦恶欲呕，待得又是半斤烈酒灌入腹中，五脏六腑似乎都欲翻转。他紧紧闭口，不让腹中酒水呕将出来。突然间丹田中一动，一股真气冲将上来，只觉此刻体内的翻搅激荡，便和当日真气无法收纳之时的情景极为相似，当即依着伯父所授的法门，将那股真气纳入大椎穴。体内酒气翻涌，竟与真气相混，这酒水是有形有质之物，不似真气内力可在穴道中安居。他却也任其自然，让这真气由天宗穴而肩贞穴，再经左手掌臂上的小海、支正、养老诸穴而通至手掌上的阳谷、后豁、前谷诸穴，由小指的少泽穴中倾泻而出。他这时所运的真气线路，便是六脉神剑中的“少泽剑”。少泽剑本来是一股有劲无形的剑气，这时他小指之中，却有一道酒水缓缓流出。初时段誉尚未察觉，但过不多时，头脑便感清醒，察觉酒水从小指尖流出，暗叫：“妙之极矣！”他左手垂向地下，那大汉（乔峰）并没留心，只见段誉本来醉眼，但过不多时，便即神采奕奕，不禁暗暗生奇，笑道：“兄台酒量居然倒也不一般，果然有些意思。”又斟了两大碗……（《天龙八部》第十四章　剧饮千杯男儿事）小酒量的段誉因为作弊，和千杯不醉的乔峰居然连干了四十碗高粱酒。想想乔峰被坑得一无所知，也是蛮有趣的。';
				}elseif($zheye[$k]['fenshu']=='AAAG' || $zheye[$k]['fenshu']=='AAGA'){//1
					$zheye[$k]['fenshu1'] = 3.5;
					$zheye[$k]['result'] = '一般';
					$zheye[$k]['common'] = '一人我饮酒醉——一般';
					$zheye[$k]['ping'] = 1.5;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力良好，与您基因型相同人群的酒精代谢能力多数为良好，且酒量在1.5瓶啤酒左右。“酣天酒、芳脸潮红”，您喝酒是容易“上脸”滴，这是因为您分解乙醇的速度很快，但过快的乙醇分解速度导致短时间内大量乙醛积累，而您的乙醛脱氢酶活性良好，代谢速度慢，一下子分解不了太多的乙醛，过多的乙醛使人脸红。与您相同基因型的人群，有92.16%都是易脸红的。“朝辞白帝彩云间，我的酒量真良好。”酒桌上，为了不伤感情，可以喝；为了不伤身体，少喝点，量力而为。送您一句话：人在江湖走，不能多喝酒。';
					$zheye[$k]['gushi'] = '东汉•班固《汉书•陈遵传》载：遵嗜酒，每大饮，宾客满堂，辄关门，取客车辖投井中。虽有急，终不得去。为了避免客人喝酒中途走掉，居然把客人的车辖丢到井中，真是难以想象，要是客人家发生火灾等事咋办？';
				}elseif($zheye[$k]['fenshu']=='AAAA'){//1
					$zheye[$k]['fenshu1'] = 3;
					$zheye[$k]['result'] = '弱';
					$zheye[$k]['common'] = '向来酒量常嫌窄——有点弱';
					$zheye[$k]['ping'] = 1;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力一般，与您基因型相同人群的酒精代谢能力多数为一般，且酒量在1瓶啤酒左右。您分解乙醇的能力是正常的，乙醛分解能力一般，过快的乙醇分解速度导致短时间内大量乙醛积累。美酒一杯醉心扉，面颊桃红兴致归。您喝酒是容易“上脸”滴，这是因为您的乙醛脱氢酶活性太一般，一下子分解不了太多的乙醛。我只能说，我是亚洲人，我骄傲；我是“亚洲红”，我骄傲；我为“亚洲”带盐......送您一句话：感情薄，要喝倒；感情厚，不喝透；感情铁，喝一些。';
					$zheye[$k]['gushi'] = '醉里且贪欢笑，要愁那得工夫。近来始觉古人书，信著全无是处。  昨夜松边醉倒，问松“我醉何如”。只疑松动要来扶，以手推松曰“去”。 辛弃疾这首《西江月•遣兴》和鲁智深喝醉后把寺庙门口金刚当成大汉，堪称异曲同工。风吹树枝摇动，还以为有人要来扶他，以手推之，叫他去去去，这种我没醉，不要你扶的态度与欧阳修的醉翁、李白的“我欲醉眠卿且去”相互对比还是满有意思的。';
				}elseif($zheye[$k]['fenshu']=='AAGG'){//1
					$zheye[$k]['fenshu1'] = 4.5;
					$zheye[$k]['result'] = '强';
					$zheye[$k]['common'] = '白玉舟横酒量宽——强';
					$zheye[$k]['ping'] = 2.6;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力强，与您基因型相同人群的酒精代谢能力多数为强，其中88.2%的人喝酒不易脸红，且酒量在2.6瓶啤酒左右。您分解乙醇和乙醛的酶活性都强，这意味着您喝了酒后，乙醇迅速被分解成乙醛，同时，乙醛的分解速度也很快，前后两个酶合作相得益彰，大大增加了您的酒精分解速度。但是过快的乙醇分解速度，也会导致乙醛的少量积累，所以您的酒量只能屈居第二，不能算是最强的，但也是出类拔萃的。“莫笑杯中酒量减，至和全在半醺时。”男人少喝酒，幸福能长久。送您一句话：革命小酒要少喝，誓死保护胃粘膜。';
					$zheye[$k]['gushi'] = '贺龙元帅从13岁起便出外谋生，随着年龄的增长，贺龙慢慢开始喝酒，后来还以“喝酒”为名拉出了一个军，成为历史的奇迹。那是1915年冬，湖南革命党授命19岁的贺龙到石门泥沙镇组织军队，准备发起反袁暴动。到达泥沙镇后，交游广阔的贺龙即在“张本纪面馆”摆下了四桌酒席，召来了团防局的旧友新交。酒席开始后，觥筹交错间，贺龙借故离开，他随即拿了一把锋利的菜刀带着谷彩之等十人奔到团防局大门口，下了哨兵的枪，冲进屋里活捉了毫无反应的局长、队长，缴获了二十支“汉阳造”步枪。稍后，贺龙又带领众人一枪未发缴了团防局的武装，发展了三百多人，打出了“湘西讨袁独立军”的旗号。 　　1928年1月16日，贺龙、周逸群、卢冬生等在洪湖地区乌林镇腰口一家小酒馆里喝酒时，听说洪湖上游的观音洲上驻了一个国民党团防队，他们名义上是查共产党，实际上是以抢劫为主。闻此消息，贺龙率领众人缴了团防的枪，杀了反动透顶、穷凶极恶的队长黑牙张。贺龙此举声震湘鄂西，使敌人闻之胆寒，人民欢欣鼓舞，这其中不无“酒”的功劳。';
				}elseif($zheye[$k]['fenshu']=='GAAG' || $zheye[$k]['fenshu']=='GAGA'){//1
					$zheye[$k]['fenshu1'] = 4;
					$zheye[$k]['result'] = '一般';
					$zheye[$k]['common'] = '自知酒量防逾矩——一般';
					$zheye[$k]['ping'] = 2;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力良好，与您基因型相同人群的酒精代谢能力多数为良好，且酒量在2瓶啤酒左右。酒醒霞散脸边红，梦回山蹙眉间翠。您喝酒是容易“上脸”滴，这是因为您分解乙醇的速度较快，但过快的乙醇分解速度导致短时间内大量乙醛积累，而您的乙醛脱氢酶活性良好，代谢速度慢，一下子分解不了太多的乙醛，过多的乙醛使人脸红。与您相同基因型的人群，有92.16%都是易脸红的。“寻常酒量，喝酒不应分外豪”，只要感情有，喝什么都是酒，悠着点总是不会错的......送您一句话：万水千山总是情，少喝一杯我看行。';
					$zheye[$k]['gushi'] = '知章骑马似乘船，眼花落井水底眠。汝阳三斗始朝天，道逢麴车口流涎，恨不移封向酒泉。左相日兴费万钱，饮如长鲸吸百川，衔杯乐圣称避贤。宗之潇洒美少年，举觞白眼望青天，皎如玉树临风前。苏晋长斋绣佛前，醉中往往爱逃禅。李白斗酒诗百篇，长安市上酒家眠，天子呼来不上船，自称臣是酒中仙。张旭三杯草圣传，脱帽露顶王公前，挥毫落纸如云烟。  焦遂五斗方卓然，高谈雄辩惊四筵。杜甫在这首诗中写了八位爱喝酒的名人：李白、贺知章、李适之、李琎、崔宗之、苏晋、张旭、焦遂。他们或因醉酒发生窘态，耗费万钱，或因醉酒诗兴大发，落笔如飞，总之，每一位都对酒十分痴迷，堪称酒仙。';
				}elseif($zheye[$k]['fenshu']=='GAAA'){//1
					$zheye[$k]['fenshu1'] = 3;
					$zheye[$k]['result'] = '弱';
					$zheye[$k]['common'] = '愧我无酒量——弱';
					$zheye[$k]['ping'] = 1.1;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力一般，与您基因型相同人群的酒精代谢能力多数为一般，且酒量在1.1瓶啤酒左右。您乙醇分解速度较快，但乙醛分解能力一般。三杯竹叶穿心过，两朵桃花上脸来。您喝酒是容易“上脸”滴，这是因为您的乙醛脱氢酶活性一般，一下子分解不了太多的乙醛。千杯不醉，臣妾做不到啊。让我静一静，给我来碗“淡淡的忧伤面”。没有？那来碗担担面吧，多吃菜来少喝酒，不伤肝胃命长久。送您一句话：只要感情好，能喝多少，喝多少；只要感情深，不管一口闷不闷。点点滴滴都是情。';
					$zheye[$k]['gushi'] = '丰子恺因牙疼去医院拔牙，大夫嘱道：未愈期间不准饮酒。这下可难住了嗜酒如命的丰老先生。不听话吧，牙病要作怪，听话不喝吧，又是万万的舍不得。勉强按捺几天后，已是坐立不安，心痒难熬。最后，他终于想出了一个绝妙的办法：取一支干净的玻璃吸管，吸入几滴酒后，射到喉部直咽下去。这样既不让酒润到病牙，又暂时解了酒瘾。殊不知饮酒上火，并不是避开牙齿就太平无事的。牙病痊愈后，丰子恺特地写了一篇《口中剿匪记》，以恢谐的笔调历数因牙病使他不得饮酒的苦处。';
				}elseif($zheye[$k]['fenshu']=='GAGG'){//1
					$zheye[$k]['fenshu1'] = 5;
					$zheye[$k]['result'] = '强';
					$zheye[$k]['common'] = '胸次无忧酒量宽——最强';
					$zheye[$k]['ping'] = 3;
					$zheye[$k]['fenxi'] = '您的基因检测结果是酒精代谢能力强，与您基因型相同人群的酒精代谢能力多数为强，其中88.2%的人喝酒不易脸红，且酒量在3瓶啤酒左右。您分解乙醇的酶活性良好，同时分解乙醛的酶活性强，这意味着您喝了酒后，乙醇分解成乙醛的速度较快，同时，乙醛的分解速度也很快，正好匹配乙醇的分解速度，这样前后两个酶合作相得益彰，大大增加了您的酒精分解速度。您的酒量是当之无愧的NO.1，“会当凌绝顶，一览众山小。”无敌是多么的寂寞......送您一句话：莫言酒量全输我，自古喝酒误事多，英雄也要少点喝。';
					$zheye[$k]['gushi'] = '段誉未喝第三碗酒时，已感烦恶欲呕，待得又是半斤烈酒灌入腹中，五脏六腑似乎都欲翻转。他紧紧闭口，不让腹中酒水呕将出来。突然间丹田中一动，一股真气冲将上来，只觉此刻体内的翻搅激荡，便和当日真气无法收纳之时的情景极为相似，当即依着伯父所授的法门，将那股真气纳入大椎穴。体内酒气翻涌，竟与真气相混，这酒水是有形有质之物，不似真气内力可在穴道中安居。他却也任其自然，让这真气由天宗穴而肩贞穴，再经左手掌臂上的小海、支正、养老诸穴而通至手掌上的阳谷、后豁、前谷诸穴，由小指的少泽穴中倾泻而出。他这时所运的真气线路，便是六脉神剑中的“少泽剑”。少泽剑本来是一股有劲无形的剑气，这时他小指之中，却有一道酒水缓缓流出。初时段誉尚未察觉，但过不多时，头脑便感清醒，察觉酒水从小指尖流出，暗叫：“妙之极矣！”他左手垂向地下，那大汉（乔峰）并没留心，只见段誉本来醉眼，但过不多时，便即神采奕奕，不禁暗暗生奇，笑道：“兄台酒量居然倒也不一般，果然有些意思。”又斟了两大碗……（《天龙八部》第十四章　剧饮千杯男儿事）小酒量的段誉因为作弊，和千杯不醉的乔峰居然连干了四十碗高粱酒。想想乔峰被坑得一无所知，也是蛮有趣的。';
				}
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
						}
					}
				}
			}
			krsort($new_zheye);
			$this->zheye = $new_zheye;
			$this->fzheye = $zheye;
			$this->field = $field;

			$this->fzheye['0']['fenshu'] = sprintf( "%.0f",$this->fzheye['0']['fenshu']);
			$this->avg = 46;
			$this->display('baogao4_jiujing4');

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
							print_r($temp[$key]);exit;
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
				if ($this->fzheye['4']['fenshu1'] == 5) {
					$this->fenxi = "您对紫外线抗过敏能力较强，但是夏季天气炎热，紫外线强烈，还是要特别注意防晒的，要做好相应的防护措施如：佩戴太阳伞、太阳帽、披风、擦防晒霜、保湿水等。";
				} elseif ($this->fzheye['4']['fenshu1'] == 4) {
					$this->fenxi = "2、您对紫外线抗过敏能力良好，所以在炎热的夏季，紫外线强烈，要特别注意防晒，要做好相应的防护措施如：佩戴太阳伞、太阳帽、披风、擦防晒霜、保湿水等，减少出门几率。";
				} else {
					$this->fenxi = "3、您对紫外线抗过敏能力较低，在炎热的夏季，紫外线强烈，要特别注意防晒，要做好相应的防护措施如：佩戴太阳伞、太阳帽、披风、擦防晒霜、保湿水等，减少出门几率。在日常生活中，要避免长时间的日晒，也不要使用碱性肥皂、不要用低劣粗糙的毛巾擦脸，尽量保持皮肤柔润。";
				}
				
				$this->avg = 63;
				$this->fzheye['4']['fenshu'] = sprintf( "%.0f",$this->fzheye['4']['fenshu']);
				$this->display('baogao4_merrong4');
			} elseif($field['cid']==2) {
				if ($this->fzheye['2']['fenshu1'] == 5) {
					$this->fenxi = "运动能力强，运动量大的话，建议多补充营养物质，合理安排运动量。";
				} elseif ($this->fzheye['2']['fenshu1'] == 4) {
					$this->fenxi = "运动能力良好，建议多参加体育运动，注意运动前做好准备活动，选择合适运动量，防止运动时受伤。";
				} else {
					$this->fenxi = "运动能力一般，建议多参加体育运动，生命在于运动，选择合适的运动项目，提高免疫力和身体素质。";
				}
				$this->fzheye['2']['fenshu'] = sprintf( "%.0f",$this->fzheye['2']['fenshu']);
				$this->avg = 46;
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
						if ($vkey=='rs662799') {
							if ($vvalue[2] == 100) {
								$zstate = '好';
							} elseif ($vvalue[2] == 50) {
								$zstate = '一般';
							} else {
								$zstate = '不好';
							}
						} elseif ($vkey=='rs1801282') {
							if ($vvalue[2] == 100) {
								$dstate = '好';
							} elseif ($vvalue[2] == 50) {
								$dstate = '一般';
							} else {
								$dstate = '不好';
							}
						} elseif ($vkey=='rs4994') {
							if ($vvalue[2] == 100) {
								$rstate = '好';
							} elseif ($vvalue[2] == 50) {
								$rstate = '一般';
							} else {
								$rstate = '不好';
							}
						} else {
							if ($vvalue[2] == 100) {
								$ystate = '好';
							} elseif ($vvalue[2] == 50) {
								$ystate = '一般';
							} else {
								$ystate = '不好';
							}
						}
						$feipang['CT'][$vkey] = $vvalue;
					}
					$feipang['fenshu'] += $zvalue['fenshu'];
					$feipang['fenshu1'] += $zvalue['fenshu1'];
					$feipang['totalscore'] += $zvalue['totalscore'];
					$feipang['good'] += $zvalue['good'];
					$feipang['common'] += $zvalue['common'];
					$feipang['excellent'] += $zvalue['excellent'];
				}
				$this->fenxi = '控制脂肪摄入效果'.$zstate.',控制高热量食物减肥效果'.$rstate.',摄入单不饱和脂肪酸效果'.$dstate.',运动减肥效果'.$ystate.'。';
				$feipang['fenshu1'] = sprintf( "%.0f",$feipang['fenshu1']/4);
				$feipang['fenshu'] = sprintf( "%.0f",$feipang['fenshu']/4);
				$this->avg = 58;//造假数据
				$this->feipang = $feipang;
				$this->display('baogao4_feipang4');
			}
		
		}
	}

	/**
	 *第三方商品列表
	 */
	function goodlist() {
		//$ids = '21,23,24,25';//得到商品ID
		$ids = '7,8,9,10';//得到商品ID
		//得到商品详细并得到商品搭配列表
		$sql = 'select g.*,b.brand_name from '.$this->goods.' as g left join '.$this->brand.' as b on g.brand_id=b.brand_id where goods_id in(' .$ids. ') order by rank desc';
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
		/*$_SESSION[C('APP_INDEX_NAME').'_thirdtotid'] = 1;
		$_SESSION['thirdusername'] = '童宇涛';
		$_SESSION['user_id'] = 197;
		$_SESSION[C('APP_INDEX_NAME').'_userid'] = '13758267885';
		$_SESSION[C('APP_INDEX_NAME').'_thirduid'] = 4318901;*/
		if (empty($_SESSION[C('APP_INDEX_NAME').'_thirduid']) || empty($_POST['goods_id'][0])) {
			exit;
		}
		//判断是否上线
		if(empty($_SESSION['user_id'])){
			$this->error('您还没有登录请先登录！','/index/Index/loginurl');	exit;	
		}
		$sql = 'select * from '.$this->goods.' where is_on_sale=1 and  goods_id='.intval($_POST['goods_id'][0]);
		$num = $this->db->getNum($sql);
		if(empty($num)){
			$this->error('该产品暂未上线，尽请期待！');
		}
		//查看该用户是否已经激活，已经使用了激活，不给再激活,激活后thirdtoid字段会被变0
		$sql ='select u.id,u.username from gs_user u left join gs_indent i on i.user_id=u.id where i.i_type=11 and u.id="'.$_SESSION['user_id'].'"';
		$res = $this->db->getRow($sql);
		if ($res) {
			echo '<script type="text/javascript">';
			$url = C('THIRD_URL');
			echo 'alert("您已经激活，请等待报告结果");';
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			exit;
		}

		$goods = array();
		foreach($_POST['goods_id'] as $k=>$v){
			$goods[$k]['goods_id'] 	= $v;
			$goods[$k]['number']    = $_POST['number'][$k];
		}
		$this->shopping = $this->IntegrationGoods($goods);
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
				$sql_price = 'select shop_price,goods_name from '.$this->goods.' where goods_id='.$goods_id;
				$r1 = $this->db->getRow($sql_price);
				$_POST['price'] += $r1['shop_price'] * $v;
				$sql .= "(000,$goods_id,$uid,$v,".$r1['shop_price']."),";
			}
		}
		$sql = trim($sql,',');
		//通知同程通知同程权益递减
		$param['url'] = 'http://m.ly.com/itravel/Home/Interest';
		$param['date'] = $_SESSION['tokentime'];
		$param['token'] = $_SESSION['token'];
		$param['supplier'] = '23mima';
		$param['interesttype'] = 3;
		$param['userid'] = $_SESSION[C('APP_INDEX_NAME').'_thirduid'];
		$param['productId'] = $goods_id;
		$param['productName'] = urlencode($r1['goods_name']);
		$param['tel'] = $_POST['mobile'];
		$param['address'] = $_POST['province'].$_POST['city'].$_POST['country'].$_POST['address'];
		$param['sign'] = md5(C('THIRD_KEY').$param['interesttype'].$param['userid'].$param['productId']);
		$notifyRes = $this->notifyThirdPart($param);
		if ($notifyRes->IsSuccess != 'true') {
			var_dump($param);
			echo json_encode($notifyRes);exit;
		}

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
		$psql = 'update gs_user set thirdtoid='.intval($goods_id).' where id='.$uid;
		$res = $this->db->query($psql);//购买了那些产品
		$r = $this->db->insert($this->indent,$data);
		$indent_id = mysql_insert_id();
		$sql = str_ireplace("(000,","(".$indent_id.',',$sql);
		$r1 = $this->db->query($sql);
		if (empty($r) || empty($r1) || empty($res) ) {
	        mysql_query('rollback');
	        $this->success('订单出错！请重新提交！',U('Index/index'));
	    }else{
	        mysql_query('commit');
			$url = C('THIRD_URL');
			echo $url;


			/*echo '<script type="text/javascript">';
			$tips = '基因检测流程及注意事项：\n您的权益激活后，工作人员会在两个工作日内给你邮寄基因检测采样盒(用户选择到付)；\n收到采样盒后，请仔细阅读采样说明书进行采样，并按提示回寄采样盒，地址详见说明书；\n收到您的采样盒后，约10个工作日内出具检测报告，请在臻旅会员个人中心基因检测项中查看电子检测报告；\n如有任何疑问，请致电400-109-2599。';
			echo 'alert("'.$tips.'");';
			$url = C('THIRD_URL');
			echo 'window.location.href="'.$url.'";';
			echo '</script>';*/
	        //$this->success('激活成功',C('THIRD_URL'));
	        //原来是跳转支付页面现在直接默认开通成功
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