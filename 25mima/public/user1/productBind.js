var productBind = function(){
	var isUpdateSex = true,
		data = null;

	function setDefault(){
		var d = new Date();
	  	$('#selYear').val(d.getFullYear());
	  	$('#selMonth').val(1);
	  	$('#selDay').val(1);
	  	cusSelect();
	}

	function recoverRecord(object){
	  	isUpdateSex = true;
	  	data = object;
	  	object.sex == '1' ? $('#rcv-sex-detection  .rcvMale').trigger("click") : $('#rcv-sex-detection  .rcvFamale').trigger("click");
	  	isUpdateSex = !(object.detectionStatus >= 16 && object.detectionStatus <= 18 || object.detectionStatus == 3);
	  	$('.rcvName').val(object.name);
	  	$('.rcvNumber').val(object.barCode).attr('disabled', true);
	  	$("#rcv-sex-detection input").attr('disabled', !isUpdateSex);
	  	!isUpdateSex ? $('#modifyTip').html('<i class="iCue"></i>基因检测报告出来以后，性别与出生日期不可更改') : $('#modifyTip').html('<i class="iCue"></i>您的检测报告将在我们收到回寄之后的30天左右给出');

	  	if(object.authorize){
		  	object.authorize == '1' ? $('.authorize').text('同意授权').attr('data-authorize', '1') : $('.authorize').text('不同意授权').attr('data-authorize', '0');
	  	}else{
	  		popUpWindow();
	  	}

	  	if(object.birthday){
	  		var birthday = object.birthday.split('-');
	  		$('#selYear').val(birthday[0]);
	  		$('#selMonth').val(birthday[1]);
	  		$('#selDay').val(birthday[2]);
	  		cusSelect();
	  		$("#datePick select").attr('disabled', !isUpdateSex);
	  	}

	}

	

	return {
		init: function(obj){

			setDefault();
			

			$("#rcv-sex-detection .rcvMale, #rcv-sex-detection .rcvFamale").click(function(){
				if(isUpdateSex){
					$(this).children().addClass('checked');
					$(this).siblings().children().removeClass('checked');
				}
			});

			// 获取编号框
			$("#getNum").click(function (e) {
			  $('#numPomp').modal({
			    "opacity":40,
			    "overlayClose":true,
			    "containerId":"numPomp-container",
			    "overlayId":"numPomp-overlay"
			  });
			  return false;//避免页面跳转
			});

			//!common.isEmptyObj(obj) ? recoverRecord(obj) : popUpWindow();

		}
	};
}();



