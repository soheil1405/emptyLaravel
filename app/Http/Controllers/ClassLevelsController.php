<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreclassLevelsRequest;
use App\Http\Requests\UpdateclassLevelsRequest;
use App\Models\classLevels;

class ClassLevelsController extends Controller
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
     * @param  \App\Http\Requests\StoreclassLevelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreclassLevelsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\classLevels  $classLevels
     * @return \Illuminate\Http\Response
     */
    public function show(classLevels $classLevels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classLevels  $classLevels
     * @return \Illuminate\Http\Response
     */
    public function edit(classLevels $classLevels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclassLevelsRequest  $request
     * @param  \App\Models\classLevels  $classLevels
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateclassLevelsRequest $request, classLevels $classLevels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classLevels  $classLevels
     * @return \Illuminate\Http\Response
     */
    public function destroy(classLevels $classLevels)
    {
        //
    }
}
