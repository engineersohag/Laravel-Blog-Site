<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function comments_store(StoreCommentRequest $request, Post $post)
    {
         Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
        ]);

        return back();
    }



}
