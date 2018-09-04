<!doctype html>
@extends('Frontviews.layouts')
<link href="{{asset('css/layer/theme/default/layer.css')}}" rel="stylesheet">
<link href="{{asset('css/common/base.css')}}" rel="stylesheet">
<link href="{{asset('css/frontcss/share.css')}}" rel="stylesheet">
<link href="{{asset('css/common/m.css')}}" rel="stylesheet">
<script src="{{asset('js/common/scrollReveal.js')}}"></script>
@section('content')
    <style>
        .aimages{
            float: right;
            cursor: pointer;
        }
    </style>
    <style>
        img{
            display: inline;
        }
        #templatemo_main {
            padding: 0px;
        }
        .sta{
            margin-top: 11%;
        }
        .stabt{
            margin-top: 6%;
        }
        .hfont{
            color: #00baf2;
        }
        .sina15-dropdown a:hover{
            color:#23527c ;
        }
    </style>
    <article>
        <div class="container">
            <h2 class="ctitle"><b>站长唯美相册</b> <span style="color: #fff;">好咖啡要和朋友一起品尝，好“照片”也要和同样喜欢它的人一起分享。</span></h2>
            <div class="blog">
                @foreach($album as $albums)
                    @if($albums->al_ques!=null&&$albums->ima_road!=null)
                        <figure>
                            <ul rel="{{$albums->al_id}}">
                                @if(isset($adminsta))
                                    <div href="#" rel="2" class="aimages" onclick="showiamges(this)" target="_blank" title="{{$albums->al_name}}"><img src="{{asset("upimage/".$albums->ima_road)}}"></div>
                                @else
                                <div style="margin-right: 3%;margin-top: 3%;" href="#" rel="1" class="aimages" target="_blank" onclick="showiamges(this)" title="{{$albums->al_name}}"><img src="{{asset('images/imaques.jpg')}}"></div>
                                @endif
                            </ul>
                            <p><a href="#" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a></p>
                            <figcaption>{{$albums->al_introce}}</figcaption>
                        </figure>
                        @endif
                      @if($albums->al_ques!=null&&$albums->ima_road==null)
                            <figure>
                                <ul rel="{{$albums->al_id}}">
                                    @if(isset($adminsta))
                                        <div href="#" rel="3" class="aimages" onclick="showiamges(this)" target="_blank" title="{{$albums->al_name}}"><img src="{{asset('images/imemty.png')}}"></div>
                                        @else
                                    <div style="margin-right: 3%;margin-top: 3%;" href="#" rel="1" class="aimages" target="_blank" onclick="showiamges(this)"title="{{$albums->al_name}}"><img src="{{asset('images/imaques.jpg')}}"></div>
                                    @endif
                                </ul>
                                <p><a href="#" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a></p>
                                <figcaption>{{$albums->al_introce}}</figcaption>
                            </figure>
                          @endif
                        @if($albums->al_ques==null&&$albums->ima_road!=null)
                            <figure>
                                <ul rel="{{$albums->al_id}}">
                                    <div href="#" rel="2" class="aimages" onclick="showiamges(this)" target="_blank" title="{{$albums->al_name}}"><img src="{{asset("upimage/".$albums->ima_road)}}"></div>
                                </ul>
                                <p><a href="#" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a></p>
                                <figcaption>{{$albums->al_introce}}</figcaption>
                            </figure>
                        @endif
                        @if($albums->al_ques==null&&$albums->ima_road==null)
                            <figure>
                                <ul rel="{{$albums->al_id}}">
                                    <div href="#" rel="0" class="aimages" onclick="showiamges(this)" target="_blank" title="{{$albums->al_name}}"><img src="{{asset('images/imemty.png')}}"></div>
                                </ul>
                                <p><a href="#" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a></p>
                                <figcaption>{{$albums->al_introce}}</figcaption>
                            </figure>
                        @endif
                    @endforeach
            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog"style="width: 510px">
                <div class="modal-content" style="width: 340px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyque()">&times;</button>
                        <h4 class="modal-title" id="ModalLabel" style="text-align: center;">请输入回答主人问题</h4>
                    </div>
                    <div class="modal-body">
                        <span>问题</span>
                        <input id="ques" maxlength="6px">
                        <p  style="margin-top: 20px">答案：</p>
                        <textarea class="incont" style="width: 312px;display: block;height: 56px;" id="amswer" maxlength="10px"></textarea>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-primary relpy" onclick="showimgans(this)">提交答案</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </aside>
    </article>
    {{--<script>--}}
        {{--if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){--}}
            {{--(function(){--}}
                {{--window.scrollReveal = new scrollReveal({reset: true});--}}
            {{--})();--}}
        {{--};--}}
    {{--</script>--}}
<script>
    albumnav();
    emptyque();
</script>
    <script src="{{asset('js/common/jquery-3.2.js')}}"></script>
    <script src="{{asset('css/layer/layer.js')}}"></script>
    <link href="{{asset('css/layer/theme/default/layer.css')}}" rel="stylesheet">
    <link href="{{asset('css/common/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/common/bootstrap.min.js')}}"></script>
@stop
