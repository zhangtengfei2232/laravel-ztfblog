<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ImagesDatas extends Model
{
        //查最新的图片
        public static function senewimg()
        {
            $newimg=DB::select('select ima_road from images WHERE ima_sta=0 ORDER BY created_at DESC limit 5');
            return $newimg;
        }
        //前台显示相片
        public static function seimages($alid)
        {
            $images=DB::table('images')->select('ima_road','ima_id')->where('al_id',$alid)->orderBy('created_at')->limit(2)->get();
            return $images;
        }
        //前后台显示相片,每次显示2张
        public static function seimage($alid,$count)
        {
            $count=$count*2;
            $images=DB::select('select ima_road,ima_id from images WHERE al_id='.$alid.' ORDER BY created_at limit '.$count.',2');
            return $images;
        }
        //查要删除的照片的路径
        public static function seimgroad($imgid)
        {
             $imgroad=[];
             for($i=0;$i<count($imgid);$i++){
                 $imgids=DB::table('images')->where('ima_id',$imgid[$i])->select('ima_road')->get();
                 array_push($imgroad,$imgids[0]->ima_road);

             }
             return $imgroad;
        }
        //删除照片
        public static function deleteimages($images)
        {
            $judeg=0;
           for($i=0;$i<count($images);$i++){
               $judeg++;
               DB::table('images')->where('ima_id',$images[$i])->delete();
           }
           if($judeg==count($images)){
               return 1;
           }else{
               return 0;
           }
        }
        //删除文章照片
        public static function deleteartimg($imgid)
        {
            DB::table('images')
                ->where('ima_id',$imgid)
                ->delete();
        }
        //添加照片
         public static function addiamges($imgroad,$albumid)
         {
             for($i=0;$i<count($imgroad);$i++){
               $time=date("Y-m-d H:i:s");
               $addimage=DB::table('images')->insert(['ima_road'=>$imgroad[$i],'al_id'=>$albumid,'created_at'=>$time,'ima_sta'=>0]);
             }
             if($addimage){
                 return 1;
             }else{
                 return 0;
             }

         }
}