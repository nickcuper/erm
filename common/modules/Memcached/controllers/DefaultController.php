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
			'postOnly + delete', // we only allow deletion via POST request
			#'ajaxOnly + ', // we only allow deletion via POST request
		);
	}

        /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
                $model = new Comment('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

                $dataProvider = $model->search();

		$this->render('index', [
                        'model' => $dataProvider
                ]);
	}

        /**
         * @return ActiveRecord
         */
        protected function loadModel()
        {
                $id = Yii::app()->request->getParam('id');

                $model = Comment::model()
                    ->cache(60*60*24, new CacheTags('Comment-'.$id))
                    ->findByPk($id);

                if ($model === null)
                    throw new CHttpException(404, 'Page not found');

                return $model;
        }

        /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'memcached' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel()->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('memcached/index'));
	}

        /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                $model = $this->loadModel();

		$this->render('view',[
			'model'=>$model,
		]);
	}

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                $model=new Comment();

		if (isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];

                        if ($model->validate() && $model->save())
                                $this->redirect(array('view','id'=>$model->employee_id));
		}

		$this->render('create', [
			'model'=>$model,
		]);
	}

        /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        
}