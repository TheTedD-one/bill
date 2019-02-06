<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequisitesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requisites-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'is_deleted') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'modified_date') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'bin') ?>

    <?php // echo $form->field($model, 'iik') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'isMe') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
