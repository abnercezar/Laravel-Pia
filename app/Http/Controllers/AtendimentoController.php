<?php

namespace App\Http\Controllers;

use App\Enums\AtendimentoType;
use App\Http\Requests\StoreAtendimentoRequest;
use App\Http\Requests\UpdateAtendimentoRequest;
use App\Http\Resources\AtendimentoResource;
use App\Http\Resources\DropdownResource;
use App\Models\Atendimento;
use App\Models\Irma;

class AtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atendimentos = AtendimentoResource::collection(Atendimento::all());
        return inertia('Atendimento', compact('atendimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $irmas = DropdownResource::collection(Irma::all());
        $atendimentoTipos = AtendimentoType::all();
        
        return inertia('AtendimentoNewEdit', compact('irmas', 'atendimentoTipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAtendimentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAtendimentoRequest $request)
    {
        Atendimento::create($request->validated());
        return redirect()->route('atendimentos.index')->with('message', 'Atendimento cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atendimento  $atendimento
     * @return \Illuminate\Http\Response
     */
    public function show(Atendimento $atendimento)
    {
        return inertia('AtendimentoNewEdit', compact('atendimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atendimento  $atendimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Atendimento $atendimento)
    {
        return inertia('AtendimentoNewEdit', compact('atendimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAtendimentoRequest  $request
     * @param  \App\Models\Atendimento  $atendimento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAtendimentoRequest $request, Atendimento $atendimento)
    {
        $atendimento->update($request->validates());
        return redirect()->route('atendimentos.index')->with('message', 'Atendimento atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atendimento  $atendimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atendimento $atendimento)
    {
        $atendimento->forceDelete();
        return redirect()->route('atendimentos.index')->with('message', 'Atendimento deletado com sucesso');
    }
}
