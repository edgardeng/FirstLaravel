<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','ArticleController@index');

// 注册路由,在routes.php中增加：
Route::get('article/create','ArticleController@create'); // 需要放在上面，否则先匹配article/id
Route::post('article/store','ArticleController@store'); //提交表单
Route::get('article/{id}','ArticleController@show');


Route::any('user/photo','UserController@photo');      // 上传图片
Route::any('upload', 'UserController@testUpload');
// api test
Route::get('useruploadtest','UserController@testFileupload');      // 上传图片

Route::post('user/create','UserController@create');     // post
//Route::get('user/{id}','UserController@info');          // get

// param

//
//Route::get('foo',function(){
//    return "Hello Laravel[GET]!";
//});
//
//
//Route::post('boo',function(){
//    return "Hello boo [GET]!";
//});
//
//// 多请求
//Route::match(['get','post'],'both',function (){
//    return 'hello both';
//});
//
//Route::any('multi',function(){
//    return "Hello multi [GET]!";
//});
//
//Route::any('test','StudentController@orm4');
//
//Route::any('blade','StudentController@blade1');
//
//Route::any('cssTest','StudentController@css');
//
//Route::any('url',['as'=>'url','uses'=>'StudentController@url']);

//路由参数
//Route::get('user/{id}',function($id){
//    return "Hello Laravel[GET]!".$id;
//});

// 路由别名


// 路由群组
//Route::group(['prefix' => 'user'],function (){
//
//    Route::any('multi',function(){
//        return "Hello user multi [GET]!";
//    });
//});

// 路由中输出视图


//Route::get('view', function () {
//    return view('welcome');
//});


// 关联控制器

//Route::get('member/info', "MemberController@info");

//Route::get('member/info', ['uses' => "MemberController@info"]);
//别名


//Route::get('member/info', [
//    'uses' => "MemberController@info",
//    'as' => 'member'
//]);


//Route::get('member/{id}', ['uses' => "MemberController@info"])
//->where('id','[0-9]+');






