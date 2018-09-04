function login() {
    email=$('#email').val();
    password=$('#password').val();
    if(email==''||password==''){
        layer.alert('你的账号或者密码不能为空');
        return;
    }
    $.ajax({
        type:'post',
        url:'seadmin',
        data:{email:email,password:password},
        dataType: 'JSON',
        success :function (data) {
            console.log(data);
            return;
            if(data==0){
                layer.alert("账号或者密码错误");
            }else {
                location.href='showreart';
            }
        }
    })
}