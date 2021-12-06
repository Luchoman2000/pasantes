function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

// Para marcar el ingreso
$(document).on('click', '.m_entrada', function () {
    // Do click stuff here
    // console.log('IS CLICKEEEEED');
    // $('.m_entrada').removeClass('is-success');
    $('.m_entrada').removeClass('is-light');
    $('.m_entrada').addClass('is-loading');

    $.ajax({
        type: "POST",
        url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
        data: "ingreso=1",
        success: function (response) {
            console.log(response);
            if (response == 1) {


                $('#marcador').append('<div id="almuerzo" style="display: none;" class="almuerzo box">\
            <div class="list-item box">\
                <div class="columns is-mobile">\
                    <div class="column">\
                        <div class="list-item-content is-small">\
                            <div class="list-item-title title is-5">Almuerzo inicio</div>\
                            <div id="des_m_almuerzo_inicio" class="list-item-description has-text-grey">Sin marcar</div>\
                        </div>\
                    </div>\
                    <div class="column">\
                        <div class="list-item-controls is-small">\
                            <div class="buttons is-right">\
                            <button type="submit" id="m_almuerzo_inicio" class="button is-success is-light">\
                                <span class="icon is-small">\
                                    <i class="fa fa-edit"></i>\
                                </span>\
                                <span id="text_m_almuerzo_inicio">Marcar</span>\
                            </button>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>\
            <div class="list-item box">\
                <div class="columns is-mobile">\
                    <div class="column">\
                            <div class="list-item-content is-small">\
                                <div class="list-item-title title is-5">Almuerzo fin</div>\
                                <div id="des_m_almuerzo_fin" class="list-item-description has-text-grey">Sin marcar</div>\
                            </div>\
                        </div>\
                        <div class="column">\
                            <div class="list-item-controls is-small">\
                                <div class="buttons is-right">\
                                <button type="submit" id="m_almuerzo_fin" class="button is-success is-light">\
                                    <span class="icon is-small">\
                                        <i class="fa fa-edit"></i>\
                                    </span>\
                                    <span>Marcar</span>\
                                </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>');

                $('#almuerzo').fadeIn();

                $('.m_entrada').addClass('is-light');
                $('.m_entrada').removeClass('is-loading');
                $('.m_entrada').removeClass('is-success');
                // $('.m_entrada').children('#text_m_entrada').html('✔ Marcado ')
                $('.m_entrada').children('span').remove();
                $('#des_m_entrada').text('Marcado a la hora: ' + moment().format('HH:mm:ss'));
                $('.m_entrada').html('<span>✔ Marcado</span>')
                $('.m_entrada').prop("disabled", true);

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: "success",
                    title: "Marcado con éxito ✔"
                })
            } else if (response == 2) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    },
                    willClose: () => {
                        location.reload();
                    }

                });

                Toast.fire({
                    icon: "error",
                    title: "Ya marcó su entrada 🤐 "
                });
            }
        }
    });
});

// Para marcar el inicio del almuerzo
$(document).on('click', '#m_almuerzo_inicio', function () {
    // Do click stuff here
    // console.log('IS CLICKEEEEED almuerzo inicio');
    // $('.m_entrada').removeClass('is-success');

    $('#m_almuerzo_inicio').removeClass('is-light');
    $('#m_almuerzo_inicio').addClass('is-loading');
    $.ajax({
        type: "POST",
        url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
        data: "almuerzo_inicio=1",
        success: function (response) {
            console.log(response);
            if (response == 1) {
                $('#m_almuerzo_inicio').addClass('is-light');
                $('#m_almuerzo_inicio').removeClass('is-loading');
                $('#m_almuerzo_inicio').removeClass('is-success');
                // $('.m_entrada').children('#text_m_entrada').html('✔ Marcado ')
                $('#m_almuerzo_inicio').children('span').remove();
                $('#des_m_almuerzo_inicio').text('Marcado a la hora: ' + moment().format('HH:mm:ss'));
                $('#m_almuerzo_inicio').html('<span>✔ Marcado</span>')
                $('#m_almuerzo_inicio').prop("disabled", true);

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    }
                })
                let comidas = ['🍕', '🍔', '🌭', '🍗', '🥑', '🥧', '🥓', '🍟', '🍖', '🍛', '🎂']


                Toast.fire({
                    icon: "success",
                    title: "Almuerzo iniciado " + comidas[getRandomInt(comidas.length)]
                })
            } else if (response == 2) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener("mouseenter", Swal.stopTimer)
                        toast.addEventListener("mouseleave", Swal.resumeTimer)
                    },
                    willClose: () => {
                        location.reload();
                    }

                });

                Toast.fire({
                    icon: "error",
                    title: "Ya marcó su entrada de almuerzo 🤐 "
                });
            }
        }
    });
});

// Para marcar el fin del almuerzo
$(document).on('click', '#m_almuerzo_fin', function () {
    // Do click stuff here
    // console.log('IS CLICKEEEEED almuerzo fin');
    // $('.m_entrada').removeClass('is-success');

    if (!$('#m_almuerzo_inicio').is(':disabled')) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer)
                toast.addEventListener("mouseleave", Swal.resumeTimer)
            }

        });

        Toast.fire({
            icon: "error",
            title: "Debe marcar primero el inicio del almuerzo 😑 "
        });
    } else {
        $('#m_almuerzo_fin').removeClass('is-light');
        $('#m_almuerzo_fin').addClass('is-loading');

        $.ajax({
            type: "POST",
            url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
            data: "almuerzo_fin=1",
            success: function (response) {
                console.log(response);
                if (response == 1) {
                    $('#m_almuerzo_fin').addClass('is-light');
                    $('#m_almuerzo_fin').removeClass('is-loading');
                    $('#m_almuerzo_fin').removeClass('is-success');
                    // $('.m_entrada').children('#text_m_entrada').html('✔ Marcado ')
                    $('#m_almuerzo_fin').children('span').remove();
                    $('#des_m_almuerzo_fin').text('Marcado a la hora: ' + moment().format('HH:mm:ss'));
                    $('#m_almuerzo_fin').html('<span>✔ Marcado</span>')
                    $('#m_almuerzo_fin').prop("disabled", true);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer)
                            toast.addEventListener("mouseleave", Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: "success",
                        title: "Almuerzo finalizado ✔"
                    })
                } else if (response == 2) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer)
                            toast.addEventListener("mouseleave", Swal.resumeTimer)
                        },
                        willClose: () => {
                            location.reload();
                        }

                    });

                    Toast.fire({
                        icon: "error",
                        title: "Ya marcó su regreso del almuerzo 🤐 "
                    });
                } else if (response == 3) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer)
                            toast.addEventListener("mouseleave", Swal.resumeTimer)
                        },
                        willClose: () => {
                            location.reload();
                        }
                    });

                    Toast.fire({
                        icon: "error",
                        title: "Debe marcar primero el inicio del almuerzo 🤐 "
                    });
                }

            }
        });
    }
});

// Para marcar la salida
$(document).on('click', '#m_salida', function () {
    // Do click stuff here
    console.log('IS CLICKEEEEED salida');
    // $('.m_entrada').removeClass('is-success');
    $('#m_salida').removeClass('is-light');
    $('#m_salida').addClass('is-loading');
    if ($('#des_m_almuerzo_inicio').text() == "Sin marcar" || $('#des_m_almuerzo_fin').text() == "Sin marcar") {
        Swal.fire({
            title: '¿Está seguro de marcar su salida?',
            text: "Usted no ha completado su hora de almuerzo, no se registrará la hora ¿Continuar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, marcar salida!',
            cancelButtonText: 'No, cancelar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                    data: "salida=1&no_almuerzo=1",
                    success: function (response) {
                        console.log(response);
                        if (response == 1) {
                            $('#m_salida').addClass('is-light');
                            $('#m_salida').removeClass('is-loading');
                            $('#m_salida').removeClass('is-success');
                            // $('.m_entrada').children('#text_m_entrada').html('✔ Marcado ')
                            $('#m_salida').children('span').remove();
                            $('#des_m_salida').text('Marcado a la hora: ' + moment().format('HH:mm:ss'));
                            $('#m_salida').html('<span>✔ Marcado</span>')
                            $('#m_salida').prop("disabled", true);

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener("mouseenter", Swal.stopTimer)
                                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: "success",
                                title: "Salida marcada ✔"
                            })
                            location.reload();
                        } else if (response == 2) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener("mouseenter", Swal.stopTimer)
                                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                                },
                                willClose: () => {
                                    location.reload();
                                }

                            });

                            Toast.fire({
                                icon: "error",
                                title: "Ya marcó su salida 🤐 "
                            });
                        }
                    }
                });
            }
            if (result.isDismissed) {
                $('#m_salida').removeClass('is-loading');
                $('#m_salida').addClass('is-light');
            }
        });

    } else {
        $.ajax({
            type: "POST",
            url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
            data: "salida=1",
            success: function (response) {
                console.log(response);
                if (response == 1) {
                    $('#m_salida').addClass('is-light');
                    $('#m_salida').removeClass('is-loading');
                    $('#m_salida').removeClass('is-success');
                    // $('.m_entrada').children('#text_m_entrada').html('✔ Marcado ')
                    $('#m_salida').children('span').remove();
                    $('#des_m_salida').text('Marcado a la hora: ' + moment().format('HH:mm:ss'));
                    $('#m_salida').html('<span>✔ Marcado</span>')
                    $('#m_salida').prop("disabled", true);

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer)
                            toast.addEventListener("mouseleave", Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: "success",
                        title: "Salida marcada ✔"
                    })
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '¡Dia Completado! 😃',
                        showConfirmButton: false,
                        timer: 1000
                    })
                } else if (response == 2) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener("mouseenter", Swal.stopTimer)
                            toast.addEventListener("mouseleave", Swal.resumeTimer)
                        },
                        willClose: () => {
                            location.reload();
                        }

                    });

                    Toast.fire({
                        icon: "error",
                        title: "Ya marcó su salida 🤐 "
                    });
                }
            }
        });
    }
})


//Para exportar asistencia a word
$(document).on('click', '#exportarWorda', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    // console.log(datos);

    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();
    // data = data + '&reporte_asistencia=1';
    // var data = new FormData(form);
    // data.append('datos', datos);
    // data.append('exportar_asistencia', true);
    // Swal.fire({
    //     title: 'Exportar a Word',
    //     html: '<span>¿Desea exportar a Word?</span>',
    //     icon: 'question',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Si, exportar!',
    //     cancelButtonText: 'Cancelar'
    // }).then((result) => {
    //     if (result.isConfirmed) {

    // ajax para exportar a word y descargarlo



    $.ajax({
        type: 'POST',
        url: SERVERURL + "/pasantes/ajax/reporte.ajax.php",
        url: url,
        data: form.serialize(),
        data: data,
        // dataType: 'json',
        success: function (data) {
            //download data



            console.log(data);
            Swal.fire({
                title: 'Exito!',
                text: 'Se ha exportado correctamente',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        },
        error: function (data) {
            console.log(data);
            Swal.fire({
                title: 'Error!',
                text: 'No se ha podido exportar',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        }
    });
    //     }
    // })

});

//Show Advanced options toggler