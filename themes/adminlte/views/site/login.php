<?php
    $form = $this->beginWidget('BsActiveForm', array(
        'enableAjaxValidation' => true,
        'id' => 'login-form',
        'htmlOptions' => array(
            'class' => 'form-signin',
        )
    ));
?>

<?php echo $form->textFieldControlGroup($model, 'email'); ?>

<?php echo $form->passwordFieldControlGroup($model, 'password'); ?>

<p class="hint">
    <tt>admin@gmail.com/admin</tt>
    <tt>manager@gmail.com/manager</tt>
    <tt>demo1@gmail.com/demo</tt>
    <tt>demo2@gmail.com/demo</tt>
    <tt>demo3@gmail.com/demo</tt>
</p>

<?php
    echo BsHtml::submitButton('Login', array(
        'color' => BsHtml::BUTTON_COLOR_DEFAULT,
        'class' => 'btn-lg btn-primary btn-block'
    ));
?>

<?php $this->endWidget(); ?>
