<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComumCreateRequest;
use App\Http\Requests\ComumDestroyRequest;
use App\Http\Requests\ComumEditRequest;
use App\Http\Requests\ComumIndexRequest;
use App\Http\Requests\ComumShowRequest;
use App\Http\Requests\ComumStoreRequest;
use App\Http\Requests\ComumUpdateRequest;
use App\Http\Resources\ComumResource;
use App\Models\Comum;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

class ComumController extends Controller
{
    /**
     * Lista as comuns
     * 
     * @param  ComumIndexRequest $request
     * @return InertiaResponse
     */
    public function index(ComumIndexRequest $request): InertiaResponse
    {
        $comuns = ComumResource::collection(Comum::orderBy('name')->get());
        return inertia('Comum', compact('comuns'));
    }

    /**
     * Mostra os dados da comum
     * 
     * @param  ComumShowRequest $request
     * @param  Comum            $comum  
     * @return InertiaResponse          
     */
    public function show(ComumShowRequest $request, Comum $comum): InertiaResponse
    {
        return inertia('ComumNewEdit', compact('comum'));
    }

    /**
     * Vai para tela de criação da comum
     * 
     * @param  ComumCreateRequest $request 
     * @return InertiaResponse                      
     */
    public function create(ComumCreateRequest $request): InertiaResponse
    {
        return inertia('ComumNewEdit');
    }

    /**
     * Registra a comum efetivamento no banco de dados
     * 
     * @param  ComumStoreRequest $request 
     * @return RedirectResponse                     
     */
    public function store(ComumStoreRequest $request): RedirectResponse
    {
        $comum = Comum::create($request->validated());
        return redirect(route('comums.index'))->with(['message' => $comum->name . ' criado com sucesso']);
    }

    /**
     * Vai para tela de edição da comum
     *     
     * @param  ComumEditRequest $request
     * @param  Comum            $comum  
     * @return InertiaResponse                  
     */
    public function edit(ComumEditRequest $request, Comum $comum): InertiaResponse
    {
        return inertia('ComumNewEdit', compact('comum'));
    }

    /**
     * Atualiza o registro da comum efetivamente no banco de dados
     * 
     * @param  ComumUpdateRequest $request 
     * @param  Comum              $comum   
     * @return RedirectResponse                      
     */
    public function update(ComumUpdateRequest $request, Comum $comum): RedirectResponse
    {
        $comum->update($request->validated());
        return redirect(route('comums.index'))->with(['message' => $comum->name . ' atualizado com sucesso']);
    }

    /**
     * Deleta a comum efetivamente do banco de dados
     * 
     * @param  ComumDestroyRequest $request
     * @param  Comum               $comum  
     * @return RedirectResponse                      
     */
    public function destroy(ComumDestroyRequest $request, Comum $comum): RedirectResponse
    {
        $comum->forceDelete();
        return back()->with(['message' => $comum->name . ' deletado com sucesso']);
    }
}
