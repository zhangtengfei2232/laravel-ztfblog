<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class VurcountDatas extends Model
{
      //去查用户是否已经点赞
      public static function selectvcount($artid,$userid)
      {
        $vcount=DB::table('vurcount')
            ->where('user_id',$userid)
            ->where('art_id',$artid)
            ->count();
        if($vcount>0){
            return false;
        }else{
            return true;
        }
      }
      //更新VURcount表
      public static function addcount($artid,$userid)
      {
         $vur=DB::table('vurcount')->insert(['user_id'=>$userid,'art_id'=>$artid]);
         if($vur){
             return 1;
         }else{
             return 0;
         }
      }
      //当文章删除之后，删除对应的关系
      public static function deletevt($artid)
      {
          $count=DB::table('vurcount')->where('art_id',$artid)->delete();
          if($count>0){
              return 1;
          }else{
              return 0;
          }
      }
}