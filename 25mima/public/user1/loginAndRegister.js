var loginAndRegister = function(){
	var isInit = false;
	// pomp窗口登录／注册模块切换
	function logRegSwitch(){
		$('#regNow').on('click', function() {
			$('#logTab').hide();
			$('#regTab').show();
		});
		$('#logNow').on('click', function() {
			// 谷歌分析
			ga('send', 'event', '开始注册-跳转至登录');

			$('#regTab').hide();
			$('#logTab').show();
		});
	}

	return {
		init: function(successCallback){
			login.init(successCallback);
			fastReg.init(successCallback);
			isInit = true;
		},

		showPopm: function(successCallback){
			$('.captcha-img').attr('src', '/validate/captcha?r='+Math.random());

			//$('#LogRegPomp').modal({
			$.modal($('#pop_template').html(),{
				"opacity":30,
				"overlayClose":false,
				"onShow": function(){
					// 谷歌分析
					ga('send', 'event', '开始注册');

					loginAndRegister.init(successCallback);
					fastReg.pompValidate();
				},
				"containerId":"LogRegPomp-container",
				"overlayId":"LogRegPomp-overlay"
			});
			logRegSwitch();
		},
		hidePopm:function(){
		    
		}
	}
}();