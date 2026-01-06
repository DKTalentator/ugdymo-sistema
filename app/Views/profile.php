<?php
/** @var string $fullName */
/** @var string $email */
/** @var string|null $createdAt */
?>

<h2>Mano profilis</h2>

<p>
    <strong>Vardas ir pavardė:</strong><br>
    <?= htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <strong>El. paštas:</strong><br>
    <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
</p>

<?php if ($createdAt !== null): ?>
    <p>
        <strong>Registracijos data:</strong><br>
        <?= htmlspecialchars($createdAt, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<p>
    (Vėliau čia galėsim pridėti profilį redaguojančią formą, slaptažodžio keitimą ir pan.)
</p>
