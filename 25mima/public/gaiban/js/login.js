 $(function () {
     //选项按钮
     $('.login_mothed').on('click', 'span', function () {
         arr = [];
         $(this).addClass('active').siblings().removeClass('active');
         $(this).children('input').attr('checked', 'checked');
         $(this).siblings().children('input').removeAttr('checked');
         var a = $(this).index();
         $('.login_input').eq(a).removeClass('hide').siblings().addClass('hide');

     });
     ///

     var arr = new Array();
     ///
     var Phone = /^1[3|4|5|8]\d{9}$/;
     $('.login_input dl').on('blur keyup', 'input[type=text],input[type=password]', function () {
         var a = $(this).parents('dl').index();
         var b = $(this).attr('name');
         var _this = $(this);
         switch (b) {
         case "phone":
             if (Phone.test($(this).val())) {
                 _this.parent().find('.login_info').addClass('hide');
                 _this.removeClass('false');
                 arr[a] = true;
             } else {
                 _this.parent().find('.login_info').removeClass('hide');
                 _this.addClass('false');
                 arr[a] = false;
             }
             break;
             //修改密码
         case "p1":
             if ($(this).val() != "" | undefined | null) {
                 if (_this.val() == $('input[name=p2]').val()) {
                     $('input[name=p2]').parent().find('.login_info').addClass('hide');
                     $('input[name=p2]').removeClass('false');
                     arr[a + 1] = true;
                 } else {
                     $('input[name=p2]').parent().find('.login_info').removeClass('hide');
                     $('input[name=p2]').addClass('false');
                     arr[a + 1] = false;
                 };
                 _this.parent().find('.login_info').addClass('hide');
                 _this.removeClass('false');
                 arr[a] = true;
             } else {
                 _this.parent().find('.login_info').removeClass('hide');
                 _this.addClass('false');
                 arr[a] = false;
             }
             break;
         case "p2":
             if ($(this).val() != "" | undefined | null) {
                 if (_this.val() == $('input[name=p1]').val()) {
                     _this.parent().find('.login_info').addClass('hide');
                     _this.removeClass('false');
                     arr[a] = true;
                 } else {
                     _this.parent().find('.login_info').removeClass('hide');
                     _this.addClass('false');
                     arr[a] = false;
                 }
             } else {
                 _this.parent().find('.login_info').removeClass('hide');
                 _this.addClass('false');
                 arr[a] = false;
             }
             break;
         default:
             if ($(this).val() != "" | undefined | null) {
                 _this.parent().find('.login_info').addClass('hide');
                 _this.removeClass('false');
                 arr[a] = true;
             } else {
                 _this.parent().find('.login_info').removeClass('hide');
                 _this.addClass('false');
                 arr[a] = false;
             }
             break;
         };
     });
     //登录按钮
     $('.login_btn').click(function (e) {
         $(this).parents('.login_input').find('input[type=text],input[type=password]').blur();
         console.log(arr);
         if ($.inArray(false, arr) != -1) {
             e.preventDefault();
         }
     });

     ///发送验证码
     var tt = true,
         Timer,
         PhoneEx = /^1[3|4|5|8]\d{9}$/;
     $('.login_phone').on('blur', function () {
         var _this = $(this);
         if (!PhoneEx.test($(this).val())) {
             $('.sendCode').removeClass('active');
             $('.sendCode').off('click');
         } else {
             $('.sendCode').addClass('active');
             $('.sendCode').on('click', function () {
                 if (!tt)
                     return false;
                 tt = false;
                 var codeTime = 2
                 clearInterval(Timer);
                 var sed = $(this);
                 Timer = setInterval(function () {
                     codeTime--;
                     if (codeTime < 0) {
                         sed.html("重新发送验证码");
                         tt = true;
                     } else {
                         sed.html(codeTime);
                     }
                 }, 1000);

             });
         };
     });









 });