<?php
namespace Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
  private string $key;

  public function __construct()
  {
    $this->key = require_once __DIR__ ."/../../.env/secretKey.php";
  }

  public function generateToken($user)
    {
        $payload = [
            'iss' => "passionmanga",
            'iat' => time(),
            'exp' => time() + (60 * 60),
            'userId' => $user->Id_user,
            'email' => $user->email,
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
}