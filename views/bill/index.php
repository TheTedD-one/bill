<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счета';
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
            <?php Pjax::begin([ 'id' => 'pjax-bill-list']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'layout' => "{summary}\n{items}\n<div class='grid-pagination' align='right'>{pager}</div>",
                'columns' => [
                    [
                        'attribute' => 'id',
                        'label' => 'Счет №',
                        'enableSorting' => false
                    ],
                    [
                        'label' => 'Получатель',
                        'value' => function ($model) {
                            return $model->customer->name . ' (БИН: ' . $model->customer->bin . ')';
                        }
                    ],
                    [
                        'attribute' => 'created_date',
                        'label' => 'Дата',
                        'enableSorting' => false
                    ],
                    [
                        'label' => 'Кол-во позиций',
                        'value' => function ($model) {
                            return $model->positionCount;
                        }
                    ],

                    [
                        'class' => '\yii\grid\ActionColumn',
                        'template' => '{view}{edit}{delete}',
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
                                        'class' => 'list-icons-item update-button grid-icons',
                                        'attr-id' => $model->id
                                    ]
                                );
                            },
                            'delete' => function($url, $model) {
                                return Html::a(
                                    '<i class="icon-trash"></i>',
                                    '#',
                                    [
                                        'class' => 'list-icons-item delete-button grid-icons',
                                        'attr-id' => $model->id,
                                        'attr-url' => '/bill/delete-bill',
                                        'attr-pjax-id' => 'pjax-bill-list',
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

<div id="bill_form_modal" class="modal fade">
    <div class="modal-dialog">
        <?= $this->render('components/_bill-form', [
            'model' => $model,
        ]); ?>
    </div>
</div>

<?php
$script = <<<JS
    deleteAction();
    $(document).on('pjax:success', function() {
       deleteAction();
    });
JS;

$this->registerJs($script);
?>