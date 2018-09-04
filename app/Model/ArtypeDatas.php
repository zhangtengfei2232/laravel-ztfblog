<?php
namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class ArtypeDatas extends Model
{
    //添加新的文章类型
    public static function addtype($newtype)
    {
        if($newtype==null||strlen($newtype)>16){
            return 3;
        }
        //判断标签个数
        $count=DB::table('artype')->count();
        if($count>5){
            return 1;
        }else{
            //判断标签名字是否存在
            $artypename=DB::table('artype')->select('ty_id')->where('art_ty',$newtype)->get();
            if(count($artypename)>0){
                return 4;
            }
            $type=DB::table('artype')->insert(['art_ty'=>$newtype,'countart'=>0]);
        }
        if($type){
            return 2;
        }else{
            return 0;
        }
    }
    //查文章的所有类型,排除文章本身类型
    public static function seartype($tyid)
    {
        $upartype=DB::table('artype')->select('ty_id','art_ty')->where('ty_id','!=',$tyid)->get();
        return $upartype;
    }
    //查文章的所有类型
    public static function sealltype()
    {
        $alltype=DB::table('artype')->select('ty_id','art_ty')->get();
        return $alltype;
    }
    //文章页面,查所有文章的类型
    public  static function setypes()
    {
          $types=DB::table('artype')->select('ty_id','art_ty','countart')->get();
          return $types;
    }
    //删除文章类型
    public static function deletetype($typeid)
    {
        //先去查文章类型数目
        $coutype=DB::table('artype')->select('ty_id')->count();
        if($coutype==1){
            return 3;
        }
        $art=DB::table('artical')->where('art_type',$typeid)->count();
        if($art>0){
            return 2;
            }else{
            $judgs=DB::table('artype')->where('ty_id',$typeid)->delete();
        }
        if($judgs>0){
            return $judgs;
        }else{
            return 0;
        }
    }
    //修改文章类型
    public static function updatetype($typename,$typeid)
    {
        //判断标签名字是否存在
          $artypename=DB::table('artype')->select('ty_id')->where('art_ty',$typename)->get();
            if(count($artypename)>0){
                return 3;
            }
          if($typeid==null||$typename==null||strlen($typename)>16){
              return 2;
          }else{
              $type=DB::table('artype')->where('ty_id',$typeid)->update(['art_ty'=>$typename]);
              if($type>0){
                  return 1;
              }else{
                  return 0;
              }
          }
    }
    //更改该类型的文章数目
    public static function addartype($artid,$typeid,$oldtypeid=null)
    {
        if($artid==0){
            //删除文章
            $countart = DB::table('artype')->where('ty_id', $typeid)->select('countart')->get();
            DB::table('artype')->where('ty_id',$typeid)->update(['countart' => ($countart[0]->countart-1)]);
        }else{
            //添加文章
            if($artid == -1){
                $countart = DB::table('artype')->where('ty_id', $typeid)->select('countart')->get();
                DB::table('artype')->where('ty_id', $typeid)->update(['countart' => ($countart[0]->countart+1)]);
            }else{
                //修改文章，判断是否更改
                $artype = DB::table('artical')->where('art_id', $artid)->select('art_type')->get();
                if($artype[0]->art_type == $typeid){
                    return;
                }else{
                    //如果修改文章时候，更改增加文章类型+1
                    $countart = DB::table('artype')->where('ty_id', $typeid)->select('countart')->get();
                    DB::table('artype')->where('ty_id', $typeid)->update(['countart' => ($countart[0]->countart + 1)]);
                    //原来的-1
                    $oldcountart = DB::table('artype')->where('ty_id', $oldtypeid)->select('countart')->get();
                    DB::table('artype')->where('ty_id', $oldtypeid)->update(['countart' => ($oldcountart[0]->countart-1)]);
                }
            }
        }
    }
    //去查文章类型表的第一个类型
    public static function sefirstype()
    {
       $firstype=DB::table('artype')->select('ty_id')->first();
       return $firstype;
    }

}