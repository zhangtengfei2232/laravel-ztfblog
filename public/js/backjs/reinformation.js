//token验证
// $(function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//
// });
function showmesg(judge) {
    if(judge==1){
        layer.alert('修改成功');
    }else{
        layer.alert('修改失败');
    }
}