
@extends('app')
@section('content')
@foreach($articles as $article)
    <h1><a href="/FirstLaravel/public/article/{{ $article->id }}">{{ $article->title }}</a></h1>
    <h1><a href="{{ url('article',$article->id) }}">{{ $article->title }}</a></h1>

    <h1>{{ $article->title }}</h1>
    <p>{{ $article->introduction }}</p>
    <hr>
@endforeach
@endsection