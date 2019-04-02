<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title modal-title-js">Отправить счет на email</h5>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <fieldset class="content-group">
                    
                    <input type="hidden" id="send-bill-id" name="send-bill-id" value="<?= $billModel->id ?>">

                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-success btn-rounded email-send-button"><i class="icon-plus-circle2 position-left"></i>Добавить</button>
        <button type="button" class="btn border-danger text-danger btn-flat btn-rounded" data-dismiss="modal"><i class="icon-cross2 position-left"></i>Закрыть</button>
    </div>
</div>

<?php
$script = <<<JS
    $(document).ready(function() {
        $('#payment_send_modal').on('show.bs.modal', function() {
            $('#email').val('');
        });
        
        $('.email-send-button').on('click', function() {
            $.ajax({
                    url: '/pdf/payment-send?id=' + $('#send-bill-id').val() + '&email=' + $('#email').val(),
                    type: 'POST',
                    success: function(res) {
                        if (res) {
                            $('#payment_send_modal').modal('hide');
                            successNoty();
                        } else {
                            $('#payment_send_modal').modal('hide');
                            errorNoty();
                        }
                    },
                    error: function(){
                        $('#payment_send_modal').modal('hide');
                        errorNoty();
                    }
            });
        });
    });
JS;

$this->registerJs($script);
?>