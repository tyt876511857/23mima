$(function() {
	$('.mark').css({
		height: $(document).height() + 'px',
	});
	$('header').on('click', 'a', function() {
		var a = $(this).index();
		$('.mark').eq(a).toggleClass('show');
		$('.mark').eq(a).siblings('.mark').removeClass('show');
	});
	$('.user_detial').css('top', "40px");
	$('.menu_list').css('top', "40px");

});