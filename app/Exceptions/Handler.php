<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;

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

        $this->renderable(function (Exception $e, $request) {

                $response = $this->customApiResponse($e, $request);
                $message = $response['message'];
                return response()->view('errors.http_errors', compact('message'));

        });
    }
    private function customApiResponse($exception, $request)
    {

        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Unauthorized Token is missing or invalid';
                break;
                case 404:
                    $response['message'] = 'Page not found';
                    break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Requested page not found on server or moved.';
                break;
            case 405:
                $response['message'] = 'Request Method not Allowed';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = 'Whoops, looks like something you are calling is not valid';
                break;
        }

        if (config('app.debug')) {
            //  $response['trace'] = $exception->getTrace();
            // $response['code'] = $exception->getCode();
        }

        $response['status'] = 'errors';
        return $response;
    }
}
