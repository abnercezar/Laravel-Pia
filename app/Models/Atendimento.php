<?php

namespace App\Models;

use App\Enums\AtendimentoType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atendimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['irma'];

    protected $fillable = [
        'irma_id',
        'tipo',
        'valor',
    ];

    protected $casts = [
        'tipo' => AtendimentoType::class,
        'valor' => 'float'
    ];

    public function irma(): BelongsTo
    {
        return $this->belongsTo(Irma::class);
    }
}
