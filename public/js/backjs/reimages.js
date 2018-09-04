//token验证
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
//添加相册
function addalbum(){
    var alname=$('#alname').val();
    var savepwd=$('#savepwd').val();
    var amswerpwd=$('#amswerpwd').val();
    var introce=$('#introce').val();
    if(alname==""||savepwd==""||amswerpwd==""||introce==""){
        layer.alert('你输入的内容不合法');
        return;
    }
    $.ajax({
        type:'POST',
        url:'addalbum',
        data:{alname:alname,savepwd:savepwd,amswerpwd:amswerpwd,introce:introce},
        dataType: 'json',
        success :function (data) {
                 console.log(data);
                 if(data==0){
                     layer.alert('你输入的内容不合法');
                 }else if(data==2){
                     layer.alert('添加失败');
                 }else {
                     location.href='showalbum';
                 }
        }
    });
}
//清空模态框的内容
function emadals() {
    $('#alname').val(' ');
    $('#savepwd').val(' ');
    $('#incont').val(' ');
    $('#introce').val(' ');
    $('#addques').val(' ');
    $('#addamswer').val(' ');
    $('#updateques').val(' ');
    $('#updateamswer').val(' ');
    $('#updaname').val(' ');
    $('#updacontent').val(' ');
}
//显示修改相册名字的模态框
function shupnamodel(obj) {
    var albumid=$(obj).attr('rel');
    $('#upnamebt').attr('rel',albumid);
    $('#updatename').modal('show');
}
//修改相册的名字
function updatealname(obj) {
    var albumid=$(obj).attr('rel');
    var alnewname=$('#updaname').val();
    if(alnewname==""){
        layer.alert('你输入的内容不合法');
        return;
    }
    $.ajax({
        type:'POST',
        url:'upalname',
        data:{albumid:albumid,alnewname:alnewname},
        dataType: 'json',
        success :function (data){
            if(data==0){
                layer.alert('你输入的内容不合法');
            }else if(data==2){
                layer.alert('修改失败');
            }else {
                location.href='showalbum';
            }
        }
    });
}
//显示修改相册介绍的模态框
function shupconmodel(obj) {
    var albumid=$(obj).attr('rel');
    $('#upcontentbt').attr('rel',albumid);
    $('#updatecontent').modal('show');
}
//修改相册的介绍
function upalinronce(obj) {
    var albumid=$(obj).attr('rel');
    var updacontent=$('#updacontent').val();
     if(updacontent==""){
         layer.alert('你输入的内容不合法');
         return
     }
    $.ajax({
        type:'POST',
        url:'upintroce',
        data:{albumid:albumid,updacontent:updacontent},
        dataType: 'json',
        success :function (data){
            console.log(data);
            if(data==0){
                layer.alert('你输入的内容不合法');
            }else if(data==2){
                layer.alert('修改失败');
            }else {
                location.href='showalbum';
            }
        }
    });

}
//显示添加密保的模态框
function addquemodel(obj) {
     var albumid=$(obj).attr('rel');
     $('#addquebt').attr('rel',albumid);
     $('#addmodal').modal('show');
}
//给相册添加密保
function addques(obj){
    var albumid=$(obj).attr('rel');
    var addques=$('#addques').val();
    var addamswer=$('#addamswer').val();
    if(addques==""||addamswer==""){
        layer.alert('你输入的内容不合法');
        return;
    }
    $.ajax({
        type:'POST',
        url:'addalques',
        data:{albumid:albumid,addques:addques,addamswer:addamswer},
        dataType: 'json',
        success :function (data) {
            if(data==0){
                layer.alert('你输入的内容不合法');
            }else if(data==2){
                layer.alert('添加失败');
            }else {
                location.href='showalbum';
            }
        }
    });
}
//去后台查所要修改的相册的密保
function seques(obj){
    var albumid=$(obj).attr('rel');
    $.ajax({
        type:'GET',
        url:'seques',
        data:{albumid:albumid},
        dataType: 'json',
        success :function (data){
            $('#updateques').val(data[0].al_ques);
            $('#updateamswer').val(data[0].al_ans);
            $('#upquebt').attr('rel',data[0].al_id);

            showupmodel();
        }
    });
}
//显示要修改密保的模态框
function showupmodel() {
    $('#updatemodal').modal('show');
}

//修改密保
function updateques(obj) {
    var albumid=$(obj).attr('rel');
    var updateques=$('#updateques').val();
    var updateamswer=$('#updateamswer').val();
    if(updateques==""||updateamswer==""){
        layer.alert('你输入的内容不合法');
        return;
    }
    $.ajax({
        type:'POST',
        url:'updateques',
        data:{albumid:albumid,updateques:updateques,updateamswer:updateamswer},
        dataType: 'json',
        success :function (data){
           if(data==0){
               layer.alert('你输入的内容不合法');
           }else if(data==2){
               layer.alert('修改失败');
           }else {
               location.href='showalbum';
           }
        }
    });
}
//删除相册
function deletealbums(obj){
    var alid=$(obj).attr('rel');
    layer.confirm('你确定要删除吗',{
            btn:['是','否']
        },function(){
            $.ajax({
                type:'GET',
                url:'deletealbum',
                data:{alid:alid},
                dataType: 'json',
                success :function (data) {
                    if(data==2){
                        layer.alert("该相册有照片，无法删除");
                    }
                    else if(data==0){
                        layer.alert("删除失败");
                    }else{
                        layer.confirm('删除成功', function(){
                            location.href='showalbum';
                            });
                    }
                }
            });
        },function(){
            return;
        }
    )
}
//后台显示照片
function reshowimage(obj){
    var albumid=$(obj).attr('rel');
    location.href='showreima?albumid='+albumid;
}
//显示复选框
function shows(obj) {
    $(obj).children('input').css('opacity',1);
}
//隐藏复选框
function hidde(obj) {
    if($(obj).children('input').is(':checked')){
        $(obj).children('input').css('opacity',1)
        return;
    }else {
        $(obj).children('input').css('opacity',0)
    }
}
//删除照片
function deletephotos() {
    var input = $('.input');
    var delarr=[];
    for (var i=0;i<input.length;i++){
        if(input[i].checked){
            delarr.push(input.eq(i).attr('rel'));
        }
    }
    if(delarr.length==0){
        layer.alert('你没有选中任何东西');
        return;
    }
    layer.confirm('你是否要删除？', {
        btn: ['是', '否']
    },function () {
        $.ajax({
            type:'GET',
            url:'deletepic',
            data:{depic:delarr},
            datatype:'JSON',
            success:function (data){
                // console.log(data);
                if(data==1){
                    layer.alert('删除成功',function () {
                        var albumid=$('#sealbumid').attr('rel');
                        location.href='showreima?albumid='+albumid;
                    });
                }else {
                    layer.alert('你没有选中任何东西');
                }
            }
        })
    },function () {
        return;
    })
}
//显示上传照片的模态框
function showimgmodels() {
    var albumid=$('#sealbumid').attr('rel');
    $('.relpy').attr('rel',albumid);
    $('#modal').modal('show');
}
//清空模态框中的照片
function emptyimgs() {
    var fileimg = $("#file-Portrait1");
    fileimg.after(fileimg.clone().val(""));
    fileimg.remove();
    var elem = document.getElementById('pics');
    while(elem.hasChildNodes()) //当elem下还存在子节点时 循环继续
    {
        elem.removeChild(elem.firstChild);
    }
}
function emptysessions(judge) {
    location.href='emptyssession?judge='+judge;
}
function shaddal() {
    $('#addalmodal').modal('show');
}
function deleteque(obj) {
    var alid=$(obj).attr('rel');
    layer.confirm('你是否要删除？', {
        btn: ['是', '否']
    },function () {
        $.ajax({
            type:'GET',
            url:'deleteque',
            data:{alid:alid},
            datatype:'JSON',
            success:function (data){
                console.log(data);
                if(data==1){
                    layer.alert('删除成功',function () {
                        location.href='showalbum';
                    });
                }else if(data==0) {
                    layer.alert('删除失败');
                }
            }
        })
    },function () {
        return;
    })

}