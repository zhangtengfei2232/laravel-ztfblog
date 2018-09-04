@extends('Frontviews.layouts')
@section('content')
<script src="{{asset('js/common/jquery-3.2.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/common/bootstrap.min.css')}}">
<link href="{{asset('css/common/base.css')}}" rel="stylesheet">
<link href="{{asset('css/frontcss/learn.css')}}" rel="stylesheet">
<script src="{{asset('js/common/bootstrap.min.js')}}"></script>
<script src="{{asset('js/common/scrollReveal.js')}}"></script>
<div>
    <style>
        img{
            display: inline;
        }
        #mobileclient a:hover{
            color: #337ab7;
        }
    </style>
    <div style="float: right;margin-top: -6%;margin-right: 2%">
        <form id="seartform" action="sealart" method="post" enctype="multipart/form-data" class="bs-example bs-example-form" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group" style="float: right;width: 23%">
                <input id="arttitles" name="artitle" type="text" class="form-control" maxlength="15px" placeholder="点我，有你想要的！">
                <span class="input-group-addon" style="background-color: yellow;cursor: pointer" onclick="judeseart()">搜索</span>
            </div>
        </form>
    </div>
<div class="containers" style="color: #fff">
    <h2 class="ctitle"><b>学无止境</b> <span style="color: #00baf2">不要轻易放弃。学习成长的路上，我们长路漫漫，只因学无止境。</span></h2>
    <div class="rnav">
        <ul>
            @foreach($types as $artypes)
                <li><a id="type{{$artypes->ty_id}}" href="{{url('showartpage?typeid='.$artypes->ty_id)}}">{{$artypes->art_ty}}</a></li>
            @endforeach
        </ul>
    </div>
    @section('articaldetile')
    <ul class="cbp_tmtimeline">
        @foreach($typeartical as $articals)
        <li>
            <time class="cbp_tmtime"><span>{{ date('m-d',strtotime($articals->created_at))}}</span> <span>{{ date('Y',strtotime($articals->created_at))}}</span></time>
            <div class="cbp_tmicon"></div>
            <div class="cbp_tmlabel" data-scroll-reveal="enter right over 1s" >
                <h2 style="max-width:200px;color: #fff;margin-bottom: 4%">{{$articals->art_title}}</h2>
                <span style="float: right;margin-top: -50px">浏览量：{{$articals->art_revcout}}</span>
                <p style="margin-top: -4%"><span class="blogpic"><a href="#"><img src="{{asset("upartimg/".$articals->ima_road)}}"></a></span>{!! $articals->art_text!!}</p>
                <a style="margin-top: 0px" href="{{url('showdetilepage?artid='.$articals->art_id.'&typeid='.$articals->art_type)}}" target="_blank" class="readmore">阅读全文&gt;&gt;</a> </div>
        </li>
        @endforeach
    </ul>
    @show
</div>
</aside>
    @section('artspeachs')
    @show
    @section('artcomment')
        @show
</div>
    @if(isset($artype))
    <script>
        artmynav({{$artype}});
    </script>
    @endif
@if(isset($judge))
<div class="container" style="margin-left: 40%;">
    {{ $typeartical->links() }}
</div>
    @endif
    @if(count($typeartical)==0)
        <script>
            warning();
        </script>
    @endif
@stop
{{--<script>--}}
    {{--if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){--}}
        {{--(function(){--}}
            {{--window.scrollReveal = new scrollReveal({reset: true});--}}
        {{--})();--}}
    {{--};--}}
{{--</script>--}}

