function Check(){
    var form = document.getElementById("form");
    if(form.str.value == ''){
        alert('查询号码不可以为空！');
        form.str.focus();
        return false;
    }
    if(form.yzm.value == '' || form.yzm.value.length!='4'){
        alert('请正确填写验证码！');
        form.yzm.focus();
        return false;
    }

}