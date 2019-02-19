@extends('Backviews.Backlayout')
<!DOCTYPE html>
<link href="{{asset('css/common/base.css')}}" rel="stylesheet">
<link href="{{asset('css/common/share.css')}}" rel="stylesheet">
<link href="{{asset('css/common/m.css')}}" rel="stylesheet">
<link href="{{asset('css/common/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('js/common/scrollReveal.js')}}"></script>
<style>
    img{
        display: inline;
    }
</style>dsdsasdasdasdasd
<style>
    .aimages{
        float: right;
        cursor: pointer;
    }
</style>
<style>
    .blog figure{
        margin-left: 25px;
    }
    .frontnav li{
        width: 103px;
    }
    .nav li a{
        width: 100%;
        font-size: 15px;
    }
    .navbar-default{
        height: 76px;
    }
    .navbar-nav.navbar-right{
        margin-right: 5px!important;
    }
    .btns{
        font-size: 10px;
        width: 67px!important;
        background-color: #0A0A0A;
    }
</style>
@section('maincontent')
    <div class="containe"style="margin-left: 20%">
        <h2 class="ctitle "><b>唯美.小清新</b> <span class="glyphicon glyphicon-plus" style="color:#fff;cursor: pointer" data-toggle="modal"  onclick="shaddal()">添加坏小哥相册</span></h2>
        <figcaption class="blog">
            @foreach($album as $albums)
                @if($albums->al_ques!=null&&$albums->ima_road!=null)
                    <figure>
                        <ul rel="{{$albums->al_id}}">
                            <div href="#" class="aimages" target="_blank" title="{{$albums->al_name}}">
                                <button type="button" class="close" rel="{{$albums->al_id}}" data-dismiss="modal" aria-hidden="true" onclick="deletealbums(this)">&times;</button>
                                <img rel="{{$albums->al_id}}" src="{{asset("upimage/".$albums->ima_road)}}" onclick="reshowimage(this)">
                            </div>
                        </ul>
                        <p>
                            <a href="#" style="margin-left: 18%" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a>
                        </p>
                        <figcaption>{{$albums->al_introce}}</figcaption>
                        <button class="btns" style="width: 80px;margin-left: 2%" type="type" rel="{{$albums->al_id}}" class="btn btn-primary" onclick="shupnamodel(this)">换名字</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="btn btn-primary" onclick="shupconmodel(this)">改介绍</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="seques(this)">改密保</button>
                        <button class="btns"   style="width: 80px;float: right;margin-right: 6px;margin-top: 3px;" type="button" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="deleteque(this)">删密保</button>
                    </figure>
                @endif
                @if($albums->al_ques!=null&&$albums->ima_road==null)
                    <figure>
                        <ul rel="{{$albums->al_id}}">
                            <div href="#" style="margin-right: 8%"  class="aimages" target="_blank" title="{{$albums->al_name}}">
                                <button type="button" style="width: 10px;height: 5px;" class="close" rel="{{$albums->al_id}}" data-dismiss="modal" aria-hidden="true" onclick="deletealbums(this)">&times;</button>
                                <img rel="{{$albums->al_id}}" src="{{asset("upimage/imemty.png")}}" onclick="reshowimage(this)">
                            </div>
                        </ul>
                        <p><a href="#" style="margin-left: 18%" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a>
                        </p>
                        <figcaption style="line-height: 16px">{{$albums->al_introce}}</figcaption>
                        <button class="btns" style="width: 80px;margin-left: 2%" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="shupnamodel(this)">换名字</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="shupconmodel(this)">改介绍</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="seques(this)">改密保</button>
                        <button class="btns" style="width: 80px;float: right;margin-right: 6px;margin-top: 3px;" type="submit" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="deleteque(this)">删密保</button>
                    </figure>
                @endif
                @if($albums->al_ques==null&&$albums->ima_road!=null)
                    <figure>
                        <ul rel="{{$albums->al_id}}">
                            <div href="#"  class="aimages" target="_blank" title="{{$albums->al_name}}">
                                <button type="button" class="close" rel="{{$albums->al_id}}" data-dismiss="modal" aria-hidden="true" onclick="deletealbums(this)">&times;</button>
                                <img rel="{{$albums->al_id}}" src="{{asset("upimage/".$albums->ima_road)}}" onclick="reshowimage(this)">
                            </div>
                        </ul>
                        <p><a href="#" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a></p>
                        <figcaption>{{$albums->al_introce}}</figcaption>
                        <div style="text-align: center">
                        <button class="btns" style="width: 80px;margin-left: 2%" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="shupnamodel(this)">换名字</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="shupconmodel(this)">改介绍</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="addquemodel(this)">加密保</button>
                        </div>
                    </figure>
                @endif
                @if($albums->al_ques==null&&$albums->ima_road==null)
                    <figure>
                        <ul rel="{{$albums->al_id}}">
                            <div href="#" style="width: 110%;"  class="aimages"  target="_blank" title="{{$albums->al_name}}">
                                <button type="button" class="close" rel="{{$albums->al_id}}" data-dismiss="modal" aria-hidden="true" onclick="deletealbums(this)">&times;</button>
                                <img  rel="{{$albums->al_id}}" src="{{asset("upimage/imemty.png")}}" onclick="reshowimage(this)">
                            </div>
                        </ul>
                        <p><a href="#" target="_blank" title="坏小哥博客">{{$albums->al_name}}</a></p>
                        <figcaption>{{$albums->al_introce}}</figcaption>
                        <div style="text-align: center">
                        <button class="btns" style="width: 80px;margin-left: 2%" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="shupnamodel(this)">换名字</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="shupconmodel(this)">改介绍</button>
                        <button class="btns" style="width: 80px" type="type" rel="{{$albums->al_id}}" class="delete btn btn-primary" onclick="addquemodel(this)">加密保</button>
                        </div>
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="addalmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emadals()">&times;</button>
                    <h4 class="modal-title" id="myModal" style="text-align: center;">请输入新相册信息</h4>
                </div>
                <div class="modal-body" >
                    <span style="float: left;">昵称：</span>
                    <input id="alname" maxlength="6px" style="float: left;" placeholder="字符不能超过6个">
                    <span style="margin-right: 84%;margin-top: 10%;float: right;width: 50px">密保：</span>
                    <input id="savepwd" maxlength="6px" style="margin-right: 27%;margin-top: -7%;float: right;"placeholder="字符不能超过6个">
                    <p  style="float: left;margin-top: 32px;">答案：</p>
                    <textarea class="incont" style="margin-right: 1%;float: right;width: 257px; display: block;height: 43px;margin-top: 9%;" id="amswerpwd" maxlength="20px" placeholder="字符不能超过10个"></textarea>
                    <p  style="float: left;margin-top: 32px;">相册介绍：</p>
                    <textarea class="incont" style="float: left;width: 300px; display: block;height: 60px;margin-top: -1%;" id="introce" maxlength="30px" placeholder="字符不能超过30个"></textarea>
                    <div class="modal-footer" style="margin-top: 93%">
                        <button type="button" id="addalbt" class="btn btn-primary relpy" onclick="addalbum()">添加相册</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emadals()">&times;</button>
                    <h4 class="modal-title" id="ModalLabel" style="text-align: center;">请输入内容</h4>
                </div>
                <div class="modal-body">
                    <span>问题</span>
                    <input id="addques" maxlength="6px">
                    <p  style="margin-top: 20px">答案：</p>
                    <textarea class="incont" style="width: 312px;display: block;height: 56px;" id="addamswer" maxlength="10px"></textarea>
                    <div class="modal-footer">
                        <button type="button" id="addquebt" class="btn btn-primary addques" onclick="addques(this)">添加</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emadals()">&times;</button>
                    <h4 class="modal-title" id="upModalLabel" style="text-align: center;">请输入修改内容</h4>
                </div>
                <div class="modal-body" >
                    <span>问题</span>
                    <input id="updateques" maxlength="6px">
                    <p  style="margin-top: 20px">答案：</p>
                    <textarea class="incont" style="width: 308px;display: block;height: 43px;" id="updateamswer" maxlength="10px"></textarea>
                    <div class="modal-footer">
                        <button type="button" id="upquebt" class="btn btn-primary updateques" onclick="updateques(this)">修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updatename" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emadals()">&times;</button>
                    <h4 class="modal-title" id="upnameModalLabel" style="text-align: center;">请输入新相册名字</h4>
                </div>
                <div class="modal-body" style="height: 150px" >
                    <div style="margin-top: 5%">
                        <span>新相册名</span>
                        <input id="updaname" maxlength="6px">
                    </div>
                    <div class="modal-footer" style="margin-top: 9%">
                        <button type="button" id="upnamebt" class="btn btn-primary updatename" onclick="updatealname(this)">修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updatecontent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emadals()">&times;</button>
                    <h4 class="modal-title" id="upnameModalLabel" style="text-align: center;">请输入新相册名字</h4>
                </div>
                <div class="modal-body" style="height: 210px" >
                    <div style="margin-top: 5%">
                        <span>相册新介绍</span>
                        <textarea id="updacontent" style="width: 300px;height: 67px" maxlength="30px"></textarea>
                    </div>
                    <div class="modal-footer" style="margin-top: 9%">
                        <button type="button" id="upcontentbt" class="btn btn-primary updatename" onclick="upalinronce(this)">修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        realbumnav();
    </script>
@endsection