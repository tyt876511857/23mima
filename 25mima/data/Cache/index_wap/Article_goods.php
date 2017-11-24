<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php if(isset($field['title'])){echo $field['title'];} ?></title>
<meta name="Keywords" content="<?php if(isset($field['keywords'])){echo $field['keywords'];} ?>">
<meta name="Description" content="<?php if(isset($field['description'])){echo $field['description'];} ?>">
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
		    margin: 1% 2%;
			padding: 1%;
			background:#F1590d;
			color:#fff;
			width: 60%;
			float: left;
			text-align: center;
			border: 1px solid #F1590d;
			
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
    </style>
    <script>
    $(function(){
      $('.p_detial').click(function(){
        var a=$(this).index();
        $(this).removeClass('hover').siblings().addClass('hover');
        $('.p_d_con').eq(a).removeClass('hide').siblings('.p_d_con').addClass('hide');
      });
    })
      
    </script>
  </head>

  <body style="background: #FFFFFF;">
    <section class="ui-container">
    
      
        <div class="ui-row p_d_con" id="ui-row">
<?php
if(empty($field['goods_brief1'])){
echo $field['goods_brief'];
}else{
echo $field['goods_brief1'];
}
?>
        </div>
        <div class="ui-row p_d_con hide" style="text-align: center;">
          <img src="<?php if(isset($field['goods_img1'])){echo $field['goods_img1'];} ?>" alt="" width="100%" />
        </div>

      </div>
	  <div style="margin-bottom: 85px;clear:both;width:100%">
</div>

    <footer class="ui-footer ui-footer-stable ui-border-t" style="height: 40px;background: rgba(255,255,255,.9);">
<?php if($field['bg_id']>0){ ?>
     <a class="slbg" href="/index/Index/baogao/id/<?php if(isset($field['bg_id'])){echo $field['bg_id'];} ?>">示例报告</a>
<?php }else{ ?>
	 <a class="slbg" >暂没有示例</a>
<?php } ?>
      <form action="<?php echo U('Shopping/mima') ?>" id="form" method="post">
      <input type="hidden" name='number[]' value="1">
      <input type="hidden" name='goods_id[]' value="<?php if(isset($field['goods_id'])){echo $field['goods_id'];} ?>">
	  <?php if($field['is_on_sale']==1){ ?>
     <a href="javascript:$('#form').submit();" class=" ljgm" >立即购买</a>
	 <?php }else{ ?>
	  <a  class=" ds" >待售中</a>
	<?php } ?>
      </form>
</footer>
	 
	 
     
    </section>
  </body>
</html>
<style>
#ui-row img{display:block;width:100%;}
</style>