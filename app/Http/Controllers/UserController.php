<?php

namespace App\Http\Controllers;

use App\User;
use App\Phone;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use function Sodium\increment;

class UserController extends BaseController
{

    public function phone($id)
    {
        $result = Phone::find(1)->user;
        return $result->toArray();
    }

    public function number($id)
    {
        $result = Phone::where('number', $id)->first()->user;
        return $result->toArray();
    }

    public function article($id)
    {
        // $articles = User::find($id)->article;
        $article = User::find($id)->article()->where('title', 'aa')->first();
        return $article->toArray();
    }

    public function roles()
    {
        // $roles = User::find(1)->roles;
//        $roles = User::find(1)->roles()->orderBy('name')->get();
//        return $roles->toArray();
        $user = User::find(1);

        foreach ($user->roles as $role) {
            dump($role->pivot);
//            echo $role->pivot->created_at;
        }
    }


    public function info($id, Request $request)
    {

        $info = array(
            'id' => $id,
            'name' => 'edgardeng',
            'email' => 'edgardeng@qq.com',
            'url' => 'http://github.com/edgardeng'
        );

//        // get方法
//        echo $request->get('id');
//        // get方法
//        echo $request->query('id');
//        // get方法
//        echo $request->query->get('id');
//        // 有post会覆盖get improve by amu(题主)
//        echo $request->id;
//        // 有post会覆盖get
//        echo $request->input('id');


        // 参数
        $name = $request->get('name');
        $email = $request->get('email');
        if ($name) {
            $info['name'] = $name;
        }
        if ($email) {
            $info['email'] = $email;
        }
        $result = json_encode($info);
        return $result;
    }

    public function create(Request $request)
    {
        $info = array(
            'id' => 1
        );

        $method = $request->method();
        $info['request'] = $method;

        // 参数

        $name = $request->input('name');
        $email = $request->input('email');
        $url = $request->input('url');

        if ($name) {
            $info['name'] = $name;
        }
        if ($email) {
            $info['email'] = $email;
        }
        if ($url) {
            $info['url'] = $url;
        }
        $result = json_encode($info);
        return $result;
    }
}
