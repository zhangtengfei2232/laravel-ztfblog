@extends('Backviews.Backlayout')
@section('maincontent')
    <style>
        .ths{
            vertical-align:middle;
            text-align: center;
        }
        .main{
            width: calc(100% - 260px);
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div style="color: #fff;width:82%;">
    <table class="table table-bordered" style="margin-left:18%;color: #fff;width: 80%;vertical-align:middle;text-align: center;">
        <caption class="caption" style="margin-left: 260px"><h1>文章的类型</h1>
            <div style="float: left;margin-left: -49%;">
                <button type="submit" class="add btn btn-primary glyphicon glyphicon-plus" onclick="showmodel()" >添加文章类型</button>
            </div>
        </caption>
        <tr>
            <th class="ths" height="55px">文章类型</th>
            <th class="ths" height="55px">文章数目</th>
            <th class="ths" height="55px" width="100px">编辑</th>
        </tr>
        @foreach($artypes as $artype)
            <tr style="height:30px;">
                <td style="width:100px;vertical-align:middle">{{$artype->art_ty}}</td>
                <td style="width:100px;vertical-align:middle">{{$artype->countart}}</td>
                <td style="width:80px">
                    <div style="margin-top: 8%">
                        <button type="submit" class="change btn btn-primary glyphicon glyphicon-pencil" onclick="showmodelold(this)" name="artid" value="{{$artype->ty_id}}" >修改</button>
                        <button style="float: right;margin-right: 10%" type="submit" class="delete btn btn-primary glyphicon glyphicon-trash" onclick="deletetypes({{$artype->ty_id}})">删除</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px;height: 187px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptymodel()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">请输入新标签名字</h4>
                </div>
                <div class="modal-body" >
                    <form method="post" action="addtypes" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <span>标签名字：</span>
                        <input id="lablename" maxlength="5px" name="newtype">
                        <div class="modal-footer" style="margin-top: 7%">
                            <button type="submit" class="btn btn-primary relpy">添加标签</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalold" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog"style="width: 510px">
            <div class="modal-content" style="width: 340px;height: 187px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="emptymodel()">&times;</button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">请输入修改的标签名字</h4>
                </div>
                <div class="modal-body" >
                    <form method="post" action="updatetype" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <span>新标签名字：</span>
                        <input id="lable" maxlength="5px" name="newtype">
                        <input id="updatetype" maxlength="12px" name="typeid" style="display: none">
                        <div class="modal-footer" style="margin-top: 7%">
                            <button type="submit" class="btn btn-primary relpy" onclick="">修改标签</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($type))
        <script>
            @if($judge==1)
            judgeuptype({{$type}});
            @else
            judgeaddtype({{$type}});
            @endif
        </script>
    @endif
    <script>
        relablenav();
    </script>

@endsection