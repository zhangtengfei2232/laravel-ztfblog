<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Model\ImagesDatas;
use App\Model\AlbumDatas;
use App\Model\ArtypeDatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ReimagesController extends Controller
{
    //后台显示相册
     public function showalbum()
     {
         $album = AlbumDatas::sealbum();
         return view('Backviews.Realbum', ['album' => $album]);
     }
     //后台显示照片
     public function showreima(Request $request)
     {   $albumid=$request->albumid;
         $images=ImagesDatas::seimages($albumid);
         return view('Backviews.Reimages',['images'=>$images,'albumid'=>$albumid]);
     }
    //后台去请求照片
     public function seimage(Request $request)
     {
         $albumid=$request->alid;
         $count=$request->count;
         $images=ImagesDatas::seimage($albumid,$count);
         return json_encode($images);
     }
     //添加相册
     public function addalbum(Request $request)
     {
       $alname=$request->alname;
       $savepwd=$request->savepwd;
       $amswerpwd=$request->amswerpwd;
       $introce=$request->introce;
       $album=AlbumDatas::addalbum($alname,$savepwd,$amswerpwd,$introce);
       return json_encode($album);
     }
     //删除相册
     public function deletealbum(Request $request)
     {
          $albumid=$request->alid;
          $dealbum=AlbumDatas::delealbum($albumid);
          return json_encode($dealbum);
     }
     //添加密保
    public function addalques(Request $request)
    {
          $albumid=$request->albumid;
          $addques=$request->addques;
          $addamswer=$request->addamswer;
          $adalques=AlbumDatas::adddalques($albumid,$addques,$addamswer);
          return json_encode($adalques);
    }
    //搜索所要修改的相册的密保
    public function seques(Request $request)
    {
      $albumques=AlbumDatas::sealbumques($request->albumid);
      return json_encode($albumques);
    }
    //修改相册密保
    public function updateques(Request $request)
    {
        $albumid=$request->albumid;
        $updateques=$request->updateques;
        $updateamswer=$request->updateamswer;
        $album=AlbumDatas::updatealques($albumid,$updateques,$updateamswer);
        return json_encode($album);
    }
    //修改相册名字
    public function upalname(Request $request)
    {
        $albumid=$request->albumid;
        $alnewname=$request->alnewname;
        $album=AlbumDatas::upalname($albumid,$alnewname);
           return json_encode($album);
    }
    //修改相册介绍
    public function upintroce(Request $request)
    {
        $albumid=$request->albumid;
        $updacontent=$request->updacontent;
        $album=AlbumDatas::upalintroce($albumid,$updacontent);
      return json_encode($album);
    }
    //删除相册密保
    public function deleteque(Request $request)
    {
     $albumid=$request->alid;
     $delete=AlbumDatas::deleteques($albumid);
     return json_encode($delete);
    }
    //上传照片
    public function addiamges(Request $request)
    {
        $albumid=$request->albumid;
        $imgArr = $request->file("img");
        if(count($imgArr)==0){
            return json_encode(0);
        }else{
           $imgroad=$this->upfile($imgArr);
           $addimage=ImagesDatas::addiamges($imgroad,$albumid);
           return json_encode($addimage);
        }
    }
    //上传文件
    public function upfile($file){
         $imageroad=[];
        for($i=0;$i<count($file);$i++){
           if(!$file[$i] == null) {
// 文件是否上传成功
              if ($file[$i]->isValid()) {

////                原文件名
                $originalName=$file[$i]->getClientOriginalName();
                //                类型
//                $type=$file->getClientMimeType();
//                临时绝对路径
                //扩展名
//                $ext=$file->getClientOriginalExtension();
                $realPath=$file[$i]->getRealPath();//获取原始路径
                $originalName=time().'-'.$originalName;
//                文件名
                $bool=Storage::disk('image')->put($originalName, file_get_contents($realPath));

              }
           }
           array_push($imageroad,$originalName);
        }
        return  $imageroad;
    }
    //删除照片
    public function deletepic(Request $request)
    {
          $imgid=$request->depic;
          $imgroad=ImagesDatas::seimgroad($imgid);
          $imagesid=ImagesDatas::deleteimages($imgid);
          $this->deleteFile($imgroad);
          return json_encode($imagesid);
    }
    //    删除相册图片
    public function deleteFile($img)
    {
        for($i=0;$i<count($img);$i++){
          if($img[$i] != null){
            Storage::disk('image')->delete($img[$i]);
          }
      }
    }


}
