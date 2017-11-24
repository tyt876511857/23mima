$.ajax({url:'/index/Jsget/goods_stars',success:function(){}, async: false,
	success:function(msg){
		stars = eval('(' + msg + ')');
	}
});
var stars_url = $("script").last().attr("src");
var stars_len = stars_url.indexOf('id=')+3;
var stars_id  = stars_url.substring(stars_len);
//stars_id= stars_id.replace(/(^\s*)|(\s*$)/g, ""); //去除空白
document.write('<a style="width:'+stars[stars_id]+'%;"></a>');