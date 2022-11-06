<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
//        if ($request->wantsJson()) {
//            if($e instanceof ValidationException){
//                return $this->renderValidationException($request,$e);
//            }
//            $exception = $this->prepareException($e);
//            dd($e);
//            $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
//            dd($exception, $code);

//            return response(['message' => $code === 500 ? 'خطای سرور رخ داده است' : $exception->getMessage()], $code);
//        }

        $this->reportable(function (Throwable $e) {
            //
        });


    }

    public function render($request,Throwable $exception)
    {
        dd($exception->getMessage());
        if ($request->wantsJson()) {
            //add Accept: application/json in request
//            dd($request->wantsJson());
//            dd($exception);
            return $this->handleApiException($request, $exception);
        }

            return $this->renderOtherException($request,$exception);


//        return $retval;
    }

    private function handleApiException(Request $request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->renderValidationException($request, $exception);
        }
        if ($exception instanceof AuthenticationException){
            return $this->renderAuthenticationException($request,$exception);
        }
        return $this->renderOtherException($request,$exception);
    }

    /**این کد برای اعتبار سنجی ورودی هاست
     * @param $request
     * @param ValidationException $e
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function renderValidationException($request, ValidationException $e)
    {
        return response([$e->errors()], 422);

    }

    /** این کد برای سایر خطاهای رست ای پی آی می باشد که به صورت json برمیگرداند
     * @param $request
     * @param $exception
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function renderOtherException($request, $exception)
    {
        $e = $this->prepareException($exception);
//            dd($e);
        $code = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
//            dd($exception, $code);
//
        return response(['message' => $code === 500 ? 'خطای سرور رخ داده است' : $e->getMessage()], $code);
    }

    /**برای هندل خطاهای احراز هویت
     * @param Request $request
     * @param AuthenticationException $exception
     * @return void
     */
    private function renderAuthenticationException(Request $request, AuthenticationException $exception)
    {
//        dd($exception->getMessage());
        return response(['error'=>'شما دسترسی به این داده ها ندارید'],401);
    }
}


