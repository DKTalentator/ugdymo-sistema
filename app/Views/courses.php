<?php
/** @var array $courses */
?>

<h2>Mano kursai</h2>

<?php if (empty($courses)): ?>
    <p>Šiuo metu nėra aktyvių kursų.</p>
<?php else: ?>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li style="margin-bottom: 10px;">
                <strong><a href="?page=course&id=<?= (int)$course['id'] ?>">
        <?= htmlspecialchars($course['title'], ENT_QUOTES, 'UTF-8') ?>
    </a></strong><br>
                <?php if (!empty($course['description'])): ?>
                    <small><?= nl2br(htmlspecialchars($course['description'], ENT_QUOTES, 'UTF-8')) ?></small><br>
                <?php endif; ?>
                <?php if (!empty($course['created_at'])): ?>
                    <small>Sukurta: <?= htmlspecialchars($course['created_at'], ENT_QUOTES, 'UTF-8') ?></small>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
