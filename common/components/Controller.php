<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl',
		);
	}
    
    public function getPageTitle()
    {
        return str_replace(Yii::app()->name.' - ', '', parent::getPageTitle());
    }
}