//Para borrar registro de pasante
$(document).on('click', '#borrar_registro', function () {
    // console.log($(this).parent().parent().parent().attr('id'));
    var id = $(this).parent().parent().parent().attr('id');
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Barrarás el registro de este usuario, ¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: '¡No, cancelar!',

    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                method: "POST",
                data: 'id=' + id + '&borrar_registro=true',
                success: function (data) {
                    // console.log(data);
                    if (data == 'ok') {
                        Swal.fire(
                            '¡Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        )
                        $('#' + id).remove();


                    } else if (data == 'error') {
                        Swal.fire(
                            '¡Error!',
                            'Ha ocurrido un error.',
                            'error'
                        )
                    }

                }
            });
        }
    });
});

//Para editar horas registro de pasante
$(document).on('click', '#editar_registro', function () {
    // id fila seleccionada
    var id = $(this).parent().parent().parent().attr('id');
    var id_p = $(this).parent().parent().parent().next().next().val();
    // console.log(id_p);
    // console.log("EDITANDOO");

    var h_entrada = $('#' + id).children().children().find('div.h_entrada').text();
    var h_almuerzo_start = "";
    var h_almuerzo_end = "";
    var h_salida = "";

    $('#h_entrada_u').next().text(h_entrada);
    $('#h_entrada_u').val(h_entrada);
    $('#asiId').val(id);


    if ($('#' + id).children().children().find('div.h_almuerzo_start').length != 0) {
        h_almuerzo_start = $('#' + id).children().children().find('div.h_almuerzo_start').text();
        $('#h_almuerzo_start_u').next().text(h_almuerzo_start);
        $('#h_almuerzo_start_u').val(h_almuerzo_start);
    } else {
        $('#h_almuerzo_start_u').next().text("No marcado");
        $('#h_almuerzo_start_u').val("00:00:00");
    }
    if ($('#' + id).children().children().find('div.h_almuerzo_end').length != 0) {
        h_almuerzo_end = $('#' + id).children().children().find('div.h_almuerzo_end').text();
        $('#h_almuerzo_end_u').next().text(h_almuerzo_end);
        $('#h_almuerzo_end_u').val(h_almuerzo_end);
    } else {
        $('#h_almuerzo_end_u').next().text("No marcado");
        $('#h_almuerzo_end_u').val("00:00:00");
    }
    if ($('#' + id).children().children().find('div.h_salida').length != 0) {
        h_salida = $('#' + id).children().children().find('div.h_salida').text();
        $('#h_salida_u').next().text(h_salida);
        $('#h_salida_u').val(h_salida);
    } else {
        $('#h_salida_u').next().text("No marcado");
        $('#h_salida_u').val("00:00:00");
    }


    fetch(SERVERURL + '/pasantes/ajax/asistencia.ajax.php?getObservacion=' + id).then(response => response.text()).then(result => {
        $('#asi_obserbacion').val(result);
    });

    fetch(SERVERURL + "/pasantes/ajax/perfil.ajax.php?getHorario=" + id_p).then(function (response) {
        return response.json();
    }).then(function (data) {
        // console.log(data);
        if (data == 1) {
            $('.blockHorario').hide();
        } else {
            $('.blockHorario').show();
            $('#hor_entrada').html(data.hor_entrada);
            // var h_limite = $('#hor_limite').text();
            var h_limite = data.hor_limite_entrada;
            $('#hor_limite').text(h_limite);
            var hora_entrada = moment(h_entrada, "HH:mm:ss");
            var horario_entrada = moment(data.hor_entrada, "HH:mm:ss");
            if (hora_entrada <= horario_entrada) {
                $('#asi_estado').text("Puntual");
                $('#asi_estado').css("color", "green");
            } else if (hora_entrada >= horario_entrada && hora_entrada <= moment(horario_entrada, "HH:mm:ss").add(h_limite, 'minutes')) {
                $('#asi_estado').text("Atrasado");
                $('#asi_estado').css("color", "orange");
            } else {
                $('#asi_estado').text("Tarde");
                $('#asi_estado').css("color", "red");
            }

        }

    });

});

//Para editar horas registro de pasante desde tabla
$(document).on('click', '.editarRegistro', function () {

    $('#edit_hora').addClass('is-active');
    // id fila seleccionada
    var id = $(this).attr('id');
    var id_p = $(this).attr('data-idper');
    var row = $(this).closest('tr');

    // console.log(id_p);
    // console.log("EDITANDOO");


    // console.log("EDITANDOO");
    // console.log("Ingreso: " + row.children().eq(1).clone().children().remove().end().text());
    // console.log("Almuerzo_inicio: " + row.children().eq(2).text());
    // console.log("Almuerzo_fin: " + row.children().eq(3).text());
    // console.log("Salida: " + row.children().eq(4).clone().children().remove().end().text());
    // console.log(id);

    var h_entrada = row.children().eq(1).clone().children().remove().end().text().replace(/\s/g, '');
    var h_almuerzo_start = "";
    var h_almuerzo_end = "";
    var h_salida = "";

    $('#h_entrada_u').next().text(h_entrada);
    $('#h_entrada_u').val(h_entrada);
    $('#asiId').val(id);


    if (row.children().eq(2).text() != "Sin almuerzo" && row.children().eq(2).text() != "--:--:--") {
        h_almuerzo_start = row.children().eq(2).clone().children().remove().end().text().replace(/\s/g, '');
        $('#h_almuerzo_start_u').next().text(h_almuerzo_start);
        $('#h_almuerzo_start_u').val(h_almuerzo_start);
    } else {
        $('#h_almuerzo_start_u').next().text("No marcado");
        $('#h_almuerzo_start_u').val("00:00:00");
    }
    if (row.children().eq(3).text().length != 0 && row.children().eq(3).text() != "--:--:--") {
        h_almuerzo_end = row.children().eq(3).clone().children().remove().end().text().replace(/\s/g, '');
        $('#h_almuerzo_end_u').next().text(h_almuerzo_end);
        $('#h_almuerzo_end_u').val(h_almuerzo_end);
    } else {
        $('#h_almuerzo_end_u').next().text("No marcado");
        $('#h_almuerzo_end_u').val("00:00:00");
    }
    if (row.children().eq(4).text() != "--:--:--") {
        h_salida = row.children().eq(4).clone().children().remove().end().text().replace(/\s/g, '');
        $('#h_salida_u').next().text(h_salida);
        $('#h_salida_u').val(h_salida);
    } else {
        $('#h_salida_u').next().text("No marcado");
        $('#h_salida_u').val("00:00:00");
    }

    fetch(SERVERURL + '/pasantes/ajax/asistencia.ajax.php?getObservacion=' + id).then(response => response.text()).then(result => {
        $('#asi_obserbacion').val(result);
    });

    fetch(SERVERURL + "/pasantes/ajax/perfil.ajax.php?getHorario=" + id_p).then(function (response) {
        return response.json();
    }).then(function (data) {
        // console.log(data);
        if (data == 1) {
            $('.blockHorario').hide();
        } else {
            $('.blockHorario').show();
            $('#hor_entrada').html(data.hor_entrada);
            var h_limite = $('#hor_limite').text();
            var hora_entrada = moment(h_entrada, "HH:mm:ss");
            var horario_entrada = moment(data.hor_entrada, "HH:mm:ss");
            if (hora_entrada <= horario_entrada) {
                $('#asi_estado').text("Puntual");
                $('#asi_estado').css("color", "green");
            } else if (hora_entrada >= horario_entrada && hora_entrada <= moment(horario_entrada, "HH:mm:ss").add(h_limite, 'minutes')) {
                $('#asi_estado').text("Atrasado");
                $('#asi_estado').css("color", "orange");
            } else {
                $('#asi_estado').text("Tarde");
                $('#asi_estado').css("color", "red");
            }

        }

    });

});

//Para crear nueva asistencia
$(document).on('click', '#nueva_asistencia', function () {
    // id fila seleccionada
    var row = $(this).closest('tr');
    var id = row.children().find('input').attr('id');
    // console.log(id);
    swal.fire({
        title: '¿Estás seguro?',
        text: "Marcarás la asistencia de este usuario",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, marcar',
        cancelButtonText: 'No, cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                method: "POST",
                data: 'per_id_C=' + id + '&nueva_asistencia=true',
                success: function (data) {
                    // console.log(data);
                    if (data == 'ok') {
                        Swal.fire(
                            '¡Marcado!',
                            'La asistencia ha sido marcada.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });

                    } else if (data == 'error') {
                        Swal.fire(
                            '¡Error!',
                            'Ha ocurrido un error.',
                            'error'
                        ).then(function () {
                            location.reload();
                        });
                    }

                }
            });
        }
    });



})

$(document).on('change', '#h_entrada_u', function () {
    var h_limite = $('#hor_limite').text();
    var hora_entrada = moment($(this).val(), "HH:mm:ss");
    var horario_entrada = moment($('#hor_entrada').text(), "HH:mm:ss");
    if (hora_entrada <= horario_entrada) {
        $('#asi_estado').text("Puntual");
        $('#asi_estado').css("color", "green");
    } else if (hora_entrada >= horario_entrada && hora_entrada <= moment(horario_entrada, "HH:mm:ss").add(h_limite, 'minutes')) {
        $('#asi_estado').text("Atrasado");
        $('#asi_estado').css("color", "orange");
    } else {
        $('#asi_estado').text("Tarde");
        $('#asi_estado').css("color", "red");
    }

})


//Para guardar horas editadas
$(document).on('submit', '#guardar_edicion', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    var formdata = new FormData(this);
    // var form = $(this);
    var h_entrada = $('#h_entrada_u').val();
    var h_almuerzo_start = $('#h_almuerzo_start_u').val();
    var h_almuerzo_end = $('#h_almuerzo_end_u').val();
    var h_salida = $('#h_salida_u').val();

    // console.log("Ingreso: " + h_entrada);
    // console.log("Almuerzo_inicio: " + h_almuerzo_start);
    // console.log("Almuerzo_fin: " + h_almuerzo_end);
    // console.log("Salida: " + h_salida);

    //Validar orden de horas
    // if (h_almuerzo_start != "00:00:00" && h_almuerzo_end != "00:00:00") {
    //     if (h_entrada > h_almuerzo_start) {
    //         Swal.fire(
    //             '¡Error!',
    //             'La hora de inicio del almuerzo no puede ser menor que la hora de entrada.',
    //             'error'
    //         )
    //     } else if (h_almuerzo_end > h_salida) {
    //         Swal.fire(
    //             '¡Error!',
    //             'La hora de fin del almuerzo no puede ser mayor a la hora de salida.',
    //             'error'
    //         )
    //     }
    // } else {



    // console.log(formdata);
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Guardarás los cambios realizados en el registro de este usuario",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, guardar!',
        cancelButtonText: '¡No, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                method: "POST",
                // data: form.serialize(),
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data);
                    if (data == 'ok') {
                        Swal.fire(
                            '¡Guardado!',
                            'Los cambios se han guardado.',
                            'success'
                        ).then(function () {
                            location.reload();
                        })
                    } else if (data == 'error') {
                        Swal.fire(
                            'Atención!',
                            'No se actualizó ningúna fila.',
                            'warning'
                        ).then(function () {
                            location.reload();
                        })
                    } else if (data == 'error_h') {
                        Swal.fire(
                            'Atención!',
                            'La hora de entrada debe ser menor a la hora de salida.',
                            'warning'
                        )
                    } else if (data == 'error_a') {
                        Swal.fire(
                            'Atención!',
                            'No se ha marcado el inicio del almuerzo',
                            'warning'
                        )
                    } else if (data == 'error_s') {

                        Swal.fire(
                            'Atención!',
                            'Horas no secuenciales',
                            'warning'
                        );
                    } else if (data == 'error_h_entrada') {
                        Swal.fire(
                            'Atención!',
                            'Debe ingresar la hora de entrada',
                            'warning'
                        );
                    }


                }
            });
        }
    });
    // }

});

$(document).on('click', '.btnNuevoRegistroAsi', function () {
    // get today with moment ja
    let today = moment().format('yyyy-MM-DD');
    // console.log(today);
    $('#fecha_n_a').val(today);
    $('.btnreset_h_e').prev().val('00:00:00');
    $('.btnReset_i_a').prev().val('00:00:00');
    $('.btnReset_f_a').prev().val('00:00:00');
    $('.btnReset_s').prev().val('00:00:00');
});

//Para nuevo registro 
$(document).on('submit', '#guardar_nuevo_registro', function (e) {

    e.stopImmediatePropagation();

    e.preventDefault();

    // console.log("Entro");
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Crearás una asistencia a este usuariousuario",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, crear!',
        cancelButtonText: '¡No, cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            var formData = new FormData(this);
            $.ajax({
                url: SERVERURL + "/pasantes/ajax/admin.ajax.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data);
                    if (data == 1) {
                        Swal.fire(
                            '¡Guardado!',
                            'Se ha guardado el registro.',
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
                            'El usuario ya tiene un registro de asistencia en ese día',
                            'error'
                        )
                    } else if (data == 'error_h') {
                        Swal.fire(
                            'Atención!',
                            'La hora de entrada debe ser menor a la hora de salida.',
                            'warning'
                        )
                    } else if (data == 'error_a') {
                        Swal.fire(
                            'Atención!',
                            'No se ha marcado el inicio del almuerzo',
                            'warning'
                        )
                    } else if (data == 'error_s') {

                        Swal.fire(
                            'Atención!',
                            'Horas no secuenciales',
                            'warning'
                        );
                    } else if (data == 'error_h_entrada') {
                        Swal.fire(
                            'Atención!',
                            'Debe ingresar la hora de entrada',
                            'warning'
                        );
                    }

                }

            })
        }
    });
})





//Resetear horas
$(document).on('click', '.btnReset_h_e', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    $(this).prev().val($('.s_h_entrada').text());
})
$(document).on('click', '.btnReset_i_a', function (e) {

    e.stopImmediatePropagation();
    e.preventDefault();
    $(this).prev().val($('.s_h_salida_a').val());
})
$(document).on('click', '.btnReset_f_a', function (e) {

    e.stopImmediatePropagation();
    e.preventDefault();
    $(this).prev().val($('.s_h_regreso_a').val());
})
$(document).on('click', '.btnReset_s', function (e) {

    e.stopImmediatePropagation();
    e.preventDefault();
    $(this).prev().val($('.s_h_salida').text());
})

//Para llenar acorde al horario
$(document).on('click', '.btnAutoFill', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
})