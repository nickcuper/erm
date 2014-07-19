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
    Hint: You may login with <tt>demo/demo</tt>.
</p>

<?php
    echo BsHtml::submitButton('Login', array(
        'color' => BsHtml::BUTTON_COLOR_DEFAULT,
        'class' => 'btn-lg btn-primary btn-block'
    ));
?>

<?php $this->endWidget(); ?>
