<?php

namespace App\Core\Enumerations;

use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum StatusEstablishmentEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case PENDENTE_ANALISE = 'status.pendente.analise';
    case PENDENTE_CORRECAO = 'status.pendente.correcao';
    case CORRIGIDO = 'status.corrigido';
    case APROVADO = 'status.aprovado';
    case PENDENTE_PAGAMENTO = 'status.pendente.pagamento';

    public function withMeta(): array
    {
        return match ($this) {
            self::PENDENTE_ANALISE => [
                'description' => 'Pendente Análise',
            ],
            self::PENDENTE_CORRECAO => [
                'description' => 'Pendente Correção',
            ],
            self::CORRIGIDO => [
                'description' => 'Corrigido',
            ],
            self::APROVADO => [
                'description' => 'Aprovado',
            ],
            self::PENDENTE_PAGAMENTO => [
                'description' => 'Pendente Pagamento',
            ],
        };
    }
}
