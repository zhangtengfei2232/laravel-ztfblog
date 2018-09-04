//token验证
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});
var nums =0;
var  files ;
var files_arr = new Array();
$(function () {
    var imgs =new Array();
    $("#file-Portrait1").click();
    $("#file-Portrait1").on("change",function (){
        files = this.files;
        var beg=files_arr.length;
      for(var i=0;i < this.files.length;i++){
        files_arr[beg+i]=files[i];
        imgs=new Image();
        var objURL=getObjectURL(files[i]);
        if(objURL){
            imgs.src=objURL;
            imgs.class=beg+i;
            imgs.onload=function(e){
                imgs.id=nums;
                $imgheight=this.height;
                $imgwidth=this.width;
                $img_w=120;
                $img_h=120;
                if($imgheight>=$imgwidth) {
                    $(".pics").append("<div class='cloth' id='cloth" + imgs.id + "'></div>");
                    $("#cloth" + imgs.id).append("<div class='im' id='imgpic" + imgs.id + "'>").css({
                        width: 135 + "px",
                        height: 155 + "px",
                        display: "inline-block",
                        background: "#fff",
                        "margin-right": 40 + "px"
                    });
                    $("#imgpic" + imgs.id).append("<img src='' id='pict" + imgs.id + "'>").css({
                        padding: 10 + "px",
                        background: "#f3f3f3",
                        "text-align": "center",
                        "vertical-align": "middle",
                        height: 131 + "px"
                    });
                    $("#pict" + imgs.id).attr("src", this.src).css({
                        "max-width": "100%",
                        "max-height": "100%",
                        align: "center"
                    });
                    $("#cloth" + imgs.id).append("<div class='deletes' onclick='deletes(" + imgs.id + ")'>删除</div>").attr("margin-left", '30px');
                }else if($imgheight<=$imgwidth){
                    $(".pics").append("<div class='cloth' id='cloth" + imgs.id + "'></div>");
                    $("#cloth" + imgs.id).append("<div class='im' id='imgpic" + imgs.id + "'>").css({
                        width: 135 + "px",
                        height: 155 + "px",
                        display: "inline-block",
                        background: "#fff",
                        "margin-right": 50 + "px"
                    });
                    $("#imgpic" + imgs.id).append("<img src='' id='pict" + imgs.id + "'>").css({
                        padding: 10 + "px",
                        background: "#f3f3f3",
                        "text-align": "center",
                        "vertical-align": "middle",
                        height: 131 + "px"
                    });
                    $("#pict" + imgs.id).attr("src", this.src).css({
                        "max-width":"100%",
                        "max-height": "100%",
                         align: "center"
                    });
                    $("#cloth" + imgs.id).append("<div class='deletes' onclick='deletes(" + imgs.id +")'>删除</div>").css({
                        cursor:"pointer"
                    })
                    ;
                }
                nums=nums+1;

            };
        };
          if(!/image\/\w+/.test(files[i].type)){
              layer.alert("你选择的图片不合法！");
              deletes(i);
              return false;
          }
    }

    })

});

function getObjectURL(file) {
    var url=null;
    if(window.createObjectURL!=undefined){
        url=window.createObjectURL(file);
    }else if(window.URL!=undefined){
        url=window.URL.createObjectURL(file);
    }else if(window.webkitURL!=undefined){
        url=window.webkitURL.createObjectURL(file);
    }
    return url;
}
var odate  =new FormData();


function deletes(num){
    $("#cloth"+num).remove();
    delete files_arr[num];
    var pic=new Array();
    var j=0;
    for($i=0;$i<files_arr.length;$i++){
        (function(e){
            if(files_arr[$i]!=undefined){
                odate.append('pic'+j,files_arr[$i]);
                j++;
            }
        })($i);}
}
function uploadimgs(obj){
    var albumid=($(obj).attr('rel'));
    // console.log(files_arr[0]);
    // console.log(files_arr.length);
    if(files_arr[0] ==null){
        layer.alert('你没有选中任何文件');
        return false;
    }
    // var file=$("#file-Portrait1");
    // var files = file[0].files;
    for(i=0;i<files_arr.length;i++){
       odate.append('img['+i+']',files_arr[i]);
    }
    layer.confirm('是否添加新照片？', {
        btn: ['是', '否']
    },function () {
       $.ajax({
              type:'post',
              url:'addimages?albumid='+albumid,
              data:odate,
              processData: false,
              contentType: false,
              success:function(data){
              // console.log(data,"asdsdadsada");
                  if(data==0){
                      layer.alert('你没有选择文件');
                  }else if(data==1){
                      layer.alert('上传成功',function(){
                      location.href='showreima?albumid='+albumid;
                      })
                  }else if(data==2){
                      layer.alert('上传失败');
                  }
              }
           })
    },function () {
           return;
    })
}
function emptyimgss() {
    var fileimg = $("#file-Portrait1");
    fileimg.after(fileimg.clone().val(""));
    fileimg.remove();
    var elem = document.getElementById('pics');
    while(elem.hasChildNodes()) //当elem下还存在子节点时 循环继续
    {
        elem.removeChild(elem.firstChild);
    }
}
var count=0;
var  judge=0;
$(function(){
    // $("img.lazy").lazyload({
    //     load:function(){
    //         $('#container').BlocksIt({
    //             numOfCol:4,
    //             offsetX: 5,
    //             offsetY: 5
    //         });
    //     }
    // });

    var currentWidth = 985;
    $(window).resize(function() {
        var winWidth = $(window).width();
        var conWidth;
        if(winWidth < 545) {
            conWidth = 325;
            col = 2
        } else if(winWidth < 765) {
            conWidth = 545;
            col = 3
        } else if(winWidth < 985) {
            conWidth = 765;
            col = 4;
        } else {
            conWidth = 985;
            col = 5;
        }
        if(conWidth != currentWidth) {
            currentWidth = conWidth;
            $('#container').width(conWidth);
            $('#container').BlocksIt({
                numOfCol: col,
                offsetX: 5,
                offsetY: 5
            });
        }
    });
});
//后台异步获取照片
function reshowimagess(albumid) {
    if(judge==1){
        return;
    }
    count++;
    $.ajax({
        url:'seimage',type: 'get',data: {alid:albumid,count:count},dataType: 'JSON',
        success: function (data) {
            // var data=JSON.parse(data);
            if(data.length==0){
                judge=1;
                layer.alert('已经没有多余照片');
                return;
            }
            for (var i = 0; i < data.length; i++) {
                var html = "";
                var img = '';
                html = html + "<div class='grid'>" +
                    "<div class='imgholder'  onmouseover='shows(this)' onmouseout='hidde(this)' style='position: relative;'>" +
                    "<input type='checkbox' class='input' rel='"+data[i].ima_id+"' style='position:absolute;width: 30px;height:17px;top:0px;opacity: 0;'>"+
                    "<img class='lazy thumb_photo' title='" + i + "'  src='../../../upimage/"+data[i].ima_road+"'  data-original='" + data.ima_road + " ' width='225' onclick='seeBig(this)'/>" +
                    "</div>" +
                    "</div>";
                img = img + "<img class='img' src='../../../upimage/"+data[i].ima_road+"'>";
                $('#container').append(html);
                $('.content').append(img);
                // $('#container').BlocksIt({
                //     numOfCol: 4,
                //     offsetX: 5,
                //     offsetY: 5
                // });
                // $("img.lazy").lazyload();
                $('.load_more_text').show();
                $('.load_more_gif').hide();
            }
        }
    });
}
function albumnav() {
    $('#album').css("color","#cd7e00");
}

