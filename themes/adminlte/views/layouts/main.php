<?php
/* @var $this Controller */

Yii::app()->clientScript
        ->registerPackage('jquery')
        ->registerPackage('font-awesome')
        ->registerPackage('adminlte');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $this->pageTitle ?> | <?= Yii::app()->name ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php
        $this->renderPartial('//layouts/parts/sidebar');
        ?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1><?= $this->pageTitle ?></h1>
                <?php
                if (isset($this->breadcrumbs))
                {
                    $this->widget('BsBreadcrumb', array(
                        'links' => $this->breadcrumbs,
                    ));
                }
                ?>
            </section>

            <!-- Main content -->
            <section class="content">
                <?php $this->renderPartial('//layouts/parts/alerts'); ?>
                <?= $content ?>
            </section><!-- /.content -->

        </div><!-- ./wrapper -->
    </body>
</html>