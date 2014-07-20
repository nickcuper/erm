<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Comment List</h1>

<?php $this->renderPartial('_grid', array('dataProvider' => $model)); ?>
