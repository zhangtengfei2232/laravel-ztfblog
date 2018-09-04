<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\ImagesDatas;
use Illuminate\Http\Request;
use App\Model\AlbumDatas;
use Illuminate\Support\Facades\Session;
class ImagesController  extends Controller
{
        //前台显示相册
     public function showimapage()
     {
          $album=AlbumDatas::sealbum();
          if(session()->has('username')){
              $username=Session::get('username');
              if(session()->has('intysa')){
                  $adminsta=Session::get('intysa');
                  return view('Frontviews/Images',['album'=>$album,'username'=>$username,'adminsta'=>$adminsta]);
              }
            return view('Frontviews/Images',['album'=>$album,'username'=>$username]);
          }else{
              return view('Frontviews/Images',['album'=>$album]);
          }
     }
        //前台去查相册的密保问题
     public function seques(Request $request)
     {
           $albumques=AlbumDatas::seques($request->albumid);
           return json_encode($albumques);
     }
       //前台去查相册的答案
     public function seans(Request $request)
     {
         $albumid=$request->albumid;
         $ques=$request->ques;
         $ans=$request->ans;
         $albumans=AlbumDatas::seans($albumid,$ques,$ans);
         return json_encode($albumans);
     }
        //前台显示每一个相册的相片
     public function showimages(Request $request)
     {
          $albumid=$request->albumid;
          $images=ImagesDatas::seimages($albumid);
          if(session()->has('username')){
              $username=Session::get('username');
              if(session()->has('intysa')){
                  $adminsta=Session::get('intysa');
                  return view('Frontviews.showimages',['images'=>$images,'albumid'=>$albumid,'username'=>$username,'adminsta'=>$adminsta]);
              }
              return view('Frontviews.showimages',['images'=>$images,'albumid'=>$albumid,'username'=>$username]);
          }else{
              return view('Frontviews.showimages',['images'=>$images,'albumid'=>$albumid]);
          }
     }
    public function showimage(Request $request)
    {
        $albumid=$request->alid;
        $count=$request->count;
        $images=ImagesDatas::seimage($albumid,$count);
        return json_encode($images);
    }

}