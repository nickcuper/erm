<?php

$buttons = [
        'update' => [
                'imageUrl' => false,
                'label' => '<button type="button" class="btn btn-sm"><span class="glyphicon glyphicon-cog"></span> Update</button>',
                'visible' => '!Yii::app()->user->isGuest',
        ],
        'delete' => [
                'imageUrl' => false,
                'label' => '<button type="button" class="btn btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</button>',
                'visible' => '!Yii::app()->user->isGuest',
        ],
        'view' => [
                'imageUrl' => false,
                'label' => '<button type="button" class="btn btn-sm"><span class="glyphicon glyphicon-cog"></span> View</button>',
        ]
];

$this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'employee-grid',
    'type' => BsHtml::GRID_TYPE_HOVER,
    'columns' => [
        'id',
        /*[
                'header' => 'Author',
                'name' => 'userId',
                'value' => '$data->user->email',
        ],*/
        [
                'header' => 'text',
                'name' => 'text',
                'value' => 'mb_substr($data->text, 0, 50)."..."',
        ],
        'created',
        [
                'header' => 'Actions',
                'class' => 'CButtonColumn',
                'template' => '{update} {view} {delete}',
                'buttons' => $buttons
        ],
    ],
    'pager' => ['class' => 'bootstrap.widgets.BsPager', 'size' => BsHtml::PAGINATION_SIZE_DEFAULT],
));