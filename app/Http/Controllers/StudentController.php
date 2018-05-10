<?php

namespace App\Http\Controllers;

use App\Student;
use function foo\func;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use function Sodium\increment;

class StudentController extends BaseController
{

    public function info($id) {
        return view('member');//" member info - ".$id;
    }
    public function test1() {
        // 最原始的 查询
//        $student = DB::select('select * from student');
//        dump($student);

        // 最原始的插入
//        $bool = DB::insert('insert into student(name, age) VALUES (?, ?)',['imooc',18]);
//        dump($bool);
        // 最原始的更新
//        $num = DB::update('update student set age = ? where name = ?', [19,'edgar']);
//        dump($num);

        // 选择
//        $student = DB::select('select * from student WHERE age > ?',[18]);
//        dump($student);

        // 选择
        $num = DB::delete('delete from student WHERE age > ?',[18]);
        dump($num); //返回行数 或0

    }

    public function query1( )
    {

        $bool = DB::table('student')->insert (
            ['name' => 'imooc',
              'age' => 18  ]
        );
        dump($bool); // 返回true

        $id = DB::table('student')->insertGetId (
            ['name' => 'imoob',
                'age' => 18  ]
        );
        dump($id); // 返回id

        $bool = DB::table('student')->insert(
            [
                ['name' => 'imood', 'age' => 18],
                ['name' => 'imooe', 'age' => 18]
            ]
        );
        dump($bool); // 返回true

    }

    // 更新指定内容 自增自减
    public function query2( )
    {
        $num = DB::table('student')
            ->where('id',4)
            ->update(['age' => 30]);
        dump($num); // 返回1  受影响的行数
         // 自增1
        $num = DB::table('student')->increment('age');
        dump($num); // 返回1  受影响的行数

        // 自增3
        $num = DB::table('student')->increment('age',3);
        dump($num); // 返回1  受影响的行数

        // 条件自增
        $num = DB::table('student')
            ->where('id',4)
            ->increment('age',3);
        dump($num);

        // 自增的同时修改数据
        $num = DB::table('student')
            ->where('id',5)
            ->increment('age',3,['name' => 'duo']);
        dump($num);


        // 自增1
        $num = DB::table('student')->decrement('age');
        dump($num); // 返回1  受影响的行数

        // 自增3
       $num = DB::table('student')->decrement('age',3);
       dump($num); // 返回1  受影响的行数

    }

    // 查询构造器删除数据
    public function query3( )
    {
        $num = DB::table('student')
            ->where('id',4)
            ->delete();
        dump($num); // 受影响的行数

          $num = DB::table('student')
            ->where('id','<', 4)
            ->delete();
            dump($num); // 受影响的行数

        // 删除整表数据 慎用
        $num = DB::table('student')
            ->truncate(); //不返回

        dump($num); // 受影响的行数


    }

    // 查询
    public function query4( )
    {


//        // get
//        $result = DB::table('student')->get();
//        dump($result); // 返回 array
//
//        // first
////        $single = DB::table('student')->first();
////        dump($single);
//
//        //
////        $last = DB::table('student')
////            ->orderBy('id','desc')
////            ->first();
////        dump($last);
//
//        // where
////        $where = DB::table('student')
////            ->where('id','<',4)
////            ->get();
////        dump($where);
//
//
////        $where2 = DB::table('student')
////            ->whereRaw('id > ? and age > ?' , [2,10])
////            ->get();
////        dump($where2);
//
//        // pluck
//
////        $where2 = DB::table('student')
////            ->whereRaw('id > ? and age > ?' , [2,10])
////            ->pluck('name');
////        dump($where2);
//
////        $result2 = DB::table('student')
////            ->pluck('name');
////        dump($result2);
//
//
//        // lists 不支持
////        $result3 = DB::table('student')
////            ->lists('name','id');
////        dump($result3);
//
//        // select 指定查找
////        $result4 = DB::table('student')
////            ->select('id','name','age')
////            ->get();
////        dump($result4);

        // chunk 分段 一定要用加 orderBy

        echo '<pre>';
        $result5 = DB::table('student')
            ->orderBy('id')
            ->chunk(2, function ($student) {
                dump($student);
                return true; // 返回false 就不继续了 或者添加自己的条件
            });

        dump($result5);

    }
    // 查询构造器中的 聚合函数
    public function query5( )
    {

        // count
        $result = DB::table('student')->count();
        dump($result); // 返回 number

        // max min
        $result = DB::table('student')->max('age');
        $result = DB::table('student')->min('age');
        dump($result); // 返回 number 最大值

        $avg = DB::table('student')->avg('age');
        $sum = DB::table('student')->sum('age');

        dump($avg); // 返回 number 最大值
        dump($sum); // 返回 number 最大值


    }

    // Eloguent ORM
    // 简介：简洁的 ActiveRecord实现，数据库操作
    // 1 建立student 模型

    public function orm1( )
    {
        // all 所有记录
//        $result = Student::all();
//        dump($result);
        // find
//        $result = Student::find(2);
//        dump($result); // 一个模型的对象
        // findOrFail 指定查找 或报错
//        $result = Student::findOrFail(12);
//        dump($result);

        // get

//        $result = Student::get();
//        dump($result);
//
//        $result2 = Student::where('id','<',3)
//            ->orderBy('age')
//            ->first();
//        dump($result2);

//        $result3 = Student::orderBy('id')
//            ->chunk(2, function ($student) {
//                dump($student);
//                return true; // 返回false 就不继续了 或者添加自己的条件
//            });
        // 聚合函数
        $result4 = Student::count();
        dump($result4); // 返回 number

    }
    public function orm2( )
    {
        // 使用模型 新增数据
//        $student = new Student();
//        dump($student);

//        $student->name = 'sean';
//        $student->age = 19;
//        $bool = $student->save(); // 保存，插入数据

//        $student = Student::find(4);
//        echo $student->create_at;

//        使用模型的Create方法新增数据
//        $student = Student::create(
//            ['name' => 'mooc',
//                'age' => 18]
//        );
//        dd($student);// 报错，允许批量插入

        // firstOrCreate()
        $student = Student::firstOrCreate([
            'name' => 'immooi',
        ]); // 如果没有，新增后返回实例
        dd($student);

        // firstOrNew() 如果有

        $student = Student::firstOrCreate([
            'name' => 'immooi',
        ]); // 如果没有，新增后返回实例
        $bool = $student->save(); //
        dd($student);


    }

    public function orm3() {
        // 通过模型 更新数据
        $student = Student::find(4);
        $student->name = 'ketty';
        $bool = $student->save();
        dump($bool);

        // 结合查询语句 批量更新
        $num = Student::where('id','>',4)
            ->update(
                ['age' => '55']
            );
        dump($num);
    }
    // orm 删除
    public function orm4() {
        // 通过模型 删除数据
        $student = Student::find(4);
        $bool = $student->delete();
        dump($bool); // true 则删除成功，否则报错

        // 通过主键删除
        $num = Student::destroy(3);
        $num = Student::destroy(2,3,4); // 删除多条数据
        $num = Student::destroy([2,3,4]);
        dump($num); // 影响的行数

        // 删除条件 数据
        $num = Student::where('id','>','1')
                ->delete();
        dump($num);

    }
    public function blade1() {
        $val = array(
            'name' => 'sjlkd;l',
            'val' => ['a','b'],
            'arr' => []
        );
        return view('student/section1',$val);
        // 在子试图中引用模板
    }

    public function url() {
        return 'url';
    }

    public function css() {
        return view('css');
    }



    /*

    在modal Student中

// 自动维护时间戳
    public $timestamps = false; // 关闭时间戳

    protected function getDateFormat() {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    } // 自定义时间格式化


    在model中
//允许批量赋值的字段
    protected $fillable = ['name','age'];

    //指定不允许批量赋值的字段
    protected $guarded = [];

    在controller

    使用模型的Create方法新增数据
    $student = Student::create(
        ['name' => 'mooc',
        'age' => 18]
    );
    dd($student);// 报错，允许批量插入

        // firstOrCreate()
        $student = Student::firstOrCreate([
            'name' => 'immooi',
        ]); // 如果没有，新增后返回实例
        dd($student);

        // firstOrNew() 如果有

        $student = Student::firstOrCreate([
            'name' => 'immooi',
        ]); // 如果没有，新增后返回实例
        $bool = $student->save(); //
        dd($student);

     */

    /*
     blade 模版引擎。
    1 简介 ：
    模板继承： yield，
    2 基础 include
    3 控制
    4 url
     */

}
