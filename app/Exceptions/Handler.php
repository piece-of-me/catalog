<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): \Illuminate\Http\JsonResponse
    {
        return $this->_handleApiException($e);
    }

    private function _handleApiException(Throwable $exception): \Illuminate\Http\JsonResponse
    {
        if ($exception instanceof ModelNotFoundException) {
            return Response::json(['message' => 'Entity Not Found'], 404);
        } elseif ($exception instanceof NotFoundHttpException) {
            return Response::json(['message' => 'Entity Not Found'], 404);
        }
        return Response::json(['message' => 'Internal Server Error'], 500);
    }
}
