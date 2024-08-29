<?php 
namespace Core\Middlewares;

use Auth\middlewares\AdminMiddleware;
use Auth\middlewares\AuthMiddleware;
use Auth\middlewares\GuestMiddleware;

class _BaseMiddleware
{
    const MAP = [
        'guest' => GuestMiddleware::class,
        'auth' => AuthMiddleware::class,
        'admin' => AdminMiddleware::class,
    ];

}