<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<?php $this->renderPartial('_autocomplete',['model'=>$model])?>

<?php
var_dump($model);
?>