<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
<?php $this->display('index:Index:css','lib') ?>
<link href="/public/gaiban/css/jmlx.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->display('index:Index:header','lib') ?>
	<div class="w1000">
		<div class="row">
			<h3 class="titlec"><span><img src="/public/gaiban/images/jm (1).jpg" /></span>加盟联系</h3>
			<div class="desc">
				 <h4>联系我们</h4>
				 <p>如有意向者，请点击进入”<a href="/news_18.html">申请加盟</a>“并提交您的申请信息，我公司将作统一审核后，邀请有意向者进一步洽谈合作细节。</p>
				<div >
					<div class="left">
						<p>如需了解有关加盟合作的相关信息，请向我公司加盟热线咨询。</p>
						<p>全国招商热线：400-109-2599（转1）<br/>全国招商邮箱：23mima@23mima.com</p>
					</div>
					<div class="right"><img src="/public/gaiban/images/jm (2).jpg" /></div>
				</div>
			</div>
		</div>
	</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>

</html>