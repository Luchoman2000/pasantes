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
    $('.pNombre').val(nombre[0].toUpperCase());

    $('.pNombre2').val("");
    $('.pNombre2').val(nombre[1].toUpperCase());
    
    $('.pApellido').val("");
    $('.pApellido').val(nombre[2].toUpperCase());

    $('.pApellido2').val("");
    $('.pApellido2').val(nombre[3].toUpperCase());
    

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

    // llenar slect de estado

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



//Guardar cambios del usuario Nuevo / Editar


// $(document).on('click', '.nuevoUsuario', function () {
//     validar();

// });
// $(document).on('click', '.editarUsuarioF', function () {
//     validar();
// });

//Submit Usuario
$('#mUsuario').submit(function (e) {
    // debugger;
    e.stopImmediatePropagation();
    e.preventDefault();
    // e.stopPropagation();
    // console.log(e);

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

        // } else {}

    }
    // else {
    //     Swal.fire(
    //         '¡Error!',
    //         'Ha ocurrido un error, intente de nuevo mas tarde',
    //         'error'
    //     ).then(function () {
    //         location.reload();
    //     });
    // }

});

//Submit Personal
$(document).on('submit', '#mPersonal', function(e) {
    e.stopImmediatePropagation();
    e.preventDefault();

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
                        }

                    }
                });
            }
        });
    }

});

function validar(accion) {
    var r = false;
    var personal = $('.euNombre').val();
    var usuario = $('.uUsuario').val();
    var rol = $('.euRol').val();
    var estado = $('.euEstado').val();
    var clave = $('.uNClave').val();
    var clave2 = $('.uSNClave').val();


    // console.log("Accion: " + "editar_usuario");
    console.log("Accion: " + accion);

    console.log("Personal: " + personal);
    console.log("ID_ USUARIO: " + $('.btnUsuarioForm').attr('id'));
    console.log("Usuario: " + usuario);
    console.log("Rol: " + rol);
    console.log("Estado: " + estado);
    console.log("Clave: " + clave);
    console.log("Clave2: " + clave2);

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
    console.log("Accion: " + accion);

    console.log("Nombre: " + nombre);
    console.log("Nombre2: " + nombre2);
    console.log("Apellido: " + apellido);
    console.log("Apellido2: " + apellido2);

    console.log("Cedula: " + cedula);
    console.log("Correo: " + correo);
    console.log("Telefono: " + telefono);
    // console.log("Direccion: " + direccion);
    // console.log("Rol: " + rol);
    console.log("Estado: " + estado);

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