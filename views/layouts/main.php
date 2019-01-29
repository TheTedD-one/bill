<?php

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerCsrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Main navbar -->
    <?= $this->render('components/_header'); ?>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?= $this->render('components/_sidebar'); ?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
                    </div>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <?= $content ?>

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
