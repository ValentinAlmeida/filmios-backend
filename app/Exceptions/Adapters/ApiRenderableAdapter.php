<?php

namespace App\Exceptions\Adapters;

use App\Core\Exceptions\Enumerations\ErroComun;
use App\Core\Exceptions\Enumerations\ResourceError;
use App\Contracts\Exceptions\Renderable;
use App\Core\Exceptions\Enumerations\AuthenticationError;
use App\Core\Exceptions\ResourceError as ExcecaoRecurso;
use App\Core\Exceptions\AuthenticationError as ExcecaoAutenticacao;
use App\Core\Exceptions\AuthorizationError as ExcecaoAutorizacao;
use App\Core\Exceptions\ValidationError as ExcecaoValidacao;
use App\Core\Exceptions\Enumerations\AuthorizationError;
use App\Core\Exceptions\Enumerations\ValidationError;
use App\Exceptions\ApiException;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class ApiRenderableAdapter implements Renderable
{
    private ApiException $exception;

    public function __construct(\Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $this->exception = $this->httpToApi($exception);
        } else {
            $this->exception = $this->isKnown($exception)
                ? $this->knownException($exception)
                : $this->unknownException($exception);
        }
    }

    private function httpStatusResolve(string $errorCode)
    {
        return match ($errorCode) {
            ResourceError::JA_EXISTE->codigo() => Response::HTTP_UNPROCESSABLE_ENTITY,
            ResourceError::NAO_PODE_CRIAR->codigo() => Response::HTTP_UNPROCESSABLE_ENTITY,
            ResourceError::NAO_PODE_ATUALIZAR->codigo() => Response::HTTP_UNPROCESSABLE_ENTITY,
            ResourceError::NAO_PODE_DELETAR->codigo() => Response::HTTP_UNPROCESSABLE_ENTITY,
            ResourceError::NAO_ENCONTRADO->codigo() => Response::HTTP_UNPROCESSABLE_ENTITY,
            ResourceError::INVALIDO->codigo() => Response::HTTP_UNPROCESSABLE_ENTITY,
            AuthenticationError::CREDENCIAIS_INVALIDAS->codigo() => Response::HTTP_UNAUTHORIZED,
            AuthenticationError::TOKEN_EXPIRADO->codigo() => Response::HTTP_UNAUTHORIZED,
            AuthenticationError::REFRESH_TOKEN_EXPIRADO->codigo() => Response::HTTP_UNAUTHORIZED,
            AuthenticationError::TOKEN_NAO_ENCONTRADO->codigo() => Response::HTTP_UNAUTHORIZED,
            AuthenticationError::TOKEN_INVALIDO->codigo() => Response::HTTP_UNAUTHORIZED,
            AuthenticationError::ACESSO_BLOQUEADO->codigo() => Response::HTTP_UNAUTHORIZED,
            AuthorizationError::NAO_AUTORIZADO->codigo() => Response::HTTP_FORBIDDEN,
            ValidationError::VALIDACAO_REQUISICAO->codigo() => Response::HTTP_BAD_REQUEST,
        };
    }

    public function render($request)
    {
        return $this->exception->render($request);
    }

    private function knownException($exception)
    {
        $excecao = $this->parseException($exception);
        $instance = new ApiException(
            $excecao->mensagem,
            $excecao->nome,
            $excecao->codigo,
            $this->httpStatusResolve($excecao->codigo),
            $excecao->previous
        );
        $instance->setDetalhes($excecao->getDetalhes());

        return $instance;
    }

    private function parseException($exception)
    {
        if ($excecao = ExcecaoRecurso::pertence($exception)) {
            return $excecao;
        }

        if($excecao = ExcecaoAutenticacao::pertence($exception)) {
            return $excecao;
        }

        if($excecao = ExcecaoAutorizacao::pertence($exception)) {
            return $excecao;
        }

        if($excecao = ExcecaoValidacao::pertence($exception)) {
            return $excecao;
        }
    }

    private function unknownException(\Throwable $th)
    {
        return new ApiException(
            ErroComun::ERRO_INTERNO->mensagem(),
            'ErroInterno',
            ErroComun::ERRO_INTERNO->codigo(),
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $th
        );
    }

    private function isKnown(\Throwable $th)
    {
        return property_exists($th, 'codigo');
    }

    private function isHttpException(\Throwable $th)
    {
        return $th instanceof HttpExceptionInterface;
    }

    private function httpToApi(HttpExceptionInterface $exception)
    {
        $statusCode = $exception->getStatusCode();
        $message = Response::$statusTexts[$statusCode];
        $errorCode = Str::finish('HTTP', $statusCode);

        return new ApiException($message, 'HttpError', $errorCode, $statusCode);
    }
}
