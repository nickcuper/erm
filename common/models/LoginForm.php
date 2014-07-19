<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $rememberMe;
    
	public $requiredRole;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			['email, password', 'required'],
			// rememberMe needs to be a boolean
			['rememberMe', 'boolean'],
			// password needs to be authenticated
			['password', 'authenticate'],
			['email', 'checkRole'],
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate()
	{
		if ($this->hasErrors())
            return; // There are errors already
		
        $identity = $this->getIdentity();
        if ($identity->ok)
            return; // Authenticate successfully
        
        if (!YII_DEBUG) {
            $this->addError('password','Incorrect email or password.');

        } else {
            switch ($identity->errorCode) {
                case UserIdentity::ERROR_USERNAME_INVALID:
                    $this->addError('email', 'Invalid email.');
                    break;

                case UserIdentity::ERROR_PASSWORD_INVALID:
                    $this->addError('email', 'Invalid password.');
                    break;

                default:
                    $this->addError('password', 'Unknown UserIdenitity error.');
                    break;
            }
        }
	}

    public function checkRole()
    {
		if ($this->hasErrors())
            return; // There are errors already
		
        if ($this->requiredRole && $this->getIdentity()->user->role !== $this->requiredRole)
            $this->addError('email', 'You have no access to this application.');
    }
    
	/**
	 * Logs in the user using the given email and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
        $identity = $this->getIdentity();
        if ($identity->ok) {
			$duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->getIdentity(), $duration);
			return true;
            
		} else
			return false;
	}
    
    /**
     * 
     * @return UserIdentity
     */
    protected function getIdentity()
    {
        if ($this->_identity !== null)
            return $this->_identity;
        
        $this->_identity = new UserIdentity($this->email, $this->password);
        $this->_identity->authenticate();
        
        return $this->_identity;
    }
}
