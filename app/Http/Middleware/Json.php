<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Agent;
use Illuminate\Support\Facades\Log;

class Json
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])
            && $request->isJson()
        ) {

            $data = $request->json()->all();
            if(env('APP_DEBUG_REQUESTS', false)){
                $file = $path = base_path('storage/logs/'.date('Y-m-d').'requests.log');
                file_put_contents($file, '['.date('Y-m-d H:i:s').'] ' . json_encode($data) . PHP_EOL, FILE_APPEND );
            }

            $request->request->replace(is_array($data) ? $data : []);
        }
        return $next($request);
    }
}