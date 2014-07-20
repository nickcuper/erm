<?php

/**
 * Password helper behavior.
 * It provides virtual attribute "password" as wrapper to model's password.
 */
class PasswordBehavior extends CBehavior
{
    public $hashAttribute = 'passwordHash';
    
    /**
     * Returns empty string.
     */
    public function getPassword()
    {
        return '';
    }
    
    /**
     * Encodes and sets password
     * @param string $password
     */
    public function setPassword($password)
    {
        if (!empty($password)) {
            $hash = CPasswordHelper::hashPassword($password);
            $this->getOwner()->{$this->hashAttribute} = $hash;
        }
    }
    
    /**
     * Verifies password
     * @param string $password
     * @return boolean
     */
    public function passwordIs($password)
    {
        $hash = $this->getOwner()->{$this->hashAttribute};
        return CPasswordHelper::verifyPassword($password, $hash);
    }
}

/**
 * @property PasswordBehavior $passwordBehavior
 * @property string $password
 * @method boolean passwordIs($password)
 */
