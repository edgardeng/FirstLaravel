@extends('layouts')

{{-- 从业 --}}
@section('header')
  @parent
  {{--继承 模板中的模版--}}
    edgardeng headr
@stop

@section('sidebar')
    @if($name == 'sean')
      I'm sean
    @elseif($name == 'abc')
        I'm abc
    @else
        Who I am
    @endif
{{-- unless 相当于 if的取反--}}

    @unless( $name == 'sean')
      I'm xiao
    @endunless

    @for($i=0;$i<3;$i++)
        <p> 循环 </p>
    @endfor

    @foreach($val as $item)
        <p> {{$item}}</p>
    @endforeach

    @forelse($arr as $item)
        <p> {{$item}}</p>
    @empty
        {{-- 有数据 则遍历,否则 --}}
        <p> null</p>
    @endforelse

    {{-- url --}}
    <a href="{{url('url')}}"> url </a>
    <br/>
    <a href="{{action('StudentController@url')}}"> action </a>
    <br/> 别名
    <a href="{{route('url')}}"> router </a>



@stop

@section('content')
    edgar content
    {{--模板中的变量输出--}}
    <p>{{ $name }}</p>
    {{--模板中 php代码--}}
    <p>{{ time() }}</p>
    <p>{{ date('Y-m-d',time()) }}</p>
    <p>{{in_array($name,$val) ? 'true': 'false'}}</p>

    <p>{{ isset($name) ? $name : 'default' }}</p>
    <p>{{ $name or 'default' }} </p>

    {{--原样输出--}}
    <p>@{{ $name }}</p>
    {{--模板注释  html的注释在网页源码中看得到--}}
    {{-- 引用子视图  include --}}


    @include('common',['error' => '出错了'])


@stop

