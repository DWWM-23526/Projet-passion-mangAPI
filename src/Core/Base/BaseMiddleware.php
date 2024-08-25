<?php 
namespace Core\Base;

use middlewares\AdminMiddleware;
use middlewares\AuthMiddleware;
use middlewares\GuestMiddleware;

class BaseMiddleware
{
    const MAP = [
        'guest' => GuestMiddleware::class,
        'auth' => AuthMiddleware::class,
        'admin' => AdminMiddleware::class,
    ];

}