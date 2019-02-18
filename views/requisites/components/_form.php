<?php

use yii\bootstrap\ActiveForm;
use app\models\Requisites;

$form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal', 'id' => 'requisites-form'],
]);
?>


    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title modal-title-js">Создать новый реквизит</h5>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <fieldset class="content-group">
                        <legend class="text-bold">Основная форма</legend>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'name') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'address') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'bin') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'iik') ?>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-rounded requisites-submit-button"><i class="icon-plus-circle2 position-left"></i>Добавить</button>
            <button type="button" class="btn border-danger text-danger btn-flat btn-rounded" data-dismiss="modal"><i class="icon-cross2 position-left"></i>Закрыть</button>
        </div>
    </div>

<?php ActiveForm::end() ?>

<?php
$script = <<<JS

    function formInit()
    {
        $('#requisites_form_modal').on('show.bs.modal', function() {
           formReset();
           $('.requisites-submit-button').attr('attr-model-id', '');
        });
    }

    function formSubmit() {
        $('#requisites-form').on('beforeSubmit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            var disabled = $(this).find(':input:disabled').removeAttr('disabled');
            var data = $(this).serialize();
            disabled.attr('disabled','disabled');
            
            if($('.requisites-submit-button').attr('attr-model-id')) {
                $.ajax({
                    url: '/requisites/update?id=' + $('.requisites-submit-button').attr('attr-model-id'),
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res) {
                            $('#requisites_form_modal').modal('hide');
                            $.pjax.reload({container: '#pjax-requisites-list'});
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
                    url: '/requisites/create',
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res) {
                            $('#requisites_form_modal').modal('hide');
                            $.pjax.reload({container: '#pjax-requisites-list'});
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
                url: '/requisites/get-model?id=' + id,
                type: 'GET',
                success: function(res) {
                    if (res) {
                        $('#requisites_form_modal').modal('show');
                        fillForm(JSON.parse(res));
                        $('.requisites-submit-button').attr('attr-model-id', JSON.parse(res).id);
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
        $('#requisites-name').val(model.name);
        $('#requisites-address').val(model.address);
        $('#requisites-bin').val(model.bin);
        $('#requisites-iik').val(model.iik);
        
        $('.requisites-submit-button').html('<i class="icon-pencil position-left"></i>Редактировать');
        $('.modal-title-js').html('Редактирование реквизита');
    }
    
    function formReset() {
        $('#requisites-name').val('');
        $('#requisites-address').val('');
        $('#requisites-bin').val('');
        $('#requisites-iik').val('');
        
        $('.form-group.has-success').each(function(){
            $(this).removeClass('has-success');
        });
        
        $('.requisites-submit-button').html('<i class="icon-plus-circle2 position-left"></i>Добавить');
        $('.modal-title-js').html('Создать новый реквизит');
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
