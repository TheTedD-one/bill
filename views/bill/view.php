<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = 'Счет №' . $billModel->id;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Информация о счете<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Поставщик</h6>
            </div>
            <div class="col-md-6">
                <h6>Получатель</h6>
                <span class="text-size-small text-muted">Наименование: </span><span class="text-size-small"><?= $billModel->customer->name ?></span><br>
                <span class="text-size-small text-muted">БИН: </span><span class="text-size-small"><?= $billModel->customer->bin ?></span>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Позиции<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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