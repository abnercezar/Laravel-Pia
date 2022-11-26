<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comum extends Model
{
    use HasFactory;

    protected $table = 'comuns';

    protected $fillable = [
        'name',
    ];
}
