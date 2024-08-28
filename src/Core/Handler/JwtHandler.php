<?php

namespace Core\Handler;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{

    private function __construct() {}

    private static function _getKey()
    {

        $key = require __DIR__ . "/../../config/jwt.config.php";
        if (!is_array($key)) {
            throw new \Exception("Invalid JWT configuration.");
        }
        return $key['SECRET_KEY'];
    }

    public static function generateToken($user, $roleWeight)
    {
        if (!$roleWeight) {
            throw new \Exception("Role weight not found for id_role: " . $user->id_role);
        }

        $payload = [
            'iss' => "passionmanga",
            'iat' => time(),
            'exp' => time() + (365 * 24 * 60 * 60),
            'Id_user' => $user->id,
            'email' => $user->email,
            'role' => $user->id_role,
        ];

        return JWT::encode($payload, self::_getKey(), 'HS256');
    }

    public static function generateEmailToken($user)
    {
        $payload = [
            'iss' => "passionmanga",
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
        ];

        return JWT::encode($payload, self::_getKey(), 'HS256');
    }

    public static function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(self::_getKey(), 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            throw new \Exception("token decode failed");
        }
    }
}
