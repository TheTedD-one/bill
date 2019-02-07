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
