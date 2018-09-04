
//token验证
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
//删除文章
function deletesart(artid){
    layer.confirm('你确定要删除吗',{
            btn:['是','否']
        },function(){
            $.ajax({
                type:'GET',
                url:'deleteart',
                data:{artid:artid},
                dataType: 'json',
                success :function (data) {
                    if(data==0){
                        layer.alert("删除失败");
                    }else if(data==2){
                        layer.alert("只剩一篇，不能再删除");
                    }else {
                        layer.confirm('删除成功',
                            function(index){
                                location.href='showreart';
                                layer.close(index);
                            });
                        }
                }
            });
        },function(){
            return;
        }
    )
}
//展示添加标签的model
function showmodel() {
    $('#modal').modal('show');
}
function showmodelold(obj) {
    $('#modalold').modal('show');
    var typeid=$(obj).val();
    $('#updatetype').attr('value',typeid);
}
//判断文章标签是否添加成功
function judgeaddtype(judge){
    if(judge==2){
        layer.alert('添加成功');
    }else if(judge==1){
        layer.alert('标签最多只能添加6个');
    }else if(judge==3){
        layer.alert('标签名字不合法');
    }else if(judge==4){
        layer.alert('标签名字已经存在');
    }else {
        layer.alert('添加失败');
    }
}
//判断文章标签是否修改成功
function judgeuptype(judge) {
    if(judge==1){
        layer.alert('修改成功');
    }else if(judge==2){
        layer.alert('标签名字不合法');
    }else if(judge==3){
        layer.alert('标签名字已经存在');
    }else{
        layer.alert('添加失败');
    }
}
//清空模态框的内容
function emptymodel() {
    $('#lablename').val(' ');
    $('#lable').val(' ');
}

//文章上传图片
function showartimg(obj,judge){
    // 是否为图像
       $file = obj.files[0];
       // console.log(obj);
       // console.log($file);
        if(!/image\/\w+/.test($file.type)){
            layer.alert("你选择的图片不合法！");
            cancle(judge);
            return false;
        }
        $reader = new FileReader();
        $reader.onload = function (e){
            $("#seeimg").attr('src',e.target.result);
        }
        $reader.readAsDataURL($file);
}
function cancle(judge){
    if(judge==1){
      var oldimg=$('#hinimg')[0].src;
      $("#seeimg").attr('src',oldimg);
    }
    var obj = document.getElementById('user-pic');
    obj.outerHTML=obj.outerHTML;//初始化Input
    obj.value="";
}
//删除文章类型
function deletetypes(typeid){
    layer.confirm('你确定要删除吗',{
            btn:['是','否']
        },function(){
            $.ajax({
                type:'GET',
                url:'deletetype',
                data:{typeid:typeid},
                dataType: 'json',
                success :function (data) {
                    console.log(data);
                    if(data==0){
                        layer.alert("删除失败");
                    }else if(data==2){
                        layer.alert("该文章类型有文章，无法删除");
                    }else if(data==3){
                        layer.alert("最后一个了，无法删除");
                    }else{
                        layer.confirm('删除成功',
                            function(index){
                                location.href='showlable';
                                layer.close(index);
                            });
                    }
                }
            });
        },function(){
            return;
        }
    )
}
function rearticalnav() {
     $('#reartid').css("background-color","#252c35");
     $('#reartid').css("border-left-color","#00AAFF");
}
function realbumnav() {
    $('#realbum').css("background-color","#252c35");
    $('#realbum').css("border-left-color","#00AAFF");
}
function relablenav() {
    $('#relable').css("background-color","#252c35");
    $('#relable').css("border-left-color","#00AAFF");
}
function respeachnav() {
    $('#respeach').css("background-color","#252c35");
    $('#respeach').css("border-left-color","#00AAFF");
}
function reinfornav() {
    $('#reinfor').css("background-color","#252c35");
    $('#reinfor').css("border-left-color","#00AAFF");
}
//跳转到添加文章页面
function showaddart() {
    location.href="showaddart";
}
//显示管理员修改修改密码的模态框
function showuppwd() {
    $('#uppwd').modal('show');
}
//清空模态框
function empmodel() {
    var oldpwd=document.getElementById('oldpwd');
    var upusecount=document.getElementById('upusecount');
    var newpwd=document.getElementById('newpwd');
    upusecount.value='';
    newpwd.value='';
    oldpwd.value='';
}
//修改密码
function upmapwd(){
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
