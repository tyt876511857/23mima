/**
 * ------------------------------------------------------------
 * 09-22 by bomee 修改表单数据收集方式，并修改登录后不能跳转到来源的bug
 * 10-19 by bomee 增加redirect时的hash附带;
 * ------------------------------------------------------------
 */
 var login = function(){
    return {
        init : function(successCallback){
            $.cookie('username') && $.cookie('username')!='null' && $('#username').val($.cookie('username'));

            var errorMsg = {
                username: '请输入正确的手机号码',
                password: '请输入您的登录密码'
            };

            var showError = function(msg){
                $('#failTips label').html(msg);
            };

            $('#login-box').on('submit', function(){
                var params = $(this).serializeArray();

                for(var i = 0, param; param = params[i]; i++){
                    if(param.name == 'username'){
                        $.cookie('username', param.value);
                    }
                    if(!param.value){
                        showError(errorMsg[param.name]);
                        return false;
                    }
                }
                $.ajax({
                    cache: false,
                    type: 'POST',
                    url:  $(this).attr('action') || '/login',
                    data: $.param(params),
                    success: function(result){
                        if(!result.code){
                            showError('');
                            successCallback ? successCallback() : location.href = (result.data || '/') + (location.hash);
                        } else {
                            showError('用户名或密码错误');
                        };
                    },
                    error: function(msg){
                        console.error(msg);
                        showError('服务器忙，请稍后再试');
                    }
                });
                return false;
            });
        }
    }
}();