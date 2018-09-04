<!DOCTYPE html>
<html lang="en">
<head>
    <title>坏小哥博客后台管理</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('css/common/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/backcss/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/backcss/chartist-custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/backcss/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/backcss/demo.css')}}">
    <script src="{{asset('js/frontjs/jquery-1.12.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
    <script src="{{asset('js/common/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/backjs/respeach.js')}}"></script>
    <script src="{{asset('css/layer/layer.js')}}"></script>
    <script src="{{asset('js/backjs/reartical.js')}}"></script>
    <script src="{{asset('js/backjs/reimages.js')}}"></script>
    {{--<script src="{{asset('js/backjs/jquery.easypiechart.min.js')}}"></script>--}}
    {{--<script src="{{asset('js/backjs/jquery.slimscroll.min.js')}}"></script>--}}
    {{--<script src="{{asset('js/backjs/chartist.min.js')}}"></script>--}}
    {{--<script src="{{asset('js/backjs/klorofil-common.js')}}"></script>--}}
    <link href="{{asset('css/layer/theme/default/layer.css')}}" rel="stylesheet">
</head>
<style>
    .nav li{
        line-height: 82px;
    }
</style>
<body  style="background-color: #0A0A0A" id="outer">
<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div style="font-size:50px;letter-spacing:66px;float:left;margin-left: 55px">
                <span>坏小哥博客管理</span>
            </div>
            <div id="navbar-menu">
                <ul class="nav navbar-nav navbar-right frontnav">
                    <li class="dropdown">
                        <a href="{{url('batomainpage')}}" class="dropdown-toggle" target="_blank">
                            <span class="badge bg-danger">进入前台</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a style="cursor: pointer" class="dropdown-toggle" onclick="showuppwd()">
                            <span class="badge bg-danger" style="width: 70px">修改密码</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">
                            <span class="badge bg-danger" style="width: 70px" onclick="emptysessions(1)">退出</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <li><a id="reartid" href="showreart" class="collapsed"><i class="glyphicon glyphicon-list-alt"></i> <span>文章管理</span></a></li>
                    <li><a id="relable" href="showlable" class="collapsed"><i class="glyphicon glyphicon-send"></i> <span>标签管理</span></a></li>
                    <li>
                        <a id="respeach" href="#subPages" data-toggle="collapse" class="collapsed" onclick="showspeimg(this)">
                            <i class="glyphicon glyphicon-open"></i>
                            <span>闲言管理</span>
                        </a>
                        <div id="subPages" class="collapse">
                            <ul class="nav">
                                <li><a id="showartcolor" href="showrespea" class=""><i class="glyphicon glyphicon-heart"></i> <span>文章-管理</span></a></li>
                                <li><a id="showspecolor" href="showartpage" class=""><i class="glyphicon glyphicon-tint"></i> <span>留言-管理</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a id="realbum" href="showalbum" class="collapsed"><i class="glyphicon glyphicon-picture"></i> <span>相册管理</span></a></li>
                    <li><a id="reinfor" href="showreinma" class="collapsed"><i class="glyphicon glyphicon-user"></i> <span>信息管理</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="main"  style="background-color: #0A0A0A">
        <div class="main-content">
            <div class="container-fluid">
                @section('maincontent')
                @show
            </div>
        </div>
    </div>
    <footer style="margin-right: 35%;float: right;position: fixed">
        <div class="container-fluid" style="color: #fff">
            <p class="copyright">&copy; 2018 <a href="#" target="_blank">坏小哥</a>的博客平台-> <a href="http://www.cssmoban.com/" target="_blank" title="只有更坏的">坏小哥</a> 网址： <a href="#" title="坏小哥" target="_blank">坏小哥</a></p>
        </div>
    </footer>
</div>
<div class="modal fade" id="uppwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false"style="height: 500px">
    <div class="modal-dialog">
        <div class="modal-content" style="height:350px;width:420px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="empmodel()">&times;</button>
                <h4 class="modal-title" id="myModalLabel"style="text-align: center;">
                    请输入内容
                </h4>
            </div>
            <div class="modal-body" style="height:214px;">
                <ul style="margin-top: -30px;list-style: none">
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
                            <input id="oldpwd" maxlength="10" type="password">
                        </div>
                    </li>
                    <li style="margin-top: 5%;margin-left: 17%">
                        <div>
                <span>
                    新密码：
                </span>
                            <input id="newpwd" maxlength="10" type="password">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="upmapwd()">修改密码</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/common/bootstrap.min.js')}}"></script>
<script src="{{asset('js/backjs/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('js/backjs/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('js/backjs/chartist.min.js')}}"></script>
<script src="{{asset('js/backjs/klorofil-common.js')}}"></script>
</body>
</html>
