<?php

namespace App\Http\Controllers\Geo;

use App\Calle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'result' => 'OK', 
            'response' => Calle::orderBy('nombre')->get()
        ]);
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
     * @param  \App\Calle  $calle
     * @return \Illuminate\Http\Response
     */
    public function show(Calle $calle)
    {
        return response()->json([
            'result' => 'OK', 
            'response' => $calle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calle  $calle
     * @return \Illuminate\Http\Response
     */
    public function edit(Calle $calle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calle  $calle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calle $calle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calle  $calle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calle $calle)
    {
        //
    }
}
