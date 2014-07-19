<?php

/**
 * @property-read User $model
 *
 * @property string $email
 * @property string $role
 */
class WebUser extends CWebUser
{

    /** @var array[] Name of user model attributes that are saved as states. */
    public $stateAttributes = ['id', 'email', 'role'];

    /** @var User */
    protected $_model;

    /**
     * @return User
     */
    public function getModel()
    {
            if (!$this->getIsGuest() && $this->_model === null)
            {
                    $this->_model = User::model()
                            ->cache(60 * 60 * 24, new CacheTags('User-' . $this->role))
                        ->findByPk($this->id);
            }

            return $this->_model;
    }

    /**
     * @param User $model
     */
    public function setModel($model)
    {
            $this->setId($model->id);
            $this->_model = $model;
            $attributes = $model->getAttributes($this->stateAttributes);
            $flipped = array_flip($attributes);
            array_walk($flipped, [$this, 'setState']);
    }

    public function clearModel()
    {
            $this->setId(null);
            $this->_model = null;
            $this->clearStates();
    }

    public function setId($value)
    {
            parent::setId($value);
            $this->_model = null;
    }

    public function isManager()
    {
            return !$this->isGuest && $this->role === User::ROLE_MANAGER;
    }

}
