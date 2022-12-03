<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Irma extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'cpf',
    ];

    public function comuns(): BelongsToMany
    {
        return $this->belongsToMany(Comum::class, 'comum_irma');
    }

    public function atendimentos(): HasMany
    {
        return $this->hasMany(Atendimento::class);
    }

    public function contatos(): HasMany
    {
        return $this->hasMany(Contato::class);
    }
}
