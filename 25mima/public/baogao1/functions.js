function cusSelect(){
  $(".sel_wrap").bind("change", function() {
      var o,i =0;
    var opt = $(this).find('option');

    opt.each(function(i) {
      if (opt[i].selected == true) {
          o = opt[i].innerHTML;
        return false;
      }
      })
      $(this).find('label').html(o);
    }).trigger('change');
}

/*日期选择框控件*/
(function ($) {
	//SELECT控件设置函数
	function setSelectControl(oSelect, iStart, iLength, iIndex) {
		oSelect.empty();
		for (var i = 0; i < iLength; i++) {
			// if ((parseInt(iStart) + i) == iIndex)
			//     oSelect.append("<option selected='selected' value='" + (parseInt(iStart) + i) + "'>" + (parseInt(iStart) + i) + "</option>");
			// else
				oSelect.append("<option value='" + (parseInt(iStart) + i) + "'>" + (parseInt(iStart) + i) + "</option>");
		}
	}

	$.fn.DateSelector = function (options) {
		options = options || {};

		//初始化
		this._options = {
			ctlYearId: null,
			ctlMonthId: null,
			ctlDayId: null,
			defYear: 0,
			defMonth: 0,
			defDay: 0,
			minYear: 1882,
			maxYear: new Date().getFullYear()
		}

		for (var property in options) {
			this._options[property] = options[property];
		}

		this.yearValueId = $("#" + this._options.ctlYearId);
		this.monthValueId = $("#" + this._options.ctlMonthId);
		this.dayValueId = $("#" + this._options.ctlDayId);

		var dt = new Date(),
		iMonth = parseInt(this.monthValueId.attr("data") || this._options.defMonth),
		iDay = parseInt(this.dayValueId.attr("data") || this._options.defDay),
		iMinYear = parseInt(this._options.minYear),
		iMaxYear = parseInt(this._options.maxYear);

		this.Year = parseInt(this.yearValueId.attr("data") || this._options.defYear) || dt.getFullYear();
		this.Month = 1 <= iMonth && iMonth <= 12 ? iMonth : dt.getMonth() + 1;
		this.Day = iDay > 0 ? iDay : dt.getDate();
		this.minYear = iMinYear && iMinYear < this.Year ? iMinYear : this.Year;
		this.maxYear = iMaxYear && iMaxYear > this.Year ? iMaxYear : this.Year;

		//初始化控件
		//设置年
		setSelectControl(this.yearValueId, this.minYear, this.maxYear - this.minYear + 1, this.Year);
		//设置月
		setSelectControl(this.monthValueId, 1, 12, this.Month);
		//设置日
		var daysInMonth = new Date(this.Year, this.Month, 0).getDate(); //获取指定年月的当月天数[new Date(year, month, 0).getDate()]
		if (this.Day > daysInMonth) { this.Day = daysInMonth; };
		setSelectControl(this.dayValueId, 1, daysInMonth, this.Day);

		var oThis = this;
		//绑定控件事件
		this.yearValueId.change(function () {
			oThis.Year = $(this).val();
			setSelectControl(oThis.monthValueId, 1, 12, oThis.Month);
			oThis.monthValueId.change();
		});
		this.monthValueId.change(function () {
			oThis.Month = $(this).val();
			var daysInMonth = new Date(oThis.Year, oThis.Month, 0).getDate();
			if (oThis.Day > daysInMonth) { oThis.Day = daysInMonth; };
			setSelectControl(oThis.dayValueId, 1, daysInMonth, oThis.Day);
			cusSelect();
		});
		this.dayValueId.change(function () {
			oThis.Day = $(this).val();
			cusSelect();
		});
	}
})(jQuery);


  // jquery validate扩展方法
  jQuery.validator.addMethod("stringCheck", function(value, element) {
	  return this.optional(element) || /^[\u0391-\uFFE5\w\.]+$/.test(value);
  }, "只能包括中文字、英文字母、数字、下划线和小数点");

  jQuery.validator.addMethod("username", function(value, element) {
	  return this.optional(element) || /^([\u0391-\uFFE5\w\.] ?)+$/.test(value);
  }, "只能包括中文字、英文字母、数字、下划线、小数点和空格");

  jQuery.validator.addMethod("sfzhCheck", function(value, element) {
	  return this.optional(element) || /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(value);
  }, "请输入正确的身份证号码");

  jQuery.validator.addMethod("isMobile", function(value, element) {
	  var length = value.length;
	  var mobile = /^(1+\d{10})$/;
	  return this.optional(element) || (length == 11 && mobile.test(value));
  }, "请正确填写您的手机号码");
  //验证手机号或者邮箱
  jQuery.validator.addMethod("isMobiloremail", function(value, element) {
	  var length = value.length;
	  var mobile = /^(1+\d{10})$/;
	  var mail = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
	  if(!isNaN(value)){
		return this.optional(element) || (length == 11 &&  mobile.test(value));
	  }else{
		return this.optional(element) || (mail.test(value));
	  }
  }, "请正确填写您的手机号码或者邮箱");

  jQuery.validator.addMethod("notDefault", function(value, element) {
	  return element.selectedIndex > 0;
  }, "请确认您的地址");

  jQuery.validator.addMethod("regex", function(value, element, regex) {
	  return this.optional(element) || regex.test(value);
  }, "请输入正确的格式");
