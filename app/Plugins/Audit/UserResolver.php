<?php

namespace App\Plugins\Audit;

use App\Modulos\Acesso\Dados\Models\Usuario;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use App\Core\Contracts\Servicos\AutenticacaoService;

class UserResolver implements \OwenIt\Auditing\Contracts\UserResolver
{
    public function __construct(private readonly AutenticacaoService $authService)
    {
    }

    /**
     * @return UserResolver
     */
    private static function getInstance()
    {
        return new static(App::make(AutenticacaoService::class));
    }

    /**
     * {@inheritdoc}
     */
    public static function resolve()
    {
        $token = Request::header('Authorization');

        $instance = static::getInstance();
        $autenticado = $instance->authService->getAutenticavelPorToken($token);

        return Usuario::find($autenticado->getIdentificador()->valor());
    }
}
