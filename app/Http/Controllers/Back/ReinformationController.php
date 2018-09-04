<?php
namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use App\Model\AdminDates;
use App\Http\Controllers\Controller;
class ReinformationController extends Controller
{
       //显示修改个人信息界面
      public  function showreinma()
      {
          $information = AdminDates::seadmin();
          return view('Backviews.Reinformation', ['information' => $information]);
      }
      //修改个人信息
      public function upinmation(Request $request)
      {
          if($request->isMethod('POST')){
              $this->validate($request,[
                      'home'=>'required|max:30',
                      'adres'=>'required|email',
                      'name'=>'required|max:10',
                      'hoby'=>'required|max:30'
                  ],[
                      'required' => ':attribute 为必填项',
                      'max' => ':attribute 太长啦！',
                      'email'=>':attribute 格式不对'
                  ],[
                      'home'=>'地址',
                      'adres'=>'邮箱',
                      'name'=>'姓名',
                      'hoby'=>'爱好'
                  ]
              );
              $resetinfor=AdminDates::updateinfor($request->home,$request->adres,$request->name,$request->hoby);
              $information=AdminDates::seadmin();
              return view('Backviews.Reinformation',['information'=>$information,'resetinfor'=>$resetinfor]);
          }
      }
}