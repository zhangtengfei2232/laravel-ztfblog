@extends('Backviews.Backlayout')
<style>
    .main{
        width: calc(100% - 260px);
        margin-right: 2%    ;
    }
</style>
@section('maincontent')
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <script src="{{asset('js/backjs/reartical.js')}}"></script>
    <style>
        .ths{
            vertical-align:middle;
            text-align: center;
        }
    </style>
      <div style="color: #fff">
          <table class="table table-bordered" style="margin-left:9%;color: #fff;width: 89%;vertical-align:middle;text-align: center;">
              <caption class="caption" style="margin-left: 362px"><h1>坏小哥的作品</h1>
                  <div style="float: left;margin-left: -50%;">
                         <button type="button" class="add btn btn-primary glyphicon glyphicon-plus" onclick="showaddart()">添加文章</button>
                  </div>
                  <div class="input">
                      <form id="Form" method="POST" action="setitleart" style="float: right">
                          {{ csrf_field() }}
                          <input id="reaserch" name="artitle" type="text" value="" class="text"  placeholder="请输入搜索内容" maxlength="30">
                          <button type="submit" class="serch btn btn-primary " style="margin-top:-2px;width: 90px;height: 30px" id="find" >Go!Go!</button>
                      </form>
                  </div>
              </caption>
              <tr>
                  <th class="ths" height="55px">题目</th>
                  <th class="ths" height="55px">作品类型</th>
                  <th class="ths" height="55px">上传日期</th>
                  <th class="ths" height="55px">更新日期</th>
                  <th class="ths" height="55px">浏览量</th>
                  <th class="ths" height="55px">点赞人数</th>
                  <th class="ths" height="55px">差评人数</th>
                  <th class="ths" height="55px" width="100px">编辑</th>
              </tr>
              @if(isset($allartical))
                  @foreach($allartical as $articals)
                  <tr style="height:30px;">
                  <td style="width:230px;vertical-align:middle">{{$articals->art_title}}</td>
                  <td style="width:113px;vertical-align:middle">{{$articals->art_ty}}</td>
                  <td style="width:230px;vertical-align:middle">{{date('Y-m-d',strtotime($articals->created_at))}}</td>
                  <td style="width:230px;vertical-align:middle">{{date('Y-m-d',strtotime($articals->updated_at))}}</td>
                  <td style="width:100px;vertical-align:middle">{{$articals->art_revcout}}</td>
                  <td style="width:113px;vertical-align:middle">{{$articals->art_top}}</td>
                  <td style="width:113px;vertical-align:middle">{{$articals->art_stamp}}</td>
                  <td style="width:292px">
                       <div style="margin-top: 8%">
                      <form id="Form" method="GET" action="updatepage" style="float: right">
                          <button type="submit" class="change btn btn-primary glyphicon glyphicon-pencil" name="artid" value="{{$articals->art_id}}" >修改</button>
                      </form>
                          <button style="float: right;margin-right: 11%" type="submit" class="delete btn btn-primary glyphicon glyphicon-trash" onclick="deletesart({{$articals->art_id}})">删除</button>
                       </div>
                  </td>
                  </tr>
                  @endforeach
              @endif
          </table>
      </div>
    <div class="container" style="margin-left: 40%;">
    {{ $allartical->links() }}
    </div>
    <script>
        rearticalnav();
    </script>
@endsection