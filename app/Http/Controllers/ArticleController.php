<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;

class ArticleController extends Controller
{
    public function user($id) {
        $result = Article::find($id)->user;
        return $result->toArray();
    }
    public function index()
    {

        $articles = Article::latest()->get(); // 倒叙
        // $articles = Article::all();
        return view('articles.index',compact('articles'));
        // return $articles;
    }

    public function show($id)
    {

//        $article = Article::find($id);
        $article = Article::findOrFail($id);

//        if(is_null($article)){
//            abort(404);
//        }

//        return $article;
        return view('articles.show',compact('article'));
//        return $id;
    }

    public function create()
    {
        return view('articles.create');

    }

    public function store(Requests\StoreArticleRequest $request) {
        $result = $request->all();
        //下面增加两行，顺便看看Request::get的使用
        $result['introduction'] = mb_substr($request->get('content'),0,10);
//        $result['published_at'] = Carbon::now();
        Article::create($result);
        return redirect('/');
    }



}
