<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>采样盒</title>
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <?php $this->display('index:Index:css','lib') ?>
    <link href="/public/gaiban/css/user.css" rel="stylesheet" type="text/css" />
	<style>
	.check_btn {background:#1FADDD;color:#fff;margin: 10px auto;display: inherit;width: 100px;text-align: center;padding: 5px 0}
	.check_btn_none{background:#D7DCDE;margin: 10px auto;display: inherit;width: 100px;text-align: center;padding: 5px 0}
	</style>
</head>

<body>
 <?php $this->display('index:Index:header','lib') ?>
    <div class="w1000">
        <div class="CheckBox">
            <h2>个人信息</h2>
            <div class="cb_mess">
                <div class="cb_Pic"><img src="/public/wap1/images/<?php if($field['rcvSex']==1){echo '1.png';}else{echo '0.png';} ?>" style="border-radius:50%;" width="100%"/></div>
                <p><?php if(isset($field['name'])){echo $field['name'];} ?></p>
                <p>生日：<?php if(isset($field['birthtime1'])){echo $field['birthtime1'];} ?></p>
				<?php if($field['state']==5){ ?>
				<a href="/user/Index/baogao/id/<?php if(isset($field['id'])){echo $field['id'];} ?>" class="check_btn">查看报告</a>
				<?php }else{?>
				<a href="javascript:;" class="check_btn_none">查看报告</a>
				<?php  } ?>
            </div>
            <div class="cb_con">
                <h3>检测流程</h3>
                <ul>
                    <?php
					if($field['state']!=6){
                    for($i=0;$i<=$field['state'];$i++){
                    ?>
                    <li>
                        <div class="cb_cell">
                            <div class="cb_color co<?php echo $i; ?>"></div>
                            <span><?php echo $i+1;?></span>
                            <p><?php echo $tuoye_state[$i];?></p>
                            <p><?php echo date('Y-m-d H:i:s',$field['time'.$i]);?></p>
                        </div>
                    </li>
                    <?php }
						}else{
						for($i=0;$i<=2;$i++){
					?>
					<li>
                        <div class="cb_cell">
                            <div class="cb_color co<?php echo $i; ?>"></div>
                            <span><?php echo $i+1;?></span>
                            <p><?php echo $tuoye_state[$i];?></p>
                            <p><?php echo date('Y-m-d',$field['time'.$i]);?></p>
                        </div>
                    </li>
					<?php	
					}
					?>
					<li>
                        <div class="cb_cell">
                            <div class="cb_color co3"></div>
                            <span>3</span>
                            <p><?php echo $tuoye_state[6];?></p>
                            <p><?php echo date('Y-m-d',$field['time6']);?></p>
                        </div>
                    </li>
					<?php
						}
					?>
                </ul>
                <div class="cb_line"></div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>

<?php $this->display('index:Index:footer','lib') ?>
</body>


</html>
