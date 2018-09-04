@extends('Frontviews.Artical')
@section('articaldetile')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('css/frontcss/artical.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/common/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/frontcss/speach.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('js/common/jquery-3.2.js')}}"></script>
<script src="{{asset('js/common/bootstrap.min.js')}}"></script>
<style>
    #templatemo_menu{
        margin-top: 5%;
    }
    .sta{
        margin-top: 6%;
    }
    .stabt{
        margin-top: 6%;
    }
    .hfont{
        color: #00baf2;
    }
</style>
<div style="color:#fff;" id="artid" rel="{{$typeartical[0]->art_id}}">
    <h1 style="text-align: center;font-size: 40px;">
      {{$typeartical[0]->art_title}}
    </h1>
    <h3 style="text-align: center;">
        创作时间：{{date('Y-m-d',strtotime($typeartical[0]->created_at))}}
    </h3>
    <h3 style="float: right;margin-right: 50px;margin-top: -38px;">
        浏览量：{{$typeartical[0]->art_revcout}}
    </h3>
    <div style="margin-top: 3%;height: auto;box-shadow: yellow 0px 1px 10px;margin-left: 1%;max-width: 98%;">
      <span>
        {!! $typeartical[0]->art_text !!}
    </span>
    </div>
       <div style="float: right;margin-right: 10%">
           <img src="{{asset('images/dimg.jpg')}}" style="cursor: pointer" onclick="artop(1)">
           <span>
               :{{$typeartical[0]->art_top}}
           </span>
           <div style="margin-top: 10%">
            <img src="{{asset('images/cimg.jpg')}}" style="cursor: pointer" onclick="artop(0)">
           <span>
               :{{$typeartical[0]->art_stamp}}
           </span>
           </div>
       </div>
</div>
@endsection
@section('artspeachs')
    <br>
    <hr>
    <br>
    <div class="main">
    <div class="content">
        <textarea :class="text" id="sendspeach" maxlength="30px" style="display: block;width: 100%;min-height: 62px;padding: 8px;color: #555;font-size: 14px;resize: none;line-height: 18px;font-family:Microsoft YaHei" class="js-placeholder" placeholder="扯淡，吐槽，表扬，鼓励......想说啥，就说啥！"></textarea>
        <span class="spancount" style="position: absolute;margin-right:1%;line-height: 100%;font-size: 12px;right: 5px;bottom: 26px;color: #d0d6d9;">
        <span>
            0
        </span>
        /30
    </span>
        <div style="float: right;margin-right: 10%;margin-top: 2%;">
            <button class="sendinput btn btn-primary" id="sendcomment" rel="{{$artype}}" type="button" onclick="sendfacomment(this)">发表评论</button>
        </div>
    </div>
    </div>
@endsection

@section('artcomment')
<div class="speach"style=" margin-top: 20%;height: auto;color: #fff" id="userscomment">

</div>
<script src="{{asset('js/frontjs/artical.js')}}" type="text/javascript"></script>
    <?php
    echo "<script>var data = ".json_encode($usercomment).";commentaddiv(data)</script>";
    ?>
    <script>mynavs({{$artype}})</script>
{{--<script>--}}
    {{--function showcode() {--}}
        {{--$url = "{{ URL('captcha') }}";--}}
        {{--$url = $url + "/" + Math.random();--}}
        {{--$('#code').attr("src",$url);--}}
    {{--}--}}
{{--</script>--}}
@endsection
