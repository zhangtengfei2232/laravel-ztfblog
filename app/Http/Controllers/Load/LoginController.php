<?php
namespace App\Http\Controllers\Load;
use App\Http\Controllers\Controller;
use App\Model\UsersDatas;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Session;
class LoginController  extends Controller
{
    //管理员进后台登录界面
    public function maenter()
    {
        return view('Loadviews.Maload');
    }
    //管理员进后台
    public function enterback(Request $request)
    {
        if(session()->has('inty_sa')){
            return json_encode(2);
        }
        $validator = Validator::make($request->all(), [
            'account'=>'required|email',
            'password'=>'required|max:30',
        ],[
            'required' => ':attribute 为必填项',
            'max' => ':attribute 太长啦！',
            'email'=>':attribute 格式必须为邮箱格式'
        ],[
            'account'=>'账号',
            'password'=>'密码',
        ]);
        if ($validator->fails()) {
            return json_encode('你输入的账号或密码不合法');
        }
        $code=$request->code;
        $ssoncode=strtoupper(Session::get('code'));
        if(strtoupper($code)!=$ssoncode){
            return json_encode('你输入的验证码有误');
        }
         $account=$request->account;
         $password=$request->password;
         $adm=UsersDatas::sepassord($account,$password);
         if($adm==2){
                 $adminid=UsersDatas::secontname($account);
                 Session::put('inty_sa',1);//后台区分管理员身份，做保护
                 Session::put('intysa',1);//前台区分管理员和用户
                 Session::put('adminid',$adminid[0]->id);//把管理员ID存入session，当管理员评论文章时候取出来
                 Session::put('userid',$adminid[0]->id);//把管理员ID存入session，当用户评论文章时候取出来
                 Session::put('username',$adminid[0]->name);//把管理员昵称存进Session
                 return json_encode(1);
         }else{
             return json_encode('你输入的账号或密码不合法');
         }
    }
    //用户登录界面
    public function enterpage()
    {
       return view('Loadviews.Login');
    }
    //用户注册
    public function addusers(Request $request)
    {
        $adname=$request->adname;
        $adusecount=$request->adusecount;
        $adusepwd=$request->adusepwd;
        $adques=$request->adques;
        $readusepwd=$request->readusepwd;
        $this->validate($request,[
            'adname'=>'required|max:30',
            'adusecount'=>'required|email',
            'adusepwd'=>'required|max:30',
            'adques'=>'required|max:30',
            'readusepwd'=>'required|max:30'
        ],[
            'required' => ':attribute 必填项',
            'max' => ':attribute 太长啦！',
            'email'=>':attribute 必须为邮箱'
        ],[
                'adname'=>'昵称',
                'adusecount'=>'账号',
                'adusepwd'=>'密码',
                'name'=>'姓名',
                'adques'=>'密保',
                'readusepwd'=>'确认密码'
            ]
        );
        if($adusepwd!=$readusepwd){
            return redirect()->back()->withErrors('两次密码不一样');
        }
        if(preg_match("/ /",$adusepwd)){
            return redirect()->back()->withErrors('你输的密码有空格');    //不管空格在首尾还是中间，一个还是多个，只要有空格，就能查出来
        }
        $user=UsersDatas::addusers($adname,$adusecount,$adusepwd,$adques);
        if($user){
            return redirect()->back()->with('success',"添加成功");
        }else if($user==0){
            return redirect()->back()->withErrors(["你输入的昵称已经存在!"])->withInput();
        }else{
            return redirect()->back()->withErrors(["你输入的账号已经存在!"])->withInput();
        }
    }
    //用户登录
    public function useenter(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'account'=>'required|email',
        'password'=>'required|max:30',
    ],[
        'required' => ':attribute 为必填项',
        'max' => ':attribute 太长啦！',
        'email'=>':attribute 格式必须为邮箱格式'
    ],[
        'account'=>'账号',
        'password'=>'密码',
    ]);
        if ($validator->fails()) {
            return json_encode('你输入的账号或密码不合法');
        }
        $code=$request->code;
        $ssoncode=strtoupper(Session::get('code'));
        if(strtoupper($code)!=$ssoncode){
            return json_encode('你输入的验证码有误');
        }
        $account=$request->account;
        $password=$request->password;
        $user=UsersDatas::sepassord($account,$password);
         if($user==1||$user==2){
                $username=UsersDatas::secontname($account);//根据用户账号，去查用户ID和名字
                Session::put('userid',$username[0]->id);//把用户ID存入session，当用户评论文章时候取出来
                Session::put('username',$username[0]->name);
                if($username[0]->inty_sa==1){
                    Session::put('intysa',$username[0]->inty_sa);
                }
                return json_encode(1);
         }else{
               return json_encode('你输入的账号或密码有误');
        }
    }
    //管理员和用户修改密码
    public function updatemapwd(Request $request)
    {
        $upusecount=$request->upusecount;
        $oldpwd=$request->oldpwd;
        $newpwd=$request->newpwd;
        $adm=UsersDatas::updatepwd($upusecount,$oldpwd,$newpwd);
        return json_encode($adm);
    }
    //用户和管理员找回密码
    public function resermapwd(Request $request)
    {
        $upcont=$request->upcont;
        $ques=$request->ques;
        $usepwd=$request->usepwd;
        $adm=UsersDatas::researchpwd($upcont,$ques,$usepwd);
        return json_encode($adm);
    }
    //修改昵称
    public function updatename(Request $request)
    {
       $usname=$request->usname;
       $name=UsersDatas::updatename($usname);
       return json_encode($name);
    }
    //修改密保
    public function upques(Request $request)
    {
        $upquescont=$request->upquescont;
        $upquespwd=$request->upquespwd;
        $newques=$request->newques;
        $newques=UsersDatas::upques($upquescont,$upquespwd,$newques);
        return json_encode($newques);
    }
    //清空session中存储的用户信息
    public function emptyssession(Request $request)
    {
        if(isset($request->judge)){
            session()->forget('inty_sa');
            session()->forget('adminid');
            return  redirect()->action('Load\LoginController@maenter');
        }else{
            session()->forget('username');
            session()->forget('userid');
            session()->forget('intysa');
            return redirect()->back();
        }
    }
}