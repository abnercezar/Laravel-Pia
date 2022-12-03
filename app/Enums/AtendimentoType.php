<?php

namespace App\Enums;

enum AtendimentoType: string
{
    case CartoDeCredito = 'C';
    case Especie = 'E';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}