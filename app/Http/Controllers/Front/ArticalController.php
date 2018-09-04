<?php
namespace App\Http\Controllers\Front;
use App\Model\ArticalDatas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SpeachDatas;
use App\Model\ArtypeDatas;
use App\Model\VurcountDatas;
use Illuminate\Support\Facades\Session;
class ArticalController extends Controller
{
            //文章界面
        public function showart(Request $request)
        {
            $judge=0;
            if(isset($request->typeid)){
                $artypeid=$request->typeid;
            }else{
                $artypeid=ArtypeDatas::sefirstype();
                $artypeid=$artypeid->ty_id;
            }
                $types=ArtypeDatas::setypes();
                $typeartical=ArticalDatas::setyartical($artypeid,$artid=null);
            if(session()->has('username')){
                $username=Session::get('username');
                if(session()->has('intysa')){
                 $adminsta=Session::get('intysa');
                    return view('Frontviews/Artical',['typeartical'=>$typeartical,'types'=>$types,'artype'=>$artypeid,'username'=>$username,'adminsta'=>$adminsta,'judge'=>$judge]);
                }
                return view('Frontviews/Artical',['typeartical'=>$typeartical,'types'=>$types,'artype'=>$artypeid,'username'=>$username,'judge'=>$judge]);
            }
            return view('Frontviews/Artical',['typeartical'=>$typeartical,'types'=>$types,'artype'=>$artypeid,'judge'=>$judge]);
        }
        //文章详情页面
        public function showdetilepage(Request $request)
        {
            $artid=$request->artid;
            $artypeid=$request->typeid;
            $types=ArtypeDatas::setypes();
            $usercomment=SpeachDatas::seartcomment($artid);
            $time=time();
            if(session()->has(".'$artid'.")){
                if(($time-session(".'$artid'."))>20){//
                    session::put(".'$artid'.",$time);//绑定文章ID和时间，作为下次增加浏览量的依据
                    ArticalDatas::increacount($artid);//增加文章的浏览量
                }
            }else{
                session::put(".'$artid'.",$time);//绑定文章ID和时间，作为下次增加浏览量的依据
                ArticalDatas::increacount($artid);//增加文章的浏览量
            }
            $typeartical=ArticalDatas::setyartical($artypeid,$artid);
            if(session()->has('username')){
                $username=Session::get('username');
                if(session()->has('intysa')){
                    $adminsta=Session::get('intysa');
                    return view('Frontviews/Articaldetile',['types'=>$types,'typeartical'=>$typeartical,'artype'=>$artypeid,'usercomment'=>$usercomment,'username'=>$username,'adminsta'=>$adminsta]);
                }
                return view('Frontviews/Articaldetile',['types'=>$types,'typeartical'=>$typeartical,'artype'=>$artypeid,'usercomment'=>$usercomment,'username'=>$username]);
            }else{
                return view('Frontviews/Articaldetile',['types'=>$types,'typeartical'=>$typeartical,'artype'=>$artypeid,'usercomment'=>$usercomment]);
            }
        }
        //添加回复内容
        public function addreply(Request $request)
        {
            if(session()->has('userid')){
                $artid=$request->artid;
                $comment=$request->comment;
                $fatherid=$request->fatherid;
                $userid=session::get('userid');
                $count=SpeachDatas::countspeach($fatherid,0);
                if($count<=7){
                    $comment=SpeachDatas::addreply($artid,$comment,$userid,$fatherid);
                    return json_encode($comment);
                }else{
                    return json_encode(3);
                }
            }else{
                return json_encode(2);//判断用户是否登录
            }
        }
        //添加评论内容
        public function addspeach(Request $request)
        {
            if(session()->has('userid')){
                $artid=$request->artid;
                $comment=$request->comment;
                $userid=session::get('userid');
                $comment=SpeachDatas::addspeach($artid,$comment,$userid);
                return json_encode($comment);
            }else{
                return json_encode(2);
            }
        }
        //给文章点赞和差评
        public function arttop(Request $request)
        {
            if(session()->has('userid')){
                $artid=$request->artid;
                $userid=session::get('userid');
                $vcount=VurcountDatas::selectvcount($artid,$userid);
                if($vcount){
                    $judge=$request->judge;
                    $art=ArticalDatas::arttop($artid,$judge);
                    $vc=VurcountDatas::addcount($artid,$userid);
                    if($vc==1&&$art==1){
                        return json_encode($art);
                    }else{
                        return json_encode(0);
                    }
                }else{
                    return json_encode(3);
                }
            }else{
                return json_encode(2);
            }
        }
        //前台根据文章题目模糊查询文章
        public function sealart(Request $request)
        {
            $types=ArtypeDatas::setypes();
            $typeartical=ArticalDatas::sealartitle($request->artitle);
            if(session()->has('username')){
                $username=Session::get('username');
                if(session()->has('intysa')){
                    $adminsta=Session::get('intysa');
                    return view('Frontviews/Artical',['typeartical'=>$typeartical,'types'=>$types,'username'=>$username,'adminsta'=>$adminsta]);
                }
                return view('Frontviews/Artical',['typeartical'=>$typeartical,'types'=>$types,'username'=>$username]);
            }
            return view('Frontviews/Artical',['typeartical'=>$typeartical,'types'=>$types]);
        }
}