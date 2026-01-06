<?php

declare(strict_types=1);

// LAIKINAI: rodom klaidas ekrane, kad matytume 500 priežastį
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require __DIR__ . '/../app/Config/autoload.php';
require __DIR__ . '/../app/Services/Csrf.php';

$configFile = __DIR__ . '/../app/Config/config.php';
$config     = require $configFile;

$rawBaseUrl = $config['BASE_URL'] ?? '';

$baseUrl = $rawBaseUrl !== ''
    ? '/' . trim($rawBaseUrl, '/') . '/'
    : '/';

use App\Services\ViewRenderer;
use App\Services\Database;
use App\Services\AuthService;
use App\Models\UserModel;
use App\Presenters\HomePresenter;
use App\Presenters\ErrorPresenter;
use App\Presenters\LoginPresenter;
use App\Presenters\ProfilePresenter;
use App\Presenters\CoursesPresenter;
use App\Presenters\CoursePresenter;
use App\Models\CourseModel;

$viewRenderer = new ViewRenderer(null, $baseUrl);

// Bendra DB + Auth infrastruktūra visiems puslapiams
$db          = Database::getConnection();
$userModel   = new UserModel($db);
$authService = new AuthService($userModel);
$courseModel = new CourseModel($db);

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $presenter = new HomePresenter($viewRenderer, $authService);
        $presenter->actionDefault();
        break;
        
    case 'profile':
        $presenter = new ProfilePresenter($viewRenderer, $authService, $userModel);
        $presenter->actionDefault();
        break;
        
    case 'courses':
        $presenter = new CoursesPresenter($viewRenderer, $authService, $courseModel);
        $presenter->actionDefault();
        break;

    case 'course':
        // NAUJAS KURSO DETALIŲ MARŠRUTAS: ?page=course&id=1
        $presenter = new CoursePresenter($viewRenderer, $courseModel);
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $presenter->show($id);
        break;

    case 'login':
        $presenter = new LoginPresenter($viewRenderer, $authService);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $presenter->actionSubmit();
        } else {
            $presenter->actionDefault();
        }
        break;

    case 'logout':
        $authService->logout();
        header('Location: ?page=home');
        exit;

    default:
        $presenter = new ErrorPresenter($viewRenderer);
        $presenter->action404();
        break;
}
