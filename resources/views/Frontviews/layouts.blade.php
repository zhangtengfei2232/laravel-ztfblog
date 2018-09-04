<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>坏小哥的博客</title>
    <meta name="keywords" content="city, blog, web, theme, design, free templates, website templates, CSS, HTML" />
    <meta name="description" content="City Blog Theme is a free website template provided by templatemo.com for all webmasters." />
    <link href="{{asset('css/frontcss/templatemo_style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/frontcss/svwp_style.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/frontjs/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('js/common/bootstrap.min.js')}}"></script>
    <link href="{{asset('css/layer/theme/default/layer.css')}}" rel="stylesheet">
    <script src="{{asset('css/layer/layer.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/common/bootstrap.min.css')}}">
    <script src="{{asset('js/frontjs/enter.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/frontjs/images.js')}}"></script>
</head>
<style>
    li {
        list-style: none;
    }
</style>
<body style="background-color: #0A0A0A;">
<div id="templatemo_wrapper">
    <div id="templatemo_header">
        <div id="site_title" style="margin-right: 12%;margin-top: -3%">
            <a href="#">
                <img src="{{asset('images/name.png')}}" alt="To be or not to be,that's a question!" />
            </a>
        </div>
    </div>
    @if(isset($username))
        <div class="sina15-client" onmousemove="showfuntion()" onmouseout="hiddenfun()">
            <div class="sina15-client-tl">
                <a class="sina15-more" href="#" data-action="dropdown" data-target="mobileclient">功能列表<i class="sina15-icon sina15-icon-arrows-a"></i></a>
            </div>
            <ul id="mobileclient" class="sina15-dropdown" style="display: none">
                <li data-sudaclick="nav_app_weibo_p"><a href="#" onclick="showupquesmodal()">修改密保</a href="#"></li>
                <li data-sudaclick="nav_app_news_p"><a href="#" onclick="showupwdmodal()" >修改密码</a></li>
                <li data-sudaclick="nav_app_sports_p"><a href="#" onclick="showupnamemodal()">修改昵称</a></li>
                <li data-sudaclick="nav_app_finance_p"><a href="emptyssession">退出登录</a></li>
            </ul>
        </div>
        <div class="sta" style="">
       <span style="color: #fff">
            昵称：
            <span style="margin-top: 13px;color: #00baf2"  id="spaname">
               {{$username}}
            </span>
        </span>
        </div>
        @else
        <div id="comein">
            <button class="allbtns" id="repwds" onclick="showrepwd()">找回密码</button>
            <button class="allbtns" data-toggle="modal" data-target="#adduse">加入我们</button>
            <button id="admin" class="allbtns" data-toggle="modal" data-target="#login">登录</button>
        </div>
    @endif
    @if(!empty(session('success')))
        <script>
            layer.alert('{{session('success')}}');
        </script>
        @endif
    <div id="templatemo_menu">
        <ul>
            <li><a id="main" href="{{url('mainpage')}}"  class="current">个人主页<span style="color: #fff">ZTFPAGE</span></a></li>
            <li><a id="artical" href="{{url('showart')}}">文章荟萃<span style="color: #fff">ARTICAL</span></a></li>
            <li><a id="album" href="{{url('showimapage')}}">清新相册<span style="color: #fff">MYALBUM</span></a></li>
            <li><a id="speachpage" href="{{url('showspepage')}}">闲言碎语<span style="color: #fff">YOUANDME</span></a></li>
        </ul>
    </div>
    <div id="templatemo_mai" style="overflow: hidden;width: 100%">
        @section('content')
        @show
    </div>
</div>
<div id="templatemo_footer_wrapper" style="overflow: hidden;text-align: center;">
    <div id="templatemo_footer">
        <a href="{{url('mainpage')}}" class="current" target="_blank">个人主页</a> | <a href="{{url('showartpage')}}"  target="_blank">文章荟萃</a> | <a href="{{url('showimapage')}}"  target="_blank">清新相册</a>| <a href="{{url('showspepage')}}"  target="_blank">闲言碎语</a>
        <div class="cleaner h10"></div>
        <a href="#">欢迎下次进入坏小哥的博客</a>——><a href="{{url('mainpage')}}" target="_parent" title="博客网址">博客网址</a>
    </div>
</div>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
            <input type="hidden" name="judge" value="ztf" style="display: none">
            <div class="modal-content" style="height:390px;width:500px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptylogins()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                        欢迎进入坏小哥博客
                    </h4>
                </div>
                <div class="modal-body" style="height:214px;margin-top: 7%">
                    <ul style="margin-top: -30px">
                        <li style="margin-top: 9%">
                            <div>
                <span>
                    账号：
                </span>
                                <input id="account" maxlength="18" name="account" placeholder="账号为邮箱">
                            </div>
                        </li>
                        <li style="margin-top: 8%">
                            <div>
                <span>
                    密码：
                </span>
                                <input id="passwords" type="password" maxlength="10" name="password" placeholder="密码支持10位">
                            </div>
                        </li>
                        <li style="margin-left: -3%;margin-top: 7%">
                            <div class="input">
                            <span>
                            验证码：
                        </span>
                                <input id="mycode" type="text" style="height: 30px;size:13px;color: #0A0A0A" name="code" placeholder="验证码">
                                <img src="{{url('captcha/1')}}" style="float: right;margin-top: 3px;height:35px;margin-right: 4px" id="code" onclick="showcode()" class="prove"/>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer" style="margin-top: 4%">
                    <button type="button" class="btn btn-primary" onclick="userlogin()">登录</button>
                </div>
            </div>
    </div>
</div>
<div class="modal fade" id="upname" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:244px;width:366px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyenters()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                        请输入内容
                    </h4>
                </div>
                <div class="modal-bodys" style="height:65px;margin-top: 24%">
                    <ul style="margin-top: -30px">
                        <li style="margin-left: 1%;margin-top: 9%">
                            <div>
                <span>
                    新昵称：
                </span>
                                <input id="usname"  name="usname" maxlength="10">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="upname()">修改昵称</button>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="upques" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:338px;width:460px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyenters()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                        请输入修改密保信息
                    </h4>
                </div>
                <div class="modal-bodys" style="height:160px;">
                    <ul style="margin-top: -30px">
                        <li style="margin-top: 17%;margin-left: 4%">
                            <div>
                <span>
                    账号：
                </span>
                                <input id="upquescont" name="upquescont" maxlength="18">
                            </div>
                        </li>
                        <li style="margin-top: 9%;margin-left: 4%">
                            <div>
                <span>
                    密码：
                </span>
                                <input id="upquespwd" type="password" name="upquespwd" maxlength="18">
                            </div>
                        </li>
                        <li style="margin-left: 1%;margin-top: 10%">
                            <div>
                <span>
                    新密保：
                </span>
                                <input id="newques"  name="newques" maxlength="10">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer" style="margin-top: 5%">
                    <button type="button" class="btn btn-primary" onclick="upquess()">修改密保</button>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uppwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:335px;width:420px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyenters()">&times;</button>
                <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                    请输入修改密码信息
                </h4>
            </div>
            <div class="modal-body uppwd" style="height:214px;">
                <ul style="margin-top: -30px">
                    <li style="margin-left: 21%;margin-top: 17%">
                        <div>
                <span>
                    账号：
                </span>
                            <input id="upusecount" maxlength="18">
                        </div>
                    </li>
                    <li style="margin-left: 17%;margin-top: 4%">
                        <div>
                <span>
                    旧密码：
                </span>
                            <input id="oldpwd" type="password" maxlength="10">
                        </div>
                    </li>
                    <li style="margin-top: 5%;margin-left: 17%">
                        <div>
                <span>
                    新密码：
                </span>
                            <input id="newpwd" type="password" maxlength="10">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="upmapwds()">修改密码</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="repwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:335px;width:421px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyenters()">&times;</button>
                <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                    请输入找回密码信息
                </h4>
            </div>
            <div class="modal-bodys rearpwd" style="height:180px;text-align: center">
                <ul style="margin-top: -30px">
                    <li style="margin-top: 17%">
                        <div>
                <span>
                    账号：
                </span>
                            <input id="usecount" maxlength="18">
                        </div>
                    </li>
                    <li>
                        <div>
                <span>
                    密保：
                </span>
                            <input id="quess"  maxlength="10">
                        </div>
                    </li>
                    <li style="margin-left: -3%">
                        <div>
                <span>
                    新密码：
                </span>
                            <input id="usepwd" type="password" maxlength="10">
                        </div>
                    </li>

                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="researpwd(2)">找回密码</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="adduse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="min-height:390px;height:auto;width:461px;">
            <form method="post" id="addusersform" action="addusers" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="ddempty()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                        请输入注册信息
                    </h4>
                </div>
                @if (count($errors) > 0)
                    <script>
                        $('#adduse').modal('show');
                        setTimeout(function () {
                            $("#errors").fadeOut()
                        },1999)
                    </script>
                    <div class="alert alert-danger" id="errors" style="width:221px;float:left;margin-left:25%;height:31px;color: yellow;background-color: red;">
                        <ul>
                            <li style="margin-top: -16%;line-height: 50px">{{ $errors->first()}}</li>
                        </ul>
                    </div>
                @endif
                <div class="modal-bodys adduse" style="margin-top: 18%;height:230px;text-align: center;margin-right: -14%">
                    <ul style="margin-top: -30px;width: 70%">
                        <li>
                            <div>
                <span>
                    昵称：
                </span>
                                <input id="adname" name="adname" maxlength="10" placeholder="昵称最多10个字符">
                            </div>
                        </li>
                        <li>
                            <div>
                <span>
                    账号：
                </span>
                                <input id="adusecount" name="adusecount" maxlength="20" placeholder="账号最多20个字符,且为邮箱">
                            </div>
                        </li>
                        <li>
                            <div>
                <span>
                    密保：
                </span>
                                <input id="adques" name="adques" maxlength="10" placeholder="密保最多10个字符">
                            </div>
                        </li>
                        <li>
                            <div>
                <span>
                    密码：
                </span>
                                <input id="adusepwd" type="password" name="adusepwd" maxlength="10" placeholder="密码最多10个字符">
                            </div>
                        </li>
                        <li style="margin-right: 9%">
                            <div>
                <span>
                    确认密码：
                </span>
                                <input id="readusepwd" type="password" name="readusepwd" maxlength="10" placeholder="请再次确认密码">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="adduser()">注册</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function showcode() {
        $url = "{{ URL('captcha') }}";
        $url = $url + "/" + Math.random();
        $('#code').attr("src",$url);
    }
</script>
</body>
</html>