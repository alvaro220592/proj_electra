$(document).ready( function() {
    $('#enviar-faturas-container').hide();
    $('#btn-enviar-faturas').click(function() {
        $('#enviar-faturas-container').toggle(400);
    });
    $('#btn-nao').click(function() {
        $('#enviar-faturas-container').hide(400);
    });
});