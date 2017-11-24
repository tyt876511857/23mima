<div class="footer">
    <div class="w1000">
      <div class="cont">
        <div class="left">
          <ul>
            <li>
              <a class="title" href="/news_11.html">关于我们</a>
              <a href="/news_11.html">品牌故事</a>
              <a href="/news_10.html">动态</a>
              <a href="/news_4.html">人才招聘</a>
              <a href="/news_9.html">合作</a>
            </li>
            <li>
              <a class="title" href="/category_1.html">产品信息</a>
              <a href="/category_1.html">产品</a>     
              <a href="/news_6.html">检测流程</a>
              <a href="/news_5.html">采样方法</a>
              <a href="/index/Index/baogao">示例报告</a>
            </li>
            <li>
              <a class="title" href="/user/Indent/index">个人中心</a>
              <?php if(empty($_SESSION["user_id"])){ ?>
                <a href="<?php echo U('Index/loginurl','index') ?>">登录</a>
              <?php }else{ ?>
                <a href="<?php echo U('Index/out','index') ?>">退出</a>
              <?php } ?>
              <a href="<?php echo U('/Indent/index','user') ?>#binded">我的采样盒</a>
              <a href="/category_1.html">购买</a>
              
            </li>
          </ul>
          
        </div>
        <span class="left"></span>
        <div class="right">
          <img src="/public/gaiban/images/footer.png" alt="23密码"/>
        </div>
      </div>
      
    </div>
  </div>
  <div class="footer_copy">
    <div class="w1000">
      <div class="cont">© 2005 - 2016 杭州贰拾叁密码生物科技有限公司 版权所有 浙ICP备16019085号-1 联系方式：4001-109-2599</div>
      
    </div>
  </div>
  <script language="javascript" src="/public/gaiban/js/header.js"></script>
  <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Ffd4d4a264527b55afe1e1226cf8a8867' type='text/javascript'%3E%3C/script%3E"));
</script>

