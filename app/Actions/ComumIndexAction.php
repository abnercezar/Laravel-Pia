<?php

namespace App\Actions;

use App\Models\Comum;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class ComumIndexAction
{
    use AsAction;

    public function handle(): Collection | LengthAwarePaginator
    {
        return Comum::orderBy('name')->get();
    }
}
