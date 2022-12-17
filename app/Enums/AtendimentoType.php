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

    public function label(): string
    {
        return match ($this) {
            self::CartoDeCredito => 'Cartão de Crédito',
            self::Especie => 'Espécie',
        };
    }

    public static function all(): array
    {
        $ret = [];
        foreach(self::cases() as $case) {
            $ret[$case->name] = [
                'label' => $case->label(),
                'value' => $case->value
            ];
        }
        return $ret;
    }
}