<?php
namespace App\Http\Controllers\Front;
use App\Model\AdminDates;
use App\Model\ArticalDatas;
use App\Model\SpeachDatas;
use App\Model\ImagesDatas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class MainController extends Controller
{
    //显示首页界面
    public  static  function mainpage(Request $request)
    {
         $informa=AdminDates::seadmin();
         $hotart=ArticalDatas::sehotart();
         $newspea=SpeachDatas::senewspa();
         $newimg=ImagesDatas::senewimg();
        if (session()->has('username')){
            $username=Session::get('username');
             return view('Frontviews/Mainpage',['informa'=>$informa,'hotart'=>$hotart,'newspea'=>$newspea,'newimg'=>$newimg,'username'=>$username]);
        }else{
             return view('Frontviews/Mainpage',['informa'=>$informa,'hotart'=>$hotart,'newspea'=>$newspea,'newimg'=>$newimg]);
        }
    }
}