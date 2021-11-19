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
                    console.log(data);
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
    console.log("EDITANDOO");

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


});

//Para editar horas registro de pasante desde tabla
$(document).on('click', '.editarRegistro', function () {
    // id fila seleccionada
    var id = $(this).attr('id');
    var row = $(this).closest('tr');

    console.log("EDITANDOO");
    console.log("Ingreso: "+ row.children().eq(1).text());
    console.log("Almuerzo_inicio: "+ row.children().eq(2).text());
    console.log("Almuerzo_fin: "+ row.children().eq(3).text());
    console.log("Salida: "+ row.children().eq(4).text());
    console.log(id);

    var h_entrada = row.children().eq(1).text();
    var h_almuerzo_start = "";
    var h_almuerzo_end = "";
    var h_salida = "";

    $('#h_entrada_u').next().text(h_entrada);
    $('#h_entrada_u').val(h_entrada);
    $('#asiId').val(id);


    if (row.children().eq(2).text() != "Sin almuerzo" && row.children().eq(2).text() != "--:--:--") {
        h_almuerzo_start = row.children().eq(2).text();
        $('#h_almuerzo_start_u').next().text(h_almuerzo_start);
        $('#h_almuerzo_start_u').val(h_almuerzo_start);
    } else {
        $('#h_almuerzo_start_u').next().text("No marcado");
        $('#h_almuerzo_start_u').val("00:00:00");
    }
    if (row.children().eq(3).text().length != 0 && row.children().eq(3).text() != "--:--:--") {
        h_almuerzo_end = row.children().eq(3).text();
        $('#h_almuerzo_end_u').next().text(h_almuerzo_end);
        $('#h_almuerzo_end_u').val(h_almuerzo_end);
    } else {
        $('#h_almuerzo_end_u').next().text("No marcado");
        $('#h_almuerzo_end_u').val("00:00:00");
    }
    if (row.children().eq(4).text() != "--:--:--") {
        h_salida = row.children().eq(4).text();
        $('#h_salida_u').next().text(h_salida);
        $('#h_salida_u').val(h_salida);
    } else {
        $('#h_salida_u').next().text("No marcado");
        $('#h_salida_u').val("00:00:00");
    }


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
                    console.log(data);
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


//Para guardar horas editadas
$(document).on('submit', '#guardar_edicion', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    var formdata = new FormData(this);
    // var form = $(this);

    console.log(formdata);
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Guardarás los cambios realizados en el registro de este usuario, ¡No podrás revertir esto!",
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
                    console.log(data);
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
                    }


                }
            });
        }
    });

});