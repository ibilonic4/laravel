@extends('layouts.app-master')
<?php use App\Models\Post; ?>
@section('content')
    <div class="bg-light p-5 rounded">
       
        <p class="lead">If you are here it means that you're authenticated</p>
<?php $posts = Post::all(); ?>
        @foreach ($posts as $key => $post)
            
        <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a> <br>

       
        @endforeach 


     
    </div>
@endsection