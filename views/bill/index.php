<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bills';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Счета<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bill_form_modal">Создать новый счет</button>
        </div>
    </div>

    <div class="panel-body">
        <div class="bill-index">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

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
                        'class' => '\yii\grid\ActionColumn',
                        'template' => '{view}{edit}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a(
                                    '<i class="icon-file-eye"></i>',
                                    \yii\helpers\Url::to(['view', 'bill_id' => $model->id]),
                                    [
                                        'class' => 'list-icons-item grid-icons',
                                    ]
                                );
                            },
                            'edit' => function($url, $model) {
                                return Html::a(
                                    '<i class="icon-pencil"></i>',
                                    '#',
                                    [
                                        'class' => 'list-icons-item',
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

<div id="bill_form_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <?= $this->render('components/_bill-form', [
            'model' => $model,
        ]); ?>
    </div>
</div>