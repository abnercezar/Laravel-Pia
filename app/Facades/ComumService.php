<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed index(\Illuminate\Http\Request $request) - Retorna uma coleção de dados
 * @method static mixed store(\Illuminate\Http\Request $request) - Retorna os dados registrados
 * @method static mixed update(\Illuminate\Http\Request $request, mixed $model) - Retorna os dados atualizados
 * @method static mixed destroy(\Illuminate\Http\Request $request, mixed $model) - Remove um registro do banco de dados
 *
 * @see \App\Services\ComumService
 */
class ComumService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        // registrar o acessor no FacadeServiceProvider dentro da função boot()
        // $this->app->bind('comum.services', fn () => new ComumService);
        return 'comum.services';
    }
}
