<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;

use Request;
use Illuminate\Auth\AuthenticationException;
use Response;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
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
//        if ($exception instanceof ModelNotFoundException) {
//            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
//        }
//
//        if ($exception instanceof TokenMismatchException) {
//            return redirect()->back()->withInput($request->except('password'))->withErrors(['Validation Token was expired. Please try again']);
//        }
//
//        if ($exception instanceof NotFoundHttpException) {
//            return redirect()->route('404');
//        }

        if ($this->isHttpException($exception)) {

            $statusCode = $exception->getStatusCode();

            switch ($statusCode) {

                case '404':
                    global $pageTitle;
                    $pageTitle = '404 Страница не найдена. SportCasta';
//                    return response()->view('layouts/index', [
//                        'content' => view('errors/404')
//                    ]);
            }
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if( $request->expectsJson() ){
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }else{
            $request->session()->flash('flash_register', 'Task was successful!');
            return redirect()->guest(route('home'));
        }
//        return $request->expectsJson()
//            ? response()->json(['message' => 'Unauthenticated.'], 401)
//            : redirect()->guest(route('home', ['auth' => 'true']));
    }

//    public function handle($request)
//    {
//        try
//        {
//            return parent::handle($request);
//        }
//        catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e)
//        {
//            return response()->view('error', [], 404);
//        }
//        catch (Exception $e)
//        {
//            $this->reportException($e);
//
//            return $this->renderException($request, $e);
//        }
//    }

//    protected function prepareResponse($request, Exception $e)
//    {
//        if ($this->isHttpException($e)) {
//            return $this->toIlluminateResponse($this->renderHttpException($e), $e);
//        } else {
//            return response()->view("errors.custom", ['exception' => $e]); //By overriding this function, I make Laravel display my custom 500 error page instead of the 'Whoops, looks like something went wrong.' message in Symfony\Component\Debug\ExceptionHandler
//        }
//    }
}
