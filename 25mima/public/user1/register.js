/*
 * @description: 注册功能（验证码发送、表单验证）
 * @author: Caowei
 * @update: Caowei (2015-11-4 16:20)
 */

var fastReg = function(){
    var InterValObj, //timer变量，控制时间
        count = 120, //间隔函数，1秒执行
        curCount = 0,//当前剩余秒数
        sendedSMS = false,
        successCallbackFn;

    // 发送短信验证码
    function sendVerifyCode(mobile,code){
        $.getJSON("/validate/register/sendsms?mobile=" + mobile + "&captcha=" + code, function(result){

            if(!result.code){
                curCount = count;

                //设置button效果，开始计时
                $("#getSMS").attr("disabled", true).addClass('slvzr-disabled');
                $("#getSMS").val(curCount + "秒后重新获取");
                InterValObj = window.setInterval(setRemainTime, 1000); //启动计时器，1秒执行一次
            } else if(result.code == 1000){
                $('#mobileWrapper label.error').show().text(result.msg);
                $('.captcha-img').attr('src', '/validate/captcha?r='+Math.random());
            } else{
                $('#captchaWrapper span.error').show().text(result.msg).siblings('label.error').remove();
                $('.captcha-img').attr('src', '/validate/captcha?r='+Math.random());
            };
            sendedSMS = true;
        });
    };

    //timer处理函数
    function setRemainTime() {

        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#getSMS").removeAttr("disabled").removeClass('slvzr-disabled');//启用按钮
            $("#getSMS").val("重新获取验证码");
        } else {
            curCount--;
            $("#getSMS").val(curCount + "秒后重新获取");
        }
    }

    // 注册请求
    function doReg(data,successCallback){
        $.ajax({
            type: "POST",
                url: "/register",
                contentType: "application/json",
                data: JSON.stringify(data),
                success: function(result){

                if(!result.code){
                    successCallback ? successCallback() : (location.href = result.data || '/register/success');
                } else {
                    alert(result.msg);
                }
            }
        });
    }

    function fastRegValidate(successCallback){
        $("#fastreg").validate({
            onkeyup: false,
            focusInvalid: false,
            focusCleanup: true,
            errorPlacement: function(error,element){
                var error_div = element.parent();
                error_div.append(error);
            },
            ignore: ".captcha" ,
            rules:{
                mobile: {required: true,isMobile: true},
                password: {required: true,stringCheck: true,minlength: 6},
                verifycode: {required: true,stringCheck:true,minlength: 6},
                lawterms: {required: true}
            },
            messages:{
                mobile: {
                    required: "请输入您的手机号码",
                    isMobile: "请输入一个有效的手机号码"
                },
                password: {
                    required: "请输入您的密码",
                    stringCheck: "密码只能包括英文字母、数字和下划线",
                    minlength: "密码至少需要六位"
                },
                verifycode: {
                    required: "请输入短信验证码",
                    stringCheck: "短信验证码格式不正确",
                    minlength: "短信验证码至少六位"
                },
                lawterms: {
                    required: "请阅读并同意本声明"
                }
            },
            success: function(){

                if (curCount != 0) {
                    return;
                };

                if ($('.mobile').hasClass('valid')) {
                    $('#getSMS').attr('disabled', false).removeClass('slvzr-disabled');
                }else if($('.mobile').hasClass('error')){
                    $('#getSMS').attr('disabled', true)
                };
            } ,
            submitHandler:function(form){
                var data = {
                    sex: '1',
                    mobile: $('.mobile').val(),
                    nickName: $('.mobile').val().substr(-4,4),
                    captcha: $('.captcha').val(),
                    verifyCode: $('.verifycode').val(),
                    password: $('.password').val(),
                };
                doReg(data, successCallbackFn);
            }
        });
    }

    return {
    init: function(successCallback){
        successCallbackFn = successCallback;

        $('#switchImg, .captcha-img').on('click', function() {
            $('.captcha').val('');
            $('.captcha-img').attr('src', '/validate/captcha?r='+Math.random());
        });

        $('.captcha').on('focus', function() {
            $('#captchaWrapper span.error').text('');
        });

        $('.getSMS').on('click',function(){
            sendVerifyCode($('.mobile').val(),$('.captcha').val());
        });

        fastRegValidate();
    },
    pompValidate: function(){
        fastRegValidate();
    }
  };
}();
