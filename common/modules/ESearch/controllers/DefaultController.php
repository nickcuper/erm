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
                print_r($data);
		$this->render('index');
	}

	public function actionCreate()
	{
            




		$this->render('index');
	}
}