<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>坏小哥博客用户登陆</title>
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/frontcss/enter.css')}}">
    <link rel="stylesheet" href="{{asset('css/common/bootstrap.min.css')}}">
    <script src="{{asset('js/common/jquery-3.2.js')}}" type="text/javascript"></script>
    <script type="text/javascript"charset="UTF-8" src="{{asset('js/common/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/frontjs/enter.js')}}" type="text/javascript"></script>
    <script src="{{asset('css/layer/layer.js')}}"></script>
    <link href="{{asset('css/layer/theme/default/layer.css')}}" rel="stylesheet">
</head>
<body >
{{--{{ $success }}--}}
<div style="float: right;margin-top: 5%;margin-right: 10%;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#repwd">找回密码</button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#adduse">加入我们</button>
</div>
<div class="content">
    <div class="content-header" style="height: 70px">
        <h2 style="color: #fff">欢迎进入Miss坏小哥博客</h2>
    </div>
    <div class="content-main">
        <ul class="content-form">
            <li class="magername">
                <div class="input">
                            <span class="icon">
                                 <i>账号</i>
                            </span>
                    <input style="color: #0A0A0A;height: 42px;width:85%" id="accounttext" name="account" type="text" class="text"  placeholder="账号" maxlength="30">
                </div>
            </li>
            <li class="password">
                <div class="input">
                            <span class="icon">
                                <i>密码</i>
                            </span>
                    <input style="color:#000;height: 42px;width:85%" id="passwordtext" name="password" type="password" class="text" placeholder="密码" maxlength="30">
                </div>
            </li>
            <li >
                <div class="input">
                    <input   id="mycode" type="text" style="width:34%;height: 40px;size:13px;color: #0A0A0A" name="code" placeholder="验证码">
                    <img src="{{url('captcha/1')}}" style="float: right;margin-top: 3px;height:35px;margin-right: 4px" id="code" onclick="showcode()" class="prove"/>
                </div>
            </li>
            <li class="enter">
                <button class="inputmanage btn btn-primary" style="height:47px;float: left;width: 131px;margin-left: 30%" type="button" onclick="userlog()">登录</button>
            </li>
        </ul>
    </div>
</div>
<div class="modal fade" id="repwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:390px;width:500px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptyenter()">&times;</button>
                <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                    请输入内容
                </h4>
            </div>
            <div class="modal-bodys" style="height:210px;">
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
                            <input id="ques"  maxlength="10">
                        </div>
                    </li>
                    <li style="margin-left: 7%">
                        <div>
                <span>
                    新密码：
                </span>
                            <input id="usepwd" maxlength="10">
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
        <div class="modal-content" style="height:390px;width:500px;">
            <form method="post" action="addusers" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="ddempty()">&times;</button>
                <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                    请输入内容
                </h4>
            </div>
            <div class="modal-bodys" style="height:263px;">
                <ul style="margin-top: -30px">
                    <li>
                        <div>
                <span>
                    昵称：
                </span>
                            <input id="adname" name="adname" maxlength="10">
                        </div>
                    </li>
                    <li>
                        <div>
                <span>
                    账号：
                </span>
                            <input id="adusecount" name="adusecount" maxlength="18">
                        </div>
                    </li>
                    <li>
                        <div>
                <span>
                    密码：
                </span>
                            <input id="adusepwd" name="adusepwd" maxlength="10">
                        </div>
                    </li>
                    <li>
                        <div>
                <span>
                    密保：
                </span>
                            <input id="adques" name="adques" maxlength="10">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">注册</button>
            </div>
            </form>
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <script>
        setTimeout(function () {
            $("#errors").fadeOut()
        },2000)
    </script>
    <div class="alert alert-danger" id="errors" style="width:200px;color: yellow;margin-top: 12%;margin-right: -13%;float: right;background-color: red;">
        <ul style="margin-left: 22%">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
<script>
    function showcode() {
        $url = "{{ URL('captcha') }}";
        $url = $url + "/" + Math.random();
        $('#code').attr("src",$url);
    }
</script>
@if(isset($user))
    <script>
        remain();
    </script>
    @endif
</html>