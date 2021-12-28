//check input in live time
var valid = true;
var valid_array = [];
$(function () {

    //Check nombres
    $('#uNombres').on('keyup', function () {
        var nombres = $('#uNombres').val();
        var pattern = /^([a-zA-ZÀ-ÿÑñ]{4,15})?\s{0,1}([a-zA-ZÀ-ÿÑñ]{4,15})$/;
        if (pattern.test(nombres) && nombres.length > 3 && nombres.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid_array[0] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid_array[0] = false;
        }
    });

    //Check apellidos
    $('#uApellidos').on('keyup', function () {
        var apellidos = $('#uApellidos').val();
        var pattern = /^([a-zA-ZÀ-ÿÑñ]{4,15})?\s{0,1}([a-zA-ZÀ-ÿÑñ]{4,15})$/;
        if (pattern.test(apellidos) && apellidos.length > 0 && apellidos.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid_array[1] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid_array[1] = false;
        }
    });

    //Check cedula
    $('#uCedula').on('keyup', function () {
        var cedula = $('#uCedula').val();
        var pattern = /^[0-9]*$/;
        if (pattern.test(cedula) && cedula.length == 10) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid_array[2] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid_array[2] = false;
        }
    });

    //Check telefono
    $('#uTelefono').on('keyup', function () {
        var telefono = $('#uTelefono').val();
        var pattern = /^[0-9]*$/;
        if (pattern.test(telefono) && telefono.length == 10 || telefono.length == "") {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid_array[3] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid_array[3] = false;
        }
    });

    //Check correo
    $('#uCorreo').on('keyup', function () {
        var correo = $('#uCorreo').val();
        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (pattern.test(correo) && correo.length > 0 && correo.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid_array[4] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid_array[4] = false;
        }
    });

    // Check direccion
    $('#uDireccion').on('keyup', function () {
        var direccion = $('#uDireccion').val();
        var pattern = /[\w',-\\/.\s]/;
        if (pattern.test(direccion) && direccion.length > 0 && direccion.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid_array[5] = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid_array[5] = false;
        }
    });
});


$(document).on('submit', "#PerfilForm", function (e) {
    e.preventDefault();
    valid = !valid_array.includes(false);
    console.log(valid);
    if (valid) {

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Tus datos serán actualizados",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                var formData = $(this).serialize();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: formData,
                    success: function (data) {
                        console.log(data);
                        if (data == 1) {

                            Swal.fire(
                                '¡Éxito!',
                                'Se ha actualizado tu perfil',
                                'success'
                            ).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                '¡Error!',
                                'No se ha podido actualizar tu perfil',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    } else {
        Swal.fire(
            '¡Error!',
            'Revisa los campos en rojo',
            'error'
        );
    }

});