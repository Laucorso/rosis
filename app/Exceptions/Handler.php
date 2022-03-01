<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Models\Redirection;

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
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            // Manage redirections
            $redirection = Redirection::where('from',$request->path())->first();
            if( $redirection ) 
                return redirect($redirection->to,$redirection->code);
            $session_id = csrf_token() ?: '----------------------------------------';
            file_put_contents( base_path('404.log'), now().' '.$request->ip().' '.$session_id.' '.$request->fullUrl()."\n", FILE_APPEND );
            $ext = strtolower(pathinfo($request->url(), PATHINFO_EXTENSION));
            if( in_array($ext,['jpg','jpeg','png','gif','bmp','svg','webp']) )
                return redirect('resources/blank.jpg');

            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($ext, true)."\n", FILE_APPEND );
        });
    }

}
