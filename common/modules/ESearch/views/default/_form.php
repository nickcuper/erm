<?php
/* @var $this DefaultController */
/* @var $model RMQForm */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'es-form',
        'action' =>'/esearch/create',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->textFieldControlGroup($model, 'FirstName'); ?>
    <?php echo $form->textFieldControlGroup($model, 'LastName'); ?>
    <?php echo $form->textFieldControlGroup($model, 'Gender'); ?>
    <?php echo $form->textFieldControlGroup($model, 'Age'); ?>

    <?php
        echo BsHtml::submitButton( ($model->id) ? 'Update' : 'Add',
                [
                    'color' => BsHtml::BUTTON_COLOR_DEFAULT
                ]
        );
    ?>
<?php $this->endWidget(); ?>

</div><!-- form -->