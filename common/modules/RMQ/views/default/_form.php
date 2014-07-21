<?php
/* @var $this DefaultController */
/* @var $model RMQForm */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'RMQ-form',
        'action' =>'/rmq/create',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->textFieldControlGroup($model, 'queue'); ?>
    <?php echo $form->textAreaControlGroup($model, 'text', array('rows' => 6, 'cols' => 50)); ?>

    <div class="btn-group">
        <?php
            echo BsHtml::ajaxSubmitButton('Send','/rmq/create',
                    [
                        ''
                    ],
                    [
                        'color' => BsHtml::BUTTON_COLOR_DEFAULT
                    ]
            );

            echo BsHtml::ajaxSubmitButton('Read','/rmq/read',
                    [
                        'success' => 'js:function(data) {
                                if (data)
                                {
                                        obj = JSON.parse(data);
                                        if (obj)
                                        {
                                                $("#countMessage").html(obj.delivery_info.message_count);
                                                $("#bodyMessage").html(obj.body);
                                        }

                                        $("#rmqResult code").html(data);
                                }
                        }',
                    ],
                    [
                        'color' => BsHtml::BUTTON_COLOR_INFO
                    ]
            );

            echo BsHtml::ajaxSubmitButton('Delete','/rmq/delete',
                    [

                    ],
                    [
                        'color' => BsHtml::BUTTON_COLOR_DANGER
                    ]
            );
        ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->

