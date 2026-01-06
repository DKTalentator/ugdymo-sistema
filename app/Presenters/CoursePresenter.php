<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\ViewRenderer;
use App\Models\CourseModel;

class CoursePresenter
{
    public function __construct(
        private ViewRenderer $viewRenderer,
        private CourseModel $courseModel,
    ) {}

    /**
     * Parodo kurso detalių puslapį pagal ID.
     */
    public function show(?int $id): void
    {
        // Netinkamas arba nepateiktas ID → 404
        if ($id === null || $id <= 0) {
            $this->viewRenderer->render('errors/404', [
                'title'   => 'Kursas nerastas',
                'message' => 'Neteisingas kurso adresas arba ID.',
            ]);
            return;
        }

        $course = $this->courseModel->getCourseById($id);

        // Nerastas kursas → 404
        if ($course === null) {
            $this->viewRenderer->render('errors/404', [
                'title'   => 'Kursas nerastas',
                'message' => 'Kursas su pateiktu ID nerastas arba neaktyvus.',
            ]);
            return;
        }

        // Rodo kurso detalių vaizdą
        $this->viewRenderer->render('course/show', [
            'title'  => $course['title'] ?? 'Kurso detalės',
            'course' => $course,
        ]);
    }
}
