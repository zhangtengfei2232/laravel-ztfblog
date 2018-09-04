<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Model\ArticalDatas;
use App\Model\ImagesDatas;
use App\Model\SpeachDatas;
use Illuminate\Http\Request;
use App\Model\ArtypeDatas;
use App\Model\VurcountDatas;
use App\Model\UsersDatas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
class ReartController extends Controller
{
    //后台进前台
     public function batomainpage()
     {
         if(!session()->has('username')){
             $admid = session::get('adminid');
             $adminname = UsersDatas::seusename($admid);
             Session::put('userid', $admid);//把管理员ID存入session，当用户评论文章时候取出来
             Session::put('username', $adminname[0]->name);//把管理员昵称存进Session
             Session::put('intysa', 1);//前台区分管理员和用户
         }
         return redirect()->action('Front\MainController@mainpage');
     }
    //后台显示所有文章信息
     public function showreart()
     {
         $allartical=ArticalDatas::seallartical();
         return view('Backviews/Reartical',['allartical'=>$allartical]);
     }
    //后台根据题目，模糊查询
     public function setitleart(Request $request)
     {
        $allartical=ArticalDatas::seartitle($request->artitle);
        return view('Backviews/Reartical',['allartical'=>$allartical]);
     }
    //删除文章
     public function deleteart(Request $request)
     {
         $artid=$request->artid;
         $artimgroad=ArticalDatas::seartroad($artid);
         $deart=ArticalDatas::deleteart($artid);
         if($deart==2){
             return  json_encode($deart);
         }
         ImagesDatas::deleteartimg($artimgroad[0]->ima_id);//删除文章封面
         SpeachDatas::deallspeach($artid);  //删除该文章的所有评论
         VurcountDatas::deletevt($artid);   //删除该文章和游客的对应关系
         ArtypeDatas::addartype(0,$artimgroad[0]->art_type);
         $this->deleteFile($artimgroad[0]->ima_road);
         return  json_encode($deart);
     }
    //查所需修改的文章的信息
     public function updatepage(Request $request)
     {
         $artmation=ArticalDatas::seupdateart($request->artid);
         $artype=ArtypeDatas::seartype($artmation[0]->ty_id);
         return view('Backviews.Renewartical',['artmation'=>$artmation,'types'=>$artype]);
     }
     //显示添加文章的页面
     public function showaddart()
     {
        $alltype=ArtypeDatas::sealltype();
        $firstype=ArtypeDatas::sefirstype();
        return view('Backviews.Renewartical',['types'=>$alltype,'firstype'=>$firstype]);
     }
    //添加文章
     public function addart(Request $request)
     {
         //控制器验证
         $this->validate($request,[
             'artitle' => 'required|min:2|max:22',
             'artcontent' => 'required|min:2',
             'artimg'=>'required|image'
         ], [
             'required' => ':attribute 为必填项',
             'min' => ':attribute 长度最小为两个字符',
             'max' => ':attribute 太长啦！',
             'image'=>':attribute 格式不合法'
         ], [
             'artitle' => '标题',
             'artcontent' => '文章内容',
             'artimg'=>'文章封面图片'
         ]);
         $artypeid = $request->artnewype;//获取文章类型
         ArtypeDatas::addartype(-1,$artypeid);//该文章类型数目+1
         $artitrle = $request->artitle;//文章标题
         $artcontent = $request->artcontent;//文章内容
         $file=$request->file('artimg');//获取用户选择的文件信息
         $img=$this->upfile($file);//上传图片
         ArticalDatas::addart($artitrle,$artcontent,$artypeid,$img);
         return redirect()->action('Back\ReartController@showreart');
     }
    //修改文章
     public function updateart(Request $request)
     {
          $judge=0;
          $img=null;
         if($request->method('POST')){
             $this->validate($request,[
                 'artitle' => 'required|min:2|max:22',
                 'artcontent' => 'required|min:2'
             ], [
                 'required' => ':attribute 为必填项',
                 'min' => ':attribute 长度最小为两个字符',
                 'max' => ':attribute 太长啦！'
             ], [
                 'artitle' => '标题',
                 'artcontent' => '文章内容',
             ]);
             $original=$request->get('isimg');//原来文章封面图片路径
             $artid=$request->artid;//获取文章ID
             if ($request->hasFile('artimg')){  //进入if语句，表明用户选择了图片
                 //用户更改图片控制器验证
                 $this->validate($request,[
                     'artimg' => 'required|image'
                 ], [
                     'image' => ':attribute 格式不合法'
                 ], [
                     'artimg' => '文章封面图片'
                 ]);
                 $judge=1;
                 $file=$request->file('artimg');//获取用户选择的文件信息
                 $img=$this->upfile($file);//上传图片
                 $this->deleteFile($original);//删除图片
                }
                 $oldtypeid=$request->oldartyid;
                 $artypeid = $request->artnewype;//获取文章类型
                 //做出判断，看该文章类型是否改变，如果改变，就去给该类型的文章数目+1
                 ArtypeDatas::addartype($artid,$artypeid,$oldtypeid);
                 $artitrle = $request->artitle;//文章新标题
                 $artcontent = $request->artcontent;//文章新内容
                 //更新文章内容
                 ArticalDatas::updateart($artid,$artitrle,$artypeid,$artcontent,$img,$judge,$original);  //修改文章
             }
                 return redirect()->action('Back\ReartController@showreart');
         }
    //添加新的文章类型
    public function addtype(Request $request)
     {
         $addtypes = ArtypeDatas::addtype($request->newtype);
         $firstype=ArtypeDatas::sefirstype();
         if(isset($request->artid)){
             $artmation = ArticalDatas::seupdateart($request->artid);
             $artype = ArtypeDatas::seartype($artmation[0]->ty_id);
             return view('Backviews.Renewartical', ['artmation' => $artmation, 'types' => $artype, 'addtypes' => $addtypes,'firstype'=>$firstype]);
         }else{
             $artype=ArtypeDatas::sealltype();
             return view('Backviews.Renewartical', ['types' => $artype, 'addtypes' => $addtypes,'firstype'=>$firstype]);
         }



     }
    //上传文件
    public function upfile($file){
            if(!$file == null) {
// 文件是否上传成功
            if ($file->isValid()) {
////                原文件名
                $originalName=$file->getClientOriginalName();
                //                类型
//                $type=$file->getClientMimeType();
//                临时绝对路径
          //扩展名
//                $ext=$file->getClientOriginalExtension();
                $realPath=$file->getRealPath();//获取原始路径
                $originalName=time().'-'.$originalName;
//                文件名
                $bool=Storage::disk('artimg')->put($originalName, file_get_contents($realPath));
                return  $originalName;
            }
        }
    }
    //    删除文件
    public function deleteFile($img)
    {   if($img != null){
            Storage::disk('artimg')->delete($img);
        }
    }
}