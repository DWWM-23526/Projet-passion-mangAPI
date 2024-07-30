<?php

namespace Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private array $key;
    private $cle;

    public function __construct()
    {
        $this->key = require_once __DIR__ . "/../../config/jwt.config.php";
        $this->cle = rand(1000000, 9000000);
    }

    public function generateToken($user)
    {
        $payload = [
            'iss' => "passionmanga",
            'iat' => time(),
            'exp' => time() + (365 * 24 * 60 * 60),
            'Id_user' => $user->Id_user,
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
            'pseudo' => $user['pseudo'],
            'email' => $user['email'],
            'password' => $user['password'],
            'cle' => $this->generateRandomKey(),
        ];

        return JWT::encode($payload, $this->key['SECRET_KEY'], 'HS256');
    }
    private function generateRandomKey()
    {
        return rand(1000000, 9000000);
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
