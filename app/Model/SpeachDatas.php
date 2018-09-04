<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SpeachDatas extends Model
{
    //查最新的游客留言
    public static function senewspa()
    {
          $newspea= DB::table('speach')
              ->join('users','users.id','=','speach.users_id')
              ->join('artical','spe_artid','=','artical.art_id')
              ->join('artype','artype.ty_id','=','artical.art_type')
              ->select('spe_text','users.name','artype.art_ty','speach.created_at','spe_artid','artical.art_type','artical.art_title')
              ->orderby('speach.created_at','DESC')
              ->limit(4)
              ->get();
        for($i=0;$i<count($newspea);$i++){
            $newspea[$i]->spe_text=mb_substr($newspea[$i]->spe_text,0,10).'..........';
        }
          return $newspea;
    }
    //前后台查询游客评论文章的内容
    public static function seartcomment($artid,$p_id=0)
    {
         $rec=[];
         $usercomment=DB::select('select spe_id,spe_text,users.name,users_id,speach.created_at from speach,users WHERE  spe_artid='.$artid. ' AND father_id ='.$p_id.' AND speach.users_id=users.id ORDER BY created_at DESC ');
         if(count($usercomment)==0){
             return null;
         }
         for($i=0;$i<count($usercomment);$i++)
         {
             $res=["id"=>$usercomment[$i]->spe_id,
                   "name"=>$usercomment[$i]->name,
                   "comment"=>$usercomment[$i]->spe_text,
                   "comdate"=>date('Y-m-d',strtotime($usercomment[$i]->created_at)),
                   "father"=>$p_id,
                   "userid"=>$usercomment[$i]->users_id,
                   "child"=>SpeachDatas::seartcomment($artid,$usercomment[$i]->spe_id)//递归查询
             ];
             array_push($rec,$res);
         }
         return $rec;
    }
    //查,看是否有评论
    public static function sespeach($artid)
    {
      $rest=DB::table('speach')->where('spe_artid',$artid)->count();
      if($rest>0){
          return 1;
      }else{
          return 0;
      }
    }
    //删除文章评论
    public static function deletespeach($speid)
    {
        $spe=0;
        $speachs=DB::table('speach')->select('spe_id')->where('father_id',$speid)->get();
        if(count($speachs)==0){
          $spe=DB::table('speach')->where('spe_id',$speid)->delete();
            return ;
        }
        for($i=0;$i<count($speachs);$i++){
            self::deletespeach($speachs[$i]->spe_id);
        }
        $spe=DB::table('speach')->where('spe_id',$speid)->delete();
        if($spe>0){
            return 1;
        }else{
            return 0;
        }
    }
    //删除一篇文章的所有评论
    public static function deallspeach($artid)
    {
        $count=DB::table('speach')->where('spe_artid',$artid)->delete();
        if($count>0){
            return 1;
        }else{
            return 0;
        }
    }
    //去查一条评论的父级个数
    public static function countspeach($fatherid,$count)
    {
        $count++;
        $speach=DB::table('speach')->select('father_id')->where('spe_id',$fatherid)->get();
        if(count($speach)==0){
            return $count;
        }
        return self::countspeach($speach[0]->father_id,$count);
    }
    //添加评论
    public static function addspeach($artid,$comment,$userid)
    {
        if(strlen($comment)>91){
            return json_encode(3);
        }
        //获取当前系统时间
        $time=date("Y-m-d H:i:s");
        $comment=DB::table('speach')->insert(['spe_text'=>$comment,'users_id'=>$userid,'father_id'=>0,'spe_artid'=>$artid,'created_at'=>$time]);
        if($comment){
            return 1;
        }else{
            return 0;
        }
    }
    //添加回复
    public static function addreply($artid,$comment,$userid,$fatherid)
    {
        if(strlen($comment)>91){
            return json_encode(4);
        }
        //获取当前系统时间
        $time=date("Y-m-d H:i:s");
        $comment=DB::table('speach')->insert(['spe_text'=>$comment,'users_id'=>$userid,'father_id'=>$fatherid,'spe_artid'=>$artid,'created_at'=>$time]);
        if($comment){
            return 1;
        }else{
            return 0;
        }
    }
}