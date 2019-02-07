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
            <h5 class="modal-title">Создать новый счет</h5>
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
                                    ['id' => 'select2-me',  'class' => 'form-control select2']
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
    }

    function formSubmit() {
        $('#bill-form').on('beforeSubmit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            var disabled = $(this).find(':input:disabled').removeAttr('disabled');
            var data = $(this).serialize();
            disabled.attr('disabled','disabled');
            
            $.ajax({
                url: 'bill/create-bill',
                type: 'POST',
                data: data,
            });
            
            return false;
        });
    }
    
    $(document).ready(function() {
        formInit();
        formSubmit();
    });
JS;

$this->registerJs($script);
?>
