<?php
// app/Views/login.php
/** @var string|null $error */
/** @var string|null $oldEmail */
/** @var string $csrfToken */
?>
<h2>Prisijungimas</h2>

<?php if (!empty($error)): ?>
    <div class="error" style="color: red;">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="post" action="?page=login">
    <div>
        <label for="email">El. paštas:</label><br>
        <input
            type="email"
            id="email"
            name="email"
            required
            value="<?= htmlspecialchars($oldEmail ?? '', ENT_QUOTES, 'UTF-8') ?>"
        >
    </div>

    <div style="margin-top: 8px;">
        <label for="password">Slaptažodis:</label><br>
        <input type="password" id="password" name="password" required>
    </div>

    <!-- CSRF token -->
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

    <div style="margin-top: 12px;">
        <button type="submit">Prisijungti</button>
    </div>
</form>
