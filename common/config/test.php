<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'cache' => array(
			    'class' => 'CDummyCache',
			),
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'httpclient'=>array(
				'class' => 'HttpClient',
			),
		),
	)
);
