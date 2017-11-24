<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($zheye['name'])){echo $zheye['name'];} ?>_我的报告</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/xtc_z_bg.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000 topnav">
		
			<div class="left"><a href='<?php echo U("/Index/baogao/id/$_GET[id]") ?>'>我的报告</a>｜<span>报告概览</span></div>
			<div class="right">
				<?php $this->display('baogao','lib') ?>
			</div>
		
	</div>
	<div style="background:#f6f6f7">
		<div class="w1000 overflow">
			<div class="row toptitle">
				<h3 class="titlec"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?></h3>
				<span>
				<?php
				for($i=1;$i<=5;$i++){
	                if($i<=$_GET['f']){
	                  echo '<img src="/public/gaiban/images/tal_star.png" />';
	                }else{
	                  //echo '<span class="talg-star pictures"></span>';
	                }
              	}
				?>
				</span>
				<p><?php if(isset($zheye['name'])){echo $zheye['name'];} ?><?php echo $array[$_GET['f']]?></p>
			</div>
		</div>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left"><h3 class="titlec1">检测内容<img src="/public/gaiban/images/xtc (4).jpg" height="108"/></h3></div>
			<div class="right">
				<div id="container" style="min-width:400px;height:200px"></div>
				<table>
					<thead>
						<tr>
							<th>基因</th><th>基因能力</th><th>基因型</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($zheye['title'] as $v){ ?>
						<tr>
							<td><?php echo $jiyin_new[$v]['title_c'];?></td>
							<td><?php echo $jiyin_new[$v]['name'];?></td>
							<td><?php echo $field['content1'][$v][1];?></td>
							
						</tr>
						<?php } ?>
						
					</tbody>
				</table>
				
			</div>
			
			<div class="ck1">
					<a href="/content_<?php if(isset($zheye['typeid'])){echo $zheye['typeid'];} ?>.html">参考文献</a>
			</div>
		</div>
	</div>
	<?php 
				$gl1=(rand(1,9))/10+5;
				$gl2=(rand(1,9))/10+30;
				$gl3=100-($gl1+$gl2);
				$gl3=sprintf("%.1f",$gl3);
				?>
		<div class="w1000 overflow">
			<div class="row">
				<?php 
					$length=strlen($zheye['name']);
					
					if($length==12){
						$x=35;
					}else if($length==15){
					    $x=25;
					}else if($length==18){
					    $x=10;
					}else if($length==9){
					    $x=45;
					}
				?>
				<div class="left">
				
					<svg height="350" version="1.1" width="275" xmlns="http://www.w3.org/2000/svg">
						<circle cx="125" cy="125" r="100" stroke="#68d7c6"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl1;?>" fill="none" x="125" y="125" r="100" stroke="#68d7c6"  stroke-width="24" />
						<text fill="<?php if($_GET['f']==5){echo '#68d7c6';}else{echo '#c9c9c9';}?>">
							<tspan x='40' y='150' style="font-size:72px"><?php echo $gl1;?></tspan>
							<tspan x='145' y='145' style="font-size:36px">%</tspan>
							<tspan x='<?php echo $x;?>' y='320' style="font-size:30px"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?>优秀</tspan>
						</text>
					</svg>
					<svg height="350" version="1.1" width="275" xmlns="http://www.w3.org/2000/svg">
						<circle cx="125" cy="125" r="100" stroke="#fd5959"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl2;?>" fill="none" x="125" y="125" r="100" stroke="#fd5959"  stroke-width="24" />
						<text fill="<?php if($_GET['f']==4){echo '#fd5959';}else{echo '#c9c9c9';}?>">
							<tspan x='30' y='150' style="font-size:72px"><?php echo $gl2;?></tspan>
							<tspan x='175' y='145' style="font-size:36px">%</tspan>
							<tspan x='<?php echo $x;?>' y='320' style="font-size:30px"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?>良好</tspan>
						</text>
					</svg>
					<svg height="350" version="1.1" width="275" xmlns="http://www.w3.org/2000/svg">
						<circle cx="125" cy="125" r="100" stroke="#7d4d75"stroke-width="1" fill="#fff"/>
						<path class="ring" stroke-linecap="round" rate="<?php echo $gl3;?>" fill="none" x="125" y="125" r="100" stroke="#7d4d75"  stroke-width="24" />
						<text fill="<?php if($_GET['f']==3){echo '#7d4d75';}else{echo '#c9c9c9';}?>">
							<tspan x='30' y='150' style="font-size:72px"><?php echo $gl3;?></tspan>
							<tspan x='170' y='145' style="font-size:36px">%</tspan>
							<tspan x='<?php echo $x;?>' y='320' style="font-size:30px"><?php if(isset($zheye['name'])){echo $zheye['name'];} ?>一般</tspan>
						</text>
					</svg>
				</div>
				<div class="right">
					<h3 class="titlec2" style="overflow:hidden;">23密码<br/>多少人和我一样<img src="/public/gaiban/images/xtc (5).jpg" height="108"/></h3>
				</div>
			</div>
		</div>
	<div style="background:#f2f3f4">
		<div class="w1000 overflow">
			<div class="row">
				<div class="left">
				<h3 class="titlec3">教育建议<img src="/public/gaiban/images/xtc (6).jpg" height="108"/></h3>
			</div>
			<div class="left">
				<p class="jyadvice"><span style="font-size:18px">激发兴趣</span><br/>
				<?php if($_GET['f']==3){echo $zheye['jianyi2'];}else{echo $zheye['jianyi1'];}?></p>
			</div>
				
			</div>
		</div>
	</div>
	<div class="w1000">
		
			<img src="/public/baogao/tc/<?php echo $zheye['cid']?>-<?php echo $_GET['key']?>.jpg" width='1105'>
	
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left">
				<h3 class="titlec3">基因解读<img src="/public/gaiban/images/xtc (2).jpg" height="108"/></h3>
			</div>
			<div class="left advice">
				<?php if(isset($zheye['content1'])){echo $zheye['content1'];} ?>
			</div>
			
		</div>
	</div>
	<div class="w1000">
		<div class="row">
			<div class="left">
				<h3 class="titlec3">基因小故事<img src="/public/gaiban/images/xtc (3).jpg" height="108"/></h3>
			</div>
			<div class="left advice">
				<?php if(isset($zheye['content3'])){echo $zheye['content3'];} ?>
			</div>
			
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
<script src="/public/gaiban/js/fit_a.js"></script>
<script src="/public/gaiban/js/highcharts.js"></script>
<script >
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            categories: ['差', '一般', '良好','优秀'],
            gridLineWidth: 0,
            floor: 0
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '',
            enabled: false
        },
        series: [{
            name: 'Population',
            data: [
			<?php $color=array('#9CCBD5','#87D0C9','#68C6AE','#B3D893','#EDCB62','#E4A766'); ?>
			<?php foreach ($zheye['title'] as $k=>$v){ ?>
			{name:'<?php echo $jiyin_new[$v]['title_c'];?>',color:'<?php echo $color[$k];?>',y:
				
				<?php
				
				$fenshu = $field['content1'][$jiyin_new[$v]['title']][2];
				if($fenshu ==100){
					$fenshu1 = 3;
				}else if($fenshu ==90){
					$fenshu1 = 2;
				}else{
					$fenshu1 = 1;
				}
				echo $fenshu1;
				?>},
				
			<?php } ?>
               
                
            ],
            dataLabels: {
                enabled: false,
            }
        }]
    });
});
</script>
</html>