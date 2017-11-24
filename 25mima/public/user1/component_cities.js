/*
 * @description: 城市二级联动扩展函数
 * @author: Bird.An
 * @update: Bird.An (2016-05-18)
 */

(function() {
window.Fn = window.Fn || {};

// 可配置项
// @cfg:
// 	 	@proEl, 省份Select节点
// 	 	@cityEl, 城市Select节点
// 	 	@defaultPro, 默认省份字符串，可选
// 	 	@defaultCity 默认城市字符串，可选
window.Fn.initCitiesSelect = function(cfg) {

		// 输出option标签
		function setOptions(dataArray, defaultStr) {
				var hasDefault = false,
						outputStr = '',
						i;
		
				if (defaultStr && defaultStr !== '') {
						hasDefault = true;
				} else {
						outputStr += '<option value="-1">请选择</option>\n';
				}
		
				for (i=0; i<dataArray.length; i++) {
						outputStr +=
								'<option value="' + dataArray[i].name + '"' +
										((hasDefault && dataArray[i].name === defaultStr) ? ' selected = "selected"' : '')
										+ '>' + dataArray[i].name + '</option>\n';
				}
		
				return outputStr;
		}

		// 渲染城市Select标签
		function renderCities(proEl, cityEl, defaultCity) {
				var cities = window.constant.cities, // 缓存城市静态配置
						cityArray = [],
						i;
		
				// 得到用于渲染option城市数组
				for (i=0; i<cities.length; i++) {
						if (cities[i].name === proEl.val()) {
								cityArray = cities[i].sub;
						}
				}
		
				cityEl.html(setOptions(cityArray, defaultCity));
		}

		var $pro = cfg.proEl,
				$city = cfg.cityEl;
		
		$pro.html(setOptions(window.constant.cities, cfg.defaultPro));
		renderCities($pro, $city, cfg.defaultCity);

		// 改变省份 - 事件绑定
		$pro.on('change', function() {
				renderCities($pro, $city);
		})
};
})();