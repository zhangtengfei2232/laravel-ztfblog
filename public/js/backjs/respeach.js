//token验证
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
///显示文章的详情评论
function showspeachs(obj) {
    var artid=$(obj).attr('rel');
    $.ajax({
        type:'GET',
        url:'sespeach',
        data:{artid:artid},
        dataType: 'json',
        success :function (data) {
            console.log(data);
            if(data==0){
                layer.alert("该文章没有评论");
            }else{
                location.href='showspeach?artid='+artid;
            }
        }
    });
}
function setcoms(usercomment){
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
        li_.innerHTML+="<p>"+usercomment[i]['name']+"<p class='glyphicon glyphicon-comment'></p></p>"+"<span>"+usercomment[i]['comment']+"</span>"+"<button class='buton btn btn-primary glyphicon glyphicon-trash' rel="+usercomment[i]['id']+" style='float: right;margin-right: 3%' onclick='deletespeachs(this)'>"+"删除"+"</button>"+"<button class='buton btn btn-primary glyphicon glyphicon-comment' style='float: right;margin-right: 30px' rel="+usercomment[i]['userid']+" onclick='showtexts(this)'>"+"回复"+"</button>"+"<p>"+usercomment[i]['comdate']+"</p>";
        li_.innerHTML+="<div class='rediv' id='rediv' rel="+usercomment[i]['id']+" style='display: none;margin-left: 10%;width: 70%;height: 30%'>"+"<textarea class='retext' maxlength='30px' placeholder='最多输入30个汉字' style='width:83%;height: 60px;position: relative'></textarea>"+"<button class='buo btn btn-primary' style=' margin-left: 55%;margin-top: -34px;position: absolute' onclick='sendcomments(this)'>发送</button>"+"</div>";
        var child = setcoms(usercomment[i]["child"]);
        li_.appendChild(hr);
        li_.appendChild(child);
        ul_.appendChild(li_);
    }
    return ul_;
}
function commentaddivs(usercomment){
    if(usercomment==null){
        layer.alert('这篇文章已经没有评论',function () {
            location.href="showrespea";
        });
        return;
    }
    var userscommentid=document.getElementById('userscomment');
    userscommentid.appendChild(setcoms(usercomment))
}
//显示回复的div
function showtexts(obj) {
    var iteams = document.getElementsByClassName("rediv")
    for (var i = 0;i<iteams.length;i++){
        $(iteams[i]).css("display","none")
    }
    $(obj).next().next().css("display","block");
}
//发送回复内容
function sendcomments(obj){
    var artid=$('#artid').attr('rel');
    var  coment=$(obj).prev().val();
    var fatherid=$(obj).parent().attr('rel');
    if(coment==""){
        layer.alert('你没有输入内容');
        return ;
    }else {
        $.ajax({
            type:'GET',
            url:'countspeach',
            data:{fatherid:fatherid,artid:artid,coment:coment},
            dataType: 'json',
            success :function (data) {
                console.log(data);
                if(data==2){
                    layer.alert("评论级数过多，你无法再评论");
                }else if(data==1){
                    layer.alert('回复成功',function () {
                        location.href='showspeach?artid='+artid;
                    });
                }else if(data==0){
                    layer.alert('回复失败');
                }else if(data==3){
                    layer.alert("你输入的内容不合法");
                }else if(data==3){
                    layer.alert('你是管理员吗？');
                }
            }
        });
        $(obj).parent().css("display","none");
    }

}
function deletespeachs(obj) {
    layer.confirm('你确定要删除吗',{
            btn:['是','否']
        },function(){
        var speachid=$(obj).attr('rel');
        var artid=$('#userscomment').attr('rel');
        $.ajax({
            type:'GET',
            url:'deletespeach',
            data:{speachid:speachid},
            dataType: 'json',
            success :function (data) {
                console.log(data);
                if(data==0){
                    layer.alert("删除失败");
                }else{
                    layer.alert('删除成功', function(){
                        location.href='showspeach?artid='+artid;
                    });
                }
            }
        });

        },function(){
            return;
        }
    )
}
function deallspeach(obj) {
    layer.confirm('你确定要删除全部评论吗',{
            btn:['是','否']
        },function(){
            var artid=$(obj).attr('rel');
            $.ajax({
                type:'GET',
                url:'sespeach',
                data:{artid:artid},
                dataType: 'json',
                success :function (data) {
                    console.log(data);
                    if(data==0){
                        layer.alert("该文章没有评论");
                    }else{
                        $.ajax({
                            type:'GET',
                            url:'deallspeach',
                            data:{artid:artid},
                            dataType: 'json',
                            success :function (data) {
                                console.log(data);
                                if(data==0){
                                    layer.alert("删除失败");
                                }else{
                                    layer.alert('删除成功', function(){
                                        location.href='showrespea';
                                    });
                                }
                            }
                        });
                    }
                }
            });

        },function(){
            return;
        }
    )
}
var jud=0;
//后台显示闲言碎语图标
function showspeimg(jushow){
    var obj=$('#respeach');
    if(jud==1){
        $(obj).addClass("collapsed");
        $(obj).removeClass("active");
        $(obj).attr("aria-expanded","true");
        $(obj).next().addClass("collapse in");
        $(obj).next().removeClass("collapse");
        $(obj).next().attr("aria-expanded","true");
        jud=0;
    } else if(jud==0){
        $(obj).addClass("active");
        $(obj).removeClass("collapsed");
        $(obj).attr("aria-expanded","false");
        $(obj).next().addClass("collapse");
        $(obj).next().removeClass("collapse in");
        $(obj).next().attr("aria-expanded","false");
        jud=1;
    }
}
//设置闲言a标签颜色
function showartcolor() {
    $('#showartcolor').css('color','#337ab7');
}
function showspecolor() {
    $('#showspecolor').css('color','#337ab7');
}