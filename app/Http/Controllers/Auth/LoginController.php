<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\AdminDates;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest')->except('seadmin');
    }
    public function login()
    {
        return view('auth/login');
    }
    //根据密码账号，查管理员
    public function seadmin(Request $request)
    {   $emile=$request->emile;
        $password=$request->password;
        $result=AdminDates::seadmer($emile,$password);
        return json_encode($request->emile);
    }
}
