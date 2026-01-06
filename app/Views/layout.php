<?php
// app/Views/layout.php
/** @var string $content */
/** @var string|null $baseUrl */
/** @var string|null $userName */
?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>LMS</title>

    <!-- Paprastas default CSS, jei turite savo – pakeisi vėliau -->
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        header { margin-bottom: 20px; }
        .nav { display: flex; justify-content: space-between; align-items: center; }
        .nav a { margin-left: 10px; text-decoration: none; }
    </style>
</head>
<body>

<header>
    <div class="nav">
        <div>
            <a href="?page=home"><strong>LMS</strong></a>
        </div>

        <div>
            <?php if ($userName): ?>
                Prisijungęs kaip <strong><?= htmlspecialchars($userName) ?></strong>
                | <a href="?page=courses">Mano kursai</a>
                | <a href="?page=profile">Mano profilis</a>
                | <a href="?page=logout">Atsijungti</a>
            <?php else: ?>
                <a href="?page=login">Prisijungti</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main>
    <?= $content ?>
</main>

<footer style="margin-top: 40px; color: #777;">
    © <?= date('Y') ?> LMS
</footer>

</body>
</html>
