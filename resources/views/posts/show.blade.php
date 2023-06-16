@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>View Post</h2>

        <div class="card">
            <div class="card">
                @if($post->image)
                    <img src="{{ $post->image }}" class="card-img-top" alt="Post Image">
                @endif
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
            </div>


        </div>

        <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">My Posts</a>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">All Posts</a>
    </div>
@endsection
