<!doctype html>
@extends('Frontviews.layouts')
<style>
    .sidebar_box{
        margin-top: -5%;
    }
    .body{
        color: #fff!important;
    }
</style>
@section('content')
    	<div id="templatemo_conten" style="width: 100%;color: #fff;">
            <div id="templatemo_sidebar" style="margin-right:-5%;float: right;height: auto;">
                <div class="sidebar_box">
                    <a style="color:skyblue">相关信息</a>
                </div>
                <div class="sidebar_box">
                    <h4 style="margin-left: 20px;color: yellow">热门文章</h4>
                    <ul class="tmo_list">
                        @foreach($hotart as $hotartical)
                            <li style="width: 100px">
                                <a href="{{url('showdetilepage?artid='.$hotartical->art_id.'&typeid='.$hotartical->art_type)}}" target="_blank">{{$hotartical->art_title}}</a>
                                <span style="display: block">
                          创作时间：{{date('Y-m-d',strtotime($hotartical->created_at))}}
                        </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="sidebar_box" style="margin-left: 14%;width: 100%">
                    <h4 style="color: yellow">游客最新评论</h4>
                    @foreach($newspea as $newspe)
                        <div class="recent_comment_box">
                            <div>
                                <span>日期：{{$newspe->created_at}}</span>
                            </div>
                            <a href="{{url('showdetilepage?artid='.$newspe->spe_artid.'&typeid='.$newspe->art_type)}}" target="_blank">{{$newspe->name}}评论->{{$newspe->art_ty}}->{{$newspe->art_title}}:</a>
                            <p>{{$newspe->spe_text}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="templatemo_slid" style="    -webkit-box-sizing: content-box;
    /* box-sizing: content-box; */">
                <div id="featuredslideshow">
                    <ul>
                        @foreach($newimg as $newimgs)
                        <li><img width="580" height="299" alt="我爱你" src="{{asset("upimage/".$newimgs->ima_road)}}" /></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="post_box"  style="width: 66%;height: 450px">
        		<img src="{{asset('images/ztf.jpg')}}" alt="image" />
                <div class="post_box_right">
					<h2>坏小哥资料库</h2>
				  <div class="post_meta"><strong>性别：</strong>男| <strong>年龄：</strong>不详</div>
                    <p><a href="#" target="_parent" title="个人简介">个人简介:</a>博主是阳光，帅气的小帅哥一枚，喜欢玩游戏，唱歌，跳舞。喜欢个子高，懂礼貌，明事理的女孩。<a href="#" target="_blank"></a><a href="#" target="_blank"></a><a href="#" target="_blank"></a></p>
                    <div class="inform">
                        <div class="mation">
                            <header class="post-header">
                                <h1 class="post-header" itemprop="name headline">About Me</h1>
                            </header>
                            <p>
                                <strong>籍贯</strong>
                                :{{$informa[0]->adm_adres}}
                            </p>
                            <p>
                                <strong>Email</strong>
                                :{{$informa[0]->adm_emile}}
                            </p>
                            <p>
                                <strong>爱好</strong>:
                                {{$informa[0]->adm_hoby}}
                                <a href=""></a>
                            </p>
                            <p>
                                <strong>姓名</strong>
                                :
                                {{$informa[0]->adm_name}}
                                <a href=""></a>
                            </p>
                        </div>
                    </div>
    			</div>
                <div class="cleaner"></div>
            </div>
            <script src="{{asset('js/frontjs/jquery.slideViewerPro.1.0.js')}}" type="text/javascript"></script>
            <script src="{{asset('js/frontjs/jquery.timers.js')}}" type="text/javascript"></script>
            <div class="post_box post_box_last">
                <img src="{{asset('images/birthday.jpg')}}" alt="image" />
                <div class="post_box_right">
	                <h2>生活中的那些事</h2>
				  <div class="post_meta"><strong>日期：</strong>2017年5月3日| <strong>地点:</strong>河南科技学院</div>
                	<p>今天晚上我度过了，来到大学的第一个生日，和我的室友以及我在新乡最喜欢的朋友。我真的很开心，因为有他们的陪伴，我的生日过的才更加的有意义！感谢他们！</p>
                <a href="blog_post.html" class="more">Read more</a><br />
                <div class="cleaner"></div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
            $("div#featuredslideshow").slideViewerPro({
                thumbs: 4,
                thumbsPercentReduction: 15,
                galBorderWidth: 0,
                galBorderColor: "#666",
                thumbsTopMargin: 10,
                thumbsRightMargin: 10,
                thumbsBorderWidth: 1,
                thumbsActiveBorderColor: "#000",
                thumbsActiveBorderOpacity: 0.8,
                thumbsBorderOpacity: 0,
                buttonsTextColor: "#707070",
                autoslide: true,
                typo: true
            });
        </script>
        <script>
            thisnav();
        </script>
@endsection