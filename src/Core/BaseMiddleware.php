<?php 
namespace Core;

use middlewares\AuthMiddleware;
use middlewares\GuestMiddleware;

class BaseMiddleware
{

    const MAP = [
        'guest' => GuestMiddleware::class,
        'auth' => AuthMiddleware::class,

    ];

}