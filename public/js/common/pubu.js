var count=0;
var  judge=0;
$(function(){
    $("img.lazy").lazyload({
        load:function(){
            $('#container').BlocksIt({
                numOfCol:4,
                offsetX: 5,
                offsetY: 5
            });
        }
    });

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

//异步获取照片信息
function ajaxGetPhotos(albumid){
    if(judge==1){
        return ;
    }
    count++;
    $.ajax({
        url:'showimage',type: 'get',data: {alid:albumid,count:count},dataType: 'JSON',
        success: function (data) {
           // var data=JSON.parse(data);
            if(data.length==0){
                judge=1;
                layer.alert('已经没有多余照片了');
                return;
            }
            for (var i=0;i<data.length;i++) {
                var html = "";
                var img = '';
                html = html + "<div class='grid'>" +
                    "<div class='imgholder'>" +
                    "<img class='lazy thumb_photo' title='" + i + "'  src='../../../upimage/"+data[i].ima_road+"'  data-original='../../../upimage/" + data[i].ima_road + " ' width='225' onclick='seeBig(this)'/>" +
                    "</div>" +
                    "</div>";
                img = img + "<img class='img' src='../../../upimage/"+data[i].ima_road+"'>";
                $('#container').append(html);
                $('.content').append(img);
                $('#container').BlocksIt({
                    numOfCol: 4,
                    offsetX: 5,
                    offsetY: 5
                });
                $("img.lazy").lazyload();
                $('.load_more_text').show();
                $('.load_more_gif').hide();
            }
        }
    });
}
function albumnav() {
    $('#album').css("color","#cd7e00");
}