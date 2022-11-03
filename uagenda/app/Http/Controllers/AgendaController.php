<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $agendas = Agenda::orderBy('id','desc')->paginate(5);
        return view('agendas.index', compact('agendas'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('agendas.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
        ]);
        
        Agenda::create($request->post());

        return redirect()->route('agendas.index')->with('success','Agenda has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Agenda  $Agenda
    * @return \Illuminate\Http\Response
    */
    public function show(Agenda $Agenda)
    {
        return view('agendas.show',compact('Agenda'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Agenda  $Agenda
    * @return \Illuminate\Http\Response
    */
    public function edit(Agenda $Agenda)
    {
        return view('agendas.edit', compact('Agenda'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Agenda  $Agenda
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Agenda $Agenda)
    {
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
        ]);
        
        $Agenda->fill($request->post())->save();

        return redirect()->route('agendas.index')->with('success','Agenda Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Agenda  $Agenda
    * @return \Illuminate\Http\Response
    */
    public function destroy(Agenda $Agenda)
    {
        $Agenda->delete();
        return redirect()->route('agendas.index')->with('success','Agenda has been deleted successfully');
    }
}
