$(document).ready(function() {
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

    $('.select2-search').select2({
        tabIndex: -1
    });
});

//Noty
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

//Delete
function deleteAction() {
    $('.delete-button').on('click', function() {
        var id = $(this).attr('attr-id');
        var url = $(this).attr('attr-url');
        var pjaxId =  $(this).attr('attr-pjax-id');

        function deleteAjax(url, id, pjaxId) {
            $.ajax({
                url: url + '?id=' + id,
                type: 'GET',
                success: function(res) {
                    if (res) {
                        swal({
                            title: "Успех",
                            text: "Запись удалена успешно!",
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        });
                        $.pjax.reload({container: '#' + pjaxId});
                    } else {
                        swal({
                            title: "Неудача",
                            text: "Не удалось удалить запись!",
                            confirmButtonColor: "#2196F3",
                            type: "error"
                        });
                    }
                },
                error: function(){
                    swal({
                        title: "Неудача",
                        text: "Не удалось удалить запись!",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                },
            });
        }
        swal({
                title: "Вы действительно хотите удалить запись?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Да, удалить!",
                cancelButtonText: "Нет",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    deleteAjax(url, id, pjaxId);
                }
                else {
                    swal({
                        title: "Отмена",
                        text: "Удаление было отменено пользователем!",
                        confirmButtonColor: "#2196F3",
                        type: "error"
                    });
                }
            });
    });
}
