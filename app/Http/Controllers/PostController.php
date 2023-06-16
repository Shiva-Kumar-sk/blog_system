<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $imageUrl = asset('storage/images/' . basename($imagePath));
        } else {
            $imageUrl = null;
        }

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imageUrl,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    { 
        return view('posts.show', compact('post'));
    }

    public function edit( string $id)
    {
        $post = Post::find($id);

        if(!$post) {
            return redirect()->route('posts.index')->with('error', 'Product Not Found .');
        }
        
        if($post->user_id !== auth()->user()->id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to do this action.');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if($post->user_id !== auth()->user()->id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to do this action.');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if($post->user_id !== auth()->user()->id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to do this action.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
