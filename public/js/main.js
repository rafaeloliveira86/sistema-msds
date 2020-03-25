$(document).ready(function() {
    /********** Authenticate **********/
    //Login
    $('#btn_login').on('click', function() {
        $('#form_login').attr('action', baseUri+'auth/index');
        $('#form_login').submit();
    });
    
    //Logout
    $('#btn_logout').on('click', function() {
        window.location.href = baseUri+'auth/logout';
    });
    
    /********** Usuário **********/
    //Create
    $('#btn_save_register').on('click', function() {
        swal({
            title: 'Cadastrar Usuário', 
            text: 'Aguarde! Salvando as informações.',
            type: 'success', 
            timer: 5000,
            onOpen: function () {
                swal.showLoading()
            }
        }).then(function () {
            
        },
        function (dismiss) {
            if (dismiss === 'timer') { //dismiss pode ser 'cancel', 'overlay', 'close' e 'timer'
                $('#form_create').attr('action', baseUri+'auth/create');
                $('#form_create').submit();
            }
        }); 
    });
    
    //Read
    $('#btn_select_register').on('click', function() {
        
    });
    
    //Update
    $('#btn_update_register').on('click', function() {
        
    });
    
    //Delete
    $('#btn_delete_register').on('click', function() {
        
    });
    
    //Cancel
    $('#btn_cancel_register').on('click', function() {
        window.location.href = baseUri+'auth';
    });
});