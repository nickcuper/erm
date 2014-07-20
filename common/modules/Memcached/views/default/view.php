<?php
/* @var $this EmployeesController */
/* @var $model Employees */

$this->breadcrumbs = array(
    'Comment' => array('index'),
    $model->id,
);
?>

<?php
$this->widget('bootstrap.widgets.BsDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'text',
        'created',
    ),
));
?>
