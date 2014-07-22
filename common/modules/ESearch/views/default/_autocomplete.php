<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<?php
    $this->beginWidget('bootstrap.widgets.BsPanel', [
        'title' => 'Elastic Search'
    ]);
?>
<div class="col-xs-7">
<?php    
    $this->widget('CAutoComplete', [
            'model' => 'Employees',
            'name' => 'first_name',
            'url' => ['/esearch/autocomplete'],
            'minChars' => 3,
            'matchCase'=>false,
            'value' => '',
            'htmlOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'First or Last Name'
            ],
            'methodChain'=>".result(function(event,item){\$(\"#_id\").val(item[1]);})",
    ]);
    
    echo CHtml::hiddenField('_id');
?>
</div>
<div class="btn-group">
<?php
    echo BsHtml::linkButton('Add Index',
                    
                    [
                        'url' => '/esearch/create',
                        'color' => BsHtml::BUTTON_COLOR_DEFAULT
                    ]
            );
    
    echo BsHtml::ajaxSubmitButton('Delete Index','/esearch/delete',
                    [
                        'data'=>'js:{id:$("#_id").val()}',
                        'success'=>'js:function(data){
                                $("#first_name").val("");
                                $("#_id").val("");
                        }',
                    ],
                    [
                        'color' => BsHtml::BUTTON_COLOR_DANGER
                    ]
            );
    echo BsHtml::ajaxSubmitButton('Get STATS','/esearch/stats',
                    [
                        'success' => 'js:function(data) {
                            console.log(window.location);
                                if (data)
                                {
                                        $("#result").html(data);
                                }
                        }',
                    ],
                    [
                        'color' => BsHtml::BUTTON_COLOR_INFO
                    ]
            );
?>
</div>
<?php
    $this->endWidget();