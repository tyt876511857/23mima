/*首页banner轮播图效果*/
  var kin = $('#kinMaxShow');
  var len = kin.children().length;
  var str = '<ul class="label">';
  for(var i=1;i<=len;i++){
    if(i==1){
      str+='<li class="intro"></li>';
    }else{
      str+='<li></li>';
    }
  }
  $(str).appendTo(kin);
  var label = $('.label');
  label.children('li').click(function(){

    var i = $(this).index();
    console.info(i);
    label.children('li').removeClass("intro").eq(i).addClass("intro");
    kin.children('div').css('display','none').eq(i).css('display','block');
  });
  //间隔毫秒切换一次
  var interval = 5000;
  var start = setInterval("viwepager()",interval);
  function viwepager(){
    var i = $('.intro').index()+1;
    i = i==len?0:i;
    //console.log(i);
    $(kin).find('li').eq(i).trigger("click");
  }
  //移到图片上时暂停
  kin.find('div').mouseover(function(){
    clearInterval(start);//停止
  });
  kin.find('div').mouseout(function(){
    start = setInterval("viwepager()",interval);
  });
  //图标设置在中间
  var label_width = $('#kinMaxShow .label').width()/2;
  $('#kinMaxShow .label').css('left',$(window).width()/2-label_width);
  //品牌上下移动
  function brand_arrows(str){
    var ul = $('.brand ul');
    var height = ul.height();
    var length = $(ul).find('li').length/8;
    length = (Math.ceil(length)-1)*height;//ul总高度 //向上取整再减去1
    if(str=='up'){
      if(ul.scrollTop() == 0){
        ul.animate({scrollTop: length+'px'});
      }else{
        ul.animate({scrollTop: ul.scrollTop()-height+'px'});
      }
    }else{
      if(ul.scrollTop() >= length){
        ul.animate({scrollTop: '0px'});
      }else{
        ul.animate({scrollTop: ul.scrollTop()+height+'px'});
      }
    }
  }
  brand_move = window.setInterval(function(){brand_arrows('down');}, 1000*5);
  $('.brand ul').mouseover(function(){
    clearInterval(brand_move);//停止
  });
  $('.brand ul').mouseout(function(){
    brand_move = window.setInterval(function(){brand_arrows('down');}, 1000*5);
  });