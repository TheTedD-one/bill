<?php

use yii\bootstrap\ActiveForm;
use app\models\Requisites;

$form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal', 'id' => 'bill-form'],
]);
?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title modal-title-js">Создать новый счет</h5>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <fieldset class="content-group">
                        <legend class="text-bold">Основная форма</legend>

                        <div class="row">
                            <div class="col-md-6">
                                <?=
                                    $form->field($model, 'my_requisites_id')->dropDownList(
                                            Requisites::getSelectDetails(Requisites::MY_REQUISITES),
                                            ['id' => 'select2-me',  'class' => 'form-control select2', 'disabled' => 'disabled']
                                    );
                                ?>
                            </div>
                            <div class="col-md-6">
                                <?=
                                    $form->field($model, 'customer_requisites_id')->dropDownList(
                                        Requisites::getSelectDetails(),
                                        ['id' => 'select2-customer', 'class' => 'form-control select2-search']
                                    );
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <label>
                                        <input type="checkbox" id="sender-checkbox" class="styled" checked="checked">
                                        Грузоотправитель (поставщик)
                                    </label>
                                </div>
                                <?=
                                    $form->field($model, 'sender_requisites_id')->dropDownList(
                                        Requisites::getSelectDetails(),
                                        ['id' => 'select2-sender', 'class' => 'form-control select2-search', 'disabled' => 'disabled']
                                    )->label(false);
                                ?>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label>
                                        <input type="checkbox" id="recipient-checkbox" class="styled" checked="checked">
                                        Грузополучатель (получатель)
                                    </label>
                                </div>
                                <?=
                                    $form->field($model, 'recipient_requisites_id')->dropDownList(
                                        Requisites::getSelectDetails(),
                                        ['id' => 'select2-recipient', 'class' => 'form-control select2-search', 'disabled' => 'disabled']
                                    )->label(false);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <?=
                                $form->field($model, 'payment_type')->dropDownList(
                                    \app\models\Bill::getPaymentTypes(),
                                    ['id' => 'select2-payment_type',  'class' => 'form-control select2']
                                );
                                ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="content-group">
                        <legend class="text-bold">Доставка</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'contract_type') ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'delivery_type') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'delivery_point') ?>
                            </div
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'delivery_document') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'transport_document') ?>
                        </div>
                    </fieldset>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-rounded bill-submit-button"><i class="icon-plus-circle2 position-left"></i>Добавить</button>
            <button type="button" class="btn border-danger text-danger btn-flat btn-rounded" data-dismiss="modal"><i class="icon-cross2 position-left"></i>Закрыть</button>
        </div>
    </div>

<?php ActiveForm::end() ?>

<?php
$script = <<<JS

    function formInit()
    {
        $('#select2-sender').val($('#select2-me').val()).trigger('change');
        $('#select2-recipient').val($('#select2-customer').val()).trigger('change');
        
        $('#sender-checkbox').on('change', function() {
            if($(this).prop('checked')) {
                $('#select2-sender').prop("disabled", true);
                $('#select2-sender').val($('#select2-me').val()).trigger('change');
            } else {
                $('#select2-sender').prop("disabled", false);
            }
        });
        
        $('#recipient-checkbox').on('change', function() {
            if($(this).prop('checked')) {
                $('#select2-recipient').prop("disabled", true);
                $('#select2-recipient').val($('#select2-customer').val()).trigger('change');
            } else {
                $('#select2-recipient').prop("disabled", false);
            }
        });
        
        $('#select2-customer').on('change', function() {
             if($('#recipient-checkbox').prop("checked")) {
                 $('#select2-recipient').val($(this).val()).trigger('change');
             }
        });
        
        $('#bill_form_modal').on('show.bs.modal', function() {
           formReset();
           $('.bill-submit-button').attr('attr-model-id', '');
        });
    }

    function formSubmit() {
        $('#bill-form').on('beforeSubmit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            var disabled = $(this).find(':input:disabled').removeAttr('disabled');
            var data = $(this).serialize();
            disabled.attr('disabled','disabled');
            
            if($('.bill-submit-button').attr('attr-model-id')) {
                $.ajax({
                    url: '/bill/update-bill?id=' + $('.bill-submit-button').attr('attr-model-id'),
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res) {
                            $('#bill_form_modal').modal('hide');
                            $.pjax.reload({container: '#pjax-bill-list'});
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
                    url: 'bill/create-bill',
                    type: 'POST',
                    data: data,
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
                url: '/bill/get-bill-model?id=' + id,
                type: 'GET',
                success: function(res) {
                    if (res) {
                        $('#bill_form_modal').modal('show');
                        fillForm(JSON.parse(res));
                        $('.bill-submit-button').attr('attr-model-id', JSON.parse(res).id);
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
    
    function fillForm(model) {
        if(model.my_requisites_id !== model.sender_requisites_id) {
            $("#sender-checkbox").prop("checked", false).trigger('change');
            $('#select2-sender').val(model.sender_requisites_id).trigger('change');
        } else {
            $("#sender-checkbox").prop("checked", true).trigger('change');
        }
        
        if(model.customer_requisites_id !== model.recipient_requisites_id) {
            $("#recipient-checkbox").prop("checked", false).trigger('change');
            $('#select2-customer').val(model.customer_requisites_id).trigger('change');
            $('#select2-recipient').val(model.recipient_requisites_id).trigger('change');
        } else {
            $("#recipient-checkbox").prop("checked", true).trigger('change');
            $('#select2-customer').val(model.customer_requisites_id).trigger('change');
        }
        
        $('#select2-payment_type').val(model.payment_type).trigger('change');
        $('#bill-contract_type').val(model.contract_type);
        $('#bill-delivery_type').val(model.delivery_type);
        $('#bill-delivery_point').val(model.delivery_point);
        $('#bill-delivery_document').val(model.delivery_document);
        $('#bill-transport_document').val(model.transport_document);
        
        $('.bill-submit-button').html('<i class="icon-pencil position-left"></i>Редактировать');
        $('.modal-title-js').html('Редактирование счета');
    }
    
    function formReset() {
        $("#sender-checkbox").prop("checked", true).trigger('change');
        $("#recipient-checkbox").prop("checked", true).trigger('change');
        
        $('#select2-customer').val('1').trigger('change');
        $('#select2-recipient').val('1').trigger('change');
        $('#select2-sender').val('1').trigger('change');
        
        $('#select2-payment_type').val('Безналичный расчет').trigger('change');
        $('#bill-contract_type').val('');
        $('#bill-delivery_type').val('');
        $('#bill-delivery_point').val('');
        $('#bill-delivery_document').val('');
        $('#bill-transport_document').val('');
        
        $('.form-group.has-success').each(function(){
            $(this).removeClass('has-success');
        });
        
        $('.bill-submit-button').html('<i class="icon-plus-circle2 position-left"></i>Добавить');
        $('.modal-title-js').html('Создать новый счет');
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
