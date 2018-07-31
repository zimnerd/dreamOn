<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dream;
use Validator;

class DreamController extends Controller
{

    public $successStatus = 200;

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['user_id'] = $user = Auth::id();
        $input['important_facts']=json_encode(explode(",", $request->important_facts));
        $input['tags']=json_encode(explode(",", $request->tags));
        $dream = Dream::create($input);
        $dream['id'] = Dream::create($input)->id;

        return response()->json(['data' => $dream], $this->successStatus);
    }

    public function list()
    {
        $user = Auth::id();
        $dreams = Dream::where('user_id',$user)->orderBy('created_at', 'asc')->get();
        //$dreams = User::findOrFail($user)->dreams;
        return response()->json(['data' => $dreams], $this->successStatus);
    }

    public function edit($id)
    {
        $dream = Dream::findOrFail($id);
    }

    public function show($id)
    {
        $dream = Dream::findOrFail($id);
        $dream['id'] = $id;
        return response()->json(['data' => $dream], $this->successStatus);
    }

    public function update($id, Request $request)
    {
        $dream = Dream::findOrFail($id);
        $input = $request->all();
        $input['user_id'] = $user = Auth::id();
        $input['important_facts']=json_encode(explode(",", $request->important_facts));
        $input['tags']=json_encode(explode(",", $request->tags));
        $dream->fill($input)->save();
        return response()->json(['data' => $dream], $this->successStatus);
    }

}