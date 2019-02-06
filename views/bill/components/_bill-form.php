<?php

use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal', 'id' => 'position-form'],
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

                        <div class="col-md-12">
                            <?= $form->field($model, 'id') ?>
                        </div>
                    </fieldset>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-rounded position-submit-button"><i class="icon-plus-circle2 position-left"></i>Добавить</button>
            <button type="button" class="btn border-danger text-danger btn-flat btn-rounded" data-dismiss="modal"><i class="icon-cross2 position-left"></i>Закрыть</button>
        </div>
    </div>

<?php ActiveForm::end() ?>