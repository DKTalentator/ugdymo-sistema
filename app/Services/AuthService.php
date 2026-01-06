<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    public function __construct(
        private UserModel $userModel
    ) {}

    public function login(string $email, string $password): bool
    {
        $user = $this->userModel->findByEmail($email);

        if ($user === null || (int)$user['is_active'] !== 1) {
            return false;
        }

        if (!password_verify($password, $user['password_hash'])) {
            return false;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_regenerate_id(true);

        $_SESSION['user_id']    = (int)$user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name']  = $user['full_name'];

        return true;
    }

    public function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        session_start();
        session_regenerate_id(true);
    }

    public function isAuthenticated(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && is_int($_SESSION['user_id']);
    }

    public function getCurrentUserName(): ?string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return $_SESSION['user_name'] ?? null;
    }
    
     public function getCurrentUserId(): ?int
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && is_int($_SESSION['user_id'])
            ? $_SESSION['user_id']
            : null;
    }

    public function getCurrentUserEmail(): ?string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return $_SESSION['user_email'] ?? null;
    }

    /**
     * Helperis puslapiams, kurie leidžiami tik prisijungusiems.
     * Jei neprisijungęs – redirect į login puslapį.
     */
    public function requireLogin(string $redirectPage = 'login'): void
    {
        if ($this->isAuthenticated()) {
            return;
        }

        // Galėtum čia dar išsisaugoti, kur žmogus norėjo patekti:
        // $_SESSION['after_login_redirect'] = $_SERVER['REQUEST_URI'] ?? null;

        header('Location: ?page=' . urlencode($redirectPage));
        exit;
    }
    

}
