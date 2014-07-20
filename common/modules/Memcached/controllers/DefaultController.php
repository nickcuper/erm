<?php

class DefaultController extends WebController
{
        private $modelClass = 'Comment';

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

                $model = ActiveRecord::model($this->modelClass)
                    ->cache(60*60*24, new CacheTags($this->modelClass))
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

        public function actionCreateTest()
	{
            for ($i=1;$i<100;$i++) {
                $mComment = new Comment;
                $mComment->userId = rand(14,18);
                $mComment->text = $this->generateRandomString(rand(50,180));
                $mComment->created = date('Y-m-d H:i:s');
                $mComment->save();
            }
		#$this->render('index', ['model' => $mComment]);
	}

        private function generateRandomString($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }
}