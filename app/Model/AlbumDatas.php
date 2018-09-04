<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlbumDatas  extends Model
{
    //前后台显示相册
    public static function sealbum()
    {
        $album=DB::select('select al_id,al_name,al_ques,al_ans,album.created_at,al_introce from album');
        for($i=0;$i<count($album);$i++){
            $album[$i]->ima_road=null;
            $albumnewimg=DB::select('select ima_road from images WHERE al_id='.$album[$i]->al_id." ORDER BY created_at DESC LIMIT 1");
            if($albumnewimg==[]){
                continue;
            }
            $album[$i]->ima_road=$albumnewimg[0]->ima_road;
        }
        return $album;
    }
    //前台显示相册的问题
    public  static function seques($albumid)
    {
        $albumques=DB::table('album')->select('al_ques','al_ans')->where('al_id',$albumid)->get();
        return $albumques;
    }
    //前台查相册的答案
    public static function seans($albumid,$ques,$ans)
    {
        $alid=DB::table('album')
            ->where('al_id',$albumid)
            ->where('al_ans',$ans)
            ->where('al_ques',$ques)->first();
        if(count($alid)!=0){
            return 1;
        }else{
            return 0;
        }
    }
    //添加相册
    public static function addalbum($alname,$savepwd,$amswerpwd,$introce)
    {
        if($alname==null||$amswerpwd==null||$savepwd==null||$introce==null){
            return 0;
        }else if(strlen($alname)>20||strlen($savepwd)>20||strlen($amswerpwd)>30||strlen($introce)>60){
            return 0;
        }else{
            $album=DB::table('album')->insert(['al_name'=>$alname,'al_ques'=>$savepwd,'al_ans'=>$amswerpwd,'al_introce'=>$introce]);
            if($album){
                return 1;
            }else{
                return 2;
            }
        }
    }
    //删除相册
    public static function delealbum($albumid)
    {
        $count=DB::table('images')->where('al_id',$albumid)->count();
        if($count>0){
            return 2;
        }else{
            $counts=DB::table('album')->where('al_id',$albumid)->delete();
            if($counts>0){
                return 1;
            }else{
                return 0;
            }
        }
    }
    //添加相册密保
    public static function adddalques($albumid,$addques,$addamswer)
    {
      if($albumid==null||$addamswer==null||$addques==null){
          return 0;
      }
      if(strlen($addques)>20||strlen($addamswer)>30){
          return 0;
      }
        $addalques=DB::table('album')->where('al_id',$albumid)->update(['al_ques'=>$addques,'al_ans'=>$addamswer]);
         if($addalques>0){
             return 1;
         }else{
             return 2;
         }
    }
    //查所需修改相册的密保
    public static function sealbumques($albumid)
    {
      $albumques=DB::table('album')->select('al_id','al_ques','al_ans')->where('al_id',$albumid)->get();
      return $albumques;
    }
    //修改相册密保
    public static function updatealques($albumid,$updateques,$updateamswer)
    {
        if($albumid==null||$updateamswer==null||$updateques==null){
            return 0;
        }elseif(strlen($updateamswer)>30||strlen($updateques)>18){
            return 0;
        }else{
            $album=DB::table('album')->where('al_id',$albumid)->update(['al_ques'=>$updateques,'al_ans'=>$updateamswer]);
        }
        if($album>0){
            return 1;
        }else{
            return 2;
        }
    }
    //修改相册名字
    public static function upalname($albumid,$alnewname)
    {
       if($alnewname==null||strlen($alnewname)>18){
           return 0;
       }else{
           $album=DB::table('album')->where('al_id',$albumid)->update(['al_name'=>$alnewname]);
       }
       if($album>0){
           return 1;
       }else{
           return 2;
       }
    }
    //修改相册介绍
    public static function upalintroce($albumid,$updacontent)
    {
        if($updacontent==null||strlen($updacontent)>90){
            return 0;
        }else{
            $album=DB::table('album')->where('al_id',$albumid)->update(['al_introce'=>$updacontent]);
        }
        if($album>0){
            return 1;
        }else{
            return 2;
        }
    }
    //删除相册密保
    public static function deleteques($albumid)
    {
         $albumques=DB::table('album')->where('al_id',$albumid)->update(['al_ques'=>null,'al_ans'=>null]);
         if($albumques>0){
             return 1;
         }else{
             return 0;
         }
    }
}