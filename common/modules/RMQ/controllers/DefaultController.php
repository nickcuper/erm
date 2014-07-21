<?php

class DefaultController extends WebController
{

         /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + create, read, delete', // we only allow deletion via POST request
			'ajaxOnly + create, read, delete', // we only allow deletion via POST request
		);
	}

        public function actionIndex()
        {
                $model = new RMQForm();

                $this->render('index',['model' => $model]);
        }

        public function actionCreate()
        {
                $model = $this->loadModel('create');

                $this->performAjaxValidation($model);

                if ($model->validate())
                    $model->createQueue();

                Yii::app()->end();
        }

        public function actionRead()
        {
                $model = $this->loadModel('search');

                echo CJSON::encode($model->search());
                Yii::app()->end();
        }

        public function actionDelete()
        {
               $model = $this->loadModel('delete');

                echo CJSON::encode($model->delete());
                Yii::app()->end();
        }

        /**
         * @param string $scenario
         * @return \RMQForm
         * @throws CHttpException
         */
        private function loadModel($scenario='')
        {
                if (!Yii::app()->request->getPost('RMQForm')) throw new CHttpException(404, 'Page not found');

                $model = new RMQForm($scenario);
                $model->attributes = Yii::app()->request->getPost('RMQForm');

                return $model;
        }

        /**
	 * Performs the AJAX validation.
	 * @param Employees $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='RMQ-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


}
