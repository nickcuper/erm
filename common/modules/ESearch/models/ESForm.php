<?php

/**
 * ESForm class.
 * ESForm is the data structure for keeping
 * user elastic search form data. It is used by the action of 'ESearch Module'.
 */
class ESForm extends CFormModel
{
        const ES_INDEX='erm';
        const ES_TYPE='erm_type';


        /** @var string $FirstName */
	public $FirstName;

        /** @var string $LastName */
	public $LastName;

        /** @var string $Gender */
	public $Gender;

        /** @var int $Age */
	public $Age;

        /** @var mixed $id  Id*/
	public $id;

        /** @var string $name Use for search */
	public $name;


        /** @var array $_params List of main params ES */
        private $_params = [
                'index' => self::ES_INDEX,
                'type' => self::ES_TYPE,
            ];

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
			// LastName and FirstName are required
			['LastName, FirstName', 'required', 'on'=>['create']],

			['LastName, FirstName, Age, Gender, id, name', 'safe', 'on'=>[
                                                        'search',
                                                        'delete',
                                                ]
                        ],
		];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'LastName'=>'Last Name',
			'FirstName'=>'First Name',
			'Age'=>'Age',
			'Gender'=>'Gender',
		];
	}

        public function create()
        {
                $client = new Elasticsearch\Client();

                $params['body']  = [
                        'FirstName' => $this->FirstName,
                        'LastName' => $this->LastName,
                        'Age' => $this->Age,
                        'Gender' => $this->Gender,
                ];
                $params = array_merge($params, $this->getParams());

                $isCreate = $client->index($params);

                return (bool)$isCreate['created'];
        }

        public function search()
        {
                $client = new Elasticsearch\Client();

                $params['body']['query']['fuzzy_like_this']= [
                    'fields' => ['FirstName', 'LastName'],
                    'like_text'=> $this->name,
                    'max_query_terms'=>12
                ];
                $params = array_merge($params, $this->getParams());

                return $client->search($params);
        }

        public function delete()
        {
                $client = new Elasticsearch\Client();

                $params['id'] = $this->id;
                $params = array_merge($params, $this->getParams());

                $client->delete($params);
        }

        /**
         * Return list of params
         * @param string $type
         * @return mixed
         */
        public function getParams($type='')
        {
                return ($type && isset($this->_params[$type])) ?
                            $this->_params[$type] : $this->_params;
        }
}
