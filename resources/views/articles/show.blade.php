
@extends('app')
@section('content')
        <h1>{{ $article->title }}</h1>
        <p>{{ $article->introduction }}</p>
        <hr>
@endsection