<?php
/* @var $this EmployeesController */
/* @var $model Employees */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'employees-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textAreaControlGroup($model, 'text', array('rows' => 6, 'cols' => 50)); ?>

    <?php
    echo BsHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
        'color' => BsHtml::BUTTON_COLOR_PRIMARY
    ));
    ?>

<?php $this->endWidget(); ?>

</div><!-- form -->