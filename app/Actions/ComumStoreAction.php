<?php

namespace App\Actions;

use App\Models\Comum;
use Lorisleiva\Actions\Concerns\AsAction;

class ComumStoreAction
{
    use AsAction;

    public function handle(array $data): Comum
    {
        return Comum::create($data);
    }
}
