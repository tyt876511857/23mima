<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>订单信息</title>
<?php $this->display('css','lib') ?>
</head>
<body id="right_bj">
<div class="right_box">
  <div class="title"><p>订单信息</p></div>
<form action="<?php echo U('/Indent/update') ?>" method="post">
  <div class="info">
    <p><span>订单编号：</span><?php if(isset($data['indent'])){echo $data['indent'];} ?></p>
    <p><span>提交时间：</span><?php echo date('y-m-d H:i:s',$data['addtime']) ?></p>
    <p><span>收货地址：</span><?php if(isset($data['name'])){echo $data['name'];} ?>,<?php if(isset($data['phone'])){echo $data['phone'];} ?>,<?php if(isset($data['size'])){echo $data['size'];} ?></p>
    <p><span>送货时间：</span><?php if(isset($data['delivery'])){echo $data['delivery'];} ?></p>
    <p><span>商品总价：</span><?php if(isset($data['price'])){echo $data['price'];} ?></p>
    <p><span>发票:</span>
    <?php 
    if($data['fapiao']==0){
      echo '不需要';
    }elseif($data['fapiao']==1){
      echo '个人';
    }elseif($data['fapiao']==2){
      echo '单位';
    }elseif($data['fapiao']==3){
      echo '增值';
    }
    ?>
    </p>
    <?php
    if($data['fapiao']==2){
      echo '<p><span>单位名称：</span>'.$data['companyName'].'</p>';
    }elseif($data['fapiao']==3){
      echo '<p><span>单位名称：</span>'.$data['vat_companyName'].'</p>';
      echo '<p><span>纳税人识别码：</span>'.$data['vat_code'].'</p>';
      echo '<p><span>注册地址：</span>'.$data['vat_address'].'</p>';
      echo '<p><span>注册电话：</span>'.$data['vat_tel'].'</p>';
      echo '<p><span>开户银行：</span>'.$data['vat_bank'].'</p>';
      echo '<p><span>银行账户：</span>'.$data['vat_bank_num'].'</p>';
      echo '<p><span>收票人姓名：</span>'.$data['vat_name'].'</p>';
      echo '<p><span>收票人手机：</span>'.$data['vat_message_tel'].'</p>';
      echo '<p><span>收票人地址：</span>'.$data['vat_province'].$data['vat_city'].$data['vat_country'].$data['vat_receive_address'].'</p>';
    }
    ?>
    <p><span>快递公司：</span><input type="text" name="company" value="<?php if(isset($data['company'])){echo $data['company'];} ?>" /></p>
    <p><span>快递单号：</span><input type="text" name="express" value="<?php if(isset($data['express'])){echo $data['express'];} ?>" /></p>
    <input type="hidden" name="id" value="<?php if(isset($data['id'])){echo $data['id'];} ?>" />
  </div>
  <table class="table" border="1" align="center">
    <tr>
      <td width="2%">id</td>
      <td width="20%">宝贝</td>
      <td width="10%">宝贝属性</td>
      <td width="10%">状态</td>
      <td width="20%">单价(元)</td>
      <td width="2%">数量</td>
    </tr>
    <?php foreach ($data['goosinfo'] as $j){ ?>
    <tr>
      <td><?php if(isset($j['goods_id'])){echo $j['goods_id'];} ?></td>
      <td><?php if(isset($j['goods_name'])){echo $j['goods_name'];} ?></td>
      <td><?php if(isset($j['attr_value'])){echo $j['attr_value'];} ?></td>
      <td><?php if(isset($data['typename'])){echo $data['typename'];} ?></td>
      <td><?php if(isset($j['shop_price'])){echo $j['shop_price'];} ?></td>
      <td><?php if(isset($j['number'])){echo $j['number'];} ?></td>
    </tr>
    <?php } ?>
    <?php foreach ($goods_array as $j){ ?>
    <tr>
      <td><?php if(isset($j['goods_id'])){echo $j['goods_id'];} ?></td>
      <td><?php if(isset($j['goods_name'])){echo $j['goods_name'];} ?></td>
      <td><?php if(isset($j['attr_value'])){echo $j['attr_value'];} ?></td>
      <td colspan="3">赠品或试用装</td>
    </tr>
    <?php } ?>
  </table>
  <div class="button-div">
      <input type="submit" value=" 确定 " />
      <input type="reset" value=" 重置 " />
  </div>
</from>
</div>
</body>
</html>