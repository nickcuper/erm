<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = 'Error ' . $code;
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="callout callout-danger">
    <h4><?=CHtml::encode($message)?></h4>
    <?php
    if (YII_DEBUG || $this->isAdmin) {
        echo
            'At ' . $file . ': ' . $line .
            '<pre>' . $trace . '</pre>';
    }
    ?>
</div>
