<?php

use r567tw\phpmvc\form\Form;

$form = new Form();
?>
<h1>Register an account</h1>

<?php $form = Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'Name', 'name') ?>
<?php echo $form->field($model, 'Email', 'email')->emailField() ?>
<?php echo $form->field($model, 'Password', 'password')->passwordField() ?>
<?php echo $form->field($model, 'Reapeat Password', 'password_confirm')->passwordField() ?>

<button class="btn btn-success">Submit</button>
<?= r567tw\phpmvc\form\Form::end() ?>