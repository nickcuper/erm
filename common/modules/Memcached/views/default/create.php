<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Comment'=>array('index'),
	'Create',
);

?>

<h1>Create Comment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>