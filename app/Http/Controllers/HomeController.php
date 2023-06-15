<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = $request->input('user');
        $query = Post::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($user) {
            $query->where('user_id', $user);
        }

        $posts = $query->orderBy('id', 'desc')->get();
        $post_count = $query->count();
        $users = User::select('id','name')->get();
        return view('home', compact('posts','users','post_count'));
    }
}
