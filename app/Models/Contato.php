<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'irma_id',
    ];

    public function irma(): BelongsTo
    {
        return $this->belongsTo(Irma::class);
    }
}
