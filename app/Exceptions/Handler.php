<?php

namespace App\Exceptions;

use Exception, Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
//        if ($e instanceof ModelNotFoundException) {
//            Log::error('Error '.$e);
//            return redirect()->back()->withErrors([
//                'error' => 'Something Wrong'
//            ]);
////            $e = new NotFoundHttpException($e->getMessage(), $e);
//        }
//        else if ($e instanceof \PDOException) {
//            Log::error('Error '.$e);
//            return redirect('/')->withErrors([
//                'error' => 'Something Wrong With Sql'
//            ]);
//            # do something special or render a custom error
//        }
//        else{
            return parent::render($request, $e);
//        }
    }
}
