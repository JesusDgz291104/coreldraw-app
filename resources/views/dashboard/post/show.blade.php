@extends('dashboard.layout')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{$post->posted}}</p>

    <p>{{$post->description}}</p>
    
    <div>{{$post->content}}</div>

@endsection
