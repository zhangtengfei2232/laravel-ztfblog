<?php
namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use App\Model\ArtypeDatas;
use Illuminate\Http\Request;
class ReartlableController extends Controller
{
        //显示文章类型界面
        public function showlable()
        {
                $artypes = ArtypeDatas::setypes();
                return view('Backviews.Reartlable',['artypes' => $artypes]);
        }
        //删除文章类型
        public function deletetype(Request $request)
            {
                $type=ArtypeDatas::deletetype($request->typeid);
                return json_encode($type);
        }
        //添加文章类型
        public function addtypes(Request $request)
        {
                $judge = 2;
                $type = ArtypeDatas::addtype($request->newtype);
                $artypes = ArtypeDatas::setypes();
                return view('Backviews.Reartlable',['type' => $type, 'artypes' => $artypes, 'judge' => $judge]);
        }
        //修改文章标签
        public function updatetype(Request $request)
        {
                $judge=1;
                $types=ArtypeDatas::updatetype($request->newtype,$request->typeid);
                $artypes=ArtypeDatas::setypes();
                return view('Backviews.Reartlable',['type'=>$types,'artypes'=>$artypes,'judge'=>$judge]);
        }
}