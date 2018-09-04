<!DOCTYPE html>
@extends('Backviews.Backlayout')
<script src="{{asset('js/backjs/reinformation.js')}}"></script>
<style>
    .main{
        width: calc(100% - 260px);
    }
</style>
@section('maincontent')
    @if (count($errors) > 0)
        <script>
            setTimeout(function () {
                $("#errors").fadeOut()
            },1999)
        </script>
        <div class="alert alert-danger" id="#errors" style="float: right;width: 35%;text-align: center;">
            <ul style="list-style: none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div style="margin-left: 29%;margin-top: 6%;color: #fff;">
        <span style="font-size: 45px">
            坏小哥个人信息
        </span>
    </div>
    <div class="information"style="width:571px;margin-left: 23%;margin-top: 6%;">
        <form method="post" action="upinmation" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" style="display: none">
            {{--{{ csrf_token() }}--}}
        <div class="form-group1" style="margin-left: 8px;height: 57px;">
            <label for="inputhome" class="col-sm-2 control-label" style="width: 47px;padding: 0;color: #fff;margin-left: 45px;"> 籍贯：</label>
            <div class="col-sm-10" style="margin-left: 0px;padding: 0;float: right;margin-top: 0px;">
                <input  class="form-control" style="width:300px;" name="home" maxlength="30px" id="inputhome"value="{{$information[0]->adm_adres}}">
            </div>
        </div>
        <div class="form-group2" style="margin-top: 24px;height: 57px; margin-left: 7px;">
            <label for="inputemail" class="col-sm-2 control-label" style="padding: 0;width: 58px;color: #fff;margin-left: 33px;"> Email：</label>
            <div class="col-sm-10" style="padding: 0;float: right;margin-top: 0px;">
                <input  type="email"name="adres" style="width:300px" class="form-control"maxlength="20px" id="inputemail" value="{{$information[0]->adm_emile}}">
            </div>
        </div>
        <div class="form-group5" style="margin-top: 24px;height: 57px; margin-left: 7px;">
            <label for="food" class="col-sm-2 control-label" style="margin-left:8%;margin-top: 5px;padding: 0;color: #fff;float: left;width: 95px;"> 姓名：</label>
            <div class="col-sm-10" style="padding: 0;margin-left: 94px;float: left;margin-top: -30px;">
                <input  class="form-control" style="width:300px;"maxlength="10px" name="name" id="food" value="{{$information[0]->adm_name}}" >
            </div>
        </div>
        <div class="form-group6" style="margin-top: 24px;height: 57px; margin-left: 7px;">
            <label for="book" class="col-sm-2 control-label" style="margin-left: 8%;margin-top: 5px;padding: 0;color: #fff;float: left;width: 95px;"> 爱好：</label>
            <div class="col-sm-10" style="padding: 0;margin-left: 94px;float: left;margin-top: -30px;">
                <input  class="form-control" name="hoby" style="width:300px"maxlength="30px" id="book" value="{{$information[0]->adm_hoby}}">
            </div>
        </div>
        <button class="mybutn btn btn-primary glyphicon glyphicon-pencil" style="margin-left: 80%" type="submit">
            修改信息
        </button>
        </form>
    </div>
    @if(isset($resetinfor))
    <script>
        showmesg({{$resetinfor}})
    </script>
    @endif
    <script>
        reinfornav();
    </script>
    @endsection