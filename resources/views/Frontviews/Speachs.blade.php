<!doctype html>
<html>
@extends('Frontviews.layouts')
<link href="{{asset('css/frontcss/book.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/common/base.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/common/m.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('js/common/scrollReveal.js')}}"></script>
{{--<script src="{{asset('js/frontjs/modernizr.js')}}"></script>--}}
<style>
    img{
        display: inline;
    }
</style>
@section('content')
    <article>
        <aside>
        <div class="container">
            <h2 class="ctitle" style="color: #fff"><b>留言板</b> <span>你，生命中最重要的过客，之所以是过客，因为你未曾为我停留。</span></h2>
            <div class="gbook">
                <div class="about">
                    <div id="fountainG">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>

                    </div>
                    <div class="about_girl"><span><a href="/"><img src="{{asset('images/mself.jpg')}}"></a></span>
                        <p>当您驻足停留过，从此便注定我们的缘分。站在时间的尽头，我们已是朋友，前端的路上我再也不用一个人独自行走。</p>
                    </div>
                    <div class="gbko">
                        <!--高速版-->
                        <div id="SOHUCS" sid="[!--id--]" ></div>
                        <script src="{{asset('js/frontjs/changyan.js')}}"></script>
                        <script type="text/javascript">
                            window.changyan.api.config({
                                appid: 'cyt6UkrdY',
                                conf: 'prod_37667ae67efaadf448cac07713d3165a'
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </aside>
    </article>
    <script>
        if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
            (function(){
                window.scrollReveal = new scrollReveal({reset: true});
            })();
        };
    </script>
    <script>
        spemynav({{$speach}});
    </script>
@stop
</html>