<h5 class="text-center">
    <strong>
        Счет-фактура № <u class=""><?= $model->id ?></u> 
        от <u><?= date('d.m.Y', strtotime($model->created_date)) ?></u>
    </strong>
</h5>
<hr>
<table class="table">
    <tr>
        <td class="td-text">
            <strong>Поставщик: </strong>
            <?= $model->me->name ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            БИН и адрес места нахождения поставщика:
            БИН: <?= $model->me->bin . ' ' . $model->me->address ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            ИИК поставщика: <?= $model->me->iik ?>
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
        <td class="td-text">
            Пункт назначения поставляемых товаров (работ, услуг): <?= $model->delivery_point ?>
        </td>
    </tr>
    <tr>
        <td class="text-center">
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
        <td class="td-text">
            Грузоотправитель: <?= 'БИН: ' . $model->sender->bin . ' '
                                . $model->sender->name
                                . ' ' . $model->sender->address ?>
        </td>
    </tr>
    <tr>
        <td class="text-center">
            <em>(БИН, наименование и адрес)</em>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            Грузополучатель: <?= 'БИН: ' . $model->recipient->bin . ' '
                                . $model->recipient->name
                                . ' ' . $model->recipient->address ?>
        </td>
    </tr>
    <tr>
        <td class="text-center">
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
            БИН: <?= $model->customer->bin . ' ' . $model->customer->address ?>
        </td>
    </tr>
    <tr>
        <td class="td-text">
            ИИК получателя: <?= $model->customer->iik ?>
        </td>
    </tr>
</table>

<table class="table table-bordered text-center">
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
            <td><?= $position->price ?></td>
            <td><?= $position->total_price_without_tax ?></td>
            <td><?= $position->tax_rate ?></td>
            <td><?= $position->tax_sum ?></td>
            <td><?= $position->total_price ?></td>
            <td><?= $position->excise_rate ?></td>
            <td><?= $position->excise_sum ?></td>
        </tr>
    <?php endforeach; ?>

    <tr>
        <td class="text-left" colspan="5"><strong>Всего по счету: </strong></td>
        <td></td>
        <td style="background-color: gray"></td>
        <td></td>
        <td></td>
        <td style="background-color: gray"></td>
        <td></td>
    </tr>
</table>

<table autosize="1">
    <tr>
        <td>
            <table class="table">
                <tr>
                    <td class="td-footer">
                        <div><strong>Директор:</strong></div>
                        <div class="div-footer">&nbsp;</div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="td-footer">
                        <div><strong>ВЫДАЛ (ответственное лицо поставщика):</strong></div>
                        <div class="div-footer">&nbsp;</div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        (Ф.И.О., подпись)
                    </td>
                    <td rowspan="3">&nbsp;&nbsp;</td>
                    <td rowspan="3" style="border: 1px dotted black">
                        <div style="padding: 5px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;МП
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
