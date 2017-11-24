<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>23密码 | 基因检测结果</title>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/fit_z_bg.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php $this->display('index:Index:header','lib') ?>
	
	
	<div class="w1000">
		<div class="row">
			<h3 class="titlec">检查结果<img src="/public/gaiban/images/jiancebg.jpg" /></h3>
			<div class="desc">
				<table border="0">
				<tr class="first">
					<th>基因</th><th>基因</th><th>基因型</th><th>风险系数</th>
				</tr>
				<?php foreach ($fit1 as $v){ ?>
				<tr class="row-item">
					<td class="borderb"><?php if(isset($v['title_c'])){echo $v['title_c'];} ?></td><td class="borderb"><?php if(isset($v['SNP'])){echo $v['SNP'];} ?></td>
					<td class="borderb">
					<table>
					<?php foreach ($v['jys'] as $item){ ?>
						<tr>
							<td  class="borderb" <?php if($item['name']==$v['jy']){echo 'style="color:red"';} ?> ><?php if(isset($item['name'])){echo $item['name'];} ?></td>
						</tr>
					<?php } ?>
						
					</table>
					</td>
					<td class="borderb">
					<table>
					<?php foreach ($v['jys'] as $item){ ?>
						<tr>
							<td  class="borderb" <?php if($item['name']==$v['jy']){echo 'style="color:red"';} ?>><?php if(isset($item['sum'])){echo $item['sum'];} ?></td>
						</tr>
					<?php } ?>
						
					</table>
					</td>
				</tr>
				<?php } ?>
				
				
				
				</table>
					
				
			</div>
			
		</div>
	</div>
	
	<?php $this->display('index:Index:footer','lib') ?>
</body>

</html>