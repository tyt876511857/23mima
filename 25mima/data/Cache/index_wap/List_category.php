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
      .product_list {
        text-align: left;
      }
      
      .product_list > li {
        position: relative;
        overflow: hidden;
        margin-bottom: 10px;
      }
      
      .product_list > li > .ui-row-flex {
        position: absolute;
        bottom: 7px;
        color: #FFFFFF;
      }
      
      .product_list > li > .ui-row-flex >.ui-col {
        padding: 10px;
        background: rgba(30, 185, 239, .5);
        line-height: 2em;
      }
      
      .product_list > li > .ui-row-flex >.ui-col.ui-col-4 {
        padding: 10px;
        background: rgba(0, 0, 0, .5);
      }
      .product_list > li > .ui-row-flex >.ui-col.ui-col-4 > h3{
        font-size: 1.5em;
      }
      .product_list > li > .ui-row-flex >.ui-col.ui-col-4 > p {
        font-size: 0.8em;
        line-height:1.2em;
      }
      .product_list > li:hover .p_l_mark{
        display: block;
      }
      .p_l_mark {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 9999;
        background: rgba(255, 255, 255, .8);
        width: 100%;
        height: 100%;
        border-top: .5em solid #1EB9EF;
        display: none;
      }
      
      .p_l_mark > div {
        text-align: center;
        padding-top: 10%;
      }
      
      .font2em{
        font-size:2em;
      }
    </style>
  </head>

  <body>
    <?php $this->display('header','lib') ?>
    <section class="ui-container ui-center">
      <div class="ui-row">
        <img src="/public/wap1/images/ad02.png" align="" width="100%" />
      </div>
      <ul class="ui-row product_list" style="padding-bottom:80px;width:100%">
        <?php foreach ($list as $v){ ?>
        <li onclick='location.href="<?php if(isset($v['url'])){echo $v['url'];} ?>"'>
          <img src="<?php if(isset($v['goods_img'])){echo $v['goods_img'];} ?>" alt="" width="100%" />
          <div class="ui-row-flex">
            <div class="ui-col ui-col-4" style="width:58%;padding-right:0;">
              <h3 style="font-size:1.3em;"><?php if(isset($v['goods_name'])){echo $v['goods_name'];} ?></h3>
              <p><?php if(isset($v['description'])){echo $v['description'];} ?></p>
            </div>
            <div class="ui-col font2em" id='price' style="width:42%;">
			<?php if($v['is_on_sale']==1){ ?>
              <span>￥<?php if(isset($v['market_price'])){echo $v['market_price'];} ?></span>
              <span>体验价：</span>
              <span>￥<?php if(isset($v['shop_price'])){echo $v['shop_price'];} ?></span>
			<?php }else{ ?>
			<span style="text-decoration:none;font-size:1em;">待售中</span>
			<?php } ?>
            </div>
          </div>
          <!-- <div class="ui-row p_l_mark">
            <div>
              <form action="<?php echo U('Shopping/mima') ?>" method="post">
              <input type="hidden" name='number[]' value="1">
              <input type="hidden" name='goods_id[]' value="<?php if(isset($v['goods_id'])){echo $v['goods_id'];} ?>">
              <a href="javascript:;" style="position:relative;">
              <input type="submit" class="submit" value="" />
              <img src="/public/wap1/images/product_icon01.png" alt=""></a><br/><br/>
              <a href="<?php if(isset($v['url'])){echo $v['url'];} ?>" class="iconfont">进一步了解</a>
              </form>
            </div>
          </div> -->
        </li>
        <?php } ?>
      </ul>
      <?php $this->display('footer','lib') ?>
    </section>
    
  </body>
</html>
<style>
.submit{display:block;width:200px;height:138px;position:absolute;left:0px;background:none;border:none;}
#price span{display:block;width:100%;font-size:0.8em;line-height:1.2em;text-align:center;}
#price span:first-child{font-size:0.6em;text-decoration:line-through}
#price span:first-child+span{font-size:0.4em;}
</style>