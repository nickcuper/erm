<?php

/**
 * Behavior that adds getListData method
 * @property-read array $listData
 * 
 * Simple attachment:
 * <code>
 * 'listDataBehavior' => array(
 *     'class' => 'ext.behaviors.ListDataBehavior',
 *     'idAttribute' => 'id',
 *     'labelAttribute' => 'name',
 *     'orderByLabel' => true,
 *     'useModels' => false,
 * ),
 * </code>
 * 
 * PhpDoc example:
 * <code>
 * @see ListDataBehavior
 * @property ListDataBehavior $listDataBehavior
 * @property-read array $listData
 * </code>
 * 
 */
class ListDataBehavior extends CActiveRecordBehavior
{
    public $idAttribute = 'id';
    public $labelAttribute = 'name';
    
    /**
     * True if you want results to be ordered by label.
     * @var boolean
     */
    public $orderByLabel = true;
    /**
     * @var boolean
     */
    public $useModels = false;


    /**
     * @var array list data cache
     */
    private static $_listData = array();
    
	/**
	 * @param CDbCriteria $criteria
	 * @return array id => name
	 */
	public function getListData($criteria = array())
	{
	    $key = get_class($this->owner);
        
        if ( !isset(self::$_listData[$key]) ) {
            self::$_listData[$key] = $this->_findListData($criteria);
	    }
	    
	    return self::$_listData[$key];
	}
    
	/**
	 * @param CActiveRecord[] $items
	 * @return array id => name
	 */
	public function arrayListData($items)
	{
        return CHtml::listData(
            $items,
            $this->idAttribute,
            $this->labelAttribute
        );
	}
    
    protected function _findListData($criteria)
    {
        if (!is_object($criteria))
            $criteria = new CDbCriteria($criteria);
        
        if ($this->orderByLabel) {
            if ($criteria->order)
                $criteria->order .= ', ' . $this->labelAttribute;
            else
                $criteria->order = $this->labelAttribute;
        }
        
        if ( $this->useModels )
            $items = $this->_findListDataUsingModels($criteria);
        else
            $items = $this->_findListDataUsingQuery($criteria);
        
        return $this->arrayListData($items);
    }
    
    protected function _findListDataUsingModels($criteria)
    {
        return $this->owner->findAll($criteria);
    }
    
    /**
     * 
     * @param CDbCriteria $criteria
     * @return array
     */
    protected function _findListDataUsingQuery($criteria)
    {
        $command = $this->getOwner()->getDbConnection()->createCommand();
        /* @var $command CDbCommand */
        
        $command
            ->select(array($this->idAttribute, $this->labelAttribute))
            ->from($this->owner->tableName() . ' ' . $criteria->alias);
        
        $command->where  = $criteria->condition;
        $command->order  = $criteria->order;
        $command->params = $criteria->params;
        
        return $command->queryAll();
    }
    
}
