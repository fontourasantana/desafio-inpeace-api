<?php
namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Lista de exceções mapeadas para tratamento de resposta na api
     *
     * @var array
     */
    protected array $exceptionMap = [
        EntityNotFoundException::class => [
            'code' => 404,
            'message' => 'Não foi possível encontrar o que você estava procurando',
            'adaptMessage' => true,
        ],
        EntityValidationException::class => [
            'code' => 422,
            'message' => 'Aconteceu algum problema ao validar os dados informados',
            'adaptMessage' => true,
        ],
        RequiredAttributesException::class => [
            'code' => 422,
            'message' => 'É necessário informar todos os campos',
            'adaptMessage' => false,
        ],
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isMappedException($exception)) {
            $response = $this->formatException($exception);
            return app('api.response')->error($response['message'], $response['code'])->send();
        }

        return parent::render($request, $exception);
    }

    /**
     * Retorna se a exceção está mapeada
     *
     * @param \Throwable $exception
     * @return bool
     */
    protected function isMappedException(\Throwable $exception): bool
    {
        $exceptionClass = get_class($exception);
        return isset($this->exceptionMap[$exceptionClass]);
    }

    /**
     * Retorna dados necessários para resposta da api mapeada
     *
     * @param \Throwable $exception
     * @return array
     */
    protected function formatException(\Throwable $exception): array
    {
        $exceptionClass = get_class($exception);
        $definition = $this->exceptionMap[$exceptionClass];

        if (!empty($definition['adaptMessage'])) {
            $definition['message'] = $exception->getMessage() ?? $definition['message'];
        }

        return [
            'code' => $definition['code'] ?? 500,
            'message' => $definition['message'],
        ];
    }
}
