<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ArticalDatas  extends Model
{
       //首页查热门文章
       public  static function sehotart()
       {
            $hotart=DB::table('artical')->select('art_id','art_title','art_type','created_at')
                ->orderby('art_revcout','DESC')
                ->limit(4)
                ->get();
            return $hotart;
       }
         //文章页面,根据类型查文章信息
        public static function setyartical($typeid,$artid)
        {
               if($artid==null){
                   $typeart=DB::table('artical')
                       ->join('images','artical.ima_id','=','images.ima_id')
                       ->select('art_id','art_type','images.ima_road','art_title','art_revcout','art_text','artical.created_at','art_top','art_stamp')
                       ->where('art_type',$typeid)
                       ->orderBy('artical.created_at','DESC')
                       ->paginate(2);
                   for($i=0;$i<count($typeart);$i++){
                         $typeart[$i]->art_text=strip_tags($typeart[$i]->art_text);
                         $typeart[$i]->art_text= str_replace('&nbsp;','',$typeart[$i]->art_text);
                         $typeart[$i]->art_text=strtr($typeart[$i]->art_text, array(' '=>''));
                         $typeart[$i]->art_text=mb_substr($typeart[$i]->art_text,0,6).'................';
                   }
               }else{
                   $typeart=DB::table('artical')
                       ->join('images','artical.ima_id','=','images.ima_id')
                       ->select('art_id','art_type','images.ima_road','art_title','art_revcout','art_text','artical.created_at','art_top','art_stamp')
                       ->where('art_type',$typeid)
                       ->where('art_id',$artid)
                       ->orderBy('artical.created_at','DESC')
                       ->get();
               }
               return $typeart;
        }

         //后台查所有文章的信息
         public static function seallartical()
         {
             $allartical=DB::table('artical')
                 ->join('artype','artical.art_type','=','artype.ty_id')
                 ->select('art_id','art_title','artype.art_ty','art_revcout','art_text','created_at','updated_at','art_top','art_stamp')
                 ->orderBy('artical.updated_at','DESC')
                 ->Paginate(2);
             for ($i = 0; $i < count($allartical); $i++) {
                 $allartical[$i]->art_text=strip_tags($allartical[$i]->art_text);
                 $allartical[$i]->art_text= str_replace('&nbsp;','',$allartical[$i]->art_text);
                 $allartical[$i]->art_text=strtr($allartical[$i]->art_text, array(' '=>''));
                 $allartical[$i]->art_text=mb_substr($allartical[$i]->art_text,0,6).'................';
             }
             return $allartical;
         }
         //根据题目模糊查询文章
         public static function seartitle($artitle)
         {
            $allartical=DB::table('artical')
                ->join('artype','artical.art_type','=','artype.ty_id')
                ->select('art_id','art_title','artype.art_ty','art_revcout','art_text','created_at','updated_at','art_top','art_stamp')
                ->where('art_title','like',"%".$artitle."%")
                ->orderBy('artical.created_at','DESC')
                ->Paginate(4);
            return  $allartical;
         }
         //删除文章
         public static function deleteart($artid)
         {
             //先去查文章的个数
             $countart=DB::table('artical')->select('art_id')->count();
             if($countart==1){
                 return 2;
             }
             //开启事务处理
             DB::beginTransaction();
             try {

                 $deart=DB::table('artical')->where('art_id',$artid)->delete();
                 if($deart>0){
                     DB::commit();
                     return 1;
                 }
             } catch (\Exception $e){
                 DB::rollBack();
                     return 0;
             }
         }
         //查所需修改的文章的信息
         public static function seupdateart($artid)
         {
            $artmation=DB::table('artical')
                ->join('images','artical.ima_id','=','images.ima_id')
                ->join('artype','artical.art_type','=','artype.ty_id')
                ->select('artical.art_id','art_title','artype.art_ty','ty_id','art_revcout','art_text','artical.created_at','art_top','art_stamp','images.ima_road','artical.ima_id')
                ->where('artical.art_id',$artid)
                ->get();
            return $artmation;
         }
         //根据文章ID去查文章信息
        public static function seartdetile($artid)
        {
            $art=DB::table('artical')->select('art_id','art_title','created_at')->where('art_id',$artid)->get();
            return $art;
        }
         //修改文章,往相册表添加新的图片
        public static function updateart($artid,$artitrle,$artypeid,$artcontent,$img,$judge,$original)
        {
            $time=date("Y-m-d H:i:s");
            if($judge==1){
                $seiamgid=DB::table('images')->insertGetId(['ima_road'=>$img,'ima_sta'=>1,'created_at'=>$time]);
                DB::table('artical')->where('art_id',$artid)->update(['art_title'=>$artitrle,'art_type'=>$artypeid,'art_text'=>$artcontent,'ima_id'=>$seiamgid,'updated_at'=>$time]);
                DB::table('images')->where('ima_road',$original)->delete();
            }elseif($judge==0){
                DB::table('artical')->where('art_id',$artid)->update(['art_title'=>$artitrle,'art_type'=>$artypeid,'art_text'=>$artcontent,'updated_at'=>$time]);
            }

        }
        //添加文章
        public static function addart($artitrle,$artcontent,$artypeid,$img)
        {
             $time=date("Y-m-d H:i:s");
             $imaid=DB::table('images')->insertGetId(['ima_road'=>$img,'ima_sta'=>1,'created_at'=>$time]);
             DB::table('artical')->insert(['art_title'=>$artitrle,'art_type'=>$artypeid,'art_text'=>$artcontent,'ima_id'=>$imaid,'created_at'=>$time,'updated_at'=>$time,'art_revcout'=>0,'art_top'=>0,'art_stamp'=>0]);
        }
        //增加文章的浏览量
        public static function increacount($artid)
        {
            $oldcount=DB::table('artical')->select('art_revcout')->where('art_id',$artid)->get();
            DB::table('artical')->where('art_id',$artid)->update(['art_revcout'=>($oldcount[0]->art_revcout+1)]);
        }
        //给文章点赞和差评
        public static function arttop($artid,$judge)
        {
            if($judge==1){
                $top=DB::table('artical')->select('art_top')->where('art_id',$artid)->get();
                $artical=DB::table('artical')->where('art_id',$artid)->update(['art_top'=>($top[0]->art_top+1)]);
                if($artical>0){
                    return 1;
                }else{
                    return 0;
                }
            }else if($judge=0){
                $stamp=DB::table('artical')->select('art_stamp')->where('art_id',$artid)->get();
                $artical=DB::table('artical')->where('art_id',$artid)->update(['art_stamp'=>($stamp[0]->art_stamp+1)]);
                 if($artical>0){
                     return 1;
                 }else{
                     return 0;
                 }
            }
        }
        //查文章的图片ID和图片路径
        public static function seartroad($artid)
        {
          $artimaroad=DB::table('artical')
              ->join('images','artical.ima_id','=','images.ima_id')
              ->where('art_id',$artid)
              ->select('images.ima_road','artical.ima_id','art_type')
              ->get();
          return $artimaroad;
          }
          //前台根据题目搜索文章
        public static function sealartitle($artitle)
        {
            $typeart=DB::table('artical')
                ->join('images','artical.ima_id','=','images.ima_id')
                ->select('art_id','art_type','images.ima_road','art_title','art_revcout','art_text','artical.created_at','art_top','art_stamp')
                ->where('art_title','like',"%".$artitle."%")
                ->orderBy('artical.created_at','DESC')
                ->get();
            for($i=0;$i<count($typeart);$i++){
                $typeart[$i]->art_text=strip_tags($typeart[$i]->art_text);
                $typeart[$i]->art_text= str_replace('&nbsp;','',$typeart[$i]->art_text);
                $typeart[$i]->art_text=strtr($typeart[$i]->art_text, array(' '=>''));
                $typeart[$i]->art_text=mb_substr($typeart[$i]->art_text,0,6).'................';
            }
            return $typeart;
        }
}