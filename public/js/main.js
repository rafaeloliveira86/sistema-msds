$(document).ready(function() {
    //Login
    $('#btn_login').on('click', function() {
        //alert('Login');
    });
    //Cadastrar novo usuário
    $('#btn_save_register').on('click', function() {
        //alert('Salvar');
    });
    $('#btn_cancel_register').on('click', function() {
        window.location.href = baseUri+'login';
    });
});