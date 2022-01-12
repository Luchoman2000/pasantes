function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

function setObservacion() {
    Swal.fire({
        title: '¿Deseas añadir una observación?',
        input: 'textarea',
        inputAttributes: {
            'maxlength': '140',
            'autocapitalize': 'off',
            'autocorrect': 'off'
        },
        inputPlaceholder: 'Escribe aquí tu observación',
        showCancelButton: true,
        confirmButtonText: 'Añadir',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: async (observacion) => {
            // console.log(observacion);
            try {
                const response = await fetch(`${SERVERURL}/pasantes/ajax/asistencia.ajax.php?observacion=${observacion}`);
                // console.log(response);
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                if (response.status == 200) {
                    Swal.fire(
                        'Añadido',
                        'Tu observación ha sido añadida.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    throw new Error('Error al añadir la observación');
                }

            } catch (error) {
                // console.log(error);
                Swal.showValidationMessage(
                    `Error: ${error}`
                );
            }
        },
        preCancel: () => {
            location.reload();
        }

    }).then((result) => {
        if (result.isDismissed || result.isCancelled) {

            location.reload();
        }
    });
}

// Validar campos de exportación
var valid = true;
$(function () {

    //Check Empresa
    $('#empresa').on('keyup', function () {
        var empresa = $(this).val();
        var pattern = /^[a-zA-Z\s]*$/;
        if (pattern.test(empresa) && empresa.length > 4 && empresa.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid = false;
        }
    });

    //Check Tutor
    $('#tutor').on('keyup', function () {
        var tutor = $(this).val();
        var pattern = /^[a-zA-Z\s]*$/;
        if (pattern.test(tutor) && tutor.length > 4 && tutor.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid = false;
        }
    });

    //Check cargo
    $('#cargo').on('keyup', function () {
        var cargo = $(this).val();
        var pattern = /^[a-zA-Z\s]*$/;
        if (pattern.test(cargo) && cargo.length > 4 && cargo.length < 30) {
            $(this).removeClass('is-danger');
            $(this).addClass('is-success');
            valid = true;
        } else {
            $(this).removeClass('is-success');
            $(this).addClass('is-danger');
            valid = false;
        }
    });
})

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
            // console.log(response);
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

                $('#almuerzo').fadeIn(300);
                $('.m_entrada').parent().parent().parent().parent().parent().addClass('has-background-success-light').fadeIn(300);
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
                    position: "bottom-end",
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
                    position: "bottom-end",
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
                    title: "Ya marcó su entrada 😐 "
                });
            } else if (response == 'atrasado ok') {
                Swal.fire({
                        icon: 'warning',
                        title: '¡Atrasado!',
                        text: 'Llegaste atrasado, tu entrada será registrada de todos modos.',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    })
                    .then((result) => {
                        if (result.value) {
                            setObservacion();
                        }
                        // location.reload();
                    })

            } else if (response == 'tarde ok') {
                Swal.fire({
                        icon: 'warning',
                        title: '¡Tarde!',
                        text: 'Llegaste tarde 😢, tu entrada será registrada de todos modos.',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    })
                    .then((result) => {
                        if (result.value) {
                            setObservacion();
                        }
                        // location.reload();
                    })

            } else if (response == 'tarde sin registro entrada ok') {
                Swal.fire({
                        icon: 'error',
                        title: 'Tarde!',
                        text: 'Llegaste tarde 😢, tu entrada no será registrada',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    })
                    .then((result) => {
                        if (result.value) {
                            setObservacion();
                        }
                        // location.reload();
                    })
            } else if (response == 'tarde sin registro todo ok') {
                Swal.fire({
                        icon: 'error',
                        title: 'Tarde!',
                        text: 'Llegaste tarde 😢, tu asistencia de hoy no será registrada',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    })
                    .then((result) => {
                        if (result.value) {
                            setObservacion();
                        }
                        // location.reload();
                    })

            } else if (response == 0) {
                Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error, por favor intente nuevamente.',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Reintentar'
                    })
                    .then((result) => {
                        location.reload();
                    })
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
    Swal.fire({
        title: 'Aviso',
        text: "Estas apunto de empezar tu hora de almurzo, ¿Continuar?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        $('#m_almuerzo_inicio').removeClass('is-loading');
        $('#m_almuerzo_inicio').addClass('is-light');

        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                data: "almuerzo_inicio=1",
                success: function (response) {
                    // console.log(response);
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
                            position: "bottom-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener("mouseenter", Swal.stopTimer)
                                toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                        })
                        let comidas = ['🍏', '🍎', '🍊', '🍌', '🍉', '🍇', '🍓', '🍗', '🍖', '🍔', '🍟', '🍕', '🍤', '🍙', '🍚', '🍘', '🍥', '🍰', '🎂', '🍮', '🍭', '🍬', '🍫', '🍿', '🍩', '🍪', '🌰', '🍝', '🍜', '🍲', '🍛', '🍣', '🍱']


                        Toast.fire({
                            icon: "success",
                            title: "Almuerzo iniciado " + comidas[getRandomInt(comidas.length)]
                        })
                    } else if (response == 2) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "bottom-end",
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
                            title: "Ya marcó su entrada de almuerzo 😐 "
                        });
                    }
                }
            });
        }
    })
});

// Para marcar el fin del almuerzo
$(document).on('click', '#m_almuerzo_fin', function () {
    // Do click stuff here
    // console.log('IS CLICKEEEEED almuerzo fin');
    // $('.m_entrada').removeClass('is-success');

    if (!$('#m_almuerzo_inicio').is(':disabled')) {
        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
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
            title: "Debe marcar primero el inicio del almuerzo 😐 "
        });
    } else {
        $('#m_almuerzo_fin').removeClass('is-light');
        $('#m_almuerzo_fin').addClass('is-loading');

        $.ajax({
            type: "POST",
            url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
            data: "almuerzo_fin=1",
            success: function (response) {
                // console.log(response);
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
                        position: "bottom-end",
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
                        position: "bottom-end",
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
                        title: "Ya marcó su regreso del almuerzo 😐 "
                    });
                } else if (response == 3) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "bottom-end",
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
                        title: "Debe marcar primero el inicio del almuerzo"
                    });
                }

            }
        });
    }
});

// Para marcar la salida
$(document).on('click', '#m_salida', function () {
    // Do click stuff here
    // console.log('IS CLICKEEEEED salida');
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
                        // console.log(response);
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
                                position: "bottom-end",
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
                                position: "bottom-end",
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
                                title: "Ya marcó su salida 😐 "
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
        Swal.fire({
            title: 'Aviso',
            text: "Estás a punto de marcar tu salida, ¿Continuar?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, marcar salida!',
            cancelButtonText: 'No, cancelar!'
        }).then((result) => {
            $('#m_salida').removeClass('is-loading');
            $('#m_salida').addClass('is-light');

            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                    data: "salida=1",
                    success: function (response) {
                        // console.log(response);
                        if (response == 1) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: '¡Dia Completado! 😃',
                                showConfirmButton: false,
                                timer: 1000
                            }).then
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
                                position: "bottom-end",
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
                                position: 'bottom-end',
                                icon: 'success',
                                title: '¡Dia Completado! 😃',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        } else if (response == 2) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "bottom-end",
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
                                title: "Ya marcó su salida 😐 "
                            });
                        }
                    }
                });
            }
        });
    }
})


$(document).on('click', '.updateObser', function () {
    var text = $(this).prev().text();
    Swal.fire({
        title: 'Observación',
        input: 'textarea',
        inputAttributes: {
            'maxlength': '140',
            'autocapitalize': 'off',
            'autocorrect': 'off',
            'pattern': '^[[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \s]{0,120}]*$',
            'title': 'Solo letras y números',
            'validationMessage': 'Solo letras y números (max. 120 caracteres)'
        },
        inputValue: text,
        inputPlaceholder: 'Escribe aquí tu observación de este día',
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
        showLoaderOnConfirm: true,
        preConfirm: async (observacion) => {
            // console.log(observacion);
            try {
                const response = await fetch(`${SERVERURL}/pasantes/ajax/asistencia.ajax.php?observacionUp=${observacion}`);
                // console.log(response);
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                if (response.status == 200) {
                    Swal.fire(
                        'Acualizado!',
                        'Tu observación ha sido actualizada.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    throw new Error('Error al añadir la observación');
                }

            } catch (error) {
                // console.log(error);
                Swal.showValidationMessage(
                    `Error: ${error}`
                );
            }
        },
        preCancel: () => {
            location.reload();
        },
        inputValidator: (observacion) => {
            return new Promise((resolve) => {
                // validar con saltos de linea
                Validar = /^[[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ \s]{0,120}]*$/;
                if (Validar.test(observacion) && observacion.length <= 120) {
                    resolve()
                } else {
                    resolve('Solo letras y números')
                }
            });
        }


    })
})

//Para exportar asistencia a word
$(document).on('submit', '#exportarWorda', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    // console.log(valid);

    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();
    if (valid) {
        $.ajax({
            type: 'POST',
            url: SERVERURL + "/pasantes/ajax/reporte.ajax.php",
            url: url,
            data: form.serialize(),
            data: data,
            success: function (response) {
                window.location = SERVERURL + "/pasantes/ajax/reporte.ajax.php";
            },
            error: function (data) {
                // console.log(data);
                Swal.fire({
                    title: 'Error!',
                    text: 'No se ha podido exportar',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
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