<?php

namespace App\Http\Controllers;

use App\Symbol;
use Illuminate\Http\Request;

class SymbolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Symbol::all();
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
        $symbolName = $request->input('symbolName');

        Symbol::create(['name' => $symbolName]);

        return Symbol::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function show(Symbol $symbol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function edit(Symbol $symbol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symbol $symbol)
    {
        $symbolName = $request->input('symbolName');

        $symbol->name = $symbolName;
        $symbol->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symbol  $symbol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symbol $symbol)
    {
        $symbol->delete();
    }
}
