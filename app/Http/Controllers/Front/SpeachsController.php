<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\SpeachDatas;
use Illuminate\Support\Facades\Session;
class SpeachsController  extends Controller
{
     public function showspepage()
     {
         $speach=1;
         if (session()->has('username')){
             $username=Session::get('username');
             return view('Frontviews.Speachs',['username'=>$username,'speach'=>$speach]);
         }else{
             return view('Frontviews.Speachs',['speach'=>$speach]);
         }
     }


}