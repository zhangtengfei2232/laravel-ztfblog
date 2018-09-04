<?php
namespace App\Http\Controllers\Front;

use App\Member;
use App\Http\ControllerS\Controller;
class MemberController extends Controller {
    public function info($id){
           return Member::getMember();
//        return 'member-info-id:'.$id;
//        return route('memberinfo');
//        return view('member/info',[
//            'name'=>'ztf',
//            'age'=>18
//        ]);
    }

}