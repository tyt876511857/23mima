<html>
<head>
<title>管理中心</title>
<meta http-equiv='Content-Type' content='text/html';charset='utf-8'>
<?php $this->display('index:Index:css','lib') ?>
<?php $this->display('css','lib') ?>
</head>
<body id="site">
<?php $this->display('index:Index:header','lib') ?>
<div class="w1200">
    <?php $this->display('left','lib') ?>
    <div class="user_right">
        <p class="user_title">我的订单</p>
        <?php foreach ($list as $v){ ?>
            <div class="indent_list">
                <h3><?php echo date('y-m-d',$v['addtime']) ?> 订单号：<?php if(isset($v['indent'])){echo $v['indent'];} ?></h3>
                <table>
                <tr>
                    <td width='600'>
                        <?php foreach ($v['child'] as $j){ ?>
                            <div><a href="<?php if(isset($j['url'])){echo $j['url'];} ?>"><img src='<?php if(isset($j['goods_thumb'])){echo $j['goods_thumb'];} ?>' /><?php if(isset($j['goods_name'])){echo $j['goods_name'];} ?><br /><?php if(isset($j['attr_value'])){echo $j['attr_value'];} ?></a><p><?php if(isset($j['shop_price'])){echo $j['shop_price'];} ?></p><span><?php if(isset($j['number'])){echo $j['number'];} ?></span></div>
                        <?php } ?>
                        <!-- <?php foreach ($v['present'] as $j){ ?>
                            <div><a href="<?php if(isset($j['url'])){echo $j['url'];} ?>"><img src='<?php if(isset($j['goods_thumb'])){echo $j['goods_thumb'];} ?>' /><?php if(isset($j['goods_name'])){echo $j['goods_name'];} ?><br /><?php if(isset($j['attr_value'])){echo $j['attr_value'];} ?></a><p>赠品</p><span></span></div>
                        <?php } ?> -->
                    </td>
                    <td width="100"><?php if(isset($v['price'])){echo $v['price'];} ?></td>
                    <td width="100"><?php if(isset($v['typename'])){echo $v['typename'];} ?></td>
                    <td width="100"><a href='<?php echo U("/Indent/info/id/$v[id]") ?>'>订单详情</a></td>
                    <td width="100"><?php if($v["type"]==0){ ?>
                        <form action="<?php echo U('Alipay/index','user') ?>" method='post' target="_blank"><input name="id" type="hidden" value="<?php if(isset($v['indent'])){echo $v['indent'];} ?>" /><input name="submit" type="submit" value="付款" /></form>
                    <?php } ?></td>
                </tr>
                </table>
            </div>
        <?php } ?>
    </div>
</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>
