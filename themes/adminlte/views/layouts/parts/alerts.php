<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?=Yii::app()->user->getFlash('error');?>
    </div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('info')): ?>
    <div class="alert alert-info alert-dismissable">
        <i class="fa fa-info"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?=Yii::app()->user->getFlash('info');?>
    </div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('warning')): ?>
    <div class="alert alert-warning alert-dismissable">
        <i class="fa fa-warning"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?=Yii::app()->user->getFlash('warning');?>
    </div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <i class="fa fa-check"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?=Yii::app()->user->getFlash('success');?>
    </div>
<?php endif; ?>
