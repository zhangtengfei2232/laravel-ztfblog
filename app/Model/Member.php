<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model {
    protected $table='admin';  //指定表明
    protected $primaryKey='adm_id';  //指定adm_id
    public $timestamps=true;    //自动维护时间戳
    //转化为时间戳形式

     //允许批量赋值的字段
    protected $fillable=['adm_name','adm_psd','adm_cont'];

    //不允许批量赋值的字段
//    protected $guarded=[];

    protected function getDateFormat()
    {
        return time();
    }

    //从数据库中取出数据，时间字段不做处理
    protected function asDateTime($value)
    {
        return $value;
    }

    public static function getMember(){

          //查询数据
//            $admin=DB::select('select * from admin WHERE adm_id >= ?',[1]);
//       $admin=DB::select('select * from admin');
          //插入数据

//            $bool=DB::insert('insert into admin(adm_name,adm_sex,adm_psd,adm_adres,adm_cont,adm_emile) VALUE (?,?,?,?,?,?)',
//                ['坏小哥','男','1','兰桂坊','1','2232050718@qq.com']);
          //修改数据
//            $num=DB::update('update admin set adm_sex=? WHERE adm_id=?',['男',1]);
          //删除数据
//       $nums=DB::delete('delete from admin WHERE adm_id > ?',[1]);




          //查询构造器中插入数据
//         $bool=DB::table('admin')->insert(['adm_name'=>'d','adm_sex'=>'sd',
//             'adm_psd'=>'f','adm_cont'=>'frf','adm_emile'=>'dad','adm_adres'=>'fd']);
          //获取插入数据的ID
//       $id=DB::table('admin')->insertGetId(['adm_name'=>'df','adm_sex'=>'s',
//           'adm_psd'=>'fu','adm_cont'=>'fr','adm_emile'=>'d','adm_adres'=>'fd']);
          //利用数组插入数据
//       $bool=DB::table('admin')->insert([
//           ['adm_name'=>'dfgfh','adm_sex'=>'sg',
//           'adm_psd'=>'fuh','adm_cont'=>'frg','adm_emile'=>'dh','adm_adres'=>'fdg'],
//           ['adm_name'=>'dfff','adm_sex'=>'ssfs',
//               'adm_psd'=>'fufsd','adm_cont'=>'frfs','adm_emile'=>'dfs','adm_adres'=>'fdfd'],
//       ]);



          //使用查询构造器更新数据
          //修改数据
//           $num=DB::table('admin')
//           ->where('adm_id',5)
//           ->update(['adm_sex'=>'男']);
          //自增字段
//        $num=DB::table('admin')->increment('adm_id');
          //自增3
//       $num=DB::table('admin')->increment('adm_id',3);
          //自减
//       $num=DB::table('admin')->decrement('adm_id',3);
          //有条件的自减
//        $num=DB::table('admin')
//            ->where('adm_id',1)
//            ->decrement('adm_id',3);
          //自减的时候。改变其他字段的值
//       $num=DB::table('admin')
//           ->where('adm_id',1)
//           ->decrement('adm_id',3,['adm_sex'=>'dsad']);


          //使用查询构造器删除数据
//              $num=DB::table('admin')
//                  ->where('adm_id',7)
//                  ->delete();
//       $num=DB::table('admin')
//           ->where('adm_id','>=',5)
//           ->delete();
          //清空数据表
//       $num=DB::table('admin')->truncate();


          //使用查询构造器查询数据
          //使用get()，获取表中所有数据

//       $adm=DB::table('admin')->get();
          //获取结果集的第一条数据
//       $adm=DB::table('admin')
//           ->orderBy('adm_id','desc')
//           ->first();
          //where
//       $adm=DB::table('admin')
//           ->where('adm_id','>=',1)
//           ->get();
          //多条件查询
//        $adm=DB::table('admin')
//       ->whereRaw('adm_id >=? and adm_age > ?',[1,15])
//           ->get();

          //pluck返回结果集中指定的字段
//       $adm=DB::table('admin')
//           ->pluck('adm_name');


          //lists与pluck的区别为,lists可以指定字段作为下标
//       $adm=DB::table('admin')
//           ->pluck('adm_name','adm_sex');
          //select 查询指定的字段
//       $adm=DB::table('admin')
//           ->select('adm_sex','adm_name')
//           ->get();
          //chunk 分段获取数据
//       DB::table('admin')->orderBy('adm_id')->chunk(2,function ($results){
//          echo '<pre>';
//           var_dump($results) ;
//               if(你的条件){
//
//                    return false;
//              }

//     });
//        return $d;

          //聚合函数

//       $num=DB::table('admin')->max('adm_id');//某列最大的值
//       $min=DB::table('admin')->min('adm_id');//某列最小的值
//       $count=DB::table('admin')->count();//统计表中的数据个数
//       $avg=DB::table('admin')->avg('adm_id');//某一列的平均值
//         $sum=DB::table('admin')->sum('adm_id');//某一列的总和
//          var_dump($sum);

                 //all()
//          $admins=AdminDates::all();
                //find()
//          $admins=AdminDates::find(1);
                //findOrfail()
//          $admins=AdminDates::findOrFail(10);
                //get()
//          $admins=AdminDates::get();
                //加条件，取第一条
//            $admins=AdminDates::where('adm_id','>','1')
//            ->orderBy('adm_id','desc')
//            ->first();
//          $admins=AdminDates::chunk(2,function ($admin){
//                echo '<pre>';
//              var_dump($admin) ;
//          });
          //
          //聚合函数
//               $num=AdminDates::count();
//                 $max=AdminDates::where('adm_id','>',2)->max('adm_id');

          //使用模型新增数据
//          $admin= new AdminDates();
//          $admin->adm_sex='das';
//          $admin->adm_name='dasdf';
//          $admin->adm_psd='dasa';
//          $admin->adm_cont='dasffgfg';
//          $admin->save();
//            $admin=AdminDates::find(5);
//            echo $admin->created_at;
//            echo date('Y-m-d H:i:s',$admin->created_at);
        //create新增数据
//        $admin= AdminDates::create([
//            'adm_name'=>'fedfhj','adm_psd'=>'fsfts','adm_cont'=>'afre']);
//        return $admin;
        //firstOrCreate()以属性查找，有就查出来，没有就新增
//                  $admin=AdminDates::firstOrCreate(
//                      ['adm_name'=>'坏小哥']);
        //firstOrNew
//        $admin=AdminDates::firstOrNew([
//            'adm_name'=>'fedfhj','adm_psd'=>'fsfts','adm_cont'=>'afre'
//        ]);
//        $bool=$admin->save();
//                  return $admin;
        //通过模型修改数据
//        $admin=AdminDates::find(1);
//        $admin->adm_name='坏小哥';
//        $bool=$admin->save();
          //批量更新
//          $num=AdminDates::where('adm_id','>','8')->update([
//            'adm_sex'=>'男'
//
//        ]);
        //通过模型删除数据
//        $admin=AdminDates::find(12);
//        $bool=$admin->delete();
        //通过主键删除数据
//        $num=AdminDates::destroy(5);
//        $num=AdminDates::destroy(5,6);//删除多条数据
//        $num=AdminDates::destroy([5,6]);
//        $num=AdminDates::where('adm_id','>','3')->delete();
//        return $num;
      }

}