<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <title>坏小哥后台登陆</title>
    <link rel="stylesheet" href="{{asset('css/frontcss/enter.css')}}">
</head>
<body >
<div style="float: right;margin-top: 5%;margin-right: 10%;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#repwd">找回密码</button>
</div>
<div class="content">
    <div class="content-header" style="height: 68px">
        <h2 style="color:#fff;">坏小哥博客后台登陆</h2>
    </div>
    <div class="content-main">
        <ul class="content-form">
            <li class="magername">
                <div class="input">
                    <input style="color: #000;width: 101%;height: 100%;" id="accounttext" autocomplete="off" name="account" type="text" class="text"  placeholder="账号" maxlength="30">
                </div>
            </li>
            <li class="password">
                <div class="input">
                    <input style="color:#000;width: 101%;height: 100%;" id="passwordtext" autocomplete="off" name="password" type="password" class="text" placeholder="密码" maxlength="30">
                </div>
            </li>
            <li >
                <div class="input">
                    <input  type="text" id="macode" style="width:40%;height: 43px;size:13px;color: #0A0A0A" name="code" placeholder="验证码">
                    <img  src="{{url('captcha/1')}}" style="width:50%;float: right;height:35px;margin-top: 3px;margin-right: 4px" id="code" class="prove" onclick="showcode()"/>
                </div>
            </li>
            <li class="enter">
                <button class="inputmanage btn btn-primary" style="height:47px;float: left;width: 131px;margin-left: 30%" onclick="malogin()" >登录后台</button>
            </li>
        </ul>
    </div>
</div>
<div class="modal fade" id="repwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:390px;width:428px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emrepwdmodal()">&times;</button>
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
                            <input id="usepwd" maxlength="10" type="password">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="researpwd(1)">找回密码</button>
            </div>
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <script>
        setTimeout(function () {
            $("#errors").fadeOut()
        },4000)
    </script>
    <div class="alert alert-danger" id="errors" style="color: yellow;margin-top: 12%;margin-right: -6%;float: right;background-color: red;">
        <ul>
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

<script src="{{asset('js/common/jquery-3.2.js')}}" type="text/javascript"></script>
<script src="{{asset('js/frontjs/images.js')}}" type="text/javascript"></script>
<script src="{{asset('css/layer/layer.js')}}"></script>
<link href="{{asset('css/layer/theme/default/layer.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/common/bootstrap.min.css')}}">
<script type="text/javascript"charset="UTF-8" src="{{asset('js/common/bootstrap.min.js')}}"></script>
</html>