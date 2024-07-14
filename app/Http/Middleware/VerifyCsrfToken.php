<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    protected $except = [
        // Aquí puedes añadir las rutas que deseas excluir de la verificación CSRF y permitir CORS
        'api/*', // Ejemplo de ruta API
    ];
}
