//token验证
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
function setcom(usercomment){
       var ul_ = document.createElement('ul');
       ul_.setAttribute("class","comentul");
           if(usercomment==null){
                     return ul_;
           }
       for(var i=0;i<usercomment.length;i++){
           var li_=document.createElement("li");
           var hr=document.createElement("hr");
           var span=document.createElement("span");
           hr.setAttribute("class","comenthr");
           li_.setAttribute("class","comentli");
           span.setAttribute("class","comentspan");
           li_.innerHTML+="<p>"+usercomment[i]['name']+"<p class='glyphicon glyphicon-comment'></p>"+"</p>"+"<button class='buton btn btn-primary glyphicon glyphicon-comment' onclick='showtext(this)'>"+"回复"+"</button>"+"<span>"+usercomment[i]['comment']+"</span>"+"<p>"+usercomment[i]['comdate']+"</p>";
           li_.innerHTML+="<div class='rediv' id='rediv' rel="+usercomment[i]['id']+" style='display: none'>"+"<textarea class='retext'maxlength='30px' placeholder='最多输入30个汉字'></textarea>"+"<button class='buo btn btn-primary' onclick='sendcomment(this)'>发表</button>"+"</div>";
           var child = setcom(usercomment[i]["child"]);
           li_.appendChild(hr);
           li_.appendChild(child);
           ul_.appendChild(li_);
       }
       return ul_;
}
function commentaddiv(usercomment){
    var userscommentid=document.getElementById('userscomment');
    userscommentid.appendChild(setcom(usercomment))
}
//显示回复的div
function showtext(obj) {
    var iteams = document.getElementsByClassName("rediv")
    for (var i = 0;i<iteams.length;i++){
        $(iteams[i]).css("display","none")
    }
    $(obj).next().next().next().css("display","block");
}
//发送回复内容
function sendcomment(obj){
    var typeid =$('#sendcomment').attr('rel');
    var  artid=$('#artid').attr('rel');
    var coment=$(obj).prev().val();
    var fatherid=$(obj).parent().attr('rel');
    $.ajax({
        type:'POST',
        url:'addreply',
        data:{artid:artid,comment:coment,fatherid:fatherid},
        dataType: 'json',
        success :function (data) {
            if(data==2){
                $('#login').modal('show');
            }else if(data==0){
                layer.alert("回复失败");
            }else if(data==3){
                layer.alert("评论级数过多，你无法再评论");
            }else if(data==4){
                layer.alert("你输入的内容不合法");
            }else{
                location.href='showdetilepage?artid='+artid+'&typeid='+typeid;
            }
        }
    });

}
//发送评论内容
function sendfacomment(obj){
    var artid=$('#artid').attr('rel');
    var artype=$(obj).attr('rel');
    var comment=$('#sendspeach').val();
    if(artid==""||artype==""||comment==""){
        layer.alert("你输入的不合法");
        return;
    }
    $.ajax({
        type:'POST',
        url:'addspeach',
        data:{
            _token:$('meta[name="csrf-token"]').attr('content'),
            artid:artid,
            comment:comment
        },
        dataType: 'json',
        success :function (data) {
            if(data==2){
                $('#login').modal('show');
            }else if(data==0){
                layer.alert("评论失败");
            }else if(data==3){
                layer.alert("你输入的不合法");
            }else{
                location.href='showdetilepage?artid='+artid+'&typeid='+artype;
            }
        }
    });
}
//清空登录模态框
function emptylogin() {
    $('#account').val(" ");
    $('#password').val(" ");
    $('#mycode').val(" ");
}
//给文章点赞
function artop(judge){
    var artid=$('#artid').attr('rel');
    var typeid=$('#sendcomment').attr('rel');
    $.ajax({
        type:'GET',
        url:'arttop',
        data:{artid:artid,judge:judge},
        dataType: 'json',
        success :function (data) {
            if(data==2){
                $('#login').modal('show');
            }else if(data==0){
                layer.alert("操作失败");
            }else if(data==3){
                layer.alert("你已经为该文章表过态");
            }else{
                if(judge==1){
                    layer.alert('点赞成功',function () {
                        location.href='showdetilepage?artid='+artid+'&typeid='+typeid;
                    });
                }else {
                    layer.alert('差评成功',function () {
                        location.href='showdetilepage?artid='+artid+'&typeid='+typeid;
                    });
                }

            }
        }
    });
}