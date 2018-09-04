<?php
namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\SpeachDatas;
use App\Model\ArticalDatas;
use App\Model\ArtypeDatas;
use Illuminate\Support\Facades\Session;
class RespeachController extends Controller
{
     //显示评论管理界面
      public  function showrespea()
      {
          $speach = ArticalDatas::seallartical();
          return view('Backviews.Respeachs', ['speach' => $speach]);
      }
      //先去查这篇文章有没有评论
      public function sespeach(Request $request)
      {
             $speach=SpeachDatas::sespeach($request->artid);
             return json_encode($speach);
      }
      //显示评论详情
       public function showspeach(Request $request)
       {
            $artid=$request->artid;
            $art=ArticalDatas::seartdetile($artid);
            $speach=SpeachDatas::seartcomment($artid);
            return view('Backviews.Reshowspeach',['speach'=>$speach,'art'=>$art]);
       }
       //删除评论
       public function deletespeach(Request $request)
       {
            $speach=SpeachDatas::deletespeach($request->speachid);
            return json_encode($speach);
       }
       //删除一篇文章所有评论
       public function deallspeach(Request $request)
       {
           $speach=SpeachDatas::deallspeach($request->artid);
           return json_encode($speach);
       }
       //去查一条评论的父级个数,然后判断是否可以回复
       public function countspeach(Request $request)
       {
           if(Session()->has('adminid')){
               $count=0;
               $fatherid=$request->fatherid;
               $countspeach=SpeachDatas::countspeach($fatherid,$count);
               if($countspeach<=7){
                   $artid=$request->artid;
                   $coment=$request->coment;
                   $adminid=Session::get('adminid');
                   $countspeach=SpeachDatas::addreply($artid,$coment,$adminid,$fatherid);
                   return json_encode($countspeach);
               }
               return json_encode(2);
           }else{
               return json_encode(3);
           }

       }
}