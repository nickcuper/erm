<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientScript->registerScript('autocomplete-details','

    $(function(){
        $("#ajax-add-subordinates").click(function(){
            $.post("/employees/addsubordinates",{employee_id:$("#parent_id").val()}, function(){
                $.fn.yiiGridView.update("employee-grid");
            })
        });
    });

', CClientScript::POS_READY);?>
<br/><br/>
<?php
    $this->beginWidget('bootstrap.widgets.BsPanel', array(
        'title' => 'Elastic Search'
    ));
?>
<div class="col-xs-6">
<?php    $this->widget('CAutoComplete', array(
            'model' => 'Employees',
            'name' => 'first_name',
            'url' => array('/esearch/autocomplete'),
            'minChars' => 3,
            'matchCase'=>false,
            'value' => '',
            'htmlOptions' => array('class' => 'form-control'),
            #'methodChain'=>".result(function(event,item){\$(\"#parent_id\").val(item[1]);})",
    ));
?>
</div>
<?php

    echo BsHtml::linkButton('Update Index', array(
        'color' => BsHtml::BUTTON_COLOR_PRIMARY,
        'id' => 'ajax-add-subordinates'
    ));
    $this->endWidget();