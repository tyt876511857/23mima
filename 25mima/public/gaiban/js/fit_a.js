$('.tabnav a').click(function(){
		var num=$(this).index();
		$(this).addClass('active').siblings().removeClass('active');
		
		$('.tabcont .cont').eq(num).fadeIn().siblings().css('display','none');
		$('.tabcont .cont').eq(num).addClass('show').siblings().removeClass('show');
	});
	
	$("path.ring").each(function() {
		var aa = $(this);

	   // YUNM.debug('path.ring' + aa.selector);

		var r = aa.attr("r");
		var x = aa.attr("x"), rate = aa.attr("rate");

		// 给path 设置属性
		if (rate < 100) {
			var progress = rate / 100;

			// 将path平移到我们需要的坐标位置
			aa.attr('transform', 'translate(' + x + ',' + x + ')');

			// 计算当前的进度对应的角度值
			var degrees = progress * 360;

			// 计算当前角度对应的弧度值
			var rad = degrees * (Math.PI / 180);

			// 极坐标转换成直角坐标
			var x = (Math.sin(rad) * r).toFixed(2);
			var y = -(Math.cos(rad) * r).toFixed(2);

			// 大于180度时候画大角度弧，小于180度的画小角度弧，(deg > 180) ? 1 : 0
			var lenghty = window.Number(degrees > 180);

			// path 属性
			var descriptions = [ 'M', 0, -r, 'A', r, r, 1, lenghty, 1, x, y ];

			aa.attr('d', descriptions.join(' '));
		}
	})