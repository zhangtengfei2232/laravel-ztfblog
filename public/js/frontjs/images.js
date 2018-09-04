//token验证
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

//去后台请求查询相册密保，显示相册问题
function showiamges(obj){
    var albumjuge=$(obj).attr('rel');
    var albumid=$(obj).parent().attr('rel');
    if(albumjuge==0||albumjuge==3){
            layer.alert('主人什么也没留下');
            return;
    }else if(albumjuge==1){
          var albumid=$(obj).parent().attr('rel');
          $.ajax({
              type:'GET',
              url:'seques',
              data:{albumid:albumid},
              dataType:'json',
              success :function (data) {
                  $('#modal').modal('show');
                  $('.relpy').attr('rel',albumid);
                  $('#ques').val(data[0].al_ques);
              }
          });
          return;
      }else{
          location.href='showimages?albumid='+albumid;
      }
}
//去后台查问题答案，比较游客是否输入的答案是否正确
function showimgans(obj) {
    var  ques=$('#ques').val();
    var  ans=$('#amswer').val();
    var albumid=$(obj).attr('rel');
    if(ans==""||albumid==""||ques==""){
        layer.alert('你没有输入的不合法');
        return;
    }
    $.ajax({
        type:'GET',
        url:'seans',
        data:{ans:ans,albumid:albumid,ques:ques},
        dataType:'json',
        success:function(data){
            if(data==0){
                layer.alert('你没有这张脸');
            }else if(data==1){
                location.href='showimages?albumid='+albumid;
            }
        }
    });
}
//清空模态框中游客输入的内容
function emptyque() {
    $('#ques').val(" ");
    $('#amswer').val(" ");
}
function mynavs(typeid){
    $('#artical').css("color","#cd7e00");
    $('#type'+typeid).css("background-color","#075498");
}
//用户登录
function userlogin() {
    var account=$('#account').val();
    var password=$('#passwords').val();
    var code=$('#mycode').val();
    $.ajax({
        type:'POST',
        url:'useenter',
        data:{account:account,password:password,code:code},
        dataType:'json',
        success:function(data){
            if(data!=1){
                layer.alert(data);
                showcodes();
            }else {
                location.reload();
            }
        },
        error: function(msg){
            // console.log(msg)
            var info="";
            var json=JSON.parse(msg.responseText);
            console.log(json);
            for (value in json)
                info+=json[value];
                layer.alert(info);
                    showcodes();
        },
    });
}
//管理员登录
function malogin() {
    var account=$('#accounttext').val();
    var password=$('#passwordtext').val();
    var code=$('#macode').val();
    $.ajax({
        type:'POST',
        url:'enterback',
        data:{account:account,password:password,code:code},
        dataType:'json',
        success:function(data){
            console.log(data);
            if(data==2){
                layer.alert('你已经登录过了');
                return;
            }else if(data==1){
                location.href="showreart";
            }else {
                layer.alert(data);
                showcodes();
            }
        },
        error: function(msg){
            // console.log(msg)
            var info="";
            var json=JSON.parse(msg.responseText);
            console.log(json);
            for (value in json)
                info+=json[value];
            layer.alert(info);
            showcodes();
        },
    });
}
function showcodes() {
    $url = window.location.host+'/captcha';
    $url = 'http://'+$url + "/" + Math.random();
    $('#code').attr("src",$url);
}
//清空登录模态框
function emptylogins() {
    var account=document.getElementById('account');
    var mycode=document.getElementById('mycode');
    var passwords=document.getElementById('passwords');
    account.value='';
    mycode.value='';
    passwords.value='';
}
//显示登录模态框
function showlogin() {
    $('#login').modal('show');
}
//清空模态框内容
function emptyenters() {
    //修改昵称
    $('#usecontame').val(" ");
    $('#usepsd').val(" ");
    var usepsd=document.getElementById('usepsd');
    usepsd.value='';
    $('#usname').val(" ");
    //管理员和用户修改密码
    $('#oldpwd').val(" ");
    $('#upusecount').val(" ");
    $('#newpwd').val(" ");
    var oldpwd=document.getElementById('oldpwd');
    var newpwd=document.getElementById('newpwd');
    oldpwd.value='';
    newpwd.value='';
    //修改密保
    $('#upquescont').val(" ");
    $('#upquespwd').val(" ");
    $('#newques').val(" ");
    var upquespwd=document.getElementById('upquespwd');
    var newques=document.getElementById('newques');
    upquespwd.value='';
    newques.value='';
    //找回密码
    $('#usecount').val(" ");
    $('#quess').val(" ");
    $('#usepwd').val(" ");
    var quess=document.getElementById('quess');
    var usepwd=document.getElementById('usepwd');
    quess.value='';
    usepwd.value='';
}
//管理员登录后台界面清空模态框内容
function emptyenter() {
    //管理员和用户找回密码
    var usepwd=document.getElementById('usepwd');
    var usecount=document.getElementById('usecount');
    var ques=document.getElementById('ques');
    usecount.value='';
    ques.value='';
    usepwd.value='';
    //管理员和用户修改密码
    var oldpwd=document.getElementById('oldpwd');
    var upusecount=document.getElementById('upusecount');
    var newpwd=document.getElementById('newpwd');
    upusecount.value='';
    newpwd.value='';
    oldpwd.value='';
}
//清空管理员找回密码的模态框
function emrepwdmodal() {
    //管理员和用户找回密码
    var usepwd=document.getElementById('usepwd');
    var usecount=document.getElementById('usecount');
    var ques=document.getElementById('ques');
    usecount.value='';
    ques.value='';
    usepwd.value='';
}
//用户注册前验证
function adduser() {
    var adname=$('#adname').val();
    var adusecount=$('#adusecount').val();
    var adques=$('#adques').val();
    var adusepwd=$('#adusepwd').val();
    var readusepwd=$('#readusepwd').val();
    var myReg=/^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
    if(adname==""||adusecount==""||adques==""||adusepwd==""||readusepwd==""){
        layer.alert("你输入的不合法");
        return;
    }
    if(myReg.test(adusecount)){
        if(adusepwd!=readusepwd){
            layer.alert("你两次输入的密码不一样");
            return;
        }else {
            $('#addusersform').submit();
        }
    }else {
        layer.alert("你输入的账号不是邮箱");
        return;
    }
}
function ddempty() {
    //注册
    var adname=document.getElementById('adname');
    var adusepwd=document.getElementById('adusepwd');
    var adusecount=document.getElementById('adusecount');
    var adques=document.getElementById('adques');
    var readusepwd=document.getElementById('readusepwd');
    adname.value='';
    adusecount.value='';
    adques.value='';
    adusepwd.value='';
    readusepwd.value='';
}
//修改密码
function upmapwds(){
    var upusecount= $('#upusecount').val();
    var oldpwd= $('#oldpwd').val();
    var newpwd= $('#newpwd').val();
    var reg = new RegExp("\\s");
    var r = newpwd.substr(1).match(reg);
    if(r!=null){
        layer.alert('你输入的新密码有空格');
        return;
    }
    if(upusecount==""||oldpwd==""||newpwd==""){
        layer.alert('你少输入东西');
        $('#uppwd').modal('show');
        return;
    }else {
        layer.confirm('您确定要修改吗？',{
            btn: ['是','否'] //按钮
        }, function(){
            $.ajax({
                type:'POST',
                url:'updatemapwd',
                data:{upusecount:upusecount,oldpwd:oldpwd,newpwd:newpwd},
                dataType:'json',
                success: function (data){
                    console.log(data);
                    if(data==1){
                        layer.alert('修改成功');
                            $('#uppwd').modal('hide');
                            return;
                    }else if(data==0){
                        layer.alert('输入不合法');
                    }else if(data==3){
                        layer.alert('你输入的账号或密码有误');
                    }else{
                        layer.alert('你并没有修改密码');
                    }
                }
            })
        }, function(){
            return;
        });
    }
}
//显示找回密码的模态框
function showrepwd() {
    $('#repwd').modal('show');
}
//管理员和用户找回密码
function researpwd(judge) {
    var upcont=$('#usecount').val();
    var ques=$('#quess').val();
    var usepwd=$('#usepwd').val();
    var reg = new RegExp("\\s");
    var r = usepwd.substr(1).match(reg);
    if(r!=null){
        layer.alert('你输入的新密码有空格');
        return;
    }
    if(upcont==""||ques==""||usepwd==""){
        layer.alert('你少输入东西');
        $('#repwd').modal('show');
        return;
    }else {
        $.ajax({
            type:'POST',
            url:'resermapwd',
            data:{upcont:upcont,ques:ques,usepwd:usepwd,judge:judge},
            dataType:'json',
            success: function (data){
                console.log(data);
                if(data==1){
                    layer.alert('找回成功')
                        $('#repwd').modal('hide');
                        return;
                }else if(data==0){
                    layer.alert('你输入的内容不合法');
                }else {
                    layer.alert('你输入的账号或密保有误');
                }
            }
        })
    }
}
//修改密保
function upquess() {
    var upquescont= $('#upquescont').val();
    var upquespwd= $('#upquespwd').val();
    var newques= $('#newques').val();
    if(upquescont==""||upquespwd==""||newques==""){
        layer.alert('你少输入东西');
        return;
    }else {
        $.ajax({
            type:'POST',
            url:'upques',
            data:{upquescont:upquescont,upquespwd:upquespwd,newques:newques},
            dataType:'json',
            success: function (data){
                console.log(data);
                if(data==1){
                    layer.alert('修改成功');
                    $('#upques').modal('hide');
                    return;
                }else if(data==0){
                    layer.alert('你输入的账号或密码有误');
                }else if(data==2){
                    layer.alert('你输入的内容不合法');
                }else if(data==3){
                    layer.alert('你没有做任何修改');
                }
            }
        })
    }
}
//显示修改密码的模态框
function showupwdmodal() {
    $('#uppwd').modal('show');
}
//显示修改密保的模态框
function showupquesmodal() {
    $('#upques').modal('show');
}
//显示修改昵称的模态框
function showupnamemodal() {
    $('#upname').modal('show');
}
//修改昵称
function upname(){
    var usname= $('#usname').val();
    if(usname==""){
        layer.alert('你少输入东西');
        return;
    }else {
        $.ajax({
            type:'POST',
            url:'updatename',
            data:{usname:usname},
            dataType:'json',
            success: function (data){
                console.log(data);
                if(data==1){
                    layer.alert('修改成功');
                    document.getElementById('spaname').innerHTML=usname;
                    $('#upname').modal('hide');
                    return;
                }else if(data==2){
                    layer.alert('你输入的昵称已存在');
                }else if(data==0){
                    layer.alert('你没有做任何修改');
                }
            }
        })
    }
}
//显示用户登录后的功能表
function showfuntion() {
    $('#mobileclient').css('display','block');
}
//隐藏
function hiddenfun() {
    $('#mobileclient').css('display','none');
}