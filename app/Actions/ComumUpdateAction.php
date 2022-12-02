<?php

namespace App\Actions;

use App\Models\Comum;
use Lorisleiva\Actions\Concerns\AsAction;

class ComumUpdateAction
{
    use AsAction;

    public function handle(Comum $comum, array $data): Comum
    {
        $comum->update($data);
        return $comum->fresh();
    }
}
