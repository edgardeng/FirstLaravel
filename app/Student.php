<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // 指定表名
    protected $table = 'student';

    // 指定ID
    protected $primaryKey = 'id';

    //允许批量赋值的字段
    protected $fillable = ['name','age'];

    //指定不允许批量赋值的字段
    protected $guarded = [];

    // 自动维护时间戳
    public $timestamps = false; // 关闭时间戳

    protected function getDateFormat() {
        return time();
    }

    protected function asDateTime($value)
    {
        return $value;
    }


}
