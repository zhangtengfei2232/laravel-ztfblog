//token验证
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
// function keywordfocus(input) {
//     var divinput=input.parentNode;
//     var labelSpan=divinput.getElementsByTagName('span');
//     for(var i=0;i<labelSpan.length;i++){
//         if(labelSpan[i].className=='formli-input-warning'&&labelSpan[i].style.opacity==1){
//             labelSpan[i].style.opacity=0;
//         }
//     }
// }




