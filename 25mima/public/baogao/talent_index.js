$(function() {
		// 根据0~360度数值得到图表X轴Label
		function getXAxis(degree) {
				switch (degree) {
				case 0:
						return '情景记忆';
				case 40:
						return '数学';
				case 80:
						return '学习';
				case 120:
						return '专注';
				case 160:
						return '语言表达'
				case 200:
						return '创造';
				case 240:
						return '自律';
				case 280:
						return '音乐';
				case 320:
						return '运动';
				}
		}

		// 图表配置
		$('#tal-polar').highcharts({
				chart: {
						polar: true,
						height: 335
						//backgroundColor: '#99dfe7'
				},
				title: {
						text: null
				},
				pane: {
						startAngle: 0,
						endAngle: 360
				},
				xAxis: {
						tickInterval: 40,
						min: 0,
						max: 360,						
						labels: {
								formatter: function() {
										return getXAxis(this.value);
								}
						},
						gridLineColor: '#e9edee'
				},
				yAxis: {
						min: 0,
						max: 5,
						tickInterval: 1,
						labels :{
								enabled: false
						},
						gridLineColor: '#f0f0f0'
				},
				plotOptions: {
						series: {
								pointStart: 0,
								pointInterval: 40
						},
						column: {
								pointPadding: 0,
								groupPadding: 0
						}
				},
				series: [{
						type: 'area',
						data: serverData.starArray
				}],
				tooltip: {
						enabled: false
				},
				legend: {
						enabled: false
				},
    		credits:{
    				enabled: false
    		}
		});

		// 基因板块点击 - 事件绑定
		$('.tal-main-gene').on('click', function() {
				window.location.href = $(this).attr('data');
		});

		// 参考文献查看更多 - 事件绑定
		$('.j_more').on('click', function() {
				$(this).hide();
				$('.j_items').show();
		});
});