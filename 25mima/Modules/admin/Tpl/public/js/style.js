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
	$(function(){
		$(':submit').click(function(){
			//$(':submit').attr('disabled','true');
			$(this).css('display','none');
		});
	});
