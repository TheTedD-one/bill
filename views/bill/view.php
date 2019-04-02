<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = 'Счет №' . $billModel->id;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="panel panel-white panel-collapsed">
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
                <ul class="media-list media-list-bordered">
                    <li class="media-header">Поставщик</li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Наименование: </span><span class="text-size-small"><?= $billModel->me->name ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИН: </span><span class="text-size-small"><?= $billModel->me->bin ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Банк: </span><span class="text-size-small"><?= $billModel->me->bank ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">ИИК: </span><span class="text-size-small"><?= $billModel->me->iik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИК: </span><span class="text-size-small"><?= $billModel->me->bik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Адрес: </span><span class="text-size-small"><?= $billModel->me->address ?></span>
                        </div>
                    </li>

                    <li class="media-header">Грузоотправитель</li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Наименование: </span><span class="text-size-small"><?= $billModel->sender->name ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИН: </span><span class="text-size-small"><?= $billModel->sender->bin ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Банк: </span><span class="text-size-small"><?= $billModel->sender->bank ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">ИИК: </span><span class="text-size-small"><?= $billModel->sender->iik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИК: </span><span class="text-size-small"><?= $billModel->sender->bik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Адрес: </span><span class="text-size-small"><?= $billModel->sender->address ?></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="media-list media-list-bordered">
                    <li class="media-header">Получатель</li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Наименование: </span><span class="text-size-small"><?= $billModel->customer->name ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИН: </span><span class="text-size-small"><?= $billModel->customer->bin ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Банк: </span><span class="text-size-small"><?= $billModel->customer->bank ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">ИИК: </span><span class="text-size-small"><?= $billModel->customer->iik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИК: </span><span class="text-size-small"><?= $billModel->customer->bik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Адрес: </span><span class="text-size-small"><?= $billModel->customer->address ?></span>
                        </div>
                    </li>

                    <li class="media-header">Грузополучатель</li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Наименование: </span><span class="text-size-small"><?= $billModel->recipient->name ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИН: </span><span class="text-size-small"><?= $billModel->recipient->bin ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Банк: </span><span class="text-size-small"><?= $billModel->recipient->bank ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">ИИК: </span><span class="text-size-small"><?= $billModel->recipient->iik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">БИК: </span><span class="text-size-small"><?= $billModel->recipient->bik ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Адрес: </span><span class="text-size-small"><?= $billModel->recipient->address ?></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <ul class="media-list media-list-bordered">
                    <li class="media-header">Оплата и доставка</li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Договор на поставку: </span><span class="text-size-small"><?= $billModel->contract_type ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Условия оплаты: </span><span class="text-size-small"><?= $billModel->payment_type ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Способ отправления: </span><span class="text-size-small"><?= $billModel->delivery_type ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Пункт назначения: </span><span class="text-size-small"><?= $billModel->delivery_point ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Довереность на поставку товаров: </span><span class="text-size-small"><?= $billModel->delivery_document ?></span>
                        </div>
                    </li>
                    <li class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <span class="text-size-small text-muted">Товарно-транспортная накладная: </span><span class="text-size-small"><?= $billModel->transport_document ?></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Позиции<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <div class="btn-group" style="margin-right: 4px">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Счет на оплату <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?= Url::to(['/pdf/payment', 'id' => $billModel->id]) ?>" target="_blank">
                            <i class="icon-file-eye"></i> Просмотреть</a>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#payment_send_modal"><i class="icon-envelop3"></i> Отправить</a></li>
                </ul>
            </div>
            <a href="<?= Url::to(['/pdf/invoice', 'id' => $billModel->id]) ?>"
               class="btn btn-primary"
               target="_blank"
            >
                Счет-фактура
            </a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#position_form_modal">Добавить позицию</button>
        </div>
    </div>

    <div class="panel-body">
        <div class="bill-index">
            <?php Pjax::begin([ 'id' => 'pjax-position-list']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'layout' => "{summary}\n{items}\n<div class='grid-pagination' align='right'>{pager}</div>",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'name',
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
                                        'attr-url' => '/bill/delete-position',
                                        'attr-pjax-id' => 'pjax-position-list',
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

<div id="payment_send_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <?= $this->render('components/_payment-send-form', [
            'billModel' => $billModel,
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