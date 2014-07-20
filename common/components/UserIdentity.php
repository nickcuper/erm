<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 *
 * @property-read boolean $ok
 */
class UserIdentity extends CUserIdentity
{

    /**
     * @var User
     */
    public $user;

    public function authenticate()
    {
            $this->user = $user = User::model()->findByEmail($this->username);

            if (!$user)
            {
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
            elseif (!$user->passwordIs($this->password))
            {
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
            else
            {
                    $this->errorCode = self::ERROR_NONE;

                    $states = $user->getAttributes(Yii::app()->user->stateAttributes);
                    $this->setPersistentStates($states);
            }

            return !$this->errorCode;
    }

    public function getOk()
    {
            return $this->errorCode === self::ERROR_NONE;
            ;
    }

}
