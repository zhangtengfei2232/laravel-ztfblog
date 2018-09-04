<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminDates extends Model
{
     protected $table='admin';  //指定表明
     protected $primaryKey='adm_id';  //指定adm_id
    //查管理员信息
     public static function seadmin(){
         $seladmininma=DB::select('select adm_adres,adm_emile,adm_name,adm_hoby from admin WHERE adm_id=1');
       return $seladmininma;
     }
    //修改管理员信息
    public static function updateinfor($home,$adres,$name,$hoby)
    {
        $reset=DB::table('admin')->where('adm_id',1)->update(['adm_adres'=>$home,'adm_emile'=>$adres,'adm_name'=>$name,'adm_hoby'=>$hoby]);
        if($reset>0){
            return 1;
        }else{
            return 0;
        }
    }
//     //根据密码和账号去查管理员
//    public static function seadmer($emile,$password)
//    {
//        $admin=DB::table('admin')->select('adm_id')
//            ->where('adm_cont',$emile)
//            ->where('adm_psd',md5($password))
//            ->first();
//        if(count($admin)==0){
//            return 0;
//        }else{
//            return 1;
//        }
//    }

//    //管理员,修改密码
//    public static function updatemapwd($upusecount,$oldpwd,$newpwd)
//    {
//        if($upusecount==null||$oldpwd==null||$newpwd==null){
//            return 0;
//        }else if(strlen($newpwd)>30){
//            return 0;
//        }else{
//            $seadm=DB::table('admin')
//                ->where('adm_psd',md5($newpwd))
//                ->where('adm_cont',$upusecount)
//                ->get();
//            if(count($seadm)>0){
//                return 2;
//            }else{
//                $adm=DB::table('admin')
//                    ->where('adm_cont',$upusecount)
//                    ->where('adm_psd',md5($oldpwd))
//                    ->update(['adm_psd'=>md5($newpwd)]);
//                if($adm>0){
//                    return 1;
//                }else{
//                    return 3;
//                }
//            }
//        }
//    }
//    //管理员，通过密保找回密码
//    public static function resermapwd($upcont,$ques,$usepwd)
//    {
//        if ($upcont == null || $ques == null || $usepwd == null) {
//            return 0;
//        } else if (strlen($usepwd) > 30) {
//            return 0;
//        } else {
//            $adm = DB::table('admin')
//                ->where('adm_cont', $upcont)
//                ->where('adm_key', $ques)
//                ->update(['amd_psd' => md5($usepwd)]);
//            if($adm>0){
//                return 1;
//            }else{
//                return 0;
//            }
//        }
//    }

}