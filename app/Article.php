<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
        'title',
        'introduction',
        'content',
        'published_at'
    ];

    protected $dates = ['published_at'];


    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d',$date);
    }

    public function setPasswordAttribute($passowrd)
    {
        $this->attributes['password'] = 'a'; //； Hash::make($passowrd);
        //仅仅是举例
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }



}
