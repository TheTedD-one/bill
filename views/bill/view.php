<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Счета<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <?= Html::a('Добавить позицию', ['create-position'], ['class' => 'btn btn-success']) ?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#position_form_modal">Добавить позицию</button>
        </div>
    </div>

    <div class="panel-body">
        <div class="bill-index">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'is_deleted',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'created_date',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'modified_date',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'bill_id',
                        'enableSorting' => false
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<div id="position_form_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <?= $this->render('components/_position-create-form', [
            'positionModel' => $positionModel,
            'billModel' => $billModel,
        ]); ?>
    </div>
</div>