<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\SystemStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dream;
use Validator;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
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
    public function create(Request $request)
    {
        //

        Log::info('Creating comment: '.$request);

        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'dream_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $comment = new Comment;
        $comment->body = $request->get('body');
        $comment['user_id'] = $user = Auth::id();
        $comment->user()->associate($request->user());
        $comment['system_status'] = SystemStatus::where('status_name', 'dream_public')->pluck('id')->first();
        $dream = Dream::find($request->get('dream_id'));
        $dream->comments()->save($comment);

        return response()->json(['data' => $comment], $this->successStatus);

    }

    public function createReply(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $reply['system_status'] = SystemStatus::where('status_name', 'comment_active')->pluck('id')->first();
        $dream = Dream::find($request->get('dream_id'));

        $dream->comments()->save($reply);

        return response()->json(['data' => $reply], $this->successStatus);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully'], $this->successStatus);
    }
}
