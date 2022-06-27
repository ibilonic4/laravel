@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Home page</h1>
        <p class="lead">Home</p>
        <a href="{{ route('dashboard.index') }}" class="btn btn-info">View posts</a>
        
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection