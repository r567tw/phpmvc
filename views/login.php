<?php

use r567tw\phpmvc\form\Form;

$form = new Form();
?>
<h1>Login</h1>
<?php $form = Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'Email', 'email')->emailField() ?>
<?php echo $form->field($model, 'Password', 'password')->passwordField() ?>
<button type="submit" class="btn btn-primary">Login</button>
<?= r567tw\phpmvc\form\Form::end() ?>