<?php

class DefaultController extends WebController
{

	public function actionIndex()
	{
                $elastica_query = new Elastica\Query();
                $term_filter = new Elastica\Filter\Term();
                $term_filter->setTerm('firstname','Stepan');

                $elastica_query->setFilter($term_filter);

                $dataprovider =  new ElasticaDataProvider('habrahabr', $elastica_query, array(
                    'sort' => array(
                        'attributes' => array('firstname.desc',),
                    ),
                  'pagination' => array(
                    'pageSize' => 30,
                  ),
                ),'users');

                $data = $dataprovider->getData();


                $client = new Elasticsearch\Client();
                $params = array();
                /*$params['body']  = array('testField' => 'abc');
                $params['index'] = 'my_index';
                $params['type']  = 'my_type';
                $params['id']    = 'my_id';
                $ret = $client->index($params);*/

                $params['index'] = 'my_index';
            $params['type']  = 'my_type';
            $params['body']['query']['match']['testField'] = 'abc';

            $results = $client->search($params);


		$this->render('index',['model' => $results]);
	}

	public function actionCreate()
	{


		$this->render('index');
	}

        /**
         * Autocomplete
         * @return string $list
         */
        public function actionAutocomplete()
        {
                $list ='';

                if (isset($_GET['q']))
                {
                        $name = $_GET['q'];
                        /**
                         * Criteria search heare
                         */


                        /*foreach ( $emplArray as $model)
                        {
                            $list .= $model->first_name.' '.$model->last_name.'|'.$model->employee_id. "\n";
                        }*/
                }

                echo $list;
                Yii::app()->end();
        }
}