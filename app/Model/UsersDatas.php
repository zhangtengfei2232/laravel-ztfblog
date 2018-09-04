<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class UsersDatas extends Model
{
    //用户登录,去查用户输入的密码和账号是否正确，判断
    public static function sepassord($usercont,$userpwd)
    {
            $users=DB::table('users')
                ->where('email',$usercont)
                ->where('password',md5($userpwd))
                ->first();
            if(count($users)==0){
                return 0;
            }else{
                $user=DB::table('users')
                    ->select('inty_sa')
                    ->where('email',$usercont)
                    ->where('password',md5($userpwd))
                    ->get();
                if($user[0]->inty_sa==1){
                    return 2;
                }else{
                    return 1;
                }
            }
    }
    //用户注册
    public static function addusers($adname,$adusecount,$adusepwd,$adques)
    {
        $exitname=DB::table('users')->where('name',$adname)->get();
        if(count($exitname)>0){
            return 0;
        }
        $seues=DB::table('users')->where('email',$adusecount)->get();
        if(count($seues)>0){
            return false;
        }else{
            $users=DB::table('users')->insert(['name'=>$adname,'email'=>$adusecount,'password'=>md5($adusepwd),'se_key'=>$adques]);
            if($users){
                return $users;
            }else{
                return false;
            }
        }
    }
    //用户通过密保找回密码
    public static function researchpwd($upcont,$ques,$usepwd)
    {
        if($upcont==null||$ques==null||$usepwd==null){
            return ;
        }elseif (strlen($usepwd)>30) {
            return 0;
        }else{
            $seadm=DB::table('users')
                ->where('se_key',$ques)
                ->where('email',$upcont)
                ->where('password',md5($usepwd))
                ->get();
            if(count($seadm)>0){
                return 1;
            }
            $adm = DB::table('users')
                ->where('email', $upcont)
                ->where('se_key', $ques)
                ->update(['password' => md5($usepwd)]);
            if($adm>0){
                return 1;
            }else{
                return 2;
            }
        }
    }
    //用户修改密码
    public static function updatepwd($upusecount,$oldpwd,$newpwd)
    {
        if($upusecount==null||$oldpwd==null||$newpwd==null||strlen($newpwd)>30){
            return 0;
        }else{
            $seadm=DB::table('users')
                ->where('password',md5($newpwd))
                ->where('email',$upusecount)
                ->get();
            if(count($seadm)>0){
                return 2;
            }else{
                $adm=DB::table('users')
                    ->where('email',$upusecount)
                    ->where('password',md5($oldpwd))
                    ->update(['password'=>md5($newpwd)]);
                if($adm>0){
                    return 1;
                }else{
                    return 3;
                }
            }
        }
    }
    //根据用户账号查用户名字和ID
    public static function secontname($usercont)
    {
       $user=DB::table('users')->select('name','id','inty_sa')->where('email',$usercont)->get();
       return $user;
    }
    //根据用户ID去查用户昵称
    public static function seusename($admid)
    {
        $username=DB::table('users')->select('name')->where('id',$admid)->get();
        return $username;
    }
    //修改用户昵称
    public static function updatename($usname)
    {
        $userid=session::get('userid');
        $oldname=DB::table('users')->where('id',$userid)->select('name')->get();
        if($oldname[0]->name==$usname){
            return 0;
        }
        $exitname=DB::table('users')->where('name',$usname)->get();
        if(count($exitname)>0){
            return 2;
        }else{
            DB::table('users')
                ->where('id',$userid)
                ->update(['name'=>$usname]);
            session()->forget('username');
            session::put('username', $usname);
            return 1;
        }
    }
    //修改密保
    public static function upques($upquescont,$upquespwd,$newques)
    {
        if($upquespwd==null||$upquescont==null||$newques==null){
            return 2;
        }
        $seques=DB::table('users')
            ->where('email',$upquescont)
            ->where('password',md5($upquespwd))
            ->select('se_key')
            ->get();
        if(isset($seques[0]->se_key)){
            $ques=DB::table('users')
                ->where('email',$upquescont)
                ->where('password',md5($upquespwd))
                ->update(['se_key'=>$newques]);
            if($ques>0){
                return 1;
            }else{
                return 3;
            }
        }else{
            return 0;
        }

    }
}