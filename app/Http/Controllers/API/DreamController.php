<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Dream;

class DreamController extends Controller
{
    //
    public $successStatus = 200;
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'important_facts' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['user_id'] = $user =  Auth::id();
        $dream = Dream::create($input);
        $success['name'] = $dream->heading;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function list()
    {
        $dreams = Dream::orderBy('created_at', 'asc')->get();
        return response()->json(['data' => $dreams],  $this-> successStatus);

    }

}