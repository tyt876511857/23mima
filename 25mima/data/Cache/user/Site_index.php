<html>
<head>
<title>管理中心</title>
<meta http-equiv='Content-Type' content='text/html';charset='utf-8'>
<?php $this->display('index:Index:css','lib') ?>
<?php $this->display('css','lib') ?>
</head>
<body id="site">
<?php $this->display('index:Index:header','lib') ?>
<div class="w1200">
	<?php $this->display('left','lib') ?>
	<div class="user_right">
        <p class="user_title">收货地址</p>
		<script type="text/javascript" src="/public/user/GlobalProvinces_main.js"></script>
		<script type="text/javascript" src="/public/user/GlobalProvinces_extend.js"></script>
		<script type="text/javascript" src="/public/user/initLocation.js"></script>
			<ul id="alladdress">
                <li><span class="name">姓名</span><span class="phone">手机</span><span class="sheng">省</span><span class="shi">市</span><span class="xian">区</span><span class="site">详细地址</span><span class="encoding">邮编</span><span class='chaozuo'>操作</span></li>
				<?php foreach ($site as $v){ ?>
				<li class="s<?php if(isset($v['id'])){echo $v['id'];} ?>"><input name="site" type="radio" value="<?php if(isset($v['id'])){echo $v['id'];} ?>"><span class='name'><?php if(isset($v['name'])){echo $v['name'];} ?></span><span class='phone'><?php if(isset($v['phone'])){echo $v['phone'];} ?></span><span class='sheng'><?php if(isset($v['sheng'])){echo $v['sheng'];} ?></span><span class='shi'><?php if(isset($v['shi'])){echo $v['shi'];} ?></span><span class='xian'><?php if(isset($v['xian'])){echo $v['xian'];} ?></span><span class='site'><?php if(isset($v['site'])){echo $v['site'];} ?></span><span class='encoding'><?php if(isset($v['encoding'])){echo $v['encoding'];} ?></span><span class='chaozuo'><a onclick="upSite(this)">修改</a><a href='<?php echo U("Site/delete/id/$v[id]") ?>'>删除</a></span></li>
				<?php } ?>
			</ul>
            <a onclick="$(address).css('display','block');";>添加新地址</a>
			<div id="address" <?php if($site){ ?>style='display:none'<?php } ?>>
				<p><span>* 收 货 人</span><input type="text" name="address[name]" /></p>
				<p>
					<span>* 区&nbsp;&nbsp;&nbsp;&nbsp;域</span>
					<select id="sheng" name="address[province]"></select>
					<select id="shi" name="address[city]">	</select>
					<select id="xian" name="address[country]" ></select>
					<select id="xiang" name="address[street]" ></select>
				</p>
				<p><span>* 地&nbsp;&nbsp;&nbsp;&nbsp;址</span><input type="text" class="site" name="address[site]" /></p>
				<p><span>* 邮政编码</span><input type="text" name="address[encoding]" /></p>
				<p><span>* 手机号码</span><input type="text" name="address[phone]" /></p>
				<input type="hidden" name="address[id]" value='0' />
				<p><input name="buttom" id="buttom" type="button" onclick='addSite()' value="提交" /></p>
			</div>
	</div>
</div>
<?php $this->display('index:Index:footer','lib') ?>
</body>
</html>
<script>
	initLocation({sheng_val:sheng,shi_val:shi,xian_val:xian});
	//判断地址正确性并提交收货地址
    function addSite(){
    	//判断地址正确性
    	if($('[name="address[name]"]').val()=='' || $('[name="address[country]"]').val()=='' || $('[name="address[site]"]').val()=='' || $('[name="address[phone]"]').val()==''){
    		alert('收货地址信息不正确！');
    		return false;
    	}else if($('[name="address[name]"]').val().length>4){
    		alert('姓名请小于4个字符！');
    		return false;
    	}else if($('[name="address[phone]"]').val().length!=11){
    		alert('手机号码不正确');
    		return false;
    	}
    	$.post("<?php echo U('Site/addSite','user') ?>",{
    		id:$('[name="address[id]"]').val(),
    		name:$('[name="address[name]"]').val(),
    		sheng:$('[name="address[province]"]').val(),
    		shi:$('[name="address[city]"]').val(),
    		xian:$('[name="address[country]"]').val(),
    		site:$('[name="address[site]"]').val(),
    		phone:$('[name="address[phone]"]').val(),
    		encoding:$('[name="address[encoding]"]').val(),
    	},
        function(data,status){
        	//$('#address').css('display','none');
        	var dataobj = eval("(" +data +")");
        	var str = '<li class="s'+dataobj.id+'"><input name="site" type="radio" value="'+dataobj.id+'" checked="checked"><span class="name">'+dataobj.name+'</span><span class="phone">'+dataobj.phone+'</span><span class="sheng">'+dataobj.sheng+'</span><span class="shi">'+dataobj.shi+'</span><span class="xian">'+dataobj.xian+'</span><span class="site">'+dataobj.site+'</span><span class="encoding">'+dataobj.encoding+'</span><span class="chaozuo"><a onclick="upSite(this)">修改</a><a href="<?php echo U("Site/delete/id/'+dataobj.id+'") ?>">删除</a></span></li>';
        	var body = $('#alladdress');
        	$('#alladdress .s'+dataobj.id).remove();
        	$('[name="address[id]"]').val(0);
        	$(str).appendTo(body);
        	$('#address').css('display','none');
			//var dataobj = eval("(" +data +")");
        	//alert(dataobj.name);
        });
    }
    function upSite(obj){
    	var li = obj.parentNode.parentNode;
    	var id = $(li).find('[name="site"]').val();
    	var name = $(li).find('.name').html();
    	var phone = $(li).find('.phone').html();
    	var sheng = $(li).find('.sheng').html();
    	var shi = $(li).find('.shi').html();
    	var xian = $(li).find('.xian').html();
    	var site = $(li).find('.site').html();
    	var encoding = $(li).find('.encoding').html();

    	$('[name="address[id]"]').val(id);
    	$('[name="address[name]"]').val(name);
    	$('[name="address[phone]"]').val(phone);
    	$('[name="address[site]"]').val(site);
    	$('[name="address[encoding]"]').val(encoding);
    	initLocation({sheng_val:sheng,shi_val:shi,xian_val:xian});

    	//$(li).remove();
    	$('#address').css('display','block');
    }
</script>