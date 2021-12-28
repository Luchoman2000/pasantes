var u_valid = true;
var p_valid = true;
var u_valid_array = [];
var p_valid_array = [];
$(function () {

    // Validacion de formulario de usuario

    //Check Usuario
    $('.uUsuario').on('keyup', function () {
        var usuario = $('.uUsuario').val();
        var pattern = /^(?=.{3,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
        if (pattern.test(usuario) && usuario.length >= 3 && usuario.length <= 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            u_valid_array[0] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            u_valid_array[0] = false;
        }
    });

    //Check Clave1
    $('.uNClave').on('keyup', function () {
        var clave1 = $('.uNClave').val();
        var pattern = /^(?=.{4,15}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
        if (pattern.test(clave1) && clave1.length >= 4 && clave1.length <= 15) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            u_valid_array[1] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            u_valid_array[1] = false;
        }
    });

    //Check Clave2
    $('.uSNClave').on('keyup', function () {
        var clave2 = $('.uSNClave').val();
        var pattern = /^(?=.{4,15}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/;
        if (pattern.test(clave2) && clave2.length >= 4 && clave2.length <= 15) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            u_valid_array[2] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            u_valid_array[2] = false;
        }
    });

    //Fin Validacion de formulario de usuario

    //Validacion de formulario de personal

    //Check Nombre1
    $('.pNombre').on('keyup', function () {
        var nombre1 = $(this).val();
        var pattern = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]{4,15}$/;
        if (pattern.test(nombre1) && nombre1.length > 3 && nombre1.length < 16) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[0] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[0] = false;
        }
    });

    //Check Nombre2
    $('.pNombre2').on('keyup', function () {
        var nombre2 = $(this).val();
        var pattern = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]{4,15}$/;
        if (pattern.test(nombre2) && (nombre2.length > 1 && nombre2.length < 30) || nombre2 == "") {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[1] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[1] = false;
        }
    });

    //Check Apellido1
    $('.pApellido').on('keyup', function () {
        var apellido1 = $(this).val();
        var pattern = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]{4,15}$/;
        if (pattern.test(apellido1) && apellido1.length > 0 && apellido1.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[2] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[2] = false;
        }
    });

    //Check Apellido2
    $('.pApellido2').on('keyup', function () {
        var apellido2 = $(this).val();
        var pattern = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]{4,15}$/;
        if (pattern.test(apellido2) && (apellido2.length > 1 && apellido2.length < 30) || apellido2 == "") {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[3] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[3] = false;
        }
    });

    //Check cedula
    $('.pCedula').on('keyup', function () {
        var cedula = $(this).val();
        var pattern = /^[0-9]*$/;
        if (pattern.test(cedula) && cedula.length == 10) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[4] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[4] = false;
        }
    });

    //Check telefono
    $('.pTelefono').on('keyup', function () {
        var telefono = $(this).val();
        var pattern = /^[0-9]*$/;
        if (pattern.test(telefono) && telefono.length == 10 || telefono == "") {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[5] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[5] = false;
        }
    });

    //Check email
    $('.pEmail').on('keyup', function () {
        var email = $(this).val();
        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (pattern.test(email) && email.length > 0 && email.length < 50 || email == "") {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[6] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[6] = false;
        }
    });

    // Check direccion
    $('.pDireccion').on('keyup', function () {
        var direccion = $(this).val();
        var pattern = /[\w',-\\/.\s]/;
        if (pattern.test(direccion) && direccion.length > 0 && direccion.length < 35 || direccion == "") {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            p_valid_array[7] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            p_valid_array[7] = false;
        }
    });

    //Fin Validacion de formulario de personal

})

//Para borrar registro de pasante
$(document).on('click', '.eliminarUsuario', function () {
    // console.log($(this).parent().parent().parent().attr('id'));
    var id = $(this).attr('id');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Barrarás este usuario, ¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: '¡No, cancelar!',

    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                method: "POST",
                data: 'id=' + id + '&borrar_usuario=true',
                success: function (data) {
                    console.log(data);
                    if (data == 'ok') {
                        Swal.fire(
                            '¡Eliminado!',
                            'El usuario se ha eliminado.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });


                    } else if (data == 'error') {
                        Swal.fire(
                            '¡Error!',
                            'Ha ocurrido un error, intente de nuevo mas tarde',
                            'error'
                        ).then(function () {
                            location.reload();
                        });
                    } else if (data = "error_s") {
                        Swal.fire(
                            '¡Error!',
                            'No puedes eliminar tu mismo usuario',
                            'error'
                        )

                    }

                }
            });
        }
    });
});

//Para eliminar personal
$(document).on('click', '.eliminarPersonal', function () {
    // console.log($(this).parent().parent().parent().attr('id'));
    var id = $(this).attr('id');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Barrarás este usuario, ¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: '¡No, cancelar!',
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                method: "POST",
                data: 'id_personal=' + id + '&borrar_personal=true',
                success: function (data) {
                    console.log(data);
                    if (data == 'ok') {
                        Swal.fire(
                            '¡Eliminado!',
                            'El usuario eliminado.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });
                    } else if (data == 'error') {
                        Swal.fire(
                            '¡Error!',
                            'Ha ocurrido un error, intente de nuevo mas tarde',
                            'error'
                        ).then(function () {
                            location.reload();
                        });
                    } else if (data == 'error_s') {
                        Swal.fire(
                            '¡Error!',
                            'No puedes eliminar tu mismo personal',
                            'error'
                        )
                    }
                }
            });
        }
    });
});

// Para eliminar horario
$(document).on('click', '.eliminarHorario', function () {
    // console.log($(this).parent().parent().parent().attr('id'));
    var id = $(this).attr('id');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Barrarás este horario, ¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: '¡No, cancelar!',
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                method: "POST",
                data: 'id_horario=' + id + '&borrar_horario=true',
                success: function (data) {
                    console.log(data);
                    if (data == 'ok') {
                        Swal.fire(
                            '¡Eliminado!',
                            'El horario se ha eliminado.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });
                    } else if (data == 'error') {
                        Swal.fire(
                            '¡Error!',
                            'Ha ocurrido un error, intente de nuevo mas tarde',
                            'error'
                        ).then(function () {
                            location.reload();
                        });
                    } else if (data == 'error_s') {
                        Swal.fire(
                            '¡Error!',
                            'No puedes eliminar tu mismo horario',
                            'error'
                        )
                    }
                }
            });
        }
    });
});


//Para editar usuario
$(document).on('click', '.editarUsuario', function () {
    let id_usuario = $(this).attr('id');
    var id_rol = $(this).attr('rol');
    var estado = $(this).attr('estado');

    console.info(id_usuario);
    // alert(id_usuario);

    var row = $(this).closest('tr');

    // console.log(row);

    var usuario = row.children().eq(1).text();

    $('.uUsuario').val("");
    $('.uUsuario').val(usuario);
    $('.mUserTitle').text('Editar usuario');

    // llenar slect de personal
    $.ajax({
        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
        method: "POST",
        data: 'Uid=' + id_usuario + '&editar_usuario_select_personal=true',
        success: function (data) {
            // data = JSON.parse(data);
            console.log(data);
            // console.log(data);
            $('.euNombre').html('');
            $('.euNombre').append(data);

        }
    });

    // llenar slect de rol
    $.ajax({
        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
        method: "POST",
        data: 'Uid=' + id_rol + '&editar_usuario_select_rol=true',
        success: function (data) {
            // console.log(data);
            $('.euRol').html('');
            $('.euRol').append(data);

        }
    });

    // llenar slect de horario
    $.ajax({
        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
        method: "POST",
        data: 'Uid=' + id_usuario + '&editar_usuario_select_horario=true',
        success: function (data) {
            // console.log(data);
            $('.euHorario').html('');
            $('.euHorario').append(data);
            console.log(data);
            if ($('.euRol option:selected').text() == "ADMINISTRADOR") {
                $('.euHorario').attr('disabled', true);
                $('.euHorario').val("1");
            } else {
                $('.euHorario').attr('disabled', false);
            }

        }
    });



    $('.euEstado').html('');
    $('.uNClave').val("");
    $('.uSNClave').val("");

    if (estado == "1") {
        $('.euEstado').append('<option value="1" selected>Activo</option>');
        $('.euEstado').append('<option value="0" >Inactivo</option>');
    } else {
        $('.euEstado').append('<option value="0" selected>Inactivo</option>');
        $('.euEstado').append('<option value="1">Activo</option>');

    }
    // $('.euClave').html('');

    // $('.euClave').append('\
    // <label class="label">Clave anterior</label>\
    // <div class="control">\
    //     <input class="input" type="password" placeholder="Clave">\
    // </div>');

    $('.btnUsuarioForm').html('');
    $('.btnUsuarioForm').append('Guardar cambios');
    $('.btnUsuarioForm').attr('id', id_usuario);


    $('.btnUsuarioForm').removeClass('nuevoUsuario');
    $('.btnUsuarioForm').addClass('editarUsuarioF');



});

//Para editar personal
$(document).on('click', '.editarPersonal', function () {
    $('.mPersonTitle').text('');
    $('.mPersonTitle').text('Editar personal');
    let id_personal = $(this).attr('id');
    // var id_rol = $(this).attr('rol');
    var estado = $(this).attr('estado');

    var row = $(this).closest('tr');
    var nombre = row.children().eq(0).text();
    var nombre = nombre.split(' ');
    var cedula = row.children().eq(1).text();
    var telefono = row.children().eq(2).text();
    var correo = row.children().eq(3).text();
    var fecha_nacimiento = row.children().eq(4).text();

    $('.pNombre').val("");
    $('.pNombre').val(nombre[0]);

    $('.pNombre2').val("");
    $('.pNombre2').val(nombre[1]);

    $('.pApellido').val("");
    $('.pApellido').val(nombre[2]);

    $('.pApellido2').val("");
    $('.pApellido2').val(nombre[3]);


    $('.pCedula').val("");
    $('.pCedula').val(cedula);
    $('.pTelefono').val("");
    $('.pTelefono').val(telefono);
    $('.pEmail').val("");
    $('.pEmail').val(correo);
    $('.pFechaNacimiento').val("");
    $('.pFechaNacimiento').val(fecha_nacimiento);

    $('.pEstado').html('');
    if (estado == "1") {
        $('.pEstado').append('<option value="1" selected>Activo</option>');
        $('.pEstado').append('<option value="0" >Inactivo</option>');
    } else {
        $('.pEstado').append('<option value="0" selected>Inactivo</option>');
        $('.pEstado').append('<option value="1">Activo</option>');

    }
    $('.btnPersonalForm').html('');
    $('.btnPersonalForm').append('Guardar cambios');
    $('.btnPersonalForm').attr('id', id_personal);

    $('.btnPersonalForm').removeClass('nuevoPersonal');
    $('.btnPersonalForm').addClass('editarPersonalF');

});

//Para editar horario
$(document).on('click', '.editarHorario', function () {
    $('.mHorarioTitle').text('');
    $('.mHorarioTitle').text('Editar horario');
    let id_horario = $(this).attr('id');
    var row = $(this).closest('tr');
    var hora_inicio = row.children().eq(0).text();
    var hora_inicio_almuerzo = row.children().eq(1).text();
    var hora_fin_almuerzo = row.children().eq(2).text();
    var hora_fin = row.children().eq(3).text();

    $('.hInicio').val("");
    $('.hInicio').val(moment(hora_inicio, 'HH:mm').format('HH:mm'));

    $('.hAlmuerzoInicio').val("");
    $('.hAlmuerzoInicio').val(moment(hora_inicio_almuerzo, 'HH:mm').format('HH:mm'));

    $('.hAlmuerzoFin').val("");
    $('.hAlmuerzoFin').val(moment(hora_fin_almuerzo, 'HH:mm').format('HH:mm'));

    $('.hFin').val("");
    $('.hFin').val(moment(hora_fin, 'HH:mm').format('HH:mm'));

    $('.btnHorarioForm').html('');
    $('.btnHorarioForm').append('Guardar cambios');
    $('.btnHorarioForm').attr('id', id_horario);

    $('.btnHorarioForm').removeClass('nuevoHorario');
    $('.btnHorarioForm').addClass('editarHorarioF');


})



//Para nuevo usuario
$(document).on('click', '#nuevo_usuario', function () {
    $('.mUserTitle').text('Nuevo usuario');

    // llenar slect de personal
    $.ajax({
        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
        method: "POST",
        data: 'editar_usuario_select_personal=true',
        success: function (data) {
            // console.log(data);
            $('.euNombre').html('');
            $('.euNombre').append(data);

        }
    });

    // llenar slect de rol
    $.ajax({
        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
        method: "POST",
        data: 'editar_usuario_select_rol=true',
        success: function (data) {
            // console.log(data);
            $('.euRol').html('');
            $('.euRol').append(data);

        }
    });

    // llenar select de horario
    $.ajax({
        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
        method: "POST",
        data: 'editar_usuario_select_horario=true',
        success: function (data) {
            // console.log(data);
            $('.euHorario').html('');
            $('.euHorario').append(data);

        }
    });

    // llenar slect de estado
    $('.euHorario').attr('disabled', false);
    $('.euHorario').val("1");
    $('.uUsuario').val("");
    $('.uNClave').val("");
    $('.uSNClave').val("");

    $('.euEstado').html('');
    $('.euEstado').append('<option value="" selected>Seleccione un estado</option>');
    $('.euEstado').append('<option value="1">Activo</option>');
    $('.euEstado').append('<option value="0">Inactivo</option>');
    $('.euClave').html('');


    $('.btnUsuarioForm').html('');
    $('.btnUsuarioForm').append('Guardar');
    $('.btnUsuarioForm').removeAttr('id');


    $('.btnUsuarioForm').removeClass('editarUsuarioF');
    $('.btnUsuarioForm').addClass('nuevoUsuario');



})

//Para nuevo personal
$(document).on('click', '#nuevo_personal', function () {
    $('.mPersonTitle').text('Nuevo personal');
    $('.pNombre').val("");
    $('.pNombre2').val("");
    $('.pApellido').val("");
    $('.pApellido2').val("");
    $('.pEmail').val("");
    $('.pTelefono').val("");
    $('.pCedula').val("");

    $('.pFechaNacimiento').val("")


    $('.pEstado').html('');
    $('.pEstado').append('<option value="" selected>Seleccione un estado</option>');
    $('.pEstado').append('<option value="1">Activo</option>');
    $('.pEstado').append('<option value="0">Inactivo</option>');

    $('.btnPersonalForm').html('');
    $('.btnPersonalForm').append('Guardar');
    $('.btnPersonalForm').removeAttr('id');

    $('.btnPersonalForm').removeClass('editarPersonalF');
    $('.btnPersonalForm').addClass('nuevoPersonal');


});

//Para nuevo horario
$(document).on('click', '#nuevo_horario', function () {
    $('.mHorarioTitle').text('Nuevo horario');
    $('.hInicio').val("");
    $('.hAlmuerzoInicio').val("");
    $('.hAlmuerzoFin').val("");
    $('.hFin').val("");

    $('.btnHorarioForm').html('');
    $('.btnHorarioForm').append('Guardar');
    $('.btnHorarioForm').removeAttr('id');

    $('.btnHorarioForm').removeClass('editarHorarioF');
    $('.btnHorarioForm').addClass('nuevoHorario');


})

//Submit Usuario
$(document).on('submit', '#mUsuario', function (e) {
    // debugger;
    e.stopImmediatePropagation();
    e.preventDefault();
    // e.stopPropagation();
    // console.log(e);

    u_valid = !u_valid_array.includes(false);
    if (u_valid) {

        console.log($('.btnUsuarioForm').attr('id'));


        var formData = new FormData(document.getElementById("mUsuario"));

        if ($('.nuevoUsuario').length != 0) {
            var accion = 'nuevo_usuario';
        } else if ($('.editarUsuarioF').length != 0) {
            var accion = 'editar_usuario';
            // formData.append('id_usuario', $('.btnUsuarioForm').attr('id'));
            formData.append('id_usuario', $('.btnUsuarioForm').attr('id'));
        }
        valido = validar(accion);
        // if (!valido) return true;
        // 
        console.log(valido);
        if (valido) {
            // debugger;
            var clave = $('.uNClave').val();
            var clave2 = $('.uSNClave').val();
            if (accion == 'editar_usuario') {
                if (clave.length != 0 || clave2.length != 0) {
                    if (clave == "") {
                        Swal.fire(
                            '¡Error!',
                            'Ingrese una clave',
                            'error'
                        )

                    } else if (clave2 == "") {
                        Swal.fire(
                            '¡Error!',
                            'Repita la clave',
                            'error'
                        )

                    } else if (clave == clave2) {
                        Swal.fire({
                            title: '¿Esta seguro de cambiar la clave?',
                            text: "Usted va a modificar la clave de este usuario, ¿Continuar?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, cambiar!',
                            cancelButtonText: 'No, cancelar!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                formData.append(accion, true);

                                // console.log(formData);
                                $.ajax({
                                    url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                                    method: "POST",
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function (data) {
                                        console.log(data);
                                        if (data == 1) {
                                            Swal.fire(
                                                '¡Guardado!',
                                                'El usuario ha sido guardado.',
                                                'success'
                                            ).then(function () {
                                                location.reload();
                                            });

                                        } else if (data == 0) {
                                            Swal.fire(
                                                '¡Error!',
                                                'Ha ocurrido un error, intente de nuevo mas tarde',
                                                'error'
                                            ).then(function () {
                                                location.reload();
                                            });
                                        } else if (data == 2) {
                                            Swal.fire(
                                                '¡Error!',
                                                'El usuario ya existe!',
                                                'error'
                                            )
                                        } else if (data = "error_s") {
                                            Swal.fire(
                                                '¡Error!',
                                                'No puedes editar la informacion de este usuaio',
                                                'error'
                                            )

                                        }

                                    }
                                });
                            }
                        });

                    } else {
                        Swal.fire(
                            '¡Error!',
                            'Las claves no coinciden',
                            'error'
                        )
                        valido = false;
                    }
                } else {
                    formData.append(accion, true);

                    // console.log(formData);
                    $.ajax({
                        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                        method: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            if (data == 1) {
                                Swal.fire(
                                    '¡Guardado!',
                                    'El usuario ha sido guardado.',
                                    'success'
                                ).then(function () {
                                    location.reload();
                                });

                            } else if (data == 0) {
                                Swal.fire(
                                    '¡Error!',
                                    'Ha ocurrido un error, intente de nuevo mas tarde',
                                    'error'
                                ).then(function () {
                                    location.reload();
                                });
                            } else if (data == 2) {
                                Swal.fire(
                                    '¡Error!',
                                    'El usuario ya existe!',
                                    'error'
                                )
                            } else if (data = "error_s") {
                                Swal.fire(
                                    '¡Error!',
                                    'No puedes editar la informacion de este usuaio',
                                    'error'
                                )

                            }

                        }
                    });
                }
            } else {
                formData.append(accion, true);

                // console.log(formData);
                $.ajax({
                    url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire(
                                '¡Guardado!',
                                'El usuario ha sido guardado.',
                                'success'
                            ).then(function () {
                                location.reload();
                            });

                        } else if (data == 0) {
                            Swal.fire(
                                '¡Error!',
                                'Ha ocurrido un error, intente de nuevo mas tarde',
                                'error'
                            ).then(function () {
                                location.reload();
                            });
                        } else if (data == 2) {
                            Swal.fire(
                                '¡Error!',
                                'El usuario ya existe!',
                                'error'
                            )
                        }

                    }
                });
            }

        }
    } else {
        Swal.fire(
            '¡Error!',
            'Revisa los campos en rojo',
            'error'
        );
    }

});

//Submit Personal
$(document).on('submit', '#mPersonal', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();

    p_valid = !p_valid_array.includes(false);

    if (p_valid) {

        var formData = new FormData(this);

        if ($('.nuevoPersonal').length != 0) {
            accion = 'nuevo_personal';
        } else if ($('.editarPersonalF').length != 0) {
            accion = 'editar_personal';
            formData.append('id_personal', $('.editarPersonalF').attr('id'));
        }

        formData.append(accion, true);

        valido = validarPersonal(accion);
        console.log(valido);
        if (valido) {

            Swal.fire({
                title: '¿Esta seguro de guardar el personal?',
                text: "Usted va a guardar el personal, ¿Continuar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, guardar!',
                cancelButtonText: 'No, cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                        method: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            if (data == 1) {
                                Swal.fire(
                                    '¡Guardado!',
                                    'El personal ha sido guardado.',
                                    'success'
                                ).then(function () {
                                    location.reload();
                                });

                            } else if (data == 0) {
                                Swal.fire(
                                    '¡Error!',
                                    'Ha ocurrido un error, intente de nuevo mas tarde',
                                    'error'
                                ).then(function () {
                                    location.reload();
                                });
                            } else if (data == 2) {
                                Swal.fire(
                                    '¡Error!',
                                    'El personal ya existe!',
                                    'error'
                                )
                            } else if (data == "error_s") {
                                Swal.fire(
                                    '¡Error!',
                                    'No puedes editar la informacion de este personal',
                                    'error'
                                )
                            }


                        }
                    });
                }
            });
        }
    } else {
        Swal.fire(
            '¡Error!',
            'Revisa los campos en rojo',
            'error'
        );
    }

});

//Submit Horario
$(document).on('submit', '#mHorario', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();

    var formData = new FormData(this);

    if ($('.nuevoHorario').length != 0) {
        accion = 'nuevo_horario';
    } else if ($('.editarHorarioF').length != 0) {
        accion = 'editar_horario';
        formData.append('id_horario', $('.editarHorarioF').attr('id'));
    }

    formData.append(accion, true);

    valido = validarHorario(accion);
    console.log(valido);
    if (valido) {

        Swal.fire({
            title: '¿Esta seguro de guardar el horario?',
            text: "Usted va a guardar el horario, ¿Continuar?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'No, cancelar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire(
                                '¡Guardado!',
                                'El horario ha sido guardado.',
                                'success'
                            ).then(function () {
                                location.reload();
                            });

                        } else if (data == 0) {
                            Swal.fire(
                                '¡Error!',
                                'Ha ocurrido un error, intente de nuevo mas tarde',
                                'error'
                            ).then(function () {
                                location.reload();
                            });
                        } else if (data == 2) {
                            Swal.fire(
                                '¡Error!',
                                'El horario ya existe!',
                                'error'
                            )
                        } else if (data == "error_s") {
                            Swal.fire(
                                '¡Error!',
                                'No puedes editar la informacion de este horario',
                                'error'
                            )
                        }
                    }
                });
            }
        });
    }
});


$(document).on('change', '.euRol', function () {
    if ($('.euRol option:selected').text() == "ADMINISTRADOR") {
        $('.euHorario').val("1");
        $('.euHorario').attr('disabled', true);
    } else {
        $('.euHorario').attr('disabled', false);


    }


});

//Submit USuario
function validar(accion) {
    var r = false;
    var personal = $('.euNombre').val();
    var usuario = $('.uUsuario').val();
    var rol = $('.euRol').val();
    var estado = $('.euEstado').val();
    var clave = $('.uNClave').val();
    var clave2 = $('.uSNClave').val();


    // console.log("Accion: " + "editar_usuario");
    // console.log("Accion: " + accion);

    // console.log("Personal: " + personal);
    // console.log("ID_ USUARIO: " + $('.btnUsuarioForm').attr('id'));
    // console.log("Usuario: " + usuario);
    // console.log("Rol: " + rol);
    // console.log("Estado: " + estado);
    // console.log("Clave: " + clave);
    // console.log("Clave2: " + clave2);

    if (personal == "") {
        Swal.fire(
            '¡Error!',
            'Seleccione un personal',
            'error'
        )
        return r;
    } else if (usuario == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese un usuario',
            'error'
        )
        return r;
    } else if (rol == "") {
        Swal.fire(
            '¡Error!',
            'Seleccione un rol',
            'error'
        )
        return r;
    } else if (estado == "") {
        Swal.fire(
            '¡Error!',
            'Seleccione un estado',
            'error'
        )
        return r;


    } else {
        if (accion == 'nuevo_usuario') {
            if (clave == "") {
                Swal.fire(
                    '¡Error!',
                    'Ingrese una clave',
                    'error'
                )
                return r;
            } else if (clave2 == "") {
                Swal.fire(
                    '¡Error!',
                    'Repita la clave',
                    'error'
                )
                return r;

            }
            if (clave != clave2) {
                Swal.fire(
                    '¡Error!',
                    'Las claves no coinciden',
                    'error'
                )
                return r;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }


}

//para validar los datos de personal
function validarPersonal(accion) {
    var r = false;
    var nombre = $('.pNombre').val();
    var nombre2 = $('.pNombre2').val();
    var apellido = $('.pApellido').val();
    var apellido2 = $('.pApellido2').val();
    var cedula = $('.pCedula').val();
    var correo = $('.pCorreo').val();
    var telefono = $('.pTelefono').val();
    // var direccion = $('.euDireccion').val();
    // var rol = $('.euRol').val();
    var estado = $('.pEstado').val();

    // console.log("Accion: " + "editar_usuario");
    // console.log("Accion: " + accion);

    // console.log("Nombre: " + nombre);
    // console.log("Nombre2: " + nombre2);
    // console.log("Apellido: " + apellido);
    // console.log("Apellido2: " + apellido2);

    // console.log("Cedula: " + cedula);
    // console.log("Correo: " + correo);
    // console.log("Telefono: " + telefono);
    // console.log("Direccion: " + direccion);
    // console.log("Rol: " + rol);
    // console.log("Estado: " + estado);

    if (nombre == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese un nombre',
            'error'
        )
        return r;
    } else if (apellido == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese un apellido',
            'error'
        )
        return r;
    } else if (cedula == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese una cedula',
            'error'
        )
        return r;
    }
    // else if (correo == "") {
    //     Swal.fire(
    //         '¡Error!',
    //         'Ingrese un correo',
    //         'error'
    //     )
    //     return r;
    // } else if (telefono == "") {
    //     Swal.fire(
    //         '¡Error!',
    //         'Ingrese un telefono',
    //         'error'
    //     )
    //     return r;
    // } else if (direccion == "") {
    //     Swal.fire(
    //         '¡Error!',
    //         'Ingrese una direccion',
    //         'error'
    //     )
    //     return r;
    // } else if (rol == "") {
    //     Swal.fire(
    //         '¡Error!',
    //         'Seleccione un rol',
    //         'error'
    //     )
    //     return r;
    // } 
    else if (estado == "") {
        Swal.fire(
            '¡Error!',
            'Seleccione un estado',
            'error'
        )
        return r;
    } else {
        return true;
    }

}

//para validar los datos de horario
function validarHorario(accion) {
    var r = false;
    var hora_inicio = $('.hInicio').val();
    var hora_inicio_almuerzo = $('.hAlmuerzoInicio').val();
    var hora_fin_almuerzo = $('.hAlmuerzoFin').val();
    var hora_fin = $('.hFin').val();

    // console.log("Accion: " + "editar_usuario");
    // console.log("Accion: " + accion);

    // console.log("Hora_inicio: " + hora_inicio);
    // console.log("Hora_inicio_almuerzo: " + hora_inicio_almuerzo);
    // console.log("Hora_fin_almuerzo: " + hora_fin_almuerzo);
    // console.log("Hora_fin: " + hora_fin);

    if (hora_inicio == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese una hora de inicio',
            'error'
        )
        return r;
    } else if (hora_inicio_almuerzo == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese una hora de inicio de almuerzo',
            'error'
        )
        return r;
    } else if (hora_fin_almuerzo == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese una hora de fin de almuerzo',
            'error'
        )
        return r;
    } else if (hora_fin == "") {
        Swal.fire(
            '¡Error!',
            'Ingrese una hora de fin',
            'error'
        )
        return r;
    } else {
        return true;
    }
}


function togglePassword(id) {
    // var input = document.getElementById(id);
    var icon = $('#btn' + id).children().children();
    var input = $('#password' + id);
    if (input.attr('type') == 'password') {
        input.attr('type', 'text');
        icon.removeClass('fa fa-eye-slash');
    } else {
        input.attr('type', 'password');
        icon.addClass('fa fa-eye');
    }
}