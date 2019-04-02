<?php

use app\helpers\SumHelper;

?>
<table class="table table-bordered table-font-size13" style="vertical-align: top;">
    <tr>
        <td>
            <strong>Бенефициар:</strong>: <br>
            <?= $model->me->name ?> <br>
            <?= 'БИН: ' . $model->me->bin ?>
        </td>
        <td>
            <strong>ИИК:</strong> <br>
            <?= $model->me->iik ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Банк бенефициара:</strong> <br>
            <?= $model->me->bank ?>
        </td>
        <td>
            <strong>БИК:</strong> <br>
            <?= $model->me->bik ?>
        </td>
    </tr>
</table>

<h5 class="text-center" style="font-size: 13px;">
    <strong>
        Счет на оплату № <u class=""><?= $model->id ?></u>
        от <u><?= date('d.m.Y', strtotime($model->created_date)) ?></u>
    </strong>
</h5>

<hr style="margin-top: 5px; margin-bottom: 5px;">

<table class="table table-font-size13">
    <tr>
        <td class="" style="padding-top: 10px">
            <strong>Поставщик: </strong>
            <?= $model->me->name ?>
        </td>
    </tr>
    <tr>
        <td class="">
            <strong>Покупатель: </strong>
            <?= $model->customer->name ?>
        </td>
    </tr>
</table>

<table class="table table-bordered text-center table-font-size13">
    <tr>
        <td><strong>№</strong></td>
        <td><strong>Товары (работы, услуги)</strong></td>
        <td><strong>Кол-во</strong></td>
        <td><strong>Ед.</strong></td>
        <td><strong>Цена</strong></td>
        <td><strong>Сумма</strong></td>
    </tr>

    <?php foreach($model->position as $key => $position): ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $position->name ?></td>
            <td><?= $position->quantity ?></td>
            <td><?= \app\models\Position::getUnitList()[$position->unit] ?></td>
            <td><?= number_format((float)$position->price, 2, '.', ''); ?></td>
            <td><?= number_format((float)$position->total_price_without_tax, 2, '.', ''); ?></td>
        </tr>
    <?php endforeach; ?>

    <tr>
        <td class="text-right" colspan="5"><strong>Итого:</strong></td>
        <td><?= number_format((float)$total['total_price_without_tax'], 2, '.', ''); ?></td>
    </tr>
    <tr>
        <td class="text-right" colspan="5"><strong>В том числе НДС:</strong></td>
        <td><?= $total['tax_sum'] == 0 ? '' : number_format((float)$total['tax_sum'], 2, '.', ''); ?></td>
    </tr>
    <tr>
        <td class="text-right" colspan="5"><strong>Всего к оплате:</strong></td>
        <td><?= number_format((float)$total['total_price'], 2, '.', ''); ?></td>
    </tr>
</table>

<table class="table table-font-size13">
    <tr>
        <td class="" style="padding-top: 10px">
            <strong>Всего наименований: </strong>
            <?= count($model->position); ?>
        </td>
    </tr>
    <tr>
        <td class="">
            <strong>Сумма прописью: </strong>
            <?= SumHelper::num2str(number_format((float)$total['total_price'], 2, '.', '')) ?>
        </td>
    </tr>
</table>

<div style="font-size: 11px">
    Внимание! <br>
    Оплата данного счета означает согласие с условиями поставки товара.
    Уведомление об оплате обязательно, в противном случае не гарантируется наличие товара на складе.
    Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и
    паспорта.
</div>

<hr style="margin-bottom: 5px">

<table class="table table-font-size" style="margin-left: 430px; width: 250px">
    <tr>
        <td class="td-text">
            <strong>Директор: </strong>
            Назыров М.Я.
        </td>
    </tr>
</table>