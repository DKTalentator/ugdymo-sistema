<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\ViewRenderer;
use App\Services\AuthService;
use App\Models\UserModel;

class ProfilePresenter
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private AuthService $authService,
        private UserModel $userModel
    ) {}

    public function actionDefault(): void
    {
        // Tik prisijungusiems
        $this->authService->requireLogin();

        $userId = $this->authService->getCurrentUserId();

        if ($userId === null) {
            // Netikėta situacija – šiaip jau neturėtų nutikti
            header('Location: ?page=login');
            exit;
        }

        $user = $this->userModel->findById($userId);

        if ($user === null) {
            // Jei vartotojas ištrintas – atsijungiam ir siunčiam į login
            $this->authService->logout();
            header('Location: ?page=login');
            exit;
        }

        $this->viewRenderer->render('profile', [
            'fullName'  => $user['full_name'],
            'email'     => $user['email'],
            'createdAt' => $user['created_at'] ?? null,
        ]);
    }
}
