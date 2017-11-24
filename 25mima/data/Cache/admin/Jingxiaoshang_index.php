<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>经销商列表</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>经销商列表</p></div>
  <table class="table" border="1" align="center">
	<tr><td colspan='12' text-align='right'>
	<a href="<?php echo U('/Jingxiaoshang/adduser') ?>" target="main">添加经销商</a>
	</td>
	</tr>
	
   <tr>
      <td width="2%">编号</td>
      <td width="10%">用户名</td>
      <td width="5%">qq</td>
      <td width="7%">邮箱</td>
      <td width="5%">姓名</td>
      <td width="10%">注册时间</td>
      <td width="10%">最后登陆时间</td>
      <td width="10%">登陆IP</td>
      <td width="5%">渠道</td>
      <td width="5%">二维码</td>
      <td width="5%">操作</td>
      <td width="5%">删除</td>
    </tr>
    <?php foreach ($list as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td style="line-height:28px;"><img style="float:left;" src="<?php if(isset($v['litpic'])){echo $v['litpic'];} ?>" width="28" height='28' /><?php if(isset($v['username'])){echo $v['username'];} ?></td>
        <td><?php if(isset($v['qq'])){echo $v['qq'];} ?></td>
        <td><?php if(isset($v['email'])){echo $v['email'];} ?></td>
        <td><?php if(isset($v['name'])){echo $v['name'];} ?></td>
        <td><?php echo date('y-m-d H:i:s',$v['register']) ?></td>
        <td><?php echo date('y-m-d H:i:s',$v['logintime']) ?></td>
        <td><a href="https://www.baidu.com/s?wd=<?php if(isset($v['loginip'])){echo $v['loginip'];} ?>" target="_blank"><?php if(isset($v['loginip'])){echo $v['loginip'];} ?></a></td>
        <td><?php if(isset($v['qudao'])){echo $v['qudao'];} ?></td>
        <td><a href="/admin/Jingxiaoshang/addcard?userid=<?php if(isset($v['id'])){echo $v['id'];} ?>" target="main">添加优惠码</a></td>
        <td><a href="http://cli.im/?http://23mima.com/index/Index/loginurl?parent_id=<?php if(isset($v['id'])){echo $v['id'];} ?>" target="_blank">生成二维码</a></td>
        <td>
          <a href='<?php echo U("/Member/delete/id/$v[id]") ?>' onclick="if(!confirm('您确定要移除这个会员吗？')){return false;};" title="移除">
            <img src="/Modules/admin/Tpl/public/images/icon_drop.gif" border="0" height="16" width="16" />
          </a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <ul id="page"><?php echo $showpage; ?></ul>
</div>
</body>
</html>