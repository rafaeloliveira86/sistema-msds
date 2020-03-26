$(document).ready(function() {    
    /********** Authenticate **********/
    //Login
    $('#btn_login').on('click', function() {
        $('#form_login').attr('action', baseUri+'auth');
        $('#form_login').submit();
    });
    
    //Logout
    $('#btn_logout').on('click', function() {
        window.location.href = baseUri+'logout';
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
                $('#form_create').attr('action', baseUri+'create');
                $('#form_create').submit();
            }
        }); 
    });
    
    //Read
    $('#btn_select_register').on('click', function() {
        
    });
    
    //Update
    $(function() {
        $(document).on('click', '#btn_update_register', function(e) {
            e.preventDefault;
            let userId = $(this).closest('tr').find('.cod').text();
            saveToStorage(userId);
            let user_id = JSON.parse(localStorage.getItem('data'));
            $.post(baseUri+'showmodal', { act: 1, id: user_id }, function(data) {
                $("#modal").modal('show');          
                $(".modal-content").html(data);
            });
        });
    });
    $(function() {
    $(document).on('click', '#btn_update_register_modal', function(e) {
        e.preventDefault;
        swal({
            title: 'Atualizar Usuário', 
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
                swal('Confirmado!', 'Usuário atualizado com sucesso!', 'success');
                $('.swal2-confirm').on('click', function() {
                    $('#form_update').attr('action', baseUri+'update');
                    $('#form_update').submit();
                });
            }
        });
    });
    });
    
    //Delete
    $(function() {
        $(document).on('click', '#btn_delete_register', function(e) {
            e.preventDefault;
            let userId = $(this).closest('tr').find('.cod').text();
            swal({
                title: 'Excluir Usuário', 
                text: "Caso contrário clique em cancelar!", 
                type: 'warning', 
                showCancelButton: true,
                confirmButtonColor: '#3085d6', 
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, confirmar!', 
                cancelButtonText: 'Não, cancelar!',
                confirmButtonClass: 'btn btn-primary', 
                cancelButtonClass: 'btn btn-danger', 
                buttonsStyling: true
            }).then(function() {
                $.ajax({
                    method: "POST",
                    //url: baseUri+'delete',
                    url: baseUri+'delete/update',
                    data: {
                        id: userId
                    },
                    success: function(data) {
                        if(data) {
                            swal('Confirmado!', 'Usuário excluído com sucesso!', 'success');
                            $('.swal2-confirm').on('click', function() {                                
                                window.location.reload();
                            });
                            console.log('Usuário excluido com sucesso!');
                        }
                    },
                    error: function() {
                        console.log('Não foi possível excluír o registro.');
                    }
                });
            },
            function (dismiss) {
                if (dismiss === 'cancel') { //dismiss pode ser 'cancel', 'overlay', 'close' e 'timer'
                    swal('Cancelado!', 'Exclusão de usuário cancelado.', 'error');
                }
            });
        });
    });
    
    //Cancel
    $('#btn_cancel_register').on('click', function() {
        window.location.href = baseUri+'auth';
    });
});

function saveToStorage(param) {
    localStorage.setItem('data', JSON.stringify(param));
}