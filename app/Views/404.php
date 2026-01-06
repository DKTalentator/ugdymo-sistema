<?php
// app/Views/404.php
/** @var string $heading */
/** @var string $message */
?>
<h2><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h2>

<p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>

<p>
    <a href="<?= $baseUrl ?>?page=home">Grįžti į pradžią</a>
</p>
