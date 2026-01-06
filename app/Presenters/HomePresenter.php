<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\ViewRenderer;
use App\Services\AuthService;

class HomePresenter
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private AuthService $authService
    ) {}

    public function actionDefault(): void
    {
        $userName = $this->authService->getCurrentUserName();

        $this->viewRenderer->render('home', [
            'heading'  => 'Sveiki atvykę į LMS',
            'userName' => $userName,
        ]);
    }
}
