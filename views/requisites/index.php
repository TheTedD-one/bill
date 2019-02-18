<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Реквизиты';
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Реквизиты<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#requisites_form_modal">Создать новый реквизит</button>
        </div>
    </div>

    <div class="panel-body">
        <div class="bill-index">
            <?php Pjax::begin([ 'id' => 'pjax-requisites-list']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'layout' => "{summary}\n{items}\n<div class='grid-pagination' align='right'>{pager}</div>",
                'columns' => [
                    [
                        'attribute' => 'name',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'bin',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'address',
                        'enableSorting' => false
                    ],
                    [
                        'attribute' => 'iik',
                        'enableSorting' => false
                    ],

                    [
                        'class' => '\yii\grid\ActionColumn',
                        'template' => '{edit}{delete}',
                        'buttons' => [
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
                                        'attr-url' => '/requisites/delete',
                                        'attr-pjax-id' => 'pjax-requisites-list',
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

<div id="requisites_form_modal" class="modal fade">
    <div class="modal-dialog">
        <?= $this->render('components/_form', [
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
