/*
 * @description: 参考文献弹窗 组件JS
 * @author: Bird.An
 * @update: Bird.An (2016-05-13 16:00)
 * @require: jquery, md_literature.jsp
 */

$(function() {
		$('body').on('click', '.md-literature', function() {
				var $this = $(this),
						index = $('.md-literature').index($this);

  			$('.md-literature-pop').eq(index).modal({
  			  	"opacity": 60,
  			  	"overlayClose": true,
  			  	"containerId": "md-literature-pop-container",
  			  	"overlayId": "md-literature-pop-overlay"
  			});

  			// 谷歌分析
  			ga('send', 'event', 'button', 'click', 'view-document', 1);
		});
});