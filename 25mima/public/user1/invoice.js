$(function(){
    // 不开发票
    $(".j-invoice-none").on('click', function(event) {
        $(this).addClass('invoice-choose-current').siblings().removeClass('invoice-choose-current');
        // 重置发票的内容
        $('#fapiao').val(0);//不开发票
        $(".j-normal-info, .j-vat-info").hide();
        $("#invoice-status").attr("data-category", "0");
        console.log($("#invoice-status").attr("data-category"));
    });

    // 普通发票填写逻辑 && 普通发票个人和单位切换显示填写单位的input
    $(".j-invoice-normal").on('click', function(event) {
        $(".invoice-shade, .invoice-normal-wrap").show();
        $(".invoice-choose span").on('click', function(event) {
            $(this).addClass('invoice-choose-current').siblings().removeClass('invoice-choose-current');
            if($(this).index()===2){
                $(".invoice-company-box").show();
            }else {
                $(".invoice-company-box").hide();
            }
        });

        // 单位类型发票判断用户输入
        $(".invoice-normal-company").keyup(function() {
            if ($(this).val()!== '') {
                $(".invoice-company-box").removeClass('invoice-normal-error');
            }else {
                $(".invoice-company-box").addClass('invoice-normal-error');
            };
        });

        // 提交普通发票信息
        $(".invoice-normal-submit").on('click', function(event) {

            // 判断选择是不是单位发票 ？ 判断单位名称是否为空：默认为个人
            var companyVal = $(".invoice-normal-company").val(),
                comopanyStatus = $(".j-choose-company").hasClass('invoice-choose-current');
            if ( comopanyStatus ) {
                if ( companyVal!== '' ) {
                    $(".j-invoice-normal-info").text(companyVal);
                    $(".invoice-shade, .invoice-normal-wrap").hide();
                     $('#fapiao').val(2);//公司发票
                }
            }else {
                $(".j-invoice-normal-info").text('个人');
                $(".invoice-normal-company").val('');
                $(".invoice-shade, .invoice-normal-wrap").hide();
                 $('#fapiao').val(1);//个人发票
            }

            $(".j-normal-info").show();
            $(".invoice-choose-uncurrent").eq(1).addClass('invoice-choose-current').siblings().removeClass('invoice-choose-current');
            $("#invoice-status").attr("data-category", "1");
        });
    });

    // 增值税发票
    $(".j-invoice-vat").on('click', function(event) {
        $(".invoice-vat-wrap, .invoice-shade").show();

        // 增值税发票下一步
        $(".invoice-vat-next").on('click', function(event) {
            var r1 = $('[name=vat_companyName]').val();
            var r2 = $('[name=vat_code]').val();
            var r3 = $('[name=vat_address]').val();
            var r4 = $('[name=vat_tel]').val();
            var r5 = $('[name=vat_bank]').val();
            var r6 = $('[name=vat_bank_num]').val();
            if(r1=='' || r2=='' || r3=='' || r4=='' || r5=='' || r6==''){
              alert('请完整填写公司信息！');
              return false;
            }
            
            /*if(r4.length!='11'){
              alert('请正确填写电话号！');
              return false;
            }*/
            //if ($("#invoice-vat-fm").validate()) {
                $(".invoice-vat-fm-step-one").hide();
                $(".invoice-vat-fm-step-two").show();
                $(".invoice-vat-step1").removeClass('invoice-vat-step-current');
                $(".invoice-vat-step2").addClass('invoice-vat-step-current')
            //};
        });

        // 提交
        $(".invoice-vat-over").on('click', function(event) {
            var r1 = $('[name=vat_name]').val();
            var r2 = $('[name=vat_message_tel]').val();
            var r3 = $('[name=vat_country]').val();
            var r4 = $('[name=vat_receive_address]').val();
            if(r1=='' || r2=='' || r3=='' || r4==''){
              alert('请完整填写收票人信息！');
              return false;
            }
            //if ($("#invoice-vat-fm-two").valid()) {
                $(".j-invoice-vat-info").text($(".j-invoice-vat-company").val());
                $(".j-vat-info").show();
                $(".invoice-vat-wrap, .invoice-shade").hide();
                $("#invoice-status").attr("data-category", "2");
            //};
            $(".j-normal-info").hide();
            $(".invoice-choose-uncurrent").eq(2).addClass('invoice-choose-current').siblings().removeClass('invoice-choose-current');
            $('#fapiao').val(3);//增值发票
        });

    });

    $(".invoice-vat-pre").on('click', function(event) {
        $(".invoice-vat-fm-step-one").show();
        $(".invoice-vat-fm-step-two").hide();
        $(".invoice-vat-step2").removeClass('invoice-vat-step-current');
        $(".invoice-vat-step1").addClass('invoice-vat-step-current')
    });

    // 关闭发票
    $(".invoice-normal-cancel").on('click', function(event) {
        $(".invoice-shade, .invoice-normal-wrap").hide();
    });

    $(".invoice-vat-cancel").on('click', function(event) {
        $(".invoice-vat-wrap, .invoice-shade").hide();
    });
  
    //增值税发票第一步的验证
    $("#invoice-vat-fm").validate({
        rules:{
            vat_companyName:{
              required:true
            },
            vat_code:{
              required:true
            },
            vat_address:{
              required:true
            },
            vat_tel:{
              required:true,
              isMobile: true
            },
            vat_bank:{
              required:true
            },
            vat_bank_num:{
              required:true
            }

        },
        messages:{
            vat_companyName:{
              required:"单位名称不能为空"
            },
            vat_code:{
              required:"纳税人识别码不能为空"
            },
            vat_address:{
              required:"注册地址不能为空"
            },
            vat_tel:{
              required:"注册电话不能为空",
              isMobile: "不是有效的手机号码"
            },
            vat_bank:{
              required:"开户银行不能为空"
            },
            vat_bank_num:{
              required:"银行账户不能为空"
            }
        }
    });

    //增值税发票第2步的验证
    $("#invoice-vat-fm-two").validate({
        rules:{
          vat_name:{
            required:true,
            stringCheck: true
          },
          vat_message_tel:{
            required:true,
            isMobile: true
          },
          vat_province: {
            notDefault:true,
          },
          vat_city: {
            notDefault:true,
          },
          vat_receive_address:{
            required:true
          }
        },
        messages:{
          vat_name:{
            required:"收票人姓名不能为空",
            stringCheck: "姓名只能包括中文字、英文字母、数字和下划线"
          },
          vat_province: {notDefault: "请选择省份"},
          vat_city: {notDefault: "请选择城市"},
          vat_message_tel:{
            required:"收票人手机不能为空",
            isMobile: "请输入一个有效的手机号码"
          },
          vat_receive_address:{
            required:"详细地址不能为空"
          }
        }
    });

});
