@extends('Backviews.Backlayout')
<link rel="stylesheet" href="{{asset('css/common/bigimg.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('css/common/pubu.css')}}" type="text/css" media='screen'/>
<style>
    .main{
        margin-right: 6%;
    }
</style>
@section('maincontent')
    <!--瀑布流  start-->
    <div class="reimagefind" style="overflow: hidden;float: right;width: 319px;overflow: hidden;height: 50px;margin-right: 2%;">
        <button class=" btn btn-primary glyphicon glyphicon-open" style="width:130px;height:40px" onclick="showimgmodels()">上传图片</button>
        <button  class=" btn btn-primary glyphicon glyphicon-trash" onclick="deletephotos()" style="width:130px;float:right;height:40px">删除照片</button>
    </div>
    <div id="wrapper" style="margin-top: 7%">
        <div id="container" style="width:995px;" rel="{{$albumid}}">
            @foreach($images as $image)
                <div class="grid">
                    <div class="imgholder" style="position: relative" onmouseover="shows(this)" onmouseout="hidde(this)" >
                        <input type="checkbox" class="input" rel="{{$image->ima_id}}" style="position:absolute;width: 30px;height:17px;top:0px;opacity: 0;">
                        <img class="lazy thumb_photo" title="1" src="{{asset("upimage/".$image->ima_road)}}" data-original="{{asset($image->ima_road)}}" width="225" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--瀑布流 end-->
    <!--大图弹出层 start-->
    <div class="container" style="margin-top: 3%">
        <div class="close_div" style="background-color: aqua;">
            <img src="{{asset('images/closelabel.gif')}}" class="close_pop" title="关闭" alt="关闭" style="cursor:pointer">　
        </div>
        <!-- 代码 开始 -->
        <div class="content" style="margin-left: 0%;width: 131%;height: 100%;">
            <span style="display:none"><img src="{{asset('images/load.gif')}}" /></span>
            <div class="left"></div>
            <div class="right"></div>
            @foreach($images as $image)
                <img class="img" src="{{asset("upimage/".$image->ima_road)}}">
            @endforeach
        </div>
        <div class="bottom">共 <span id="img_count">x</span> 张 / 第 <span id="xz">x</span> 张</div>
        <!-- 代码 结束 -->
    </div><!--end-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 800px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyimgs()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">请选择上传的图片</h4>
                </div>
                <div class="modal-body" style="min-height: 500px;">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                            <input id="file-Portrait1" class="btn btn-primary fileinput-button" type="file" name="myfile"style="color: #ACCD3C;display:inline" multiple>
                            <button class="btn btn-primary" type="button" style="float: right;margin-right: 7%;" onclick="emptyimgss()">取消上传</button>
                        </div>
                    </form>
                    <div class="pics" id="pics" style="width: 750px;min-height: 350px;margin-top: 5%;border:2px solid #000;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary relpy" onclick="uploadimgs(this)">上传</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/frontjs/jquery-1.12.4.min.js')}}" type="text/javascript"></script>
    <script>
        realbumnav();
    </script>
    <script type="text/javascript" src="{{asset('js/common/jquery.lazyload.min.js')}}" ></script>
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$("img.lazy").lazyload();--}}
        {{--});--}}
    {{--</script>--}}
    <script type="text/javascript" src="{{asset('js/common/blocksit.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/common/notification.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/common/bigimg.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/backjs/uploadimage.js')}}"></script>
    {{--<script src="{{asset('js/common/jquery-3.2.1.js')}}"></script>--}}
    <script type="text/javascript">
        var minAwayBtm = 0.5;  // 距离页面底部的最小距离
        $(window).scroll(function() {
            var awayBtm = $(document).height() - $(window).scrollTop() - $(window).height();
            var albumid=$('#container').attr('rel');
            if (awayBtm <= minAwayBtm) {
                setTimeout(function () {
                    reshowimagess(albumid);
                },1999)
            }
        });
    </script>
@endsection