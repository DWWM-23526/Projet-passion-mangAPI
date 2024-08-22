<?php

namespace Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private array $key;

    public function __construct()
    {
        $this->key = require_once __DIR__ . "/../../config/jwt.config.php";
    }

    public function generateToken($user)
    {
        $payload = [
            'iss' => "passionmanga",
            'iat' => time(),
            'exp' => time() + (365 * 24 * 60 * 60),
            'Id_user' => $user->id,
            'email' => $user->email,
        ];

        return JWT::encode($payload, $this->key['SECRET_KEY'], 'HS256');
    }

    public function generateEmailToken($user)
    {
        $payload = [
            'iss' => "passionmanga",
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
        ];

        return JWT::encode($payload, $this->key['SECRET_KEY'], 'HS256');
    }
    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->key['SECRET_KEY'], 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            throw new \Exception("token decode failed");
        }
    }
}
