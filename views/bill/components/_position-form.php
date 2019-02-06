<?php

use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal', 'id' => 'position-form'],
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
                        <?= $form->field($positionModel, 'unit')->dropDownList(\app\models\Position::getUnitList()) ?>
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
        <button type="submit" class="btn btn-success btn-rounded position-submit-button"><i class="icon-plus-circle2 position-left"></i>Добавить</button>
        <button type="button" class="btn border-danger text-danger btn-flat btn-rounded" data-dismiss="modal"><i class="icon-cross2 position-left"></i>Закрыть</button>
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
                total_price.val(sum.toFixed(2));
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
        
        $('#position_form_modal').on('show.bs.modal', function() {
           formReset();
           $('.position-submit-button').attr('attr-model-id', '');
        });
    }
    
    function formSubmit() {
        $('#position-form').on('beforeSubmit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            var disabled = $(this).find(':input:disabled').removeAttr('disabled');
            var data = $(this).serialize();
            disabled.attr('disabled','disabled');
            
            if($('.position-submit-button').attr('attr-model-id')) {
                $.ajax({
                    url: 'update-position?id=' + $('.position-submit-button').attr('attr-model-id'),
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res) {
                            $('#position_form_modal').modal('hide');
                            $.pjax.reload({container: '#pjax-position-list'});
                            successNoty();
                        } else {
                            errorNoty();
                        }
                    },
                    error: function(){
                        errorNoty();
                    }
                });
            } else {
                $.ajax({
                    url: 'create-position',
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res) {
                            $('#position_form_modal').modal('hide');
                            $.pjax.reload({container: '#pjax-position-list'});
                            successNoty();
                        } else {
                            errorNoty();
                        }
                    },
                    error: function(){
                        errorNoty();
                    }
                });
            }
            
            
            return false;
        });
    }
    
    function getForm() {
        $('.update-button').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).attr('attr-id');
           
            $.ajax({
                url: 'get-position-model?id=' + id,
                type: 'GET',
                success: function(res) {
                    if (res) {
                        $('#position_form_modal').modal('show');
                        fillForm(JSON.parse(res));
                        $('.position-submit-button').attr('attr-model-id', JSON.parse(res).id);
                    } else {
                        errorNoty();
                    }
                },
                error: function(){
                    errorNoty();
                }
            });
        })
    }
    
    function formReset() {
        var name = $('#position-name');
        var unit = $('#position-unit');
        var quantity = $('#position-quantity');
        var price = $('#position-price');
        var total_price_without_tax = $('#position-total_price_without_tax');
        var tax_rate = $('#position-tax_rate');
        var tax_sum = $('#position-tax_sum');
        var total_price = $('#position-total_price');
        var excise_rate = $('#position-excise_rate');
        var excise_sum = $('#position-excise_sum');
        
        name.val('');
        quantity.val('');
        price.val('');
        total_price_without_tax.val('');
        total_price.val('');

        tax_rate.val('0');
        tax_sum.val('0.00');

        excise_rate.val('0');
        excise_sum.val('0.00');
        
        $('.form-group.has-success').each(function(){
            $(this).removeClass('has-success');
        });
        
        // toDo reset unit
    }
    
    function fillForm(model) {
        var name = $('#position-name');
        var unit = $('#position-unit');
        var quantity = $('#position-quantity');
        var price = $('#position-price');
        var total_price_without_tax = $('#position-total_price_without_tax');
        var tax_rate = $('#position-tax_rate');
        var tax_sum = $('#position-tax_sum');
        var total_price = $('#position-total_price');
        var excise_rate = $('#position-excise_rate');
        var excise_sum = $('#position-excise_sum');
        
        name.val(model.name);
        quantity.val(model.quantity);
        price.val(model.price);
        total_price_without_tax.val(model.total_price_without_tax);
        tax_rate.val(model.tax_rate);
        tax_sum.val(model.tax_sum);
        total_price.val(model.total_price);
        excise_rate.val(model.excise_rate);
        excise_sum.val(model.excise_sum);
                
        // toDo add unit
    }
    
    function successNoty(message = 'Операция прошла успешно') {
        new Noty({
            theme: ' alert alert-success alert-styled-left p-0 bg-white',
            text: message,
            type: 'success',
            progressBar: false,
            closeWith: ['button'],
            layout: 'topRight',
            timeout: 5000
        }).show();
    }
    
    function errorNoty(message = 'Операция завершилась с ошибкой') {
        new Noty({
            theme: ' alert alert-danger alert-styled-left p-0',
            text: message,
            type: 'error',
            progressBar: false,
            closeWith: ['button'],
            layout: 'topRight',
            timeout: false
        }).show();
    }

    $(document).ready(function() {
       formInit();
       formSubmit();
       getForm();
       
       $(document).on('pjax:success', function() {
           getForm();
       });
    });
JS;

$this->registerJs($script);
?>
