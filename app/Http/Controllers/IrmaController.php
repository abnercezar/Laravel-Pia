<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIrmaRequest;
use App\Http\Requests\UpdateIrmaRequest;
use App\Http\Resources\ComumDropdownResource;
use App\Http\Resources\IrmaResource;
use App\Models\Comum;
use App\Models\Irma;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IrmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $irmas = IrmaResource::collection(
            Irma::with(['contatos', 'comuns'])->orderBy('name')->get()
        );

        return inertia('Irma', compact('irmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comuns = $this->dropdownComuns();
        return inertia('IrmaNewEdit', compact('comuns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIrmaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIrmaRequest $request)
    {
        $irma = \DB::transaction(function () use ($request) {
            $irma = Irma::create($request->safe()->only(['name', 'cpf']));
            $irma->comuns()->attach($request->safe()->comuns);
            $irma->contatos()->createMany($request->safe()->contatos);
            return $irma;
        });

        return redirect()->route('irmas.index')->with('message', "Irmã {$irma->name} criado(a) com sucesso.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function show(Irma $irma)
    {
        $irma->load(['contatos', 'comuns']);
        $irma = IrmaResource::make($irma);

        $comuns = $this->dropdownComuns();

        return inertia('IrmaNewEdit', compact('irma', 'comuns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function edit(Irma $irma)
    {
        $irma->load(['contatos', 'comuns']);
        $irma = IrmaResource::make($irma);

        $comuns = $this->dropdownComuns();

        return inertia('IrmaNewEdit', compact('irma', 'comuns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIrmaRequest  $request
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIrmaRequest $request, Irma $irma)
    {
        \DB::transaction(function () use ($request, $irma) {
            $irma->update($request->safe()->only(['name', 'cpf']));
            $irma->comuns()->sync($request->safe()->comuns);
            $irma->contatos()->forceDelete();
            $irma->contatos()->createMany($request->safe()->contatos);
        });

        return redirect()->route('irmas.index')->with('message', "Irmã {$irma->name} atualizado(a) com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Irma $irma)
    {
        try {
            if ($irmas->atendimentos()->withTrashed()->exists())
                throw new TemAtendimentoException("A Irmã não pode ser deletada pois possui atendimentos.", 1);

            \DB::transaction(function () use ($irma) {
                $irma->contatos()->delete();
                $irma->delete();
            });

            return redirect()->route('irmas.index')->with('message', "Irmã {$irma->name} deletado(a) com sucesso.");
        } catch (TemAtendimentoException $exception) {
            return back()->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    private function dropdownComuns(): ResourceCollection
    {
        return ComumDropdownResource::collection(Comum::orderBy('name')->get());
    }
}
