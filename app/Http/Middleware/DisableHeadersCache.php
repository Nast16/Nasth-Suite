<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableHeadersCache
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Menambahkan perintah ke header HTTP agar browser tidak menyimpan cache halaman
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
    }
}