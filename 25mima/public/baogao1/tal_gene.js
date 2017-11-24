$(function(){
	// 判断是否开启上一项或者下一项
	// 当前显示的文章的索引
	var current_index = parseInt($(".tal-suggest-current").attr('suggest-index')),

		// 总文章
		$suggest = $(".talg-detail-box .talg-suggest-box"), 
		suggests = $suggest.length -1;

	if ( current_index === 0 ) {
		$(".talg-switch-pre").addClass('talg-switch-none');
	} else if ( current_index === suggests ){
		$(".talg-switch-next").addClass('talg-switch-none');
	}


	$(".talg-switch-pre").click(function(event) {
		var current_index = parseInt($(".tal-suggest-current").attr('suggest-index'));
		// 如果上一项是第一项关闭向上按钮
		if (current_index === 0 ) return;
		if ( current_index - 1 === 0 ) {
			$(".talg-switch-pre").addClass('talg-switch-none');
		} 
		$($suggest[(current_index)]).removeClass('tal-suggest-show tal-suggest-current');
		$($suggest[(current_index - 1)]).addClass('tal-suggest-show tal-suggest-current');
		$(".talg-switch-next").removeClass('talg-switch-none');

	});

	$(".talg-switch-next").click(function(event) {
		var current_index = parseInt($(".tal-suggest-current").attr('suggest-index'));
		// 如果上一项是第一项关闭向上按钮
		if (current_index === 2 ) return;
		if ( current_index + 1 === suggests ) {
			$(".talg-switch-next").addClass('talg-switch-none');
		}
		$($suggest[(current_index)]).removeClass('tal-suggest-show tal-suggest-current');
		$($suggest[(current_index + 1)]).addClass('tal-suggest-show tal-suggest-current');
		$(".talg-switch-pre").removeClass('talg-switch-none');
		
	});
})