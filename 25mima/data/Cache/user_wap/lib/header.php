<!-- <div id="header" class="">
  <div class="logo"><a href="/"><img src="/public/wap/wap01.jpg"></a></div>
  <i id="nav-kg"></i>
</div>
<div id="nav" style="display: none;">
<ul class="lb">       
  <li><a class="nav-a">关于我们</a>
  <div class="nav-b">
    <div class="nav-blist">
    <p class="lmastyle"><a href="/news_11.html">品牌故事</a></p>
    <p><a href="/news_4.html">人才招聘</a></p>
    </div>
    <div class="nav-blist">
    <p class="lmastyle"><a href="/news_10.html">新闻动态</a></p>
    </div>
  </div>
  </li>
  <li><a href="http://weidian.com/?userid=957918963" class="nav-a">产品中心</a></li>
  <li><a href="/news_2.html" class="nav-a">基因故事</a></li>
  <li><a href="/news_7.html" class="nav-a">专家谈基因</a></li>
  <li><a href="/news_8.html" class="nav-a">品牌活动</a></li>
  <li><a href="/news_9.html" class="nav-a">招商加盟</a></li>
  <li><a href="/news_3.html" class="nav-a">联系我们</a></li>
</ul>
</div> 
<header class="ui-header ui-header-stable ui-border-b user_header">
  <a class="iconfont menu" href="javascript:;">&#xe602;</a>-->
  <?php if(empty($_SESSION['user_userid'])){?>
    <!--<a class="iconfont user_id" href="<?php echo U('Index/loginurl') ?>">&#xe62a;</a>-->
  <?php }else{?>
    <!--<a class="iconfont user_id" href="javascript:;">&#xe62a;</a>-->
  <?php   }?>
  

  <!--<span class="logo" style="width: 65px;margin:10px 0;height:auto;"><img src="/public/wap1/images/logo.png"  alt="logo"></span>
</header>
<div class="ui-row mark">
      <ul class="ui-row ui-whitespace menu_list">
        <li style="text-align: center;width: 100%;border: none;">
          <img src="/public/wap1/images/menu.png" alt="" width="100%" />
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_11.html"><i class="menu_icon menu_icon01"></i>品牌故事<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_4.html"><i class="menu_icon menu_icon02"></i>人才招聘<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_10.html"><i class="menu_icon menu_icon01"></i>新闻动态<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/category_1.html"><i class="menu_icon menu_icon03"></i>产品中心<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_2.html"><i class="menu_icon menu_icon04"></i>基因故事<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_7.html"><i class="menu_icon menu_icon05"></i>专家谈基因<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_8.html"><i class="menu_icon menu_icon06"></i>品牌活动<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_9.html"><i class="menu_icon menu_icon07"></i>招商加盟<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>
        <li style="width: 50%;float:left;border:0;">
          <a href="/news_3.html"><i class="menu_icon menu_icon08"></i>联系我们<!--<i class="m_l_link iconfont" >&#xe60d;</i></a>
        </li>

      </ul>
    </div>
    <?php if(!empty($_SESSION['user_userid'])){?>
    <div class="ui-row mark">
      <ul class="ui-row ui-whitespace user_detial">
        <li style="height: 80px;line-height:40px;border: none;">
          <p class="demo-desc" style="text-align: center;color: #727272;">23密码欢迎您，<span><?php if(isset($_SESSION['user_userid'])){echo $_SESSION['user_userid'];} ?></span></p>
        </li>
        <li>
          <a href="<?php echo U('Index/mybaogao','user') ?>"><i class="iconfont">&#xe62a;</i>我的报告</a>
        </li>
        <li>
          <a href="<?php echo U('Index/mytuoye','user') ?>"><i class="iconfont">&#xe63e;</i>样本盒</a>
        </li>
        <li>
          <a href="javascript:;"><i class="iconfont">&#xe654;</i>我的优惠券</a>
        </li>
		<li>
          <a href="<?php echo U('Indent/index','user') ?>"><i class="iconfont">&#xe605;</i>我的订单</a>
        </li>
        <li>
          <a href="<?php echo U('Login/logout','user') ?>"><i class="iconfont">&#xe73c;</i>退出账号</a>
        </li>
      </ul>
    </div>-->
    <?php   }?>