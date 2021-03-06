<?php

abstract class ActiveRecord extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ActiveRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return \CActiveDataProvider
     */
    abstract public function search();

    # Events #

    public function beforeSave()
    {

            if (!parent::beforeSave())
                return false;


            // Not using behavior because we're using this string after saving
            // and we need date in string, not CDbExpression('NOW()')
            if ($this->isNewRecord && $this->hasAttribute('created'))
                $this->created = date('Y-m-d H:i:s');

            if ($this->isNewRecord && $this->hasAttribute('userId'))
                    $this->created = Yii::app()->user->id;

            return true;
    }

    public function afterSave()
    {
            parent::afterSave();
            $this->onChange();
    }

    public function afterDelete()
    {
            parent::afterDelete();
            $this->onChange();
    }

    public function onChange()
    {
            $class = get_class($this);
            Yii::app()->cache->clear([$class, $class . '-' . $this->id]);
    }
}
