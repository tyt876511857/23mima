<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>添加优惠码</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>添加优惠码</p></div>
  <table class="table" border="1" align="center">
	<form action='<?php echo U('/Jingxiaoshang/addcard') ?>' method='post' name='form'>
		<tr> <td width="10%">用户名</td>
		<input type='hidden' value='<?php if(isset($cards['id'])){echo $cards['id'];} ?>' name='id'>
      <td style='text-align:left'><input type='text' readonly name='username' value='<?php echo $username; ?>' /><input type='hidden' value='<?php echo $userid; ?>' name='userid' /></td></tr>
	  <tr> <td width="10%">优惠码</td>
      <td style='text-align:left'><input type='text' value='<?php if(isset($cards['card'])){echo $cards['card'];} ?>' name='card' /></td></tr> 
	  <tr> <td width="10%">优惠价格</td>
      <td style='text-align:left'><input type='text'value='<?php if(isset($cards['jiage'])){echo $cards['jiage'];} ?>' name='jiage' /></td></tr>
	 <tr>
     <td></td>
      <td style='text-align:left'><input type="submit" value='添加' /></td></tr>
    </tr>
    </form>
  </table>
   <div class="title"><p>优惠码列表</p></div>
 
  <table class="table" border="1" align="center">
       <tr>
        <td>id</td>
        <td>优惠码 </td>
        <td>优惠价格</td>
        <td>添加时间</td>
        <td>操作</td>
        
      </tr>
 
      <?php foreach ($lists as $v){ ?>
      <tr>
        <td><?php if(isset($v['id'])){echo $v['id'];} ?></td>
        <td><?php if(isset($v['card'])){echo $v['card'];} ?></td>
        <td><?php if(isset($v['jiage'])){echo $v['jiage'];} ?></td>
        <td><?php echo date('y-m-d H:i:s',$v['addtime']) ?></td>
        <td><a href='/admin/Jingxiaoshang/addcard?userid=<?php if(isset($v['userid'])){echo $v['userid'];} ?>&id=<?php if(isset($v['id'])){echo $v['id'];} ?>'>修改</a> ||<a href='/admin/Jingxiaoshang/delcard?id=<?php if(isset($v['id'])){echo $v['id'];} ?>'>删除</a></td>
      </tr>
    <?php } ?>

    </table>

</div>
</body>
</html>