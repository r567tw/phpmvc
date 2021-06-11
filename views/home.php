<?php
use app\core\Application;
?>
<h1>Hello My framework</h1>
<?php if (Application::$app->session->getFlash('success')): ?>
    <div class="alert alert-success">
        <?=Application::$app->session->getFlash('success')?>
    </div>
<?php endif ?>

<p><?=$name?></p>