<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    public function register(): void
    {

        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $exception)
    {

        // logika jika fungsi tidak ditemukan

        if ($exception instanceof \BadMethodCallException) {

            return back();
        }

        // jika pesan 419 PAGE EXPIRED
        if ($exception instanceof TokenMismatchException) {
            return back();
            // return redirect()->route('nama.route.yang.diinginkan');
        }

        // jika pesan 404 NOT FOUND
        // if ($this->isHttpException($exception) && $exception->getStatusCode() == 404) {
        //     return back();
        //     return response()->view('errors.404', [], 404);
        // }

        return parent::render($request, $exception);
    }
}
