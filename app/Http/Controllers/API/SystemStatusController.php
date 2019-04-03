<?php

namespace App\Http\Controllers\API;

use App\SystemStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class SystemStatusController extends Controller
{
    public $successStatus = 200;
    public function list()
    {
        //
        $status = SystemStatus::orderBy('status_name', 'asc')->get();
        //$dreams = User::findOrFail($user)->dreams;
        return response()->json(['data' => $status], $this->successStatus);
    }

    public function listbyarea($area)
    {
        //
        $status = SystemStatus::where('status_area',$area)->orderBy('status_name', 'asc')->get();
        //$dreams = User::findOrFail($user)->dreams;
        return response()->json(['data' => $status], $this->successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
