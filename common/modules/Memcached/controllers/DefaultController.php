<?php

class DefaultController extends WebController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}