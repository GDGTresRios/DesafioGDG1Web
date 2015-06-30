$(function () {
    $('#tGrid .lkEditar').on('click', function () {
        $.ajax({
            url: 'cadastro.php',
            data: {id: ($(this).data('id'))}
        }).done(function (resultado) {
            $('#ajax').html(resultado);
            $('#modal_cadastro').modal('show');
        }).fail(function (resultado) {
            alert('Erro!');
        });
    });

    $('#btIncluir').on('click', function () {
        $.ajax({
            url: 'cadastro.php'
        }).done(function (resultado) {
            $('#ajax').html(resultado);
            $('#modal_cadastro').modal('show');
        }).fail(function (resultado) {
            alert('Erro!');
        });
    });
});