<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Read;
use App\Dream;
use App\Like;
use Illuminate\Http\Request;

class ReadController extends Controller
{

    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        if (Read::where('user_id', '=', Auth::id())->where('dream_id', '=', $request->get('dream_id'))->exists()){
            // user found
            return response()->json(['error' => "Already Read"], 401);
        }
        else {
            Log::info('Creating A Read: ' . $request);
            $read = new Read;
            $read['user_id'] = $user = Auth::id();
            $read->user()->associate($request->user());
            $dream = Dream::find($request->get('dream_id'));
            $dream->reads()->save($read);
            return response()->json(['data' => $dream->reads()], $this->successStatus);
        }

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
     * @param  \App\Read  $read
     * @return \Illuminate\Http\Response
     */
    public function show(Read $read)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Read  $read
     * @return \Illuminate\Http\Response
     */
    public function edit(Read $read)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Read  $read
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Read $read)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Read  $read
     * @return \Illuminate\Http\Response
     */
    public function destroy(Read $read)
    {
        //
    }
}
