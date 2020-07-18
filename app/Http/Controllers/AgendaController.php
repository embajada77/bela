<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::query()
            // ->unless(auth()->user()->isAn('admin'), function ($q) {
            //     $q->where('centro_id', auth()->user()->centro_id);
            // })
            ->get();

        return view('admin.agendas.index')
            ->with([
                'title' => 'Agendas',
                'agendas' => $agendas,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',$agenda);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',$agenda);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        $this->authorize('view',$agenda);

        return view('admin.agendas.show')
            ->with([
                'title' => 'Agenda',
                'agenda' => $agenda,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        $this->authorize('update',$agenda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $this->authorize('update',$agenda);
    }

    # Podría usar los FormRequest para poner el authorize ahí :: mucho mas prolijo.
    // public function update(UpdateAgendaRequest $request, Agenda $agenda)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $this->authorize('delete',$agenda);
    }
}
