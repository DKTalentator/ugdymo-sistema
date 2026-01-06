<?php
declare(strict_types=1);

namespace App\Presenters;

class ErrorPresenter extends BasePresenter
{
    public function action404(): void
    {
        http_response_code(404);

        $this->render('404', [
            'title'   => 'Puslapis nerastas',
            'heading' => '404 – puslapis nerastas',
            'message' => 'Atsiprašome, toks puslapis mūsų LMS sistemoje nerastas.',
        ]);
    }
}
