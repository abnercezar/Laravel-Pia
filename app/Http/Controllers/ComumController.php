<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateComumRequest;
use App\Http\Requests\DestroyComumRequest;
use App\Http\Requests\EditComumRequest;
use App\Http\Requests\IndexComumRequest;
use App\Http\Requests\ShowComumRequest;
use App\Http\Requests\StoreComumRequest;
use App\Http\Requests\UpdateComumRequest;
use App\Http\Resources\ComumResource;
use App\Models\Comum;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

class ComumController extends Controller
{
    /**
     * Lista as comuns
     * 
     * @param  IndexComumRequest $request
     * @return InertiaResponse
     */
    public function index(IndexComumRequest $request): InertiaResponse
    {
        $comuns = ComumResource::collection(Comum::orderBy('name')->get());
        return inertia('Comum', compact('comuns'));
    }

    /**
     * Mostra os dados da comum
     * 
     * @param  ShowComumRequest $request
     * @param  Comum            $comum  
     * @return InertiaResponse          
     */
    public function show(ShowComumRequest $request, Comum $comum): InertiaResponse
    {
        return inertia('ComumNewEdit', compact('comum'));
    }

    /**
     * Vai para tela de criação da comum
     * 
     * @param  CreateComumRequest $request 
     * @return InertiaResponse                      
     */
    public function create(CreateComumRequest $request): InertiaResponse
    {
        return inertia('ComumNewEdit');
    }

    /**
     * Registra a comum efetivamento no banco de dados
     * 
     * @param  StoreComumRequest $request 
     * @return RedirectResponse                     
     */
    public function store(StoreComumRequest $request): RedirectResponse
    {
        $comum = Comum::create($request->validated());
        return redirect(route('comums.index'))->with(['message' => $comum->name . ' criado com sucesso']);
    }

    /**
     * Vai para tela de edição da comum
     *     
     * @param  EditComumRequest $request
     * @param  Comum            $comum  
     * @return InertiaResponse                  
     */
    public function edit(EditComumRequest $request, Comum $comum): InertiaResponse
    {
        return inertia('ComumNewEdit', compact('comum'));
    }

    /**
     * Atualiza o registro da comum efetivamente no banco de dados
     * 
     * @param  UpdateComumRequest $request 
     * @param  Comum              $comum   
     * @return RedirectResponse                      
     */
    public function update(UpdateComumRequest $request, Comum $comum): RedirectResponse
    {
        $comum->update($request->validated());
        return redirect(route('comums.index'))->with(['message' => $comum->name . ' atualizado com sucesso']);
    }

    /**
     * Deleta a comum efetivamente do banco de dados
     * 
     * @param  DestroyComumRequest $request
     * @param  Comum               $comum  
     * @return RedirectResponse                      
     */
    public function destroy(DestroyComumRequest $request, Comum $comum): RedirectResponse
    {
        $comum->forceDelete();
        return back()->with(['message' => $comum->name . ' deletado com sucesso']);
    }
}
