/* eslint-disable func-names */
/* eslint-disable no-undef */
/* Mi script ajax */

// eslint-disable-next-line no-undef
$(document).ready(() => {
    /* ################ CREAR ADMIN ################## */
    $('#crear-registro').on('submit', function (e) {
        e.preventDefault();

        const datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: datos,
            dataType: 'json',
            success(data) {
                $('#crear-categoria').trigger('reset');
                const resultado = data;
                console.log(resultado);

                if (resultado.respuesta === 'exito') {
                    Swal.fire({
                        title: 'Categoria Creada',
                        icon: 'success',
                        html: `Se creo el registro <b>${resultado.nombre}</b> correctamente`,
                    });
                    setTimeout(() => {
                        // eslint-disable-next-line no-undef
                        window.location.href = 'lista-registrados.php';
                    }, 3000);
                } else {
                    Swal.fire({
                        title: 'Hubo un error al crear....',
                        icon: 'error',
                        text:
                'Si continua con el problema Favor de contactar al Administrador del sistema',
                    });
                }
                /* ## TERMINA EL ELSE */
            },
        /* ## TERMINA EL SUCCESS ## */
        });
        /* ## TERMINA EL EVENTO AJAX ## */
    });
    /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */

    /* ################ ELIMINA ADMIN ################## */
    $('.borrar_registro').on('click', function () {
        // e.preventDefault();
        const id = $(this).attr('data-id');
        const tipo = $(this).attr('data-tipo');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger',
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: 'Eliminar Categoria',
                text: '¿Estas seguro de eliminar este Registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'No, cancelar',
                reverseButtons: true,
            })
            .then((result) => {
                if (result.value) {
                    /* ### SI DA CLICK A CONFIRMAR DE BORRAR ### */

                    /* ##PETICION POR AJAX A BASE DE DATOS ## */
                    $.ajax({
                        type: 'post',
                        url: `modelo-${tipo}.php`,
                        data: {
                            id_registrado: id,
                            registro: 'eliminar',
                        },
                        dataType: 'json',
                        success(response) {
                            const resultado = response;
                            console.log(resultado);

                            if (resultado.respuesta === 'exitoso') {
                                swalWithBootstrapButtons.fire(
                                    'Eliminado!',
                                    'El Registro se elimino de manera correcta',
                                    'success',
                                );
                                /* ## SE REMUEVE ELEMENTO TR DEL DOM ## */
                                $(`[data-id="${resultado.id_eliminado}"]`)
                                    .parents('tr')
                                    .remove();
                            } else {
                                Swal.fire({
                                    title: 'Hubo un error....!',
                                    text: 'No se elimino, contactar a administrador o intentar de nuevo',
                                    icon: 'error',
                                });
                            }
                        },
                    });
                } else if (
                /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'No se elimino ningun Administrador',
                        'error',
                    );
                }
            });
    });

    /* ######### EDITAR Categoria ############ */

    $('#editar-registro').on('submit', function (e) {
        e.preventDefault();

        const datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: datos,
            dataType: 'json',
            success(data) {
                const resultado = data;
                console.log(resultado);

                /* ## INGRESO EXITOSO AL SISTEMA ## */

                if (resultado.respuesta === 'exitoso') {
                    Swal.fire({
                        title: 'Se actualizaron los datos correctamente',
                        icon: 'success',
                        html: `Nombre : <b> ${resultado.nombre} </b> `,
                        // showLoaderOnConfirm: true,
                        // showCloseButton: true
                    });
                    setTimeout(() => {
                        window.location.href = 'lista-registrados.php';
                    }, 3000);
                } else {
                    /* ## INGRESO EXITOSO AL SISTEMA ERRONEO ## */
                    Swal.fire({
                        title: 'Hubo un error...',
                        icon: 'error',
                        html: 'No se actualizaron los datos, intentar de nuevo o contactar al administrador ',
                    });
                }
            },
        /* ## TERMINA EL SUCCESS ## */
        });
        /* ## TERMINA EL EVENTO AJAX ## */
    });
    /* ## TERMINA LA FUNCION DEL CLICK SUBMIT ## */
});
/* ## TERMINA DOCUMENTO ## */
