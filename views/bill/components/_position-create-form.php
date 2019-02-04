<?php

use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
]);

$positionModel->bill_id = $billModel->id;
$positionModel->tax_rate = '0';
$positionModel->tax_sum = '0.00';

$positionModel->excise_rate = '0';
$positionModel->excise_sum = '0.00';
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Добавить позицию</h5>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <fieldset class="content-group">
                    <legend class="text-bold">Основная форма</legend>

                    <?= $form->field($positionModel, 'bill_id',
                        [
                            'template' => '{input}',
                            'options' => ['tag' => false],
                        ]
                    )->hiddenInput()->label(false) ?>

                    <div class="col-md-12">
                        <?= $form->field($positionModel, 'name') ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($positionModel, 'unit') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($positionModel, 'quantity')->textInput(['type' => 'number']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($positionModel, 'price')->textInput(['type' => 'number']) ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($positionModel, 'total_price_without_tax')->textInput(['disabled' => 'disabled']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($positionModel, 'total_price')->textInput(['disabled' => 'disabled']) ?>
                    </div>
                </fieldset>
            </div>

        </div>

        <fieldset class="content-group">
            <legend class="text-bold">НДС</legend>

            <div class="col-md-6">
                <?= $form->field($positionModel, 'tax_rate') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($positionModel, 'tax_sum')->textInput(['disabled' => 'disabled']) ?>
            </div>
        </fieldset>
        <fieldset class="content-group">
            <legend class="text-bold">Акциз</legend>

            <div class="col-md-6">
                <?= $form->field($positionModel, 'excise_rate')->textInput(['disabled' => 'disabled']) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($positionModel, 'excise_sum')->textInput(['disabled' => 'disabled']) ?>
            </div>
        </fieldset>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
</div>

<?php ActiveForm::end() ?>

<?php
$script = <<<JS
    function formInit() {
        var quantity = $('#position-quantity');
        var price = $('#position-price');
        var total_price_without_tax = $('#position-total_price_without_tax');
        
        var tax_rate = $('#position-tax_rate');
        var tax_sum = $('#position-tax_sum');
        
        var total_price = $('#position-total_price');
        
        function sumTotalPriceWithoutTax() {
            if(quantity.val() && price.val()) {
                var sum = Number(quantity.val()) * Number(price.val());
                total_price_without_tax.val(sum.toFixed(2));
            }
        }
        
        function sumTax() {
            if(quantity.val() && price.val() && tax_rate.val()) {
                var sum = Number(quantity.val()) * Number(price.val());
                var tax = Number(tax_rate.val());
                var tax_total = sum * tax / 100;
                tax_sum.val(tax_total.toFixed(2));
            }
        }
        
        function sumTotalPrice() {
            if(total_price_without_tax.val() && tax_sum.val()) {
                var sum = Number(total_price_without_tax.val()) + Number(tax_sum.val());
                total_price.val(sum);
            }
        }
        
        
        quantity.on('change', function() {
            sumTotalPriceWithoutTax();
            sumTax();
            sumTotalPrice();
        });
        
        price.on('change', function() {
            var val = +price.val();
            price.val(val.toFixed(2));
            
            sumTotalPriceWithoutTax();
            sumTax();
            sumTotalPrice();
        });
        
        tax_rate.on('change', function() {
            sumTotalPriceWithoutTax();
            sumTax();
            sumTotalPrice();
        });
    }
    $(document).ready(function() {
       formInit();
    });
JS;

$this->registerJs($script);
?>