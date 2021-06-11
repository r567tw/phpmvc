<?php

use app\core\Application;
?>
<?php if (Application::$app->user) : ?>
    <h1>Welcom user <?= Application::$app->user->name ?></h1>
<?php else : ?>
    <h1>Hello My framework</h1>
<?php endif ?>

<?php if (Application::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success">
        <?= Application::$app->session->getFlash('success') ?>
    </div>
<?php endif ?>


<p><?= $name ?></p>