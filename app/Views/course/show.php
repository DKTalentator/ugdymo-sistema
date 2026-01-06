<?php
// app/Views/course/show.php

/**
 * @var array<string, mixed> $course
 */
?>

<h2>
    <?= htmlspecialchars($course['title'] ?? 'Kurso detalės', ENT_QUOTES, 'UTF-8') ?>
</h2>

<?php if (!empty($course['created_at'])): ?>
    <p>
        <small>
            Sukurta: 
            <?= htmlspecialchars((string)$course['created_at'], ENT_QUOTES, 'UTF-8') ?>
        </small>
    </p>
<?php endif; ?>

<p>
    <?= nl2br(
        htmlspecialchars(
            $course['description'] ?? 'Šiuo metu šiam kursui aprašymas nepateiktas.',
            ENT_QUOTES,
            'UTF-8'
        )
    ) ?>
</p>

<hr>

<p><strong>Kurso ID:</strong>
    <?= htmlspecialchars((string)($course['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
</p>

<p>
    <a href="?page=home">⬅ Grįžti į pradžią</a>
</p>
