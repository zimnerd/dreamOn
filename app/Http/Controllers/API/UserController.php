<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public $headers = array('Access-Control-Allow-Origin' => '*,http://localhost:8000,localhost:8000', 'Access-Control-Allow-Methods' => array('GET', 'POST', 'PATCH', 'PUT', 'DELETE', 'OPTIONS'), 'Access-Control-Allow-Headers' => 'Origin, Content-Type, Content-Range, Content-Disposition, Content-Description, X-Auth-Token');

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['data' => $data], $this->successStatus, $this->headers);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401, $this->headers);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401, ['Access-Control-Allow-Origin' => '*', 'Access-Control-Allow-Headers' => 'Origin, Content-Type, Content-Range, Content-Disposition, Content-Description, X-Auth-Token']);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus, $this->headers);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus,$this->headers );}

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}