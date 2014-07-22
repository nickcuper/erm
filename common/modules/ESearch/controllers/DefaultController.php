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
			'postOnly + stats', // we only allow deletion via POST request
			'ajaxOnly + stats', // we only allow deletion via AJAX request
		);
	}
        
	public function actionIndex()
	{
		$this->render('index',['model' => null]);
	}

	public function actionCreate()
	{
                $model=new ESForm('create');
                
                $this->performAjaxValidation($model);
                
                if (Yii::app()->request->isPostRequest) 
                {
                        $model->attributes = Yii::app()->request->getPost('ESForm');

                        if ($model->validate() && $model->create()) 
                        {
                                Yii::app()->user->setFlash('success', "Index was created");
                                Yii::app()->request->redirect(Yii::app()->createUrl('esearch/index'));
                        }
                }
                
		$this->render('edit',['model' => $model]);
	}
        
	public function actionDelete()
	{
                $model=new ESForm('delete');
                $model->id=Yii::app()->request->getPost('id');
                $model->delete();
                
		Yii::app()->end();
	}

        /**
         * Autocomplete
         * @link http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/search.html
         * @return string $list
         */
        public function actionAutocomplete()
        {
                $list='';
                
                if (isset($_GET['q']))
                {
                        $model=new ESForm('search');
                        $model->name= trim($_GET['q']);
                        
                        $results = $model->search();
                        
                        foreach ( $results['hits']['hits'] as $model)
                        {
                                $_data = $model['_source'];
                                $list .= $_data['FirstName'].' '.$_data['LastName'].'|'.$model['_id']."\n";
                        }
                }

                echo $list;
                Yii::app()->end();
        }
        
        /**
         * Return statistic by ElasticSearch
         * @link http://elasticsearch.org/guide/en/elasticsearch/client/php-api/current/_namespaces.html
         */
        public function actionStats() 
        {
                $client = new Elasticsearch\Client();
                
                // Index Stats
                // Corresponds to curl -XGET localhost:9200/_stats
                $response = $client->indices()->stats();
                print_r($response);
                // Node Stats
                // Corresponds to curl -XGET localhost:9200/_nodes/stats
                $response = $client->nodes()->stats();
                print_r($response);
                // Cluster Stats
                // Corresponds to curl -XGET localhost:9200/_cluster/stats
                $response = $client->cluster()->stats();
                print_r($response);
                
                Yii::app()->end();
        }
        
        /**
	 * Performs the AJAX validation.
	 * @param Employees $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='es-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}