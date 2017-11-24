<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>基因产品列表</title>
<meta name="Keywords" content="">
<meta name="Description" content="">
<?php $this->display('css','lib') ?>
    <style>
      .p_detial.hover {
        background: #E5E4E2;
      }
      
      .p_d_job {
        width: 100%;
        margin-bottom: 50px;
      }
      
      .p_d_job th {
        text-align: center;
        color: #0079FF;
        font-size: 1.5em;
        border-bottom: 1px solid #C7ECFC;
        height: 50px;line-height: 50px;
      }
      
      .p_d_job td {
        width: 50%;
        vertical-align: middle;
        border-bottom: 1px solid #C7ECFC;
      }
      .p_d_job td:nth-child(odd){
        font-size:1.5em;
      /*  font-weight: bold;*/
        color: #383735;
      }
      .p_d_job td:nth-child(even){
        color:#898989 ;
        font-size: 1em;
      }
      .rela {
        position: relative;
      }
      .slbg{
			    margin: 1% 2%;
    padding: 1%;
    width: 25%;
    float: left;
    text-align: center;
    border: 1px solid;
    border-radius: 5px;
	  }
	  .ljgm{
      position: relative;
      left: 68%;
      /*top: -55px;*/
      display: inherit;
      font-size: 16px;
      line-height: 27px;
      color: #fff;
      width: 25%;
      border-radius: 38px;
      text-align: center;
      background: -webkit-gradient(linear, 0% 25%, 75% 100%, from(#946134), to(#f7e5d2));
	  }
	  .ds{
		    margin: 1% 2%;
			padding: 1%;
			background:#999;
			color:#fff;
			width: 60%;
			float: left;
			text-align: center;
			border: 1px solid #999;
			
	  }
    div.ui-row1 {
        display: block;
    }
    #ui-row1 img {
      display: block;
      width: 100%;
  }
  .tipp {
    font-size: 16px;
    color:#565555;
    margin-top: 20px;
    margin-bottom: 15px;
    text-align: center;
  }
  .mb10{
    margin-bottom: -10px;
  }
    </style>
    <script>
    $(function(){
      $('.p_detial').click(function(){
        var a=$(this).index();
        $(this).removeClass('hover').siblings().addClass('hover');
        $('.p_d_con').eq(a).removeClass('hide').siblings('.p_d_con').addClass('hide');
      });
     /* var ah = $(window).width()*411.31/667+27;
      ah = ah*0.21;*/
      //var ah = $(".ui-container").height();
      var ah = 800*411.31/667*1.130;
      ah = ah*0.208;
      lh = ah*0.5;
      $("a").css('top',"-"+ah+'px');
      $("a").css('line-height',lh+'px');
    })
     function dogoods(goods_id) {
        $('#goods_id').attr("value",goods_id);
        $('#form').submit();
     }
    </script>
  </head>

  <body style="background: #FFFFFF;width: 800px;margin: 0 auto;">
  <p class="tipp">
    以下基因检测内容 (四选一)
  </p>
  <?php foreach ($fields as $key => $field) { ?>
    <div class="ui-container mb10">
        <div class="ui-row1 p_d_con rela" id="ui-row1" >
        <?php
        if(empty($field['goods_brief1'])){
        echo $field['goods_brief'];
        }else{
        echo $field['goods_brief1'];
        }
        ?>
        <a href="javascript:" onclick="dogoods(<?php if(isset($field['goods_id'])){echo $field['goods_id'];} ?>);return false;" class=" ljgm" >立即激活</a>
          
        </div>


   
  </div>

    <?php } ?>
  <p class="tipp" style="margin-top: 0px;margin-bottom: 50px;">
    以上基因检测内容 (四选一)
  </p>
     <form action="/index/Third/mima" id="form" method="post">
              <input type="hidden" name='number[]' value="1">
              <input type="hidden" name='goods_id[]' value="" id="goods_id">
      </form>
  </body>
</html>
<style>
#ui-row1 img{display:block;width:100%;}
</style>