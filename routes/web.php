<?php

Auth::routes();

Route::get('showreart', 'HomeController@showreart');

Route::get('/', function (){
    return view('welcome');
});
Route::get('/yu', function (){
    return 'ppppp';
});
//前台路由
Route ::group(['namespace'=>'Front'],function(){
    //主页
    Route ::get('mainpage','MainController@mainpage');
    //文章页面
    Route ::any('sealart','ArticalController@sealart');
    Route ::get('showart','ArticalController@showart');
    Route ::post('addspeach','ArticalController@addspeach');
    Route ::post('addreply','ArticalController@addreply');
    Route ::get('arttop','ArticalController@arttop');
    Route ::get('showdetilepage','ArticalController@showdetilepage');
    Route ::get('showspepage','SpeachsController@showspepage');
    //相册界面
    Route ::get('showimages','ImagesController@showimages');
    Route ::get('seques','ImagesController@seques');
    Route ::get('seans','ImagesController@seans');
    Route ::get('showimapage','ImagesController@showimapage');
    Route ::get('showimage','ImagesController@showimage');
});

//后台路由
Route::group(['namespace'=>'Back','middleware'=>['validate']],function(){
    //后台去前台的路由
    Route ::get('batomainpage','ReartController@batomainpage');
    //后台界面
    Route ::get('showreart','ReartController@showreart');
    Route ::get('showreima','ReimagesController@showreima');
    Route ::get('showrespea','RespeachController@showrespea');
    Route ::get('showreinma','ReinformationController@showreinma');
    //后台对文章的操作
    Route ::post('setitleart','ReartController@setitleart');
    Route ::get('deleteart','ReartController@deleteart');
    Route ::get('updatepage','ReartController@updatepage');
    Route ::any('addtype','ReartController@addtype');
    Route ::any('updateart','ReartController@updateart');
    Route ::post('addart','ReartController@addart');
    Route ::get('showaddart','ReartController@showaddart');
    //后台对文章类型的操作
    Route ::get('showlable','ReartlableController@showlable');
    Route ::get('deletetype','ReartlableController@deletetype');
    Route ::post('addtypes','ReartlableController@addtypes');
    Route ::post('updatetype','ReartlableController@updatetype');
    //后台对相册的操作
    Route ::get('showalbum','ReimagesController@showalbum');
    Route ::post('addalbum','ReimagesController@addalbum');
    Route ::get('deletealbum','ReimagesController@deletealbum');
    Route ::post('addalques','ReimagesController@addalques');
    Route ::get('seques','ReimagesController@seques');
    Route ::post('updateques','ReimagesController@updateques');
    Route ::post('upalname','ReimagesController@upalname');
    Route ::post('upintroce','ReimagesController@upintroce');
    Route ::get('showreima?{albumid}','ReimagesController@showreima');
    Route ::get('deletepic','ReimagesController@deletepic');
    Route ::get('seimage','ReimagesController@seimage');
    Route ::post('addimages','ReimagesController@addiamges');
    Route ::get('deleteque','ReimagesController@deleteque');
    //后台对文章评论的操作
    Route ::get('showrespea','RespeachController@showrespea');
    Route ::get('showspeach','RespeachController@showspeach');
    Route ::get('deletespeach','RespeachController@deletespeach');
    Route ::get('sespeach','RespeachController@sespeach');
    Route ::get('deallspeach','RespeachController@deallspeach');
    Route ::get('countspeach','RespeachController@countspeach');
    //后台对留言评论的操作
    Route ::get('showartpage','ReartspeachController@showartpage');
    //后台修改个人信息
    Route ::get('showreinma','ReinformationController@showreinma');
    Route ::post('upinmation','ReinformationController@upinmation');
});
//登录路由
Route ::group(['namespace'=>'Load'],function (){
    Route ::post('seadmin','LoginController@seadmin');
    Route ::get('maenter','LoginController@maenter');
    Route ::get('enterpage','LoginController@enterpage');
    Route ::post('updatemapwd','LoginController@updatemapwd');
    Route ::post('resermapwd','LoginController@resermapwd');
    Route ::post('addusers','LoginController@addusers');
    Route ::get('captcha/{tmp}','CodeController@captcha');
    Route ::post('enterback','LoginController@enterback');
    Route ::post('useenter','LoginController@useenter');
    Route ::get('emptyssession','LoginController@emptyssession');
    Route ::post('updatename','LoginController@updatename');
    Route ::post('upques','LoginController@upques');
});

