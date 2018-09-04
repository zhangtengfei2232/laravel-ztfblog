<?php
namespace App\Http\Controllers\Load;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;
class CodeController extends Controller
{
      //生成验证码
      public function captcha()
      {
        $builder=new CaptchaBuilder();
        $builder->build(150,35);
        $phrase=$builder->getPhrase();
        //把东西存入SESSION中
          Session::flash('code',$phrase);//存储验证码
          ob_clean();//清除缓存
          return response($builder->output())->header('Content-type','image/jpeg');
      }
}