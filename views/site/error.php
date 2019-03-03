<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
Yii::$app->layout = 'service';
?>

<!-- Error title -->
<div class="text-center content-group">
    <h1 class="error-title"><?= Html::encode($exception->statusCode) ?></h1>
    <h5><?= nl2br(Html::encode($message)) ?></h5>
</div>
<!-- /error title -->


<!-- Error content -->
<div class="row">
    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
        <div class="row">
            <div class="col-sm-12">
                <a href="<?= Url::to('/') ?>" class="btn btn-primary btn-block content-group"><i
                            class="icon-circle-left2 position-left"></i> На главную</a>
            </div>
        </div>
    </div>
</div>
<!-- /error wrapper -->
