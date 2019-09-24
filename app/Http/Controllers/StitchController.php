<?php

namespace App\Http\Controllers;

use App\Stitch;
use Illuminate\Http\Request;

class StitchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stitch::all();
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
        $stitchName = $request->input('stitchName');

        Stitch::create(['name' => $stitchName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stitch  $stitch
     * @return \Illuminate\Http\Response
     */
    public function show(Stitch $stitch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stitch  $stitch
     * @return \Illuminate\Http\Response
     */
    public function edit(Stitch $stitch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stitch  $stitch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stitch $stitch)
    {
        $stitchName = $request->input('stitchName');

        $stitch->name = $stitchName;
        $stitch->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stitch  $stitch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stitch $stitch)
    {
        $stitch->delete();
    }
}
