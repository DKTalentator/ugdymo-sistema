<?php
// app/Presenters/BasePresenter.php
declare(strict_types=1);

namespace App\Presenters;

use App\Services\ViewRenderer;

abstract class BasePresenter
{
    protected ViewRenderer $view;

    public function __construct(ViewRenderer $view)
    {
        $this->view = $view;
    }

    protected function render(string $template, array $params = []): void
    {
        $this->view->render($template, $params);
    }
}
