<?php

namespace App\Services;

class AuthService {
    public static function login(string $email, string $password)
    {
        if (!$token = auth()->attempt([
            'email' => $email,
            'password' => $password
        ])) throw new \Exception("E-mail/password incorrect");

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 2
        ];
    }
}