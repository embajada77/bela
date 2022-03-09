<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::query()
            ->unless(auth()->user()->can('view-all',Persona::class), function ($q) {
                $q->where('id', 0);
            })
            ->get();

        return view('admin.personas.index')
            ->with([
                'title' => 'Personas',
                'personas' => $personas->sortBy('inverse_full_name'),
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
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        dd($persona->full_name);

        return $persona->document;

        dd(
            $persona,
            $persona->document->format('masked'),
            $persona->full_name,

            // $persona->document->typePregMatch(),
            // $persona->document->typePregReplace(),
            // $persona->document->fullDescription(),

            // $persona->person_name->abbrName(),
            // $persona->person_name->abbrSurname(),
            // $persona->person_name->firstName(),
            // $persona->person_name->firstSurname(),
            // $persona->person_name->fullName(),
            // $persona->person_name->minimalName(),
            // $persona->person_name->reduceName(),
            // $persona->person_name->inverseFullName(),
            // $persona->person_name->inverseMinimalName(),
            // $persona->person_name->inverseReduceName(),
            'gil'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
