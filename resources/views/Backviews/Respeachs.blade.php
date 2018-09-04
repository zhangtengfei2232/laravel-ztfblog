@extends('Backviews.Backlayout')
<style>
    .ths{
        vertical-align:middle;
        text-align: center;
    }
    .main{
        width: calc(100% - 260px);
    }
</style>
@section('maincontent')
    <div style="color: #fff;width:82%;">
        <table class="table table-bordered" style="margin-left:18%;color: #fff;width: 80%;vertical-align:middle;text-align: center;">
            <caption class="caption" style="margin-left: 260px"><h1 style="color: #fff">坏小哥文章评论</h1>
            </caption>
            <tr>
                <th class="ths" height="55px">文章题目</th>
                <th class="ths" height="55px">文章开头</th>
                <th class="ths glyphicon glyphicon-edit" height="55px" style="width: 332px">编辑</th>
            </tr>
            @if(isset($speach))
                @foreach($speach as $speachs)
                    <tr style="height:30px;">
                        <td style="width:100px;vertical-align:middle">{{$speachs->art_title}}</td>
                        <td style="width:100px;vertical-align:middle">{!! $speachs->art_text !!}</td>
                        <td style="width:40%">
                            <div style="width: 316px;float: left">
                                <button type="submit" rel="{{$speachs->art_id}}" class="change btn btn-primary 	glyphicon glyphicon-eye-open" onclick="showspeachs(this)" name="artid">查看评论详情</button>
                                <button style="float: right;margin-right: 6%"  rel="{{$speachs->art_id}}" type="submit" class="delete btn btn-primary glyphicon glyphicon-trash" onclick="deallspeach(this)">删除全部评论</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
    <div class="container" style="position: fixed;margin-left: 30%;">
        {{ $speach->links() }}
    </div>
    <script>
        respeachnav();
        showspeimg(1);
        showartcolor();
    </script>
    <script src="{{asset('js/backjs/respeach.js')}}"></script>
    @endsection