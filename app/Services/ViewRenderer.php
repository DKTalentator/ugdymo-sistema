<?php

declare(strict_types=1);

namespace App\Services;

class ViewRenderer
{
    public function __construct(
        private ?string $layout = null,
        private ?string $baseUrl = null
    ) {
        // jei nenurodytas layout – naudojam default
        if ($this->layout === null) {
            $this->layout = __DIR__ . '/../Views/layout.php';
        }
    }

    public function render(string $view, array $params = []): void
    {
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            echo "View failas nerastas: " . htmlspecialchars($view);
            return;
        }

        // paverčiam masyvo raktus į kintamuosius
        extract($params, EXTR_SKIP);

        // 1. sugeneruojam view turinį
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // 2. iškviest layout
        $userName = $_SESSION['user_name'] ?? null;
        $baseUrl  = $this->baseUrl;

        require $this->layout;
    }
}
