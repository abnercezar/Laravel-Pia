<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIrmaRequest;
use App\Http\Requests\UpdateIrmaRequest;
use App\Models\Irma;

class IrmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreIrmaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIrmaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function show(Irma $irma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function edit(Irma $irma)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Irma  $irma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Irma $irma)
    {
        //
    }
}
