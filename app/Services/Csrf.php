<?php
// app/Services/Csrf.php

class Csrf
{
    private const TOKEN_KEY = 'csrf_token';

    public static function generateToken(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION[self::TOKEN_KEY] = $token;

        return $token;
    }

    public static function validateToken(?string $tokenFromForm): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION[self::TOKEN_KEY]) || empty($tokenFromForm)) {
            return false;
        }

        $isValid = hash_equals($_SESSION[self::TOKEN_KEY], $tokenFromForm);

        // panaudojam kartą ir išvalom
        unset($_SESSION[self::TOKEN_KEY]);

        return $isValid;
    }
}
