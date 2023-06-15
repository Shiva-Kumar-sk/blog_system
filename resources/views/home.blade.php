@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Posts ({{ $post_count }})</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('home') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                        <select name="user" class="form-control ml-2">
                            <option value="">All Authors</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-12 mb-4">
                <a href="{{ route('posts.show', $post->id) }}" class="nav-link"> 
                    <div class="card">
                        @if($post->image)
                            <img src="{{ $post->image }}" class="card-img-top" alt="Post Image">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">{{ $post->title }}</h4>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
