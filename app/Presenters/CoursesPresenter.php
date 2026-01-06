<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\ViewRenderer;
use App\Services\AuthService;
use App\Models\CourseModel;

class CoursesPresenter
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private AuthService $authService,
        private CourseModel $courseModel
    ) {}

    public function actionDefault(): void
    {
        // Tik prisijungusiems
        $this->authService->requireLogin();

        $courses = $this->courseModel->getActiveCourses();

        $this->viewRenderer->render('courses', [
            'courses' => $courses,
        ]);
    }
}
