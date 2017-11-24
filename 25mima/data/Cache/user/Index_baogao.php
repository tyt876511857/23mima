<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>个人中心</title>
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <?php $this->display('index:Index:css','lib') ?>
    <link href="/public/gaiban/css/user.css" rel="stylesheet" type="text/css" />
</head>

<body>
 <?php $this->display('index:Index:header','lib') ?>
    <!-- 广告图 -->
    <div class="User_ad">
        <img src="/public/gaiban/images/person_banner.jpg" width="100%" />
        <div class="User_ad_th">
            <h2>个人中心</h2>
            <span>Personal Center</span>
        </div>
    </div>
    <script>
        $(function () {
            $('.User_th').on('click', 'li', function () {
                var a = $(this).index();
                $(this).addClass('active').siblings().removeClass('active');
                $('.User_con').children().eq(a).removeClass('hide').siblings().addClass('hide');
            });
            $('.checkType').click(function () {
                $(this).next().toggleClass('hide');
                $(this).parent().parent().siblings().find('.checkType').next().addClass('hide');
            });

            //
            var CheckTimer;
            $('.checkType_con').hover(function () {
                clearTimeout(CheckTimer);
                $(this).removeClass('hide');
            }, function () {
                var _this = $(this);
                clearTimeout(CheckTimer);
                setTimeout(function () {
                    _this.addClass('hide');
                }, 500);

            });

        })
    </script>
    <div class="User_bg">
        <div class="w1000">
            <div class="User">
                <ul class="User_th">
                    <li class="active">个人账户</li>
                    <li>我的订单</li>
                    <li>采样盒</li>
                </ul>
                <div class="User_con">
                    <div class="U_c_cell">
                        <div class="UserAccount">
                            <div class="U_a_th">账户余额：<span>￥0.00</span></div>
                            <div class="U_a_con">
                                <div>我的优惠券
                                    <input type="submit" value="立即使用" class="UsingBtn" />
                                </div>
                                <div>
                                    <input type="text" name="" class="addText" placeholder="请输入优惠码" />
                                    <input type="button" value="添加" class="addBtn" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="U_c_cell hide">
                        <div class="UserOrder">
                            <h3>我的购物记录</h3>
                            <table>
                                <tr>
                                    <th>订单编号</th>
                                    <th>产品名称</th>
                                    <th>数量</th>
                                    <th>总价</th>
                                    <th>下单时间</th>
                                    <th>收货地址</th>
                                    <th>操作</th>
                                </tr>
                                <?php
                                if(empty($list)){
                                ?>
                                <tr>
                                    <td colspan="7" class="hide">
                                        <div class="UserOrder_info">
                                            <p>您还没有订单，请先去购买合适型号的商品吧！</p>
                                            <a href="/category_1.html">去购买</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php foreach ($list as $v){ ?>
                                <?php foreach ($v['child'] as $j){ ?>
                                <tr>
                                    <td width="10%"><?php if(isset($v['indent'])){echo $v['indent'];} ?></td>
                                    <td width="10%"><?php if(isset($j['goods_name'])){echo $j['goods_name'];} ?></td>
                                    <td width="10%"><?php if(isset($j['number'])){echo $j['number'];} ?></td>
                                    <td width="15%"><?php echo $j['shop_price'] * $j['number'];?></td>
                                    <td width="20%"><?php echo date('Y-m-d H:i:s',$v['addtime']) ?></td>
                                    <td width="20%"><?php if(isset($v['size'])){echo $v['size'];} ?></td>
                                    <td width="15%">
                                        <!--<a href="javascript:;">系统关闭</a> |--> <a href="javascript:;" class="checkType">查看状态</a>
                                        <div class="checkType_con hide">
                                            <h4>状态列表</h4>
                                            <ul>
                                                <li>
                                                    <span class="left"><?php echo date('Y-m-d H:i:s',$v['addtime']) ?></span>
                                                    <span class="right">订单提交</span>
                                                </li>
                                                <!--<li>
                                                    <span class="left">2016.04.05 16:35:78</span>
                                                    <span class="right">系统关闭</span>
                                                </li>--> 
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </table>

                        </div>
                    </div>
                    <div class="U_c_cell hide">
                        <div class="box">
							 <?php
                                if(empty($tuoye)){
                                ?>
                                <div class="box_info hide">
									<p>采样盒您可以把您的家人的信息绑定在同一个登录账户中.</p>
									<a href="/user/Index/add#add" class="addBox">绑定采样盒</a>
								</div>
                                <?php } ?>
                            <ul>
                                <?php foreach ($tuoye as $v){ ?>
                                <li>
                                    <div class="box_cell" style="position: relative;">
                                        <a href='<?php echo U("/Index/info/id/$v[id]") ?>'>
                                            <div class="box_cell_pic"><img src="/public/wap1/images/<?php if($v['rcvSex']==1){echo '1.png';}else{echo '0.png';} ?>" style="border-radius:50%;" width="100%"/></div>
                                            <h4><?php if(isset($v['name'])){echo $v['name'];} ?></h4>
                                            <p>生日：<?php echo date('Y-m-d',$v['birthtime']) ?></p>
                                            <p>采集器编码：<?php if(isset($v['identifier'])){echo $v['identifier'];} ?></p>

                                            <span><?php echo $tuoye_state[$v['state']]; ?>（<?php echo date('Y-m-d',$v['bgtime']) ?>） 
                                            </span>
                                        </a>
                                       <?php if(!empty($v['pdfurl'])) {?>
                                                <a href='/index/Index/downloadpdf/id/<?php echo $v['bid'];?>' style="position: absolute;left: 20px;top:0px;color: #1CACF2;font-size: 20px;">下载报告</a>
                                        <?php }?>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
							
                            <div style="clear:both"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $this->display('index:Index:footer','lib') ?>
</body>


</html>