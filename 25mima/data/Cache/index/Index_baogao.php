<!DOCTYPE html>
<!-- saved from url=(0036)http://www.23mofang.com/report/index -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>23魔方 | 天赋基因检测结果</title>
  <meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="/public/baogao/reset.css" type="text/css">
<link rel="stylesheet" href="/public/baogao/style.css" type="text/css">
<script charset="utf-8" src="/public/baogao/v.js"></script><script async="" src="/public/baogao/agt.js"></script><script async="" src="/public/baogao/tg.js"></script><script src="/public/baogao/hm.js"></script><script type="text/javascript" async="" src="/public/baogao/vds.js"></script><script type="text/javascript" async="" defer="" src="/public/baogao/piwik.js"></script><script async="" src="/public/baogao/ga.js"></script><script src="/public/baogao/jquery.min.js" type="text/javascript"></script>
<script src="/public/baogao/jquery.plugins.min.js" type="text/javascript"></script>
<script src="/public/baogao/functions.js" type="text/javascript"></script>
<script src="/public/baogao/common.js" type="text/javascript"></script>
<script src="/public/baogao/widget.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="/res/desktop/plugin/selectivizr.min.js"></script>
<script src="/res/desktop/plugin/html5shiv.min.js"></script>
<![endif]-->
<?php $this->display('css','lib') ?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','http://static.23mofang.com/ga.js','ga');
	if( uid ){ga('create', 'UA-60524847-1', {'userId': uid});ga('require', 'displayfeatures');
	ga('set', 'dimension1', uid);ga('set', 'dimension2', userStatus);
	}else{ga('create', 'UA-60524847-1', 'auto');}
</script>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//da.23mofang.com/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    _paq.push(['setUserId',uid]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>

<noscript>&lt;p&gt;&lt;img src="//123.56.197.127/piwik/piwik.php?idsite=2" style="border:0;" alt="" /&gt;&lt;/p&gt;</noscript>
<!-- End Piwik Code -->
<script type="text/javascript">
var _vds = _vds || [];
window._vds = _vds;
(function(){
  _vds.push(['setAccountId', 'a468fa1a1535faa3']);
  (function() {
    var vds = document.createElement('script');
    vds.type='text/javascript';
    vds.async = true;
    vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(vds, s);
  })();
})();
</script>


<link rel="stylesheet" href="/public/baogao/report.css">
  <link rel="stylesheet" href="/public/baogao/index.css">
</head>
<body>
 <link rel="stylesheet" href="/public/baogao/nav.css">
  <?php $this->display('header','lib') ?>
<script>
var reportSwitch = (function() {
    var switchTo = function(barcode) {
      $.ajax({
        dataType : "json",
        cache : false,
        url : "/example-report/changePerson?nowuuid=" + barcode,
        success : function(res) {
          if (res.code) {
            alert('error');
          } else {
            reportSwitch.origin ? location.href = reportSwitch.origin : location.reload();
          }
        }
      });
    };

    return {
      switchTo : switchTo
    };
  })();
</script><script type="text/javascript">
  $(function() {
      $('#peoLabel').text($('#peoSelect .selected').text());
      $('#peoSelect .userbar-report-opt').click(function() {
          reportSwitch.switchTo($(this).attr('value'));
      }).css('width', $('#peoLabel').outerWidth() - 1);

      $('.example-switch-sle').click(function() {
          reportSwitch.switchTo($(this).attr('value'));
      })

      // 获取浏览器当前地址
      var pathname = document.location.pathname,
          scrollTop;
          
      $(".global-box-fill").height($("#nav-other").height());

      $(window).bind('scroll', function() {
          scrollTop = $(document).scrollTop();

          if (scrollTop < 30 ) {
              $("#nav-other").css('top', 30-scrollTop);
          }else if (scrollTop > 30){
              $("#nav-other").css('top', 0);
          }
      });


  });
</script>
<div class="comm-search-nav-box">
  <div class="crumb-search-wrap clearfix">
    <ul class="bread-crumb">
      <li class="crumb divider"><a href="/public/baogao/23魔方 _ 天赋基因检测结果.html">我的报告</a></li>
      <li class="crumb"><span class="current">报告概览</span></li>
    </ul>
  </div>
</div>
<!-- 顶部展示区域 -->
<div class="tal-header container clearfix">
  <!-- 基因检测结果 -->
  <div class="tal-result">
    <h2 class="tal-result-title">您的宝贝天赋基因检测结果</h2>
    <div class="tal-tag-wrap">
      <?php foreach ($zheye['0'] as $k=>$v){ ?>
      <?php
      if($k<4){
        echo "<div class='tal-tag'>$v[description1]</div>";
      }
      ?>
      <?php } ?>
    </div>
  </div>
<style>
.tal-tag{background:#318ba1;padding:0;margin:0 0 10px 20px;height:36px;line-height:36px;text-align:center;-moz-border-radius: 15px;      /* Gecko browsers */
    -webkit-border-radius: 15px;   /* Webkit browsers */
    border-radius:15px; width:160px;}
</style>
  <!-- 雷达图表 -->
  <div class="tal-polar-wrap">
    <p class="tal-polar-text tal-polar-text-name">果儿</p>
    <p class="tal-polar-text tal-polar-text-date">2岁5个月</p>
    <div id="tal-polar" style="height:335px;" data-highcharts-chart="0"><div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 340px; height: 335px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="340" height="335"><desc>Created with Highcharts 4.1.3</desc><defs><clippath id="highcharts-1"><rect x="0" y="0" width="320" height="310"></rect></clippath></defs><rect x="0" y="0" width="340" height="335" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><g class="highcharts-grid" zIndex="1"><path fill="none" d="M 170 165 L 170 33.25" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 254.68726757620158 64.07364461907464" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 299.7484214593584 142.1218525923819" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 284.09884694859977 230.87499999999997" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 215.06115388315686 288.8045027885434" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 124.93884611684314 288.80450278854346" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 55.90115305140023 230.87500000000006" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 40.25157854064159 142.12185259238197" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 85.31273242379842 64.07364461907466" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 165 L 169.99999999999997 33.25" stroke="#e9edee" stroke-width="1" zIndex="1" opacity="1"></path></g><g class="highcharts-grid" zIndex="1"><path fill="none" stroke="#f0f0f0" stroke-width="1" zIndex="1"></path><path fill="none" d="M 170 138.65 A 26.35 26.35 0 1 1 169.97365000439166 138.6500131749989 M 170 165 A 0 0 0 1 0 170 165 " stroke="#f0f0f0" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 112.3 A 52.7 52.7 0 1 1 169.94730000878332 112.30002634999781 M 170 165 A 0 0 0 1 0 170 165 " stroke="#f0f0f0" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 85.94999999999999 A 79.05000000000001 79.05000000000001 0 1 1 169.92095001317495 85.9500395249967 M 170 165 A 0 0 0 1 0 170 165 " stroke="#f0f0f0" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 59.599999999999994 A 105.4 105.4 0 1 1 169.8946000175666 59.6000526999956 M 170 165 A 0 0 0 1 0 170 165 " stroke="#f0f0f0" stroke-width="1" zIndex="1" opacity="1"></path><path fill="none" d="M 170 33.25 A 131.75 131.75 0 1 1 169.86825002195826 33.250065874994505 M 170 165 A 0 0 0 1 0 170 165 " stroke="#f0f0f0" stroke-width="1" zIndex="1" opacity="1"></path></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 170 33.25 A 131.75 131.75 0 1 1 169.86825002195826 33.250065874994505 M 170 165 A 0 0 0 1 0 170 165 " stroke="#C0D0E0" stroke-width="1" zIndex="7" visibility="visible"></path></g><g class="highcharts-axis" zIndex="2"></g><g class="highcharts-series-group" zIndex="3"><path fill="rgba(124,181,236,0.25)" d="M 0 0"></path><g class="highcharts-series" visibility="visible" zIndex="0.1" transform="translate(10,10) scale(1 1)" clip-path="url(#highcharts-1)"><path fill="rgba(124,181,236,0.75)" d="M 160 23.25 L 227.74981406096126 74.25891569525972 L 237.84905287561506 141.27311155542915 L 228.4593081691599 194.52499999999998 L 187.03669232989412 229.28270167312607 L 114.93884611684314 278.80450278854346 L 68.72092244112018 207.70000000000005 L 30.25157854064159 132.12185259238197 L 75.31273242379842 54.073644619074656 L 160 23.25 L 160 155" zIndex="0"></path><path fill="none" d="M 160 23.25 L 227.74981406096126 74.25891569525972 L 237.84905287561506 141.27311155542915 L 228.4593081691599 194.52499999999998 L 187.03669232989412 229.28270167312607 L 114.93884611684314 278.80450278854346 L 68.72092244112018 207.70000000000005 L 30.25157854064159 132.12185259238197 L 75.31273242379842 54.073644619074656 L 160 23.25" stroke="#7cb5ec" stroke-width="2" zIndex="1" stroke-linejoin="round" stroke-linecap="round"></path><path fill="none" d="M 150 23.25 L 160 23.25 L 227.74981406096126 74.25891569525972 L 237.84905287561506 141.27311155542915 L 228.4593081691599 194.52499999999998 L 187.03669232989412 229.28270167312607 L 114.93884611684314 278.80450278854346 L 68.72092244112018 207.70000000000005 L 30.25157854064159 132.12185259238197 L 75.31273242379842 54.073644619074656 L 160 23.25 L 170 23.25" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="22" zIndex="2" class=" highcharts-tracker" style=""></path></g><g class="highcharts-markers highcharts-tracker" visibility="visible" zIndex="0.1" transform="translate(10,10) scale(1 1)" style="" clip-path="none"><path fill="#7cb5ec" d="M 75.31273242379842 50.073644619074656 C 80.64073242379843 50.073644619074656 80.64073242379843 58.073644619074656 75.31273242379842 58.073644619074656 C 69.98473242379842 58.073644619074656 69.98473242379842 50.073644619074656 75.31273242379842 50.073644619074656 Z" stroke-width="1"></path><path fill="#7cb5ec" d="M 30.25157854064159 128.12185259238197 C 35.57957854064159 128.12185259238197 35.57957854064159 136.12185259238197 30.25157854064159 136.12185259238197 C 24.92357854064159 136.12185259238197 24.92357854064159 128.12185259238197 30.25157854064159 128.12185259238197 Z" stroke-width="1"></path><path fill="#7cb5ec" d="M 68.72092244112018 203.70000000000005 C 74.04892244112018 203.70000000000005 74.04892244112018 211.70000000000005 68.72092244112018 211.70000000000005 C 63.39292244112018 211.70000000000005 63.39292244112018 203.70000000000005 68.72092244112018 203.70000000000005 Z" stroke-width="1"></path><path fill="#7cb5ec" d="M 114.93884611684314 274.80450278854346 C 120.26684611684314 274.80450278854346 120.26684611684314 282.80450278854346 114.93884611684314 282.80450278854346 C 109.61084611684313 282.80450278854346 109.61084611684313 274.80450278854346 114.93884611684314 274.80450278854346 Z" stroke-width="1"></path><path fill="#7cb5ec" d="M 187.03669232989412 225.28270167312607 C 192.36469232989413 225.28270167312607 192.36469232989413 233.28270167312607 187.03669232989412 233.28270167312607 C 181.70869232989412 233.28270167312607 181.70869232989412 225.28270167312607 187.03669232989412 225.28270167312607 Z" stroke-width="1"></path><path fill="#7cb5ec" d="M 228.4593081691599 190.52499999999998 C 233.7873081691599 190.52499999999998 233.7873081691599 198.52499999999998 228.4593081691599 198.52499999999998 C 223.1313081691599 198.52499999999998 223.1313081691599 190.52499999999998 228.4593081691599 190.52499999999998 Z" stroke-width="1"></path><path fill="#7cb5ec" d="M 237 137.27311155542915 C 242.328 137.27311155542915 242.328 145.27311155542915 237 145.27311155542915 C 231.672 145.27311155542915 231.672 137.27311155542915 237 137.27311155542915 Z"></path><path fill="#7cb5ec" d="M 227 70.25891569525972 C 232.328 70.25891569525972 232.328 78.25891569525972 227 78.25891569525972 C 221.672 78.25891569525972 221.672 70.25891569525972 227 70.25891569525972 Z"></path><path fill="#7cb5ec" d="M 160 19.25 C 165.328 19.25 165.328 27.25 160 27.25 C 154.672 27.25 154.672 19.25 160 19.25 Z" stroke-width="1"></path></g></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"><text x="170" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="21.25" opacity="1">情景记忆</text><text x="264.3290817214996" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="55.58297797228998" opacity="1">数学</text><text x="314.5205377545415" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="142.51712992737797" opacity="1">学习</text><text x="297.0892280053664" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="start" transform="translate(0,0)" y="241.37499999999997" opacity="1">专注</text><text x="220.1914560330419" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="305.89989210033207" opacity="1">语言表达</text><text x="119.80854396695813" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="middle" transform="translate(0,0)" y="305.89989210033207" opacity="1">创造</text><text x="42.91077199463365" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="241.37500000000006" opacity="1">自律</text><text x="25.47946224545845" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="142.51712992737802" opacity="1">音乐</text><text x="75.67091827850034" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:22px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="55.582977972289996" opacity="1">运动</text></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"></g></svg></div></div>
  </div>
</div>

<!-- 天赋展示区域 -->
<div class="tal-main-wrap">
  <div class="container clearfix">

	<?php foreach ($zheye as $v){ ?>
	<?php foreach ($v as $j){ ?>
    <a href='<?php echo U("Index/baogao1/id/5/key/$j[id]") ?>'>
    <div class="tal-main-gene" data="talent/detail?id=55013d68e26979ca6dceed7e">
      <div class="clearfix">
        <img src="<?php if(isset($j['litpic'])){echo $j['litpic'];} ?>" class="tal-gene-img" alt="<?php if(isset($j['name'])){echo $j['name'];} ?>">
            <div class="tal-gene-content">
          <p class="mt10 tal-pl5"><?php if(isset($j['name'])){echo $j['name'];} ?></p>
          <!-- 星星输出 -->
          <p class="mt10">
		  <?php
			for($i=1;$i<=$j['fenshu1'];$i++){
				echo '<img src="/public/baogao/tal_star.png" class="tal-star">';
			}
		  ?>
          </p>
        </div>
      </div>
      <p class="mt20"><?php if(isset($j['name'])){echo $j['name'];} ?><?php if(isset($j['pingjia'])){echo $j['pingjia'];} ?></p>
    </div>
    </a>
	<?php } ?>
	<?php } ?>
    
	
	
    </div>
</div>

<!-- 参考文献 -->
<div class="tal-footer" style="clear:both">
  <p class="tal-mb10 clearfix">
    <span class="tal-footer-ckwx">【参考文献】</span>
    <a target="_blank" href="http://www.23mofang.com/advantage/authority" class="tal-link fn-right">查看论文依据&nbsp;&gt;</a>
  </p>

  <!-- 预显示的论文条目 -->
  <p> <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=11440986" target="_Blank">1.&nbsp;Differential expression of the actin-binding proteins, alpha-actinin-2 and -3, in different species: implications for the evolution of functional redundancy.</a></p>
  <p> <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=17550918" target="_Blank">2.&nbsp;ACTN3 genotype in professional soccer players.</a></p>
  <p> <a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=12879365" target="_Blank">3.&nbsp;ACTN3 genotype is associated with human elite athletic performance.</a></p>
  <p><a href="javascript:;" class="tal-link fn-right j_more">查看更多&nbsp;&gt;</a></p>
     <!-- 预隐藏的论文条目 -->
  <div class="j_items" style="display:none;">
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=15221860" target="_Blank">4.&nbsp;A gene for speed? The evolution and function of alpha-actinin-3.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=16612741" target="_Blank">5.&nbsp;ACTN3 Genotype in Professional Endurance Cyclists.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=15886711" target="_Blank">6.&nbsp;Mitochondrial DNA and ACTN3 genotypes in Finnish elite endurance and sprint athletes.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=17033684" target="_Blank">7.&nbsp;Association analysis of the ACTN3 R577X polymorphism and complex quantitative body composition and performance phenotypes in adolescent Greeks.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=15718405" target="_Blank">8.&nbsp;ACTN3 genotype is associated with increases in muscle strength in response to resistance training in women.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=17828264" target="_Blank">9.&nbsp;Loss of ACTN3 gene function alters mouse muscle metabolism and shows evidence of positive selection in humans.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=17848603" target="_Blank">10.&nbsp;The ACTN3 (R577X) genotype is associated with fiber type distribution.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/entrez/query.fcgi?cmd=Search&db=PubMed&term=18178581" target="_Blank">11.&nbsp;An Actn3 knockout mouse provides mechanistic insights into the association between alpha-actinin-3 deficiency and human athletic performance.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/20044476" target="_Blank">12.&nbsp;Associations of polymorphisms of eight muscle- or metabolism-related genes with performance in Mount Olympus marathon runners.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/17053149" target="_Blank">13.&nbsp;Common Kibra alleles are associated with human memory performance.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/25146696" target="_Blank">14.&nbsp;Association of KIBRA rs17070145 polymorphism with episodic memory in the early stages of a human neurodevelopmental disorder.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/26415670" target="_Blank">15.&nbsp;Investigating the influence of KIBRA and CLSTN2 genetic polymorphisms on cross-sectional and longitudinal measures of memory performance and hippocampal volume in older individuals.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/24614497" target="_Blank">16.&nbsp;A genome-wide linkage and association study of musical aptitude identifies loci containing genes related to inner ear development and neurocognitive functions.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/20156565" target="_Blank">17.&nbsp;Neurophysiological Markers of Novelty Processing Are Modulated by COMT and DRD4 Genotypes.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/17574217" target="_Blank">18.&nbsp;Association of the Dopamine D4 Receptor (DRD4) Gene and Approach-Related Personality Traits: Meta-Analysis and New Data. </a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/10673770" target="_Blank">19.&nbsp;Identification of a Polymorphism in the Promoter Region of DRD4 Associated with the Human Novelty Seeking Personality Trait.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/11244482" target="_Blank">20.&nbsp;Association between Novelty Seeking and the -521 C/T Polymorphism in the Promoter Region of the DRD4 Gene. </a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/23252368" target="_Blank">21.&nbsp;The −521 C/T Variant in the Dopamine-4-Receptor Gene (DRD4) Is Associated with Skiing and Snowboarding Behavior: The DRD4 Gene and Skiing/snowboarding Behavior. </a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/24100617" target="_Blank">22.&nbsp;Genetic modulation of personality traits: a systematic review of the literature.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/24734235" target="_Blank">23.&nbsp;The dopaminergic reward system and leisure time exercise behavior: a candidate allele study.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/18063800" target="_Blank">24.&nbsp;Genetically determined differences in learning from errors.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/18621654" target="_Blank">25.&nbsp;Comment on “Genetically Determined Differences in Learning from Errors” .</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/25003214" target="_Blank">26.&nbsp;The correlation between reading and mathematics  ability at age twelve has a substantial genetic component.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/24611799" target="_Blank">27.&nbsp;Who is afraid of math? Two sources of genetic variance for mathematical anxiety.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/16801949" target="_Blank">28.&nbsp;The SNAP-25 gene is associated with cognitive ability: evidence from a family-based study in two independent Dutch cohorts.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/17948273" target="_Blank">29.&nbsp;A Polymorphism at the 3-Untranslated Region of the CLOCK Gene Is Associated With Adult Attention-Deficit Hyperactivity Disorder.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/25673850" target="_Blank">30.&nbsp;Circadian modulation of dopamine levels and dopaminergic neuron development contributes to attention deficiency and hyperactive behavior.</a></p>
  <p><a href="http://www.ncbi.nlm.nih.gov/pubmed/20923434" target="_Blank">31.&nbsp;Association between FOXP2 gene and speech sound disorder in Chinese population.</a></p>
  </div>
</div>
<?php $this->display('footer','lib') ?>
<script>
  var _hmt = _hmt || [];
  _hmt.push(['_setCustomVar', 1, 'uid', uid, 1]);
  _hmt.push(['_setCustomVar', 2, 'userStatus', userStatus, 1]);
  (function() {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?08b920c492d69aa3ea81852effbff71a";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
  })();
</script>
<script> 
    (function(a,b,c,d,e){ 
        var s= b.createElement(c);s.async=1;s.src='//t.agrantsem.com/tg.js?c='+d+'&t='+e; 
        var r= b.getElementsByTagName(c)[0];r.parentNode.insertBefore(s,r); 
    })(window,document,'script','AG_863614_EAHA','1'); 
</script> 

<script src="/public/baogao/highcharts.js"></script><img src="/public/baogao/pv" style="display: none; width: 0px; height: 0px;">
<script src="/public/baogao/highcharts_more.js"></script>
<script type="text/javascript">

// 谷歌分析
ga('set', 'contentGroup1', '个人报告-儿童天赋报告首页');
ga('send', 'pageview');

var serverData = {
    starArray: [
        5.0,4.0,3.0,3.0,3.0,5.0,4.0,5.0,5.0,]
    };

</script>
<script src="/public/baogao/talent_index.js"></script>


</body></html>
<style>
.tal-pl5{font-size:18px;}
.mt20{font-size:16px;}
</style>