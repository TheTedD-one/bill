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
            <?= Html::a('Создать новый счет', ['create-bill'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <div class="panel-body">
        <div class="bill-index">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a(
                                    '<i class="icon-file-eye2"></i>',
                                    \yii\helpers\Url::to(['view', 'bill_id' => $model->id]),
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