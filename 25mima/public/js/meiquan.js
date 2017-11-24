//图片轮播
var kin = $('#banner');
var len = kin.children().length;
var str = '<ul class="label">';
for(var i=1;i<=len;i++){
	if(i==1){
		str+='<li class="intro">'+i+'</li>';
	}else{
		str+='<li>'+i+'</li>';
	}
}
$(str).appendTo(kin);
var label = $('.label');
label.children().mouseover(function(){
var i = $(this).index();
label.children('li').removeClass("intro").eq(i).addClass("intro");
kin.children('div').css('display','none').eq(i).css('display','block');
});
//间隔毫秒切换一次
var interval = 10000;
var start = setInterval("viwepager()",interval);
function viwepager(){
	var i = $('.intro').index()+1;
	i = i==len?0:i;
	//console.log(i);
	$(kin).find('li').eq(i).trigger("mouseover");
}
//移到图片上时暂停
kin.find('div').mouseover(function(){
	clearInterval(start);//停止
});
kin.find('div').mouseout(function(){
	start = setInterval("viwepager()",interval);
});

//左上点击切换轮播图

$('.top ul li').click(function(){
	var src = $(this).find('img').attr('src');
	var href = $(this).find('img').attr('data');
	$('#top-img img').attr('src',src);
	$('#top-img').attr('href',href);
});
$('.top ul li:first').click();
var li = $('#demo li');
var distance2 = li.outerWidth(true);						//单个li的宽度
$('#demo ul').css('width',li.length * distance2 +'px');	//设置Ul的宽度
//重磅栏目的切换图
var li = $('#demo1 li');
var distance1 = li.outerWidth(true);						//单个li的宽度
$('#demo1 ul').css('width',li.length * distance1 +'px');	//设置Ul的宽度
function move(str,id,distance){
	var ul =  document.getElementById(id);
	if(str=='left'){
		ul.scrollLeft -= eval(distance);
	}else if(str=='right'){
		ul.scrollLeft += eval(distance);
	}
}






