<?php

class SiteController extends WebController
{
	public function accessRules()
	{
                return array_merge([
                    ['allow',
                            'actions' => ['error'],
                    ],
                ], parent::accessRules());
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return [
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>[
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			],
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>[
				'class'=>'CViewAction',
			],
		];
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
                if ($error=Yii::app()->errorHandler->error)
                {
                    if(Yii::app()->request->isAjaxRequest)
                            echo $error['message'];
                    else
                            $this->render('error', $error);
                }
	}

        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',['model'=>$model]);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionCreateUser()
	{
		$userAdmin = new User('register');
                $userAdmin->email = 'admin@gmail.com';
                $userAdmin->password = 'admin';
                $userAdmin->role = User::ROLE_ADMIN;
                $userAdmin->save();

		$userManager = new User('register');
                $userManager->email = 'manager@gmail.com';
                $userManager->password = 'manager';
                $userManager->role = User::ROLE_MANAGER;
                $userManager->save();

		$user_1 = new User('register');
                $user_1->email = 'demo1@gmail.com';
                $user_1->password = 'demo';
                $user_1->role = User::ROLE_USER;
                $user_1->save();

		$user_2 = new User('register');
                $user_2->email = 'demo2@gmail.com';
                $user_2->password = 'demo';
                $user_2->role = User::ROLE_USER;
                $user_2->save();

		$user_3 = new User('register');
                $user_3->email = 'demo3@gmail.com';
                $user_3->password = 'demo';
                $user_3->role = User::ROLE_USER;
                $user_3->save();
	}
}
