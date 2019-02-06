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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#position_form_modal">Добавить позицию</button>
        </div>
    </div>

    <div class="panel-body">
        <div class="bill-index">
            <?php Pjax::begin([ 'id' => 'pjax-position-list']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{summary}\n{items}\n<div class='grid-pagination' align='right'>{pager}</div>",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'name',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'unit',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'quantity',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'price',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'total_price_without_tax',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'tax_rate',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'tax_sum',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'total_price',
                        'enableSorting' => false
                    ],

                    [
                        'class' => '\yii\grid\ActionColumn',
                        'template' => '{edit}',
                        'buttons' => [
                            'edit' => function($url, $model) {
                                return Html::a(
                                    '<i class="icon-pencil"></i>',
                                    '#',
                                    [
                                        'class' => 'list-icons-item update-button',
                                        'attr-id' => $model->id
                                    ]
                                );
                            }
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<div id="position_form_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <?= $this->render('components/_position-form', [
            'positionModel' => $positionModel,
            'billModel' => $billModel,
        ]); ?>
    </div>
</div>