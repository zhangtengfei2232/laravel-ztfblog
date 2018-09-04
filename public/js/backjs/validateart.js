var ue;
var oldtext;
$.cretaUE = function(text,flag) {
    ue = UE.getEditor( 'editor', {

        autoHeightEnabled: true,

        autoFloatEnabled: true,

        initialFrameWidth: 690,

        initialFrameHeight:483

    });
    if(flag)
        setTimeout(function () {
             text=HTMLDecode(text);
             ue.setContent("");
             ue.setContent(text);
             oldtext=ue.getContent();
        },600);
}
//html->文本
function HTMLEncode(html) {
    var temp = document.createElement("div");
    (temp.textContent != null) ? (temp.textContent = html) : (temp.innerText = html);
    var output = temp.innerHTML;
    temp = null;
    return output;
}
//文本->html
function HTMLDecode(text) {
    var temp = document.createElement("div");
    temp.innerHTML = text;
    var output = temp.innerText || temp.textContent;
    temp = null;
    return output;
}
//文章修改前验证
function artvalidates() {
    var upform = document.getElementById('upform');
    var oldtitle=$('#oldartitle').val();
    var newartitle=$('#newartitle').val();
    var options=$('#arttyid option:selected');
    var newartyiid=options.val();
    var oldartyid=$('#oldartyid').attr('rel');
    var oldimg=$('#hinimg')[0].src;
    var newimg=$('#seeimg')[0].src;
    var newtext=ue.getContent();
    if(newartitle==""||newtext==""){
        layer.alert('你修改的内容不合法');
    }else if(oldtitle==newartitle&&newartyiid==oldartyid&&oldimg==newimg&&oldtext==newtext){
        layer.alert('你并没有做任何改变');
        return;
    }else{
        //验证通过，提交表单数据
        upform.submit();
    }
}
//文章添加前验证
function addart() {
    var addartform = document.getElementById('addart');
    var obj = document.getElementById('user-pic');
    var newartitle=$('#addartitle').val();
    var newtexts=ue.getContent();
    console.log(newartitle,obj.value,newtexts);
    if(newartitle==""||newtexts==""){
        layer.alert('你少输入东西');
        return;
    }else if(obj.value==""){
        layer.alert('你没有选择图片');
        return;
    }else {
        //验证通过，提交表单数据
        addartform.submit();
    }
}