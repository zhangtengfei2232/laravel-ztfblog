<!DOCTYPE html>
<style>
    .comentul li {
        list-style: none;
    }
    .retext{
        display: block;
        color: #555;
        font-size: 14px;
        resize: none;
        font-family: Microsoft YaHei;
    }
    .main{

        width: 70%;
        margin-right: 6%;
        margin-top: 4%;
    }
    .main-content{
        border: solid;
        margin-top: -4%;
        width: 100%;
    }
</style>
@extends('Backviews.Backlayout')
@section('maincontent')
    <div style="width: 440px;color:#fff;float:left;margin-left: 10%;" id="artid" rel="{{$art[0]->art_id}}">
    <span style="font-size: 50px">
        文章题目：
    </span>
    <span style="font-size: 30px">
        {{$art[0]->art_title}}
    </span>
    <div>
      <span style="font-size: 50px">
        创作时间：
    </span>
        <span style="font-size: 30px">
        {{date('Y-m-d',strtotime($art[0]->created_at))}}
    </span>
    </div>
</div>
<div>
    <div class="speach"style=" margin-top: 20%;height: auto;color: #fff" id="userscomment" rel="{{$art[0]->art_id}}">

    </div>
</div>
    <?php
    echo "<script>var data = ".json_encode($speach).";commentaddivs(data)</script>";
    ?>
    <script>
        respeachnav();
    </script>
@endsection
