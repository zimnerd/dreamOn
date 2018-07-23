<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dream;
use Illuminate\Support\Facades\Auth;
use Validator;
class DreamController extends Controller
{
    //
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'description' => 'required',
            'password' => 'required',
            'tags' => 'required',
            'important_facts' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $dream = Dream::create($input);
        $success['name'] = $dream->heading;
        return response()->json(['success' => $success], $this->successStatus);
    }
    public function list(){
        return response()->json(['success' => "hi"]);

    }

}