<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Comment;
use App\Dream;
use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public $successStatus = 200;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commentlike(Request $request)
    {
        //

        Log::info('Creating A like: '.$request);

        if (Like::where('user_id', '=', Auth::id())->where('comment_id', '=', $request->get('comment_id'))->exists()){
            // user found
            $comment = Comment::find($request->get('comment_id'));
            return response()->json(['error' => "Already liked", 'data'=>$comment->likes()->get()], 401);
        }
        else {

            $like = new Like;
            $like['user_id'] = $user = Auth::id();
            $comment = Comment::find($request->get('comment_id'));
            $comment->likes()->save($like);

            return response()->json(['data' => $comment->likes()->get()], $this->successStatus);
        }
    }

    public function dreamlike(Request $request)
    {
        //

        if (Like::where('user_id', '=', Auth::id())->where('dream_id', '=', $request->get('dream_id'))->exists()){
            // user found
            return response()->json(['error' => "Already liked"], 401);
        }
        else {
            Log::info('Creating A like: ' . $request);
            $like = new Like;
            $like['user_id'] = $user = Auth::id();
            $like->user()->associate($request->user());
            $dream = Dream::find($request->get('dream_id'));
            $dream->likes()->save($like);
            return response()->json(['data' => $dream->likes()], $this->successStatus);
        }
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();
        return response()->json(['message' => 'Like removed successfully'], $this->successStatus);
    }
}
