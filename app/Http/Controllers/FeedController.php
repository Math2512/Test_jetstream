<?php

namespace App\Http\Controllers;

use App\Models\post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeedController extends Controller
{
    public function index()
    {
        $posts = post::withCount('likes')->with(['user'])->with([
            'likes' => function($query){
                $query->where('user_id', auth()->user()->id);
            }
        ])->orderBy('created_at', 'DESC')->get();
        
        //dd($posts);
        return Inertia::render('Feed', [
            'posts'=>$posts
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:100'],
            'user' => ['exists:users,id']
        ]);

        $path = $request->file('path')->store('img', 's3');
        return $path;
        //post::create([
        //    'title'=>$request->input('title'),
        //    'path'=>$request->file('path')->store('img', 'public'),
        //    'user_id'=>auth()->user()->id
        //]);

        return Redirect::route('feed.index');
    }

    public function like(post $post)
    {
        auth()->user()->likes()->attach($post->id);
        return Redirect::route('feed.index');
    }

    public function dislike(post $post)
    {
        auth()->user()->likes()->detach($post->id);
        return Redirect::route('feed.index');
    }
}
