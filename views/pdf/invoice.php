<h5 class="text-center" style="font-size: 13px;">
    <strong>
        Счет-фактура № <u class=""><?= $model->id ?></u> 
        от <u><?= date('d.m.Y', strtotime($model->created_date)) ?></u>
    </strong>
</h5>
<hr style="margin-top: 5px; margin-bottom: 5px;">
<table class="table table-font-size">
    <tr>
        <td class="td-text">
            <strong>Поставщик: </strong>
            <?= $model->me->name ?>
        </td>
    </tr>
    <tr>
        <td class="td-text" style="padding-top: 15px;">
            БИН и адрес места нахождения поставщика:
            БИН: <?= $model->me->bin . ', ' . $model->me->address ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            ИИК поставщика: <?= $model->me->iik . ', ' . $model->me->bank . ', БИК: ' .  $model->me->bik ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Договор (контракт) на поставку товаров (работ, услуг): <?= $model->contract_type ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Условия оплаты по договору (контракту): <?= $model->payment_type ?>
        </td>
    </tr>
    <tr>
        <td class="td-text" style="padding-top: 15px;">
            Пункт назначения поставляемых товаров (работ, услуг): <?= $model->delivery_point ?>
        </td>
    </tr>
    <tr>
        <td class="text-center" style="font-size: 9px">
            <em>государство, регион, область, город, район</em>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Поставка товаров (работ, услуг) осуществлена по доверенности: <?= $model->delivery_document ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Способ отправления: <?= $model->delivery_type ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Товарно-транспортная накладная: <?= $model->transport_document ?>
        </td>
    </tr>
    <tr>
        <td class="td-text" style="padding-top: 15px;">
            Грузоотправитель: <?= 'БИН: ' . $model->sender->bin . ', '
                                . $model->sender->name
                                . ', ' . $model->sender->address ?>
        </td>
    </tr>
    <tr>
        <td class="text-center" style="font-size: 9px">
            <em>(БИН, наименование и адрес)</em>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Грузополучатель: <?= 'БИН: ' . $model->recipient->bin . ', '
                                . $model->recipient->name
                                . ', ' . $model->recipient->address ?>
        </td>
    </tr>
    <tr>
        <td class="text-center" style="font-size: 9px">
            <em>(БИН, наименование и адрес)</em>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            <strong>Получатель: </strong><?= $model->customer->name ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            БИН и адрес места нахождения получателя:
            БИН: <?= $model->customer->bin . ', ' . $model->customer->address ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            ИИК получателя: <?= $model->customer->iik . ', ' . $model->customer->bank . ', БИК: ' . $model->customer->bik ?>
        </td>
    </tr>
</table>

<table class="table table-bordered text-center table-font-size">
    <tr>
        <td rowspan="2">№ п/п</td>
        <td rowspan="2">Наименование товаров (работ, услуг)</td>
        <td rowspan="2">Ед. изм.</td>
        <td rowspan="2">Кол-во (объем)</td>
        <td rowspan="2">Цена (KZT)</td>
        <td rowspan="2">Стоимость товаров (работ, услуг) без НДС</td>
        <td colspan="2">НДС</td>
        <td rowspan="2">Всего стоимость реализации</td>
        <td colspan="2">Акциз</td>
    </tr>
    <tr>
        <td>Ставка</td>
        <td>Сумма</td>
        <td>Ставка</td>
        <td>Сумма</td>
    </tr>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
    </tr>

    <?php foreach($model->position as $key => $position): ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $position->name ?></td>
            <td><?= \app\models\Position::getUnitList()[$position->unit] ?></td>
            <td><?= $position->quantity ?></td>
            <td><?= number_format((float)$position->price, 2, '.', ''); ?></td>
            <td><?= number_format((float)$position->total_price_without_tax, 2, '.', ''); ?></td>
            <td><?= $position->tax_rate == 0 ? 'без НДС' : $position->tax_rate . '%'?></td>
            <td>
                <?= $position->tax_sum == 0 ? '' :
                    number_format((float)$position->tax_sum, 2, '.', ''); ?>
            </td>
            <td><?= number_format((float)$position->total_price, 2, '.', ''); ?></td>
            <td><?= $position->excise_rate == 0 ? '' : $position->excise_rate ?></td>
            <td><?= $position->excise_sum == 0 ? '' : $position->excise_sum ?></td>
        </tr>
    <?php endforeach; ?>

    <tr>
        <td class="text-left" colspan="5"><strong>Всего по счету: </strong></td>
        <td><?= number_format((float)$total['total_price_without_tax'], 2, '.', ''); ?></td>
        <td style="background-color: gray"></td>
        <td><?= $total['tax_sum'] == 0 ? '' : number_format((float)$total['tax_sum'], 2, '.', ''); ?></td>
        <td><?= number_format((float)$total['total_price'], 2, '.', ''); ?></td>
        <td style="background-color: gray"></td>
        <td></td>
    </tr>
</table>

<table autosize="1" class="table-font-size">
    <tr>
        <td>
            <table class="table">
                <tr>
                    <td class="td-footer">
                        <div><strong>Директор: Назыров М.Я.</strong></div>
                        <div class="div-footer">&nbsp;</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="td-footer">
                        <div><strong>ВЫДАЛ (ответственное лицо поставщика):</strong></div>
                        <div class="div-footer">Директор</div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        (Ф.И.О., подпись)
                    </td>
                    <td rowspan="3">&nbsp;&nbsp;</td>
                    <td rowspan="3">
                        <div style="padding: 5px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;<span style="border: 1px solid black; padding: 10px">МП</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </td>
                    <td rowspan="3">&nbsp;&nbsp;</td>
                    <td class="text-center">
                        (должность)
                    </td>
                </tr>
                <tr>
                    <td class="td-footer" style="padding-top: 20px">
                        <div><strong>Главный бухгалтер: Не предусмотрен</strong></div>
                        <div class="div-footer">&nbsp;</div>
                    </td>
                    <td class="td-footer">
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        (Ф.И.О., подпись)
                    </td>
                    <td class="text-center">
                        (Ф.И.О., подпись)
                    </td>
                </tr>
            </table>
            <p>Примечание: Без печати недействительно. Оригинал (первый экземпляр) - покупателю.
                Копия (второй экземпляр) - поставщику.</p>
        </td>
    </tr>
</table>
