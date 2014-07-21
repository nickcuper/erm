<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
?>

<h1>RabbitMQ</h1>

<?php $this->renderPartial('_form', ['model' => $model]) ?>
<br>
<br>
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Result Request to RabbitMQ Server [Count Message In Queue <b id="countMessage"></b>]
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="rmqResult">
                Current Message: <b id="bodyMessage"></b>
                <pre>

                    <code></code>
                </pre>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
</div>
</div>