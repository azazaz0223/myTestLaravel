<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Summary of Handler
 */
class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register() : void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            // 1.Model 找不到資源
            if ($exception instanceof ModelNotFoundException) {
                // 呼叫 errorResponse 方法
                return $this->errorResponse(
                    '找不到資源',
                    Response::HTTP_NOT_FOUND
                );
            }
            // 2.網址輸入錯誤（新增判斷）
            if ($exception instanceof NotFoundHttpException) {
                return $this->errorResponse(
                    '無法找到此網址',
                    Response::HTTP_NOT_FOUND
                );
            }
            // 3.網址不允許該請求動詞（新增判斷）
            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->errorResponse(
                    $exception->getMessage(), // 回傳例外內的訊息
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * Summary of unauthenticated
     * @param mixed $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // 客戶端請求JSON格式
        if ($request->expectsJson()) {
            return $this->errorResponse(
                $exception->getMessage(),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return parent::unauthenticated($request, $exception);
    }
}