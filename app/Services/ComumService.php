<?php

namespace App\Services;

use App\Actions\ComumDestroyAction;
use App\Actions\ComumIndexAction;
use App\Actions\ComumStoreAction;
use App\Actions\ComumUpdateAction;
use App\Http\Resources\ComumResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComumService
{
    /**
     * List all
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request): mixed
    {
        return ComumResource::collection(
            ComumIndexAction::run()
        );
    }

    /**
     * Store data
     *
     * @param  Request  $request
     * @return Model
     */
    public function store(Request $request): Model
    {
        return ComumResource::make(
            ComumStoreAction::run($request->validated())
        );
    }

    /**
     * Update data
     *
     * @param  Request  $request
     * @param  mixed  $model
     * @return Model
     */
    public function update(Request $request, mixed $model): Model
    {
       return ComumResource::make(
            ComumUpdateAction::run($request->validated(), $model)
       );
    }

    /**
     * Destroy data
     *
     * @param  Request  $request
     * @param  mixed  $model
     * @return mixed
     */
    public function destroy(Request $request, mixed $model): mixed
    {
        return ComumResource::make(
            ComumDestroyAction::run($model)
       );
    }
}
