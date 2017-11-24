$(function(){


if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
	var $a = window.location.href;
	var $b = $a.replace('121.43.148.46','www.xiaoshouyi.com');
	//window.location.href=$b;
}

function getmobile() {
	var userAgent = navigator.userAgent || navigator.vendor || window.opera;
	if( userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i) ){
		return 'ios';
	}else if( userAgent.match( /Android/i ) ){
		return 'android';
	}else{
		return 'unknown';
	}
}
var $xz = getmobile();
$('.navxz').click(function(){
	if($xz=='ios' || $xz=='android'){
		if($xz=='ios'){
			window.location.href="https://itunes.apple.com/cn/app/ingage-crm/id654720925"
		}
		if($xz=='android'){
			window.location.href="http://dl.xiaoshouyi.com/apps/android"
		}
	}
	return false;
});
$('.navxzkxb').click(function(){
	if($xz=='ios' || $xz=='android'){
		if($xz=='ios'){
			window.location.href="https://itunes.apple.com/cn/app/ingage-crm/id654720925"
		}
		if($xz=='android'){
			window.location.href="http://dl_kx.xiaoshouyi.com"
		}
	}
	return false;
});

$('.navxz').click(function(){
	
})

$('#nav-kg').on('mousedown', function(){  
	if($('#header').hasClass('navkgs')){
		$('#header').removeClass('navkgs')
		$('#nav').hide()
	}else{
		$('#header').addClass('navkgs')
		$('#nav').show()
	}
});
$('.nav-b').on('click','a',function(){
	$('#nav-kg').trigger("mousedown")
});

$('#footernav li').on('click', function(){  
	if($(this).hasClass('footernav-lishow')){
		$(this).removeClass('footernav-lishow')
	}else{
		$(this).addClass('footernav-lishow').siblings('li').removeClass('footernav-lishow')
	}
});

$('#nav li').on('click', function(){  
	if($(this).hasClass('nav-lishow')){
		$(this).removeClass('nav-lishow')
	}else{
		$(this).addClass('nav-lishow').siblings('li').removeClass('nav-lishow')
	}
});

$('.cp-tab-tt').on('click', function(){  
	if($(this).hasClass('cp-tab-tthover')){
		$(this).removeClass('cp-tab-tthover')
		$(this).next('.cp-tab').hide()
		var $thist = $(this).offset().top;
		$('html,body').animate({scrollTop:Math.abs($thist)-115}, 100)
	}else{
		$(this).addClass('cp-tab-tthover').siblings('.cp-tab-tt').removeClass('cp-tab-tthover')
		$('.cp-tab').hide()
		$(this).next('.cp-tab').show()
		var $thist = $(this).offset().top;
		$('html,body').animate({scrollTop:Math.abs($thist)-115}, 100)
	}
});


$('.mokjg-d2-ren,.mokjg-d2-nian').on('focus','input',function(){
	$(this).val('');
}).on('keyup','input',function(){
	$(this).val($(this).val().replace(/\D/g,'').replace(/\b(0+)/gi,""));
}).on('blur','input',function(){
	var $val = $(this).val(); 
	if($.trim($val) == ''){
		$(this).val(this.defaultValue);
	}
});
$('.mokjg-d2-sbm').on('mousedown',function(){
	var $jga = Number($('.mokjg-d2-ren').find('input').val());
	var $jgb = Number($('.mokjg-d2-nian').find('input').val());
	var $jgc = Number($('.mokjg-d2-jg').find('.hot').attr('data-jg'));	
	if($jga < 6 ){
		$('.mokjg-d2-mn').html('<span>用户数量不得小于6人</span>');
	}else {
		$('.mokjg-d2-mn').html('您需支付<span>'+$jgb*12*$jgc*$jga+'</span>元&nbsp;,&nbsp;约合每用户每天<span>'+($jgc*12/365).toFixed(2)+'</span>元。');
	}
});
$('.mokjg-d2-jg').on('mousedown','a',function(){
	$(this).addClass('hot').siblings().removeClass('hot')
});


$('.jrwm-b').on('click','a',function(){
	$('.jrwm-b').show();
	$(this).closest('.jrwm-b').hide();
	$('.jrwm-c').hide();
	$(this).closest('.jrwm-list').find('.jrwm-c').show();

	var $thist = $(this).closest('.jrwm-list').offset().top;
	$('html,body').animate({scrollTop:Math.abs($thist)-99}, 100)
});


$('.lmbanner-c').on('click','a',function(){
	$('#shipin,#lmbanner-video').show();
	myVideo = document.getElementById('lmbanner-video');
	myVideo.play();
});
$('.kehuanli-a,.cgkha').on('click','i',function(){
	$('#shipin,#lmbanner-video').show();
	myVideo = document.getElementById('lmbanner-video');
	myVideo.play();
});
$('.footervideo02').on('click','a',function(){
	$('#shipin,#footer-video').show();
	myVideo = document.getElementById('footer-video');
	myVideo.play();
});
$('.syvideo-b').on('click','img',function(){
	$('#shipin,#indexfooter-video').show();
	myVideo = document.getElementById('indexfooter-video');
	myVideo.play();	
});
$('#video-stop').on('touchstart',function(){
	myVideo.pause();
	$('#shipin,#shipin video').hide();
	return false;
});


$('.gjc-list').on('click','.gjc-title',function(){  
	var $thisclass = $(this).closest('.gjc-list');
	if($thisclass.hasClass('gjc-list-index')){
		$thisclass.removeClass('gjc-list-index')
		var $thist = $(this).offset().top;
		$('html,body').animate({scrollTop:Math.abs($thist)-100}, 100)
	}else{
		$thisclass.addClass('gjc-list-index').siblings('.gjc-list').removeClass('gjc-list-index')
		var $thist = $(this).offset().top;
		$('html,body').animate({scrollTop:Math.abs($thist)-100}, 100)
	}
});


$('.anli-con').find('div,p,span,strong').css({'fontSize':'1em','lineHeight':'1.8'})


});