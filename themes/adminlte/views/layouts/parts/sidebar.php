<?php

/* @var $this Controller */

$this->widget('bootstrap.widgets.BsNavbar', [
    'collapse'   => true,
    'brandLabel' => BsHtml::icon(BsHtml::GLYPHICON_HOME) . '&nbsp;' . Yii::app()->name . '&nbsp; Yii',
    'brandUrl'   => Yii::app()->homeUrl,
    'position'   => BsHtml::NAVBAR_POSITION_FIXED_TOP,
    'items'      => [
        [
            'class'           => 'bootstrap.widgets.BsNav',
            'type'            => 'navbar',
            'activateParents' => true,
            'items'           => [
                [
                    'label'   => 'Memcached',
                    'url'     => ['/memcached/index'],
                    'pull'    => BsHtml::NAVBAR_NAV_PULL_RIGHT,
                ],
                [
                    'label' => 'RabbitMQ',
                    'url'   => [ '/rmq/index'],
                    'pull'  => BsHtml::NAVBAR_NAV_PULL_RIGHT,
                ],
                [
                    'label' => 'ElasticSearch',
                    'url'   => [ '/esearch/index'],
                    'pull'  => BsHtml::NAVBAR_NAV_PULL_RIGHT,
                ],
            ],
            'htmlOptions'     => [
                'pull' => BsHtml::NAVBAR_NAV_PULL_LEFT
            ]
        ],
        [
            'class'           => 'bootstrap.widgets.BsNav',
            'type'            => 'navbar',
            'activateParents' => true,
            'items'           => [
                [
                    'label'   => 'Login',
                    'url'     => '/login',
                    'pull'    => BsHtml::NAVBAR_NAV_PULL_RIGHT,
                    'visible' => Yii::app()->user->isGuest
                ],
                [
                    'label'   => 'Logout (' . Yii::app()->user->name . ')',
                    'pull'    => BsHtml::NAVBAR_NAV_PULL_RIGHT,
                    'url'     => '/logout',
                    'visible' => !Yii::app()->user->isGuest
                ]
            ],
            'htmlOptions'     => [
                'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT
            ]
        ]
    ]
]);
