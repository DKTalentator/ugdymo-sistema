<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\ViewRenderer;
use App\Services\AuthService;

class LoginPresenter
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private AuthService $authService
    ) {}

    public function actionDefault(): void
    {
        $csrfToken = \Csrf::generateToken();

        $this->viewRenderer->render('login', [
            'error'     => null,
            'oldEmail'  => null,
            'csrfToken' => $csrfToken,
        ]);
    }

    public function actionSubmit(): void
    {
        // CSRF
        $tokenFromForm = $_POST['csrf_token'] ?? null;
        if (!\Csrf::validateToken($tokenFromForm)) {
            $this->showFormWithError('Neteisingas saugumo žetonas. Pabandykite dar kartą.');
            return;
        }

        $email    = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $this->showFormWithError('Užpildykite el. pašto ir slaptažodžio laukus.', $email);
            return;
        }

        // Login per AuthService
        if (!$this->authService->login($email, $password)) {
            $this->showFormWithError('Neteisingi prisijungimo duomenys.', $email);
            return;
        }

        header('Location: ?page=home');
        exit;
    }

    private function showFormWithError(string $message, ?string $oldEmail = null): void
    {
        $csrfToken = \Csrf::generateToken();

        $this->viewRenderer->render('login', [
            'error'     => $message,
            'oldEmail'  => $oldEmail,
            'csrfToken' => $csrfToken,
        ]);
    }
}
