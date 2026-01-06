<?php
/** @var string $heading */
/** @var string|null $userName */
?>

<h2><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h2>

<?php if ($userName !== null): ?>
    <p>
        Prisijungęs naudotojas:
        <strong><?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></strong> — <a href="?page=logout">Atsijungti</a>
    </p>
<?php else: ?>
    <p>
        Jūs šiuo metu neprisijungę.
        <a href="?page=login">Prisijungti</a>
    </p>
<?php endif; ?>

<p>Čia ateityje atsiras jūsų LMS sistema.</p>
