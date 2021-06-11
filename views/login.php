<?php

use app\core\form\Form;

$form = new Form();
?>
<h1>Login</h1>
<?php $form = Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'Email', 'email')->emailField() ?>
<?php echo $form->field($model, 'Password', 'password')->passwordField() ?>
<button type="submit" class="btn btn-primary">Login</button>
<?= app\core\form\Form::end() ?>