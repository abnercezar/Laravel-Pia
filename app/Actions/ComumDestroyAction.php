<?php

namespace App\Actions;

use App\Models\Comum;
use Lorisleiva\Actions\Concerns\AsAction;

class ComumDestroyAction
{
    use AsAction;

    public function handle(Comum $comum): Comum
    {
        $comum->forceDelete();
        return $comum;
    }
}
