<?php

namespace App\Http\Controllers\API;

use App\DreamCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dream;
use Validator;

class DreamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;
    public function list()
    {
        //
        $categories = DreamCategory::orderBy('category_name', 'asc')->get();
        //$dreams = User::findOrFail($user)->dreams;
        return response()->json(['data' => $categories], $this->successStatus);
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
     * @param  \App\DreamCategory  $dreamCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DreamCategory $dreamCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DreamCategory  $dreamCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DreamCategory $dreamCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DreamCategory  $dreamCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DreamCategory $dreamCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DreamCategory  $dreamCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DreamCategory $dreamCategory)
    {
        //
    }
}
