@extends('Backviews.Backlayout')
@section('maincontent')
    <style>
        .sidebar{
            width: 16%!important;
            margin-top: 80px!important;
            float: right;
        }
        .main{
            width: 83%!important;
            margin-top: 80px;
            float: right;
        }
        #wrapper #sidebar-nav,#wrapper .main{
            padding: 0!important;

        }
    </style>
    <script src="{{asset('js/backjs/validateart.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/backcss/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/backcss/amazeui.min.css')}}">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
        footer{
            position: fixed;
        }
    </style>
    @if(isset($artmation))
    <form method="post" id="upform" action="updateart" enctype="multipart/form-data">
        @else
        <form method="post" id="addart" action="addart" enctype="multipart/form-data"  style="color: #fff">
        @endif
        {{ csrf_field() }}
        <div class="am-form">
            @if(isset($artmation))
                <input id="oldartyid" name="oldartyid" type="hidden" rel="{{$artmation[0]->ty_id}}" value="{{$artmation[0]->ty_id}}">
                <input name="artid" value="{{$artmation[0]->art_id}}" style="display: none">
            @endif
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right" style="color: #fff">
                    文章标题:
                </div>
                <div class="am-u-sm-8 am-u-md-4">
                    @if(isset($artmation))
                        <input type="text"  style="display: none" id="oldartitle" value="{{$artmation[0]->art_title}}">
                        <input type="text" id="newartitle" value="{{$artmation[0]->art_title}}" minlength="2px" maxlength="10px" class="am-input-sm" name="artitle" placeholder="仅支持2-10个字符">
                   @else
                    <input type="text" id="addartitle" class="am-input-sm" name="artitle" minlength="2px" maxlength="10px" placeholder="仅支持2-10个字符">
                @endif
                </div>
                <div class="am-u-sm-12 am-u-md-6"></div>
            </div>
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right" style="color: #fff">所属类别:</div>
                <div class="am-u-sm-8 am-u-md-10" style="width: 10%">
                    <select id="arttyid" name="artnewype" style="height: 4%;padding: 0px">
                        @if(isset($artmation))
                        <option value="{{ $artmation[0]->ty_id }}">{{$artmation[0]->art_ty}}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->ty_id }}">{{ $type->art_ty }}</option>
                            @endforeach
                        @else
                            @foreach($types as $type)
                                <option value="{{ $type->ty_id }}">{{ $type->art_ty }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <span style="margin-left: 32%;" class="btn btn-primary glyphicon glyphicon-plus" onclick="showmodel()">添加文章标签</span>
            </div>
            <div class="am-g am-margin-top">
                <div class="am-u-sm-4 am-u-md-2 am-text-right" style="color: #fff">
                    文章封面:
                </div>
                <div style="left: -44.4%;width:  39%;" class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
                    <div class="am-panel am-panel-default">
                        <div class="am-panel-bd">
                            <div class="am-g">
                                <div class="am-u-md-4 limitImage">
                                    @if(isset($artmation))
                                        <img id="hinimg" style="display: none" class="am-img-circle am-img-thumbnail" src="{{asset("upartimg/".$artmation[0]->ima_road)}}"/>
                                        <img id="seeimg" class="am-img-circle am-img-thumbnail" src="{{asset("upartimg/".$artmation[0]->ima_road)}}"/>
                                    @else
                                        <img id="seeimg" class="am-img-circle am-img-thumbnail" src="" alt=""/>
                                    @endif
                                </div>
                                <div class="am-u-md-8">
                                    <div class="am-form">
                                        <div class="am-form-group">
                                            @if(isset($artmation))
                                                <input type="file" id="user-pic" onchange="showartimg(this,1)" name="artimg">
                                            @else
                                                <input type="file" id="user-pic" onchange="showartimg(this,2)" name="artimg">
                                            @endif
                                            <br><p class="am-form-help">点击修改封面...</p><br><br>
                                            {{--<br><button type="button" onclick="cancle()" class="am-btn am-btn-primary am-btn-xs">删除</button>--}}
                                            {{--<br><p class="am-form-help">点击删除封面...</p>--}}
                                        </div>
                                    </div>
                                    @if(isset($artmation))
                                    <input type="hidden" name="isimg" value="{{$artmation[0]->ima_road}}">
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-g am-margin-top-sm">
                <div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text" style="color: #fff">
                    文章内容:
                </div>
                <div class="am-u-sm-12 am-u-md-10">
                            <textarea id="editor" name="artcontent" type="text/plain">
                            </textarea>
                            @if(isset($artmation))
                                <textarea id="editortext" style="display: none;" type="text/plain">
                                     {!!$artmation[0]->art_text !!}
                                </textarea>
                            @endif
                </div>
                    <script type="text/javascript">
                    $.cretaUE("{{isset($artmation)?$artmation[0]->art_text:null}} ",{{isset($artmation)?1:0}})
                    </script>
            </div>
                <div class="am-u-sm-4 am-u-md-2 am-text-right">
                <div class="am-margin">
                    @if(isset($artmation))
                        <button type="button" onclick="artvalidates()" class="am-btn am-btn-primary am-btn-xs glyphicon glyphicon-pencil">提交</button>
                        @else
                        <button type="button" onclick="addart()" class="am-btn am-btn-primary am-btn-xs glyphicon glyphicon-pencil">提交</button>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px;height: 187px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptymodel()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">请输入新标签名字</h4>
                </div>
                <div class="modal-body" >
                    <form method="post" action="addtype" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <span>标签名字：</span>
                    <input id="newtype" maxlength="12px" name="newtype">
                        @if(isset($artmation))
                    <input name="artid" value="{{$artmation[0]->art_id}}" style="display: none">
                        @endif
                    <div class="modal-footer" style="margin-top: 7%">
                        <button type="submit" class="btn btn-primary relpy" onclick="">添加标签</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($addtypes))
    <script>
     judgeaddtype({{$addtypes}});
    </script>
    @endif
    <script>
        rearticalnav();
    </script>
@endsection
