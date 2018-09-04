@extends('Frontviews.layouts')
@section('content')
    <script type="text/javascript" src="{{asset('js/common/notification.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/common/bigimg.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/common/bigimg.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/common/pubu.css')}}" type="text/css" media='screen'/>
<div style="font-family:cursive;font-size: 50px;overflow: hidden;color: #fff">
    <span style="display: block;margin-top: 5%;">
        唯美.小清新.青春.只因你而精彩！
    </span>
    <span style="margin-right:-3%;float: right;margin-top: 6%;height: 57px;">
        坏小哥，致青永远不朽的青春！
    </span>
</div>

<!--瀑布流  start-->
<div id="wrapper" class="wrapper" rel="{{$albumid}}" style="margin-top: 5%">
    <div id="container" style="width:995px;">
        @foreach($images as $image)
        <div class="grid">
            <div class="imgholder">
                <img class="lazy thumb_photo" title="1" src="{{asset("upimage/".$image->ima_road)}}" data-original="{{asset("upimage/".$image->ima_road)}}" width="225" />
            </div>
        </div>
        @endforeach
    </div>
</div>
<!--瀑布流 end-->
<!--大图弹出层 start-->
<div class="container">
    <div class="close_div" style="background-color: aqua">
        <img src="{{asset('images/closelabel.gif')}}" class="close_pop" title="关闭" alt="关闭" style="cursor:pointer">　
    </div>
    <!-- 代码 开始 -->
    <div class="content">
        <span style="display:none"><img src="{{asset('images/load.gif')}}" /></span>
        <div class="left"></div>
        <div class="right"></div>
        @foreach($images as $image)
        <img class="img" src="{{asset("upimage/".$image->ima_road)}}">
            @endforeach
    </div>
    <div class="bottom" style="background-color: aqua">共 <span id="img_count">x</span> 张 / 第 <span id="xz">x</span> 张</div>
    <!-- 代码 结束 -->
</div><!--end-->
    <script type="text/javascript" src="{{asset('js/common/pubu.js')}}"></script>
    <script>
        albumnav();
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
    $("img.lazy").lazyload();
    });
    </script>
    <script type="text/javascript" src="{{asset('js/common/jquery.lazyload.min.js')}}" ></script>
    <script type="text/javascript" src="{{asset('js/common/blocksit.min.js')}}"></script>
    <script type="text/javascript">
        var minAwayBtm = 0.1;  // 距离页面底部的最小距离
        $(window).scroll(function() {
            var awayBtm = $(document).height() - $(window).scrollTop() - $(window).height();
            var albumid=$('#wrapper').attr('rel');
            if (awayBtm <= minAwayBtm) {
                ajaxGetPhotos(albumid);
            }
        });
    </script>
@endsection