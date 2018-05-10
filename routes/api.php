<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// 接管路由
$api = app('Dingo\Api\Routing\Router');

// 配置api版本和路由
$api->version('v1', ['namespace' => 'App\Api\Controllers'], function ($api) {
    $api->post('login', 'LoginController@login');
    $api->post('login2', 'LoginController@login2');
    $api->post('register', 'RegisterController@register');
    $api->get('user', 'UserController@index');
        $api->get('user/{id}', 'UserController@show');
//    $api->group(['middleware' => 'api.auth'], function ($api) {
//        $api->get('user', 'UserController@index');
//        $api->get('user/{id}', 'UserController@show');
//    });
});

