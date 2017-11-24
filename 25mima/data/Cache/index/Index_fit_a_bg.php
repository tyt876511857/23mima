<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>23密码 | 基因检测结果</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<meta name="renderer" content="webkit|ie-comp|ie-stand">

<link href="/public/gaiban/css/fit_a_bg.css" rel="stylesheet" type="text/css" />

<script language="javascript" src="/public/gaiban/js/jquery-1.8.3.min.js"></script>


<!--[if lt IE 9]>
    <script type="text/javascript" src="js/PIE_IE678.js"></script>
	</script>
    <![endif]-->
<!--[if gt IE 8]>
	<script type="text/javascript" src="js/PIE_IE9.js"></script>
 <![endif]-->


</head>
<body>
	<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000 topnav">
		
			<div class="left"><a>您的报告</a>｜<span>报告概览</span></div>
			<div class="right">
				<?php $this->display('baogao','lib') ?>
		        
			</div>
		
	</div>
	<div class="w1000">
		<div class="row">
			<span class="">您的报告</span>
			<h3><span>肥</span><span>胖</span><span>基</span><span>因</span></h3>
			<span class="">检测结果</span>
			<div class="tab">
				<div class="tabnav">
					<a href="javascript:;" class="active">肥胖简介</a>
					<a href="javascript:;">肥胖危害</a>
					<a href="javascript:;">肥胖高发期</a>
					<a href="javascript:;">肥胖主要原因</a>
					<a href="javascript:;">肥胖相关基因</a>
				</div>
				<div class="tabcont">
					<div class="cont show"><p><?php if(isset($field1['cont1'])){echo $field1['cont1'];} ?></p></div>
					<div class="cont"><p><?php if(isset($field1['cont2'])){echo $field1['cont2'];} ?></p></div>
					<div class="cont"><p><?php if(isset($field1['cont3'])){echo $field1['cont3'];} ?></p></div>
					<div class="cont"><p><?php if(isset($field1['cont4'])){echo $field1['cont4'];} ?></p></div>
					<div class="cont"><p><?php if(isset($field1['cont5'])){echo $field1['cont5'];} ?></p></div>
				</div>
			</div>
			
		</div>
	</div>
	<div style="background:#f2f3f4">
		<div class="w1000 overflow">
			<div class="row">
				<div class="left">
					<h3 class="titlec1">我的结果<img src="/public/gaiban/images/fit (2).jpg" height="108"/></h3>
					<div class="cont1">
						<div class="c1 first"><span>我的BMI</span><span class="sj"><?php echo $bmi; ?></span><span class="zt"><?php echo $bmi_shuoming; ?></span></div>
						<div class="c1"><span>总风险系数</span><span class="sj"><?php echo $zfxxs; ?></span><span class="zt"><?php if($zfxxs>1){echo '肥胖风险高';}else{echo '肥胖风险正常';} ?></span></div>
					</div>
				</div>
				<?php 
				$res = $this->db->getRow('select high,common from '.$this->fit_count);
				if (!empty($res['high']) && !empty($res['common'])){
					$total = $res['high']+$res['common'];
					$gl1 = round($res['high']/$total*100);
					$gl2 = round($res['common']/$total*100);;
				} else {
					$gl1=rand(0,5)+55;
					$gl2=100-$gl1;
				}
				?>
				<div class="right">
					<h3 class="titlec2">23密码 多少人和我一样<img src="/public/gaiban/images/fit (3).jpg" height="108"/></h3>
					<div class="cont1">
					<svg height="350" version="1.1" width="250" xmlns="http://www.w3.org/2000/svg">
						<circle cx="125" cy="125" r="100" stroke="#68d7c6"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl2;?>" fill="none" x="125" y="125" r="100" stroke="#68d7c6"  stroke-width="24" />
						<text fill="<?php if($zfxxs<=1){echo '#68d7c6';}else{echo '#c9c9c9';} ?>">
							<tspan x='55' y='150' style="font-size:72px"><?php echo $gl2;?></tspan>
							<tspan x='145' y='145' style="font-size:36px">%</tspan>
							<tspan x='40' y='320' style="font-size:36px">肥胖风险低</tspan>
						</text>
					</svg>
					<svg height="350" version="1.1" width="250" style="margin-left:50px" xmlns="http://www.w3.org/2000/svg">
						<circle cx="125" cy="125" r="100" stroke="#fd5959"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl1;?>" fill="none" x="125" y="125" r="100" stroke="#fd5959"  stroke-width="24" />
						<text fill="<?php if($zfxxs>1){echo '#fd5959';}else{echo '#c9c9c9';} ?>">
							<tspan x='55' y='150' style="font-size:72px"><?php echo $gl1;?></tspan>
							<tspan x='145' y='145' style="font-size:36px">%</tspan>
							<tspan x='40' y='320' style="font-size:36px">肥胖风险高</tspan>
						</text>
					</svg>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left">
				<h4 class="titlec">您的结果</h4>
				<table>
					<thead>
						<tr>
							<th>基因</th><th>检测位点</th><th>基因型</th><th>风险系数</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($fit1 as $v){ ?>
						<tr>
							<td><?php if(isset($v['title_c'])){echo $v['title_c'];} ?></td><td><?php if(isset($v['SNP'])){echo $v['SNP'];} ?></td><td><?php if(isset($v['jy'])){echo $v['jy'];} ?></td><td><?php if(isset($v['fs'])){echo $v['fs'];} ?></td>
						</tr>
					<?php } ?>
						
						
					</tbody>
				</table>
				
			</div>
			<div class="right"><h3 class="titlec1">基因明细<img src="/public/gaiban/images/fit (4).jpg" height="108"/></h3></div>
			<div class="ck">
					<a href="/index/Index/fit_z/id/<?php echo $id; ?>" target="_blank">检测结果解释</a><a class="ck_btn" href="javascript:;">参考文献</a>
			</div>
		</div>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left">
				<h3 class="titlec3">减肥建议<img src="/public/gaiban/images/fit (1).jpg" height="108"/></h3>
			</div>
			<div class="left">
				<p class="advice">
				<?php foreach ($jianyi as $k=>$item){ ?>
					<b><?php echo $k; ?>:</b><br/>
					<?php foreach ($item as $k1=>$v){ ?>
					<?php echo ($k1+1);?>.<?php if(isset($v['name'])){echo $v['name'];} ?><br />
					<?php } ?>
					<br/>
				<?php } ?>
				
				</p>
			</div>
			
		</div>
	</div>
	<div style="background:#f2f3f4">
		<div class="w1000 overflow">
			<div class="row">
			<?php foreach ($fit2 as $k=>$v){ ?>
				<a class="item" href="/index/Index/baogao1/id/<?php echo $id; ?>/key/<?php if(isset($v['id'])){echo $v['id'];} ?>/f/<?php if(isset($v['fs'])){echo $v['fs'];} ?>">
					<img src="/public/gaiban/images/fit (<?php echo ($k+5);?>).jpg" width="252px" height="301px" class="left"/>
					<div class="left">
						<p class="item_title1"><?php if(isset($v['name'])){echo $v['name'];} ?>对减肥的作用</p>
						<p class="item_title2"><?php if(isset($v['title_c'])){echo $v['title_c'];} ?><br/><?php if(isset($v['jg'])){echo $v['jg'];} ?></p>
						<span class="check">查看详情</span>
					</div>
				</a>
			<?php } ?>
				
				
			</div>
		</div>
	</div>
	
	<?php $this->display('index:Index:footer','lib') ?>
	<div class="ckwxs">
		<?php foreach ($articles as $k=>$v){ ?>
			<?php if(isset($v['content'])){echo $v['content'];} ?><br/>
		<?php } ?>
	</div>
	<div class="ckwxs_bg"></div>
	<script>
	$('.ck_btn').click(function(){
		$('.ckwxs').fadeIn();
		$('.ckwxs_bg').fadeIn();
	});
	$('.ckwxs_bg').click(function(){
		$('.ckwxs').fadeOut();
		$('.ckwxs_bg').fadeOut();
	});
	</script>
</body>
<script src="/public/gaiban/js/fit_a.js"></script>
</html>