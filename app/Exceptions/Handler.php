<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Constant\ErrorCode;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     * @throws
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $log = myLog("error");
        $log->debug("message". $exception->getMessage());
        $log->debug("trace". $exception->getTraceAsString());
        if(ErrorCode::getCode($exception->getCode())){
            $result['msg'] = ErrorCode::msg($exception->getCode());
            $result['code'] = $exception->getCode();
            return response()->json($result, ErrorCode::status($exception->getCode()));
        }
        return parent::render($request, $exception);
    }
}
