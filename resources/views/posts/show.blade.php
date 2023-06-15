@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>View Post</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                @if($post->image)
                    <img src="{{ $post->image }}" alt="Post Image" width="100">
                @endif
            </div>
        </div>

        <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">My Posts</a>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">All Posts</a>
    </div>
@endsection
