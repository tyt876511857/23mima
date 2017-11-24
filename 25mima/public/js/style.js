/*全局共用*/

	/*TAB切换*/
	function nTabs(thisObj,Num){
		thisObj.style.cursor='default';
		if(thisObj.className == "li2")return;
		var tabObj = thisObj.parentNode.id;
		var tabList = document.getElementById(tabObj).getElementsByTagName("li");
		for(i=0; i <tabList.length; i++){
		  if (i == Num){
		   thisObj.className = "li2"; 
		   document.getElementById(tabObj+i).style.display = "block";
		  }else{
		  	tabList[i].className = ""; 
		    document.getElementById(tabObj+i).style.display = "none";
		  }
		} 
	}
	//滚动效果
	var juli = 188;
	function gundong(demo,demo1,demo2){
		var speed=20;
		var tab =  document.getElementById(demo);
		var tab1 = document.getElementById(demo1);
		var tab2 = document.getElementById(demo2);

		tab2.innerHTML = tab1.innerHTML;
		function Marquee(){
			if(tab1.offsetWidth>980){
				if(tab1.offsetWidth-tab.scrollLeft<0){
					tab.scrollLeft-=tab1.offsetWidth;
				}else{
					tab.scrollLeft++;
				}
			}
		}
		var MyMar=setInterval(Marquee,speed);
		tab.onmouseover=function() {clearInterval(MyMar)};
		tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
		
	}
	function onright(thisobj){
		var tab =  document.getElementById(thisobj.id);
		var tab1 = document.getElementById(thisobj.id+1);
		var tab2 = document.getElementById(thisobj.id+2);
		if(tab.scrollLeft+juli>tab1.offsetWidth){
			tab.scrollLeft = juli;
		}else{
			tab.scrollLeft+=juli;
		}
	}
	function onleft(thisobj){
		var tab =  document.getElementById(thisobj.id);
		var tab1 = document.getElementById(thisobj.id+1);
		var tab2 = document.getElementById(thisobj.id+2);
		if(tab.scrollLeft-juli<0){
			tab.scrollLeft=tab1.offsetWidth-juli;
		}else{
			tab.scrollLeft-=juli;
		}
	}
  	/*滑动显示隐藏菜单*/
	 function show_menu(str){
	    var getid = $("#"+str);
	    if(getid.css('display') == 'block'){
	    	getid.css('display','none');
	      //getid.slideToggle('slow');
	    }else{
	      //for(var i=1;i<6;i++){
	        //$('#menu'+i).slideUp('slow');
	      //}
	      //getid.slideToggle('slow');
	      getid.css('display','block');
	    }
	 }
	/*注册表单提交验证*/
	function registerCheck(){
	    var form = document.getElementById("register");
	    if(form.alias.value == ''){
	        alert('昵称不可以为空！');
	        form.alias.focus();
	        return false;
	    }
	    if(form.alias.value.length >10){
	        alert('昵称请不要超过10个字符！');
	        form.alias.focus();
	        return false;
	    }
	    if(form.qq.value == '' || isNaN(form.qq.value) || form.qq.value.length >11 || form.qq.value.length <5){
	        alert('请正确填写QQ号！');
	        form.qq.focus();
	        return false;
	    }
	    if(form.email.value == ''){
	        alert('邮箱不可以为空！');
	        form.email.focus();
	        return false;
	    }
	    /*正则验证邮箱*/
	    var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;  
	    if (!pattern.test(form.email.value)) {
	        alert("请输入正确的邮箱地址。");  
	        form.email.focus();
	        return false;
	    }
	    if(form.pwd.value == ''){
	        alert('密码不可以为空！');
	        form.pwd.focus();
	        return false;
	    }
	    if(form.pwd.value != form.pwd1.value){
	        alert('两次密码不一致！');
	        form.pwd1.focus();
	        return false;
	    }
	    if(form.name.value.length >4){
	        alert('姓名请不要超过4个字符！');
	        form.name.focus();
	        return false;
	    }
/*	    if(form.yzm.value == '' || form.yzm.value.length!='4'){
	        alert('请正确填写验证码！');
	        form.yzm.focus();
	        return false;
	    }*/
	}

	/*注册表单显示效果*/
	function enroll(){
	    var obj = $('#enroll1');
	    if(obj.css('display') == 'block'){
	      $('#quangpin').fadeToggle('slow');
	      obj.fadeToggle('slow');
	      $('#quangpin').detach();
	      $('#header_top .right').css('z-index','99');
	    }else{
	      $('#header_top .right').css('z-index','999');
	      var str = '<div id="quangpin" onclick="enroll()"></div>';
	      $("body").before(str);
	      obj.fadeToggle("slow");
	      $('#quangpin').fadeToggle('slow');
	    }
	}
	/*登陆表单显示效果*/
	function login(){
		var label_width = $('#h_logio').width()/2;
    	$('#h_logio').css('left',$(window).width()/2-label_width);
		var obj = $('#h_logio');
		if(obj.css('display') == 'block'){
	      $('#quangpin').fadeToggle('slow');
	      obj.fadeToggle('slow');
	      $('#quangpin').detach();
	    }else{
	      var str = '<div id="quangpin" onclick="login()"></div>';
	      $("body").before(str);
	      obj.fadeToggle("slow");
	      $('#quangpin').fadeToggle('slow');
	    }
	    setCookie('login_url1',window.location.href);
	}
	//登陆显示
	<!--//获取指定名称的cookie值
	  function getCookie(name){ 
	    var strCookie=document.cookie;
	    var arrCookie=strCookie.split("; ");
	    for(var i=0;i<arrCookie.length;i++){ 
	      var arr=arrCookie[i].split("="); 
	      if(arr[0]==name)return arr[1]; 
	    } 
	    return "";
	  } 
	//-->
	<!--//设置cookie-->
	function setCookie(k1,v1){
		document.cookie = k1 + "=" + v1 + ";";
	}
	<!--//QQ登陆
	function toLogin(){
   		window.location.href = "http://www.alumduan.com/data/qqlogin/example/oauth/index.php";
 	} 
 	//-->

 	function wenqian_show(id){
 		var getid = $("#"+id);
 		var label_width = $("#"+id).width()/2;
    	$("#"+id).css('left',$(window).width()/2-label_width);
	    if(getid.css('display') == 'block'){
	    	getid.css('display','none');
	    }else{
	      getid.css('display','block');
	    }
 	}
 	function tec_show(obj){
 		var str = $(obj).attr('data');
 		$('#tec p').html(str);
 		var label_width = $("#tec").width()/2;
    	$("#tec").css('left',$(window).width()/2-label_width);
 		$('#tec').css('display','block');
 	}
 	function tec_close(){
 		$('#tec').css('display','none');
 	}

 		





