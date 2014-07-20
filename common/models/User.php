<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $passwordHash
 * @property string $created
 * @property string $role
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 *
 * @property PasswordBehavior $passwordBehavior
 * @property string $password
 */
class User extends CActiveRecord
{

    const NAME_ATTR = 'name';

    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            return [
                    ['email', 'required'],
                    ['email', 'length', 'max' => 254],
                    ['email', 'email'],
                    ['email', 'unique'],
                    ['password', 'safe', 'on' => 'register, profile, admin'],

                    ['passwordHash', 'unsafe'],

                    ['role', 'unsafe', 'except' => 'admin, search'],
                    // The following rule is used by search().
                    ['id, email, created, role', 'safe', 'on' => 'search'],
            ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            return [
                    'comments' => array(self::HAS_MANY, 'Comment', 'userId'),
            ];
    }

    public function behaviors()
    {
            return [
                    'passwordBehavior' => 'PasswordBehavior',
            ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return [
                'id'           => 'ID',
                'email'        => 'Email',
                'passwordHash' => 'Password',
                'created'      => 'Created',
                'role'         => 'Role',
            ];
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return boolean
     */
    public function isUser()
    {
            return $this->role === self::ROLE_USER;
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail($email)
    {
            return $this->findByAttributes(array(
                'email' => $email,
            ));
    }
}
